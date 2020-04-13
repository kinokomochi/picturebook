<?php
session_start();
require_once __DIR__ . './../vendor/autoload.php';
require_once './../init.php';
require_once('mypage_class.php');

$login = checkLoginStatus();
if(!$login){
    header('Location:./../login/login.php');
}
displayLink($login);
if($login){
    $pdo =connectDB();
    $user = new Mypage($pdo, $_SESSION['id']);
    $user = $user->findUser($pdo, $_SESSION['id']);

    $post = new Mypage();
    $pbooks = $post->findPbooks($pdo, $_SESSION['id']);

    $message = $user['nickname'].'さんのマイページ';
    require_once('mypage.tpl.php');
}