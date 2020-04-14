<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';

$user = ['email'=>'', 'password'=>''];
$message = "ログインフォーム";
require_once('login.tpl.php');