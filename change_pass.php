<?php
// セッションの開始
session_start();
$_SESSION['lecture'] = "";
if(!$_SESSION['studentid']){
  header('Location: login.php');
  // 終了
  exit();
}
 ?>
 <!DOCTYPE html>
 <html lang="ja" >
 	<head>
 	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
 	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 	<link href="css/bootstrap.css" rel="stylesheet" media="screen">
 	<title>パスワードの変更</title>
  </head>
  <body>
  <script src="http//code.jquery.com/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="http//code.jquery.com/jquery.js"></script>
  <script src="./bootstrap-dropdown.js"></script>
  <div class="container">
  Login: <b><?php echo $_SESSION['studentid']; ?></b>
  <hr>
  <h1>パスワードの変更</h1><br>
  <ul>
    <li>
      <b>パスワードの変更を行います。</b>
      <br><br>
      <form method="POST" action="changed_pass.php">
        旧パスワード（使用中のパスワード）：
        <br>
        <input type='password' name='old_pass' autocomplete="off">
        <br>
        新規パスワード(半角英数字)：
        <br>
        <input type="password" name='new_pass' autocomplete="off">
        <br>
        新規パスワード(確認用)：
        <br>
        <input type="password" name='sub_new_pass' autocomplete="off">
        <br>
        <br>
        <input type="submit" value="パスワードを変更">
      </form>
      <br>
      <form action="index2.php" method="post" enctype="multipart/form-data">
        <input type="submit" value="講義選択に画面に戻る">
      </form>
    </li>
  </ul>
  </body>
</html>
