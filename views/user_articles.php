<?php
require_once("../database_connection.php");
require_once("../app_config.php");
if ((!isset($_SESSION['user_id'])) || (!strlen($_SESSION['user_id']) > 0)) {
    header("Location: http://localhost/training/main/login.html");
    exit;
}
if(isset($_REQUEST['user_id'])) {
    $user_id = $_REQUEST['user_id'];
    $user_id = $_REQUEST['user_id'];
    $query = sprintf("Select * FROM articles where user_id='%s';",
        mysqli_real_escape_string($link, $user_id));
    $result = mysqli_query($link, $query)
    or handle_error("Cant take user" . $user_id . " articles", "db error");

    if (mysqli_num_rows($result) < 1) {
        handle_error("Sorry, but you dont have articles", $_COOKIE['user_id'] . " value of COOKIE user_id");
    }

}
else{
    handle_error("Log in please", "not logged user try take articles");

}
?>

    <head>
        <link rel="stylesheet" type="text/css" href="http://localhost/training/main/mystyle.css">
    </head>
<?php
    require_once ("header.php");
?>
<div class="articles">

    <?php
    foreach($result as $a):?>


        <div class="article">
            <div class="title">
                <a href="article.php?id=<?=$a["id"]?>"><?=$a["title"]?></a>
            </div>
            <em>Published: <?=$a["date"]?></em>
            <p class="content"><?=$a["content"]?></p>
            <p class="author"><a href="<?php echo "http://localhost/training/main/user_profile.php?user_id=".$a['user_id'] ; ?>" >Author</a> </p>
        </div>


    <?php endforeach ?>

</div>
