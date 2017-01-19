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
<title>チェック</title>
</head>
<body>
	<script src="http//code.jquery.com/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
	<script src="./jquery.min.js"></script>
	<script src="./bootstrap-dropdown.js"></script>

<div class="container">
<!--
Login: <b><?php //echo $_SESSION['studentid']; ?></b>
<hr>
-->
<?php
//	echo "<font size=6>" . $_SESSION['lecture'] . "のミニッツペーパー</font>";
?>

<?php
//	if(substr($_SESSION['lecture'], 0, 1) == 't'){
//		echo '<td><a href= "upload_csv.php">CSVアップロード</a></td>';
//		echo '<li><a href="check.php">詳細検索</a>';
//	}
?>
<br>
</button>
</form>
</div>
<br>
<?php header('Location: mine.php'); ?>
</body>
</html>
