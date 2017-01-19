<?php
	include_once './log.php';
	// セッションの開始
	session_start();
	// どの講義が選択されたかを保存　講義選択以外から来た場合はスルー
	if(!$_SESSION['lecture']){
		$_SESSION['lecture'] = $_POST['lec'];
	}

/*
	// どの年度が選択されたかを保存　講義選択以外から来た場合はスルー
	if(!$_SESSION['year']){
		$_SESSION['year'] = $_POST['fiscal'];
	}
*/

 	if(!$_SESSION['studentid']){
 		header('Location: login.php');
		// 終了
		exit();
 	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
<title>ミニッツペーパー管理システム</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<p>Login: <?php echo $_SESSION['studentid']; ?></p>
<hr>
<?php
	echo "<h1><font size=4>" . $_SESSION['lecture'] . "のミニッツペーパー</font></h1>";
?>
<div id="form">
<p class="form-title">メニュー</p>
<div align = "center">
<button class="list" type="button" onclick="location.href='mine.php'">自分のミニッツペーパー</button><br><br>
<button class="list" type="button" onclick="location.href='date.php'">全体のミニッツペーパー</button><br><br>
<button class="list" type="button" onclick="location.href='keyserch.php'">　  　 　単語検索　 　  　</button><br><br>
<button class="list" type="button" onclick="location.href='chart.php'">　　提出率のグラフ　　</button>
</div>
<?php
	if(substr($_SESSION['lecture'], 0, 1) == 't'){
		echo '<td><a href= "upload_csv.php">CSVアップロード</a></td>';
		echo '<li><a href="check.php">詳細検索</a>';
	}
?>
<hr>
<button class="btn" type="button" onclick="location.href='index.php'">講義選択へ戻る</button>
</div>
</body>
</html>
