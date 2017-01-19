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
<link rel="stylesheet" href="css/sample.css">
<link href="../css/bootstrap.css" rel="stylesheet" media="screen">
<link href="css/bs-button-style.css" rel="stylesheet" media="screen">
<title>ミニッツペーパーの削除</title>
</head>
<body>
	<div id="login" style="font-size: 15px;">
		Login: <?php echo $_SESSION['userid']; ?> さん
	</div>
	<div id="menu">ミニッツぺーパーの削除</div>
	<div class="container">
<?php
	echo "<font size=5>" . $_SESSION['lecture'] . "のミニッツペーパー</font><br>";
?>
<?php
	$id = $_GET['id'];
	$_SESSION['id'] = $id;
	echo $id . 'のミニッツペーパー<br>を削除しますか？';
	echo '<body><br><br>';
?>
	<form method="POST" action="delete_date.php">
		<input type="radio" name="OK" value="ON">
						本当に削除する
						<input type="radio" name="OK" value="OFF" checked>
						削除しない
						<br><br>
						<button class="btn btn-danger" style="font-size: 20px; position: relative; left: 0px; top: 8px; padding: 7px 60px; text-align:center">削除する</button>
					</form>

<br>
<form action="top.php" method="post" enctype="multipart/form-data">
	<button class="btn btn-primary" style="font-size: 20px; position: relative; left: 0px; top: 8px; padding: 7px 80px; text-align:center">ミニッツペーパー編集画面に戻る</button>
</form>
<br><br>
</div>
</body>
</html>
