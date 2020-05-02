<?php
session_start();
require_once __DIR__ . './../vendor/autoload.php';

$login = checkLoginStatus();
if(!$login){
    header('Location:./../login/login.php');
}

$pdo = connectDB();
$user = findUserInfo($pdo, $_SESSION['id']);
require_once 'myimg_edit.tpl.php';
