 <?php

   include_once '../teacher/function.php';

 echo $_POST['var1'];
  echo $_POST['var2'];
 echo $_POST['var3'];
 echo $_POST['var4'];

  $rgb=$_POST['var1'];
  var_dump($rgb);
  $str= $_POST['var2'];
  $number= $_POST['var3'];
  $school_date= $_POST['var4'];




  $conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);

  if ($conn) {
                // データベースの選択
                mysql_select_db(DATABASE,$conn);
		
		$sql3 = "update color set rgb='$rgb' WHERE `school_date`='{$school_date}' AND `number`='{$number}'";
		 $query = mysql_query($sql3, $conn);
	}
?>
