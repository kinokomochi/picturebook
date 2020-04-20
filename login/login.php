<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';
var_dump($_COOKIE);
if(isset($_COOKIE['email']) && isset($_COOKIE['password'])){
    $user['email'] = $_COOKIE['email'];
    $user['password'] = $_COOKIE['password'];
}
//var_dump($user);

$message = "ログインフォーム";
require_once('login.tpl.php');