<?php
ini_set( 'display_errors', 1 );
header("Content-Type: text/html; charset=UTF-8");
include_once 'function.php';
$conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);
print'以下の学生を本当に削除しますか？';
echo'<br>';
$name=array();
if ($conn) {
  mysql_select_db(DATABASE,$conn);
	$count=0;
        $i=0;
	 foreach ( $_POST ['input5'] as $value ) {
		echo '<form method="POST" action="delete2.php" name="form1">';
		?>
		<input type="hidden" name="input5[]" size="30" maxlength="20" VALUE=<?php echo $value?>>
		<?php
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
		$name="$_POST ['input5']";
	}
	?>
						<input type="radio" name="OK" value="ON">
						本当に削除する
						<input type="radio" name="OK" value="OFF" checked>
						削除しない
						<br>
						<input type="submit" value="削除する">
					</form>
					<br>
<li><a href="top.php">メニューへ戻る</a>
<br><br>
