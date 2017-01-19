<?php
	// セッションの開始
	session_start();
   	if(!$_SESSION['userid']){
 		header('Location: ./login.php');
		// 終了
		exit();
 	}
	//このシステムを構成する全ての関数を格納したphpファイルをインクルード
	include_once './function.php';
	if($_SESSION['mseg_safe']==""){
		$message = $_SESSION['mseg'];
	}else{
		$message_safe = $_SESSION['mseg_safe'];
	}
	//echo '$_SESSION[\'mseg\']='.$_SESSION['mseg'];
	//echo '$_SESSION[\'mseg_safe\']='.$_SESSION['mseg_safe'];
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/sample.css">
<link href="../css/bootstrap.css" rel="stylesheet" media="screen">
<title>ミニッツペーパー管理システム</title>
</head>
<body>
	<div id="login" style="font-size: 15px;">
		Login: <?php echo $_SESSION['userid']; ?> さん
	</div>
	<div id="menu">メニュー画面</div>
		<br>
	<div class="container">
		<?php //エラーメッセージの表示
		//echo"a";
		if($message_safe!=NULL || $message!=NULL){
			//echo"b";
			if($message!=NULL){
				//echo"c";
				echo "<font color='red'>".$message."</font><br>";
			}else{
				//echo"d";
				echo "<font color='blue'>".$message_safe."</font><br>";
				 $_SESSION['mseg_safe']="";
			}
		}else{
			//echo"e";
			echo "<br>";
		}
		?>
	<ul>
				<li>■ミニッツペーパーの編集<br>
				<li>Excelをアップする講義を選んでください<br>
			<form action="cushion.php" method="POST">
				<select name="lec" class="form-control" style="font-size:20px; height:50px; width: 50%;">
<?php
	//csvファイルのチェック
	$lec_csv = dirname(__FILE__)."/user_data/".$_SESSION['userid'].".csv";
	echo $lec_csv;
	$fp = fopen($lec_csv,"r");
	$lecture = fgetcsv_reg($fp,null,',','"');
	mb_convert_variables("UTF-8", "SJIS", $lecture);#文字コード変更
//	$lecture = mb_convert_encoding($lecture, 'sjis','UTF-8');
	fclose($fp);

	$i = 1;
	$check = 0;
	//while(!empty($lecture[$i])){
	//	echo '<option>'.$lecture[$i].'</option>';
	//	$i++;
	//}

	if ( ( $handle = fopen ( $lec_csv, "r" ) ) !== FALSE ) {
		while ( ( $data = fgetcsv_reg( $handle, 1000, ",", '"' ) ) !== FALSE ) {
			if ($check == 1){
				$i = 0;
			}
			while ($i < count($data)) {
				//mb_convert_encoding($data[$i], "SJIS", "UTF-8");
				mb_convert_variables("UTF-8", "SJIS", $data[$i]);#文字コード変更
				if($data[$i] != ""){
					echo '<option>'.$data[$i].'</option>';
				}
				$i++;
			}
			$check = 1;
			$i = 0;
		}
	fclose ( $handle );
	}


?>
				</select>
				<button class="btn btn-success" style="font-size: 20px; position: relative; left: 0px; top: 8px">ミニッツペーパーの編集</button>

			</form>
		</li>
		<li>■新しく講義の追加<br>
		<li>追加する講義名を入力してください
			<form action="add_lecture.php" method="POST">
				<input type="text" name="lec_name" autocomplete="off" class="form-control" style="font-size:20px; height:50px; width: 50%;">
				<button class="btn btn-success" style="font-size: 20px; position: relative; left: 0px; top: 8px">講義を追加する</button>
			</form>
		</li>
<?php
$str1= <<<EOT
		<li>■講義の削除<br>
		<li>削除する講義名を選んでください
			<form action="delete_lecture.php" method="POST">
				<select name="lec_name" class="form-control" style="font-size:20px; height:50px; width: 50%;">
EOT;
$str2 = <<<EOT
				</select>
				<input type="radio" name="del_OK" value="ON">本当に削除する
				<input type="radio" name="del_OK" value="OFF" checked>削除しない
				<br>
				<button class="btn btn-success" style="font-size: 20px; position: relative; left: 0px; top: 8px">講義を削除する</button>
			</form>
		</li>
EOT;

$i = 1;
$check = 0;
//while(!empty($lecture[$i])){
//	echo '<option>'.$lecture[$i].'</option>';
//	$i++;
//}
echo $str1;
if ( ( $handle = fopen ( $lec_csv, "r" ) ) !== FALSE ) {
while ( ( $data = fgetcsv_reg( $handle, 1000, ",", '"' ) ) !== FALSE ) {
	if ($check == 1){
		$i = 0;
	}
		while ($i < count( $data )) {
				//mb_convert_encoding($data[$i], "SJIS", "UTF-8");
				mb_convert_variables("UTF-8", "SJIS", $data[$i]);#文字コード変更
				if($data[$i] != ""){
					echo '<option>'.$data[$i].'</option>';
				}
				$i++;
		}
		$check = 1;
		$i = 0;
}
fclose ( $handle );
}
		echo $str2;
/*
	if($i - 1 !== 1){
		echo $str1;
		$j = 1;
		while(!empty($lecture[$j])){
			echo '<option>'.$lecture[$j].'</option>';
			$j++;
		}
		echo $str2;
	}
	*/
?>
	</ul>
	<form action="logout.php" method="POST">
	<button class="btn btn-danger" style="font-size: 20px; position: relative; left: 0px; top: 10px">ログアウト</button>
	</form>
	</div>
</body>
</html>
