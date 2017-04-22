<?php
require_once("app_config.php");
$error_message=$_REQUEST['error_message'];
 if (isset($_REQUEST['error_message'])) 
 {
     $error_message = preg_replace("/\\\\/", '', $_REQUEST['error_message']);
 } 
else 
{
        $error_message = "This is just some strange problem. All fine :D";
 } 
if (isset($_REQUEST['system_error_message'])) 
{
    $system_error_message = preg_replace("/\\\\/", '',
    $_REQUEST['system_error_message']); 
} 
else 
{
    $system_error_message = "Сообщения о системных ошибках отсутствуют.";
 } 
?> 
<html>
    <head>
        <title>Ahtung</title>
        <link rel="icon" href="images/error.png" type="image">
        <style>
            body{background-color: darkgrey;
            color:#494949;}
            h1{
                padding:20px;
                margin-left:25%;
            }
            h2{
                padding:10px;
                margin-left:25%;
            }
            img{margin-left:  25%;}
            .fromphp{margin-left:52.5%;padding:0px;}
        </style>
    </head>
    <body>
        <h1>Sorry, but Something goes wrong while we work on your query :C</h1>
        
        <h1>You, also can return on  <a href="javascript:history.go(-1);">previous page</a></h1>
       
        <h2>We know what that was.</h2>

        <?php echo  "<h2>$error_message</h2>";?>
        <h2>And we working in that</h2>
        <h2>Click on panda, if u want to go on home page</h2>
        <a href="http://localhost/training/index.php">
        <img src="images/404.png">
        </a>
        </br>
        <?php 
            debug_print("<hr/>");
            debug_print("<p>We have error system level:</br> <strong>{$system_error_message}</strong></p>")
            
        ?>
    </body>
</html>