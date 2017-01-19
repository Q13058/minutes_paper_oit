 <?php
// The file test.xml contains an XML document with a root element
// and at least an element /[root]/title.
$zip = new ZipArchive();
$zip->open('test2.xlsx');



    $xml = simplexml_load_string( $zip->getFromName('xl/styles.xml'));
	//$xml = simplexml_load_file('styles.xml');

    foreach($xml-> fills ->fill as $data){
    //print_r($data->patternFill->fgColor['rgb']);
    $result[] = array( 'rgb' => (string)$data->patternFill->fgColor['rgb']);
    $arr=get_object_vars($result);
    //print_r( $result );
	}

	
	foreach ($result as $key1 => $value1) {
  foreach ($value1 as $key2 => $value2) {
    print $value2."	"; //「.」は文字列連結
  }
}

	$data[0]="トマト";
	
	//print_r( $result);

//} else {
    //exit('Failed to open styles.xml.');
//}
?> 
