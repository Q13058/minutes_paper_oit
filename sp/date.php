<?php
include_once '../teacher/function.php';
	// セッションの開始
	session_start();

	// ログインチェック
	if(!$_SESSION['studentid']){
		// ログインフォーム画面へ
		header('Location: login.php');
		// 終了
		exit();
	}
	$number = $_SESSION['studentid'];
	$school_date = date('Y-m-d');
	$login_time = date('H:i:s');
	$type = "SP_date";
	//go_to_login($count_student, $num, $school_date, $login_time, $type);
	go_to_menu($number, $school_date, $login_time, $type);
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
		<title>講義日選択</title>
	</head>
	<link rel="stylesheet" href="css/style.css">
	<body>
		<div align = "center">
			<table class="coder">
				<tr><th align="center" style = "background:#f9f9db;">講義日</th></tr>
				<form action="" method="GET">
<?php

	// MySQLへの接続
	$conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);

	if ($conn) {
		// データベースの選択
		mysql_select_db(DATABASE,$conn);

		// データベースへの問い合わせSQL文
		$sql = 'SELECT DISTINCT school_date FROM qanda WHERE lecture = "' . $_SESSION['lecture'] . '" ORDER BY school_date';

		// SQL文の実行
		$query = mysql_query($sql, $conn);

		// データの取出し
		while($row=mysql_fetch_object($query)) {
echo<<<HTML
<tr><td><button class="list" type="button" onclick="location.href='serch.php?id={$row->school_date}'">{$row->school_date}</button></td></tr>
HTML;
		}
	}
?>
</form>
</table>
</div>
<br>
<button class="btn" type="button" onclick="location.href='top.php'">メニューへ戻る</button><br><br>
<?php
	echo $_SESSION['lecture'] . 'のミニッツペーパー';
?>
</body>
</html>
