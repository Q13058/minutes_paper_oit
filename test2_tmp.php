 <?php
// The file test.xml contains an XML document with a root element
// and at least an element /[root]/title.
$zip = new ZipArchive();
$zip->open('test2.xlsx');



    $xml = simplexml_load_string( $zip->getFromName('xl/worksheets/sheet1.xml'));
        //$xml = simplexml_load_file('styles.xml');
	
    foreach($xml-> sheetData->row as $data){
    //$childs = new SimpleXMLElement($data);
    $child=count($data,1);
	for($i=0;$i<$child;$i++){
	$result2[$i]=0;
	}

    //print_r($child);
    for($i=0;$i<$child;$i++){
    $result[] = array( 'r' => (string)$data->c[$i]['r']);
    $result2[] = array( 's' => (string)$data->c[$i]['s']);
	//print_r($result2[$i]);
	}
    
    $arr=get_object_vars($result);
    $arr2=get_object_vars($result2);
    //print_r($arr);
    //print_r($arr2);
        }


        foreach ($result as $key1 => $value1) {
  foreach ($value1 as $key2 => $value2) {
    print $value2."     "; //「.」は文字列連結
  }
}
	$i=0;
	foreach ($result2 as $key1 => $value1) {
  foreach ($value1 as $key2 => $value2) {
	if($result2[$i]!=0){
    print $value2."     "; //「.」は文字列連結
	}else{
	print_r($result2[$i]);
	}
	$i=$i+1;
  }
}
        
        

//} else {
    //exit('Failed to open styles.xml.');
//}
?>
