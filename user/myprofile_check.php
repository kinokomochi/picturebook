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

$user = makeNewProfileFromPost();
//エラーチェック
$error = validateNewProfile($user);
logD($error, '$myimgerror');
$_SESSION['rewrite'] = $user;
var_dump($_SESSION);
if(profileHasError($error)){
    $message = '入力内容に不備があります';
    require_once 'myprofile_edit.tpl.php';
    exit;
}
if(!profileHasError($error)){
    logD($user, 'check user');
    $message = 'この内容で更新してよろしいですか？';
    $rewrite = makeNewProfileFromPost();
    var_dump($rewrite);
    require_once 'myprofile_check.tpl.php';
}
