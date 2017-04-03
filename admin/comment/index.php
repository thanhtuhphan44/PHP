<?php
require_once '../../library/config.php';
require_once '../library/functions.php';

$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
checkUser();
$content = "comment.php";
$script    = 0;

require_once '../include/template.php';
?>