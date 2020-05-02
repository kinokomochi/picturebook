<?php
require_once __DIR__ . '/../vendor/autoload.php';
session_start();
$message = "ログインフォーム";
$uri = null;
$member = ['id'=>'','nickname'=>'', 'email'=>'', 'password'=>''];
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location:room.php');
    exit;
}

if(!CsrfValidator::validate(filter_input(INPUT_POST, 'token'))){
    header('Content-type: text/plain; charset=UTF-8', true, 400);
    die('CSRF validation failed.');
}

$user = makeLoginUserFromPost();
$error = validateLoginUser($user);

if(loginHasError($error)){
    logD($user, 'user');
    logD($error, 'error');
    require('login.tpl.php');
    exit;
}

if(!loginHasError($error)){
    $pdo = connectDB();
    $member = lookUpUser($pdo, $user['email']);
    logD($user, 'login user');
}

if(!$member){
        $error['login'] = 'failed';
        require('login.tpl.php');
        exit;
    }
    if($member){

        if(password_verify($user['password'], $member['password']) == false){
            $error['login'] = 'failed';
            require('login.tpl.php'); 
            exit;
        }

        elseif(password_verify($user['password'], $member['password']) == true){
        $uri = 'login_check.tpl.php';
        setCookieAndSession($member['id'], $member['nickname']);
        returnOrMovePage($uri);
       }
    }