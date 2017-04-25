<?php
require_once ("../app_config.php");
require_once ("../database_connection.php");

$title = mysqli_real_escape_string($link, (trim($_REQUEST['title'])));
$str = str_replace(' ', '', $_REQUEST['tag']);
$tag = mysqli_real_escape_string($link, $str);
$content = mysqli_real_escape_string($link, (trim($_REQUEST['content'])));
$query = sprintf("INSERT INTO articles(user_id, title, tags, content) 
VALUES ('%d', '%s', '%s', '%s');" ,
    $_SESSION['user_id'],
    $title,
    $tag,
    $content
);
$result = mysqli_query($link, $query);

header("Location: http://localhost/training/views/article.php?id=".mysqli_insert_id($link));
exit();