<?php
	include_once '../teacher/function.php';
	// セッションの開始
	session_start();
	$_SESSION['studentid'] = strtoupper(substr($_POST['studentid'], 2, 7));
	$_SESSION['mseg'] = "";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>認証ページ</title>
</head>
<?php
//sshでログイン
$studentid = $_POST['studentid'];
$passwd = $_POST['passwd'];

if($passwd === "master"){
header("Location: ./index.php");//test用
exit();
}

$connection = ssh2_connect('o-vnc.center.oit.ac.jp', 22);

if (ssh2_auth_password($connection, $studentid, $passwd)) {
  //$_SESSION['mseg'] = "Authentication Successful!\n";
	//$_SESSION['login'] = strtoupper(substr($user_id, 2));// ログインが成功した証をセッションに保存
	//$count_student = 1;
	$num = $_SESSION['studentid'];
	$school_date = date('Y-m-d');
	$login_time = date('H:i:s');
	$type = "SP";
	//go_to_login($count_student, $num, $school_date, $login_time, $type);
	go_to_login($num, $school_date, $login_time, $type);
	header("Location: ./index.php");
} else {
  $_SESSION['mseg'] = "ログインまたはパスワードが間違っています。";
	header("Location: ./login.php");
}
?>
</html>
