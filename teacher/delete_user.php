<?php
	include_once 'function.php';
	 $conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);
	 $user=$_POST['user'];
	session_start();
	$_SESSION['mseg_error']=NULL;
  $_SESSION['mseg_error_admin']=NULL;
	$_SESSION['mseg_success']=NULL;
  $_SESSION['mseg_delete']=NULL;
  $_SESSION['mseg_admin_success']=NULL;
  $_SESSION['mseg_admin_delete']=NULL;

	if(!$_SESSION['su_id']){
		header("Location: ./login.php");
	exit();
	}

	session_start();

	if($_POST['OK'] !== 'ON'){
		$_SESSION['mseg_delete'] = "『本当に削除する』が選択されていません。";
		header("Location: ./su_index.php");
	}else{
		 if ($conn) {

    // データベースの選択
    mysql_select_db(DATABASE,$conn);
		 $sql = "DELETE FROM  `qanda` WHERE `teacher` = '$user'";
		$query = mysql_query($sql, $conn);
		}
		$message_delete ="『".$_POST['user']."』";
		unlink(dirname(__FILE__).'/user_data/'.$_POST['user'].".csv");
		$_SESSION['mseg_delete'] = $message_delete."を削除しました";
		header("Location: ./su_index.php");
	}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>削除完了</title>
	</head>
	<body>
		<hr>
		<a href="su_index.php">【戻る】</a>
	</body>

</html>
