<?php
session_start();
require_once __DIR__ . './../vendor/autoload.php';
$login = checkLoginStatus();
if(!$login){
    header('Location:./../login/login.php');
}

if(isset($_GET['action'])){
    $user = $_SESSION['rewrite'];
    $message = '新しいプロフィールを登録してください';
    logD($user, 'rewrite user');
    require_once 'myprofile_edit.tpl.php';
    exit;
}
$pdo = connectDB();
$user = findUserInfo($pdo, $_SESSION['id']);
list($user['year'], $user['month'], $user['day']) = explode("-", $user['birthday']);
$_SESSION['image'] = $user['image'];
logD($user, 'myprofile user');
$message = '新しいプロフィールを登録してください';
require_once 'myprofile_edit.tpl.php';
