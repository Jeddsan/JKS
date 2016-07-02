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
                <textarea name="input" placeholder="Your code here"></textarea>
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

$variables = array("" => '');

function getParseResult($code){
    $result = "";
    $regex_defined_variables = "/(var [a-zA-Z_]+[ ]*=[a-zA-Z0-9_\"{}+!?. ]+;)/";
    preg_match_all($regex_defined_variables, $code, $matches);
    echo("Number of defined variables: ".count($matches[0])."<br />");
    for($i = 0;$i<count($matches[0]);$i++){
        $var = $matches[0][$i];
        $var = substr($var,4);
        $var = str_replace(" ","",$var);
        $parts = split("=",$var);
        $variables[$parts[0]] = $parts[1];
        echo("Defined variable: ".$var."<br />");
    }

    echo("<b>Stored variables:</b> <br />");
    print_r($variables);
    return $result;
}
?>
