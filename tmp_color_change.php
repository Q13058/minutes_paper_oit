<style type="text/css">
 .FFFFFF{
background-Color:white;
 }
 .808080{
 background-Color:gray;
 }
 .0000FF{
 background-Color:blue;
 }
.FF0000{
 background-Color:red;
 }
.FFFF00{
 background-Color:yellow;
 }
.cyan{
 background-Color:cyan;
 }
.BlanchedAlmond{
 background-Color:BlanchedAlmond;
 }
.LightGreen{
background-Color:LightGreen;
 }
.LightPink{
background-Color:LightPink;
 }
.LightCoral{
background-Color:LightCoral;
}
 </style> 	

<script type="text/javascript">
 
        function dblclick(){
        document.getElementById('t1').className='white';
        }

        function onButtonClick() {
      selindex = document.form1.Select1.selectedIndex;
      target = document.getElementById("output");
      switch (selindex) {
        case 0:
          target.innerHTML = "FFFFFF";
          break;
        case 1:
          target.innerHTML = "0000FF";
          break;
        case 2:
          target.innerHTML = "FF0000";
          break;
        case 3:
          target.innerHTML = "808080";
          break;
        case 4:
          target.innerHTML = "FFFF00";
          break;
        case 5:
          target.innerHTML = "cyan";
          break;
        case 6:
          target.innerHTML = "BlanchedAlmond";
          break;
	case 7:
          target.innerHTML = "LightGreen";
          break;
	case 8:
          target.innerHTML = "LightPink";
          break;
	case 9:
          target.innerHTML = "LightCoral";
          break;
      }
	alert(target.innerHTML);
    }

    </script>

<?php
	$ua=$_SERVER['HTTP_USER_AGENT'];
	if((strpos($ua,'iPhone')!==false)||(strpos($ua,'iPod')!==false)||(strpos($ua,'Android')!==false)) {
	    header('Location: ./sp/mine.php');
	    exit();
	}

	include_once './teacher/function.php';
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <link rel="stylesheet" href="sample.css">
<title>Q&A</title>
</head>
<?php
	
?>
<body>
 <div id="pagebody">

	<!-- ヘッダ -->
	<div id="header"><h1>ミニッツペーパ閲覧システム</h1></div>
	<ul id="menu">
		<li id="menu01"><a href="top.php">トップ画面</a></li>
		<li id="menu01"><a href="date.php">講義日から探す</a></li>
		<li id="menu01"><a href="keyserch.php">単語検索</a></li>
		<li id="menu01"><a href="chart.php">提出率のグラフ</a></li>
		
		
		
	</ul>
	<form name="form1" action="">
    <select id="Select1"" onchange="onButtonClick();">
      <option>white</option>
      <option>blue</option>
      <option>red</option>
      <option>gray</option>
      <option>yellow</option>
      <option>cyan</option>
      <option>BlanchedAlmond</option>
      <option>LightGreen</option>
      <option>LightPink</option>
       <option>LightCoral</option>
    </select>
  </form>
	<div id="output"></div>
<br>

</div>
	<br><br>

	<?php
	// MySQLへの接続
	$conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);
	$num =0;
	$cnt2=0;
	$flag4=0;
	$flag5=0;
	$flag6=0;
	$flag7=0;
	$flag8=0;
	$myid2=1;
	$myid3=100;
	$myid4=200;
	$myid5=300;
	$myid6=400;
	$name = "output";
	if ($conn) {
		// データベースの選択
		mysql_select_db(DATABASE,$conn);
			//$sql = "SELECT `num`, `number`, `question`, `answer`, `comment`, `reply`, `column1`, `column2`, `column3`, `column4`,`school_date`,`present` FROM `qanda` ORDER BY `num`, `school_date`";
		$sql = 'SELECT * FROM `qanda` WHERE 1';
		// SQL文の実行
		$query = mysql_query($sql, $conn);

			echo '<div id="this">';

			while($row=mysql_fetch_object($query)) {

			//空値に－を代入して見た目を綺麗に
			if(!$row->question)$row->question = '-';
			if(!$row->answer)$row->answer = '-';
			if(!$row->comment)$row->comment = '-';
			if(!$row->reply)$row->reply = '-';
			if(!$row->column1)$row->column1 = '-';
			if(!$row->column2)$row->column2 = '-';
			if(!$row->column3)$row->column3 = '-';
			if(!$row->column4)$row->column4 = '-';

		$sql2 = "SELECT `question1`, `question2`, `question3`, `question4`, `question5`, `question6`, `question7`, `question8`, `school_date`, `count` FROM `question` WHERE `school_date`='{$row->school_date}' ORDER BY `count`,`school_date`";
		$query2 = mysql_query($sql2, $conn);


	
			while($row2 = mysql_fetch_object($query2)){

			$sql3 = "SELECT `school_date`, `number`, `rgb`, `c`  FROM `color` WHERE `school_date`='{$row->school_date}' AND `number`='{$row->number}' AND `c`='{$row->answer}'  ORDER BY `school_date`";


			$query3 = mysql_query($sql3, $conn);

                        $row3 = mysql_fetch_object($query3);
                        $num = $row2->count;
                        if($num ==0){
                         $num =4;
                        }
                        $color=$row3->rgb;
                        if($color=='000000'){
                        $color=FFFFFF;
                        }

			$num = $row2->count;
			$myid="t1";
			if($num ==0){
			 $num =4;
			}
			switch ($num){
				case "4":
				if($flag4==0){
				echo '<table  border="1" align="center">';
                		echo '<tr bgcolor="#CCCCCC">';
				?>
                		<td   id="<?php echo $myid ?>" onclick="document.getElementById('<?php echo $myid ?>').className=document.getElementById('output').innerHTML,  ajaxPost('<?php echo $name ?>','<?php echo $myid ?>','<?php echo $row->number ?>','<?php echo $row->school_date ?>');" ondblclick="document.getElementById('t1').className='white';"  width="80" align="center" >講義日</td>
				

				<?php
         	       		echo '<td width="500" align="center">質問とその回答</td>';
                		echo '<td width="300">-</td>';
                		echo '<td width="200">-</td>';
                		echo '<td width="100">-</td>';
				echo '</tr>';
                		echo '<tr>';
                		echo '<tr bgcolor="#CCCCFF">';
                		echo '<td width="80">' . $row2->school_date .'</td>';
                		echo '<td width="300">' . $row2->question1 .'</td>';
                		echo '<td width="300" align="center">' . $row2->question2 .'</td>';
                		echo '<td width="100">' . $row2->question3 .'</td>';
                		echo '<td width="100">' . $row2->question4 .'</td>';
                		echo '</tr>';
                		echo '</table>';
				$flag4=$flag4+1;
				}
				echo '<table border="1" align="center">';
				echo '<tr>';
				?>
				<td id="<?php echo $myid2 ?>" onclick="document.getElementById('<?php echo $myid2 ?>').className=document.getElementById('output').innerHTML;" ondblclick="document.getElementById('<?php echo $myid2 ?>').className='white';"  width="80"> <?php echo $row->school_date ?> </td>
				
				<td   id="<?php echo $myid3 ?>" onclick="document.getElementById('<?php echo $myid3 ?>').className=document.getElementById('output').innerHTML;" ondblclick="document.getElementById('<?php echo $myid3 ?>').className='white';"  width="500"> <?php echo $row->question ?></td>
				
				<td id="<?php echo $myid4 ?>" onclick="document.getElementById('<?php echo $myid4 ?>').className=document.getElementById('output').innerHTML;" ondblclick="document.getElementById('<?php echo $myid4 ?>').className='white';"  width="300"> <?php echo $row->answer ?></td>

				<td   id="<?php echo $myid5 ?>" onclick="document.getElementById('<?php echo $myid5 ?>').className=document.getElementById('output').innerHTML;" ondblclick="document.getElementById('<?php echo $myid5 ?>').className='white';"  width="200"> <?php echo $row->comment ?></td>

				<td  id="<?php echo $myid6 ?>" onclick="document.getElementById('<?php echo $myid6 ?>').className=document.getElementById('output').innerHTML;" ondblclick="document.getElementById('<?php echo $myid6 ?>').className='white';"   width="100"><?php echo $row->reply ?> </td>
				
				

				<?php
				echo'</tr>';
				echo "</table>";
				$myid2=$myid2+1;
				$myid3=$myid3+1;
				$myid4=$myid4+1;
                                $myid5=$myid5+1;
				$myid6=$myid6+1;
				break;

				case "5":


				 $sql3 = "SELECT `school_date`, `number`, `rgb`, `c`  FROM `color` WHERE `school_date`='{$row->school_date}' AND `number`='{$row->number}' AND `c`='{$row->answer}'  ORDER BY `school_date`";

                $query3 = mysql_query($sql3, $conn);

                        $row3 = mysql_fetch_object($query3);
                         $color=$row3->rgb;
			 if($color=='000000'OR $color==NULL){
                        $color=FFFFFF;
                        }

			var_dump($color);
				if($flag5==0){
				echo "<br>";
                		echo '<table  border="1" align="center">';
                		echo '<tr bgcolor="#CCCCCC">';
                		echo '<td width="80" align="center" >講義日</td>';
                		echo '<td width="500" align="center">質問とその回答</td>';
                		echo '<td width="300">-</td>';
                		echo '<td width="200">-</td>';
                		echo '<td width="100">-</td>';
			        echo '<td width="100" >-</td>';
                		echo '</tr>';
                		echo '<tr>';
                		echo '<tr bgcolor="#CCCCFF">';
                		echo '<td width="80">' . $row2->school_date .'</td>';
                		echo '<td width="500">' . $row2->question1 .'</td>';
                		echo '<td width="300">' . $row2->question2 .'</td>';
                		echo '<td width="200">' . $row2->question3 .'</td>';
                		echo '<td width="100">' . $row2->question4 .'</td>';
                		echo '<td width="100">' . $row2->question5 .'</td>';
                		echo '</tr>';
                		echo "</table>";
				$flag5=$flag5+1;
				}
				echo '<table border="1" align="center">';
				echo '<tr>';
				echo '<td width="80" >' . $row->school_date .'</td>';
				echo '<td width="500">' . $row->question .'</td>';
				echo '<td width="300">' . $row->answer .'</td>';
				?>
				<td width="200"  bgcolor="<?php print $color;?>"><?php  $row->comment;?></td>
				<?php
				echo '<td width="100">' . $row->reply .'</td>';
				echo '<td width="100">' . $row->column1 .'</td>';
				echo '</tr>';
				echo "</table>";
				break;

				case "6":

				if($flag6==0){
                		echo '<table  border="1" align="center">';
                		echo '<tr bgcolor="#CCCCCC">';
                		echo '<td width="80" align="center" >講義日</td>';
                		echo '<td width="500" align="center">質問とその回答</td>';
                		echo '<td width="300">-</td>';
                		echo '<td width="200">-</td>';
                		echo '<td width="100">-</td>';
				echo '<td >-</td>';
                		echo '<td >-</td>';
                		echo '</tr>';
                		echo '<tr>';
                		echo '<tr bgcolor="#CCCCFF">';
                		echo '<td>' . $row2->school_date .'</td>';
                		echo '<td>' . $row2->question1 .'</td>';
                		echo '<td>' . $row2->question2 .'</td>';
                		echo '<td>' . $row2->question3 .'</td>';
                		echo '<td>' . $row2->question4 .'</td>';
                		echo '<td>' . $row2->question5 .'</td>';
                		echo '<td>' . $row2->question6 .'</td>';
                		echo '</tr>';
                		echo "</table>";
				$flag6=$flag6+1;
				}	
				echo '<table border="1" align="center">';
				echo '<tr>';
				echo '<td>' . $row->school_date .'</td>';
				echo '<td>' . $row->question .'</td>';
				echo '<td>' . $row->answer .'</td>';
				echo '<td>' . $row->comment .'</td>';
				echo '<td>' . $row->reply .'</td>';
				echo '<td>' . $row->column1 .'</td>';
				echo '<td>' . $row->column2 .'</td>';
				echo '</tr>';
				echo "</table>";
				break;

				case "7":

				if($flag7==0){
                		echo '<table  border="1" align="center">';
                		echo '<tr bgcolor="#CCCCCC">';
                		echo '<td width="80" align="center" >講義日</td>';
                		echo '<td width="500" align="center">質問とその回答</td>';
                		echo '<td width="300">-</td>';
                		echo '<td width="200">-</td>';
                		echo '<td width="100">-</td>';
				echo '<td >-</td>';
                		echo '<td >-</td>';
                		echo '<td >-</td>';
                		echo '</tr>';
                		echo '<tr>';
                		echo '<tr bgcolor="#CCCCFF">';
                		echo '<td>' . $row2->school_date .'</td>';
                		echo '<td>' . $row2->question1 .'</td>';
                		echo '<td>' . $row2->question2 .'</td>';
                		echo '<td>' . $row2->question3 .'</td>';
                		echo '<td>' . $row2->question4 .'</td>';
                		echo '<td>' . $row2->question5 .'</td>';
                		echo '<td>' . $row2->question6 .'</td>';
                		echo '<td>' . $row2->question7 .'</td>';
                		echo '</tr>';
                		echo "</table>";
				$flag7=$flag7+1;
				}

				echo '<table border="1" align="center">';
				echo '<tr>';
				echo '<td>' . $row->school_date .'</td>';
				echo '<td>' . $row->question .'</td>';
				echo '<td>' . $row->answer .'</td>';
				echo '<td>' . $row->comment .'</td>';
				echo '<td>' . $row->reply .'</td>';
				echo '<td>' . $row->column1 .'</td>';
				echo '<td>' . $row->column2 .'</td>';
				echo '<td>' . $row->column3 .'</td>';
				echo '</tr>';
				echo "</table>";
				break;

				case "8":

				if($flag8==0){
                		echo '<table  border="1" align="center">';
                		echo '<tr bgcolor="#CCCCCC">';
                		echo '<td width="80" align="center" >講義日</td>';
                		echo '<td width="500" align="center">質問とその回答</td>';
                		echo '<td width="300">-</td>';
                		echo '<td width="200">-</td>';
                		echo '<td width="100">-</td>';
				echo '<td >-</td>';
                		echo '<td >-</td>';
                		echo '<td >-</td>';
                		echo '<td >-</td>';
                		echo '</tr>';
                		echo '<tr>';
                		echo '<tr bgcolor="#CCCCFF">';
                		echo '<td>' . $row2->school_date .'</td>';
                		echo '<td>' . $row2->question1 .'</td>';
                		echo '<td>' . $row2->question2 .'</td>';
                		echo '<td>' . $row2->question3 .'</td>';
                		echo '<td>' . $row2->question4 .'</td>';
                		echo '<td>' . $row2->question5 .'</td>';
                		echo '<td>' . $row2->question6 .'</td>';
                		echo '<td>' . $row2->question7 .'</td>';
                		echo '<td>' . $row2->question8 .'</td>';
                		echo '</tr>';
                		echo "</table>";
				$flag8=$flag8+1;
                                }

				echo '<table border="1" align="center">';
				echo '<tr>';
				echo '<td>' . $row->school_date .'</td>';
				echo '<td>' . $row->question .'</td>';
				echo '<td>' . $row->answer .'</td>';
				echo '<td>' . $row->comment .'</td>';
				echo '<td>' . $row->reply .'</td>';
				echo '<td>' . $row->column1 .'</td>';
				echo '<td>' . $row->column2 .'</td>';
				echo '<td>' . $row->column3 .'</td>';
				echo '<td>' . $row->column4 .'</td>';
				echo '</tr>';
				echo "</table>";
				break;
				}
			}
		}
				echo '</div>';
	
}
?>
 <div id="ichigo"></div>

<br>
  <div id="output"></div>

<br>
<li><a href="top.php">メニューへ戻る</a>
<br><br>
</body>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
  function ajaxPost(param1,param2,param3,param4){
    $.post("color_change.php", {


      input1:param1
      input2:param2
      input3:param3
      input4:param4
    },function(json){
     alert(param1);
     alert(param2);
     alert(param3);
     alert(param4);
    });
  }

</script>



</html>
