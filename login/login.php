<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

$user = ['email'=>'', 'password'=>''];
// var_dump($_SERVER['HTTP_REFERER']);
// var_dump($_SESSION['return_uri']);
$message = "ログインフォーム";
require_once('../init.php');
require_once('login.tpl.php');