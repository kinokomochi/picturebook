<?php
session_start();
require_once __DIR__ . './../vendor/autoload.php';
require_once './../init.php';

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
$user = makeUserImageFromPost();
//エラーチェック
$error = validateMyImage($user);
logD($error, '$myimgerror');
//エラーがあればmyimg_edit.tplを呼び出す
if($error){
    require_once 'myimg_edit.tpl.php';
    exit;
}
//エラーがなければ「この画像に更新してよろしいですか？」と表示
elseif(!$error){
    $message = 'この画像に更新してよろしいですか？';
    require_once 'myimg_check.tpl.php';
}
//よろしければDBにupdate
//よろしくなければmyimg_edit.tplを呼び出す