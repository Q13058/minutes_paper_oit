<html>

<head>

<title>�`�F�b�N�{�b�N�X�̃e�X�g</title>

</head>

<body>



<?php

$value = $_POST["cell"];
echo "�I�������Z���� ". count($value) ." �ł��B<br>";
foreach($value as $v){
 $args[] = $v;
 echo $v ." ";

}
var_dump($args);
?>



</body>

</html>