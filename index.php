<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="images/book.ico" />
    <link rel="stylesheet" type="text/css" href="http://localhost/training/main/mystyle.css">

    <title>Start page</title>
</head>
<body>
<?php
    require_once("database_connection.php");
    require_once("app_config.php");
    require_once ($root."training/views/header.php");
?>



    <div class="main-body">
        <div class="text"> Hello, this is my blog. Welcome. You can sign in if u have account
                on my website or u can register new account button 'sign-up'
        </div>
    </div>
    <div class="box">
        <div class="button1">

            <form  action="http://localhost/training/main/login.html">
                <input  class= "in" type="submit" value="Sign in"/>
            </form>
        </div>

        <div class="button2">

                   <form  action="http://localhost/training/main/create_users.php">
                       <input  class="up" type="submit" value="Sign Up"/>
                   </form>
        </div>
    </div>

</body>
</html>