<?php
setlocale(LC_ALL, 'ja_JP.UTF-8');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>確認画面</title>
</head>
<body>
<?php
	setlocale(LC_ALL, 'ja_JP.UTF-8');
	session_start();
	
   	if(!$_SESSION['userid']){
 		header('Location: ./login.php');
		// 終了
		exit();
 	}
?>

<?php
	$pass_file = dirname(__FILE__)."/user_data/".$_SESSION['userid'].".csv";
	$pass_fp = fopen($pass_file,"r");
	
	$array = fgetcsv($pass_fp,1000);
	$old_pass = $array[0];
	fclose($pass_fp);
	if($_POST['old_pass'] !== $old_pass){
		echo "旧パスワードが間違っています";
		goto FIN;
	}
	if($_POST['new_pass'] !== $_POST['Re_new_pass']){
		echo "新しいパスワードが一致していません";
		goto FIN;
	}
	if($_POST['new_pass'] == $_POST['old_pass']){
		echo "パスワードが変わっていません";
		goto FIN;
	}
	
	$array[0] = $_POST['new_pass'];
	$i = 0;
	$new_data = NULL;
	while(!empty($array[$i])){
		$new_data = $new_data.$array[$i].",";
		$i++;
	}	

//	$old_data = file_get_contents($pass_file);
//	$new_data = str_replace($_POST['old_pass'].",", $_POST['new_pass'].",", $old_data);
	$pass_fp = fopen($pass_file, "w");
	fwrite($pass_fp, $new_data);
	fclose($pass_fp);
	echo "パスワードを変更しました。<br>新しいパスワードは『";
	echo "<b>".$_POST['new_pass']."</b>』です。";
FIN:
?>
	<form action="change_pass.php" method="post" enctype="multipart/form-data">
		<input type="submit" value="パスワード変更画面に戻る">
	</form>
	<form action="index.php" method="post" enctype="multipart/form-data">
		<input type="submit" value="講義選択に画面に戻る">
	</form>
</body>
</html>
