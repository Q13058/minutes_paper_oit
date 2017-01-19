<?php
ini_set( 'display_errors', 0);
include_once '../teacher/function.php';
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
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
<title>Q&A</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/top_view.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
(function($) {
    $(function() {
        var $header = $('#top-head');
        $(window).scroll(function() {
            if ($(window).scrollTop() > 50) {
                $header.addClass('fixed');
            } else {
                $header.removeClass('fixed');
            }
        });
    });
})(jQuery);
</script>
</head>

<?php
	// タイトル
	$lec = $_SESSION['lecture'];
	$id = $_GET['id'];
	//echo "<h1><font size=5>" . $id . 'の'.$lec .'のミニッツペーパー</font></h1>';
	echo '<body><br><br>';

	// MySQLへの接続
	$conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);

	if ($conn) {
		// データベースの選択
		mysql_select_db(DATABASE,$conn);

		$id = $_GET['id'];

		// データベースへの問い合わせSQL文
		$sql = 'SELECT number, question, answer, comment, reply, column1, column2, column3, column4, school_date FROM qanda WHERE  school_date = "' . $id . '" AND lecture = "' . $_SESSION['lecture'] . '" ORDER BY question' ;

		// SQL文の実行
		$query = mysql_query($sql, $conn);
		$row_1 = mysql_fetch_object($query);
				echo	"<div align = center>";
					$sql2_1 = "SELECT `question1`, `question2`, `question3`, `question4`, `question5`, `question6`, `question7`, `question8`, `school_date`, `count` FROM `question` WHERE `school_date`='{$row_1->school_date}' ORDER BY `school_date`";
					$query2_1 = mysql_query($sql2_1, $conn);
					$row2_1 = mysql_fetch_object($query2_1);
					$num2_1 = $row2_1->count;

if($num2_1 == 4){
echo<<<HTML
					<table class = coder id="top-head">
					<thead>
					<tr><th width = "50%" colspan="4" style = "background:#f9f9db;"><font size=2>$id の$lec のミニッツペーパー</font></th></tr>
					</thead>
					<tbody>
					<tr>
						<th width = "50%" height="60px"><button class="list" type="button" onclick="location.href='serch.php?id={$row_1->school_date}'">設問</button></th>
						<th width = "50%" height="60px" style = "background-color:#ffBB77;"><button class="list" type="button" onclick="#">質問など</button></th>
					</tr>
					</tbody>
					</table>
					<br><br>
HTML;
}
if($num2_1 == 6){
echo<<<HTML
					<table class = coder id="top-head">
					<thead>
					<tr><th width = "50%" colspan="4" style = "background:#f9f9db;"><font size=2>$id の$lec のミニッツペーパー</font></th></tr>
					</thead>
					<tbody>
					<tr>
						<th width = "33%" height="60px"><button class="list" type="button" onclick="location.href='serch.php?id={$row_1->school_date}'"><font size="3vw">設問１</font></button></th>
						<th width = "33%" height="60px"><button class="list" type="button" onclick="location.href='serch_work_1.php?id={$row_1->school_date}'"><font size="3vw">設問2</font></button></th>
						<th width = "33%" height="60px" style = "background-color:#ffBB77;"><button class="list" type="button" onclick="#"><font size="3vw">質問など</font></button></th>
					</tr>
					</tbody>
					</table>
					<br><br><br><br>
HTML;
}
if($num2_1 == 8){
echo<<<HTML
					<table class = coder id="top-head">
					<thead>
					<tr><th width = "50%" colspan="4" style = "background:#f9f9db;"><font size=2>$id の$lec のミニッツペーパー</font></th></tr>
					</thead>
					<tbody>
					<tr>
						<th width = "25%" height="60px"><button class="list" type="button" onclick="location.href='serch.php?id={$row_1->school_date}'"><font size="3vw">設問1</font></button></th>
						<th width = "25%" height="60px"><button class="list" type="button" onclick="location.href='serch_work_1.php?id={$row_1->school_date}'"><font size="3vw">設問2</font></button></th>
						<th width = "25%" height="60px"><button class="list" type="button" onclick="location.href='serch_work_2.php?id={$row_1->school_date}'"><font size="3vw">設問3</font></button></th>
						<th width = "25%" height="60px" style = "background-color:#ffBB77;"><button class="list" type="button" onclick="#"><font size="3vw">質問など</font></button></th>
					</tr>
					</tbody>
					</table>
					<br><br>
HTML;
}
					//色選択（codermine：akairo ）
					//if($row->number == $_SESSION['studentid']) echo "<table class= codermine >";
					//else  echo "<table class = coder>";
					echo "<br><br><br>";
					echo "<table class = coder>";
					//質問と「中西からの回答」を表示
if($num2_1 == 4){
echo<<<HTML
				<thead>
				<tr>
					<th width = "50%" style = "background:#bff0ff; text-align: left;">{$row2_1->question3}</th>
					<th width = "50%" style = "background:#bff0ff;">{$row2_1->question4}</th>
				</tr>
				</thead>
								<tbody>
HTML;
}
if($num2_1 == 6){
echo<<<HTML
				<thead>
				<tr>
					<th width = "50%" style = "background:#bff0ff; text-align: left;">{$row2_1->question5}</th>
					<th width = "50%" style = "background:#bff0ff;">{$row2_1->question6}</th>
				</tr>
				</thead>
								<tbody>
HTML;
}
if($num2_1 == 8){
echo<<<HTML
				<thead>
				<tr>
					<th width = "50%" style = "background:#bff0ff; text-align: left;">{$row2_1->question7}</th>
					<th width = "50%" style = "background:#bff0ff;">{$row2_1->question8}</th>
				</tr>
				</thead>
				<tbody>
HTML;
}
		// データの取出し
		while($row=mysql_fetch_object($query)) {
			if($row->question!='未回答' && $row->question!='未登録' && !empty($row->question)){
				$sql2 = "SELECT `question1`, `question2`, `question3`, `question4`, `question5`, `question6`, `question7`, `question8`, `school_date`, `count` FROM `question` WHERE `school_date`='{$row->school_date}' AND `lecture`='{$lec}' ORDER BY `school_date`";
				$query2 = mysql_query($sql2, $conn);
				// 未回答などは非表示
				while($row2 = mysql_fetch_object($query2)){
					// 空値に－を代入して見た目を綺麗に
					if(!$row->question)$row->question = '-';
					if(!$row->answer)$row->answer = '-';
					if(!$row->comment)$row->comment = '-';
					if(!$row->reply)$row->reply = '-';
					if(!$row->column1)$row->column1 = '-';
					if(!$row->column2)$row->column2 = '-';
					if(!$row->column3)$row->column3 = '-';
					if(!$row->column4)$row->column4 = '-';

				$num = $row2->count;
				if($num ==0) $num =4;//表示数の数を初期化（４項目がデフォルト）

				//色を指定
				if($row->number == $_SESSION['studentid']){
						$color_background = "background-color:#ff9966;";
				}else{
						$color_background = "background-color:#aaffc2;";
				}
				if($num2_1 == 4){
					if($row->comment == '-' || $row->reply == '-'){
						break;
					}
				}
				if($num2_1 == 6){
					if($row->column1 == '-' || $row->column2 == '-'){
						break;
					}
				}
				if($num2_1 == 8){
					if($row->column3 == '-' || $row->column4 == '-'){
						break;
					}
				}
				switch ($num){
					case "4":
echo<<<HTML

				<tr><th width = "50%" style = "{$color_background} text-align: left;">{$row->comment}</th><td width = "50%">{$row->reply}</td></tr>

HTML;
					break;

					case "5":

echo<<<HTML
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
					</div><br><br><br>
HTML;
					break;



					case "6":
echo<<<HTML

				<tr><th width = "50%" style = "{$color_background} text-align: left;">{$row->column1}</th><td width = "50%">{$row->column2}</td></tr>

HTML;
					break;




					case "7":

echo<<<HTML
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
					</div><br><br><br>
HTML;
					break;

					case "8":

echo<<<HTML
					<tr>
						<th width = "50%" style = "{$color_background} text-align: left;">{$row->column3}</th>
						<td width = "50%">{$row->column4}</td>
					</tr>
HTML;
					break;
					}
				}
			}
		}
	}
?>
</tbody></table></div>
</div><br><br><br>
<table class = coder id="top-bottom3">
<tbody>
<tr>
	<th width = "50%" style = "background:#f9f9db;" onclick="location.href='top.php'"><font size=3>メニューへ戻る</font></th>
	<th width = "50%" style = "background:#f9f9db;" onclick="location.href='date.php'"><font size=3>全体のミニッツペーパーに戻る</font></th>
</tr>
</tbody>
</table>
<br><br>
<?php
	//echo $_SESSION['lecture'] . 'のミニッツペーパー';
?>
</body>
</html>
