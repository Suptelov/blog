<?php
require_once ("app_config.php");
echo $root;
session_start();
$_SESSION['test'] = "Hello, world!";
echo "<div></div>";
echo $_SESSION['test'];