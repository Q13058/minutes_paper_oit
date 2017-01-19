<?php
	// セッション開始
	session_start();

	// セッション変数を初期化
	$_SESSION = array();

	// セッションIDを破棄
	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-3600, '/');
	}

	// セッションを破棄
	session_destroy();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/sample.css">
<link href="../css/bootstrap.css" rel="stylesheet" media="screen">
<title>ログアウト</title>
</head>
<body>
	<div id="login" style="font-size: 15px;">
		Logout
	</div>
	<div id="menu">ログアウト</div>
		<br>
	<div class="container">
	■ログアウトしました。<br>
	<br>
	<form action="login.php" method="POST">
	<button class="btn btn-success" style="font-size: 20px; position: relative; left: 0px; top: 8px">ログイン画面に戻る</button>
	</form>
	<br>
</div>
</body>
</html>
