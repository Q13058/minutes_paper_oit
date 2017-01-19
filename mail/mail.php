<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>シンプルなメールフォーム</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="./js/jQuery.validation.js"></script>
<script type="text/javascript" src="./js/reserve.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#contact-form").validate({
rules : {
name:{required: true}
},
errorClass: "myError"

});
});
</script>

<style>
#contact-form th{
    background-color: #F8F8F8;
    border-color: #CCCCCC #CCCCCC #CCCCCC #333333;
    border-left: 3px solid #333333;
    border-right: 1px dotted #CCCCCC;
    border-style: solid dotted solid solid;
    border-width: 1px 1px 1px 3px;
    padding: 5px 8px;
    width: 200px;
}

#contact-form td{
background-color: #FFFFFF;
    border-bottom: 1px solid #CCCCCC;
    border-right: 1px solid #CCCCCC;
    border-top: 1px solid #CCCCCC;
    padding: 5px 8px;
}

input.myError {
background-color:#CCFFFF;
}

label.myError {
color:#FF0000;
}

textarea.myError {
background-color:#CCFFFF;
}
</style>
</head>

<body>
<form id="contact-form" action="./check.php" method="post">
					<input type="hidden" name="sub_actions" value="confirm">
					<table>
					<tbody>
					<tr>
					<th>お名前</th>
					<td><input type="text" class="required" name="name" value=""></td>
					</tr>
					<tr>
					<th>メールアドレス</th>
					<td><input type="text" class="required email" name="e_mail" value=""></td>
					</tr>
					<tr>
					<th style="vertical-align:top;">お問い合わせ内容</th>
					<td><textarea name="comment" rows="4" cols="40"></textarea>
					</td>
					</tr>
					</tbody>
					</table>
					<div class="bt">
					<input type="submit" value="確認画面へ" name="submit">
					</div>
					</form>
</body>
</html>