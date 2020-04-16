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

$user = makeNewPassFromPost();
//エラーチェック
$pdo = connectDB();
$cerror = validateCurrentPass($pdo, $_SESSION['id'], $user);
$error = validateNewPass($pdo, $user);

logD($cerror, '$pwerror cerror');
logD($error, '$pwerror nerror');

if(HasPasswordError($cerror, $error)){
    $message = '入力内容に不備があります';
    require_once 'myPassword_edit.tpl.php';
    exit;
}
if(!HasPasswordError($cerror, $error)){
    logD($user, 'checkuser newpass');
    $user['newPass'] = password_hash($user['newPass'], PASSWORD_BCRYPT);
    $newPass = $user['newPass'];

    $pdo = connectDB();
    updatePW($pdo, $_SESSION['id'], $newPass);
    header('Location:mypage.php');
    exit;
}
