<!--
ミニッツペーパー閲覧システム(スマホ版)のログイン画面です
-->

<?php
$ua=$_SERVER['HTTP_USER_AGENT'];
echo $ua;
/*
「$mseg」は、ログインIDやパスワードを間違えたときに出力するための変数です
*/
	$mseg = "";
?>

<html lang="ja">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
		<title>認証</title>
		<link rel="stylesheet" type="text/css" href="./../sp/css/style.css" media="all" />

	</head>
	<body>

		<div id="form">
			<div id='mseg' style="color:red;"><?php echo $mseg; ?></div>
      <p style="text-align:center;">「Windows」「Mac OS」以外での端末において、教員用ページへのアクセスはできません。</p>
		</div>

	</form>

	</body>
</html>
