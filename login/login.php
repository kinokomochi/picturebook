<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';
require_once('../init.php');

$user = ['email'=>'', 'password'=>''];
$message = "ログインフォーム";
require_once('login.tpl.php');