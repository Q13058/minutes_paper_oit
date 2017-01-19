<?php
//mail.phpのPostをSessionに代入する。
//Postは次のページまでしか引き継ぐことが出来ません
//確認ページ、送信ページとページをまたぐ際はこのSessionを使うのが普通です。
//そのため、フォームの確認ページなどで一度Sessionに代入する必要があります。

//いきなり確認画面にアクセスがあれば不正アクセス。
//!$_POSTで　$_POSTがSetされているかをチェックし、セットされていなければリダイレクト
if(!$_POST){
header('Location: http://www.example.com/');//	headerlocationはPHPのリダイレクト処理でよく使う。
	}

//Sessionを開始するときの決まり文句、これがないとSessionが開始できない
session_start();
$_SESSION = $_POST;

//無事Sessionに保存できているかチェックする

echo '<pre>';//HTMLのpreタグを使うと、配列が見やすくなる
print_r($_SESSION);//print_rとは、配列を出力する関数
echo '</pre>';



?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>シンプルなメールフォーム</title>
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
    border-right: 1px solid #CCCCCC;ｖ
    border-top: 1px solid #CCCCCC;
    padding: 5px 8px;
}
</style>
</head>

<body>
<form id="contact-form" action="./send.php" method="post">
					<input type="hidden" name="sub_actions" value="confirm">
					<table>
					<tbody>
					<tr>
					<th>お名前</th>
					<td><?php echo htmlspecialchars($_POST['name']);?></td>
					</tr>
					<tr>
					<th>メールアドレス</th>
					<td><?php echo htmlspecialchars($_POST['e_mail']);?></td>
					</tr>
					<tr>
					<th style="vertical-align:top;">お問い合わせ内容</th>
					<td><?php echo htmlspecialchars($_POST['comment']);?>
					</td>
					</tr>
					</tbody>
					</table>

					<div class="bt">
                    <p>PCやスマホのメールフォームの修正ボタンなんかhistory.back()で十分！</p>
                    <a href="javascript:history.back();">
<input type="button" value="戻る">
</a>
					<input type="submit" value="送信" name="submit">
					</div>
					</form>
</body>
</html>
