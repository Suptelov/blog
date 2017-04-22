<?php
require_once("../database_connection.php");
require_once("../app_config.php");
if ((!isset($_SESSION['user_id'])) || (!strlen($_SESSION['user_id']) > 0)) {
    header("Location: http://localhost/training/main/login.html");
    exit;
}
$query= "Select * From Users;";
$result= mysqli_query($link, $query)
    or handle_error("cant take users from db", "blabla blaaaaa");

?>
<head>
    <title>All users</title>

    <link rel="stylesheet" type="text/css" href="http://localhost/training/main/mystyle.css">
</head>
<?php
    require_once ("header.php");
?>
<div class="box">
<?php
   foreach($result as $a):?>

        <div class="user-jail">
            <div class="user-name">
                <a href="http://localhost/training/main/user_profile.php?user_id=<?=$a['user_id']?>">
                    <?php echo "<p>{$a['first_name']} {$a['last_name']}" ;?>
                </a>
            </div>
            <div class="face">
                <p><img class="avatar" alt="Ooops, thats not image" src="<?php echo $a['user_pic_path'] ?>" />
            </div>

        </div>
    <?php endforeach ?>
        </div>

