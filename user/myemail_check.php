<?php
session_start();
require_once __DIR__ . './../vendor/autoload.php';
//ログイン認証
$login = checkLoginStatus();
if(!$login){
    header('Location:./../login/login.php');
}
//postを受け取る
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location:../room.php');
    exit;
}

$user = makeNewEmailFromPost();
//エラーチェック
$pdo = connectDB();
$error = validateNewEmail($pdo, $user);
logD($error, '$myemail error');
$_SESSION['rewrite'] = $user;
var_dump($_SESSION);
if(!empty($error['email'])){
    $message = '入力内容に不備があります';
    require_once 'myemail_edit.tpl.php';
    exit;
}
if(empty($error['email'])){
    logD($user, 'check newemail');
    $message = 'この内容で更新してよろしいですか？';
    $rewrite = makeNewEmailFromPost();
    require_once 'myemail_check.tpl.php';
}
