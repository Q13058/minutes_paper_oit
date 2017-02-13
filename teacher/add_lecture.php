<?php
ini_set( 'display_errors', 1 );#エラーがある際に表示
	// セッションの開始
	session_start();
	include_once './function.php';
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
		exit;
	}

	$csv = dirname(__FILE__).'/user_data/'.$_SESSION['userid'].'.csv';	#現在ログインしている利用者が管理しているCSVファイル
	if (!file_exists($csv)) {	#ファイルが存在するか
		error(1);
	} else if($fp = fopen($csv, 'a')){
		$lecture = $_POST['lec_name'];	#入力した講義名を変数に書き込む
		//mb_convert_variables("UTF-8", "SJIS", $lecture);#文字コード変更
		$lecture = mb_convert_encoding($lecture,"SJIS", "UTF-8"); #文字コード変更
		//mb_convert_variables("UTF-8", "SJIS", $lecture);#文字コード変更
		//fwrite($fp,$_POST['lec_name'].",");



		if ( ( $handle = fopen ( $csv, "r" ) ) !== FALSE ) {
			while ( ( $data = fgetcsv_reg( $handle, 1000, ",", '"' ) ) !== FALSE ) {
					$i = 0;
				while ($i < count($data)) {
					//mb_convert_encoding($data[$i], "SJIS", "UTF-8");
					mb_convert_variables("UTF-8", "SJIS", $data[$i]);#文字コード変更
					//echo $data[$i]."==".$lecture; それぞれの講義名を確認するためのやつ
					if($data[$i] == $lecture){
						$_SESSION['mseg'] = "既に同じ名前の講義名が存在します。:".$lecture;
						header('Location: ./index.php');
						exit;
					}
					$i++;
				}
				$i = 0;
			}
		fclose ( $handle );
		}

		fwrite($fp,$lecture.",");	#CSVファイルに書き込み
		fclose($fp);
		$lecture = mb_convert_encoding($lecture, "UTF-8","SJIS"); #文字コード変更
		//$_SESSION['mseg_safe'] = "講義名： <b>".$lecture."</b> を追加登録しました。";
	}else{
		$_SESSION['mseg'] =  "ファイルオープンに失敗しました。<br>"."[error_1]CSVファイルのパーミッションを[707]にする。";
		header('Location: ./index.php');
		exit;
	}

	$csv = dirname(__FILE__).'/admin_data/lecture.csv';					#すべての講義を管理している管理者用CSVファイル
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
	exit;
}else{
	$_SESSION['mseg'] =  "ファイルオープンに失敗しました。<br>"."[error_2](admin_user)lecture.csvファイルのパーミッションを[707]にする。";
	header('Location: ./index.php');
	exit;
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
