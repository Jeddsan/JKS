<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
//$code is the input
function parseJKS($code){
  //Declaration
  $vars=array();
  $last_var_position=0;

  //Definitions
  //$code = str_ireplace("\"","'",$code);

  $lines_arr = preg_split('/\n|\r/',$code);
  $num_lines = count($lines_arr);

  $code="";

  //Excluding functions
  for ($i=0; $i < $num_lines; $i++) {
    $current_line=$lines_arr[$i];
    if(
    contains("include",$current_line)||
    contains("include_once",$current_line)||
    contains("require",$current_line)||
    contains("require_once",$current_line)||
    contains("eval(",$current_line)){

    }else{
      $code.=$current_line."\n";
    }
  }
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
  for ($i=0; $i < count($vars); $i++){
    $current_var=$vars[$i];
    $code=str_replace(" $current_var"," $$current_var",$code);
  }
  //Cleaning
  $code=trim($code);
  return $code;
}
?>
