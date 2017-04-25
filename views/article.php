<?php
require_once("../database_connection.php");
require_once("../app_config.php");


$id= $_REQUEST['id'];
$query = sprintf("SELECT * FROM articles WHERE id = '%d';",
    mysqli_real_escape_string($link, $id)
);
$result = mysqli_query($link, $query);
$res_arr = mysqli_fetch_assoc($result);
?>
<head>
    <link rel="stylesheet" type="text/css" href="http://localhost/training/main/mystyle.css">
</head>
<?php
require_once ("header.php");
?>
<div class="main">
    <h2 class="article_title">
        <?php echo $res_arr['title'];?>
    </h2>
    <div class="tags">
        <?php

            $str = $res_arr['tags'];
            $tags = explode(";", $str);
            foreach ($tags as $t):
        ?>
                <a class="tag" href="http://localhost/training/views/articles.php?tag=<?php echo $t?>"><?php echo $t?> </a>


        <?php endforeach ?>
    </div>
    <div class="date">
        <?php echo $res_arr['date'];?>
    </div>
    <div class="content">
        <?php
            echo $res_arr['content']
        ?>
    </div>
</div>

<a href="http://localhost/training/main/user_profile.php?user_id=<?php echo $res_arr['user_id'];?>">Author</a>