<?php

include_once 'function.php';
	// セッションの開始
	session_start();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<title>Studentdata</title>
</head>
<body>
<table border=1>
<tr bgcolor="#CCCCCC">
<td>講義日</td>
</tr>
<form action="" method="GET">
<?php

	// MySQLへの接続
	$conn = mysqli_connect("150.89.227.15", "root_mp","nakanaka","mpaper_Q13058");

	if ($conn) {
		// データベースの選択
		mysqli_select_db($conn,"mpaper_Q13058");
		// データベースへの問い合わせSQL文
		$sql = 'SELECT DISTINCT school_date FROM qanda WHERE lecture = "' . $_SESSION['lecture'] . '" ORDER BY school_date';

		// SQL文の実行
		$query = mysqli_query($conn, $sql);

		// データの取出し
		while($row=mysqli_fetch_object($query)) {
			echo '<tr>';
			echo '<td><a href= "serch_tmp.php?id=' . $row->school_date . '">' . $row->school_date .'</a></td>';
			echo '</tr>';
		}
	}
?>
</form>
</table>
<br>
<li><a href="top.php">メニューに戻る</a>
<br><br>

</body>
</html>
