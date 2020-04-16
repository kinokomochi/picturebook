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
$user = makeUserImageFromPost();
var_dump($user['newImage']);
//エラーチェック
$error = validateMyImage($user);
logD($error, '$myimgerror');
var_dump($error);
//エラーがあればmyimg_edit.tplを呼び出す
if($error['newImage']){
    require_once 'myimg_edit.tpl.php';
    exit;
}
//エラーがなければ「この画像に更新してよろしいですか？」と表示
if(!$error['newImage']){
    $message = 'この画像に更新してよろしいですか？';
    $user['newImage'] = date('YmdHis') . $user['newImage'];
    move_uploaded_file($_FILES['newImage']['tmp_name'], '/Applications/XAMPP/xamppfiles/htdocs/pbook/files/'.$user['newImage']);
    $_SESSION['newImage'] = $user['newImage'];
    logD($_FILES['newImage']['name'], 'make a myimg');
    require_once 'myimg_check.tpl.php';
}
