<?php
ini_set( 'display_errors', 1 );#エラーがある際に表示
session_start();

include_once "function.php";

if (!$_SESSION['su_id']) {
	header("Location: ./login.php");
	exit();
}

if (!$_POST['new_studentId']) {
	error(3);
}
if (!$_POST['new_studentPass']) {
	error(4);
}
if ($_POST['new_studentPass'] !== $_POST['sub_new_studentPass']) {
	error(5);
}
if (!$_POST['new_studentLec_01']) {
	error(6);
}

if (!is_hankaku($_POST['new_studentId'])) {
	error(7);
}
if (!is_hankaku($_POST['new_studentPass'])) {
	error(8);
}

$dir = dirname(__FILE__) . '/../user_data/';
//echo "<br><br>".$dir."<br><br>";
//$i = 0;
if ($dir = opendir($dir)) {
	#すでに同じIDがないか検索
	while (false !== ($filename = readdir($dir))) {
		if ($filename != "." && $filename != "..") {
			$array = explode(".", $filename);
			//				$user_array[$i] = $array[0];
			if ($array[0] == $_POST['new_studentId']) {
				error(9);
			}
		}
		//		$i++;
	}
}



//$idName = mb_convert_kana($_POST['new_studentId']);
//$pass = mb_convert_kana($_POST['new_studentPass']);

//echo $idName;
//echo "<br>".$pass;

// 作成するファイル名の指定
//$file_name = $idName.'.csv';
$file_name = $_POST['new_studentId'].'.csv';


//echo "<br>".$file_name."<br>";
touch( $file_name );#ファイル作成
chmod( $file_name, 0707 );#パーミッションを与える

//echo "作成した" . $file_name . "を、" . $dir . $file_name . "に移動しました。";
#学生用の"user_data"ディレクトリにcsvファイルを移動するためにディレクトリの指定を示した変数を格納
$dir = dirname(__FILE__) . "/../user_data/".$file_name;
//echo $dir."<br>";


//echo "<br>file_name = ./" . $file_name . "<br>dir = ".$dir."<br><br>";

#学生用の"user_data"ディレクトリにcsvファイルを移動
if ( rename( $file_name, $dir ) ) {
    //echo "ファイルの移動に成功しました";
} else {
    //echo "ファイルの移動に失敗しました";
    exit(10);
}
//system("mv ./$file_name $dir");



$new_csv = dirname(__FILE__) . '/../user_data/' . $_POST['new_studentId'] . ".csv";
//echo "<br>".$new_csv."<br>";
//echo "<br>".'$newCsv='.$new_csv."<br>";

#以下、ファイルにパスワードと講義名を書き込む

$fp = fopen($new_csv, 'w');
chmod($new_csv, 0707);
fwrite($fp, $_POST['new_studentPass'] . ",");

$lec=$_POST['new_studentLec_01'];
$lec_01="\"$lec\"";
$lec_01 = mb_convert_encoding($lec_01,"SJIS", "UTF-8");
fwrite($fp, $lec_01 . ",");

$lec=$_POST['new_studentLec_02'];
$lec_02="\"$lec\"";
$lec_02 = mb_convert_encoding($lec_02,"SJIS", "UTF-8");
if (!empty($_POST['new_studentLec_02'])) {
	fwrite($fp, $lec_02 . ",");
}
$lec=$_POST['new_studentLec_03'];
$lec_03="\"$lec\"";
$lec_03 = mb_convert_encoding($lec_03,"SJIS", "UTF-8");
if (!empty($_POST['new_studentLec_03'])) {
	fwrite($fp, $lec_03 . ",");
}
fclose($fp);
echo "新規ユーザーを登録しました。<br>";
echo "ユーザー名：" . $_POST['new_studentId'] . "<br>";
echo "パスワード：" . $_POST['new_studentPass'] . "<br>";
echo "講義名1：" . $_POST['new_studentLec_01'] . "<br>";
if (!empty($_POST['new_studentLec_02'])) {
	echo "講義名2：" . $_POST['new_studentLec_02'] . "<br>";
}
if (!empty($_POST['new_studentLec_03'])) {
	echo "講義名3：" . $_POST['new_studentLec_03'] . "<br>";
}

?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
		<title>ユーザー登録完了</title>
	</head>
	<body>
		<hr>
		<a href="su_index.php">【戻る】</a>
	</body>

</html>
