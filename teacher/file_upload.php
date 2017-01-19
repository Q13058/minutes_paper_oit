<?php
session_start();

if (!$_SESSION['userid']) {
	header('Location: ./login.php');
	// 終了
	exit();
}
$message =$_SESSION['mseg'];
?>

<html>
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
		<link rel="stylesheet" href="css/sample.css">
		<link href="../css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="css/bs-button-style.css" rel="stylesheet" media="screen">
		<title>Excelアップロード</title>
		<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	</head>
	<body>
		<div id="login" style="font-size: 15px;">
			Login: <?php echo $_SESSION['userid']; ?> さん
		</div>
		<div id="menu">Excelファイルアップロード</div>
			<div class="container">
				<?php
				//エラーメッセージの表示
				if($message!=NULL){
					echo "<font color='red'>".$message."</font><br>";
				}else{
					echo "<br>";
				}
				?>
		■変換するExcelファイル（.xlsx）を指定してください。
		<form action='excel_to_sql.php' method='post' enctype='multipart/form-data'>
			<input id="lefile" type="file" style="display:none;" name='upfile' >
	<div class="input-group">
	  <input type="text" id="photoCover" class="form-control" style="cursor: text; height:50px; width:400px; font-size: 20px;" readonly="readonly" placeholder="ファイルを選択してください。">
	  <span class="input-group-btn"><button style="height:50px;" type="button" class="btn btn-info" onclick="$('input&#91;id=lefile&#93;').click();"><span class="glyphicon glyphicon-file" aria-hidden="true"></span></button></span>
	</div>


	<script>
	  $('input[id=lefile]').change(function() {
	    $('#photoCover').val($(this).val());
	  });
		$('input[id=lefile]').change(function() {
  $('#photoCover').val($(this).val().replace("C:\\fakepath\\", ""));
});
	</script>


			<br>
			■講義日を8桁の半角数字で入力してください。(例：20160911)
			<br>
				<input type="text" name="day" autocomplete="off" class="form-control" style="font-size:20px; height:50px; width: 50%; ime-mode : disabled;">
				<button class="btn btn-success btn-outline" style="font-size: 16px; position: relative; left: 0px; top: 8px;text-align:center"><b>アップロード確認画面へ</button>
			<br><br>
		</form>

		<form action="top.php" method="post" enctype="multipart/form-data">
		　<button class="btn btn-primary" style="font-size: 20px; position: relative; left: -26px; top: 8px;text-align:center">ミニッツペーパー編集画面に戻る</button>
		</form>
	</div>
	</body>
</html>
