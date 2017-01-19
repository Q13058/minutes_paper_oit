<?php
set_include_path(get_include_path() . PATH_SEPARATOR . './Classes/');  
include 'PHPExcel.php';  
include 'PHPExcel/IOFactory.php';  

/**
 * ファイルの文字コードを変換する関数
 * @access public
 * @param string $file1
 * @param string $encoding1
 * @param string $file2
 * @param string $encoding2
 * @param string $newline
 */
function convert_file_encoding($file1, $encoding1, $file2, $encoding2, $newline = ''){
    if ( ! file_exists($file1) OR ! is_file($file1)){
        return 'ファイルが存在しません。';
    }
     
    $data1 = file_get_contents($file1);
     
    if ($data1 === FALSE){
        return 'データの取得に失敗しました。';
    }
     
    $data2 = mb_convert_encoding($data1, $encoding2, $encoding1);
    $data2 = str_replace(array("\r\n", "\n", "\r"), $newline, $data2);
    $handle = fopen($file2, 'wb');
     
    if ($handle === FALSE){
        return 'ファイルへの書き込みに失敗しました。';
    }
     
    fwrite($handle, $data2);
    fclose($handle);
     
    return "{$file1} の文字コードを {$encoding2} に変換し {$file2} に出力しました。";
}


//ファイルを読み込んでインスタンス化 (※Excel2007以前の形式)
$objReader = PHPExcel_IOFactory::createReader('Excel2007');//.xslなら「Excel5」
$book = $objReader->load('LANGQA1218.xlsx');

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
HTML;

//シートをCSVに変換
$i = 1;
for($i = 1; $i <= $sheetsCount; $i++){
	$objReader->setLoadSheetsOnly($sheetsName[$i - 1]);//シートを名前で指定（phpexcelでは複数シートを一度にCSVに出来ない）
	$book = $objReader->load('LANGQA1218.xlsx');//そして、改めてロード
	$outputName = "output".$i.".csv";//出力ファイル名
	$writer = PHPExcel_IOFactory::createWriter($book, 'CSV');//CSVのフォーマットで
	$writer->save($outputName);//保存します

echo<<<HTML
<table border=1>
<caption style="font-size: 20px; font-weight: bold; font-style: italic; ">Sheet_0$i</caption>
HTML;

	//echo convert_file_encoding($outputName, "utf-8", $outputName, "sjis-win", "\n");//これはUTF-8のシートをSJISに変える

	//ここからCSV読み込み
	$reader = PHPExcel_IOFactory::createReader('CSV')//読み取りはCSVを読み取る
	            ->setDelimiter(',')//何で区切るか
	            ->setEnclosure('"')//何で閉じられているか
	            ->setLineEnding("\n")//改行文字は何か
	            ->setSheetIndex(0)//シートの1枚目
	            ->load("output".$i.".csv");//ロード
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
			$file_data[$col]=trim($value);//データ格納用に格納で、空白文字などを除去
		}
		$result[] = $file_data;//ここで2次元配列となり、$result[行][列] になってる
	}
	//echo var_dump($result);

	$flag = true;
	for($j = 0; $j < count($result); $j++){//1行ずつ取得
		//if($flag){
		//	$flag = false;
		//	continue;
		//}
		echo "<tr>";
		for($k = 0; $k < count($result[$j])-1; $k++){//1列ずつ取得
			echo "<td>".$result[$j][$k]."</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
}

echo<<<HTML
</body>
</html>
HTML;

?>