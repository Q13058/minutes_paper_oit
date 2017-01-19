<?php
 include_once './teacher/function.php';
$name="プログラミング言語論";
$name="\"$name\"";
$name2="アセンブリ言語";
$name2="\"$name2\"";



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
?>
