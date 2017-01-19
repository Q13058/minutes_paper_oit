<?php
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


//error(is_file_upload());
/*
$uploaddir = './uploads/';
$uploadfile = $uploaddir . basename($_FILES['upfile']['name']);

if (!move_uploaded_file($_FILES['upfile']['tmp_name'], $uploadfile)){
	error(10);
}*/

$zip = new ZipArchive();
$uploaddir = './uploads/';
//$uploadfile = $uploaddir . basename($_FILES['upfile']['name']);
//var_dump($uploadfile);
$filename = $_SESSION['filename'];
$uploadfile = $uploaddir . $filename;
//var_dump($filename);
$zip->open($uploadfile);
$xml = simplexml_load_string($zip->getFromName('xl/worksheets/sheet1.xml'));
$xml2 = simplexml_load_string( $zip->getFromName('xl/worksheets/sheet2.xml'));
$xml3 = simplexml_load_string( $zip->getFromName('xl/sharedStrings.xml'));
//$cell='A";
//$color=GET_RGB($xml,$xml2,$xml3,$cell);
//var_dump($xml);
$sheet1_sum=0;
$sheet2_sum=0;
	 foreach($xml-> sheetData->row as $data){
        $child=count($data,1);
        for($i=0;$i<$child;$i++){
	$sheet1_sum++;
        }
        }

	foreach($xml2-> sheetData->row as $data){
        $child=count($data,1);
        for($j=0;$j<$child;$j++){
	$sheet2_sum++;
        }
        }
	var_dump($sheet1_sum);
	var_dump($sheet2_sum);
	if($sheet1_sum>=$sheet2_sum){
	foreach($xml-> sheetData->row as $data){
        $child=count($data,1);
        for($i=0;$i<$child;$i++){
        $result[] = array( 'r' => (string)$data->c[$i]['r']);
        }
        }
	}else{
	foreach($xml2 -> sheetData->row as $data){
        $child=count($data,1);
        for($i=0;$i<$child;$i++){
        $result[] = array( 'r' => (string)$data->c[$i]['r']);
        }
        }
	}
	
	
	foreach ($result as $key1 => $value1) {
  foreach ($value1 as $key2 => $value2) {
        $cell[]=$value2;
  }
}
	print_r($cell[]);

//ファイルを読み込んでインスタンス化 (※Excel2007以前の形式)
$objReader = PHPExcel_IOFactory::createReader('Excel2007');//.xslなら「Excel5」
$book = $objReader->load($uploaddir.$filename);
 $book->setActiveSheetIndex(0);
      $sheet = $book->getActiveSheet();
      $highestRow = $sheet->getHighestRow();
         $highestColumn = $sheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        //var_dump($highestColumnIndex);
        //var_dump($highestRow);

$k=0;
 for($i=1;$i<=$highestRow;$i++){
                for($j=0;$j<$highestColumnIndex;$j++){
		$color=$cell[$k];
                $rgb[$i][$j]=$book->getActiveSheet()->getStyle($color)->getFill()->getStartColor()->getRGB();
                         //var_dump($color);
			$k++;
                }
         }
		
	

//$color= $book->getActiveSheet()->getStyle('A3')->getFill()->getStartColor()->getRGB();
        //print_r($color);

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
<body>
<form action='top.php' method='post' enctype='multipart/form-data'>
	<input type='submit' value='講義画面に戻る'>
</form>


HTML;



//追加
	$value = $_POST["cell"];
//		echo "読み込んだ列は";
		foreach($value as $v){
		 $args[] = $v; //読み込むセルの列をargsに代入
//			echo $v."列目"." ";
		}
//		echo "です。";


//シートをCSVに変換
$i = 1;

$selectsheetcount = $_POST['sheetcount'];//学科の個数の取得
//echo $selectsheetcount;
for($i = 1; $i <= $selectsheetcount; $i++){ //前のフォームからシート数カウント
	$objReader->setLoadSheetsOnly($sheetsName[$i - 1]);//シートを名前で指定（phpexcelでは複数シートを一度にCSVに出来ない）
	$book = $objReader->load($uploaddir.$filename);//そして、改めてロード
	$outputName = $_SESSION['day']."_sheet".$i.".csv";//出力ファイル名
	$writer = PHPExcel_IOFactory::createWriter($book, 'CSV');//CSVのフォーマットで
	$writer->save($uploaddir.$outputName);//保存します

echo<<<HTML
<table border=1>
<caption style="font-size: 20px; font-weight: bold; font-style: italic; ">シート名-->{$sheetsName[$i-1]}</caption>
HTML;

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

		

	//read from file
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

	$flag = true;

	
//	$flag_color = false;
	$rowcount = count($result);
	$m=2;
//	$color[][] = "FFFFFF";
	for($j = 0; $j < $rowcount; $j++){//1行ずつ取得
		echo "<tr>";
		$colcount = count($result[$j]);
		$selectcount = count($args);
		$count_num = $selectcount - 2;
		for($k = 0; $k < $selectcount; $k++){//ずつ取得
			echo "<td>".$result[$j][$args[$k]]."</td>"; //$k行　args[$i]列目を取得
//			$color[$j][$k] = $objWorksheet->getStyle($j.$args[$k])->getFill()->getStartColor()->getRGB();//セル色の取得
			//var_dump($rgb[$j+1][$k]);
		}
		echo "</tr>";
/*		for($z =0; $z < $selectcount; $z++){
		if($color[$j][$z] != "FFFFFF") $flag_color = true;

		}

	if($flag_color){
			if(!$find && !$flag){//これは冗長かも知れない
			$num  = $result[$j][0];
			$time = $result[$j][$args[1]];
			for($syoki = 0; $syoki < 8; $syoki++){
				$column[$syoki] ="";
			}	
			for($arg_num = 2; $arg_num <= $selectcount - 2; $arg_num++){
				$column[$arg_num - 2] = $result[$j][$args[$arg_num]];
			}
			$lec  = $_SESSION['lecture'];
			$date = $_SESSION['day'];
			go_to_sql_color($num, $time, $column[0], $column[1], $column[2], $column[3], $date, $lec, $column[4], $column[5], $column[6], $column[7], $outputName);
		}
	}else{ 
*/

		if(!$flag){
			$num  = $result[$j][0];
			$time = $result[$j][$args[1]];
			for($syoki = 0; $syoki < 8; $syoki++){
				$column[$syoki] ="";
			}	
			for($arg_num = 2; $arg_num <= $selectcount - 2; $arg_num++){
				$column[$arg_num - 2] = $result[$j][$args[$arg_num]];
			}
			$lec  = $_SESSION['lecture'];
			$date = $_SESSION['day'];

			if(!strlen(preg_replace('/^[ 　]+/u', '', $column[0]))){
				$column[0]="未回答";
			}
			//var_dump($arg_num);
			
			for($n=1;$n<$arg_num-1;$n++){
			//var_dump($time);
			//var_dump($num);
			//var_dump($rgb[$m][$n]);
			//var_dump($column[$n]);
		        go_to_color($date,$num,$rgb[$m][$n+2],$column[$n]);
			}
			$m++;

			//var_dump($column[0]);
			//var_dump($rgb[9][4]);
			//var_dump($column[2]);
			//var_dump($column[3]);
			//var_dump($column[4]);
			//var_dump($column[5]);
						

			if($column[0]==="未回答"){
			$present=0;
			}else{
			$present=1;
			}
			go_to_sql($num, $time, $column[0], $column[1], $column[2], $column[3], $date, $lec, $column[4], $column[5], $column[6], $column[7], $count_num,$outputName,$present);
		}


		if($flag){
			$flag = false;
//			$flag_color = false;
			for($syoki = 0; $syoki < 8; $syoki++){
				$q[$syoki] ="";
			}
			for($arg_num = 2; $arg_num <= $selectcount-1; $arg_num++){
				$q[$arg_num -2] = $result[$j][$args[$arg_num]]; //問題の保存
			}
//			echo var_dump($q);
			$date = $_SESSION['day'];
			go_to_question_sql($date, $q[0], $q[1], $q[2], $q[3], $q[4], $q[5], $q[6], $q[7], $count_num);
		}


//	}

	}
	echo "</table>";
	unlink($uploaddir.$outputName);
}

echo<<<HTML

<hr>
<br>
<form action='top.php' method='post' enctype='multipart/form-data'>
	<input type='submit' value='講義画面に戻る'>
</form>

</body>
</html>
HTML;

//unlink($uploaddir.$filename);//元ファイルは置いておこう
?>
