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
<title>Search</title>
</head>
<?php

$_SESSION['student_no']= $_POST['search_no'];
	

echo "<font size=6>" . $_SESSION['student_no']. "のミニッツペーパー</font>";
?>
<body>

<br><br>

<?php
	echo '<table border="1">';
	echo '<tr bgcolor="#CCCCCC">';
	echo '<td width="6%">講義日</td>';
	echo '<td width="20%">質問</td>';
	echo '<td width="18%">回答</td>';
	echo '<td width="20%">コメント</td>';
	echo '<td width="18%">返答</td>';
	echo '</tr>';

	// MySQLへの接続
	$conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);

	if ($conn) {
		// データベースの選択
		$db_selected = mysql_select_db(DATABASE, $conn);

		$id = $_SESSION['student_no'];
		$lec = $_SESSION['lecture'];
		// データベースへの問い合わせSQL文
		$sql = "SELECT `number`, `question`, `answer`, `comment`, `reply`, `school_date` FROM `qanda` WHERE   `delete_flag`!='1' AND `number`='{$id}' AND `lecture`='{$lec}' ORDER BY `school_date`";
		//$sql = 'SELECT * FROM `qanda` WHERE 1';
		// SQL文の実行
		$query = mysql_query($sql, $conn);
		

	// データの取出し
		while($row=mysql_fetch_object($query)) {
		/*	//空値に－を代入して見た目を綺麗に
			if(!$row->question)$row->question = '-';
			if(!$row->answer)$row->answer = '-';
			if(!$row->comment)$row->comment = '-';
			if(!$row->reply)$row->reply = '-'; */
			echo '<tr>';
			echo '<td>' . $row->school_date .'</td>';
			echo '<td>' . $row->question .'</td>';
			echo '<td>' . $row->answer .'</td>';
			echo '<td>' . $row->comment .'</td>';
			echo '<td>' . $row->reply .'</td>';
			echo '</tr>';
		} 
	}
?>
</table>
<br>
<li><a href="top.php">メニューへ戻る</a>
<br><br>
<?php
	echo $_SESSION['lecture'] . 'のミニッツペーパー';
?>
</body>
</html>
