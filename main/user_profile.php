<?php
// подключаемся к бд
require_once("../database_connection.php");
require_once("../app_config.php");
if ((!isset($_SESSION['user_id'])) || (!strlen($_SESSION['user_id']) > 0)) {
    header("Location: http://localhost/training/main/login.html");
    exit;
}
$user_id = $_REQUEST['user_id'];
setcookie('current_user', $user_id);
$select_user = sprintf("SELECT first_name, last_name, email, facebook_url,twitter_handle, bio, user_pic_path
    FROM users
    WHERE user_id=%d", $user_id);
// запрос серверу "вытащить из таблицы users пользователя  с id какой передали в пременной user_id
$selected_user = mysqli_query($link, $select_user);
// преобразуем ответ сервера в массив, вытаскиваем из него требуемые для нас значения для заполнения полей формы
if ($selected_user) {
    $row = mysqli_fetch_array($selected_user);
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $email = $row['email'];

    $facebook_url = $row['facebook_url'];
    $twitter_handle = $row['twitter_handle'];
    $bio = preg_replace("/[\r\n]+/", "</p><p>", $row['bio']);
    $pic_path = $row['user_pic_path'];
} else {
    handle_error("we found problem in your query, we will fix this", "error with user id  {$user_id}");
}
$twitter_url = "http://www.twitter.com/" . $twitter_handle;
$regexpVK = '/vk.com/';
$matches = preg_match($regexpVK, $facebook_url);
if ($matches === 0) {
    $facebook_url = "http://www.vk.com/" . $facebook_url;
}
// Требуется достать картинку из таблицы images 

/*$take_image=sprintf("SELECT image_data FROM image where image_id=%d",$pic_id);
$selected_picture=mysqli_query($link, $take_image);
if ($selected_picture)
    {
        $row=mysqli_fetch_assoc($selected_picture);
        $image=$row['image_data'];
    }
*/
?>
<html>

<head>
    <title>User profile</title>

    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>

<?php
require_once($root . "/training/views/header.php");
?>

<?php if (($first_name == "") || ($last_name == "")) {
    $user_error_message = "Invalid user, try other id";
    handle_error($user_error_message, $system_error_message);
} ?>

<h1>Hello, <?php echo "{$first_name} {$last_name}"; ?>, this is your profile page on our web site</h1>
<div>
    <p><img class="avatar" alt="Ooops, thats not image" src="<?php echo $pic_path ?>"/>
        <?php echo $bio; ?>
    </p>

    <ul><?php echo "$first_name" . "'s accounts: "; ?>
        <li>
            <a href="<?php echo $email; ?>"><img class="ico" src="../images/mail.svg"></a>
        </li>
        <li>
            <a href="<?php echo $facebook_url; ?>"><img class="ico" src="../images/vk.svg"> </a>
        </li>

        <li>
            <a href="<?php echo "$twitter_url"; ?> "><img class="ico" src="../images/twitter.svg"></a>
        </li>
        <li>
            <div>
                <a href=" <?php echo "http://localhost/training/views/user_articles.php?user_id=" . $_SESSION['user_id']; ?> ">
                    User's Articles
                </a>
            </div>
        </li>
        <li>

            <?php
            if ( ($_REQUEST['user_id'] == $_SESSION['user_id'])|| ($_SESSION['rights']=="admin")) {
                echo "<div>";
                echo "<a href='http://localhost/training/main/edit.php?user_id={$user_id}'>
                                            <img class='ico' src='http://localhost/training/images/settings.svg'>
                                        </a>";
                echo "</div>";
            }
            ?>
        </li>
    </ul>

</div>
<div align="center" class="footer">
    <?php
    if (isset($_SESSION['user_email']) && isset($_SESSION['user_id'])) {
        echo "Dear User, you entered with email LIKE " . $_SESSION['user_email'] . ". " .
            "In this session your profile identification=" . $_SESSION['user_id'];
    }
    ?>
</div>
</body>


</html>
