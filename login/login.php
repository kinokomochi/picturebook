<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';
header('WWW-Authenticate: Negotiate');
header('WWW-Authenticate: NTLM', false);
if(isset($_COOKIE['str'])){
    $str = base64_decode($_COOKIE['str']);
    $str = openssl_decrypt($str, 'aes-256-ecb', 'engWe99r41');
    list($user['email'], $user['password']) = explode("<<>>", $str);
    logD($user, 'decode cookie');
}

$message = "ログインフォーム";
require_once('login.tpl.php');