<?php
require_once ("..//app_config.php");
require_once ("../database_connection.php");
$user_id = $_REQUEST['user_id'];
$request = sprintf("Select * from users where user_id = '%d'",
      mysqli_real_escape_string($link,$user_id)
);
$result = mysqli_query($link, $request);
$arr_result = mysqli_fetch_assoc($result);

?>
<header>
    <link rel="stylesheet" type="text/css" href="http://localhost/training/main/mystyle.css">
</header>
<?php
require_once ("../views/header.php");
?>

<!-- Вопросик на счет реализации изменений, посмотреть как было у Хауди, в одном скрипте изменения-->

<form action="create_user.php?changes=1" method="post" enctype="multipart/form-data">
    <fieldset>
        <label for="first-name">Name:</label>
        <input type="text" value="<?php echo $arr_result['first_name'] ?>" name="first-name" size=20/> <br/>

        <label for="last-name">Last Name:</label>
        <input type="text" value="<?php echo $arr_result['last_name'] ?>" name="last-name" size=20/> <br/>

        <label for="email">Email:</label>
        <input type="text" value="<?php echo $arr_result['email'] ?>" name="email" size=20/> <br/>

        <label for="facebook-url">URL in Facebook:</label>
        <input type="text" value="<?php echo $arr_result['facebook_url'] ?>" name="facebook-url" size=30/> <br/>

        <label for="twitter-handle">Your Twitter ID:</label>
        <input type="text" value="<?php echo $arr_result['twitter_handle'] ?>" name="twitter-handle" size=30/> <br/>



        <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
        <label for="user_pic">Send pic:</label>
        <input type="file" name="user_pic" size="30" />

        <p class="file-label">
            <label  for="bio">Bio</label>
            <textarea  name="bio" cols="50" rows="10"><?php echo $arr_result['bio'] ?></textarea>
        </p>

    </fieldset>
    <br/>
    <fieldset class="center">
        <input type="submit" value="Save changes"/>
    </fieldset>


</form>
