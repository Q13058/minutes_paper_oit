 <!DOCTYPE html>
<html>
<head>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
 <!--省略 -->
 <script type="text/javascript">
 $('#textbox').live('keyup',function(){
 value = $('#textbox').val();
 
 $.post(
 './response.php',//script url
 {'sample':value},//キー:値
 function(data){//成功時のコールバック
 $('#output').html(data);
 }
 );
 });
 </script>
 </head>
 <body>
 <form method="post">
 <input type="text" name="sample" id="textbox" />
 </form>
 
 <h2 id="output"></h2>
 </body>
</html>

