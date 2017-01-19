<?php
	// セッション開始
	session_start();

	// セッション変数を初期化
	$_SESSION = array();

	// セッションIDを破棄
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-10000, '/');
	}

	// セッションを破棄
	session_destroy();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
<title>ログアウト</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="form">
ログアウトしました。<br>
<br>
<div align = "center">
<button class="btn" type="button" onclick="location.href='login.php'">ログイン画面に戻る</button>
</div>
</div>
</body>
</html>