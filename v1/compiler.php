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
	jks_contains("include",$current_line)||
	jks_contains("include_once",$current_line)||
	jks_contains("require",$current_line)||
	jks_contains("require_once",$current_line)){
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
		//Include array functions
		if($functions["internal"][$i]=="array"||$functions["internal"][$i]=="array_push"){
		}else{
			$code=preg_replace('#('.$functions["internal"][$i].'+[ ]*\(.*\))#i',"no_function()",$code);
		}
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
			if($num1>$num2){
				throw new Exception("First number is higher than second number.");
			}else{
				return rand($num1,$num2);
			}
		}
		//Array
		function jks_arr_prn($arr){
			return print_r($arr);
		}
		function jks_arr_cnt($array){
			return count($array);
		}
		function jks_arr_search($search,$array){
			return array_search($search,$array);
		}
		function jks_arr_order($array){
			return sort($array);
		}
		//PRCE-functions (RegEx)
		function jks_reg_repl($regex,$replace,$string){
			return preg_replace($regex,$replace,$string);
		}
		function jks_reg_matc($regex,$string){
			return preg_match($regex,$string);
		}
		function jks_reg_matc_all($regex,$string){
			return preg_match_all($regex,$string);
		}
		function jks_reg_spli($regex,$string){
			return preg_split($regex,$string);
		}
		function jks_reg_filt($regex,$replace,$string){
			return preg_filter($regex,$replace,$string);
		}
		function jks_reg_gre($regex,$array){
			return preg_grep($regex,$array);
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
		function jks_time_datetext($string,$time = '0'){
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
		function jks_string_c_html($string){
			return htmlspecialchars($string);
		}
		function jks_string_e_html($string){
			return htmlentities($string);
		}
		function jks_string_cd_html($string){
			return htmlspecialchars_decode($string);
		}
		function jks_string_ed_html($string){
			return html_entity_decode($string);
		}
		function jks_string_slashes_add($string){
			return addslashes($string);
		}
		function jks_string_slashes_addc($string){
			return addcslashes($string);
		}
		function jks_string_slashes_remove($string){
			return removeslashes($string);
		}
		function jks_string_slashes_strip($string){
			return stripslashes($string);
		}
		function jks_string_slashes_stripc($string){
			return stripcslashes($string);
		}
		//Boolean functions
		function jks_bool_isst($string){
			return isset($string);
		}
		function jks_bool_bool_is($string){
			return is_bool($string);
		}
		function jks_bool_array_is($string){
			return is_array($string);
		}
		function jks_bool_string_is($string){
			return is_string($string);
		}
		function jks_bool_int_is($string){
			return is_int($string);
		}
		function jks_bool_integer_is($string){
			return is_integer($string);
		}
		function jks_bool_double_is($string){
			return is_double($string);
		}
		function jks_bool_float_is($string){
			return is_float($string);
		}
		function jks_bool_long_is($string){
			return is_long($string);
		}
		function jks_bool_null_is($string){
			return is_null($string);
		}
		function jks_bool_numeric_is($string){
			return is_numeric($string);
		}
		function jks_bool_binary_is($string){
			return is_binary($string);
		}
		function jks_bool_object_is($string){
			return is_object($string);
		}
		function jks_bool_c_v($string){
			return boolval($string);
		}
	//End JKS functions
  //Cleaning
  $code=trim($code);
  return $code;
}
//End Parsing
//Important functions for compiler
function jks_contains($substring, $string) {
	$pos = strpos($string, $substring);
	if($pos === false) {
		return false;
	}
	else {
		return true;
	}
}
?>
