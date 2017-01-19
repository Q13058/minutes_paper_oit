<?php
define("IPADDRESS", "150.89.227.17");
define("USERNAME", "admin");
define("USERPASSWORD","nakanaka");
define("DATABASE", "newmpms2");

//ディレクトリ削除関数。Excelを展開したときのフォルダを削除するのに使う。
//出展：http://kidokorock.com/2010/01/webtips/php-webtips
function remove_directory($dir) {
	if ($handle = opendir("$dir")) {
		while (false !== ($item = readdir($handle))) {
			if ($item != "." && $item != "..") {
				if (is_dir("$dir/$item")) {
					remove_directory("$dir/$item");
				} else {
					unlink("$dir/$item");
					//echo " removing $dir/$item<br>\n";
				}
			}
		}
		closedir($handle);
		rmdir($dir);
		//echo "removing $dir<br>\n";
	}
}

	function GET_RGB($xml,$xml2,$xml3,$place){
	foreach($xml-> sheetData->row as $data){
    	$child=count($data,1);
	for($i=0;$i<$child;$i++){
	
    	$result[] = array( 'r' => (string)$data->c[$i]['r']);
	//print_r($result[$i]);
        //print_r('     ');
    	$result2[] = array( 's' => (string)$data->c[$i]['s']);
	//print_r($result2[$i]);
        //print_r('     ');
	//$v[] = $data->c[$i]->v;
        }
	//$arr=get_object_vars($result);
    	//$arr2=get_object_vars($result2);
	}

	$childlen=$xml->sheetData->row[2]->c[0]->v;
         $child=count($childlen,1);
         print_r($child);
	$i=0;
	$j=0;
	foreach($xml-> sheetData->row as $data){ //文字情報の位置取
	$childlen=$xml->sheetData->row->c;
	$child1=count($childlen,1);
	//print_r($child1);
	for($i=0;$i<$child1;$i++){
	 //print_r("	");
	$j=0;
	while(count($xml->sheetData->row[$i]->c[$j]->v,1)!=0){
	$child2=count($xml->sheetData->row[$i]->c[$j]->v,1);
	$j=$j+1;
	//print_r($child2);
	$result5[] = array((string)$data->c[$j]->v);
	}
	if(count($xml->sheetData->row[$i]->c[$j]->v,1)==0){
	$child2=count($xml->sheetData->row[$i]->c[$j]->v,1);
	//print_r($child2);
	//print_r("      ");
	}
	}

        //for($i=0;$i<$child;$i++){
	//$result5[] = array((string)$data->c[$i]->v);
	//print_r($result5[$i]);
	//}
	}


	 //print_r($result5[11]);
	$i=0;
	 foreach ($result5 as $key1 => $value1) {
  foreach ($value1 as $key2 => $value2) {
    //print $value2."     "; //「.」は文字列連結
	if($result5[$i]!=0){
        $v[]=$value2;
	}else{
        $v[]=-1;
        }
        $i=$i+1;
        //print_r($v[11]);
	//print_r('	');
  }
}
	foreach($xml3-> si as $data){ 
        $result6[] = array((string)$data->t);
	//print_r($result6[$i]);
        //print_r('     ');
        }

	foreach ($result6 as $key1 => $value1) {
  foreach ($value1 as $key2 => $value2) {
    //print $value2."     "; //「.」は文字列連結
        $str[]=$value2;
       //print_r($str[4]);
  }
}
	


	foreach ($result as $key1 => $value1) {
  foreach ($value1 as $key2 => $value2) {
    //print $value2."     "; //「.」は文字列連結
        $cell[]=$value2;
        //print_r($cell[392]);
  }
}
	foreach ($result2 as $key1 => $value1) {
  foreach ($value1 as $key2 => $value2) {
    //print $value2."     "; //「.」は文字列連結
        $s[]=$value2;
        //print_r($cell[0]);
  }
}

	 foreach($xml2->cellXfs as $data){
    //$childs = new SimpleXMLElement($data);
    $child=count($data,1);

    for($i=0;$i<$child;$i++){
    $result3[] = array( 'fillId' => (string)$data->xf[$i]['fillId']);
        }

    $arr=get_object_vars($result3);
        }


	$i=0;
	foreach ($result3 as $key1 => $value1) {
  foreach ($value1 as $key2 => $value2) {
    //print $value2."     "; //「.」は文字列連結
	if($result3[$i]!=0){
	$fill[]=$value2;
	}else{
	$fill[]=$result3[$i];
	}
	$i=$i+1;
	//print_r($fill[4]);
        //print_r('     ');
  }
}
	
	 foreach($xml2->fills->fill as $data){
    //$childs = new SimpleXMLElement($data);
    $child=count($data,1);

    for($i=0;$i<$child;$i++){
    $result4[] = array( 'rgb' => (string)$data->patternFill->fgColor[$i]['rgb']);
        }

    $arr=get_object_vars($result4);
        }

	$i=0;
	foreach ($result4 as $key1 => $value1) {
  foreach ($value1 as $key2 => $value2) {
    //print $value2."     "; //「.」は文字列連結
	if($result4[$i]!=NULL){
        $rgb[]=$value2;
        }else{
       $rgb=0;
        }
	$i=$i+1;
  }
}
	$color='FFFFFFFF';
	
	for($i=0;$i<count($cell);$i++){
	if($str[$i]==$place && $fill[$s[$i]]!=0 && $fill[$s[$i]]!=1 ){
	$color=$rgb[$fill[$s[$i]]];
	}
	}

	//$color='FFFFFF';
	//if($fill[$place]!=0){	
	//$color=$rgb[$fill[$place]];
	//}
	$color="#".substr($color,2,7);
	//print_r($rgb[3]);
	//print_r($place);
	// print_r($str[2]);
	//print_r(count($cell));
	//print_r("	");
	//print_r(count($str));
        //print_r("       ");
	 //print_r(count($fill));
	return $color;
	//return $v[3];
}


function is_file_upload() {
	if (!is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
		return 12;
	} else {
		$extension = $_FILES['upfile']['name'];
		if (substr(strrchr($extension, '.'), 1) !== "xlsx") {
			return 13;
		}
	}
	if (!$_POST['day']) {
		return 14;
	}
	$_POST['day'] = mb_convert_kana($_POST['day']);
	if (strlen($_POST['day']) !== 8) {
		return 15;
	}
	return;
}

function error($error_number){
	if($error_number !== NULL){
		$_SESSION['error'] = $error_number;
		header('Location: ./error_msg.php');
		exit();
	}else{
		return;
	}
}

function count_line($XML) {
	$xml = simplexml_load_file($XML);
	$cnt = 0;
	foreach ($xml -> sheetData -> row as $result_01) {
		foreach ($result_01  -> c as $result_02) {
			$cnt++;
		}
		break;
	}
	return $cnt;
}

/*function num_or_str($XML){
 $xml = simplexml_load_file($XML);
 foreach ($xml -> sheetData -> row  as $result_01){
 $c_attribute_cnt = 0;
 foreach($result_01 -> c as $result_a){
 $cnt = 0;
 foreach($result_a -> attributes() as $result_b => $result_c){
 //				echo $result_b -> attributes()."<br>";
 $c_attribute_cnt++;
 echo $result_b." = ".$result_c."<br>";
 }
 if($c_attribute_cnt == 2){
 $array[$cnt] = "NUM";
 }else{
 $array[$cnt] = "STR";
 }
 $cnt++;
 }
 }
 return $array;
 }*/

function num_or_str($ARRAY) {
	$cnt = 0;
	foreach ($ARRAY -> c as $result_a) {
		$c_attribute_cnt = 0;
		foreach ($result_a -> attributes() as $result_b => $result_c) {
			$c_attribute_cnt++;
		}
		$result_array[$cnt] = $c_attribute_cnt;
		$cnt++;
	}
	//	echo "cnt = $cnt<br>";
	//	for($i = 0; $i < $cnt; $i++){echo $result_array[$i].",";}
	//	echo "<br>";
	return $result_array;
}

function str_to_csv($STR_XML, $ARRAY, $FP, $C_CNT) {
	$c_cnt = 0;
	$result_string = NULL;
	//ARRAYには<c>の群れが入っている。<c>についてループし、アロー演算子で<v>を取り出す。
	foreach ($ARRAY as $result_01){
		if ($c_cnt == $C_CNT) {
			//vに格納されている数字（sharedStrings.xmlの何番目の文字列かを示す）を整数として取得
			(int)$result_num = (object)$result_01 -> v;
			//検索位置と、格納された番号が一致するかを調べるため	の変数
			$t_cnt = 0;
			//今度はsharedStrings.xmlから、対応するナンバーの文字列を探す作業
			foreach ($STR_XML -> si as $result_02) {
				if ($t_cnt == $result_num) {//一致したら、取り出す
					if (array_key_exists("r", $result_02)) {
						foreach ($result_02 -> r as $result_03) {
							//<si>の直下に<t>がながった場合の処理。<r>や<rPr>を無視して<t>のみを探し出す。
							foreach ($result_03 -> t as $result_04) {
								(string)$result_string = $result_string . $result_04;
							}
						}
					} else {
						(string)$result_string = (object)$result_02 -> t;
					}
					//言わずもがな、文字コード変換関数。Excelの文字コードはUTF-8。
					$result_string = mb_convert_encoding($result_string, "SJIS", "UTF-8");

					//ここからCSVファイルに書き込み開始。
					//UNIX系OSで回答した場合、改行コードがx000Dとなるので、それを除去する。
					if (strpos($result_string, "_x000D_")) {
						$result_string = str_replace("_x000D_", "", $result_string);
					}
					//セル内の文章中に改行やカンマが入っていたときの処理。
					if (!strpos($result_string, ",") && !strpos($result_string, "\n")) {
						fwrite($FP, $result_string . ",");
					} else {
						fwrite($FP, '"' . $result_string . '",');
					}
					//以後をサーチする必要はないので、脱出
					break;
				}
				$t_cnt++;
			}
		}
		$c_cnt++;
	}
}

function make_csv($text_xml, $sheet_xml, $CSV) {

	//xmlファイルを簡略化する
	$string_xml = simplexml_load_file($text_xml);
	$pos_xml = simplexml_load_file($sheet_xml);
	$csv_fp = fopen($CSV, "a");
	//そのシートが全部で何行で構成されているかを検出する
	$max_line = count_line($sheet_xml);

	foreach ($pos_xml -> sheetData -> row as $result_array) {//アロー演算子で階層を掘っていく。結果<row>の中身＝<c>の群れはas以降のオブジェクトに格納される
		//以後、一つの<row>ブロックに対する処理内容。これがループしている。
		//<c>タグの数ををカウントする変数
		$c_cnt = 0;		
		//その行のセルに格納されているのが数値か文字列かを判定した配列を返す。
		$ns_array = num_or_str($result_array);
		for ($i = 0; $i < $max_line; $i++) {
			//これは、セルに格納されているのが数値、またはNULLだった場合の処理。
			if ($ns_array[$i] == 2 && $i != 2) {
				//CSVには何も書かず、カンマだけを追加する。
				fwrite($csv_fp, ",");
			} else {
				//セルに文字列が入っている場合の処理。長いので別関数で処理している。
				str_to_csv($string_xml, $result_array, $csv_fp, $c_cnt);
			}
			//セルの処理が終わったら、次のセルに移るため、カウントを一つ増やす。
			$c_cnt++;
		}
		fwrite($csv_fp, "\n");
	}
FIN:
	fclose($csv_fp);
	return $max_line;
}

function result_view($file_name, $Sequence_num) {
	echo '<table border=1>';
	echo '<tr bgcolor="#CCCCCC">';
	echo '<td width="5%">学生番号</td>';
	echo '<td width="20%">質問</td>';
	echo '<td width="20%">回答</td>';
	echo '<td width="20%">コメント</td>';
	echo '<td width="20%">返答</td>';
	echo '</tr>';

	//講義設定
	$lec = htmlspecialchars($_SESSION['lecture'], ENT_QUOTES);

	// ロケール設定
	setlocale(LC_ALL, 'ja_JP.SJIS');

	// readモードで開く
	$handle = fopen("uploads/" . $file_name, 'r');

	// CSVデータを取り出す
	setlocale(LC_ALL, 'ja_JP.SJIS');
	echo "<br>";
	//	while($data = fgetcsv_reg($handle,1000)) {
	while ($data = fgetcsv($handle, 1000, ',', '"')) {
		for ($i = 0; $i < $Sequence_num; $i++) {
			$array[$i] = $data[$i];
			if ($array[$i] == NULL) {$array[$i] = "&nbsp";
			}
			//			echo "data[$i] = ".$array[$i]."<br>";
		}
		$num = $array[0];
		$que = $array[$Sequence_num - 4];
		$ans = $array[$Sequence_num - 3];
		$com = $array[$Sequence_num - 2];
		$rep = $array[$Sequence_num - 1];

		// 一行分のデータを表示
		echo '<tr>';
		echo '<td>' . $num . '</td>';
		echo '<td>' . $que . '</td>';
		echo '<td>' . $ans . '</td>';
		echo '<td>' . $com . '</td>';
		echo '<td>' . $rep . '</td>';
		echo '</tr>';
	}
	echo "</table>";
	// 閉じる
	fclose($handle);
}

/*
 // 一行分のデータを取り出す
 list($num,$que, $ans,$com,$rep) = $data;

 //セルがカラだったばあい、スペースを入れて強引にテーブルを埋める。
 if(!$num){$num = "&nbsp";}
 if(!$que){$que = "&nbsp";}
 if(!$ans){$ans = "&nbsp";}
 if(!$com){$com = "&nbsp";}
 if(!$rep){$rep = "&nbsp";}

 // 一行分のデータを表示
 echo '<tr>';
 echo '<td>' . $num . '</td>';
 echo '<td>' . $que . '</td>';
 echo '<td>' . $ans . '</td>';
 echo '<td>' . $com . '</td>';
 echo '<td>' . $rep . '</td>';
 echo '</tr>';

 // 全角から半角へ変換+文字化け防止？
 $num = mb_convert_kana($num, 'a', 'SJIS');
 //$pos = mb_convert_kana($pos, 'a', 'SJIS');
 $que = mb_convert_kana($que, 'a', 'SJIS');
 $ans = mb_convert_kana($ans, 'a', 'SJIS');
 $com = mb_convert_kana($com, 'a', 'SJIS');
 $rep = mb_convert_kana($rep, 'a', 'SJIS');
 */



function go_to_test($num, $time, $que, $ans, $com, $rep, $date, $lec, $column1, $column2, $column3, $column4, $count_num, $filename,$present) {
        //MySQLへの接続
        $conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);
        if ($conn) {
                // データベースの選択
                $db_selected = mysql_select_db(DATABASE, $conn);




                // データベースへの書き込みSQL文
                $sql = "INSERT INTO test(number, time, question, answer, comment, reply, column1, column2, column3, column4, school_date, lecture, num ,file_name,present) VALUES('{$num}', '{$time}', '{$que}', '{$ans}', '{$com}', '{$rep}', '{$column1}', '{$column2}', '{$column3}', '{$column4}', '{$date}', '{$lec}','{$count_num}' , '{$filename}','{$present}')";

                // mb_internal_encoding('sjis');

                // SQL文の実行
                $query = mysql_query($sql);
                //print_r($query);

        }
}

function go_to_sql($num, $time, $que, $ans, $com, $rep, $date, $lec, $column1, $column2, $column3, $column4, $filename,$count_num,$present,$teacher) {
	//MySQLへの接続
	$conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);
	if ($conn) {
		// データベースの選択
		$db_selected = mysql_select_db(DATABASE, $conn);




		// データベースへの書き込みSQL文
		$sql = "INSERT INTO qanda(number, time, question, answer, comment, reply, column1, column2, column3, column4, school_date, lecture,file_name,num,present,teacher) VALUES('{$num}', '{$time}', '{$que}', '{$ans}', '{$com}', '{$rep}', '{$column1}', '{$column2}', '{$column3}', '{$column4}', '{$date}', '{$lec}', '{$filename}','{$count_num}' ,'{$present}','{$teacher}')";

		// mb_internal_encoding('sjis');

		// SQL文の実行
		$query = mysql_query($sql);
		//print_r($query);

	}
}
	function go_to_color($time,$num, $rgb, $column) {
        //MySQLへの接続
        $conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);
        if ($conn) {

		//print_r($time);
                //print_r($num);
                //print_r($rgb);
                //print_r($column);
                // データベースの選択
                $db_selected = mysql_select_db(DATABASE, $conn);




                // データベースへの書き込みSQL文
                $sql = "INSERT INTO color(school_date,number,rgb,c) VALUES('{$time}','{$num}','{$rgb}','{$column}')";
           

     		//print_r($sql);
                // mb_internal_encoding('sjis');

                // SQL文の実行
                $query = mysql_query($sql);
	

        }else{
	 //print_r($sql);
	}
}



	function sum_to_sql($sum_present) {
        //MySQLへの接続
        $conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);
        if ($conn) {
                // データベースの選択
                $db_selected = mysql_select_db(DATABASE, $conn);




                // データベースへの書き込みSQL文
                $sql = "INSERT INTO qanda(sum_present) VALUES('{$sum_present}')";

                // mb_internal_encoding('sjis');

                // SQL文の実行
                $query = mysql_query($sql);

        }
}






/*
function go_to_sql_color($num, $time, $que, $ans, $com, $rep, $date, $lec, $column1, $column2, $column3, $column4, $filename) {
	//MySQLへの接続
	$conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);
	if ($conn) {
		// データベースの選択
		$db_selected = mysql_select_db(DATABASE, $conn);

		// データベースへの書き込みSQL文
		$sql = "INSERT INTO must(number, time, question, answer, comment, reply, column1, column2, column3, column4, school_date, lecture, file_name) VALUES('{$num}', '{$time}', '{$que}', '{$ans}', '{$com}', '{$rep}', '{$column1}', '{$column2}', '{$column3}', '{$column4}', '{$date}', '{$lec}', '{$filename}')";

		// mb_internal_encoding('sjis');

		// SQL文の実行
		$query = mysql_query($sql);

	}
}
*/



function go_to_question_sql($date, $q0, $q1, $q2, $q3, $q4, $q5, $q6, $q7, $count) {
	//MySQLへの接続
	$conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);
	if ($conn) {
		// データベースの選択
		$db_selected = mysql_select_db(DATABASE, $conn);

		// データベースへの書き込みSQL文
		$sql = "INSERT INTO question(school_date, question1, question2, question3, question4, question5, question6, question7, question8, count) VALUES('{$date}', '{$q0}', '{$q1}', '{$q2}', '{$q3}', '{$q4}', '{$q5}', '{$q6}', '{$q7}' ,'{$count}')";

		// mb_internal_encoding('sjis');

		// SQL文の実行
		$query = mysql_query($sql);
		//echo mysql_errno($conn).":".mysql_error($conn);
	}
}

function sheet_name($CNT, $XML) {
	$name_xml = simplexml_load_file($XML);
	$sheet_num_count = 1;
	foreach ($name_xml -> sheets -> sheet as $sheet_name) {
		if ($sheet_num_count == $CNT) {
			return $sheet_name -> attributes();
		}
		$sheet_num_count++;
	}
}
/*
//文字化け対策用fgetcsv関数？
function fgetcsv_reg (&$handle, $length , $d , $e ) {

   $d = preg_quote($d);
   $e = preg_quote($e);
   $_line = "";
   $eof = false;
   while ($eof != true) {
      $_line .= (empty($length) ? fgets($handle) : fgets($handle, $length));
      $itemcnt = preg_match_all('/'.$e.'/', $_line, $dummy);
      if ($itemcnt % 2 == 0) $eof = true;
  }
  $_csv_line = preg_replace('/(?:\\r\\n|[\\r\\n])?$/', $d, trim($_line));
  $_csv_pattern = '/('.$e.'[^'.$e.']*(?:'.$e.$e.'[^'.$e.']*)*'.$e.'|[^'.$d.']*)'.$d.'/';
  preg_match_all($_csv_pattern, $_csv_line, $_csv_matches);
  $_csv_data = $_csv_matches[1];
  for($_csv_i=0; $_csv_i<count($_csv_data); $_csv_i++) {
     $_csv_data[$_csv_i] = preg_replace('/^'.$e.'(.*)'.$e.'$/s','$1',$_csv_data[$_csv_i]);
      $_csv_data[$_csv_i] = str_replace($e.$e, $e, $_csv_data[$_csv_i]);
  }
  return empty($_line) ? false : $_csv_data;
}*/

//出展：http://phpspot.net/php/pg%E6%AD%A3%E8%A6%8F%E8%A1%A8%E7%8F%BE%EF%BC%9A%E3%81%99%E3%81%B9%E3%81%A6%E5%8D%8A%E8%A7%92%E8%8B%B1%E6%95%B0%E3%81%8B%E3%81%A9%E3%81%86%E3%81%8B%E8%AA%BF%E3%81%B9%E3%82%8B.html
function is_hankaku($str) {
	if (preg_match("/^[a-zA-Z0-9]+$/", $str)) {
		return TRUE;
	} else {
		return FALSE;
	}
}


function fgetcsv_reg (&$handle, $length = null, $d = ',', $e = '"') {
	$d = preg_quote($d);
	$e = preg_quote($e);
	$_line = "";
	$eof = false;
	while (($eof != true)and(!feof($handle))) {
		$_line .= (empty($length) ? fgets($handle) : fgets($handle, $length));
		$itemcnt = preg_match_all('/'.$e.'/', $_line, $dummy);
		if ($itemcnt % 2 == 0) $eof = true;
	}
	$_csv_line = preg_replace('/(?:\\r\\n|[\\r\\n])?$/', $d, trim($_line));
	$_csv_pattern = '/('.$e.'[^'.$e.']*(?:'.$e.$e.'[^'.$e.']*)*'.$e.'|[^'.$d.']*)'.$d.'/';
	preg_match_all($_csv_pattern, $_csv_line, $_csv_matches);
	$_csv_data = $_csv_matches[1];
	for($_csv_i=0;$_csv_i<count($_csv_data);$_csv_i++){
		$_csv_data[$_csv_i]=preg_replace('/^'.$e.'(.*)'.$e.'$/s','$1',$_csv_data[$_csv_i]);
		$_csv_data[$_csv_i]=str_replace($e.$e, $e, $_csv_data[$_csv_i]);
	}
	return empty($_line) ? false : $_csv_data;
}

/**
 * ファイルの文字コードを変換する関数
 * @access public
 * @param string $file1
 * @param string $encoding1
 * @param string $file2
 * @param string $encoding2
 * @param string $newline
 */
function convert_file_encoding($file1, $encoding1, $file2, $encoding2, $newline = ''){
    if ( ! file_exists($file1) OR ! is_file($file1)){
        return 'ファイルが存在しません。';
    }
     
    $data1 = file_get_contents($file1);
     
    if ($data1 === FALSE){
        return 'データの取得に失敗しました。';
    }
     
    $data2 = mb_convert_encoding($data1, $encoding2, $encoding1);
    $data2 = str_replace(array("\r\n", "\n", "\r"), $newline, $data2);
    $handle = fopen($file2, 'wb');
     
    if ($handle === FALSE){
        return 'ファイルへの書き込みに失敗しました。';
    }
     
    fwrite($handle, $data2);
    fclose($handle);
     
    return "{$file1} の文字コードを {$encoding2} に変換し {$file2} に出力しました。";
}
?>
