<?php
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
$num = $_SESSION['studentid'];
$school_date = date('Y-m-d');
$login_time = date('H:i:s');
$type = "PC_menu";
//go_to_login($count_student, $num, $school_date, $login_time, $type);
go_to_menu($num, $school_date, $login_time, $type);

$user_csv = dirname(__FILE__) . "/teacher/user_data/" . $_SESSION['studentid']. ".csv";
if (file_exists($user_csv)) {
	header('Location: ./mine_master.php');
}
?>
<?php include "mine_log.php"; ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="css/main.css">
  <link href="css/bootstrap.css" rel="stylesheet" media="screen">
	<title>自分のミニッツペーパ―</title>
</head>
<?php
// タイトルの表示
$id = $_SESSION['studentid'];

$zip = new ZipArchive();
$zip->open('QA0930.xlsx');
$xml = simplexml_load_string( $zip->getFromName('xl/worksheets/sheet1.xml'));
$xml2 = simplexml_load_string( $zip->getFromName('xl/styles.xml'));
$xml3 = simplexml_load_string( $zip->getFromName('xl/sharedStrings.xml'));
//$color=GET_RGB($xml,$xml2,$xml3,$cell);
?>
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
	$sql = "SELECT `num`, `number`, `question`, `answer`, `comment`, `reply`, `column1`, `column2`, `column3`, `column4`,`school_date`,`present` FROM `qanda` WHERE `delete_flag`!='1' AND `number`='{$id}' AND `lecture`='{$lec}' ORDER BY school_date DESC";
	//$sql = 'SELECT * FROM `qanda` WHERE 1';
	// SQL文の実行
	$query = mysql_query($sql, $conn);
	echo "<font size=6>" . $id. "のミニッツペーパー</font>";
  echo "<br>";
	$sql3 = "SELECT COUNT(*) as cnt FROM qanda WHERE  `delete_flag`!='1' AND  present='1' AND number='{$id}' AND `lecture`='{$lec}'";
	$sql4 = "SELECT COUNT(DISTINCT `school_date`) as lec_num FROM `qanda`";
	$query3 = mysql_query($sql3, $conn);
	$row3 = mysql_fetch_object($query3);
	$cnt=0;
	if($row3->cnt>0){
		$cnt=$row3->cnt;
	}
	$query4 = mysql_query($sql4, $conn);
	$row4 = mysql_fetch_object($query4);
	$lec_num=$row4->lec_num;
	$ave=($cnt/$lec_num)*100;
	$ave =round($ave);
	if($ave>=70){
		echo '<font size="6"  color="blue"> 総提出率　'.$ave.' %</font>';
	}else{
		echo '<font size="6"  color="red"> 総提出率　'.$ave.' %</font>';
	}
	echo "<br>";
	$sql2 = "SELECT `question1`, `question2`, `question3`, `question4`, `question5`, `question6`, `question7`, `question8`, `school_date`, `count` FROM `question` WHERE `school_date`='{$row->school_date}' ORDER BY `count`,`school_date`";
  $query2 = mysql_query($sql2, $conn);
	$row2=mysql_fetch_object($query2);
	$tmp_question=$row2->question1;
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
			$tmp2_question=$row2->question1;

			$num = $row2->count;
			if($num ==0){
			 $num =4;
			}

			$sql5 = "SELECT `school_date`, `number`, `rgb`, `column_color`  FROM `color` WHERE `school_date`='{$row->school_date}' AND `number`='{$row->number}' AND `column_color`='{$row->answer}'  ORDER BY `school_date`";
		  $query5 = mysql_query($sql5, $conn);
		  $row5 = mysql_fetch_object($query5);
		  $color=$row5->rgb;
      if($color=='0' || $color==NULL){
		  	$color=EEEEFF;//白
		  }else{
      	$color=dechex($color);
      }

			$sql6 = "SELECT `school_date`, `number`, `rgb`, `column_color`  FROM `color` WHERE `school_date`='{$row->school_date}' AND `number`='{$row->number}' AND `column_color`='{$row->reply}'  ORDER BY `school_date`";
			$query6 = mysql_query($sql6, $conn);
			$row6 = mysql_fetch_object($query6);
			$color2=$row6->rgb;
      if($color2=='0'  || $color2==NULL){
				$color2=EEEEFF;//白
			}else{
      	  $color2=dechex($color2);
      }

			$sql7 = "SELECT `school_date`, `number`, `rgb`, `column_color`  FROM `color` WHERE `school_date`='{$row->school_date}' AND `number`='{$row->number}' AND `column_color`='{$row->column2}'  ORDER BY `school_date`";
			$query7 = mysql_query($sql7, $conn);
			$row7 = mysql_fetch_object($query7);
			$color3=$row7->rgb;
      if($color3=='0'  || $color3==NULL){
				$color3=EEEEFF;//白
			}else{
    	  $color3=dechex($color3);
    	}
			//var_dump($color);
			//var_dump($row->answer);
      switch ($num){
      case "4":
      //if($flag4==0){
      echo '<table width="1000px" border="1" align="center" style="margin-left:auto;margin-right:auto;">';
      echo '<tr></tr>';
      echo '<tr bgcolor="#CCCCFF">';
      echo '<td align="center" colspan="2"><b>講義日　' . $row->school_date  . '</b></td>';
      echo '</tr>';
      echo '<tr></tr>';
      //echo '<tr bgcolor="#CCCCFF">';
      //echo '<td width="50%" bgcolor="#CCCCFF" width="34%" align="center"><b>質問とその回答</b></td>';
      //echo '<td width="50%" width="14%">-</td>';
      //echo '</tr>';
      echo '<tr bgcolor="#CCCCFF">';
      //echo '<td width="80"><b>' . $row2->school_date .'</b></td>';
      echo '<td width="50%"><b>' . $row2->question1 .'</b></td>';
      echo '<td bgcolor="#EEEEFF">' . $row->question .'</td>';
      echo '</tr>';
      echo '<tr bgcolor="#CCCCFF">';
      echo '<td width="300" align="center"><b>' . $row2->question2 .'</b></td>';
      ?>
        <td width="300" bgcolor="<?php print $color;?>"> <?php print $row->answer;?></td>
      <?php
      echo '</tr>';
      echo '<tr></tr>';
      echo '<tr bgcolor="#CCCCFF">';
      echo '<td><b>' . $row2->question3 .'</b></td>';
      echo '<td bgcolor="#EEEEFF">' . $row->comment .'</td>';
      echo '</tr>';
      echo '<tr bgcolor="#CCCCFF">';
      echo '<td><b>' . $row2->question4 .'</b></td>';
      echo '<td bgcolor="#EEEEFF">' . $row->reply .'</td>';
      echo '</tr>';
      echo '<tr></tr>';
      //echo "</table>";
      //$flag4=$flag4+1;
      //}
      //echo '<table border="1" align="center" style="margin-left:auto;margin-right:auto;">';
      //echo '<td width="80">' . $row->school_date .'</td>';
      echo "</table><br><br>";
      break;

      case "5":

      if($flag5==0){
      echo "<br>";
                  echo '<table  border="1" align="center">';
                  echo '<tr bgcolor="#CCCCFF"</tr>';
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
      $tmp_question=$tmp2_question;
      }
      echo '<table border="1" align="center">';
      echo '<tr>';
      echo '<td width="80" >' . $row->school_date .'</td>';
      echo '<td width="500">' . $row->question .'</td>';
      ?>
      <td width="300" bgcolor="<?php print $color;?>"><?php print $row->answer;?></td>
      <td width="200"> <?php print $row->comment;?></td>
      <?php
      echo '<td width="100">' . $row->reply .'</td>';
      echo '<td width="100">' . $row->column1 .'</td>';
      echo '</tr>';
      echo "</table>";
      break;

      case "6":

      //if($flag6==0){
      echo '<table width="1000px" border="1" align="center" style="margin-left:auto;margin-right:auto;">';
      echo '<tr></tr>';
      echo '<tr bgcolor="#CCCCFF">';
      echo '<td align="center" colspan="2"><b>講義日　' . $row->school_date  . '</b></td>';
      echo '</tr>';
        echo '<tr></tr>';
        //echo '</tr>';
        //echo '<tr>';
        echo '<tr>';
        echo '<td bgcolor="#CCCCFF" width="50%"><b>' . $row2->question1 .'</b?</td>';
        echo '<td bgcolor="#EEEEFF">' . $row->question .'</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td width="300" bgcolor="#CCCCFF"><b>' . $row2->question2 .'</b></td>';
        ?>
          <td width="300" bgcolor="<?php print $color;?>"> <?php print $row->answer;?></td>
        <?php
        echo '</tr>';
        echo '<tr>';
        echo '<td bgcolor="#CCCCFF"><b>' . $row2->question3 .'</b></td>';
        echo '<td bgcolor="#EEEEFF">' . $row->comment .'</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td width="100" bgcolor="#CCCCFF"><b>' . $row2->question4 .'</b></td>';
        ?>
          <td width="300" bgcolor="<?php print $color2;?>"> <?php print $row->reply;?></td>
        <?php
        echo '</tr>';
        echo '<tr>';
        echo '<td width="100" bgcolor="#CCCCFF"><b>' . $row2->question5 .'</b></td>';
        echo '<td bgcolor="#EEEEFF">' . $row->column1 .'</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td width="100" bgcolor="#CCCCFF"><b>' . $row2->question6 .'</b></td>';
        ?>
          <td width="300" bgcolor="<?php print $color3;?>"> <?php print $row->column2;?></td>
        <?php
        echo '</tr>';
        //echo "</table>";
      //$flag6=$flag6+1;
      //}
      //echo '<table border="1" align="center">';
      echo '<tr bgcolor="#EEEEFF">';
      echo '</tr>';
      echo "</table><br><br>";
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
      //if($flag8==0){
      echo '<table width="1000px" border="1" align="center" style="margin-left:auto;margin-right:auto;">';
      echo '<tr></tr>';
      echo '<tr bgcolor="#CCCCFF">';
      echo '<td align="center" colspan="2"><b>講義日　' . $row->school_date  . '</b></td>';
      echo '</tr>';
      echo '<tr></tr>';
      //echo '</tr>';
      //echo '<tr>';
      echo '<tr>';
      echo '<td bgcolor="#CCCCFF" width="50%"><b>' . $row2->question1 .'<b></td>';
      echo '<td bgcolor="#EEEEFF">' . $row->question .'</td>';
      echo '</tr>';
      echo '<tr>';
      echo '<td bgcolor="#CCCCFF"><b>' . $row2->question2 .'<b></td>';
      ?>
        <td bgcolor="<?php print $color;?>"> <?php print $row->answer;?></td>
      <?php
      echo '</tr>';
      echo '<tr>';
      echo '<td bgcolor="#CCCCFF"><b>' . $row2->question3 .'<b></td>';
      echo '<td bgcolor="#EEEEFF">' . $row->comment .'</td>';
      echo '</tr>';
      echo '<tr>';
      echo '<td bgcolor="#CCCCFF"><b>' . $row2->question4 .'<b></td>';
      ?>
        <td bgcolor="<?php print $color2;?>"> <?php print $row->reply;?></td>
      <?php
      echo '</tr>';
      echo '<tr>';
      echo '<td bgcolor="#CCCCFF"><b>' . $row2->question5 .'<b></td>';
      echo '<td bgcolor="#EEEEFF">' . $row->column1 .'</td>';
      echo '</tr>';
      echo '<tr>';
      echo '<td bgcolor="#CCCCFF"><b>' . $row2->question6 .'<b></td>';
      ?>
        <td bgcolor="<?php print $color3;?>"> <?php print $row->column2;?></td>
      <?php
      echo '</tr>';
      echo '<tr>';
      echo '<td bgcolor="#CCCCFF"><b>' . $row2->question7 .'<b></td>';
      echo '<td bgcolor="#EEEEFF">' . $row->column3 .'</td>';
      echo '</tr>';
      echo '<tr>';
      echo '<td bgcolor="#CCCCFF"><b>' . $row2->question8 .'<b></td>';
      echo '<td bgcolor="#EEEEFF">' . $row->column4 .'</td>';
      echo '</tr>';
      //echo "</table>";
      //$flag8=$flag8+1;
      //}

      //echo '<table border="1" align="center">';
      echo '<tr bgcolor="#EEEEFF">';
      echo '</tr>';
      echo "</table><br><br>";
      break;
      }
		}
	}
}
?>

<br>
</body>
</html>
