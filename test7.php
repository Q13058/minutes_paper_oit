 <?php
$omikuji = array('小吉','大吉');
$result = $omikuji[mt_rand(0,1)];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>おみくじ</title>
</head>
<body>
	<h1>おみくじ</h1>
	<p>今日の運勢は「<?php echo $result; ?>」です！</p>
	<p><a href="test7.php">もう一度!</a></p>
</body>
</htm
