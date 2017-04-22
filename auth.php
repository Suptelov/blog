<?php
// подключаемся к бд
require_once("database_connection.php");
require_once("app_config.php");





if  ( (!isset($_SERVER['PHP_AUTH_USER'])) || (!isset($_SERVER['PHP_AUTH_PW'])) )
{
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="The Social Site"');
    exit("In previous form YOU should write right pair email/password");

}
$auth_user = trim($_SERVER['PHP_AUTH_USER']);
$auth_pw = crypt(trim($_SERVER['PHP_AUTH_PW']), $auth_user );

$query= sprintf("SELECT user_id FROM users where email='%s' AND password='%s' ;",
    mysqli_real_escape_string($link,$_SERVER['PHP_AUTH_USER'] ),
    mysqli_real_escape_string($link,
        crypt(trim($_SERVER['PHP_AUTH_PW']), $_SERVER['PHP_AUTH_USER'] ) ) );
$result= mysqli_query($link, $query);
if (mysqli_num_rows($result)==1){
    //correct user
    $take_data = mysqli_fetch_assoc($result);
    $current_user_id = $take_data['user_id'];
}
else {
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="The Social Site"');
    exit("In previous form YOU should write right pair login/password");

}
?>
