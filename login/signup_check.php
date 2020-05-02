<?php 
session_start();
require_once __DIR__ . '/../vendor/autoload.php';
var_dump($_SESSION);
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location:../room.php');
    exit;
}

if(!CsrfValidator::validate(filter_input(INPUT_POST, 'token'))){
    header('Content-type: text/plain; charset=UTF-8', true, 400);
    die('CSRF validation failed.');
}

$user = makeSignupUserFromPost();
$pdo = connectDB();
$error = validateSignupUser($user);
logD($user, '$user');

$emailError = validateEmail($pdo, $user);
$passwordError = validatePW($user);
logD($_POST, '$post');
$_SESSION['rewrite'] = $user;


if((signupHasError($error)) || (signupHasEmailError($emailError)) || (signupHasPasswordError($passwordError))){
    logD($user, 'user');
    logD($error, 'error');
    $message = '入力内容に不備があります';
    require('signup.tpl.php');
    exit;
}
if((!signupHasError($error)) && (!signupHasPasswordError($passwordError))){
    $user['password'] = password_hash($user['password'], PASSWORD_BCRYPT);
    $user['password_re_enter'] = password_hash($user['password_re_enter'], PASSWORD_BCRYPT);
    $user['image'] = date('YmdHis') . $user['image'];
    move_uploaded_file($_FILES['image']['tmp_name'], '/Applications/XAMPP/xamppfiles/htdocs/pbook/files/'.$user['image']);
    $_SESSION['image'] = $user['image'];

    $message = '以下の内容で登録しますか？';
    require_once('signup_check.tpl.php');
}  
