<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';
require_once('../init.php');

var_dump($_SESSION);
$user = ['email'=>'', 'password'=>''];
// var_dump($_SERVER['HTTP_REFERER']);
var_dump($_SESSION['return_uri']);
$message = "ログインフォーム";
require_once('login.tpl.php');