 <?php
$dice1=mt_rand(1,6);  //mt_rand()でランダムな数値を生成
$dice2=mt_rand(1,6);
$zorome = ($dice1 == $dice2) ? true : false;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>サイコロ</title>
</head>
<body>
	<h1>サイコロ</h1>
	<p>サイコロの目は「<?php echo $dice1; ?>」「<?php echo $dice2; ?>」でした！</p>
	<?php if($zorome == true) : ?>
	ゾロ目です！
	<?php endif; ?>
	<p><a href="test6.php"> もう一度!</a></p>
</body>
</html>

