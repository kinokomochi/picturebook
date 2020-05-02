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

$user = makeUserImageFromPost();
$error = validateMyImage($user);
logD($error, '$myimgerror');

if($error['newImage']){
    $pdo =connectDB();
    $user = findUserInfo($pdo, $_SESSION['id']);
    require_once 'myimg_edit.tpl.php';
    exit;
}

if(!$error['newImage']){
    $message = 'この画像に更新してよろしいですか？';
    $user['newImage'] = date('YmdHis') . $user['newImage'];
    move_uploaded_file($_FILES['newImage']['tmp_name'], '/Applications/XAMPP/xamppfiles/htdocs/pbook/files/'.$user['newImage']);
    $_SESSION['newImage'] = $user['newImage'];
    logD($_FILES['newImage']['name'], 'make a myimg');
    require_once 'myimg_check.tpl.php';
}
