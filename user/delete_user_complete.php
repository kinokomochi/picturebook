<?php
session_start();
require_once __DIR__ . './../vendor/autoload.php';
if(!isset($_SESSION['id']) || ($_SESSION['time'] + 3600)  <= time()){
    header('Location:./../login/login.php');
}
$pdo = connectDB();
$user = findUserInfo($pdo, $_SESSION['id']);

deleteUserPost($pdo, $_SESSION['id']);
deleteUser($pdo, $_SESSION['id']);
$_SESSION = array();
session_destroy();
require_once 'delete_user_complete.tpl.php';