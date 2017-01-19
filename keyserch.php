<?php
ini_set( 'display_errors', 1 );#エラーがある際に表示
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
	$number = $_SESSION['studentid'];
	$school_date = date('Y-m-d');
	$login_time = date('H:i:s');
	$type = "PC_keyserch";
	//go_to_login($count_student, $num, $school_date, $login_time, $type);
	go_to_menu($number, $school_date, $login_time, $type);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/main.css">
<link href="css/bootstrap.css" rel="stylesheet" media="screen">
<title>単語検索</title>
</head>
<header>
  <div id="pagebody">
    <div id="login">
      Login: <?php echo $_SESSION['studentid']; ?>
    </div>
  <div id="header">
    <h1>ミニッツペーパー閲覧システム</h1>
  </div>
  <menu>
    <ul id="menu">
			<li class="menu01"><a href="mine.php">自分のミニッツペーパー</a></li>
 			<li class="menu01"><a href="date.php">全体のミニッツペーパー</a></li>
 			<li class="menu01"><a href="keyserch.php">単語検索</a></li>
 			<li class="menu01"><a href="chart.php">提出率のグラフ</a></li>
 			<li class="menu01"><a href="index.php">講義選択画面へ</a></li>
 		</ul>
  </menu>
  </div>
</header>
<body>
<br>
■検索したい単語を入力してください。<br>
<form action="serch_keyword.php" method="POST">
<input type="text" name="keyword" value="" size="40">
<br><br>
■表示の順番を変更<br>
<input type="radio" name="sort" value="school_date" checked>講義日
<input type="radio" name="sort" value="question">質問
<br><br>
<button class="btn btn-primary" type="submit">
<span class="glyphicon glyphicon glyphicon-search"></span>
 検索する
</button>
</form>
<br><br><br>
<?php
	echo $_SESSION['lecture'] . 'のミニッツペーパー';
?>
</body>
</html>
