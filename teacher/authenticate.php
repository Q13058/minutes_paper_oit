<?php
ini_set( 'display_errors', 1 );#エラーがある際に表示
//IDとログイン状態を引き継ぐクッションページ。コレないと面倒なことになるの。

session_start();
include_once 'function.php';
$_SESSION['mseg'] = "";

if ($_POST['mode'] == '1') {
	goto nomal;
} else {
	goto su;
}

nomal:
$user_id = strtoupper(substr($_POST['userid'], 2, 7));
$_SESSION['mseg2'] = NULL;
$user_csv = dirname(__FILE__) . "/user_data/" . $user_id . ".csv";
if (!file_exists($user_csv)) {
	$_SESSION['mseg'] = "ログインIDもしくはパスワードが間違っています。";
	header("Location: ./login.php");
}else{
	$connection = ssh2_connect('o-vnc.center.oit.ac.jp', 22);
	if (ssh2_auth_password($connection, $_POST['userid'], $_POST['pass'])) {
	  //$_SESSION['mseg'] = "Authentication Successful!\n";
		//$_SESSION['login'] = strtoupper(substr($user_id, 2));// ログインが成功した証をセッションに保存
		$_SESSION['userid'] = $user_id;
		header('Location: ./index.php');
	} else {
	  $_SESSION['mseg'] = "ログインIDもしくはパスワードが間違っています。";
		header("Location: ./login.php");
	}
}


exit();

su:
$su_id = $_POST['su_id'];
$_SESSION['mseg'] = NULL;
//excel csv、文字コード変換
$su_csv = dirname(__FILE__) . "/admin_data/" . $su_id . ".csv";
if (!file_exists($su_csv)) {
	$_SESSION['mseg2'] = "ログインIDもしくはパスワードが間違っています。";
	header("Location: ./login.php");
	exit;
} else {
	$fp = fopen($su_csv, "r");
	$su_data = fgetcsv($fp, 1000, ',');
	fclose($fp);
	if ($su_data[0] !== $_POST['su_pass']) {
		$_SESSION['mseg2'] = "ログインIDもしくはパスワードが間違っています。";
		header("Location: ./login.php");
		exit;
	} else {
		$_SESSION['su_id'] = $_POST['su_id'];//セッションに文字が入ると次のページに飛べるようになる。
		$_SESSION['mseg2'] = NULL;
		header("Location: ./su_index.php");
		exit;
	}
}

/*
if ($_POST['su_id'] != "mp_master"){
	$_SESSION['mseg2'] = "管理者IDもしくは管理者パスワードが間違っています。";
	header("Location: ./login.php");
}elseif($_POST['su_pass'] != "5!kJ2P9"){
	$_SESSION['mseg2'] = "管理者IDもしくは管理者パスワードが間違っています。";
	header("Location: ./login.php");
}else{
	$_SESSION['su_id'] = $_POST['su_id'];
	header('Location: ./su_index.php');
}
*/

?>
