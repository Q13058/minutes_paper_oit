<?php
include_once './teacher/function.php';
	// セッションの開始
	session_start();

	// ログインチェック
	if(!$_SESSION['studentid']){
		// ログインフォーム画面へ
		header('Location: login.php');
		// 終了
		exit();
	}
	$num = $_SESSION['studentid'];
	$school_date = date('Y-m-d');
	$login_time = date('H:i:s');
	$type = "PC_date";
	//go_to_login($count_student, $num, $school_date, $login_time, $type);
	go_to_menu($num, $school_date, $login_time, $type);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/main.css">
<link href="css/bootstrap.css" rel="stylesheet" media="screen">
<title>講義日から検索</title>
</head>
<header>
  <div id="pagebody">
    <div id="login">
      Login: <?php echo $_SESSION['studentid']; ?>
    </div>
  <div id="header">
    <h1>ミニッツペーパ閲覧システム</h1>
  </div>
  <menu>
    <ul id="menu">
			<li class="menu01"><a href="mine.php">自分のミニッツペーパ</a></li>
 			<li class="menu01"><a href="date.php">全体のミニッツペーパ</a></li>
 			<li class="menu01"><a href="keyserch.php">単語検索</a></li>
 			<li class="menu01"><a href="chart.php">提出率のグラフ</a></li>
 			<li class="menu01"><a href="index.php">講義選択画面へ</a></li>
 		</ul>
  </menu>
  	</div>
</header>
<body>
 <br>
<table border="1" align = "center" style = "margin-left: auto; margin-right: auto; margin-bottom: 0.5em;">
<tr bgcolor="#8f63c2" style="color:#fff">
<td width = "300px" align="center"><b>講義日一覧<b/></td>
</tr>
<form action="" method="GET">
<?php

	// MySQLへの接続
	$conn = mysqli_connect(IPADDRESS, USERNAME, USERPASSWORD, DATABASE);

	if ($conn) {
		// データベースの選択
		$db_selected = mysqli_select_db($conn, DATABASE);

		// データベースへの問い合わせSQL文
		$sql = 'SELECT DISTINCT school_date FROM qanda WHERE  lecture = "' . $_SESSION['lecture'] . '" ORDER BY school_date DESC';
		//echo $sql;
		// SQL文の実行
		$query = mysqli_query($conn,$sql);
		$_SESSION['$date_number'] = $query->school_date;
		// データの取出し
		while($row = mysqli_fetch_object($query)) {
			echo '<tr bgcolor="#eeeeee">';
			echo '<td align="center"><b><a href= "serch.php?id=' . $row->school_date . '">' . $row->school_date .'</a></b></td>';
			echo '</tr>';
		}
	}
?>
</form>
</table>
<br>
<?php
	echo $_SESSION['lecture'] . 'のミニッツペーパ';
?>
</body>
</html>
