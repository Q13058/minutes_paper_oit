<?php
	// �Z�b�V�����̊J�n
	session_start();
/*
	// ���O�C���`�F�b�N
	if(!$_SESSION['login']){
		// ���O�C���t�H�[����ʂ�
		header('Location: login.php');
		// �I��
		exit();
	}
 */
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<title>Excel�t�@�C���A�b�v���[�h</title>
</head>
<body>
���A�b�v���[�h����Excel�t�@�C������͂��Ă��������B
<br>
<form action="insert_excel.php" method="POST" enctype="multipart/form-data">
Excel�t�@�C���F
<br>
<input type="file" name="filename" size="50">
<br><br>
���Ɠ�����͂��Ă��������B(��F20110906)
<br>
<input type="text" name="day" size="40" autocomplete="off" value="">
<br><br>
<input type="submit" value="�A�b�v���[�h">
</form>
<br>
<li><a href="top.php">���j���[�ɖ߂�</a>
</body>
</html>
