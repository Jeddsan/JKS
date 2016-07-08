<?php
require("../v1/compiler.php");
$code='
$code='
var data = "";
 data = jks_gt_json("data.json");
 echo data["glossary"]["title"]."<br>";
 echo jks_math_sum   (4,5)."<br>";
 echo jks_math_sqro   (9)."<br>";
 //echo ROUND                (9)."<br>";
 //ceIl(3)."<br>";
 echo jks_math_pi_number ()."<br>";
 echo jks_math_random (1,3)."<br>";
 echo jks_string_i_repl("search","maps","Google Search")."<br>";
 echo jks_string_sub(2,2,"Hallo")."<br>";
 echo jks_string_i_find("Google","okay google")."<br>";
 echo jks_time_datetext("d.m.Y")."<br>";
 echo jks_time_string_c(jks_time_datetext("d.m.Y",jks_time_curtim()))."<br>";
 var array1 = array(1,4,2);
 jks_arr_order( array1)."<br>";
 jks_arr_prn( array1);
 var test = false;
 if(jks_bool_bool_is( test)){
	 echo "test is a bool";
 }
 echo jks_type_get( test);
 var hallo = jks_string_spli("Hallo");
 jks_arr_prn( hallo);
 echo round(6);
 echo jks_math_bin2dec(100);
 jks_arr_prn(jks_arr_values( array1));
 echo jks_vali_url("https://www.norelect.ch/");
 echo jks_vali_mailing("info@jeddsan.net");
 echo jks_vali_name("Julian Schmuckli");
 echo jks_string_base64_e("Hello Developer")."<br>";
 echo jks_string_hashing("sha512","Hello Developer")."<br>";
 echo jks_string_sha1_hashing("Hello Developer")."<br>";
 echo jks_string_2br("Hello\nDeveloper")."<br>";
 ?><Script type="text/javascript">window.location = "http://www.google.ch";</Script>
';
echo nl2br(htmlspecialchars($code))."<br><br>";
$jks_code = parseJKS($code);
echo nl2br(htmlspecialchars($jks_code))."<br><br>";
eval($jks_code);
?>
