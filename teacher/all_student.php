<?php
session_cache_limiter('private_no_expire');
session_start();// セッションの開始
require_once "Mail.php";
// エラー出力する場合
ini_set( 'display_errors', 1 );
$ua=$_SERVER['HTTP_USER_AGENT'];
if((strpos($ua,'iPhone')!==false)||(strpos($ua,'iPod')!==false)||(strpos($ua,'Android')!==false)) {
  header('Location: ./sp/mine.php');
  exit();
}
include_once './function.php';
// ログインチェック
if(!$_SESSION['userid']){
// ログインフォーム画面へ
header('Location: login.php');
// 終了
exit();
}
//include "./../mine_log.php";
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="stylesheet" href="css/sample.css">
  <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
  <link href="css/bs-button-style.css" rel="stylesheet" media="screen">
<title>ミニッツペーパーを閲覧</title>
</head>

<?php

// タイトルの表示
$id = $_SESSION['userid'];
$zip = new ZipArchive();
$zip->open('QA0930.xlsx');
//$xml = simplexml_load_string( $zip->getFromName('xl/worksheets/sheet1.xml'));
//$xml2 = simplexml_load_string( $zip->getFromName('xl/styles.xml'));
//$xml3 = simplexml_load_string( $zip->getFromName('xl/sharedStrings.xml'));
//$color=GET_RGB($xml,$xml2,$xml3,$cell);
?>
<body>
  <div id="login" style="font-size: 15px;">
		Login: <?php echo $_SESSION['userid']; ?> さん
	</div>
	<div id="menu">ミニッツぺーパー一覧</div>
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
	$id = $_SESSION['userid'];
	$lec = $_SESSION['lecture'];
	// データベースへの問い合わせSQL文
	if ($conn) {
		// データベースの選択
		mysql_select_db(DATABASE,$conn);
		$sql = "SELECT `number`,COUNT(`present`)as school_sum FROM `qanda` WHERE `delete_flag`!='1' AND  `present`='1' AND `lecture`='{$lec}' GROUP BY `number`";
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
	//echo '<td width="20%" colspan="2"><b>ログイン履歴<b></td>';
  echo '<td width="5%"><b>提出回数<b></td>';
	while($row=mysql_fetch_object($query)) {
		echo '<tr>';
		echo '<td align=center><a href= "all_student_.php?id=' . $row->number . '">' . $row->number .'</a></td>';
    $sql2 = "SELECT `num`,MAX(`school_date`)as `school_day`, `login_time` FROM `login_counter` GROUP BY `num`";
    $query2 = mysql_query($sql2, $conn);
    $check = 0;
    while($row2=mysql_fetch_object($query2)) {
      //echo "1=".$row->number . " 2=".$row2->num."<br>";
      if($row->number == $row2->num){
        if($row2->school_day != NULL){
          //echo '<td style="padding-left: 20px; text-align: center;" colspan="2">' ."【". $row2->school_day . "】　　" . /*$row2->login_time .*/ '</td>';
          $check = 1;
        }
      }
    }
    /*
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
  <div class="container">
    <form action="top.php" method="post" enctype="multipart/form-data">
    	<button class="btn btn-primary" style="font-size: 20px; position: relative; left: 0px; top: 8px; padding: 7px 80px; text-align:center">ミニッツペーパー編集画面に戻る</button>
    </form>
  </div>
  <br><br>
</body>
</html>
