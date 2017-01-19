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
	echo '<div id="login" style="font-size: 15px;">';
	echo 'Login:'.$_SESSION['userid'].'さん';
	echo '</div><div id="menu">Excelファイルチェック</div>';
?>
<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
	<link rel="stylesheet" href="css/sample.css">
	<link href="../css/bootstrap.css" rel="stylesheet" media="screen">
	<link href="css/bs-button-style.css" rel="stylesheet" media="screen">
<title>講義日一覧表示</title>
</head>
<body>
<div class="container">
<table border=1>
<tr bgcolor="#CCCCCC">
<td style="text-align:center; background-color:4ec950; color:white;" width="35%">講義日</td>
</tr>
<form action="" method="GET">
<?php

	// MySQLへの接続
	$conn = mysqli_connect(IPADDRESS, USERNAME, USERPASSWORD, DATABASE);

	if ($conn) {
		// データベースの選択
		mysqli_select_db($conn,"mpaper_Q13058");
		echo "◆".$_SESSION['lecture'];
		// データベースへの問い合わせSQL文
		$sql = 'SELECT DISTINCT school_date FROM qanda WHERE lecture = "' . $_SESSION['lecture'] . '" ORDER BY school_date';

		// SQL文の実行
		$query = mysqli_query($conn,$sql);

		// データの取出し
		while($row = mysqli_fetch_object($query)) {
			echo '<tr>';
			echo '<td style="text-align:center; background-color:white;"><a href= "delete.php?id=' . $row->school_date . '">' . $row->school_date .'</a></td>';
			echo '</tr>';
		}
	}
?>
</form>
</table>
<br>
<form action="top.php" method="post" enctype="multipart/form-data">
	<button class="btn btn-primary" style="font-size: 20px; position: relative; left: 0px; top: 8px; padding: 7px 80px; text-align:center">ミニッツペーパー編集画面に戻る</button>
</form>
<br><br>
</div>
</body>
</html>
