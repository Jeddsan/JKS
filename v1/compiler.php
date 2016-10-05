<?php
/*
Jeddsan JKS Compiler v1
Version: 1
Author: Jeddsan, NoRelect
Build Date: 05.10.2016
License: MIT License
*/
//Error Exception
class JKSParseError extends Exception {
  public function errorMessage() {
    //error message
    $errorMsg = '<br><br><b>JKS Parse Error:</b> Fatal error: <b>'.$this->getMessage().'</b><br><br>';
    return $errorMsg;
  }
}
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
	jks_contains("require_once",$current_line)||
  jks_contains("fwrite",$current_line)||
  jks_contains("fopen",$current_line)){
	}else{
	  $code.=$current_line."\n";
	}
  }
  //Remove <?php and >
  do{
    $code = str_ireplace("<?php","",$code,$times1);
    $code = str_ireplace("?>","",$code,$times2);
  }while($times1>0||$times2>0);
  do{
    $code = str_ireplace("<?","",$code,$times3);
  }while($times3>0);
  //Variables
  /*$code=str_replace("var ","$",$code,$count_set_variables);
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
}*/
  //Functions
	$functions=get_defined_functions();
	for($i=0;$i<count($functions["internal"]);$i++){
		//$code=str_replace($functions["internal"][$i]."(","no_function(",$code);
		//Include array functions
		if($functions["internal"][$i]=="array"||$functions["internal"][$i]=="array_push"){
		}else{
			$code=preg_replace('#('.$functions["internal"][$i].'[ |\n|\r|\t]*\([ |\n|\r|\t]*.*?\))#si',"no_function()",$code);
		}
	}
	//Deactivate all javascripts
	$count=1;
	while($count!=0){
		$code = preg_replace('#(<[\s]*script\b[^>]*>([\s\S]*?)<[\s]*\/[\s]*script[\s]*>)#i','',$code,-1,$count);
	}

	//Android functions
	function jks_android_createEvent($start,$end,$name){
		$start=htmlspecialchars($start);
		$end=htmlspecialchars($end);
		$name=htmlspecialchars(trim($name));
		if($start!=0||$end!=0||$name!=""){
			echo "<script>Android.createEvent($start,$end,false,$name);</script>";
			return true;
		}else{
			return false;
		}
	}
	function jks_android_setAlarm($hour,$minutes,$name){
		$hour=htmlspecialchars($hour);
		$minutes=htmlspecialchars($minutes);
		$name=htmlspecialchars(trim($name));
		echo "<script>Android.setAlarm($hour,$minutes,'$name')</script>";
		return true;
	}
	function jks_android_setBrightness($value){
		$value=htmlspecialchars(trim($value));
		echo "<script>Android.setBrightness($value)</script>";
		return true;
	}
  function jks_android_setHueLightState($name,$state){
		$name=htmlspecialchars(trim($name));
    $state=htmlspecialchars(trim($state));
		return "<script>Android.setHueLightState('$name',$state)</script>";
	}
  function jks_android_setHueLightDim($name,$number){
		$name=htmlspecialchars(trim($name));
    $number=htmlspecialchars(trim($number));
		return "<script>Android.setHueLightDim('$name',$number)</script>";
	}
  function jks_android_setMyStromState($name,$number){
		$name=htmlspecialchars(trim($name));
    $number=htmlspecialchars(trim($number));
		return "<script>Android.setMyStromState('$name',$number)</script>";
	}
  function jks_android_setMyStromToggle($name){
		$name=htmlspecialchars(trim($name));
		return "<script>Android.setMyStromToggle('$name')</script>";
	}

	//Null-Function
	function no_function(){
		try{
			throw new JKSParseError("Function not known");
		}catch(JKSParseError $e){
			echo $e->errorMessage();
		}
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
		function jks_math_tang($num){
			return tan($num);
		}
		function jks_math_sinu($num){
			return sin($num);
		}
		function jks_math_cosi($num){
			return cos($num);
		}
		function jks_math_log($num){
			return log($num);
		}
		function jks_math_expo($num){
			return exp($num);
		}
    function jks_math_modulo($x,$y){
			return fmod($x,$y);
		}
		function jks_math_min($array){
			return min($array);
		}
		function jks_math_max($array){
			return max($array);
		}
			//Pi
			function jks_math_pi_number(){
				return pi();
			}
			//Numbersystems
			function jks_math_dec2bin($number){
				return decbin($number);
			}
			function jks_math_bin2dec($number){
				return bindec($number);
			}
			function jks_math_dec2hex($number){
				return dechex($number);
			}
			function jks_math_hex2dec($number){
				return hexdec($number);
			}
			function jks_math_dec2oct($number){
				return decoct($number);
			}
			function jks_math_oct2dec($number){
				return octdec($number);
			}
			function jks_math_bin2hex($number){
				return bin2hex($number);
			}
			function jks_math_hex2bin($number){
				return hex2bin($number);
			}
			function jks_math_base_c($number,$from=10,$to=2){
				return base_convert($number,$from,$to);
			}
			//Randomnumber
			function jks_math_random($num1,$num2){
				if($num1>$num2){
					try{
						throw new JKSParseError("First number is higher than second number.");
					}catch(JKSParseError $e){
						echo $e->errorMessage();
					}
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
		function jks_arr_keys($array){
			return array_keys($array);
		}
		function jks_arr_values($array){
			return array_values($array);
		}
		function jks_arr_diff($array1,$array2){
			return array_diff($array1,$array2);
		}
		function jks_arr_diff_assoc($array1,$array2){
			return array_diff_assoc($array1,$array2);
		}
		function jks_arr_last_delete($array){
			return array_pop($array);
		}
		function jks_arr_array_in($search,$array){
			return in_array($search,$array);
		}
		function jks_arr_shuf($array){
			return shuffle($array);
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
		function jks_gt_csv($url,$seperator=",",$enclosure='"',$escape="\n"){
			$get = file_get_contents($url);
			$data = str_getcsv($get,$seperator,$enclosure,$escape);
			return $data;
		}
		//Time
		function jks_time_curtim(){
			return time();
		}
		function jks_time_datetext($string,$time = '0'){
			return date($string,$time);
		}
		function jks_time_string_c($string){
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
		function jks_string_repe($string,$times){
			return str_repeat($string,$times);
		}
		function jks_string_shuf($string){
			return str_shuffle($string);
		}
		function jks_string_sub($start,$end,$string){
			if($start>$end){
				try{
					throw new JKSParseError("Start is higher than end.");
				}catch(JKSParseError $e){
					echo $e->errorMessage();
				}
			}else{
				return substr($string,$start,$end-$start+1);
			}
		}
		// Decoding/Encoding
		function jks_string_html_c($string){
			return htmlspecialchars($string);
		}
		function jks_string_html_e($string){
			return htmlentities($string);
		}
		function jks_string_html_cd($string){
			return htmlspecialchars_decode($string);
		}
		function jks_string_html_ed($string){
			return html_entity_decode($string);
		}
		function jks_string_base64_d($string){
			return base64_decode($string);
		}
		function jks_string_base64_e($string){
			return base64_encode($string);
		}
    function jks_string_utf8_d($string){
			return utf8_decode($string);
		}
    function jks_string_utf8_e($string){
			return utf8_encode($string);
		}
    function jks_string_url_d($string){
			return urldecode($string);
		}
    function jks_string_url_e($string){
			return urlencode($string);
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
		function jks_string_impl($array){
			return implode($array);
		}
		function jks_string_expl($split,$string){
			return explode($split,$string);
		}
		function jks_string_soundex_c($string){
			return soundex($string);
		}
		function jks_string_metaphone_c($string){
			return metaphone($string);
		}
		//Uppercase/Lowercase
		function jks_string_down($string){
			return strtolower($string);
		}
		function jks_string_up($string){
			return strtoupper($string);
		}
		function jks_string_word_u($string){
			return ucwords($string);
		}
		function jks_string_first_u($string){
			return ucfirst($string);
		}
		//Correction
		function jks_string_tr($string){
			return trim($string);
		}
		function jks_string_wowr($string,$length=75,$break="\n"){
			return wordwrap($string,$length,$break);
		}
		function jks_string_spli($string,$length=1){
			return str_split($string,$length);
		}
		function jks_string_2br($string){
			return nl2br($string);
		}
		function jks_string_format_number($number,$decimals,$decimalpoint,$seperator){
			return number_format($number,$decimals,$decimalpoint,$seperator);
		}
		//Hash
		function jks_string_hashing($algo="sha256",$string){
			return hash($algo,$string);
		}
		function jks_string_sha1_hashing($string){
			return sha1($string);
		}
		function jks_string_md5_hashing($string){
			return md5($string);
		}
		//String stats
		function jks_string_char_cnt($string){
			return strlen($string);
		}
		function jks_string_word_cnt($string){
			return str_word_count($string);
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
		function jks_bool_finite_is($number){
			return is_finite($number);
		}
		function jks_bool_infinite_is($number){
			return is_infinite($number);
		}
		function jks_bool_nan_is($number){
			return is_nan($number);
		}
		function jks_bool_c_v($string){
			return boolval($string);
		}
		//Validations
		function jks_vali_url($url){
			if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)) {
				return false;
			}else{
				return true;
			}
		}
		function jks_vali_mailing($email){
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				return false;
			}else{
				return true;
			}
		}
		function jks_vali_name($name){
			if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
				return false;
			}else{
				return true;
			}
		}
		//Other functions
		function jks_type_get($string){
			return gettype($string);
		}
		function jks_string_contains($search,$string){
			return jks_contains($search,$string);
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
