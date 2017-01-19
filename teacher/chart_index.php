 <?php
        include_once 'function.php';
	session_start();
	$_SESSION['studentid']=$_POST['studentid'];
	var_dump($_POST['border']);
	if($_POST['border']=="yes"){
	$border_flag=1;
	}else{
	$border_flag=0;
	}
	
	$id=$_POST['studentid'];
                 
                // MySQLへの接続
        $conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);
	//$border_flag=1;
        if ($conn) {
                // データベースの選択
                mysql_select_db(DATABASE,$conn);
                //講義ごとの提出回数を求めるSQL文　　　　　　　　　　　　　　
                $sql = "update qanda set border_flag='$border_flag'";
                $query = mysql_query($sql, $conn);
			}

	header('Location: ./chart.php');

	?>
