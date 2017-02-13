<?php
$ua=$_SERVER['HTTP_USER_AGENT'];
if((strpos($ua,'iPhone')!==false)||(strpos($ua,'iPod')!==false)||(strpos($ua,'Android')!==false)||(strpos($ua,'iPad')!==false)) {
  header('Location: ./no_entry.php');
  exit();
}

session_start();
$message =$_SESSION['mseg'];
$message2 =$_SESSION['mseg2'];
//$message3 =$_SESSION['mseg3'];
$_SESSION['mseg_error'] = "";
$_SESSION['mseg_delete'] = "";
$_SESSION['mseg_error']=NULL;
$_SESSION['mseg_error_admin']=NULL;
$_SESSION['mseg_success']=NULL;
$_SESSION['mseg_delete']=NULL;
$_SESSION['mseg_admin_success']=NULL;
$_SESSION['mseg_admin_delete']=NULL;
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
		<title>ユーザ認証</title>
	</head>
	<body style="background-color: #eeeeee;">
		<div style="height:0.5em">
			<hr style="position:absolute; width:100%; height:4px; background-color: #0dc420; border: none; color: #428bca;">
		</div>
		<div style="height:1.6em">
			<h1 style=" height: 40px; background-color: #0dc420; color:white;">ㅤㅤㅤ教員用ミニッツペーパー閲覧システム</h1>
		</div>
		<div style="height:3em">
			<hr style="position:absolute; width:100%; height:4px; background-color: #0dc420; border: none; color: #428bca;">
		</div>
		<script src="../js/bootstrap.min.js"></script><!--「bootstrap」を使用-->
		<div class="container">
		<form method="POST" action="authenticate.php">
			<?php //エラーメッセージの表示
			if($message!=NULL){
				echo "<div style=\"font-size:20px\"><font color='red'>".$message."</font></div><br>";
			}else{
				echo "<br>";
			}
			?>
			<div style="font-size:20px">教員ID：</div><br>
			<input type='text' name='userid' autocomplete="off" style="ime-mode : disabled; font-size:20px; height:50px; width: 20%;" class="form-control"><br><br>
			<div style="font-size:20px">教員パスワード：</div><br>
			<input type="password" size="30" name='pass' autocomplete="off" style="ime-mode : disabled; font-size:20px; height:50px; width: 27%;" class="form-control"><br><br>
			<button class="btn btn-success" style="font-size: 20px; position: relative; left: 0px; top: 8px">ログイン</button>
			<input type="hidden" name="mode" value="1">
			</form>

		<hr><br>

		<form method="POST" action="authenticate.php">
			<?php
			if($message2!=NULL){
				echo "<font color='red'>".$message2."</font><br>";
			}else{
				echo "<br>";
			}
			?>
			<div style="font-size:20px">管理者ID：</div><br>
			<input type='text' name='su_id' autocomplete="off" style="ime-mode:disabled; font-size:20px; height:50px; width: 20%;" class="form-control"><br><br>
			<?php
			/*
			if($message3!=NULL){
				echo "<font color='red'>".$message3."</font><br>";
			}else{
				echo "<br>";
			}
		  */
			?>
			<div style="font-size:20px">管理者パスワード：</div><br>
			<input type="password" size="30" name='su_pass' autocomplete="off" style="ime-mode : disabled; font-size:20px; height:50px; width: 27%;" class="form-control"><br>
			<input type="hidden" name="mode" value="2"><br>
			<button class="btn btn-success" style="font-size: 20px; position: relative; left: 0px; top: 8px">管理者としてログイン</button>
		</form>
		<!-- <a href="./../login.php">学生用ログイン画面へ<a>
    -->
		</div>
	</body>
</html>
