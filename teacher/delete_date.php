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
	<div id="menu">ミニッツペーパーの削除</div>
<div class="container">
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
	if($_POST['OK'] !== 'ON'){
		echo "『本当に削除する』が選択されていません。";
	}else{
		$id = $_SESSION['id'];
		echo $id . 'のミニッツペーパー<br>';
		echo '<body><br><br>';

		// MySQLへの接続
		$conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);

		if ($conn) {
		// データベースの選択
		mysql_select_db(DATABASE,$conn);

		// データベースへの問い合わせSQL文
		$sql = 'DELETE FROM qanda WHERE lecture = "' . $_SESSION['lecture'] . '" AND school_date = "' . $id . '"';
		$sql2 = 'DELETE FROM question WHERE lecture = "' . $_SESSION['lecture'] . '" AND school_date = "' . $id . '"';
		$sql3 = 'DELETE FROM color WHERE lecture = "' . $_SESSION['lecture'] . '" AND school_date = "' . $id . '"';
		// SQL文の実行
		$query = mysql_query($sql, $conn);
		$query2 = mysql_query($sql2, $conn);
		$query2 = mysql_query($sql3, $conn);
		}
	echo "を削除しました。";
	}
?>
<form action="top.php" method="post" enctype="multipart/form-data">
	<button class="btn btn-primary" style="font-size: 20px; position: relative; left: 0px; top: 8px; padding: 7px 80px; text-align:center">ミニッツペーパー編集画面に戻る</button>
</form>
</div>
</body>
</html>
