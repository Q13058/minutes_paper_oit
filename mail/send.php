<?php
//以下ユーザー確認メール
//info@example.comを、あなたのメールアドレスにすることでこのメールフォームをそのまま使えます。
session_start();//ページ移動したら再びsession_start

$add_header="From:info@example.com\r\n";
$add_header	.= "Reply-to: info@example.com\r\n";
$add_header	.= "X-Mailer: PHP/". phpversion();
$opt = '-f'.'info@example.com'; //-fって何か意味あったんだけど忘れました　-fすると迷惑メールになりにくいとか、そんなことだったと思う。

//以下ヒアドキュメント<<<●●　HTMLでも、文字列でも、何いれてもOK●●;
//ヒアドキュメントは、メール送信とかの定型文を書いたりするとき、あとはSQLを書くときも使うかな。
//ヒアドキュメント内ではPHPのプログラムは一切かけない。変数だけ。変数は{}で囲ってあげること
//メールの本文をここでひとまとめに。
$message =<<<HTML
お問い合わせ内容の確認です。

お名前
{$_SESSION['name']}

E_mail
{$_SESSION['e_mail']}

お問い合わせ内容
{$_SESSION['comment']}

内容確認後、担当者より折り返しご連絡をさせて頂きます。
今しばらくお待ちください。

HTML;

// カレントの言語を日本語に設定する
mb_language("ja");
// 内部文字エンコードを設定する　このエンコード指定は大昔の携帯だとShift-jisにしないとだめだったとか。
// 今はUTF-8にしておけばだいたいOKだから、楽な時代になったもんだよ。
mb_internal_encoding("UTF-8");

mb_send_mail($_SESSION['e_mail'],"【お問い合わせ】確認メール",$message,$add_header,$opt);
//mb_send_mailは5つの設定項目がある
//mb_send_mail(送信先メールアドレス,"メールのタイトル","メール本文","メールのヘッダーFromとかリプライとか","送信エラーを送るメールアドレス");
//5番目の情報は第5引数と呼ばれるものでして、これがないと迷惑メール扱いになることも。



//マスター管理者にも同じメールを送りつける！！
mb_send_mail('info@example.com',"お問い合わせがありました",$message,$add_header,$opt);

session_destroy();  // セッションを破棄
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
    border-right: 1px solid #CCCCCC;
    border-top: 1px solid #CCCCCC;
    padding: 5px 8px;
}
</style>
</head>

<body>
<p>送信完了しました</p>
</body>
</html>
