<?php
ini_set( 'display_errors', 1 );
header("Content-Type: text/html; charset=UTF-8");
include_once 'function.php';
session_start();
?>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
<link rel="stylesheet" href="css/sample.css">
<link href="../css/bootstrap.css" rel="stylesheet" media="screen">
<link href="css/bs-button-style.css" rel="stylesheet" media="screen">
<title>学生データの復元</title>
</head>
<body>

<?php
echo '<div id="login" style="font-size: 15px;">';
echo 'Login:'.$_SESSION['userid'].'さん';
echo '</div><div id="menu">学生データの削除</div>';
 echo '学生データを元に戻したい番号を選んで下さい';
echo'<br>';
$conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);
if ($conn) {
  mysql_select_db(DATABASE,$conn);
	$sql = "SELECT DISTINCT number FROM qanda WHERE delete_flag = 1 ORDER BY `number` ";
	$query = mysql_query($sql, $conn);
	while($row=mysql_fetch_object($query)){
	echo '<form method="POST" action="insert2.php" name="form1">';
	$number=$row->number;
	print "${number}";
	?>
	<input type="checkbox" name="insert[]" size="30" maxlength="20" VALUE=<?php echo $number?>>
	<?php
	echo'<br>';
	//echo '<table  border="1">';
	//echo '<tr bgcolor="#CCCCCC">';
	//echo '<td>' . $row->number .'</td>';
	//echo '</tr>';
 	//echo '</table>';
	}
}
	echo'<br>';
	echo'<input type="submit" value="元に戻す">';
  echo'<br>';
	echo'</form>';
?>
<br>
<li><a href="top.php">メニューへ戻る</a>
<br><br>
