<?php
session_start();
var_dump($_COOKIE);

require_once __DIR__ . '/../vendor/autoload.php';
if(isset($_COOKIE['str'])){
    $str = base64_decode($_COOKIE['str']);
    list($user['email'], $user['password']) = explode("<<>>", $str);
    logD($user, 'decode cookie');
}
var_dump($user);

$message = "ログインフォーム";
require_once('login.tpl.php');