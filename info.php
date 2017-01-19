 <?
$funcs = get_defined_functions();

foreach ($funcs[&#39;internal&#39;] as $val) {
  echo "$val";
}
?>

