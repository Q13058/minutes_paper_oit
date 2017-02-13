<?php
include_once '../teacher/function.php';
include_once './serch_keyword_log.php';
	// セッションの開始
	session_start();

	// ログインチェック
	if(!$_SESSION['studentid']){
		// ログインフォーム画面へ
		header('Location: login.php');
		// 終了
		exit();
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
<title>キーワードを検索</title>
<link rel="stylesheet" href="css/style.css">
<script src="../js/jquery-3.1.1.min.js"></script>
<script type="text/javascript"> /*実行コード*/
    $(function() {
        $(".autlink").each(function(){
            $(this).html( $(this).html().replace(/((http|https|ftp):\/\/[\w?=&.\/-;#~%-]+(?![\w\s?&.\/;#~%"=-]*>))/g, '<a href="$1">$1</a> ') );
        });
    })(jQuery);
</script>
</head>
<style>
em.language {background:#fffb44;}
</style>
<?php
  $sort = $_POST["sort"];
	$keyword = $_POST['keyword'];
	echo '<h1><font size = "5">「' . $keyword . '」が含まれるミニッツペーパー</font></h1>';
?>
<body>
<ol id="keyword_check">
<?php

	// MySQLへの接続
	$conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);

	if ($conn) {
		// データベースの選択
		mysql_select_db(DATABASE,$conn);

		$keyword = $_POST['keyword'];
		$lec = $_SESSION['lecture'];
		// データベースへの問い合わせSQL文
		$sql = 'SELECT number, question, answer, comment, reply, column1, column2, column3, column4, school_date FROM qanda WHERE lecture = "' . $_SESSION['lecture'] . '" AND question <> "未回答" AND question LIKE "%' . $keyword . '%" ';
		//$sql = 'SELECT number, question, answer, comment, reply, column1, column2, column3, column4, school_date FROM qanda WHERE lecture = "' . $_SESSION['lecture'] . '" AND question LIKE "%' . $keyword . '%" OR answer LIKE "%' . $keyword . '%"  OR comment LIKE "%' . $keyword . '%"  OR answer LIKE "%' . $keyword . '%" OR reply LIKE "%' . $keyword . '%" OR column1 LIKE "%' . $keyword . '%" OR column2 LIKE "%' . $keyword . '%" OR column3 LIKE "%' . $keyword . '%" OR column4 LIKE "%' . $keyword . '%" ';
    /*if($sort !== 'school_date'){
		//    $sql = 'SELECT number, question, answer, comment, reply, column1, column2, column3, column4, school_date FROM qanda WHERE lecture = "' . $_SESSION['lecture'] . '" AND question LIKE "%' . $keyword . '%" OR answer LIKE "%' . $keyword . '%"  OR comment LIKE "%' . $keyword . '%"  OR answer LIKE "%' . $keyword . '%" OR reply LIKE "%' . $keyword . '%" OR column1 LIKE "%' . $keyword . '%" OR column2 LIKE "%' . $keyword . '%" OR column3 LIKE "%' . $keyword . '%" OR column4 LIKE "%' . $keyword . '%" ';
    //}else{
    //    $sql = 'SELECT number, question, answer, comment, reply, column1, column2, column3, column4, school_date FROM qanda WHERE lecture = "' . $_SESSION['lecture'] . '" AND school_date LIKE "%' . $keyword . '%" ';
		}*/
		// ソート
		if ($sort != 'school_date') {
			$sql = $sql . ' ORDER BY ' . $sort ."DESC";
		}
		// SQL文の実行
		$query = mysql_query($sql, $conn);

		// データの取出し
		while($row=mysql_fetch_object($query)) {

			$sql3 = "SELECT `school_date`, `number`, `rgb`, `column_color`  FROM `color` WHERE `lecture`='{$lec}' AND `school_date`='{$row->school_date}' AND `column_color`='{$row->answer}'  ORDER BY `school_date`";
			$query3 = mysql_query($sql3, $conn);
			$row3 = mysql_fetch_object($query3);
			$color=$row3->rgb;
			if($color=='0' || $color==NULL){
				$color=FFFFFF;
			}else{
				$color=dechex($color);
			}


		if(!$row->question)$row->question = '-';
		if(!$row->answer)$row->answer = '-';
		if(!$row->comment)$row->comment = '-';
		if(!$row->reply)$row->reply = '-';
		if(!$row->column1)$row->column1 = '-';
		if(!$row->column2)$row->column2 = '-';
		if(!$row->column3)$row->column3 = '-';
		if(!$row->column4)$row->column4 = '-';

				$sql2 = "SELECT `question1`, `question2`, `question3`, `question4`, `question5`, `question6`, `question7`, `question8`, `school_date`, `count` FROM `question` WHERE `lecture`='{$lec}' AND `school_date`='{$row->school_date}' ORDER BY `school_date`";
				$query2 = mysql_query($sql2, $conn);

			while($row2 = mysql_fetch_object($query2)){
				$num = $row2->count;
				if($num ==0) $num =4;//表示数の数を初期化（４項目がデフォルト）

				echo	"<div style=\" margin-left: auto; margin-right: auto;;\">";
							if($row->number == $_SESSION['studentid']) echo "<table class= codermine >";
							else  echo "<table class= coder>";
							//色を指定
							if($row->number == $_SESSION['studentid']){
								$color_background = "background-color:#ff9966;";
							}else{
								$color_background = "background-color:#aaffc2;";
							}
				switch ($num){
					case "4":
echo<<<HTML
					<caption>{$row->school_date}の{$lec}</caption>
					<thead>
					<tr><th style = "background:#f9f9db;">質問</th><th style = "background:#f9f9db;">自分の回答</th></tr>
					</thead>
					<tbody>
					<tr><th width = "50%" style = "{$color_background}">{$row2->question1}</th><td width = "50%">{$row->question}</td></tr>
					<tr>
						<th width = "50%" style = "{$color_background}">{$row2->question2}</th>
						<td width = "50%" bgcolor={$color}>{$row->answer}</td>
					</tr>
HTML;
					if($row->comment != "-" || $row->reply != "-" ){
						echo "<tr><th width = 50% style = " . $color_background . ">".$row2->question3."</th><td width = 50%>".$row->comment."</td></tr>";
						echo "<tr><th width = 50% style = " . $color_background . ">".$row2->question4."</th><td width = 50%>".$row->reply."</td></tr>";
					}
echo<<<HTML
					</tbody>
					</table>
					</div><br><br><br>
HTML;
					break;

					case "5":
echo<<<HTML
					<caption>{$row->school_date}の{$lec}</caption>
					<thead>
					<tr><th style = "background:#f9f9db;">質問</th><th style = "background:#f9f9db;">自分の回答</th></tr>
					</thead>
					<tbody>
					<tr><th width = "50%">{$row2->question1}</th><td width = "50%">{$row->question}</td></tr>
					<tr><th width = "50%">{$row2->question2}</th><td width = "50%">{$row->answer}</td></tr>
					<tr><th width = "50%">{$row2->question3}</th><td width = "50%">{$row->comment}</td></tr>
					<tr><th width = "50%">{$row2->question4}</th><td width = "50%">{$row->reply}</td></tr>
					<tr><th width = "50%">{$row2->question5}</th><td width = "50%">{$row->column1}</td></tr>
					</tbody>
					</table>
					</div><br><br>
HTML;
					break;

					case "6":
echo<<<HTML
					<caption>{$row->school_date}の{$lec}</caption>
					<thead>
					<tr><th style = "background:#f9f9db;">質問</th><th style = "background:#f9f9db;">自分の回答</th></tr>
					</thead>
					<tbody>
						<tr><th width = "50%" style = "{$color_background}">{$row2->question1}</th><td width = "50%">{$row->question}</td></tr>
						<tr>
							<th width = "50%" style = "{$color_background}">{$row2->question2}</th>
							<td width = "50%" bgcolor={$color}>{$row->answer}</td>
						</tr>
HTML;
					if($row->comment != "-" || $row->reply != "-" ){
						echo "<tr><th width = 50% style = " . $color_background . ">".$row2->question3."</th><td width = 50%>".$row->comment."</td></tr>";
						echo "<tr><th width = 50% style = " . $color_background . ">".$row2->question4."</th><td width = 50%>".$row->reply."</td></tr>";
					}
					if($row->column1 != "-" || $row->column2 != "-" ){
						echo "<tr><th width = 50% style = " . $color_background . ">".$row2->question5."</th><td width = 50%>".$row->column1."</td></tr>";
						echo "<tr><th width = 50% style = " . $color_background . ">".$row2->question6."</th><td width = 50% style='word-break: break-all;' class= 'autlink'>".$row->column2."</td></tr>";
					}
echo<<<HTML
					</tbody>
					</table>
					</div><br><br>
HTML;
					break;

					case "7":
echo<<<HTML
					<div align = "center">
					<table class="coder">
					<caption>{$row->school_date}の{$lec}</caption>
					<thead>
					<tr><th style = "background:#f9f9db;">質問</th><th style = "background:#f9f9db;">自分の回答</th></tr>
					</thead>
					<tbody>
					<tr><th width = "50%">{$row2->question1}</th><td width = "50%">{$row->question}</td></tr>
					<tr><th width = "50%">{$row2->question2}</th><td width = "50%">{$row->answer}</td></tr>
					<tr><th width = "50%">{$row2->question3}</th><td width = "50%">{$row->comment}</td></tr>
					<tr><th width = "50%">{$row2->question4}</th><td width = "50%">{$row->reply}</td></tr>
					<tr><th width = "50%">{$row2->question5}</th><td width = "50%">{$row->column1}</td></tr>
					<tr><th width = "50%">{$row2->question6}</th><td width = "50%">{$row->column2}</td></tr>
					<tr><th width = "50%">{$row2->question7}</th><td width = "50%">{$row->column3}</td></tr>
					</tbody>
					</table>
					</div><br><br>
HTML;
					break;

					case "8":
echo<<<HTML
					<caption>{$row->school_date}の{$lec}</caption>
					<thead>
					<tr><th style = "background:#f9f9db;">質問</th><th style = "background:#f9f9db;">自分の回答</th></tr>
					</thead>
					<tbody>
					<tr><th width = "50%" style = "{$color_background}">{$row2->question1}</th><td width = "50%">{$row->question}</td></tr>
					<tr><th width = "50%" style = "{$color_background}">{$row2->question2}</th><td width = "50%">{$row->answer}</td></tr>
HTML;
					if($row->comment != "-" || $row->reply != "-" ){
						echo "<tr><th width = 50% style = " . $color_background . ">".$row2->question3."</th><td width = 50%>".$row->comment."</td></tr>";
						echo "<tr><th width = 50% style = " . $color_background . ">".$row2->question4."</th><td width = 50%>".$row->reply."</td></tr>";
					}
					if($row->column1 != "-" || $row->column2 != "-" ){
						echo "<tr><th width = 50% style = " . $color_background . ">".$row2->question5."</th><td width = 50%>".$row->column1."</td></tr>";
						echo "<tr><th width = 50% style = " . $color_background . ">".$row2->question6."</th><td width = 50% style='word-break: break-all;' class= 'autlink'>".$row->column2."</td></tr>";
					}
					if($row->column3 != "-" || $row->column4 != "-" ){
						echo "<tr><th width = 50% style = " . $color_background . ">".$row2->question7."</th><td width = 50%>".$row->column3."</td></tr>";
						echo "<tr><th width = 50% style = " . $color_background . ">".$row2->question8."</th><td width = 50%>".$row->column4."</td></tr>";
					}
echo<<<HTML
					</tbody>
					</table>
					</div><br><br>
HTML;
					break;
				}
			}
		}
	}
?>
</table>
</div><br>
<br>
</ol>
<button class="btn" type="button" onclick="location.href='top.php'">メニューへ戻る</button>
<button class="btn" type="button" onclick="location.href='keyserch.php'">検索画面へ戻る</button>
<br><br>
<?php
	echo $_SESSION['lecture'] . 'のミニッツペーパー';
?>
<script>

// テキストノードだけを集める
function getTextNode (node) {
	return (3 === node.nodeType)
				 ? [node]
				 : (node.hasChildNodes ())
					 ? Array.prototype.concat.apply ([],
								Array.prototype.map.call (node.childNodes, arguments.callee))
					 : [];
}


/*
 * nodo に、this.text と同じ文字列が含まれていれば、this.referenceTag を複写して
 * ノードを挿入する
 */
function wardWrap (node) {
	var t, i;
	var len = this.text.length;

	while (-1 < (i = node.data.lastIndexOf (this.text))) {
		node.parentNode.insertBefore (this.referenceTag.cloneNode (true), node.splitText (i + len));
		node.data = node.data.substring (0, i);
	}
}


/*
 * 指定要素以下のテキストを集め、対象となる文字を指定ノードで置き換える
 */
function textMaker (target, referenceTag, matchStr) {
	getTextNode (target).forEach (wardWrap,
			{'referenceTag': referenceTag, 'text': matchStr || referenceTag.textContent});
}

var str = <?php echo json_encode($keyword); ?>;
var em = document.createElement ('em');

em.appendChild (document.createTextNode (str));
em.className = 'language';

textMaker (document.getElementById ('keyword_check'), em);

</script>
</body>
</html>
