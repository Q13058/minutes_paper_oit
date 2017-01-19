<?php

include_once '../teacher/function.php';
include_once './mine_log.php';
// セッションの開始
session_start();
// ログインチェック
if(!$_SESSION['studentid']){
	// ログインフォーム画面へ
	header('Location: ../login.php');
	// 終了
	exit();
}
$number = $_SESSION['studentid'];
$school_date = date('Y-m-d');
$login_time = date('H:i:s');
$type = "SP_mine";
//go_to_login($count_student, $num, $school_date, $login_time, $type);
go_to_menu($number, $school_date, $login_time, $type);

$user_csv = dirname(__FILE__) . "/../teacher/user_data/" . $_SESSION['studentid']. ".csv";
if (file_exists($user_csv)) {
	header('Location: ./mine_master.php');
}
?>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
<title>ミニッツペーパー閲覧システム</title>
<link rel="stylesheet" href="css/style.css">
</head>
<?php
	// タイトルの表示
	$id = $_SESSION['studentid'];
echo "<h1><font size=5>" . $id. "のミニッツペーパー</font></h1>";
?>
<body>


<?php

	// MySQLへの接続
	$conn = mysqli_connect(IPADDRESS, USERNAME, USERPASSWORD, DATABASE);

	if ($conn) {
		// データベースの選択
		mysqli_select_db($conn, DATABASE);

		$id = $number;
		$lec = $_SESSION['lecture'];
		// データベースへの問い合わせSQL文
		$sql = "SELECT `number`, `question`, `answer`, `comment`, `reply`, `column1`, `column2`, `column3`, `column4`,`school_date` FROM `qanda` WHERE `delete_flag`!='1' AND  `number`='{$id}' AND `lecture`='{$lec}' ORDER BY school_date DESC";
		//$sql = "SELECT `number`, `question`, `answer`, `comment`, `reply`, `column1`, `column2`, `column3`, `column4`,`school_date` FROM `qanda` WHERE `delete_flag`!='1' AND  `number`='{$id}' AND `lecture`='{$lec}' ORDER BY `school_date`";
		//$sql = 'SELECT * FROM `qanda` WHERE 1';
		// SQL文の実行
		$query = mysqli_query($conn, $sql);

		$sql3 = "SELECT COUNT(*) as cnt FROM qanda WHERE `delete_flag`!='1' AND  present='1' AND number='{$id}' AND `lecture`='{$lec}'";
		$sql4 = "SELECT COUNT(DISTINCT `school_date`) as lec_num FROM `qanda`";
		$query3 = mysqli_query($conn, $sql3);
		$row3 = mysqli_fetch_object($query3);
		$cnt=0;
		if($row3->cnt>0){
		$cnt=$row3->cnt;
		}
		 $query4 = mysqli_query($conn, $sql4);
		$row4 = mysqli_fetch_object($query4);
		$lec_num=$row4->lec_num;
		$ave=($cnt/$lec_num)*100;
		$ave =round($ave);
		$i=0;
		 echo '<p size="6" align="center" style="color:#ff0000;"> 総提出率　'.$ave.' %</p>';
	// データの取出し
		while($row=mysqli_fetch_object($query)) {

		//空値に－を代入して見た目を綺麗に
		if(!$row->question)$row->question = '-';
		if(!$row->answer)$row->answer = '-';
		if(!$row->comment)$row->comment = '-';
		if(!$row->reply)$row->reply = '-';
		if(!$row->column1)$row->column1 = '-';
		if(!$row->column2)$row->column2 = '-';
		if(!$row->column3)$row->column3 = '-';
		if(!$row->column4)$row->column4 = '-';

		$sql2 = "SELECT `question1`, `question2`, `question3`, `question4`, `question5`, `question6`, `question7`, `question8`, `school_date`, `count` FROM `question` WHERE `school_date`='{$row->school_date}' AND `lecture`='{$lec}' ORDER BY `school_date`";
		$query2 = mysqli_query($conn, $sql2);

		$sql3 = "SELECT `school_date`, `number`, `rgb`, `c`  FROM `color` WHERE `school_date`='{$row->school_date}' AND `number`='{$row->number}' AND `c`='{$row->answer}' AND `lecture`='{$lec}' ORDER BY `school_date`";

		$query3 = mysqli_query($conn, $sql3);

		$row3 = mysqli_fetch_object($query3);
		$num = $row2->count;
		if($num ==0){
		 $num =4;
		}
		$color=$row3->rgb;
		if($color=='000000'){
		$color=f0ffff;
		}

			$sql6 = "SELECT `school_date`, `number`, `rgb`, `c`  FROM `color` WHERE `school_date`='{$row->school_date}' AND `number`='{$row->number}' AND `c`='{$row->reply}' AND `lecture`='{$lec}' ORDER BY `school_date`";

                $query6 = mysqli_query($conn, $sql6);
                $row6 = mysqli_fetch_object($query6);
                $color2=$row6->rgb;
                        if($color2=='000000'){
                        $color2=f0ffff;
                        }

			while($row2 = mysqli_fetch_object($query2)){
				$num = $row2->count;
				if($num ==0) $num =4;//表示数の数を初期化（４項目がデフォルト）

				#自分のミニッツペーパに色を付ける
				echo			"<div align = center>";
									if($row->number == $_SESSION['studentid']) echo "<table class= codermine >";
									else  echo "<table class= coder>";

				switch ($num){

					case "4":
echo<<<HTML
					<caption>{$row->school_date}の{$lec}</caption>
					<thead>
					<tr><th style = "background:#f9f9db;">質問</th><th style = "background:#f9f9db;">自分の回答</th></tr>
					</thead>
					<tbody>
					<tr><th width = "50%">{$row2->question1}</th><td width = "50%">{$row->question}</td></tr>
					<tr><th width = "50%">{$row2->question2}</th><td width = "50%">{$row->answer}</td></tr>
					<tr><th width = "50%">{$row2->question3}</th><td width = "50%">{$row->comment}</td></tr>
					<tr><th width = "50%">{$row2->question4}</th><td width = "50%">{$row->reply}</td></tr>
					</tbody>
					</table>
					</div><br>
HTML;
					break;

					case "5":
echo<<<HTML
					<div align = "center">
					<table class="coder">
					<caption>{$row->school_date}の{$lec}</caption>
					<thead>
					<tr><th>質問</th><th>自分の回答</th></tr>
					</thead>
					<tbody>
					<tr><th width = "50%">{$row2->question1}</th><td width = "50%">{$row->question}</td></tr>
					<tr><th width = "50%">{$row2->question2}</th><td width = "50%">{$row->answer}</td></tr>
					<tr><th width = "50%">{$row2->question3}</th><td width = "50%">{$row->comment}</td></tr>
					<tr><th width = "50%">{$row2->question4}</th><td width = "50%">{$row->reply}</td></tr>
					<tr><th width = "50%">{$row2->question5}</th><td width = "50%">{$row->column1}</td></tr>
					</tbody>
					</table>
					</div><br>
HTML;
					break;

					case "6":
echo<<<HTML
					<caption>{$row->school_date}の{$lec}</caption>
					<thead>
					<tr><th style = "background:#f9f9db;">質問</th><th style = "background:#f9f9db;">自分の回答</th></tr>
					</thead>
					<tbody>
					<tr><th width = "50%">{$row2->question1}</th><td width = "50%">{$row->question}</td></tr>
					<tr><th width = "50%">{$row2->question2}</th><td width = "50%">{$row->answer}</td></tr>
					<tr><th width = "50%">{$row2->question3}</th><td width = "50%">{$row->comment}</td></tr>
					<tr><th width = "50%">{$row2->question4}</th><td width = "50%">{$row->reply}</td></tr>
					<tr><th width = "50%">{$row2->question5}</th><td width = "50%">{$row->column1}</td></tr>
					<tr><th width = "50%">{$row2->question6}</th><td width = "50%">{$row->column2}</td></tr>
					</tbody>
					</table>
					</div><br>
HTML;
					break;

					case "7":
echo<<<HTML
					<div align = "center">
					<table class="coder">
					<caption>{$row->school_date}の{$lec}</caption>
					<thead>
					<tr><th>質問</th><th>自分の回答</th></tr>
					</thead>
					<tbody>
					<tr><th width = "50%">{$row2->question1}</th><td width = "50%">{$row->question}</td></tr>
					<tr><th width = "50%">{$row2->question2}</th><td width = "50%">{$row->answer}</td></tr>
					<tr><th width = "50%">{$row2->question3}</th><td width = "50%">{$row->comment}</td></tr>
					<tr><th width = "50%">{$row2->question4}</th><td width = "50%">{$row->reply}</td></tr>
					<tr><th width = "50%">{$row2->question5}</th><td width = "50%">{$row->column1}</td></tr>
					<tr><th width = "50%">{$row2->question6}</th><td width = "50%">{$row->column2}</td></tr>
					<tr><th width = "50%">{$row2->question7}</th><td width = "50%">{$row->column3}</td></tr>
					</tbody>
					</table>
					</div><br>
HTML;
					break;

					case "8":

echo<<<HTML
					<caption>{$row->school_date}の{$lec}</caption>
					<thead>
					<tr><th style = "background:#f9f9db;">質問</th><th style = "background:#f9f9db;">自分の回答</th></tr>
					</thead>
					<tbody>
					<tr><th width = "50%">{$row2->question1}</th><td width = "50%">{$row->question}</td></tr>
					<tr><th width = "50%">{$row2->question2}</th><td width = "50%">{$row->answer}</td></tr>
					<tr><th width = "50%">{$row2->question3}</th><td width = "50%">{$row->comment}</td></tr>
					<tr><th width = "50%">{$row2->question4}</th><td width = "50%">{$row->reply}</td></tr>
					<tr><th width = "50%">{$row2->question5}</th><td width = "50%">{$row->column1}</td></tr>
					<tr><th width = "50%">{$row2->question6}</th><td width = "50%">{$row->column2}</td></tr>
					<tr><th width = "50%">{$row2->question7}</th><td width = "50%">{$row->column3}</td></tr>
					<tr><th width = "50%">{$row2->question8}</th><td width = "50%">{$row->column4}</td></tr>
					</tbody>
					</table>
					</div><br>
HTML;
					break;
				}


			}
		}
	}
?>
</table>
<br>
<button class="btn" type="button" onclick="location.href='top.php'">メニューへ戻る</button><br><br>
<?php
	echo $_SESSION['lecture'] . 'のミニッツペーパー';
?>
</body>
</html>
