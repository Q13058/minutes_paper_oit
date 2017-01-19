<?php
include_once './teacher/function.php';
include_once './serch_log.php';
	// セッションの開始
	session_start();

	// ログインチェック
	if(!$_SESSION['studentid']){
		// ログインフォーム画面へ
		header('Location: login.php');
		// 終了
		exit();
	}
	$id = $_GET['id'];//検索日
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/main.css">
<link href="css/bootstrap.css" rel="stylesheet" media="screen">
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/cel-variable/store.js"></script>
<script src="js/cel-variable/jquery.resizableColumns.js"></script>
<script type="text/javascript"> /*実行コード*/
/*
$(function(){
  $("table").resizableColumns({
    store: window.store
  });
});
*/
		//htmlのリンクをセル上でクリックできるようになる
    $(function() {
        $(".autlink").each(function(){
            $(this).html( $(this).html().replace(/((http|https|ftp):\/\/[\w?=&.\/-;#~%-]+(?![\w\s?&.\/;#~%"=-]*>))/g, '<a href="$1">$1</a> ') );
        });
    })(jQuery);
</script>

<title>ミニッツペーパー一覧</title>
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

<?php
	// タイトル
	$cnt=0;
	echo "<div id='date_serch'>" . $id . 'のミニッツペーパー<br>' . "</div>";
	echo '<br><br>';

	// MySQLへの接続
	$conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);

	if ($conn) {
		// データベースの選択
		mysql_select_db(DATABASE,$conn);

		$id = $_GET['id'];

		// データベースへの問い合わせSQL文
		//$sql = 'SELECT number, question, answer, comment, reply, column1, column2, column3, column4, school_date FROM qanda WHERE delete_flag!="1" AND school_date = "' . $id . '" AND lecture = "' . $_SESSION['lecture'] . '" ORDER BY question';
		$sql = 'SELECT DISTINCT qanda.number, question, answer, comment, reply, column1, column2, column3, column4, qanda.school_date, rgb FROM qanda, color WHERE qanda.number = color.number AND qanda.school_date = color.school_date AND delete_flag!="1" AND qanda.school_date = "' . $id . '" AND qanda.lecture = "' . $_SESSION['lecture'] . '" ORDER BY rgb DESC';
		//echo $sql."<br>";
		//SELECT number, question, answer, comment, reply, column1, column2, column3, column4, school_date FROM qanda WHERE delete_flag!="1" AND school_date = "2016-10-08" AND lecture = "プログラミング言語論" ORDER BY question
		//$sql = 'SELECT qanda.number, question, answer, comment, reply, column1, column2, column3, column4, qanda.school_date FROM qanda, color WHERE delete_flag!="1" AND qanda.school_date = "2016-10-08" AND lecture = "プログラミング言語論" ORDER BY rgb DESC';
		$query = mysql_query($sql, $conn);
		$row=mysql_fetch_object($query);

		$sql2 = "SELECT `question1`, `question2`, `question3`, `question4`, `question5`, `question6`, `question7`, `question8`, `school_date`, `count` FROM `question` WHERE `school_date`='{$row->school_date}' ORDER BY `school_date`";
		//echo $sql2;

		// SQL文の実行


		$query2 = mysql_query($sql2, $conn);
		$row2=mysql_fetch_object($query2);
		$num = $row2->count;
    if($num <=4) $num =4;

echo<<<HTML
		<side
		style=
		"background: #FFFFFF;
		position: fixed;
		width: 100px;
		margin: 0 auto;
		padding: 0px 0 0 0;
		line-height: 1;
		z-index: 999;
		margin-left: 380px; //これ神
		height: 5%;"
		>
		<table border="1" width = "150px">
		<tr bgcolor="#CCCCFF">
		<th style="text-align: center;">ミニッツペーパー<br>切り替え</th>
		</tr>
HTML;


		switch ($num){
			case '4':

echo<<<HTML
		<tr bgcolor="#EEEEFF">
		<th style="text-align: center;">質問またはまとめ</th>
		</tr>
		<tr>
HTML;
echo '<th style="text-align: center;"><a href= "serch_impression.php?id=' . $id . '">感想・要望</a></td>';

echo<<<HTML
		</tr>
		</table>
		</side>
HTML;
break;

case '6':
echo '<th style="text-align: center;" bgcolor="#EEEEFF">質問またはまとめ1</td>';
echo<<<HTML
</tr>
<tr>
HTML;
echo '<th style="text-align: center;"><a href= "serch_work_1.php?id=' . $id . '">質問またはまとめ2</a></td></tr>';
echo<<<HTML
<tr>
HTML;
echo '<th style="text-align: center;"><a href= "serch_impression.php?id=' . $id . '">感想・要望</a></th>';
echo<<<HTML
</tr>
</table>
</side>
HTML;
break;

		case '8':
		echo '<th style="text-align: center;" bgcolor="#EEEEFF">質問またはまとめ1</td>';
echo<<<HTML
		</tr>
		<tr>
HTML;
		echo '<th style="text-align: center;"><a href= "serch_work_1.php?id=' . $id . '">質問またはまとめ2</a></td></tr>';
		echo '<tr><th style="text-align: center;"><a href= "serch_work_2.php?id=' . $id . '">質問またはまとめ3</a></td></tr>';
echo<<<HTML
		<tr>
HTML;
		echo '<th style="text-align: center;"><a href= "serch_impression.php?id=' . $id . '">感想・要望</a></th>';
echo<<<HTML
		</tr>
		</table>
		</side>
HTML;
		break;
}

		// 空値に－を代入して見た目を綺麗に
		if(!$row->question)$row->question = '-';
		if(!$row->answer)$row->answer = '-';
		if(!$row2->question1)$row2->question1 = '-';
		if(!$row2->question2)$row2->question2 = '-';

		echo '<div align="center">';
		echo '<table border="1">';
		echo '<thead>';
		echo '<tr bgcolor="#CCCCFF">';
		//echo '<td width="6%">講義日</td>';
		echo '<th width="370px" style="text-align: center;">質問とその回答</th>';
		echo '<th width="370px" style="text-align: center;">-</th>';

			echo '</tr>';
			echo '<tr>';
			echo '<tr bgcolor="#CCCCFF">';
			//echo '<td width = "6%">' . $row2->school_date .'</td>';
			echo '<th width = "370px">' . $row2->question1 .'</th>';
			echo '<th width = "370px" style="text-align: center;">' . $row2->question2 .'</th>';
			echo '</tr>';
			echo '</thead>';
			echo "</table>";



		 //$sql3 = 'SELECT number, question, answer, comment, reply, column1, column2, column3, column4, school_date FROM qanda WHERE delete_flag!="1" AND  school_date = "' . $id . '" AND lecture = "' . $_SESSION['lecture'] . '" ORDER BY question';
		 //$sql3 = 'SELECT DISTINCT qanda.number, question, answer, comment, reply, column1, column2, column3, column4, qanda.school_date, rgb, column_color FROM qanda, color WHERE column_color = answer AND qanda.number = color.number AND qanda.school_date = color.school_date AND delete_flag!="1" AND qanda.school_date = "' . $id . '" AND lecture = "' . $_SESSION['lecture'] . '" ORDER BY rgb DESC';
		 //$sql3 = 'SELECT DISTINCT qanda.number, question, answer, comment, reply, column1, column2, column3, column4, qanda.school_date, rgb, column_color FROM qanda, color WHERE column_color = answer AND qanda.number = color.number AND qanda.school_date = color.school_date AND delete_flag!="1" AND qanda.school_date = "' . $id . '" AND qanda.lecture = "' . $_SESSION['lecture'] . '" ORDER BY `color`.`rgb` DESC';
		 //$sql3 = 'SELECT DISTINCT qanda.number, question, answer, comment, reply, column1, column2, column3, column4, qanda.school_date,rgb FROM qanda, color WHERE delete_flag!="1" AND qanda.school_date = "' . $id . '" AND lecture = "' . $_SESSION['lecture'] . '" ORDER BY rgb > "000000" DESC';
		 $sql3 = 'SELECT DISTINCT qanda.number, question, answer, comment, reply, column1, column2, column3, column4, qanda.school_date, rgb FROM qanda, color WHERE qanda.number = color.number AND qanda.school_date = color.school_date AND delete_flag!="1" AND qanda.school_date = "' . $id . '" AND qanda.lecture = "' . $_SESSION['lecture'] . '" AND color.lecture = "' . $_SESSION['lecture'] . '" ORDER BY rgb DESC';
		 //echo "<br>".$sql3;



  // SQL文の実行
  	$query3 = mysql_query($sql3, $conn);
			echo '<table border="1">';
	 while($row3=mysql_fetch_object($query3)) {
		if($row3->question!='未回答' && $row3->question!='未登録' && !empty($row3->question)){

		if(!$row3->question)$row3->question = '-';
		if(!$row3->answer)$row3->answer = '-';
		if(!$row3->comment)$row3->comment = '-';
		if(!$row3->reply)$row3->reply = '-';
		if(!$row3->column1)$row3->column1 = '-';
		if(!$row3->column2)$row3->column2 = '-';
		if(!$row3->column3)$row3->column3 = '-';
		if(!$row3->column4)$row3->column4 = '-';

	$sql4 = "SELECT DISTINCT id,`question1`, `question2`, `question3`, `question4`, `question5`, `question6`, `question7`, `question8`, `school_date`, `count` , `lecture` FROM `question` WHERE `school_date`='{$row3->school_date}' AND `lecture` = \"". $_SESSION['lecture'] ."\" ORDER BY `school_date`";
	//echo "<br><br><br><br><br>".$sql4;
	$query4 = mysql_query($sql4, $conn);
	// 未回答などは非表示
		while($row4 = mysql_fetch_object($query4)){

			$sql5 = "SELECT DISTINCT number ,`school_date`, `rgb`, `column_color`  FROM `color` WHERE `school_date`='{$row3->school_date}' AND `number`='{$row3->number}' AND `column_color`='{$row3->answer}'  ORDER BY `school_date`";
			//SELECT `school_date`, `number`, `rgb`, `column_color` FROM `color` WHERE `school_date`='2016-10-11' AND `number`='N14010' AND `column_color`='命令のフェッチだけでなく、データの読み書きもあります。' ORDER BY `school_date`
			//echo "<br>".$sql5."<br>";
		  $query5 = mysql_query($sql5, $conn);
		  $row5 = mysql_fetch_object($query5);
		  $color=$row5->rgb;
			//echo "color=> ".$color. "<br>";
		  if($color=='0' || $color==NULL){
		  	$color=FFFFFF;//白
		  }else{
		  	$color=dechex($color);
		  }

			$num = $row4->count;
			if($num <=4) $num =4;

			// 自分のミニッツペーパーには水色で色つけ
				echo '<tbody>';
			if($row3->number == $_SESSION['studentid']){
				echo '<tr bgcolor="#EEEEFF">';
			}else{
				echo '<tr>';
			}
			//echo '<td width="6%">' . $row3->school_date .'</td>';
				echo '<td width="370px">' . nl2br($row3->question) .'</td>';
			?>
			<td width="370px" bgcolor="<?php print $color;?>" ><?php print nl2br($row3->answer);?></td>
			<?php
			echo '</tr>';
			echo '</tbody>';
		}
	}
}
	echo "</table>";
}
echo '</div>';
?>
<br>
<div id="pagebody">
<ul id="menu">
	<li class="menu01"><a href="mine.php">自分のミニッツペーパー</a></li>
	<li class="menu01"><a href="date.php">全体のミニッツペーパー</a></li>
	<li class="menu01"><a href="keyserch.php">単語検索</a></li>
	<li class="menu01"><a href="chart2.php">提出率のグラフ</a></li>
	<li class="menu01"><a href="index.php">講義選択画面へ</a></li>
</ul>
</div>
</body>
</html>
