<?php
session_cache_limiter('private_no_expire');
	session_start();
	// セッションの開始
	$_SESSION['mseg'] = "";
	$_SESSION['mseg_safe'] = "";
	if($_SESSION['lecture'] == NULL){
		$_SESSION['lecture'] = $_POST['lec'];
	}

   	if(!$_SESSION['userid']){
 		header('Location: ./login.php');
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
<title>ミニッツペーパーの編集</title>
</head>
<body>
	<div id="login" style="font-size: 15px;">
		Login: <?php echo $_SESSION['userid']; ?> さん
	</div>
	<div id="menu">ミニッツぺーパーの編集</div>
	<div class="container">
<?php
	echo "<font size=5>◆" . $_SESSION['lecture'] . "のミニッツペーパー</font>";
?>
<br>■メニュー<br>
<ul>
<li>
<form action="file_upload.php" method="post" enctype="multipart/form-data">
　<button class="btn btn-success btn-outline" style="font-size: 20px; position: relative; left: 0px; top: 8px; padding: 3px 60px; text-align:center"><b>Excelファイルをアップロード</b></button>
</form>
<li>
	<form action="file_delete.php" method="post" enctype="multipart/form-data">
	　<button class="btn btn-success btn-outline" style="font-size: 20px; position: relative; left: 0px; top: 8px; padding: 3px 57px; text-align:center"><b>アップロードしたデータの削除</button>
	</form>
<li>
	<!--
	<form action="chartsearch.php" method="post" enctype="multipart/form-data">
	　<button class="btn btn-success btn-outline" style="font-size: 20px; position: relative; left: 0px; top: 8px; padding: 3px 57px; text-align:center"><b>学生番号から提出グラフを検索</button>
	</form>

<li>
	<form action="studentdata_date.php" method="post" enctype="multipart/form-data">
	　<button class="btn btn-success btn-outline" style="font-size: 20px; position: relative; left: 0px; top: 8px; padding: 3px 142px; text-align:center"><b>講義日から検索</button>
	</form>
<li>
<li>
	<form action="all_submit.php" method="post" enctype="multipart/form-data">
	　<button class="btn btn-success btn-outline" style="font-size: 20px; position: relative; left: 0px; top: 8px; padding: 3px 130px; text-align:center"><b>全学生の提出回数</button>
	</form>
-->
<form action="all_student.php" method="post" enctype="multipart/form-data">
　<button class="btn btn-success btn-outline" style="font-size: 20px; position: relative; left: 0px; top: 8px; padding: 3px 45px; text-align:center"><b>学生全員のミニッツペーパー一覧</button>
</form>
<li>
	<form action="delete_graduate.php" method="post" enctype="multipart/form-data">
	　<button class="btn btn-success btn-outline" style="font-size: 20px; position: relative; left: 0px; top: 8px; padding: 3px 130px; text-align:center"><b>学生データの削除</button>
	</form>
<li>
	<form action="insert.php" method="post" enctype="multipart/form-data">
	　<button class="btn btn-success btn-outline" style="font-size: 20px; position: relative; left: 0px; top: 8px; padding: 3px 82px; text-align:center"><b>削除した学生データの復元</button>
	</form>
</ul>

<form action="index.php" method="post" enctype="multipart/form-data">
	<button class="btn btn-primary" style="font-size: 20px; position: relative; left: 0px; top: 8px; padding: 7px 80px; text-align:center">メニュー画面に戻る</button>
</form>
</form>
</div>
</body>
</html>
