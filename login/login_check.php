<?php
require_once __DIR__ . '/../vendor/autoload.php';

require_once('../init.php');
$message = "ログインフォーム";
$uri = null;
$member = ['id'=>'', 'email'=>'', 'password'=>''];
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location:room.php');
    exit;
}
$user = makeUserFromPost();
$error = validateUser($user);
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
    if($member == false){
        $error['login'] = 'failed';
        require('login.tpl.php');
        exit;
    }
    if($member == true){
        //レコードが存在して、パスワードが一致しない場合
        if(password_verify($user['password'], $member['password']) == false){
            $error['login'] = 'failed';
            require('login.tpl.php'); 
            exit;
        }
    //レコードが存在して、パスワードが一致する場合
        elseif(password_verify($user['password'], $member['password']) == true){
        session_start();
        $_SESSION['id'] = $member['id'];
        $_SESSION['time'] = time();
        logD($_SESSION, '$_SESSION');
        //元いたページにリダイレクトするか確認ページにリダイレクトする
            if(isset($_SESSION['return_uri'])){
                $uri = $_SESSION['return_uri'];
                unset($_SESSION['return_url']);
                header('Location:'.$uri);
            }else{
                require('login_check.tpl.php');
            }
       }
    }