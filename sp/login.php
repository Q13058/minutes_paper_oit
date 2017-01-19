<!--
ミニッツペーパー閲覧システム(スマホ版)のログイン画面です
-->
<?php
/*
「$mseg」は、ログインIDやパスワードを間違えたときに出力するための変数です
*/
	$mseg = "";

	//セッションの作成
	session_start();

	//「isset」は、カッコ内の変数がNULLであるかどうかを検査します
	//変数の値がNULLだとFALSEを出力します
	if(isset($_SESSION['mseg'])){

		//「empty」は、変数が空であるかどうかを検査します。
		//変数が存在しない場合をTRUEとしています。
		if(!empty($_SESSION['mseg'])){

			//$_SESSION['mseg'] の中に値(文字列)が入っている場合は、「$mseg」に代入します
			//この場合、「ログインまたはパスワードが間違っています。」という文字列が、代入されます（同ディレクトリ内の「authenticate.php」を参照）
			$mseg = $_SESSION['mseg'];

		}
		//カッコ内の変数の割当を解除します。（破棄）
		unset($_SESSION['mseg']);

	}
?>

<html lang="ja">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
		<title>認証</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
		<script type="text/javascript">
		<!--
		function check(){
			var flag1 = 0;
			var flag2 = 0;
			var str = "";
			// 設定開始（必須にする項目を設定してください）
			if(document.form1.studentid.value == ""){ // 「お名前」の入力をチェック
				flag1 = 1;
				str += "ユーザ名を入力して下さい。<br>";
			}
			if(document.form1.passwd.value == ""){ // 「パスワード」の入力をチェック
				flag2 = 1;
				str += "パスワードを入力して下さい。<br>";
			}
			// 設定終了
			if(flag1 || flag2){
				document.getElementById("mseg").innerHTML= str;
				return false; // 送信を中止
			}
			else{
				return true; // 送信を実行
			}
		}
		// -->
		</script>
	</head>
	<body>

		<div id="form">
			<p class="form-title">Login</p>
			<div id='mseg' style="color:red;"><?php echo $mseg; ?></div>
			<form method="POST" action="authenticate.php" name="form1" onSubmit="return check()">
				<p>学内で使用しているユーザー名と<br>パスワードを入力してください。<p><br>
				<p>ユーザー名：ID<p>
				<p class="stid"><input type="text" name="studentid"></p>
				<p>パスワード：Password<p>
				<p class="pass"><input type="password" name="passwd"></p>
				<p class="submit"><input type="submit" value="ログイン"></p>
			</form>
		</div>
	<div id="form">
		<a href="http://oit.c-learning.jp/s/" target="_blank"><img src="img/c-learning.png" alt=""></a>
		<font size="2vm" color="#56CCCA">※画像をタップするとリンク先へ飛びます。</size>
	</div>
	</form>

	</body>
</html>
