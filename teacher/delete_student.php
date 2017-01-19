<?php
	include_once 'function.php';
	 $conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);
	 $user=$_POST['student_user'];
	session_start();

	if(!$_SESSION['su_id']){
		header("Location: ./login.php");
	exit();
	}

	if($_POST['OK'] !== 'ON'){
		echo "『本当に削除する』が選択されていません。";
	}else{
		 if ($conn) {

                // データベースの選択
                mysql_select_db(DATABASE,$conn);
		 $sql = "DELETE FROM  `qanda` WHERE `teacher` = '$user'";
		$query = mysql_query($sql, $conn);
		}
		unlink(dirname(__FILE__).'/../user_data/'.$user.".csv");
    //echo dirname(__FILE__).'/../user_data/'.$user.".csv";
		echo "削除しました";
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
