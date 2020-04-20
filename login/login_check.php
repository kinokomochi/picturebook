<?php
require_once __DIR__ . '/../vendor/autoload.php';
session_start();
var_dump($_COOKIE);
$message = "ログインフォーム";
$uri = null;
$member = ['id'=>'','nickname'=>'', 'email'=>'', 'password'=>''];
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location:room.php');
    exit;
}
$user = makeLoginUserFromPost();
$error = validateLoginUser($user);
if(loginHasError($error)){
    logD($user, 'user');
    logD($error, 'error');
    require('login.tpl.php');
    exit;
}
//$errorが空であれば、IDがDBに登録された情報と一致するか認証する
//つまり、DBから入力されたデータが存在するか検索する
if(!loginHasError($error)){
    $pdo = connectDB();
    $member = lookUpUser($pdo, $user['email']);
    logD($user, 'login user');
}
//レコードが存在しない場合
    if(!$member){
        $error['login'] = 'failed';
        require('login.tpl.php');
        exit;
    }
    if($member){
        //レコードが存在して、パスワードが一致しない場合
        if(password_verify($user['password'], $member['password']) == false){
            $error['login'] = 'failed';
            require('login.tpl.php'); 
            exit;
        }
    //レコードが存在して、パスワードが一致する場合
        elseif(password_verify($user['password'], $member['password']) == true){
        $uri = 'login_check.tpl.php';
        returnOrMovePage($member['id'], $member['nickname'],  $uri);
       }
    }