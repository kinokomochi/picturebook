<?php 
session_start();
require_once __DIR__ . '/../vendor/autoload.php';
require_once('../init.php');

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location:../room.php');
    exit;
}

//signup.phpから値を受とる
// var_dump($_POST);
$user = makeSignupUserFromPost();
var_dump($user['image']);
$pdo = connectDB();
$error = validateSignupUser($pdo, $user);
$passwordError = validatePW($user);
logD($passwordError, '$passwordError');
logD($error, '$error');

//$errorが空でなければsignup_check.tpl.phpを呼び出す
//書き直しの場合はsignup.tpl.phpを呼び出す
if((signupHasError($error)) || (signupHasPasswordError($passwordError))){
    logD($user, 'user');
    logD($error, 'error');
    $message = '入力内容に不備があります';
    require('signup.tpl.php');
    exit;
}
if((!signupHasError($error)) && (!signupHasPasswordError($passwordError))){
    $_SESSION['join'] = $_POST;
    $_SESSION['token'] = $token = mt_rand();
    $user['password'] = password_hash($user['password'], PASSWORD_BCRYPT);
    $user['password_re_enter'] = password_hash($user['password_re_enter'], PASSWORD_BCRYPT);

    $image = date('YmdHis') . $user['image'];
    move_uploaded_file($_FILES['image']['tmp_name'], '/Applications/XAMPP/xamppfiles/htdocs/pbook/files/'.$image);
    logD($user, 'signup new user');
    logD($image, 'user image');

    $message = '以下の内容で登録しますか？';
    require_once('signup_check.tpl.php');
}  
