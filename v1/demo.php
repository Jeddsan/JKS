<?php
require("compiler.php"); //JKS Compiler
$code='
var data = "";
 data = jks_gt_json("data.json");
 jks_print_arr( data);
';
$jks_code = parseJKS($code);
eval($jks_code);
?>
