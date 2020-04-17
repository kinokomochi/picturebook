<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

$message = "メンバー登録画面";
$user = ['name'=>'', 'image'=>'', 'introduction'=>'', 'year'=>'',
         'month'=>'', 'day'=>'', 'gender'=>'', 'team'=>'', 'email'=>'',
         'password'=>'', 'password_re_enter'=>''];

if(isset($_GET['action'])){
    $user = $_SESSION['rewrite'];
    $message = 'メンバー登録画面';
    logD($user, 'rewrite signup user');
    require_once 'signup.tpl.php';
    exit;
}
        
require_once 'signup.tpl.php';


