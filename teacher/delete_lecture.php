<?php
// セッションの開始
session_start();

if (!$_SESSION['userid']) {
	header('Location: ./login.php');
	// 終了
	exit();
}

if ($_POST['del_OK'] !== 'ON') {
	$_SESSION['mseg'] = "『本当に削除する』が選択されていません。";
	header('Location: ./index.php');
	exit;
}

//このシステムを構成する全ての関数を格納したphpファイルをインクルード
include_once './function.php';
$csv = dirname(__FILE__) . '/user_data/' . $_SESSION['userid'] . '.csv';
$fp = fopen($csv, "r+");
$data = fgetcsv_reg($fp,1000,',','"');
fclose($fp);





$fp = fopen($csv,"r+");
$i = 1;
$cnt = 1;
//0に格納されているのはパスワードだから消してはいけないので、回避措置。
$new_data[0] = $data[0];

$lec_name = $_POST['lec_name'];

while (!empty($data[$i])) {
	$data[$i] = mb_convert_encoding($data[$i], "UTF-8","SJIS");
	if ($data[$i] !== $_POST['lec_name']) {
		$new_data[$cnt++] = $data[$i];
	}
	$i++;
}
$fp = fopen($csv, "w");

$i = 0;
while (!empty($new_data[$i])) {
	$new_data[$i] = mb_convert_encoding($new_data[$i], "SJIS","UTF-8");
	fwrite($fp, $new_data[$i] . ",");
	$i++;
}





$csv = dirname(__FILE__).'/admin_data/lecture.csv';
$fp = fopen($csv, "r+");
$data = fgetcsv_reg($fp,1000,',','"');
fclose($fp);

$fp = fopen($csv,"r+");
$i = 1;
$cnt = 1;
//0に格納されているのはパスワードだから消してはいけないので、回避措置。
$new_data[0] = $data[0];

$lec_name = $_POST['lec_name'];

while (!empty($data[$i])) {
	$data[$i] = mb_convert_encoding($data[$i], "UTF-8","SJIS");
	if ($data[$i] !== $_POST['lec_name']) {
		$new_data[$cnt++] = $data[$i];
	}
	$i++;
}
$fp = fopen($csv, "w");

$i = 0;
while (!empty($new_data[$i])) {
	$new_data[$i] = mb_convert_encoding($new_data[$i], "SJIS","UTF-8");
	fwrite($fp, $new_data[$i] . ",");
	$i++;
}










/*	$data = file_get_contents($csv);
 $data = str_replace($_POST['lec_name'].",", "", $data);
 $fp = fopen($csv, "w");
 fwrite($fp,$data);
 fclose($fp);
 */
 	$_SESSION['mseg'] = "講義名： <b>" . $_POST['lec_name'] . "</b> を削除しました。";
	header('Location: ./index.php');
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>講義削除完了</title>
	</head>
	<body>
		<hr>
		<form action="index.php" method="post" enctype="multipart/form-data">
			<input type="submit" value="講義選択画面に戻る">
		</form>
	</body>

</html>
