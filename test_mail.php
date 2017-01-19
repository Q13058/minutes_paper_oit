<?php 
$to ="e1q11063@st.oit.ac.jp";
$subject="テスト送信";
$message="ただいまメールのテスト中です";
$add_header="FROM:e1q11093@st.oit.ac.jp";

if(mb_send_mail($to,$subject,$message,$add_header)){
print "メールを送信しました";
}else{
print"メール送信に失敗しました";
}
?>
