 <?php
include_once '../teacher/function.php';
	// セッションの開始
	session_start();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<title>Q&A</title>
</head>

<?php
	// タイトル
	$id = $_GET['id'];//検索日
	$cnt=0;
	echo $id . 'のミニッツペーパー<br>';
	echo '<body><br><br>';

	// MySQLへの接続
	$conn = mysqli_connect("150.89.227.15", "root_mp","nakanaka","mpaper_Q13058");

	if ($conn) {
		// データベースの選択
		mysqli_select_db($conn,"mpaper_Q13058");

		$id = $_GET['id'];

		// データベースへの問い合わせSQL文
		$sql = 'SELECT number, question, answer, comment, reply, column1, column2, column3, column4, school_date FROM qanda WHERE  school_date = "' . $id . '" AND lecture = "' . $_SESSION['lecture'] . '" ORDER BY question';

		$query = mysqli_query($conn, $sql);
		$row=mysqli_fetch_object($query);

		$sql2 = "SELECT `question1`, `question2`, `question3`, `question4`, `question5`, `question6`, `question7`, `question8`, `school_date`, `count` FROM `question` WHERE `school_date`='{$row->school_date}' ORDER BY `school_date`";


		// SQL文の実行
		$query2 = mysqli_query($conn, $sql2);
		$row2=mysqli_fetch_object($query2);
		$num = $row2->count;
                if($num <=4) $num =4;

		// 空値に－を代入して見た目を綺麗に
                                if(!$row->question)$row->question = '-';
                                if(!$row->answer)$row->answer = '-';
                                if(!$row->comment)$row->comment = '-';
                                if(!$row->reply)$row->reply = '-';
                                if(!$row->column1)$row->column1 = '-';
                                if(!$row->column2)$row->column2 = '-';
                                if(!$row->column3)$row->column3 = '-';
                                if(!$row->column4)$row->column4 = '-';


		echo '<table border="1">';
                echo '<tr bgcolor="#CCCCCC">';
                echo '<td width="6%">講義日</td>';
                echo '<td >質問とその回答</td>';
                echo '<td >-</td>';
                echo '<td >-</td>';
                echo '<td >-</td>';

		switch ($num){
                case "4":
                echo '</tr>';
		echo '<tr>';
                // 自分のミニッツペーパーには黄色で色つけ
                if($row->number == $_SESSION['studentid'])echo '<tr bgcolor="yellow">';
                else echo '<tr bgcolor="#CCCCFF">';
                echo '<td width = "6%">' . $row2->school_date .'</td>';
                echo '<td width = "10%">' . $row2->question1 .'</td>';
                echo '<td width = "10%">' . $row2->question2 .'</td>';
                echo '<td width = "10%">' . $row2->question3 .'</td>';
                echo '<td width = "10%">' . $row2->question4 .'</td>';
                echo '</tr>';
		echo "</table>";
                break;

		case "5":
                echo '<td >-</td>';
                echo '</tr>';
		echo '<tr>';
                // 自分のミニッツペーパーには黄色で色つけ
                if($row->number == $_SESSION['studentid'])echo '<tr bgcolor="yellow">';
                else echo '<tr bgcolor="#CCCCFF">';
                echo '<td width = "6%">' . $row2->school_date .'</td>';
                echo '<td width = "10%">' . $row2->question1 .'</td>';
                echo '<td width = "10%">' . $row2->question2 .'</td>';
                echo '<td width = "10%">' . $row2->question3 .'</td>';
                echo '<td width = "10%">' . $row2->question4 .'</td>';
                echo '<td width = "10%">' . $row2->question5 .'</td>';
                echo '</tr>';
		echo "</table>";
		break;

		case "6":
                echo '<td >-</td>';
                echo '<td >-</td>';
                echo '</tr>';
		echo '<tr>';
                // 自分のミニッツペーパーには黄色で色つけ
                if($row->number == $_SESSION['studentid'])echo '<tr bgcolor="yellow">';
                else echo '<tr bgcolor="#CCCCFF">';
                echo '<td width = "6%">' . $row2->school_date .'</td>';
                echo '<td width = "10%">' . $row2->question1 .'</td>';
                echo '<td width = "10%">' . $row2->question2 .'</td>';
                echo '<td width = "10%">' . $row2->question3 .'</td>';
                echo '<td width = "10%">' . $row2->question4 .'</td>';
                echo '<td width = "10%">' . $row2->question5 .'</td>';
                echo '<td width = "10%">' . $row2->question6 .'</td>';
                echo '</tr>';
		echo "</table>";
                break;

		case "7":
                echo '<td >-</td>';
                echo '<td >-</td>';
                echo '<td >-</td>';
                echo '</tr>';
		echo '<tr>';
                // 自分のミニッツペーパーには黄色で色つけ
                if($row->number == $_SESSION['studentid'])echo '<tr bgcolor="yellow">';
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
		echo "</table>";
                break;

		case "8":
                echo '<td >-</td>';
                echo '<td >-</td>';
                echo '<td >-</td>';
                echo '<td >-</td>';
                echo '</tr>';
		echo '<tr>';
                // 自分のミニッツペーパーには黄色で色つけ
                if($row->number == $_SESSION['studentid'])echo '<tr bgcolor="yellow">';
                else echo '<tr bgcolor="#CCCCFF">';
                echo '<td width = "6%">' . $row2->school_date .'</td>';
                echo '<td width = "10%">' . $row2->question1 .'</td>';
                echo '<td width = "10%">' . $row2->question2 .'</td>';
                echo '<td width = "10%">' . $row2->question3 .'</td>';
                echo '<td width = "10%">' . $row2->question4 .'</td>';
                echo '<td width = "10%">' . $row2->question5 .'</td>';
                echo '<td width = "10%">' . $row2->question6 .'</td>';
                echo '<td width = "10%">' . $row2->question7 .'</td>';
                echo '<td width = "10%">' . $row2->question8 .'</td>';
                echo '</tr>';
		echo "</table>";
                break;
		}


		 $sql3 = 'SELECT number, question, answer, comment, reply, column1, column2, column3, column4, school_date FROM qanda WHERE  school_date = "' . $id . '" AND lecture = "' . $_SESSION['lecture'] . '" ORDER BY question';




                // SQL文の実行
                $query3 = mysqli_query($conn, $sql3);
	 while($row3=mysqli_fetch_object($query3)) {
			if($row3->question!='未回答' && $row3->question!='未登録' && !empty($row3->question)){

				$sql4 = "SELECT `question1`, `question2`, `question3`, `question4`, `question5`, `question6`, `question7`, `question8`, `school_date`, `count` FROM `question` WHERE `school_date`='{$row3->school_date}' ORDER BY `school_date`";
				$query4 = mysqli_query($conn, $sql4);

				// 未回答などは非表示

				while($row4 = mysqli_fetch_object($query4)){
				$num = $row4->count;
				if($num <=4) $num =4;
				switch ($num){
				case "4":
				// 自分のミニッツペーパーには黄色で色つけ
				if($row3->number == $_SESSION['studentid'])echo '<tr bgcolor="yellow">';
				echo '<table border="1">';
				echo '<tr>';
				echo '<td width="6%">' . $row3->school_date .'</td>';
				echo '<td width="10%">' . $row3->question .'</td>';
				echo '<td width="10%">' . $row3->answer .'</td>';
				echo '<td width="10%">' . $row3->comment .'</td>';
				echo '<td width="10%">' . $row3->reply .'</td>';
				echo '</tr>';
				echo "</table>";
				break;

				case "5":
				echo '<table border="1">';
				echo '<tr>';
				echo '<td width="6%" >' . $row3->school_date .'</td>';
				echo '<td width="10%">' . $row3->question .'</td>';
				echo '<td width="10%">' . $row3->answer .'</td>';
				echo '<td width="10%">' . $row3->comment .'</td>';
				echo '<td width="10%">' . $row3->reply .'</td>';
				echo '<td width="10%">' . $row3->column1 .'</td>';
				echo '</tr>';
				echo "</table>";
				break;

				case "6":
				echo '<table border="1">';
				echo '<tr>';
				echo '<td width="6%" >' . $row3->school_date .'</td>';
                                echo '<td width="10%">' . $row3->question .'</td>';
                                echo '<td width="10%">' . $row3->answer .'</td>';
                                echo '<td width="10%">' . $row3->comment .'</td>';
                                echo '<td width="10%">' . $row3->reply .'</td>';
                                echo '<td width="10%">' . $row3->column1 .'</td>';
				echo '<td width="10%">' . $row3->column2 .'</td>';
				echo '</tr>';
				echo "</table>";
				break;

				case "7":
				echo '<table border="1">';
				echo '<tr>';
				echo '<td width="6%" >' . $row3->school_date .'</td>';
                                echo '<td width="10%">' . $row3->question .'</td>';
                                echo '<td width="10%">' . $row3->answer .'</td>';
                                echo '<td width="10%">' . $row3->comment .'</td>';
                                echo '<td width="10%">' . $row3->reply .'</td>';
                                echo '<td width="10%">' . $row3->column1 .'</td>';
                                echo '<td width="10%">' . $row3->column2 .'</td>';
				echo '<td width="10%">' . $row3->column3 .'</td>';
				echo '</tr>';
				echo "</table>";
				break;

				case "8":
				echo '<table border="1">';
				echo '<tr>';
				echo '<td width="6%" >' . $row3->school_date .'</td>';
                                echo '<td width="10%">' . $row3->question .'</td>';
                                echo '<td width="10%">' . $row3->answer .'</td>';
                                echo '<td width="10%">' . $row3->comment .'</td>';
                                echo '<td width="10%">' . $row3->reply .'</td>';
                                echo '<td width="10%">' . $row3->column1 .'</td>';
                                echo '<td width="10%">' . $row3->column2 .'</td>';
                                echo '<td width="10%">' . $row3->column3 .'</td>';
				echo '<td width="10%">' . $row3->column4 .'</td>';
				echo '</tr>';
				echo "</table>";
				break;
				}
			}

		}
	}
}

?>
<br>
<li><a href="top.php">メニューへ戻る</a>
<br><br>
<?php
	echo $_SESSION['lecture'] . 'のミニッツペーパー';
?>
</body>
</html>
