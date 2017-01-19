 <?php
        $org_timezone = date_default_timezone_get();
date_default_timezone_set('Asia/Tokyo');
?>
<?php
    $log_fl = "./acc_log4.csv";
    //$date = '2013-01-01 00:00:00';
    //$log_ln[0] = date('Y/m/d', strtotime($date));
        $timestamp = time();
        $log_ln[0] = date('Y-m-d H:i:s' ,  strtotime("+1 day +5 hour -10 minute"));
// 日時
    //$log_ln[0] = date ( "Y年n月j日　H時i分" );
        //$log_ln[0] = date ("\'y.m.d h:i:s" );

//$time = time() - date("Z");  //ローカル時刻にGMTとの時差を引く
//$time = $time + 9*3600;  //ついでに日本時間を表示
//$log_ln[0]= date("Y/m/d H:i:s (D)", $time);


// ページのURL
    $log_ln[1] = str_replace ( ",", "，", $_SERVER["REQUEST_URI"] );
// リファラー
    $log_ln[2] = str_replace ( ",", "，", $_SERVER["HTTP_REFERER"] );
// IPアドレス
    $log_ln[3] = str_replace ( ",", "，", $_SERVER["REMOTE_ADDR"] );
// ホスト名
    $log_ln[4] = str_replace ( ",", "，", @gethostbyaddr ( $_SERVER["REMOTE_ADDR"] ) );
// ブラウザ
    $log_ln[5] = str_replace ( ",", "，", $_SERVER["HTTP_USER_AGENT"] );

    if ( $csv = @fopen ( $log_fl, "a" ) )
    {
        $ln = implode ( ",", $log_ln )."\n";
        fwrite ( $csv, $ln );
        fclose ( $csv );
    }
    else
    {
        //echo "error";
    }
?>
