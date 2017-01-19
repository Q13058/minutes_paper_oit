<?php
	include_once './teacher/function.php';

	// セッションの開始
	session_start();
	$_SESSION['lecture'] = "";
 	if(!$_SESSION['studentid']){
 		header('Location: login.php');
		// 終了
		exit();
 	}

	$conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);
	if ($conn) {
                // データベースの選択
                mysql_select_db(DATABASE,$conn);
		$sql = "SELECT DISTINCT `teacher` FROM `qanda`";
		$i=0;
		$j=0;
		 $query = mysql_query($sql, $conn);
		 while($row=mysql_fetch_object($query)) {
			$teacher[$i]=$row->teacher;
			$i++;
		
		$sql2 = "SELECT DISTINCT `lecture` FROM `qanda` WHERE `teacher`='{$teacher[0]}'";
		$query2 = mysql_query($sql2, $conn);
		$j=0;
		while($row2=mysql_fetch_object($query2)) {
		$lec[$i][$j]=$row2->lecture;
		$j=$j++;
		}
		}
		}
?>


 <!DOCTYPE html>
<html lang="ja" >
	<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<title>ミニッツペーパー管理システム</title>
	</head>
	<body>
	<script src="http//code.jquery.com/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
	<script src="http//code.jquery.com/jquery.js"></script>
	<script src="./bootstrap-dropdown.js"></script>
	Login: <b><?php echo $_SESSION['studentid']; ?></b>
	<hr>
	 <div class="container">
	<h1>講義選択画面</h1><br>
	<form  name="selbox"  action="top.php" method="POST">

	<p>教員を選んで下さい</p>
	<select name="league" onchange="teamSet()">
	<option value="">教員選択</option>
	<?php
	var_dump($teacher[0]);
	echo '<option value="">'.$teacher[1].'</option>';
	?>
	</select>



	<br><br>
	<p>講義を選んで下さい</p>
	<select name="lec">
	<option value="">講義選択</option>
	<option value=""></option>
	<option value=""></option>
	<option value=""></option>
	<option value=""></option>
	<option value=""></option>
	<option value=""></option>
	</select>


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
	<br><hr>
	
	<button class="btn btn-primary">
                        <span class="glyphicon glyphicon-hand-down"> 次へ
                        </button>
	<hr>
	<a href="logout.php">【ログアウト】</a>
	<hr>
	</div>
	</form>


	<script>

//セ・リーグのチームの配列

var lec1=new Array(
"","<?php echo $lec[1][0]?>","<?php echo $lec[1][1]?>","<?php echo $lec[1][2]?>"
);



function teamSet(){
	var myNum = lec1.length;
	alert(myNum)
	

  //オプションタグを連続して書き換える
  for ( i=1; i<4; i++ ){

    //選択したリーグによって分岐
    switch (document.selbox.league.selectedIndex){
      case 0:document.selbox.lec.options[i].text="";break;
      case 1:	
	document.selbox.lec.options[i].text=lec1[i];
	document.selbox.lec.options[i].value=lec1[i];break;
      case 2: document.selbox.lec.options[i].text=p_league[i];break;
    }
  }

  //チーム名のセレクトボックスの選択番号を０にする
  document.selbox.lec.selectedIndex=0;
}

</script>



	</body>
</html>
