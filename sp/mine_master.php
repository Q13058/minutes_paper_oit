<?php
include_once '../teacher/function.php';
include_once './mine_log.php';
header("Content-Type: text/html; charset=UTF-8");
	// セッションの開始
	session_start();

	// ログインチェック
	if(!$_SESSION['studentid']){
		// ログインフォーム画面へ
		header('Location: ../login.php');
		// 終了
		exit();
	}
?>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
<title>ミニッツペーパー閲覧システム</title>
<link rel="stylesheet" href="css/style.css">
</head>
<?php
$conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);
$num =0;
$cnt2=0;
$flag4=0;
$flag5=0;
$flag6=0;
$flag7=0;
$flag8=0;
if ($conn) {
	// データベースの選択
	mysql_select_db(DATABASE,$conn);
	$id = $_SESSION['studentid'];
	$lec = $_SESSION['lecture'];
	// データベースへの問い合わせSQL文
	if ($conn) {
		// データベースの選択
		mysql_select_db(DATABASE,$conn);
		$sql = "SELECT `number`,COUNT(`present`)as school_sum FROM `qanda` WHERE   `delete_flag`!='1' AND  `present`='1' AND `lecture`='{$lec}' GROUP BY `number`";
		// ORDER BY `school_sum` DESC";
		//$sql = "SELECT `number`,COUNT(`present`) as `school_sum` FROM `qanda` WHERE `present` IN(SELECT MAX(`present`) FROM `qanda` GROUP BY `number`)";
		$query = mysql_query($sql, $conn);
	}
	echo	"<div align = center>";
	echo '<table width="50%" border="1" class = coder>';
	echo '<thead>';
	echo '<tr bgcolor="#CCCCFF">';
	echo '<td width="30%"><b>学生番号<b></td>';
	echo '<td width="70%"><b>提出回数<b></td>';
	echo '</thead>';
	echo '<tbody>';
	while($row=mysql_fetch_object($query)) {
		echo '<tr>';
		echo '<td align=center><a href= "mine_master_student.php?id=' . $row->number . '">' . $row->number .'</a></td>';
		echo '<td style="padding-left: 20px;">' . $row->school_sum .'</td>';
		echo '</tr>';
	}
	echo '</tbody>';
	echo "</table>";
	echo "</div>";
}
?>
<body>

<button class="btn" type="button" onclick="location.href='top.php'">メニューへ戻る</button><br><br>
<?php
	echo $_SESSION['lecture'] . 'のミニッツペーパー';
?>
</body>
</html>
