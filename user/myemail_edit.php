<?php
session_start();
require_once __DIR__ . './../vendor/autoload.php';
$login = checkLoginStatus();
if(!$login){
    header('Location:./../login/login.php');
}

if(isset($_GET['action'])){
    $user = $_SESSION['rewrite'];
    $message = '新しいメールアドレスを登録してください';
    logD($user, 'rewrite email');
    require_once 'myemail_edit.tpl.php';
    exit;
}
$pdo = connectDB();
$user = findUserEmail($pdo, $_SESSION['id']);
logD($user, 'myemail user');
$message = '新しいメールアドレスを入力してください';
require_once 'myemail_edit.tpl.php';
