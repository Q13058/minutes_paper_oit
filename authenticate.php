<?php
//認証ページ
//ここは、ウェブ上に表示することはなく、サーバ内部で処理されるといった感じです
#ini_set( 'display_errors', 1 );#エラーがある際に表示
include_once 'teacher/function.php'; //function.phpを読み込み
// セッションの開始
session_start();
/*
$_SESSION['studentid']に学生のidを先頭から二文字を削って大文字で保管する。
（[e1q13058]ならば、[Q13058]となる。）
*/
$_SESSION['studentid'] = strtoupper(substr($_POST['studentid'], 2, 7));
$_SESSION['mseg'] = "";
?>

<?php
//sshでログイン
$studentid = $_POST['studentid'];
$passwd = $_POST['passwd'];
$connection = ssh2_connect('o-vnc.center.oit.ac.jp', 22);
//$maintenance = false;
//if($maintenance == false){
	if (ssh2_auth_password($connection, $studentid, $passwd)) {
	  //$_SESSION['mseg'] = "Authentication Successful!\n";
		//$_SESSION['login'] = strtoupper(substr($user_id, 2));// ログインが成功した証をセッションに保存
		//$count_student = 1;
		$num = $_SESSION['studentid'];
		$school_date = date('Y-m-d');
		$login_time = date('H:i:s');
		$type = "PC";
		//go_to_login($count_student, $num, $school_date, $login_time, $type);
		go_to_login($num, $school_date, $login_time, $type); 
		header("Location: ./index.php");
	} else {
	  $_SESSION['mseg'] = "ログインまたはパスワードが間違っています。";
		header("Location: ./login.php");
	}
//}else{
//	$_SESSION['mseg'] = "現在、メンテナンス中です。終了予定時刻は16時30分です。もしくは、スマートフォンで開いてください。";
//	header("Location: ./login.php");
//}
?>
