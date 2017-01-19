<?php
	$ua=$_SERVER['HTTP_USER_AGENT'];
	if((strpos($ua,'iPhone')!==false)||(strpos($ua,'iPod')!==false)||(strpos($ua,'Android')!==false)||(strpos($ua,'iPad')!==false)) {
	    header('Location: ./sp/login.php');
	    exit();
	}

	$mseg = "";
	session_start();
	if(isset($_SESSION['mseg'])){
		if(!empty($_SESSION['mseg'])){
			$mseg = $_SESSION['mseg'];
		}
		unset($_SESSION['mseg']);
	}
?>

<!DOCTYPE html>
<html lang="ja">
	<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
		<title>認証</title>
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
	
	<h4><strong>　　ミニッツペーパシステム</strong></h4>
        <hr>
	<blockquote>
	<p>演習室と同じIDとパスワードを入力してください<br><br><p>
	</blockquote>
		<div class="container">
		<form class="form-horizontal"  method="POST" action="authenticate.php" name="form1" onSubmit="return check()" >
			<div class="form-group">
                        <div class="col-md-3">
			<span class ="glyphicon glyphicon-user"> ユーザ名</span>
			<input type='text' class="form-control"   name='studentid'>
			</div>
			</div>
			<br>
			<div class="form-group">
			<div class="col-md-3">
			<span class ="glyphicon glyphicon-exclamation-sign"> パスワード</span>
			<input type='password' class="form-control" id="pass"  name='passwd'>
			</div>
			</div>
			<br>
			<p><input type="submit" value="ログイン"></p>
		</form>
		</div>
		<script src="http//code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
	</body>
</html>
