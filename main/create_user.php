<?php

// require_once проверяет подключен ли этот файл к сценарию, если нет то подключает.
require_once("../database_connection.php");
require_once("../app_config.php");
// константа объявленная в app_config
// $upload_dir= HOST_WWW_ROOT. "uploads/profile_pics/";
$upload_dir = "../uploads/profile_pics/";
$image_fieldname = "user_pic";

//создаем массив для отлова ошибок, но индексация ведется с 1 элта, а не 0, так как
// для работы программы php, если переменная error = 0, то все ок
// следовательно для того, чтобы не было конфликтов создается массив с индексами 1 и 
//более
$php_errors = array(
    1 => 'More then max size in php.ini',
    2 => 'More then max size in php.ini',
    3 => 'Not full file',
    4 => 'User dont choose the file'
);
// режем поля, чтобы не было пробелов
$first_name = trim($_REQUEST['first-name']);
$last_name = trim($_REQUEST['last-name']);
$password = trim($_REQUEST['password']);
$email = trim($_REQUEST['email']);
$bio = trim($_REQUEST['bio']);
$facebook_url = trim($_REQUEST['facebook-url']);
// определяем есть ли в урлах имена доменов и собака в случае твиттера
$regexpF = '/vk\.com/i';
if (!isset($_REQUEST['changes'])) {
    $unique_mail = sprintf("SELECT user_id FROM users WHERE email= '%s'",
        mysqli_real_escape_string($email)
    );
    $unique_mail_result = mysqli_query($link, $unique_mail);
    if (!(mysqli_num_rows($unique_mail_result))) {
        handle_error("User with that mail box already exist on this site, take other", "user already exist  " . $email);
        exit();
    }
}
if (!preg_match($regexpF, $facebook_url)) {
    $facebook_url = "http://www.vk.com/" . $facebook_url;
}
$twitter_handle = trim($_REQUEST['twitter-handle']);
$twitter_url = "http://www.twitter.com/";

$regexpT = '/@/';
if (!(preg_match($regexpT, $twitter_handle))) {
    $twitter_url = $twitter_url . $twitter_handle;
} else {
    $twitter_handle = substr($twitter_handle, 1);
    $twitter_url = $twitter_url . $twitter_handle;
}
($_FILES[$image_fieldname]['error'] == 0)
    or handle_error("server can not take your image because", $php_errors[$_FILES[$image_fieldname]['error']]);


// проверка имени файла, чтобы функция не выкидывала встроенное сообщение ошибки 
//ставится @ в начало, если что-то не так то исполняется функция handle error
@is_uploaded_file($_FILES[$image_fieldname]['tmp_name'])
    or handle_error("what are u doing, bastard !", "your name" . "'{$_FILES[$image_fieldname]['tmp_name']}'");


//для проверки является ил данный фалй изображением, проверяем его размер
// так как если это не изображение, то функция вернет ошибку
@getimagesize($_FILES[$image_fieldname]['tmp_name'])
or handle_error("this is not pic", "{$_FILES[$image_fieldname]['tmp_name']} ");


// именем файла на сервере будет служить тек время $now
// для создания уникального файла
// пока истина (ФайлСуществует (дирректория. текВремя.-. имяКотороеДалUSER)){ТекВремя++} 
$now = time();
while (file_exists($upload_filename = $upload_dir . $now . '-' . $_FILES[$image_fieldname]['name'])) {
    $now++;
}
@move_uploaded_file($_FILES[$image_fieldname]['tmp_name'], $upload_filename)
or handle_error("возникла проблема сохранения вашего изображения " .
    "в его постоянном месте.",
    "ошибка, связанная с правами доступа при перемещении " .
    "файла в {$upload_filename}");
if (isset ($_REQUEST['changes'])) {
    $update = $_REQUEST['changes'];
    $update_sql = sprintf("UPDATE users SET 
first_name ='%s',
 last_name='%s',
 email='%s', 
 facebook_url='%s',
  twitter_handle='%s', 
  bio='%s',
  user_pic_path='%s' 
  WHERE user_id= '%d' ;",
        mysqli_real_escape_string($link,$first_name )  ,
        mysqli_real_escape_string($link,$last_name ) ,
        mysqli_real_escape_string($link, $email) ,
        mysqli_real_escape_string($link,$facebook_url ) ,
        mysqli_real_escape_string($link,$twitter_handle ),
        mysqli_real_escape_string($link,$bio ),
        mysqli_real_escape_string($link,$upload_filename ),
        mysqli_real_escape_string($link, $_SESSION['user_id'])
    );
    mysqli_query($link,$update_sql )
        or handle_error("can not update your data" , $str=mysqli_error($link) );
    header("Location: user_profile.php?user_id=" . $_SESSION['user_id']);
    exit();

}
else {
    $pass_hide = crypt($password, $email);
// вставляем в базу данных вышеперданный набор значений
    $insert_sql = "INSERT INTO users(first_name, last_name,password, email, facebook_url, twitter_handle, bio,user_pic_path)" .
        "VALUES('{$first_name}',
        '{$last_name}',
        '{$pass_hide}' 
        ,'{$email}',
        '{$facebook_url}',
        '{$twitter_handle}',
        '{$bio}',
        '{$upload_filename}');";
    mysqli_query($link, $insert_sql)
    or handle_error("Something goes wrong", mysqli_error());
    header("Location: user_profile.php?user_id=" . mysqli_insert_id($link));
    exit();
}