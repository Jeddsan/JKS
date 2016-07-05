<?php
require("index.php");
$code='
var data = "";
 data = jks_gt_json("data.json");
 echo jks_math_sum   (4,5)."<br>";
 echo jks_math_sqro   (9)."<br>";
 //echo round                (9)."<br>";
 //ceil(3)."<br>";
 echo jks_math_pi_number ()."<br>";
 echo jks_math_random (1,3)."<br>";
 echo jks_string_i_repl("search","maps","Google Search")."<br>";
 echo jks_string_sub(2,2,"Hallo")."<br>";
 echo jks_string_i_find("Google","okay google")."<br>";
 echo jks_time_datetext("d.m.Y",jks_time_curtim())."<br>";
 echo jks_time_convert_st(jks_time_datetext("d.m.Y",jks_time_curtim()))."<br>";
';
echo nl2br(htmlspecialchars($code))."<br><br>";
$jks_code = parseJKS($code);
echo nl2br(htmlspecialchars($jks_code))."<br><br>";
eval($jks_code);
?>
