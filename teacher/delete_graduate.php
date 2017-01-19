 <?php
header("Content-Type: text/html; charset=UTF-8");
include_once 'function.php';
ini_set( 'display_errors', 1 );
session_start();
$conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);
$lec = $_SESSION['lecture'];
if ($conn) {
    // データベースの選択
	mysql_select_db(DATABASE,$conn);
  $sql = "SELECT DISTINCT `number` FROM `qanda` WHERE delete_flag=0 AND `lecture`='{$lec}' ORDER BY `number` ";
	$query = mysql_query($sql, $conn);
}

echo<<<HTML
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
<link rel="stylesheet" href="css/sample.css">
<link href="../css/bootstrap.css" rel="stylesheet" media="screen">
<link href="css/bs-button-style.css" rel="stylesheet" media="screen">
<title>学生データの削除</title>
</head>
<body>
HTML;

echo '<div id="login" style="font-size: 15px;">';
echo 'Login:'.$_SESSION['userid'].'さん';
echo '</div><div id="menu">学生データの削除</div>';

echo "<div class='container'>";
echo'<br>';
echo '<p style="text-align: left; font-size:30px;">削除したい学籍番号を選択してください</p>';
//echo '<table  border="1" align="center">';
//echo '<tr bgcolor="#CCCCCC">';
while($row=mysql_fetch_object($query)){
//echo '<table  border="1">';
//echo '<tr bgcolor="#CCCCCC">';
//echo '<td>' . $row->number .'</td>';
echo '<form method="POST" action="delete_graduate_check.php" name="form1">';
$number=$row->number;
print "${number}";
?>
<input type="checkbox" name="input5[]" size="30" maxlength="20" VALUE=<?php echo $number?>>
<?php
echo'<br>';
//echo '</tr>';
 //echo "</table>";
}
//echo '</tr>';
//echo "</table>";
echo '<button class="btn btn-primary" style="font-size: 20px; position: relative; left: 0px; top: 8px;text-align:center; text-align:center;">学生データを削除する</button>';
echo '</form>';
?>
<form action='top.php' method='post' enctype='multipart/form-data'>
<button class="btn btn-primary" style="font-size: 20px; position: relative; left: 0px; top: 16px;text-align:center; text-align:center;">メニュー画面に戻る</button>
</form>
</div>
<br><br>
</body>
</html>
