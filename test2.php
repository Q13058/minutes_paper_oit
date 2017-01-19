 <?php

	include_once './teacher/function.php';

// The file test.xml contains an XML document with a root element
// and at least an element /[root]/title.
$zip = new ZipArchive();
$zip->open('QA0930.xlsx');

	?>
	<form method="POST" action="">
	<input type="text" name="text1">
	<input type="submit" name="btn1" value="色情報を取得する">
	</form>

	<?php
	if($_POST['text1']!=NULL){
	$cell=$_POST['text1'];
    $xml = simplexml_load_string( $zip->getFromName('xl/worksheets/sheet1.xml'));
    $xml2 = simplexml_load_string( $zip->getFromName('xl/styles.xml'));
    $xml3 = simplexml_load_string( $zip->getFromName('xl/sharedStrings.xml'));
        //$xml = simplexml_load_file('styles.xml');

	$color=GET_RGB($xml,$xml2,$xml3,$cell);
	//$color=1;
	print_r($xml);     
	}
?>
