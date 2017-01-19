<?php
ini_set( 'display_errors', 1 );#エラーがある際に表示
	// セッションの開始
	session_start();
  include_once "./teacher/function.php";
	$_SESSION['lecture'] = "";
 	if(!$_SESSION['studentid']){
 		header('Location: login.php');
		// 終了
		exit();
 	}
?>

<!DOCTYPE html>
<html lang="ja" >
 <head>
 <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <link href="css/bootstrap.css" rel="stylesheet" media="screen">
 <title>パスワードの変更</title>
 </head>
 <body>
 <script src="http//code.jquery.com/jquery.js"></script>
 <script src="js/bootstrap.min.js"></script>
 <script src="http//code.jquery.com/jquery.js"></script>
 <script src="./bootstrap-dropdown.js"></script>
 <div class="container">
	 Login: <b><?php echo $_SESSION['studentid']; ?></b>
	 <hr>
<?php

$pass_file = dirname(__FILE__)."/user_data/".$_SESSION['studentid'].".csv";
$pass_fp = fopen($pass_file,"r");
$array = fgetcsv_reg($pass_fp,1000);
$old_pass = $array[0];
fclose($pass_fp);
if($_POST['old_pass'] !== $old_pass){
	error(16);
}else if(!$_POST['new_pass']){
	error(17);
}else if(!$_POST['sub_new_pass']){
	error(18);
}else if($_POST['new_pass'] != $_POST['sub_new_pass']){
	error(5);
}else{

$array[0] = $_POST['new_pass'];
$i = 0;
$new_data = NULL;
while(!empty($array[$i])){
	$new_data = $new_data.$array[$i].",";
	$i++;
}

//	$old_data = file_get_contents($pass_file);
//	$new_data = str_replace($_POST['old_pass'].",", $_POST['new_pass'].",", $old_data);

//system('chmod 755 $pass_file');
$pass_fp = fopen($pass_file, "w");
fwrite($pass_fp, $new_data);
fclose($pass_fp);
echo "パスワードを変更しました。<br>新しいパスワードは『";
echo "<b>".$_POST['new_pass']."</b>』です。<br><br><br>";
FIN:
}
?>
<form action="change_pass.php" method="post" enctype="multipart/form-data">
	<input type="submit" value="パスワード変更画面に戻る">
</form>
<br>
<form action="index2.php" method="post" enctype="multipart/form-data">
	<input type="submit" value="講義選択に画面に戻る">
</form>
</body>
</html>
