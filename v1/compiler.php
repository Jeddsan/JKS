<?php
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
	contains("require_once",$current_line)){

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
  
  //Functions
	$functions=get_defined_functions();
	for($i=0;$i<count($functions["internal"]);$i++){
		//$code=str_replace($functions["internal"][$i]."(","no_function(",$code);
		$code=preg_replace('('.$functions["internal"][$i].'+( )*\(.*\);)',"no_function(",$code);
	}
	//print_r($functions);
	//Null-Function
	function no_function(){
		throw new Exception("Function not known");
		return false;
	}
	//JKS functions
		//Math
		function jks_math_sum($num1,$num2){
			return $num1+$num2;
		}
		function jks_math_dif($num1,$num2){
			return $num1-$num2;
		}
		function jks_math_mul($num1,$num2){
			return $num1*$num2;
		}
		function jks_math_div($num1,$num2){
			return $num1/$num2;
		}
		function jks_math_rnd($num){
			return round($num);
		}
		function jks_math_rnd_d($num){
			return floor($num);
		}
		function jks_math_rnd_u($num){
			return ceil($num);
		}
		function jks_math_sqro($num){
			return sqrt($num);
		}
		function jks_math_tan($num){
			return tan($num);
		}
		function jks_math_sin($num){
			return sin($num);
		}
		function jks_math_cos($num){
			return cos($num);
		}
		function jks_math_log($num){
			return log($num);
		}
		function jks_math_min($array){
			return min($array);
		}
		function jks_math_max($array){
			return max($array);
		}
		function jks_math_pi_number(){
			return pi();
		}
		function jks_math_random($num1,$num2){
			return rand($num1,$num2);
		}
		//Array
		function jks_arr_prn($arr){
			return print_r($arr);
		}
		function jks_arr_cnt($array){
			return count($array);
		}
		//Get Data
		function jks_gt_json($url){
			$data=file_get_contents($url);
			$data=json_decode($data,true);
			return $data;
		}
		function jks_gt_xml($url){
			$get = file_get_contents($url);
			$data = simplexml_load_string($get);
			return $data;
		}
		//Time
		function jks_time_curtim(){
			return time();
		}
		function jks_time_datetext($string,$time){
			return date($string,$time);
		}
		function jks_time_convert_st($string){
			return strtotime($string);
		}
		//String Modifications
		function jks_string_repl($search,$replace,$string){
			return str_replace($search,$replace,$string);
		}
		function jks_string_i_repl($search,$replace,$string){
			return str_ireplace($search,$replace,$string);
		}
		function jks_string_find($search,$string){
			return strpos($string,$search);
		}
		function jks_string_i_find($search,$string){
			return stripos($string,$search);
		}
		function jks_string_sub($start,$end,$string){
			if($start>$end){
				throw new Exception("Start is higher than end.");
			}else{
				return substr($string,$start,$end-$start+1);
			}
		}
	//End JKS functions
  
  //Cleaning
  $code=trim($code);
  return $code;
}
//End Parsing
//Important functions for compiler
function contains($substring, $string) {
	$pos = strpos($string, $substring);
	if($pos === false) {
		return false;
	}
	else {
		return true;
	}
}
?>
