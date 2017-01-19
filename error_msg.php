<?php
header("Content-Type: text/html; charset=UTF-8");
session_start();
$_SESSION['lecture'] = "";
if(!$_SESSION['studentid']){
  header('Location: login.php');
  // 終了
  exit();
}

//	echo "エラー番号：".$_SESSION['error']."<br>";
switch ($_SESSION['error']) {
	//ID系のエラー
	case 1 :
		echo "IDが正しくありません。<br>";
		break;
	//パスワード系のエラー
	case 2 :
		echo "パスワードが正しくありません。<br>";
		break;
	//登録系のエラー
	case 3 :
		echo "IDが入力されていません。<br>";
		break;
	case 4 :
		echo "パスワードが入力されていません。<br>";
		break;
	case 5 :
		echo "確認用とのパスワードが一致しません。<br>";
		break;
	case 6 :
		echo "講義名が入力されていません。<br>";
		break;
	case 7 :
		echo "新しいIDが半角英数字ではありません。<br>";
		break;
	case 8 :
		echo "新しいパスワードが半角英数字ではありません。<br>";
		break;
	case 9 :
		echo "そのIDは既に存在しています。<br>";
		break;
	//ファイルアップ系のエラー
	case 10 :
		echo "移動失敗<br>";
		break;
	case 11 :
		echo "展開失敗<br>";
		break;
	case 12 :
		echo "ファイルが選択されていません。<br>";
		break;
	case 13 :
		echo "拡張子が『.xlsx』のファイルではありません。<br>";
		break;
	case 14 :
		echo "日付が入力されていません。<br>";
		break;
	case 15 :
		echo "日付が8桁の半角数字ではありません。";
		break;
	case 16 :
		echo "旧パスワードが間違っています。";
	break;
	case 17 :
		echo "新規パスワードが入力されていません。";
	break;
	case 18 :
		echo "新規パスワード(確認用)が入力されていません。";
	break;
	default :
		echo "設定されていないエラーです。<br>";
		break;
}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>エラー</title>
	</head>
	<body>
		<hr>
		<form action="destination_url" method="get">
			<input type="button" value="戻る" onClick="history.back()">
		</form>
		<!--
		<form>
			<input type="submmit" value="戻る" onclick="history.go(-1)">
		</form>
	-->
	</body>
</html>
