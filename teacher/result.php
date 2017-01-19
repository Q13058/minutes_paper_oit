<html>

<head>

<title>チェックボックスのテスト</title>

</head>

<body>



<?php

$value = $_POST["cell"];
echo "選択したセルは ". count($value) ." です。<br>";
foreach($value as $v){
 $args[] = $v;
 echo $v ." ";

}
var_dump($args);
?>



</body>

</html>