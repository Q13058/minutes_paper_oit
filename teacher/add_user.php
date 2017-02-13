<?php
ini_set( 'display_errors', 1 );#エラーがある際に表示
header('Content-Type: text/html; charset=UTF-8');
session_start();
$_SESSION['mseg_error']=NULL;
$_SESSION['mseg_error_admin']=NULL;
$_SESSION['mseg_success']=NULL;
$_SESSION['mseg_delete']=NULL;
$_SESSION['mseg_admin_success']=NULL;
$_SESSION['mseg_admin_delete']=NULL;
include_once "./function.php";

$_SESSION['mseg_delete'] = "";

if (!$_SESSION['su_id']) {
	header("Location: ./login.php");
	exit();
}

if (!$_POST['new_id']) {
	//error(3);
	$_SESSION['mseg_error'] = "IDが入力されていません。";
	$flag = false;
	header("Location: ./su_index.php");
	exit;
	//IDが入力されていません
}

/*
if (!$_POST['new_pass']) {
	error(4);
	//パスワードが入力されていません
}
if ($_POST['new_pass'] !== $_POST['sub_new_pass']) {
	error(5);
	//確認用とのパスワードが一致しません
}
*/
if (!$_POST['new_lec_01']) {
	$_SESSION['mseg_error'] = "講義名が入力されていません。";
	header("Location: ./su_index.php");
	exit();
	//error(6);
	//講義名が入力されていません
}

if (!is_hankaku($_POST['new_id'])) {
	//error(7);
	$_SESSION['mseg_error'] = "新しいIDが半角英数字ではありません。";
	header("Location: ./su_index.php");
	exit();
	//新しいIDが半角英数字ではありません
}
/*
if (!is_hankaku($_POST['new_pass'])) {
	error(8);
	//新しいパスワードが半角英数字ではありません
}
*/
$dir = dirname(__FILE__) . '/user_data/';
//$i = 0;
if ($dir = opendir($dir)) {
	#すでに同じIDがないか検索
	while (false !== ($filename = readdir($dir))) {
		if ($filename != "." && $filename != "..") {
			$array = explode(".", $filename);
			//				$user_array[$i] = $array[0];
			if ($array[0] == $_POST['new_id']) {
				$_SESSION['mseg_error'] = "そのIDは既に存在しています。";
				header("Location: ./su_index.php");
				exit;
				//error(9);
				//そのIDは既に存在しています。
			}
		}
		//		$i++;
	}
}


$idName = mb_convert_kana($_POST['new_id']);
//$pass = mb_convert_kana($_POST['new_pass']);

echo $idName;
//echo "<br>".$pass;
$dir = dirname(__FILE__) . '/user_data/';

// 作成するファイル名の指定
$file_name = $idName.'.csv';
//echo "<br>".$file_name."<br>";
touch( $file_name );
chmod( $file_name, 0707 );

//echo "作成した" . $file_name . "を、" . $dir . $file_name . "に移動しました。";

$dir = $dir . $file_name;
	copy($file_name,$dir);
	unlink($file_name);

//echo $dir."<br>";

//system("mv ./$file_name $dir");



$new_csv = dirname(__FILE__) . '/user_data/' . $_POST['new_id'] . ".csv";

//echo "<br>".'$newCsv='.$new_csv."<br>";


$fp = fopen($new_csv, 'w');
chmod($new_csv, 0777);
//fwrite($fp, $_POST['new_pass'] . ",");

$null="NULL";
$null="\"$null\"";
$null = mb_convert_encoding($null,"SJIS", "UTF-8");
fwrite($fp, $null . ",");

$lec=$_POST['new_lec_01'];
$lec_01="\"$lec\"";
$lec_01 = mb_convert_encoding($lec_01,"SJIS", "UTF-8");
fwrite($fp, $lec_01 . ",");

$lec=$_POST['new_lec_02'];
$lec_02="\"$lec\"";
$lec_02 = mb_convert_encoding($lec_02,"SJIS", "UTF-8");
if (!empty($_POST['new_lec_02'])) {
	fwrite($fp, $lec_02 . ",");
}
$lec=$_POST['new_lec_03'];
$lec_03="\"$lec\"";
$lec_03 = mb_convert_encoding($lec_03,"SJIS", "UTF-8");
if (!empty($_POST['new_lec_03'])) {
	fwrite($fp, $lec_03 . ",");
}
fclose($fp);
/*
echo "新規ユーザーを登録しました。<br>";
echo "ユーザー名：" . $_POST['new_id'] . "<br>";
//echo "パスワード：" . $_POST['new_pass'] . "<br>";
echo "講義名1：" . $_POST['new_lec_01'] . "<br>";
if (!empty($_POST['new_lec_02'])) {
	echo "講義名2：" . $_POST['new_lec_02'] . "<br>";
}
if (!empty($_POST['new_lec_03'])) {
	echo "講義名3：" . $_POST['new_lec_03'] . "<br>";
}
*/
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
		<link rel="stylesheet" href="css/sample.css">
		<link href="../css/bootstrap.css" rel="stylesheet" media="screen">
		<title>ユーザー登録完了</title>
	</head>
	<body>
		<div id="login" style="font-size: 15px;">
			Login: <?php echo $_SESSION['su_id']; ?> さん
		</div>
		<div id="menu">新規教員登録完了画面</div>
		<div class="container">
			<?php
			$_SESSION['mseg_success']= "新しい教員を登録しました。<br>";
			$_SESSION['mseg_success'] = $_SESSION['mseg_success']."教員ID：" . $_POST['new_id'] . "<br>";
			//echo "パスワード：" . $_POST['new_pass'] . "<br>";
			$_SESSION['mseg_success'] = $_SESSION['mseg_success']."講義名1：" . $_POST['new_lec_01'] . "<br>";
			if (!empty($_POST['new_lec_02'])) {
			$_SESSION['mseg_success'] = $_SESSION['mseg_success']."講義名2：" . $_POST['new_lec_02'] . "<br>";
			}
			if (!empty($_POST['new_lec_03'])) {
			$_SESSION['mseg_success'] = $_SESSION['mseg_success']."講義名3：" . $_POST['new_lec_03'];
			}
			header("Location: ./su_index.php");
			exit;
			?>
		</div>
	</body>

</html>
