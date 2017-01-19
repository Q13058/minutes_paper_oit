<?php
session_start();

if (!$_SESSION['userid']) {
	header('Location: ./login.php');
	// 終了
	exit();
}
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>パスワード変更画面</title>
	</head>
	<body>
		<form action="pass_judge.php" method="post" enctype="multipart/form-data">
			新しいパスワードを入力してください。
			<br>
			<input type="password" name="new_pass" size="20" autocomplete="off">
			<br>
			新しいパスワードを入力してください。(確認用)
			<br>
			<input type="password" name="Re_new_pass" size="20" autocomplete="off">
			<br>
			<br>
			今のパスワードを入力してください。
			<br>
			<input type="password" name="old_pass" size="20" autocomplete="off">
			<br>
			<input type="submit" value="パスワード変更">
			<br>
		</form>
		<hr>
		<form action="index.php" method="post" enctype="multipart/form-data">
			<input type="submit" value="講義選択に画面に戻る">
		</form>
	</body>
</html>
