<?php
session_start();
require_once __DIR__ . './../vendor/autoload.php';

$login = checkLoginStatus();
if(!$login){
    header('Location:./../login/login.php');
}

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location:../room.php');
    exit;
}

if(!CsrfValidator::validate(filter_input(INPUT_POST, 'token'))){
    header('Content-type: text/plain; charset=UTF-8', true, 400);
    die('CSRF validation failed.');
}

$user = makeNewEmailFromPost();

$pdo = connectDB();
$error = validateNewEmail($pdo, $user);
logD($error, '$myemail error');
$_SESSION['rewrite'] = $user;
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
