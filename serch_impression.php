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
    $(function() {
        $(".autlink").each(function(){
            $(this).html( $(this).html().replace(/((http|https|ftp):\/\/[\w?=&.\/-;#~%-]+(?![\w\s?&.\/;#~%"=-]*>))/g, '<a href="$1">$1</a> ') );
        });
    })(jQuery);
</script>

<title>ミニッツペーパ一覧</title>
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

<?php
	// タイトル
	$cnt=0;
	echo "<div id='date_serch'>" . $id . 'のミニッツペーパ<br>' . "</div>";
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
						margin-left: -530px;
						height: 5%;"
						>
						<table width = "150px" border="1" align = "center" style = "margin-left: auto; margin-right: auto; margin-bottom: 0.5em;">
						<tr bgcolor="#8f63c2" style="color:#fff">
						<td align="center"><b>講義日一覧<b/></td>
						</tr>
						<form action="" method="GET">
HTML;

		// データベースへの問い合わせSQL文
		$sql_date = 'SELECT DISTINCT school_date FROM qanda WHERE  lecture = "' . $_SESSION['lecture'] . '" ORDER BY school_date DESC';
		//echo $sql;
		// SQL文の実行
		$query_date = mysql_query($sql_date,$conn);
		$_SESSION['$date_number'] = $query_date->school_date;
		// データの取出し
		while($row_date = mysql_fetch_object($query_date)) {
			echo '<tr bgcolor="#eeeeee">';
			echo '<td align="center"><b><a href= "serch.php?id=' . $row_date->school_date . '">' . $row_date->school_date .'</a></b></td>';
			echo '</tr>';
		}

echo<<<HTML
						</form>
						</table>
						</side>
HTML;

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
          <tr>
					<tr bgcolor="#CCCCFF">
					<th style="text-align: center;">ミニッツペーパ<br>切り替え</th>
					</tr>
					<tr>
HTML;

		switch ($num){
      case '4':
      echo '<th style="text-align: center;"><a href= "serch.php?id=' . $id . '">質問またはまとめ</a></td>';
echo<<<HTML
      </tr>
      <tr bgcolor="#EEEEFF">
      <th style="text-align: center;">感想・要望</th>
      </tr>
      </table>
      </side>
HTML;
      break;

      case '6':
      echo '<th style="text-align: center;"><a href= "serch.php?id=' . $id . '">質問またはまとめ1</a></td>';
echo<<<HTML
      </tr>
      <tr>
HTML;
      echo '<th style="text-align: center;"><a href= "serch_work_1.php?id=' . $id . '">質問またはまとめ2</a></td></tr>';
echo<<<HTML
      <tr bgcolor="#EEEEFF">
      <th style="text-align: center;">感想・要望</th>
      </tr>
      </table>
      </side>
HTML;
      break;

      case '8':
      echo '<th style="text-align: center;"><a href= "serch.php?id=' . $id . '">質問またはまとめ1</a></td>';
echo<<<HTML
      </tr>
      <tr>
HTML;
      echo '<th style="text-align: center;"><a href= "serch_work_1.php?id=' . $id . '">質問またはまとめ2</a></td></tr>';
      echo '<tr><th width ="200px" style="text-align: center;"><a href= "serch_work_2.php?id=' . $id . '">質問またはまとめ3</a></td></tr>';
echo<<<HTML
      <tr bgcolor="#EEEEFF">
      <th style="text-align: center;">感想・要望</th>
      </tr>
      </table>
      </side>
HTML;
      break;

    }

		// 空値に－を代入して見た目を綺麗に
		if(!$row->question)$row->question = '-';
		if(!$row->answer)$row->answer = '-';
		if(!$row->comment)$row->comment = '-';
		if(!$row->reply)$row->reply = '-';
		if(!$row->column1)$row->column1 = '-';
		if(!$row->column2)$row->column2 = '-';
		if(!$row->column3)$row->column3 = '-';
		if(!$row->column4)$row->column4 = '-';

		if(!$row2->question1)$row2->question1 = '-';
		if(!$row2->question2)$row2->question2 = '-';
		if(!$row2->question3)$row2->question3 = '-';
		if(!$row2->question4)$row2->question4 = '-';
		if(!$row2->question5)$row2->question5 = '-';
		if(!$row2->question6)$row2->question6 = '-';
		if(!$row2->question7)$row2->question7 = '-';
		if(!$row2->question8)$row2->question8 = '-';

		echo '<div align="center">';
		echo '<table border="1">';
		echo '<thead>';
		echo '<tr bgcolor="#CCCCFF">';
		//echo '<td width="6%">講義日</td>';
		echo '<th width="370px" style="text-align: center">質問とその回答</th>';
		echo '<th width="370px" style="text-align: center">-</th>';

		switch ($num){
			case "4":
			echo '</tr>';
			echo '<tr>';
			echo '<tr bgcolor="#CCCCFF">';
			//echo '<td width = "6%">' . $row2->school_date .'</td>';
			echo '<th width="370px">' . $row2->question3 .'</th>';
			echo '<th width="370px" style="text-align: center">' . $row2->question4 .'</th>';
			echo '</tr>';
			echo '</thead>';
			echo "</table>";
			break;

		case "5":
		echo '<td >-</td>';
		echo '</tr>';
		echo '<tr>';
		// 自分のミニッツペーパには黄色で色つけ
		//if($row->number == $_SESSION['studentid'])echo '<tr bgcolor="#FFBB77">';
		//else echo '<tr bgcolor="#CCCCFF">';
		echo '<tr bgcolor="#CCCCFF">';
		echo '<td width = "6%">' . $row2->school_date .'</td>';
		echo '<td width = "10%">' . $row2->question1 .'</td>';
		echo '<td width = "10%">' . $row2->question2 .'</td>';
		echo '<td width = "10%">' . $row2->question3 .'</td>';
		echo '<td width = "10%">' . $row2->question4 .'</td>';
		echo '<td width = "10%">' . $row2->question5 .'</td>';
		echo '</tr>';
		echo '</thead>';
		echo "</table>";
		break;

		case "6":
			echo '</tr>';
			// 自分のミニッツペーパには黄色で色つけ
			//if($row->number == $_SESSION['studentid'])echo '<tr bgcolor="#FFBB77">';
			//else echo '<tr bgcolor="#CCCCFF">';
			echo '<tr bgcolor="#CCCCFF">';
			//echo '<td width = "6%">' . $row2->school_date .'</td>';
			echo '<td width="370px">' . $row2->question5 .'</td>';
			echo '<td width="370px">' . $row2->question6 .'</td>';
			echo '</tr>';
			echo '</thead>';
			echo "</table>";
	    break;

		case "7":
                echo '<td >-</td>';
                echo '<td >-</td>';
                echo '<td >-</td>';
                echo '</tr>';
		echo '<tr>';
                // 自分のミニッツペーパには黄色で色つけ
                if($row->number == $_SESSION['studentid'])echo '<tr bgcolor="#FFBB77">';
                else echo '<tr bgcolor="#CCCCFF">';
                echo '<td width = "6%">' . $row2->school_date .'</td>';
                echo '<td width = "10%">' . $row2->question1 .'</td>';
                echo '<td width = "10%">' . $row2->question2 .'</td>';
                echo '<td width = "10%">' . $row2->question3 .'</td>';
                echo '<td width = "10%">' . $row2->question4 .'</td>';
                echo '<td width = "10%">' . $row2->question5 .'</td>';
                echo '<td width = "10%">' . $row2->question6 .'</td>';
                echo '<td width = "10%">' . $row2->question7 .'</td>';
                echo '</tr>';
					echo '</thead>';
		echo "</table>";
                break;

		case "8":
                echo '</tr>';
		echo '<tr>';
                // 自分のミニッツペーパには黄色で色つけ
                //if($row->number == $_SESSION['studentid'])echo '<tr bgcolor="#FFBB77">';
                //else echo '<tr bgcolor="#CCCCFF">';
                //echo '<td width = "6%">' . $row2->school_date .'</td>';
echo '<tr bgcolor="#CCCCFF">';
                echo '<td width="370px"><b>' . $row2->question7 .'</b></td>';
                echo '<td width="370px" style="text-align: center;"><b>' . $row2->question8 .'</b></td>';
                echo '</tr>';
					echo '</thead>';
		echo "</table>";
                break;
		}


		 //$sql3 = 'SELECT number, question, answer, comment, reply, column1, column2, column3, column4, school_date FROM qanda WHERE delete_flag!="1" AND  school_date = "' . $id . '" AND lecture = "' . $_SESSION['lecture'] . '" ORDER BY question';
		 //$sql3 = 'SELECT DISTINCT qanda.number, question, answer, comment, reply, column1, column2, column3, column4, qanda.school_date, rgb, column_color FROM qanda, color WHERE column_color = answer AND qanda.number = color.number AND qanda.school_date = color.school_date AND delete_flag!="1" AND qanda.school_date = "' . $id . '" AND lecture = "' . $_SESSION['lecture'] . '" ORDER BY rgb DESC';
		 $sql3 = 'SELECT DISTINCT qanda.number, question, answer, comment, reply, column1, column2, column3, column4, qanda.school_date, rgb, column_color FROM qanda, color WHERE column_color = answer AND qanda.number = color.number AND qanda.school_date = color.school_date AND delete_flag!="1" AND qanda.school_date = "' . $id . '" AND qanda.lecture = "' . $_SESSION['lecture'] . '" ORDER BY `color`.`rgb` DESC';
		 //$sql3 = 'SELECT DISTINCT qanda.number, question, answer, comment, reply, column1, column2, column3, column4, qanda.school_date,rgb FROM qanda, color WHERE delete_flag!="1" AND qanda.school_date = "' . $id . '" AND lecture = "' . $_SESSION['lecture'] . '" ORDER BY rgb > "000000" DESC';
		 //echo $sql3;



                // SQL文の実行
  $query3 = mysql_query($sql3, $conn);
	 while($row3=mysql_fetch_object($query3)) {
	if($row3->comment!='未回答' && $row3->comment!='未登録' && !empty($row3->comment)){

		if(!$row3->question)$row3->question = '-';
		if(!$row3->answer)$row3->answer = '-';
		if(!$row3->comment)$row3->comment = '-';
		if(!$row3->reply)$row3->reply = '-';
		if(!$row3->column1)$row3->column1 = '-';
		if(!$row3->column2)$row3->column2 = '-';
		if(!$row3->column3)$row3->column3 = '-';
		if(!$row3->column4)$row3->column4 = '-';

	$sql4 = "SELECT `question1`, `question2`, `question3`, `question4`, `question5`, `question6`, `question7`, `question8`, `school_date`, `count` FROM `question` WHERE `school_date`='{$row3->school_date}'  AND `lecture` = \"". $_SESSION['lecture'] ."\" ORDER BY `school_date`";
	$query4 = mysql_query($sql4, $conn);
	// 未回答などは非表示
	while($row4 = mysql_fetch_object($query4)){

	$sql6 = "SELECT `school_date`, `number`, `rgb`, `column_color`  FROM `color` WHERE `school_date`='{$row3->school_date}' AND `number`='{$row3->number}' AND `column_color`='{$row3->reply}'  ORDER BY `school_date`";

	$query6 = mysql_query($sql6, $conn);
	$row6 = mysql_fetch_object($query6);
	$color2=$row6->rgb;
	if($color2=='0' || $color2==NULL){
		$color2=FFFFFF;//白
	}else{
  	  $color2=dechex($color2);
  }

	$sql7 = "SELECT `school_date`, `number`, `rgb`, `column_color`  FROM `color` WHERE `school_date`='{$row3->school_date}' AND `number`='{$row3->number}' AND `column_color`='{$row3->column2}'  ORDER BY `school_date`";

	$query7 = mysql_query($sql7, $conn);
	$row7 = mysql_fetch_object($query7);
	$color3=$row7->rgb;
	if($color3=='0'|| $color3==NULL){
	  $color3=FFFFFF;//白
	}else{
	  $color3=dechex($color3);
	}

				$num = $row4->count;
			if($num <=4) $num =4;
				switch ($num){
			case "4":
      $reply = $row3->reply;
      if($reply!="-"){
				// 自分のミニッツペーパには水色で色つけ
				echo '<table border="1">';
						echo '<tbody>';
				if($row3->number == $_SESSION['studentid']){
				echo '<tr bgcolor="#EEEEFF">';
				}else{
					echo '<tr>';
				}
				//echo '<td width="6%">' . $row3->school_date .'</td>';
				echo '<td width="370px">' . nl2br($row3->comment) .'</td>';
				?>
				<td width="370px" bgcolor="<?php print $color2;?>"
        ><?php print nl2br($reply);?></td>
				<?php
				echo '</tr>';
				echo '</tbody>';
				echo "</table>";
      }
				break;

/*
			case "5":
				echo '<table border="1">';
				echo '<tbody>';
				// 自分のミニッツペーパには水色で色つけ
				if($row3->number == $_SESSION['studentid']){
					echo '<tr bgcolor="#EEEEFF">';
				}else{
					echo '<tr>';
				}
				echo '<td width="6%" >' . $row3->school_date .'</td>';
				echo '<td width="10%">' . $row3->question .'</td>';
				?>
				<td width="10%"> <?php print $row3->answer;?></td>
				<?php
				echo '<td width="10%">' . $row3->comment .'</td>';
				?>
				<td width="10%" bgcolor="<?php print $color2;?>"> <?php print $row3->reply;?></td>
				<?php
				echo '<td width="10%">' . $row3->column1 .'</td>';
				echo '</tr>';
				echo '</tbody>';
				echo "</table>";
				break;
*/
			case "6":
      	if($row3->column1!='-'){
				echo '<table border="1">';
				echo '<tbody>';
				if($row3->number == $_SESSION['studentid']){
					echo '<tr bgcolor="#EEEEFF">';
				}else{
					echo '<tr>';
				}

        echo '<td width="370px">' . nl2br($row3->column1) .'</td>';
				echo '<td width="370px">' . nl2br($row3->column2) .'</td>';
				echo '</tr>';
				echo '</tbody>';
				echo "</table>";
			break;
    }
/*
				case "7":
				echo '<table border="1">';
				echo '<tbody>';
				if($row3->number == $_SESSION['studentid']){
					echo '<tr bgcolor="#EEEEFF">';
				}else{
					echo '<tr>';
				}
				echo '<td width="6%" >' . $row3->school_date .'</td>';
                                echo '<td width="10%">' . $row3->question .'</td>';
				?>
                               <td width="10%" > <?php print $row3->answer;?></td>
				<?php
                                echo '<td width="10%">' . $row3->comment .'</td>';
				?>
                                <td width="10%" bgcolor="<?php print $color2;?>"> <?php print $row3->reply;?></td>
				<?php
                                echo '<td width="10%">' . $row3->column1 .'</td>';
                                echo '<td width="10%">' . $row3->column2 .'</td>';
				echo '<td width="10%">' . $row3->column3 .'</td>';
				echo '</tr>';
				echo '</tbody>';
				echo "</table>";
				break;
*/
				case "8":
        if($row3->column3!='-'){
				echo '<table border="1">';
				echo '<tbody>';
				if($row3->number == $_SESSION['studentid']){
					echo '<tr bgcolor="#EEEEFF">';
				}else{
					echo '<tr>';
				}
				//echo '<td width="6%" >' . $row3->school_date .'</td>';
				echo '<td width="370px" style="word-break: break-all;" class="autlink">' . nl2br($row3->column3) .'</td>';
				echo '<td width="370px" style="word-break: break-all;" class="autlink">' . nl2br($row3->column4) .'</td>';
				echo '</tr>';
				echo '</tbody>';
				echo "</table>";
				break;
      }
				}
			}

		}
	}
}
echo '</div>';
?>
<br>
<div id="pagebody">
<ul id="menu">
	<li class="menu01"><a href="mine.php">自分のミニッツペーパ</a></li>
	<li class="menu01"><a href="date.php">全体のミニッツペーパ</a></li>
	<li class="menu01"><a href="keyserch.php">単語検索</a></li>
	<li class="menu01"><a href="chart2.php">提出率のグラフ</a></li>
	<li class="menu01"><a href="index.php">講義選択画面へ</a></li>
</ul>
</div>
</body>
</html>
