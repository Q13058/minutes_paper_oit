<?php
ini_set( 'display_errors', 1 );#エラーがある際に表示
include_once './function.php';
set_include_path(get_include_path() . PATH_SEPARATOR . '../Classes/');
include 'PHPExcel.php';
include 'PHPExcel/IOFactory.php';

session_start();

if (!$_SESSION['userid']) {
	header('Location: ./login.php');
	// 終了
	exit();
}

$_SESSION['day'] = $_POST['day'];
$_SESSION['mseg'] = NULL;
//エラーの取得(function.php)
error(is_file_upload());

$uploaddir = './uploads/';
$uploadfile = $uploaddir . basename($_FILES['upfile']['name']);
//var_dump(basename($_FILES['upfile']['name']));

if (!move_uploaded_file($_FILES['upfile']['tmp_name'], $uploadfile)){
//	error(10);
echo $uploadfile;
}

$filename = $_FILES['upfile']['name'];
$_SESSION['filename'] = $_FILES['upfile']['name'];
//ファイルを読み込んでインスタンス化 (※Excel2007以前の形式)
$objReader = PHPExcel_IOFactory::createReader('Excel2007');//.xslなら「Excel5」
$book = $objReader->load($uploaddir.$filename);

//シートの数をカウント
//各シートの名前を保存
$sheetsCount = $book->getSheetCount();//シート数をカウント
$sheetsName = array();
for($i = 0; $i < $sheetsCount; $i++){
	$book->setActiveSheetIndex($i);//アクティブにするシートを指定
	$worksheet = $book->getActiveSheet();//アクティブなシートの情報を取得
	$sheetsName[$i] = $worksheet->getTitle();//そのシートのシート名を取得
}

echo<<<HTML
<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
		<link rel="stylesheet" href="css/sample.css">
		<link href="../css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="css/bs-button-style.css" rel="stylesheet" media="screen">
		<title>Excelアップロード</title>
		<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
<script type="text/javascript">
    /* フォーム全体からチェックボックスだけ全選択/全解除処理をする例 */
    function chkAll_form(bool) {
        var frm=document.form1;
        for(var i=1; i<frm.length; i++) {
            if(frm.elements[i].type=="checkbox"){
                frm.elements[i].checked=bool;
            }
        }
    }
</script>
</head>
<body>
HTML;
echo '<div id="login" style="font-size: 15px;">';
echo 'Login:'.$_SESSION['userid'].'さん';
echo '</div><div id="menu">Excelファイルチェック</div>';

//シートをCSVに変換
$i = 1;
for($i = 1; $i <= 1; $i++){
	$objReader->setLoadSheetsOnly($sheetsName[$i - 1]);//シートを名前で指定（phpexcelでは複数シートを一度にCSVに出来ない）
	$book = $objReader->load($uploaddir.$filename);//そして、改めてロード
	$outputName = $_SESSION['day']."_sheet".$i.".csv";//出力ファイル名
	$writer = PHPExcel_IOFactory::createWriter($book, 'CSV');//CSVのフォーマットで
	$writer->save($uploaddir.$outputName);//保存します


echo "<form action='new_excel_to_sql.php' method='post' name='form1'>";
echo "<div class='container'>";
echo "<table border=1>";
echo "<caption style='font-size: 20px; font-weight: bold; font-style: italic; '>".'アップロードファイル : '.$filename."</caption>";

	//echo convert_file_encoding($outputName, "utf-8", $outputName, "sjis-win", "\n");//これはUTF-8のシートをSJISに変える

	//ここからCSV読み込み
	$reader = PHPExcel_IOFactory::createReader('CSV')//読み取りはCSVを読み取る
	            ->setDelimiter(',')//何で区切るか
	            ->setEnclosure('"')//何で閉じられているか
	            ->setLineEnding("\n")//改行文字は何か
	            ->setSheetIndex(0)//シートの1枚目
	            ->load($uploaddir.$outputName);//ロード
	$objWorksheet = $reader->setActiveSheetIndex(0);//アクティブなシートの情報を取得
	$highestRow = $objWorksheet->getHighestRow();//行数
	$highestColumn = $objWorksheet->getHighestColumn();//列数（ただし文字列）
	$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);//なので、列数を数値に変換

	//選択したExcelファイルを$file_data変数（配列）に書き込む
	$result = array();//結果を格納する配列の初期化
	for($row = 1; $row <= $highestRow; ++$row){//行の数だけ回す
		$file_data = array();//データを格納する配列の初期化
		for ($col = 0; $col <= $highestColumnIndex; ++$col){//列ごとに値をとっていく
			$value=$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();//col列、row行の値を取得
			$file_data[$col]=htmlspecialchars(str_replace("_x000D_", "", trim($value)), ENT_QUOTES);//データ格納用に格納で、空白文字などを除去
		}
		$result[] = $file_data;//ここで2次元配列となり、$result[行][列] になってる
	}
	//echo var_dump($result);

	$find = strpos($sheetsName[$i - 1], "open");
	$flag = true;
	$rowcount = count($result);
	for($j = 0; $j < 1; $j++){//1行ずつ取得
		echo "<tr>";
		$colcount = count($result[$j]);
		for($k = 0; $k < $colcount - 1 ; $k++){//1列ずつ取得
			if($k == 0) {
				echo "<td align=\"center\"><input type=\"checkbox\" name=\"cell[]\" value=\"".($k)."\" checked hidden></td>";
			} else {
				echo "<td align=\"center\"><input type=\"checkbox\" name=\"cell[]\" value=\"".($k)."\"></td>";
			}
		}
		echo "</tr>";

		echo "<tr>";
		for($k = 0; $k < $colcount - 1; $k++){//1列ずつ取得
			echo "<td>".$result[$j][$k]."</td>";
		}
		echo "</tr>";

/*		if(!$find && !$flag){//これは冗長かも知れない
			$num  = $result[$j][0];
			$time = $result[$j][2];
			$que  = $result[$j][$colcount - 5];
			$ans  = $result[$j][$colcount - 4];
			$com  = $result[$j][$colcount - 3];
			$rep  = $result[$j][$colcount - 2];
			$lec  = $_SESSION['lecture'];

		}
		if($flag){
			$flag = false;
			$q[0] = $result[$j][$colcount - 5];
			$q[1] = $result[$j][$colcount - 4];
			$q[2] = $result[$j][$colcount - 3];
			$q[3] = $result[$j][$colcount - 2];
			$q[4] = $result[$j][$colcount - 1];
			//echo var_dump($q);
			$date = $_SESSION['day'];

		}
*/
	}
echo<<<HTML
</table>

<p>
<button class="btn btn-primary" type="button" onclick="chkAll_form(true)" value="check all" style="font-size: 20px; position: relative; left: -26px; top: 8px;text-align:center">すべて選択</button>
<!--
<input type="button" onclick="chkAll_form(true)" value="check all" />
-->
<button class="btn btn-primary" type="button" onclick="chkAll_form(false)" value="uncheck all" style="font-size: 20px; position: relative; left: 0px; top: 8px;text-align:center">すべてはずす</button>
<!--
<input type="button" onclick="chkAll_form(false)" value="uncheck all" />
-->
</p>
<hr>
アップロードするシート数を半角数字で入力してください。
<input type="text" name='sheetcount' size="5" value="1"/>
<br/><br/>

<button class="btn btn-primary" style="font-size: 20px; position: relative; left: 0px; top: 8px;text-align:center; text-align:center;">アップロード実行</button>
<!--
<input type='submit' value='アップロード実行' />
-->
</form>
<form action='file_upload.php' method='post'>
<button class="btn btn-primary" style="font-size: 20px; position: relative; left: 0px; top: 16px;text-align:center; text-align:center;">メニュー画面に戻る</button>
</form>
</div>
HTML;
	unlink($uploaddir.$outputName);
}


echo<<<HTML

</body>
</html>
HTML;

//unlink($uploaddir.$filename);//元ファイルは置いておこう
?>
