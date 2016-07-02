<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Parser</title>

        <link href="style.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <div class="container">
            <form method="post" action="parser.php">
                <textarea name="input" placeholder="Your code here"><?php if(isset($_POST["input"]))echo($_POST["input"]);?></textarea>
                <button class="btn">Parse</button>
            </form>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if(isset($_POST["input"])){
                    echo getParseResult($_POST["input"]);
                }
            }
            ?>
        </div>
    </body>
</html>

<?php

$variables = array();
$functions = array();

function getParseResult($code){
    $result = "";
    $regex_defined_variables = "/(var [a-zA-Z_]+[ ]*=[a-zA-Z0-9_\"{}+\-*\/!?. ]+;)/";
    preg_match_all($regex_defined_variables, $code, $matched_defined_vars);
    echo("Number of defined variables: ".count($matched_defined_vars[0])."<br />");
    for($i = 0;$i<count($matched_defined_vars[0]);$i++){
        $var = $matched_defined_vars[0][$i];
        $var = substr($var,4);
        $var = str_replace(" ","",$var);
        $parts = split("=",$var);
        $variables[$parts[0]] = $parts[1];
    }

    $regex_number_of_functions = "/(function [a-zA-Z_]+\([a-zA-Z, ]*\)[ ]*{[a-zA-Z0-9 .=+\/();\"\-\n\r\t]*})/";
    preg_match_all($regex_number_of_functions, $code, $matched_functions);
    echo("Number of functions: ".count($matched_functions[0])."<br />");
    for($i = 0;$i<count($matched_functions[0]);$i++){
        $function = $matched_functions[0][$i];
        $function = str_replace("function ","",$function);
        $name = strstr($function,'(',true);
        $function = str_replace($name,"",$function);
        $functions[$name] = $function;
    }

    echo("<b>Stored variables:</b> <br />");
    print_r($variables);
    echo("<br /><b>Stored functions:</b> <br />");
    print_r($functions);
    return $result;
}
?>
