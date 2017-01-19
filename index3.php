 <?php
$name="aaa";
$name2="bbb";
 $csv_file = fopen('sample3.csv', 'w');
		 while(($csv_print = fgetcsv($csv_file)) !== FALSE){
	  for($i=0; $i <count($csv_print); $i++){
	 if($csv_print[$i]==''){
	 fwrite($csv_file,$name.",");
	 }else{
	 fwrite($csv_file,$name2.",");
	}
	}
}
	if($csv_file = fopen('sample3.csv', 'r')){
    print '<table border=1>';
    while(($csv_print = fgetcsv($csv_file)) !== FALSE){
        print '<tr>';
        for($i=1; $i < count($csv_print); $i++){
            print '<td>' . $csv_print[$i] . '</td>';
        }
        print '</tr>';
    }
    print '</table>';
}

?>
