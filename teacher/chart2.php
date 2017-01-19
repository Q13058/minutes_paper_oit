 <?php
        include_once './teacher/function.php';
        include_once'./chart_log.php';
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
                $school_num = array('0', '0', '0', '0','0','0', '0', '0', '0','0','0', '0', '0', '0','0');
                $ave = array('0', '0', '0', '0','0','0', '0', '0', '0','0','0', '0', '0', '0','0');
                 $school_sum = array('0', '0', '0', '0','0','0', '0', '0', '0','0','0', '0', '0', '0','0');
                // MySQLへの接続
        $conn = mysql_connect(IPADDRESS, USERNAME, USERPASSWORD);
        $num =0;
        $tmp=0;
        $tmp2=0;
        $tmp3=0;
        $i=0;
        $id=$_SESSION['studentid'];
        $lec = $_SESSION['lecture'];

        if ($conn) {
                // データベースの選択
                mysql_select_db(DATABASE,$conn);

                $id = $_SESSION['studentid'];
                //講義ごとの提出回数を求めるSQL文　　　　　　　　　　　　　　
                $sql = "SELECT `number`,`school_date`,`present` FROM `qanda` WHERE   `delete_flag`!='1' AND  `number`='{$id}' AND `lecture`='{$lec}' GROUP BY `school_date`";
                $query = mysql_query($sql, $conn);


                //講義ごとの全提出回数を求めるSQL文
                $sql2 = "SELECT `school_date`,COUNT(`present`)as school_sum FROM `qanda` WHERE   `delete_flag`!='1' AND   `present`='1' AND `lecture`='{$lec}'  GROUP BY `school_date`";
                $query2 = mysql_query($sql2, $conn);
                while($row2=mysql_fetch_object($query2)) {
                $school_sum[$i]=$row2->school_sum;
                $i=$i+1;
                }
                 //全生徒数を求めるSQL文
                $sql3 = "SELECT COUNT(DISTINCT `number`) as school_num FROM `qanda` WHERE   `delete_flag`!='1'   GROUP BY `school_date`  ";
                $query3 = mysql_query($sql3, $conn);
                $i=0;
                while($row3=mysql_fetch_object($query3)) {
                $school_num[$i]=$row3->school_num;
                $i=$i+1;
                }

		 $i=0;
                $j=1;
                while($row=mysql_fetch_object($query)) {
                $tmp=$tmp+$row->present;
                $sum[$i]=$tmp;
                $sum[$i]=$sum[$i]/$j;
                $i=$i+1;
                $j=$j+1;
                }
                }


                $sql4 = "SELECT DISTINCT `border_flag`  FROM `qanda`";
                $query4 = mysql_query($sql4, $conn);
                $row4=mysql_fetch_object($query4);
                $border_flag=$row4->border_flag;

                $sql5 = "SELECT COUNT(DISTINCT `school_date`) as lec_num FROM `qanda`";
                $query5 = mysql_query($sql5, $conn);
                $row5=mysql_fetch_object($query5);
                $school_cnt=$row5->lec_num;


                for($j=0;$j<$school_cnt;$j++){
                if($border_flag==1){
                $border[$j]=60;
                }else{
                $border[$j]="";
                }

                $sql6 = "SELECT `number`,`school_date`,`present` FROM `qanda` WHERE  `lecture`='{$lec}' GROUP BY `school_date`";
                $query6 = mysql_query($sql6, $conn);
                $i=0;
                $j=1;
                 while($row6=mysql_fetch_object($query6)) {
                $tmp2=$tmp2+$school_sum[$i];
                $tmp3=$tmp3+$school_num[$i];
                $ave[$i]=$tmp2*100/$tmp3;
                $i=$i+1;
                $j=$j+1;
                }
                }

                ?>

		
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
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
           var ave = new Array("400","500","200","5","5","0","0","0","0","0","0","0","0","0","0");
            var total = new Array("0","0","0","0","0","0","0","0","0","0","0","0","0","0","0");
                var school_num = new Array("0","0","0","0","0","0","0","0","0","0","0","0","0","0","0");


                for(i=0;i<=14;i++){
                ave[i]=0;
                school_num[i]=0;
                }

                for(i=0;i<school_cnt;i++){
                total[i]=i+1;
                 ave[i]=0;
                }

		sum[0] = <?php echo $sum[0]; ?>;
                sum[1] = <?php echo $sum[1]; ?>;
                sum[2] = <?php echo $sum[2]; ?>;
                sum[3] = <?php echo $sum[3]; ?>;
                sum[4] = <?php echo $sum[4]; ?>;
                sum[5] = <?php echo $sum[5]; ?>;
                sum[6] = <?php echo $sum[6]; ?>;
                sum[7] = <?php echo $sum[7]; ?>;
                sum[8] = <?php echo $sum[8]; ?>;
                sum[9] = <?php echo $sum[9]; ?>;
                sum[10] = <?php echo $sum[10]; ?>;
                sum[11] = <?php echo $sum[11]; ?>;
                sum[12] = <?php echo $sum[12]; ?>;
                sum[13] = <?php echo $sum[13]; ?>;
                sum[14] = <?php echo $sum[14]; ?>;

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

                 school_num[0] = <?php echo $school_num[0]; ?>;
                 school_num[1] = <?php echo $school_num[1]; ?>;
                 school_num[2] = <?php echo $school_num[2]; ?>;
                 school_num[3] = <?php echo $school_num[3]; ?>;
                school_num[4] = <?php echo $school_num[4]; ?>;
                school_num[5] = <?php echo $school_num[5]; ?>;
                 school_num[6] = <?php echo $school_num[6]; ?>;
                 school_num[7] = <?php echo $school_num[7]; ?>;
                 school_num[8] = <?php echo $school_num[8]; ?>;
                school_num[9] = <?php echo $school_num[9]; ?>;
                school_num[10] = <?php echo $school_num[10]; ?>;
                school_num[11] = <?php echo $school_num[11]; ?>;
                 school_num[12] = <?php echo $school_num[12]; ?>;
                 school_num[13] = <?php echo $school_num[13]; ?>;
                 school_num[14] = <?php echo $school_num[14]; ?>;
		
		for(i=0;i<=14;i++){
                if(school_sum[i]!=0){
                ave[i]=(school_sum[i]*100)/school_num[i];
                 ave[i] = Math.round(ave[i]);
                sum[i]=sum[i]*100;
                sum[i]=Math.round(sum[i]);
                }
                }

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
			title: {
            text: 'ミニッツペーパ閲覧システム'
        },
        subtitle: {
            text: '提出状況'
        },
        xAxis: [{
            categories: ['第1回', '第2回', '第3回', '第4回', '第5回', '第6回',
                '第7回', '第8回', '第9回', '第10回', '第11回', '第12回', '第13回', '第14回','第15回']
        }],
        yAxis: [{ // Primary yAxis
                 min: 0,
                max: 100,
                labels: {
                format: '{value}%',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
                },
            title: {
                text:'提出率',
                style: {
                    color: Highcharts.getOptions().colors[1]
                }
            }
        }, { // Secondary yAxis
                min: 0,
                max: 100,
            title: {
                text: '全体提出率',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
                labels: {
                format: '{value}%',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
                },
            opposite: true
        }],
        tooltip: {
            shared: true
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: 30,
            y: 100,
	    floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
        },
                    //グラフデータの設定
                    series:[{

      //名前を設定
      name:"提出率",
      //色の設定
      color: '#00ffff',
      //グラフタイプの設定(column:棒グラフ)
      type: 'line',
      //x,y軸の設定
        data: [<?php echo round($sum[0]*100,0);
                    for($i = 1; $i<$school_cnt; $i++){
                        echo ','.round(($sum[$i]*100),0);
                        }
                                ?>],
         tooltip: {
                valueSuffix: '%'
           } },
//{
 //名前を設定
      //name: "総回数",
      //色の設定
      //color: '#ff00ff',
      //グラフタイプの設定(column:棒グラフ)
      //type: 'column',
      //x,y軸の設定
      //data: [total[0],total[1],total[2],total[3],total[4],total[5],total[6],total[7],total[8],total[9],//total[10],total[11],total[12],total[13],total[14]],
        //tooltip: {
                //valueSuffix: '%'
           //} },

        {
 //名前を設定
      name: "ボーダーライン",
      //色の設定
      color: '#ff00ff',
      //グラフタイプの設定(column:棒グラフ)
      type: 'line',
      //x,y軸の設定
      data: [<?php echo $border[0];
                    for($i = 1; $i < $school_cnt; $i++){
                        echo ','.$border[$i];
                        }
                                ?>],
        tooltip: {
                valueSuffix: '%'
           } },

{
//名前を設定
      name: "全体の提出率",
      //色の設定
      color: '#ff0000',
      //グラフタイプの設定(column:棒グラフ)
      type: 'line',
       yAxis: 1,
      //x,y軸の設定
       data: [<?php echo round($ave[0],0);
                    for($i = 1; $i < $school_cnt; $i++){
                        echo ','.round($ave[$i],0);
                        }
                                ?>],
        tooltip: {
                valueSuffix: '%'
           }
        }]
                });
            });
        </script>

 <br>
<li><a href="top.php">メニューへ戻る</a>
<br><br>

</body>
</html>
