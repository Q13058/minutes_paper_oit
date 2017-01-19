<?php
 $header = "MIME-Version: 1.0\r\n"
	  . "Content-Transfer-Encoding: 7bit\r\n"
	  . "Content-Type: text/plain; charset=ISO-2022-JP\r\n"
	  . "Message-Id: <" . md5(uniqid(microtime())) . "@ドメイン>\r\n"
	  . "From: サイト名 <e1q11093@st.oit.ac.jp>\r\n";
$body = "内容";
mb_send_mail("e1q11093@st.oit.ac.jp", "件名", $body, mb_encode_mimeheader($header), "-f http://d.hatena.ne.jp/naohide_a/20110704/1309750497");
?>
