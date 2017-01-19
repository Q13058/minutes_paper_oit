<?php
	session_start();
	
	if(!$_SESSION['userid']){
 		header('Location: ./login.php');
		// 終了
		exit();
 	}
	$_SESSION['lecture'] = $_POST['lec'];
	header("Location: ./top.php");
?>
