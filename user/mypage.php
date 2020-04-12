<?php
session_start();
require_once __DIR__ . './../vendor/autoload.php';
require_once './../init.php';
require_once('mypage_class.php');

$login = new Mypage;
$login->checkLoginStatus();
if($login){
    //DB接続
    require_once('./../init.php');

    $pdo = new Mypage;
    $pdo = $pdo->connectDB();
    //ログインしているメンバーのidに一致するレコードをDBからとってくる
    $user = new Mypage;
    $user = $user->findUser($pdo, $_SESSION['id']);

    $post = new Mypage;
    $pbooks = ['picture.id'=>'', 'sp_name'=>'', 'picture'=>'', 
              'description'=>'', 'picture.team'=>'', 'user_id'=>''];
    $pbooks = $post->findPbooks($pdo, $_SESSION['id']);
    logD($pbooks, 'mypage:$pbooks');
    logD($_SESSION, 'mypage:$_session');

    $message = $user['nickname'].'さんのマイページ';
    require_once('mypage.tpl.php');

}