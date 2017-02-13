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
	$type = "SP_keyserch";
	//go_to_login($count_student, $num, $school_date, $login_time, $type);
	go_to_menu($number, $school_date, $login_time, $type);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
<title>Q&A</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="form">
<p class="form-title" style = "font-size:22px;">検索したい語句を入力してください。</p>
<form action="serch_keyword.php" method="POST">
<p>キーワードを入力</p><br>
<center><input type="text" name="keyword" value=""></center>
<input type="hidden" name="sort" value="school_date">
<br><br><br>
<!--
<p>ソートの仕方</p><br>
<input type="radio" name="sort" value="school_date" checked>講義日
<input type="radio" name="sort" value="question">質問
<br><br>
-->
<p class="submit"><input type="submit" value="検索する"></p>
</form>
</div>
<button class="btn" type="button" onclick="location.href='top.php'">メニューへ戻る</button>
<br><br>
<?php
	echo $_SESSION['lecture'] . 'のミニッツペーパー';
?>
</body>
</html>
