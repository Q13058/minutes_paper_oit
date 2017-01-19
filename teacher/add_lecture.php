<?php
ini_set( 'display_errors', 1 );#エラーがある際に表示
	// セッションの開始
	session_start();
		$_SESSION['mseg'] = "";
		$_SESSION['mseg_safe'] = "";
   	if(!$_SESSION['userid']){
 		header('Location: ./login.php');
		// 終了
		exit();
 	}

	if($_POST['lec_name'] == NULL){
		$_SESSION['mseg'] = "講義名が入力されていません。";
		header('Location: ./index.php');
	}

	$csv = dirname(__FILE__).'/user_data/'.$_SESSION['userid'].'.csv';
	if (!file_exists($csv)) {	#ファイルが存在するか
		error(1);
	} else if($fp = fopen($csv, 'a')){
		$lecture = $_POST['lec_name'];	#入力した講義名を変数に書き込む
		//mb_convert_variables("UTF-8", "SJIS", $lecture);#文字コード変更
		$lecture = mb_convert_encoding($lecture,"SJIS", "UTF-8"); #文字コード変更
		//mb_convert_variables("UTF-8", "SJIS", $lecture);#文字コード変更
		//fwrite($fp,$_POST['lec_name'].",");
		fwrite($fp,$lecture.",");	#CSVファイルに書き込み
		fclose($fp);
		$lecture = mb_convert_encoding($lecture, "UTF-8","SJIS"); #文字コード変更
		$_SESSION['mseg_safe'] = "講義名： <b>".$lecture."</b> を追加登録しました。";
		header('Location: ./index.php');
	}else{
		$_SESSION['mseg'] =  "ファイルオープンに失敗しました。<br>"."[解決策]CSVファイルのパーミッションを[707]にする。";
	}
FIN:
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
		<title>講義追加完了</title>
	</head>
	<body>
		<hr>
		<form action="index.php" method="post" enctype="multipart/form-data">
			<input type="submit" value="講義選択画面に戻る">
		</form>
	</body>

</html>
