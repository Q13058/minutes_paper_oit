<?php
//セション
session_start();

$_SESSION['student_no'] = "";
if (!$_SESSION['userid']) {
	header('Location: ./login.php');
	// 終了
	exit();
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ミニッツペーパー管理システム</title>
</head>
<body>
Login: <b><?php echo $_SESSION['userid']; ?></b>
<hr>


<br><br><br>■検索したい学生の学生番号を6桁で入力(例:Q10090)<br>


	<form method="POST" action="studentdata.php">
			ユーザー名：
			<br>
			<input type='text' name='search_no' autocomplete="off">
			<br>
			<br>
			<input type="submit" value="検索">
		</form>



<br><br>
<form action='top.php' method='post' enctype='multipart/form-data'>
			<input type='submit' value='講義画面に戻る'>
		</form>
<br>
</body>
</html>
