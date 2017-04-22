<?php
require_once("../database_connection.php");
require_once("../app_config.php");
$user_mail = $_POST['email'];
$user_ps = $_POST['password'];
if (!isset($user_mail) || !isset($user_ps)) {
    handle_error("Wrong user mail or password", $user_mail . " AND " . $user_ps);
}
$user_mail = trim($user_mail);
$user_ps = crypt(trim($user_ps), $user_mail);
$query = sprintf("SELECT user_id, rights From users WHERE email='%s' AND password='%s';",
    mysqli_real_escape_string($link, $user_mail),
    mysqli_real_escape_string($link, $user_ps)
);
$result = mysqli_query($link, $query)
or handle_error("cant take this user from database", $user_mail . " " . $user_ps);
if (mysqli_num_rows($result) != 0) {
    //correct user
    $take_data = mysqli_fetch_assoc($result);
    $current_user_id = $take_data['user_id'];
    $rights = $take_data['rights'];
} else {

    header("Location: login.html");
    exit();
}

session_start();
$_SESSION['user_id'] = $current_user_id;
$_SESSION['user_email'] = $user_mail;
$_SESSION['user_ps'] = $user_ps;
$_SESSION['rights'] = $rights;
session_write_close();
//setcookie("user_email", $user_mail, strtotime( '+30 days' ) , '/');
//setcookie("user_ps", $user_ps, strtotime( '+30 days' ) , '/');
//setcookie("user_id", $current_user_id,strtotime( '+30 days' ) ,  '/', "localhost");
header("Location:user_profile.php?user_id=" . $current_user_id);
