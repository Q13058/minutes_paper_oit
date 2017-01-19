	<?php
	header("Content-Type: text/html; charset=UTF-8");
include_once 'function.php';
//session_start();
//if ($_POST['del_OK'] == 'OFF') {
        //echo "『削除する』が選択されていません";
        //goto FIN;
//}
print'以下の学生データを元に戻しました';
echo'<br>';

$name=array();
$conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);
if ($conn) {
        mysql_select_db(DATABASE,$conn);
        $count=0;
        $i=0;
        $sql = "UPDATE  qanda SET delete_flag= 0 WHERE number =";
         foreach ( $_POST ['insert'] as $value ) {
                if($count==0){
                $tmp .= "'$value'";
                print"'$value'";
                $name[$i]="'$value'";
		echo'<br>';
                }else{
                $tmp.="OR number=";
                $tmp.="'$value'";
                print"'$value'";
                $name[$i]="'$value'";
                echo'<br>';
                }
                $count=$count+1;
                $i=$i+1;
        }
        $sql.=$tmp;
        echo'<br>';
	$query = mysql_query($sql, $conn);
        }

FIN:
?>
<br>
<li><a href="top.php">メニューへ戻る</a>
<br><br>
