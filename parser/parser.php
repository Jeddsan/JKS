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
                <textarea name="input" placeholder="Enter JKS Code here"></textarea>
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
function getParseResult($toparse){
    // TODO
    return $result;
}
?>
