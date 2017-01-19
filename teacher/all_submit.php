 <?php
include_once 'function.php';
	// セッションの開始
	session_start();

	// ログインチェック
	if(!$_SESSION['userid']){
		// ログインフォーム画面へ
		header('Location: login.php');
		// 終了
		exit();
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Q&A</title>
</head>
	<body>
 <div id="pagebody">

	<!-- ヘッダ -->
	<div id="header"><h1>ミニッツペーパシステム</h1></div>

</div>
	<br><br>

	<?php
	// MySQLへの接続
	$conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);
	if ($conn) {
		// データベースの選択
		mysql_select_db(DATABASE,$conn);
		$sql = "SELECT `number`,COUNT(`present`)as school_sum FROM `qanda` WHERE   `delete_flag`!='1' AND  `present`='1' GROUP BY `number`";
		$query = mysql_query($sql, $conn);
	}
		echo '<table border="1">';
		echo '<tr bgcolor="#CCCCCC">';
		echo '<td>学生番号</td>';
		echo '<td>提出回数</td>';
		while($row=mysql_fetch_object($query)) {
		echo '<tr>';
		echo '<td>' . $row->number .'</td>';
		echo '<td>' . $row->school_sum .'</td>';
		echo '</tr>';
		}
		echo "</table>";
	?>
	<br>
<li><a href="top.php">メニューへ戻る</a>
<br><br>
</body>
</html>
