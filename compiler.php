<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
//$code is the input
$code="
var number1= 3;
var number2 = 4;
var result = number2 + number1;
echo result;
";
//Declaration
$vars=array();
$last_var_position=0;

//Variables
$code=str_replace("var ","$",$code,$count_set_variables);
for ($i=0; $i < $count_set_variables; $i++) {
  $start_position_var=strpos($code,"$",$last_var_position);
  $end_position_var=strpos($code," ",$start_position_var);
  $name_of_string=trim(substr($code,$start_position_var+1,$end_position_var-$start_position_var));
  array_push($vars,$name_of_string);
  $last_var_position=$start_position_var+2;
  $start_position_var=0;
  $end_position_var=0;
}
print_r($vars);
for ($i=0; $i < count($vars); $i++){
  $current_var=$vars[$i];
  $code=str_replace(" $current_var"," $$current_var",$code);
}
echo nl2br($code);
eval($code);
//$code is the output
?>
