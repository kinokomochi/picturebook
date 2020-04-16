<?php
session_start();
require_once __DIR__ . './../vendor/autoload.php';
$login = checkLoginStatus();
if(!$login){
    header('Location:./../login/login.php');
}

$message = 'パスワードを入力してください';
require_once 'myPassword_edit.tpl.php';
