<?php
	// セッションの開始
	session_start();
/*
	// ログインチェック
	if(!$_SESSION['login']){
		// ログインフォーム画面へ
		header('Location: login.php');
		// 終了
		exit();
	}
 */
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<title>Excelファイルアップロード</title>
</head>
<body>
■アップロードするExcelファイルを入力してください。
<br>
<form action="insert_excel.php" method="POST" enctype="multipart/form-data">
Excelファイル：
<br>
<input type="file" name="filename" size="50">
<br><br>
授業日を入力してください。(例：20110906)
<br>
<input type="text" name="day" size="40" autocomplete="off" value="">
<br><br>
<input type="submit" value="アップロード">
</form>
<br>
<li><a href="top.php">メニューに戻る</a>
</body>
</html>
