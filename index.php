<?php
// セッションの開始
session_start();
$_SESSION['lecture'] = "";
if(!$_SESSION['studentid']){
	header('Location: login.php');
	// 終了
	exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<title>ミニッツペーパー管理システム</title>
</head>
<body>
	<script src="http//code.jquery.com/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
	<script src="http//code.jquery.com/jquery.js"></script>
	<script src="./bootstrap-dropdown.js"></script>
  <script type="text/javascript">
	window.location.hash="no-back";
	window.location.hash="no-back-button";
	window.onhashchange=function(){
	window.location.hash="no-back";
	}
</script>
	<div class="container">
		Login: <b><?php echo $_SESSION['studentid']; ?></b>
		<hr>
		<h1>講義選択画面</h1><br>
		<form action="mine_authenticate.php" method="POST">
			講義を選んでください。<br><br>
			<select name="lec" class="form-control" style="height:40px;  width: 70%;">
<?php

//echo "<br>".$_SESSION['studentid']."<br>";
//このシステムを構成する全ての関数を格納したphpファイルをインクルード
include_once './teacher/function.php';

$lec_csv = dirname(__FILE__).'/teacher/admin_data/lecture.csv';

if($lec_csv){
//echo $lec_csv;
$fp = fopen($lec_csv,"r");
$lecture = fgetcsv_reg($fp,null,',','"');
mb_convert_variables("UTF-8", "SJIS", $lecture);#文字コード変更
//$lecture = mb_convert_encoding($lecture, 'sjis','UTF-8');
fclose($fp);

$i = 1;
$check = 0;
//while(!empty($lecture[$i])){
//echo '<option>'.$lecture[$i].'</option>';
//$i++;
//}

if ( ( $handle = fopen ( $lec_csv, "r" ) ) !== FALSE ) {
	while ( ( $data = fgetcsv_reg( $handle, 1000, ",", '"' ) ) !== FALSE ) {
		if ($check == 1){
			$i = 0;
		}
		while ($i < count($data)) {
			//mb_convert_encoding($data[$i], "SJIS", "UTF-8");
			mb_convert_variables("UTF-8", "SJIS", $data[$i]);#文字コード変更
				if($data[$i] != ""){
					echo '<option>'.$data[$i].'</option>';
				}
			$i++;
		}
		$check = 1;
		$i = 0;
	}
	fclose ( $handle );
}
}
/*
else{
	echo "<option value=\"プログラミング言語論\" selected>プログラミング言語論</option>";
	echo "<option value=\"データ構造とアルゴリズム\">データ構造とアルゴリズム</option>";
	echo "<option value=\"アセンブリ言語\">アセンブリ言語</option>";
}
*/
	echo "</select>";
?>
			<!--
			<option>年度を選んでください。<br><br></option>
			<select name="fiscal">
<?php
/*
$this_year = date("Y");
$month = date("m");
if($month>=1&&$month<=3){
	$this_year += '1';
}
$min_year = '2010';
echo"<option value='0' selected>指定しない</option>";
while($this_year >= $min_year){
	echo"<option value='$this_year'>{$this_year}年度</option>";
	$this_year--;
}
*/
?>
			</select>
<?php
/*
$this_year = date("Y");
echo"今は".$this_year."年度、".$month."月です。";
*/
?>
			-->
			<hr>
			<div class="form-group">
				<button class="btn btn-primary">
  				<span class="glyphicon glyphicon-hand-right"> 次へ
  			</button>
			</div>
		</form>
<!--
	<div class="form-group">
	<form action="change_pass.php" method="POST">
	<button class="btn btn-primary" type="submit">
	<span class="glyphicon glyphicon-cog">
	<font color = "white">パスワードの変更</font>
	</button>
	</form>
	</div>
-->
		<hr>
		<form action="logout.php" method="POST">
			<button class="btn btn-danger" type="submit">
				<font color = "white">[→ ログアウト</font>
			</button>
		</form>
		<hr>
	</div>
</body>
</html>
