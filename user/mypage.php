<?php
session_start();
require_once __DIR__ . './../vendor/autoload.php';
$login = checkLoginStatus();
displayLink($login);

if(!$login){
    header('Location:./../login/login.php');
}
if($login){
    $pdo =connectDB();
    $user = findUserInfo($pdo, $_SESSION['id']);

    $pbooks = findUserPost($pdo, $_SESSION['id']);

    $message = $user['nickname'].'さんのマイページ';
    require_once('mypage.tpl.php');
}