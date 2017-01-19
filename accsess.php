 <?php
 include_once './teacher/function.php';

$conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);
        if ($conn) {
                // データベースの選択
                mysql_select_db(DATABASE,$conn);
                // データベースへの問い合わせSQL文
                $sql = 'SELECT * FROM `color` WHERE 1';
                // SQL文の実行
                $query = mysql_query($sql, $conn);
		var_dump($query);

		 while($row=mysql_fetch_object($query)) {
                // データベースの選択
                $db_selected = mysql_select_db(DATABASE, $conn);
		var_dump($row->c);




                // データベースへの書き込みSQL文
                $sql = "INSERT INTO color(c,rgb) VALUES('{$row->c}','{$row->rgb}')";

                // mb_internal_encoding('sjis');

                // SQL文の実行
                $query = mysql_query($sql);
                print_r($query);
		
		}
		}
?>
