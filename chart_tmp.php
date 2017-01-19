   
		

	<?php
        include_once './teacher/function.php';
        // セッションの開始
        session_start();

        // ログインチェック
        if(!$_SESSION['studentid']){
                // ログインフォーム画面へ
                header('Location: login.php');
                // 終了
                exit();
        }


		 $sum = array('0', '0', '0', '0','0','0', '0', '0', '0','0','0', '0', '0', '0','0');
		 $school_sum = array('0', '0', '0', '0','0','0', '0', '0', '0','0','0', '0', '0', '0','0');
		// MySQLへの接続
        $conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);
        $num =0;
	$tmp=0;
	$i=0;
	$id=$_SESSION['studentid'];

        if ($conn) {
                // データベースの選択
                mysql_select_db(DATABASE,$conn);

                $id = $_SESSION['studentid'];
		//講義ごとの提出回数を求めるSQL文　　　　　　　　　　　　　　
		$sql = "SELECT `number`,`school_date`,`present` FROM `qanda` WHERE `number`='{$id}' GROUP BY `school_date`";
		$query = mysql_query($sql, $conn);


		//講義ごとの全提出回数を求めるSQL文
		$sql2 = "SELECT `school_date`,COUNT(`present`)as school_sum FROM `qanda` WHERE `present`='1' GROUP BY `school_date`";
		$query2 = mysql_query($sql2, $conn);
		while($row2=mysql_fetch_object($query2)) {
                $school_sum[$i]=$row2->school_sum;
                $i=$i+1;
		}
		 //全生徒数を求めるSQL文
                $sql3 = "SELECT COUNT(DISTINCT `number`) as school_num FROM `qanda`  GROUP BY `school_date`  ";
                $query3 = mysql_query($sql3, $conn);
		$row3=mysql_fetch_object($query3);
		$school_num=$row3->school_num;

		$i=0;
                while($row=mysql_fetch_object($query)) {
		$tmp=$tmp+$row->present;
		$sum[$i]=$tmp;
		$i=$i+1;
		}
		}
		?>



 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Language" content="ja">
<title>グラフ</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
 <script type="text/javascript" src=".js/modules/exporting.js"></script>

<script src="./js/highcharts.js" type="text/javascript"></script>
</head>
<body>
        <div id="container" style="width: 1000px; height: 400px; margin: 0 auto"></div>

 <script type="text/javascript">
            var chart;
	    var i=0;
            var id="<?php echo $_SESSION['studentid']; ?>";
	   var school_cnt= <?php echo $i; ?>;
	    var school_num=<?php echo $school_num; ?>;
	    var sum = new Array("0","0","0","0","0","0","0","0","0","0","0","0","0","0","0");
            var school_sum = new Array("0","0","0","0","0","0","0","0","0","0","0","0","0","0","0");
	   var ave = new Array("0","0","0","0","0","0","0","0","0","0","0","0","0","0","0");
	    var total = new Array("0","0","0","0","0","0","0","0","0","0","0","0","0","0","0");	
	

		
		for(i=0;i<school_cnt;i++){
		total[i]=i+1;
		//sum[i] = <?php echo $sum[$i]; ?>;
		//school_sum[i] = <? php echo $school_sum[$i]; ?>;
		//ave[i]=school_sum[i]/school_num;
		//ave[i] = Math.round(ave[i] * 10) / 10;
		}


		sum[0] = <?php echo $sum[0]; ?>;
		sum[1] = <?php echo $sum[1]; ?>;
		sum[2] = <?php echo $sum[2]; ?>;
		sum[3] = <?php echo $sum[3]; ?>;
		sum[4] = <?php echo $sum[4]; ?>;

		school_sum[0] = <?php echo $school_sum[0]; ?>;
                 school_sum[1] = <?php echo $school_sum[1]; ?>;
		 school_sum[2] = <?php echo $school_sum[2]; ?>;
                 school_sum[3] = <?php echo $school_sum[3]; ?>;
		school_sum[4] = <?php echo $school_sum[4]; ?>;
		school_sum[5] = <?php echo $school_sum[5]; ?>;
                 school_sum[6] = <?php echo $school_sum[6]; ?>;
                 school_sum[7] = <?php echo $school_sum[7]; ?>;
                 school_sum[8] = <?php echo $school_sum[8]; ?>;
                school_sum[9] = <?php echo $school_sum[9]; ?>;
		school_sum[10] = <?php echo $school_sum[10]; ?>;
                school_sum[11] = <?php echo $school_sum[11]; ?>;
                 school_sum[12] = <?php echo $school_sum[12]; ?>;
                 school_sum[13] = <?php echo $school_sum[13]; ?>;
                 school_sum[14] = <?php echo $school_sum[14]; ?>;

		ave[0]=(school_sum[0]*100)/school_num;
		//小数点以下四捨五入
		ave[0] = Math.round(ave[0]);
		ave[1]=school_sum[1]/school_num;
		ave[1] = Math.round(ave[1] * 100) / 10;
		ave[2]=school_sum[2]/school_num;
		ave[2] = Math.round(ave[2] * 100) / 10;
		ave[3]=school_sum[3]/school_num;
		ave[3] = Math.round(ave[3] * 100) / 10;
		ave[4]=school_sum[4]/school_num;
		ave[4] = Math.round(ave[4] * 100) / 10;
		ave[0]=school_sum[0]/school_num;
                //小数点以下四捨五入
                ave[5] = Math.round(ave[5] * 100) / 10;
                ave[5]=school_sum[5]/school_num;
                ave[6] = Math.round(ave[6] * 100) / 10;
                ave[6]=school_sum[6]/school_num;
                ave[7] = Math.round(ave[7] * 100) / 10;
                ave[7]=school_sum[7]/school_num;
                ave[8] = Math.round(ave[8] * 100) / 10;
                ave[8]=school_sum[8]/school_num;
                ave[9] = Math.round(ave[9] * 100) / 10;
		ave[9]=school_sum[9]/school_num;
		ave[10] = Math.round(ave[10] * 100) / 10;
                ave[10]=school_sum[10]/school_num;
                ave[11] = Math.round(ave[11] * 100) / 10;
                ave[11]=school_sum[11]/school_num;
                ave[12] = Math.round(ave[12] * 100) / 10;
                ave[12]=school_sum[12]/school_num;
                ave[13] = Math.round(ave[13] * 100) / 10;
                ave[13]=school_sum[13]/school_num;
                ave[14] = Math.round(ave[14] * 100) / 10;
                ave[14]=school_sum[14]/school_num;
            $(document).ready(function () {
                //グラフのオプションを設定
                chart = new Highcharts.Chart({
                    
                    chart: {
			zoomType: 'x',
			width:1000,
			heigh:2000,
                        //グラフ表示させるdivをidで設定
                        renderTo: 'container',
                        //グラフ右側のマージンを設定
                        marginRight: 140,
                        //グラフ左側のマージンを設定
                        marginBottom: 40
                    },
                    //グラフのタイトルを設定
                    title: {
                        text:  "ミニッツペーパ提出状況(棒グラフ)"
                    },
                    //x軸の設定
                    xAxis: {
                        title: {
                            text: '(講義回数)'
                        },
                        //x軸に表示するデータを設定
                        categories:["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15"],
                        //小数点刻みにしない
                        allowDecimals: false
                    },
                    //y軸の設定

	 yAxis: [{
                        title: {
                            //タイトル名の設定
                            text: "提出回数",
                            style: {
                               //タイトルの色を設定
                               color: '#4572A7',
                            }
                        },
    	                //小数点刻みにしない
                        allowDecimals: false,
                        //最大値を設定
                        max: 13,
                        //最小値を設定
                        min: 0
			}
                   },
                    //凡例の設定
                    legend: {
                        //凡例が縦に並ぶ
                        layout: 'vertical',
                        //凡例の横位置
                        align: 'right',
                        //凡例の縦位置
                        verticalAlign: 'top'
		},
                    //グラフデータの設定
                    series:[{

      //名前を設定
      name:id,
      //色の設定
      color: '#00ffff',
      //グラフタイプの設定(column:棒グラフ)
      type: 'column',
      //x,y軸の設定
	data:[sum[0],sum[1],sum[2],sum[3],sum[4],sum[5],sum[6],sum[7],sum[8],sum[9],sum[10],sum[11],sum[12],sum[13],sum[14]],
	 tooltip: {
                valueSuffix: '回'
           } },
{
 //名前を設定
      name: "総回数",
      //色の設定
      color: '#ff00ff',
      //グラフタイプの設定(column:棒グラフ)
      type: 'column',
      //x,y軸の設定
      data: [total[0],total[1],total[2],total[3],total[4],total[5],total[6],total[7],total[8],total[9],total[10],total[11],total[12],total[13],total[14]],
	tooltip: {
                valueSuffix: '回'
           } },


{
      //名前を設定
      name: "平均",
      //色の設定
      color: '#ff0000',
      //グラフタイプの設定(column:棒グラフ)
      type: 'spline',
       yAxis: 1,
      //x,y軸の設定
       data: [ave[0], ave[1],ave[2],ave[3],ave[4],23.3,ave[6],25.5, 23.3, 18.3, 13.9, 9.6],
}]
                });
            });
        </script>

 <br>
<li><a href="top.php">メニューへ戻る</a>
<br><br>

</body>
</html>
