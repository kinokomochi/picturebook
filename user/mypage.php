<?php
session_start();
require_once __DIR__ . './../vendor/autoload.php';
$login = checkLoginStatus();
displayLink($login);

if(!$login){
    header('Location:./../login/login.php');
}
$pdo =connectDB();
if($_GET['user_id'] == $_SESSION['id']){
    $user = findUserInfo($pdo, $_SESSION['id']);
    list($pbooks, $pages) = findUserPost($pdo, $_SESSION['id'], $_GET['page']);
}elseif($_GET['user_id'] != $_SESSION['id']){
    $user = findUserInfo($pdo, $_GET['user_id']);
    list($pbooks, $pages) = findUserPost($pdo, $_GET['user_id'], $_GET['page']);
}
$_SESSION['new'] = 'mypage';
$_SESSION['edit'] = 'mypage';
$message = $user['nickname'].'さんのマイページ';
require_once('mypage.tpl.php');
