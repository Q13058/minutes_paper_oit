 <?php
 header("Content-Type: text/html; charset=UTF-8");
include_once 'function.php';
if ($_POST['OK'] == 'OFF') {
	echo "『削除する』が選択されていません";
	goto FIN;
}
print'以下の学生を削除しました';
echo'<br>';

$name=array();

$conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);
if ($conn) {
  mysql_select_db(DATABASE,$conn);
	$count=0;
	$i=0;
	$sql = "UPDATE  qanda SET delete_flag= 1 WHERE number =";
	 foreach ( $_POST ['input5'] as $value ) {
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
        //$sql = 'DELETE FROM qanda WHERE number ="'.$_POST['input5'][0].'"OR number="'.$_POST['input5'][1].'"OR number="'.$_POST['input5'][2//].'"OR number="'.$_POST['input5'][3].'"OR number="'.$_POST['input5'][4].'"OR number="'.$_POST['input5'][5].'"OR number="'.$_POST['input5'][//6].'"OR number="'.$_POST['input5'][7].'"OR number="'.$_POST['input5'][8].'"OR number="'.$_POST['input5'][9].'"';
	//var_dump($sql);
  $query = mysql_query($sql, $conn);
	}

FIN:
?>
<br>
<li><a href="top.php">メニューへ戻る</a>
<br><br>
