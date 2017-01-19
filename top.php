<?php
	// セッションの開始
	session_start();
	// どの講義が選択されたかを保存　講義選択以外から来た場合はスルー
	if(!$_SESSION['lecture']){
		$_SESSION['lecture'] = $_POST['lec'];
	}

	if($_SESSION['lecture']==""OR $_SESSION['lecture']=="講義選択"){
    header('Location: index2.php');
		exit();
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
<?php include "log.php"; ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<title>ミニッツペーパー管理システム</title>
</head>
<body>
	<script src="http//code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
	<script src="./jquery.min.js"></script>
	<script src="./bootstrap-dropdown.js"></script>

	<div class="container">
Login: <b><?php echo $_SESSION['studentid']; ?></b>
<hr>
<?php
	echo "<font size=6>" . $_SESSION['lecture'] . "のミニッツペーパー</font>";
?>
<br><hr>■メニュー<br>

<ul>
<li><a href="mine.php">自分のミニッツペーパー</a>
<li><a href="date.php">全体のミニッツペーパー</a>
<li><a href="keyserch.php">単語検索</a>
<li><a href="chart.php">提出率のグラフ</a>
<li>お問合せ・質問・改善案等 → e1q13058@st.oit.ac.jp

<?php
	if(substr($_SESSION['lecture'], 0, 1) == 't'){
		echo '<td><a href= "upload_csv.php">CSVアップロード</a></td>';
		echo '<li><a href="check.php">詳細検索</a>';
	}
?>
<br>
</ul>
<hr>
<form action="index2.php" method="POST">
<button class="btn btn-primary" type="submit">
<span class="glyphicon glyphicon-hand-left">
<font color=white> 講義選択へ戻る</font>
</button>
</form>
</div>
<br>
</body>
</html>
