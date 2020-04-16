<?php
session_start();
require_once __DIR__ . './../vendor/autoload.php';

//ログイン認証
$login = checkLoginStatus();
if(!$login){
    header('Location:./../login/login.php');
}
//現在の画像取得
$pdo = connectDB();
$user = findUserInfo($pdo, $_SESSION['id']);
require_once 'myimg_edit.tpl.php';