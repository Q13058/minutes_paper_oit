<?php
//ユーザーの使用している端末が「iPhone」、「iPod」、「Android」、「iPad」のいずれかである場合、スマホ版のページへ飛ばす
$ua=$_SERVER['HTTP_USER_AGENT'];
if((strpos($ua,'iPhone')!==false)||(strpos($ua,'iPod')!==false)||(strpos($ua,'Android')!==false)||(strpos($ua,'iPad')!==false)) {
  header('Location: ./sp/login.php');
  exit();
}

$mseg = "";                       //エラーメッセージ用の変数
session_start();                  //セッション開始
if(isset($_SESSION['mseg'])){     #変数がセットされていること（NULLでないこと）を検査する
  if(!empty($_SESSION['mseg'])){  //変数が空であるかどうかを検査する
    $mseg = $_SESSION['mseg'];    //ログインが失敗していた場合、「authenticate.php」に記述していたエラーメッセージを変数に導入
  }
  unset($_SESSION['mseg']);       #指定した(ローカル)変数の割当を解除する
}

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<title>ミニッツペーパ閲覧システム ログイン認証</title>
  <script src="http//code.jquery.com/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script><!--「bootstrap」を使用-->
  <script type="text/javascript">
/*
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
*/

  </script>
</head>
<body>
  <div style="height:0.5em">
    <hr style="position:absolute; width:100%; height:4px; background-color: #428bca; border: none; color: #428bca;">
  </div>
  <div style="height:1.7em">
    <h1 style=" height: 40px; background-color: #428bca; color:white;"> ミニッツペーパ閲覧システム</h1>
  </div>
  <div style="height:3em">
    <hr style="position:absolute; width:100%; height:4px; background-color: #428bca; border: none; color: #428bca;">
  </div>

  <font size="4px">　演習室と同じIDとパスワードを入力してください</font>
  <br>
  <br>
  <div id='mseg' style="color:red;"><?php echo $mseg; //エラーメッセージ表示 ?></div>
  <!-- bootstrapのformについて http://qiita.com/zaburo/items/8983993d173c51cb3827 -->
	<div class="container">
	  <form method="POST" action="authenticate.php" name="form1" onSubmit="return check()" > <!--「authenticate.php」に移動 -->
	    <div class="form-group">
        <div class="col-md-3"><!-- Bootstrapのグリッドシステム -->
          <span class ="glyphicon glyphicon-user"> ID</span>
		      <br>
		      <input type='text' name='studentid'>
		    </div>
      </div>
		  <br>
	    <br>
		  <br>
      <div class="col-md-3">
        <span class ="glyphicon glyphicon-exclamation-sign"> パスワード</span>
		    <br>
		    <input type='password' name='passwd'>
		    <br>
		    <br>
        <button class="btn btn-primary" type="submit">
          <span class="glyphicon glyphicon-check"> ログイン</span>
        </button>
      </div>
	  </form>
  <br><br><br><br><br><br>
  <a href="http://oit.c-learning.jp/s/" target="_blank"><img src="img/c-learning.png" alt=""></a>
  <br><br><br><br>
  <font size="2vm" color="#000000">※画像をクリックするとリンク先へ飛びます。</size>
  </div>

</body>
</html>
