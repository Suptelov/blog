<?php
require_once ("../app_config.php");
$_SESSION['user_id'] = null;
session_unset();
header("Location: ../index.php");