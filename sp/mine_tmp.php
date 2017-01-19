	<?php
	include_once '../teacher/function.php';
	// セッションの開始
	session_start();

	// ログインチェック
	if(!$_SESSION['studentid']){
		// ログインフォーム画面へ
		header('Location: login.php');
		// 終了
		exit();
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <link rel="stylesheet" href="sample.css">
<title>Q&A</title>
</head>
<?php
	// タイトルの表示
	$id = $_SESSION['studentid'];
	
?>
<body>
 <div id="pagebody">

	<!-- ヘッダ -->
	<div id="header"><h1>ミニッツペーパシステム</h1></div>
	<ul id="menu">
		<li id="menu01"><a href="top.php">トップ画面</a></li>
		<li id="menu01"><a href="date.php">講義日から探す</a></li>
		<li id="menu01"><a href="keyserch.php">単語検索</a></li>
		<li id="menu01"><a href="chart.php">提出率のグラフ</a></li>
		
		
		
	</ul>

</div>
<br><br>

	<?php
	// MySQLへの接続
	$conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);
	$num =0;
	$cnt2=0;
	$flag4=0;
	$flag5=0;
	$flag6=0;
	$flag7=0;
	$flag8=0;
	if ($conn) {
		// データベースの選択
		mysql_select_db(DATABASE,$conn);

		$id = $_SESSION['studentid'];
		$lec = $_SESSION['lecture'];
		// データベースへの問い合わせSQL文
		$sql = "SELECT `num`, `number`, `question`, `answer`, `comment`, `reply`, `column1`, `column2`, `column3`, `column4`,`school_date`,`present` FROM `qanda` WHERE `number`='{$id}' AND `lecture`='{$lec}' ORDER BY `num`, `school_date`";
		//$sql = 'SELECT * FROM `qanda` WHERE 1';
		// SQL文の実行
		$query = mysql_query($sql, $conn);

		echo "<font size=6>" . $id. "のミニッツペーパー</font>";
                echo "<br>";

		 $sql3 = "SELECT COUNT(*) as cnt FROM qanda WHERE present='1' AND number='{$id}'";
                $query3 = mysql_query($sql3, $conn);
                $row3 = mysql_fetch_object($query3);
                $cnt=0;
                if($row3->cnt>0){
                $cnt=$row3->cnt;
                }
		echo '<font size=6> 総提出回数　'.$cnt.'/13</font>';
                echo "<br>";
		// データの取出し
		while($row=mysql_fetch_object($query)) {

			//空値に－を代入して見た目を綺麗に
			if(!$row->question)$row->question = '-';
			if(!$row->answer)$row->answer = '-';
			if(!$row->comment)$row->comment = '-';
			if(!$row->reply)$row->reply = '-';
			if(!$row->column1)$row->column1 = '-';
			if(!$row->column2)$row->column2 = '-';
			if(!$row->column3)$row->column3 = '-';
			if(!$row->column4)$row->column4 = '-';

		$sql2 = "SELECT `question1`, `question2`, `question3`, `question4`, `question5`, `question6`, `question7`, `question8`, `school_date`, `count` FROM `question` WHERE `school_date`='{$row->school_date}' ORDER BY `count`,`school_date`";
		$query2 = mysql_query($sql2, $conn);


	
			while($row2 = mysql_fetch_object($query2)){
			$num = $row2->count;
			if($num ==0){
			 $num =4;
			}
				
				switch ($num){
				case "4":
				if($flag4==0){
				echo '<table  border="1" align="center">';
                		echo '<tr bgcolor="#CCCCCC">';
                		echo '<td width="80" align="center" >講義日</td>';
                		echo '<td width="500" align="center">質問とその回答</td>';
                		echo '<td width="300">-</td>';
                		echo '<td width="200">-</td>';
                		echo '<td width="100">-</td>';
				echo '</tr>';
                		echo '<tr>';
                		echo '<tr bgcolor="#CCCCFF">';
                		echo '<td width="80">' . $row2->school_date .'</td>';
                		echo '<td width="300">' . $row2->question1 .'</td>';
                		echo '<td width="300" align="center">' . $row2->question2 .'</td>';
                		echo '<td width="100">' . $row2->question3 .'</td>';
                		echo '<td width="100">' . $row2->question4 .'</td>';
                		echo '</tr>';
                		echo "</table>";
				$flag4=$flag4+1;
				}
				echo '<table border="1" align="center">';
				echo '<tr>';
				echo '<td width="80">' . $row->school_date .'</td>';
				echo '<td width="500">' . $row->question .'</td>';
				echo '<td width="300">' . $row->answer .'</td>';
				echo '<td width="200">' . $row->comment .'</td>';
				echo '<td width="100">' . $row->reply .'</td>';
				echo '</tr>';
				echo "</table>";
				break;

				case "5":
				if($flag5==0){
				echo "<br>";
                		echo '<table  border="1" align="center">';
                		echo '<tr bgcolor="#CCCCCC">';
                		echo '<td width="80" align="center" >講義日</td>';
                		echo '<td width="500" align="center">質問とその回答</td>';
                		echo '<td width="300">-</td>';
                		echo '<td width="200">-</td>';
                		echo '<td width="100">-</td>';
			        echo '<td width="100" >-</td>';
                		echo '</tr>';
                		echo '<tr>';
                		echo '<tr bgcolor="#CCCCFF">';
                		echo '<td width="80">' . $row2->school_date .'</td>';
                		echo '<td width="500">' . $row2->question1 .'</td>';
                		echo '<td width="300">' . $row2->question2 .'</td>';
                		echo '<td width="200">' . $row2->question3 .'</td>';
                		echo '<td width="100">' . $row2->question4 .'</td>';
                		echo '<td width="100">' . $row2->question5 .'</td>';
                		echo '</tr>';
                		echo "</table>";
				$flag5=$flag5+1;
				}
				echo '<table border="1" align="center">';
				echo '<tr>';
				echo '<td width="80" >' . $row->school_date .'</td>';
				echo '<td width="500">' . $row->question .'</td>';
				echo '<td width="300">' . $row->answer .'</td>';
				echo '<td width="200">' . $row->comment .'</td>';
				echo '<td width="100">' . $row->reply .'</td>';
				echo '<td width="100">' . $row->column1 .'</td>';
				echo '</tr>';
				echo "</table>";
				break;

				case "6":

				if($flag6==0){
                		echo '<table  border="1" align="center">';
                		echo '<tr bgcolor="#CCCCCC">';
                		echo '<td width="80" align="center" >講義日</td>';
                		echo '<td width="500" align="center">質問とその回答</td>';
                		echo '<td width="300">-</td>';
                		echo '<td width="200">-</td>';
                		echo '<td width="100">-</td>';
				echo '<td >-</td>';
                		echo '<td >-</td>';
                		echo '</tr>';
                		echo '<tr>';
                		echo '<tr bgcolor="#CCCCFF">';
                		echo '<td>' . $row2->school_date .'</td>';
                		echo '<td>' . $row2->question1 .'</td>';
                		echo '<td>' . $row2->question2 .'</td>';
                		echo '<td>' . $row2->question3 .'</td>';
                		echo '<td>' . $row2->question4 .'</td>';
                		echo '<td>' . $row2->question5 .'</td>';
                		echo '<td>' . $row2->question6 .'</td>';
                		echo '</tr>';
                		echo "</table>";
				$flag6=$flag6+1;
				}	
				echo '<table border="1" align="center">';
				echo '<tr>';
				echo '<td>' . $row->school_date .'</td>';
				echo '<td>' . $row->question .'</td>';
				echo '<td>' . $row->answer .'</td>';
				echo '<td>' . $row->comment .'</td>';
				echo '<td>' . $row->reply .'</td>';
				echo '<td>' . $row->column1 .'</td>';
				echo '<td>' . $row->column2 .'</td>';
				echo '</tr>';
				echo "</table>";
				break;

				case "7":

				if($flag7==0){
                		echo '<table  border="1" align="center">';
                		echo '<tr bgcolor="#CCCCCC">';
                		echo '<td width="80" align="center" >講義日</td>';
                		echo '<td width="500" align="center">質問とその回答</td>';
                		echo '<td width="300">-</td>';
                		echo '<td width="200">-</td>';
                		echo '<td width="100">-</td>';
				echo '<td >-</td>';
                		echo '<td >-</td>';
                		echo '<td >-</td>';
                		echo '</tr>';
                		echo '<tr>';
                		echo '<tr bgcolor="#CCCCFF">';
                		echo '<td>' . $row2->school_date .'</td>';
                		echo '<td>' . $row2->question1 .'</td>';
                		echo '<td>' . $row2->question2 .'</td>';
                		echo '<td>' . $row2->question3 .'</td>';
                		echo '<td>' . $row2->question4 .'</td>';
                		echo '<td>' . $row2->question5 .'</td>';
                		echo '<td>' . $row2->question6 .'</td>';
                		echo '<td>' . $row2->question7 .'</td>';
                		echo '</tr>';
                		echo "</table>";
				$flag7=$flag7+1;
				}

				echo '<table border="1" align="center">';
				echo '<tr>';
				echo '<td>' . $row->school_date .'</td>';
				echo '<td>' . $row->question .'</td>';
				echo '<td>' . $row->answer .'</td>';
				echo '<td>' . $row->comment .'</td>';
				echo '<td>' . $row->reply .'</td>';
				echo '<td>' . $row->column1 .'</td>';
				echo '<td>' . $row->column2 .'</td>';
				echo '<td>' . $row->column3 .'</td>';
				echo '</tr>';
				echo "</table>";
				break;

				case "8":

				if($flag8==0){
                		echo '<table  border="1" align="center">';
                		echo '<tr bgcolor="#CCCCCC">';
                		echo '<td width="80" align="center" >講義日</td>';
                		echo '<td width="500" align="center">質問とその回答</td>';
                		echo '<td width="300">-</td>';
                		echo '<td width="200">-</td>';
                		echo '<td width="100">-</td>';
				echo '<td >-</td>';
                		echo '<td >-</td>';
                		echo '<td >-</td>';
                		echo '<td >-</td>';
                		echo '</tr>';
                		echo '<tr>';
                		echo '<tr bgcolor="#CCCCFF">';
                		echo '<td>' . $row2->school_date .'</td>';
                		echo '<td>' . $row2->question1 .'</td>';
                		echo '<td>' . $row2->question2 .'</td>';
                		echo '<td>' . $row2->question3 .'</td>';
                		echo '<td>' . $row2->question4 .'</td>';
                		echo '<td>' . $row2->question5 .'</td>';
                		echo '<td>' . $row2->question6 .'</td>';
                		echo '<td>' . $row2->question7 .'</td>';
                		echo '<td>' . $row2->question8 .'</td>';
                		echo '</tr>';
                		echo "</table>";
				$flag8=$flag8+1;
                                }

				echo '<table border="1" align="center">';
				echo '<tr>';
				echo '<td>' . $row->school_date .'</td>';
				echo '<td>' . $row->question .'</td>';
				echo '<td>' . $row->answer .'</td>';
				echo '<td>' . $row->comment .'</td>';
				echo '<td>' . $row->reply .'</td>';
				echo '<td>' . $row->column1 .'</td>';
				echo '<td>' . $row->column2 .'</td>';
				echo '<td>' . $row->column3 .'</td>';
				echo '<td>' . $row->column4 .'</td>';
				echo '</tr>';
				echo "</table>";
				break;
				}
			}
		}
	
}
?>

<br>
<li><a href="top.php">メニューへ戻る</a>
<br><br>
</body>
</html>
