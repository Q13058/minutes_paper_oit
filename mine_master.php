<?php
require_once "Mail.php";
// エラー出力する場合
ini_set( 'display_errors', 1 );
$ua=$_SERVER['HTTP_USER_AGENT'];
if((strpos($ua,'iPhone')!==false)||(strpos($ua,'iPod')!==false)||(strpos($ua,'Android')!==false)) {
  header('Location: ./sp/mine.php');
  exit();
}
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
include "mine_log.php";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/main.css">
<link href="css/bootstrap.css" rel="stylesheet" media="screen">
<title>ミニッツペーパを閲覧</title>
</head>

<?php
/*
//メール送信コード

//文字指定
mb_language("Japanese");
mb_internal_encoding("UTF-8");

//メールの内容
$to = "kimihiro_c@yahoo.co.jp";
$title = "ご無沙汰しております";
$content = "おひさしぶりです\nまたお食事にでも行きましょう。";
$from = "From: kimihiro_c@yahoo.co.jp\r\n";
//$from .= "Return-Path: kimihiro_c@yahoo.co.jp";
//メールの送信
$send_mail = mb_send_mail($to, $title, $content, $from);

//メールの送信に問題ないかチェック
if ($send_mail) {
  echo "ok";
} else {
  echo "no";
}



//ここまでコード
*/
// タイトルの表示
$id = $_SESSION['studentid'];
$zip = new ZipArchive();
$zip->open('QA0930.xlsx');
//$xml = simplexml_load_string( $zip->getFromName('xl/worksheets/sheet1.xml'));
//$xml2 = simplexml_load_string( $zip->getFromName('xl/styles.xml'));
//$xml3 = simplexml_load_string( $zip->getFromName('xl/sharedStrings.xml'));
//$color=GET_RGB($xml,$xml2,$xml3,$cell);
?>
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
	<h1>教員用ミニッツペーパ閲覧ページ</h1>
	<br>
	<form action="" method="GET">
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
	if ($conn) {
		// データベースの選択
		mysql_select_db(DATABASE,$conn);
		$sql = "SELECT `number`,COUNT(`present`)as school_sum FROM `qanda` WHERE `delete_flag`!='1' AND  `present`='1' AND `lecture`='{$lec}' GROUP BY `number`";
    //		$sql = "SELECT `number`,COUNT(`present`)as school_sum FROM `qanda` WHERE `delete_flag`!='1' AND `present`='1' WHERE lecture = ".$_SESSION['lecture']." GROUP BY `number`";
		// ORDER BY `school_sum` DESC";
		//$sql = "SELECT `number`,COUNT(`present`) as `school_sum` FROM `qanda` WHERE `present` IN(SELECT MAX(`present`) FROM `qanda` GROUP BY `number`)";
		$query = mysql_query($sql, $conn);
    //$sql2 = "SELECT `num`,`school_date`,`login_time` FROM `login_counter` ORDER BY `school_date`";
    //SELECT `num`,`school_date`,`login_time` FROM `login_counter` ORDER BY `school_date`;
    //echo $sql2;
    //$query2 = mysql_query($sql2, $conn);
  }
	echo	"<div align = center>";
	echo '<table width="35%" border="1">';
	echo '<tr bgcolor="#CCCCFF">';
	echo '<td width="10%"><b>学生番号<b></td>';
	echo '<td width="20%" colspan="2"><b>提出回数<b></td>';
  //echo '<td width="5%"><b>提出回数<b></td>';
	while($row=mysql_fetch_object($query)) {
		echo '<tr>';
		echo '<td align=center><a href= "mine_master_student.php?id=' . $row->number . '">' . $row->number .'</a></td>';
    $sql2 = "SELECT `num`,MAX(`school_date`)as `school_day`, `login_time` FROM `login_counter` GROUP BY `num`";
    $query2 = mysql_query($sql2, $conn);
    $check = 0;

    /*
    while($row2=mysql_fetch_object($query2)) {
      //echo "1=".$row->number . " 2=".$row2->num."<br>";
      if($row->number == $row2->num){
        if($row2->school_day != NULL){
          echo '<td style="padding-left: 20px; text-align: center;" colspan="2">' ."【". $row2->school_day . "】　　" . '</td>';
          $check = 1;
        }
      }
    }


    if($check == 0){
      echo '<td style="text-align: center;" colspan="2">' . '- - -' .'</td>';
      $check = 1;
    }
        */
    echo '<td style="padding-left: 20px;">' . $row->school_sum .'</td>';
		echo '</tr>';
	}
	echo "</table>";
	echo "</div>";
}
?>
	</form>
	<br><br>
  <div id="pagebody">
  <ul id="menu">
  	<li class="menu01"><a href="mine.php">自分のミニッツペーパ</a></li>
  	<li class="menu01"><a href="date.php">全体のミニッツペーパ</a></li>
  	<li class="menu01"><a href="keyserch.php">単語検索</a></li>
  	<li class="menu01"><a href="chart2.php">提出率のグラフ</a></li>
  	<li class="menu01"><a href="index.php">講義選択画面へ</a></li>
  </ul>
  </div>
  <br>
</body>
</html>
