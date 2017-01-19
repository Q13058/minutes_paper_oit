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
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
	<title>ミニッツペーパー管理システム</title>
	<link rel="stylesheet" href="css/style.css">
	<script type="text/javascript" src="js/easyselectbox.min.js"></script>
	<script type="text/javascript">
		(function ($) {
  		$('.design-select-box').easySelectBox({speed:200});
		})(jQuery);
	</script>
	</head>
	<body>
	Login: <b><?php echo $_SESSION['studentid']; ?></b>
	<hr>
	<h1>講義選択画面</h1><br>
	<div id="form">
	<form action="top.php" method="POST">
	<p class="form-title">講義を選んでください。</p><br>
	<div align = "center">
		<select name="lec" class="easy-select-box"  style="font-size: 17px;">
		<?php
		include_once './../teacher/function.php';
		$lec_csv = dirname(__FILE__)."/../teacher/user_data/Q13058.csv";

		if($lec_csv){
		//echo $lec_csv;
		$fp = fopen($lec_csv,"r");
		$lecture = fgetcsv_reg($fp,null,',','"');
		mb_convert_variables("UTF-8", "SJIS", $lecture);#文字コード変更
		//$lecture = mb_convert_encoding($lecture, 'sjis','UTF-8');
		fclose($fp);

		$i = 1;
		$check = 0;
		//while(!empty($lecture[$i])){
		//echo '<option>'.$lecture[$i].'</option>';
		//$i++;
		//}

		if ( ( $handle = fopen ( $lec_csv, "r" ) ) !== FALSE ) {
			while ( ( $data = fgetcsv_reg( $handle, 1000, ",", '"' ) ) !== FALSE ) {
				if ($check == 1){
					$i = 0;
				}
				while ($i < count($data)) {
					//mb_convert_encoding($data[$i], "SJIS", "UTF-8");
					mb_convert_variables("UTF-8", "SJIS", $data[$i]);#文字コード変更
						if($data[$i] != ""){
							echo '<option>'.$data[$i].'</option>';
						}
					$i++;
				}
				$check = 1;
				$i = 0;
			}
			fclose ( $handle );
		}
		}
		?>
	<!--
	<option value="プログラミング言語論" selected>プログラミング言語論</option>
	<option value="データ構造とアルゴリズム">データ構造とアルゴリズム</option>
	<option value="アセンブリ言語">アセンブリ言語</option>
	</select>
	-->
	</select>
	</div>
	<br><br>

<!--
<option>年度を選んでください。<br><br></option>
<select name="fiscal">
	<?php
		$this_year = date("Y");
		$month = date("m");
		if($month>=1&&$month<=3){
			$this_year += '1';
		}
		$min_year = '2010';
		echo"<option value='0' selected>指定しない</option>";
		while($this_year >= $min_year){
			echo"<option value='$this_year'>{$this_year}年度</option>";
			$this_year--;
		}
	?>
</select>
	<?php
	$this_year = date("Y");
	echo"今は".$this_year."年度、".$month."月です。";
	?>
-->

<button class="btn btn-primary" style="float: right;  width: 90px;">次へ</button>
</button>
</form>
<button class="btn btn-primary" onclick="location.href='logout.php'" style"float: right;">ログアウト</button>

	</div>
	</body>
</html>
