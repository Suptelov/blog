

<?php
 require_once("../database_connection.php");
 require_once("../app_config.php");

$user_id=$_REQUEST['user_id'];
$query=sprintf("Delete from users where user_id=%d", $user_id);
mysqli_query($link, $query)
    or handle_error("OOops {$user_id} was too strong", "{$user_id} cant be deleted");
echo "<p>User {$user_id} was deleted</p>";

?> 