<?php
session_start();
require_once __DIR__ . './../vendor/autoload.php';

//ログイン認証
$login = checkLoginStatus();
if(!$login){
    header('Location:./../login/login.php');
}
//現在の画像取得
$pdo = connectDB();
$user = findUserInfo($pdo, $_SESSION['id']);
//画像登録
require_once 'myimg_edit.tpl.php';
//この画像を登録しますか？一時ファイルを表示→確認myimg_check.phpここでDBにupdate
