<?php
session_start();
include_once './function.php';
$message_error = $_SESSION['mseg_error'];
$message_error_admin = $_SESSION['mseg_error_admin'];
$message_success = $_SESSION['mseg_success'];
$message_delete = $_SESSION['mseg_delete'];
$message_admin_success = $_SESSION['mseg_admin_success'];
$message_admin_delete = $_SESSION['mseg_admin_delete'];
$message_lecture_success = $_SESSION['mseg_lecture_success'];
$message_lecture_error = $_SESSION['mseg_lecture_error'];

if (!$_SESSION['su_id']) {
	header("Location: ./login.php");
	exit();
}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
		<link rel="stylesheet" href="css/sample.css">
		<link href="../css/bootstrap.css" rel="stylesheet" media="screen">
		<title>ミニッツペーパーシステム管理者画面</title>
	</head>
	<body>
		<div id="login" style="font-size: 15px;">
			Login: <?php echo $_SESSION['su_id']; ?> さん
		</div>
		<div id="menu">管理者画面</div>
		<div class="container">
		■メニュー
		<ul>
			<li>
				<b>教員登録</b>
				<?php //エラーメッセージの表示
				if($message_error!=NULL){
					echo "<br><font color='red'>".$message_error."</font><br>";
				}elseif($message_success!=NULL){
					echo "<br><font color='blue'>".$message_success."</font><br>";
				}else{
					echo "<br>";
				}
				?>
				<ol>
					<form method="POST" action="add_user.php">
						新規教員ID(半角英数字)：
						<br>
						<input type='text' name='new_id' autocomplete="off">
						<br>
						<!--
						新規パスワード(半角英数字)：
						<br>
						<input type="password" name='new_pass' autocomplete="off">
						<br>
						新規パスワード(確認用)：
						<br>
						<input type="password" name='sub_new_pass' autocomplete="off">
						<br>
					-->
						登録する講義(講義名1は必ず入力してください)
						<br>
						講義名1：
						<input type="text" name='new_lec_01' autocomplete="off">
						<br>
						講義名2：
						<input type="text" name='new_lec_02' autocomplete="off">
						<br>
						講義名3：
						<input type="text" name='new_lec_03' autocomplete="off">
						<br>
						<button class="btn btn-primary" style="font-size: 20px; position: relative; left: 0px; top: 16px;text-align:center; text-align:center;">新規教員を登録</button>
					</form>
				</ol>
			</li>
			<br>



			<li>
				<b>教員削除</b>
				<?php //エラーメッセージの表示
				if($message_delete!=NULL){
					echo "<br><font color='red'>".$message_delete."</font><br>";
					$_SESSION['mseg_delete']=NULL;
				}else{
					echo "<br>";
				}
				?>
				<ol>
					<form method="POST" action="delete_user.php">
						削除する教員ID：
						<br>
						<select name="user" class="form-control" style="font-size:20px; height:50px; width: 50%;">
							<?php
							$user_dir = dirname(__FILE__) . '/user_data';
							$i = 0;
							if ($user_dir = opendir($user_dir)) {
								while (false !== ($filename = readdir($user_dir))) {
									if ($filename != "." && $filename != "..") {
										//				echo $filename."<br>";
										$array = explode(".", $filename);
										$user_array[$i] = $array[0];
										echo '<option>' . $user_array[$i] . '</option>';
									}
									$i++;
								}
							}
							?>
						</select>
						<input type="radio" name="OK" value="ON">
						本当に削除する
						<input type="radio" name="OK" value="OFF" checked>
						削除しない
						<br>
						<button class="btn btn-danger" name="del_teacher" style="font-size: 20px; position: relative; left: 0px; top: 16px;text-align:center; text-align:center;">削除する</button>
					</form>
				</ol>
			</li>
			<br>


<!--
			<li>
				<b>全体の講義データ削除</b>
				<?php //エラーメッセージの表示
				if($message_lecture_error!=NULL){
					echo "<br><font color='red'>".$message_lecture_error."</font><br>";
					$_SESSION['mseg_lecture_error']=NULL;
				}elseif($message_lecture_success!=NULL){
					echo "<br><font color='blue'>".$message_lecture_success."</font><br>";
					$_SESSION['mseg_lecture_success']=NULL;
				}else{
					echo "<br>";
				}
				?>
				<ol>
					<form action="admin_lecture_delete.php" method="POST">
						<select name="lec" class="form-control" style="font-size:20px; height:50px; width: 50%;">
		<?php
			//csvファイルのチェック
			$csv = dirname(__FILE__).'/admin_data/lecture.csv';					#すべての講義を管理している管理者用CSVファイル
			$fp = fopen($csv,"r");
			$lecture = fgetcsv_reg($fp,null,',','"');
			mb_convert_variables("UTF-8", "SJIS", $lecture);#文字コード変更
		//	$lecture = mb_convert_encoding($lecture, 'sjis','UTF-8');
			fclose($fp);

			$i = 1;
			$check = 0;
			//while(!empty($lecture[$i])){
			//	echo '<option>'.$lecture[$i].'</option>';
			//	$i++;
			//}

			if ( ( $handle = fopen ( $csv, "r" ) ) !== FALSE ) {
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
		?>
				</select>
				<input type="radio" name="OK" value="ON">
				本当に削除する
				<input type="radio" name="OK" value="OFF" checked>
				削除しない
				<br>
				<button class="btn btn-danger" name="del_teacher" style="font-size: 20px; position: relative; left: 0px; top: 16px;text-align:center; text-align:center;">削除する</button>
				</ol>
			</li>
			<br>


-->









			<li>
				<b>管理者パスワード変更</b>
				<?php //エラーメッセージの表示
				if($message_error_admin!=NULL){
					echo "<br><font color='red'>".$message_error_admin."</font><br>";
					$_SESSION['mseg_error_admin']=NULL;
				}elseif($message_admin_success!=NULL){
					echo "<br><font color='blue'>".$message_admin_success."</font><br>";
					$_SESSION['mseg_success_admin']=NULL;
				}else{
					echo "<br>";
				}
				?>
				<ol>
					<form method="POST" action="admin_pass.php">
						新規パスワード(半角英数字)：
						<br>
						<input type="password" name='new_pass' autocomplete="off">
						<br>
						新規パスワード(確認用)：
						<br>
						<input type="password" name='sub_new_pass' autocomplete="off">
						<br>
						<button class="btn btn-primary" style="font-size: 20px; position: relative; left: 0px; top: 16px;text-align:center; text-align:center;">管理者パスワードの変更</button>
					</form>
				</ol>
			</li>
			<br>



<!--
			<li>
				<b>学生登録</b>
				<br>
				<br>
				<ol>
					<form method="POST" action="add_student.php">
						新規ユーザーID(半角英数字)：
						<br>
						<input type='text' name='new_studentId' autocomplete="off">
						<br>
						新規パスワード(半角英数字)：
						<br>
						<input type="password" name='new_studentPass' autocomplete="off">
						<br>
						新規パスワード(確認用)：
						<br>
						<input type="password" name='sub_new_studentPass' autocomplete="off">
						<br>
						登録する講義(講義名1は必ず入力してください)：
						<br>
						講義名1：
						<input type="text" name='new_studentLec_01' autocomplete="off">
						<br>
						講義名2：
						<input type="text" name='new_studentLec_02' autocomplete="off">
						<br>
						講義名3：
						<input type="text" name='new_studentLec_03' autocomplete="off">
						<br>
						<input type="submit" value="新規ユーザーを登録">
					</form>
				</ol>
			</li>
			<br>
			<li>
				<b>学生削除</b>
				<br>
				<br>
				<ol>
					<form method="POST" action="delete_student.php">
						削除するユーザーID：
						<br>
						<select name="student_user">
							<?php /*
							$student_dir = dirname(__FILE__) . '/../user_data';
							$i = 0;
							if ($student_dir = opendir($student_dir)) {
								while (false !== ($student_filename = readdir($student_dir))) {
									if ($student_filename != "." && $student_filename != "..") {
										//				echo $$student_filename."<br>";
										$student_array = explode(".", $student_filename);
										$student_array[$i] = $student_array[0];
										echo '<option>' . $student_array[$i] . '</option>';
									}
									$i++;
								}
							}
							*/
							?>
						</select>
						<br>
						<input type="radio" name="OK" value="ON">
						本当に削除する
						<input type="radio" name="OK" value="OFF" checked>
						削除しない
						<br>
						<input type="submit" value="削除する">
					</form>
					<br>
				</ol>
			</li>
		</ul>
		<hr>
-->
<form action='logout.php' method='post'>
<button class="btn btn-danger" style="font-size: 20px; position: relative; left: 0px; top: 16px;text-align:center; text-align:center;">ログアウト</button>
</form>
	</div>
	</body>
</html>
