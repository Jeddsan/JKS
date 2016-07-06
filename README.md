#Important Note:

This software is in the alpha stages, please do NOT use this in a production environment!

# What is JKS
JKS stands for Jeddsan Kora Script and is the main programming language for Jeddsan Kora. It based on PHP. JKS at self is only a new Syntax which let you programm your own modules with Jeddsan Kora.

# How to install
At the moment, the compiler is still in alpha and must updated mostly every day.

# How to use as a standalone application
The syntax is simple. You must require the compiler.php file on the top of your PHP-File.<br>
```php
require "v1/compiler.php";
```
<br><br>
After that you can programm your code in a string like this.<br>
```php
$code = '
var data = 34;
echo data;
';
```
<br><br>
Then you make a parse with the compiler like that:<br>
```php
  $php_code = parseJKS($code);
```
<br><br>
If you got the new PHP Code you can run it via the command <code>eval()</code><br><br>
Now your ready to programm with the new JKS syntax.

Enjoy!

# Special thanks
- NoRelect
