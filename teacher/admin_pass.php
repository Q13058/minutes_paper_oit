<?php
ini_set( 'display_errors', 1 );#エラーがある際に表示
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

if (!$_POST['new_pass']) {
  $_SESSION['mseg_error_admin'] = "パスワードが入力されていません。";
  header("Location: ./su_index.php");
  exit;
}
if ($_POST['new_pass'] !== $_POST['sub_new_pass']) {
  $_SESSION['mseg_error_admin'] = "確認用とのパスワードが一致しません。";
  header("Location: ./su_index.php");
  exit;
}

if (!is_hankaku($_POST['new_pass'])) {
	$_SESSION['mseg_error_admin'] = "新しいパスワードが半角英数字ではありません";
  header("Location: ./su_index.php");
  exit;
}

$dir = dirname(__FILE__) . '/admin_data/';

//$idName = mb_convert_kana($_POST['new_id']);
$idName = mb_convert_kana($_SESSION['su_id']);
$pass = mb_convert_kana($_POST['new_pass']);

//echo $idName;
//echo "<br>".$pass;
$dir = dirname(__FILE__) . '/admin_data/';

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

$new_csv = dirname(__FILE__) . '/admin_data/' . $idName . ".csv";

//echo "<br>".'$newCsv='.$new_csv."<br>";

$fp = fopen($new_csv, 'w');
chmod($new_csv, 0777);
fwrite($fp, $_POST['new_pass'] . ",");

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
			Login: <?php echo $idName ?> さん
		</div>
		<div id="menu">新規教員登録完了画面</div>
		<div class="container">
			<?php
				$length=strlen($_POST['new_pass']);
				$kome=NULL;
				while($length!=0){
					$kome=$kome.'*';
					$length--;
				}
        $_SESSION['mseg_admin_success']="<br>"."管理者パスワードを登録しました。<br>"."パスワード：".$kome."<br>";
				header("Location: ./su_index.php");
        exit;
      ?>
		</div>
	</body>

</html>
