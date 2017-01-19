<?php
 include_once './teacher/function.php';
$name="プログラミング言語論";
$name="\"$name\"";
$name2="アセンブリ言語";
$name2="\"$name2\"";

$csv_file = fopen('lec.csv', 'a');
        
          for($i=0; $i <2; $i++){
	 print $csv_file;
         if($csv_file==''){
         fwrite($csv_file,$name.",");
         }else{
         fwrite($csv_file,$name.",");
        }
        }

if($csv_file = fopen('lec.csv','r')){
    print '<table border=1>';
    while(($csv_print = fgetcsv($csv_file)) !== FALSE){
        print '<tr>';
        for($i=1; $i < count($csv_print)&&$csv_print[$i]!=""; $i++){
            print '<td>' . $csv_print[$i] . '</td>';
	    $tmp[$i]=$csv_print[$i];
	    var_dump($tmp[$i]);
        }
        print '</tr>';
    }
    print '</table>';
}
	 //var_dump($i);
	 //var_dump($tmp[16]);

        $conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);
        if ($conn) {
                // データベースの選択
                mysql_select_db(DATABASE,$conn);
                $sql = "SELECT DISTINCT `teacher` FROM `qanda`";
                $i=1;
                $j=1;
                $max_num=2;
                 $query = mysql_query($sql, $conn);
                 while($row=mysql_fetch_object($query)) {
                        $teacher[$i]=$row->teacher;
			//var_dump( $teacher[$i]);
			$i=$i+1;
			}
		
	 $sql2 = "SELECT DISTINCT `lecture` FROM `qanda`";
                $query2 = mysql_query($sql2, $conn);
                $j=1;
                while($row2=mysql_fetch_object($query2)) {
                $lec[$j]=$row2->lecture;
		 //var_dump( $lec[$j]);
                $j=$j+1;
                }
	}
	$l=0;	
	for($k=1;$k<$i;$k++){
		for($m=1;$m<$j;$m++){
			if($tmp[$k]!=$lec[$m]){
				$add[$l]=$lec[$m];
				//var_dump($add[$l]);
				$l=$l+1;
				}
			}
		}


	$csv_file = fopen('lec.csv', '4');
          for($i=0; $i <2; $i++){
	  var_dump($add[$i]);
	//$add[$i]="\"$add[$i]"\";
	$name= $add[$i];
	//var_dump($name);
         fwrite($csv_file,$add[$i].",");
        }
 
	if($csv_file = fopen('lec.csv','r')){
    print '<table border=1>';
    while(($csv_print = fgetcsv($csv_file)) !== FALSE){
        print '<tr>';
        for($i=1; $i < count($csv_print)&&$csv_print[$i]!=""; $i++){
            print '<td>' . $csv_print[$i] . '</td>';
            $tmp[$i]=$csv_print[$i];
            //var_dump($tmp[$i]);
        }
        print '</tr>';
    }
    print '</table>';
}
	

	


?>
