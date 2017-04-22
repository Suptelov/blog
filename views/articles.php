<?php
require_once("../database_connection.php");
require_once("../app_config.php");

if ((!isset($_SESSION['user_id'])) || (!strlen($_SESSION['user_id']) > 0)) {
    header("Location: http://localhost/training/main/login.html");
    exit;
}


    $query="Select * FROM articles;";

    $result=mysqli_query($link, $query)
        or handle_error("Cant take articles"  , "db error");

?>

    <head>
        <link rel="stylesheet" type="text/css" href="http://localhost/training/main/mystyle.css">
    </head>
<div class="articles">
    <?php
        require_once ("header.php");
    ?>
    <?php

    foreach($result as $a):?>


        <div class="article">
            <div class="title">
                <a href="article.php?id=<?=$a["id"]?>"><?=$a["title"]?></a>
            </div>
            <em>Published: <?=$a["date"]?></em>
            <p class="content"><?=$a["content"]?></p>
            <p class="author">
                <a href="<?php echo "http://localhost/training/main/user_profile.php?user_id=".$a['user_id'] ; ?>" >Author</a>
            </p>
        </div>


    <?php endforeach ?>

</div>
