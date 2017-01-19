 <!DOCTYPE html>
<html lang = "ja">
<head>
    <link class="include" rel="stylesheet" type="text/css" href="jquery.jqplot.min.css" />
    <script class="include" type="text/javascript" src="jquery.min.js"></script>
    <script class="include" type="text/javascript" src="jquery.jqplot.min.js"></script>
 
    <script class="include" language="javascript" type="text/javascript" src="plugins/jqplot.highlighter.min.js"></script>
    <script class="include" language="javascript" type="text/javascript" src="plugins/jqplot.dateAxisRenderer.min.js"></script>
</head>
<body>
 
<div id="chart1" style="height:300px; width:300px;"></div>
 
<script class="code" type="text/javascript">
$(document).ready(function()
{
    var plot1 = $.jqplot ('chart1', [[3,7,9,1,4,6,8,2,5]]);
});
</script>
</body>
</html>

