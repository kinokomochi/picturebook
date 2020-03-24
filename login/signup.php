<?php
require_once __DIR__ . '/../vendor/autoload.php';

$message = "メンバー登録画面";
$user = ['name'=>'', 'image'=>'', 'introduction'=>'', 'year'=>'',
         'month'=>'', 'day'=>'', 'gender'=>'', 'team'=>'', 'email'=>'',
         'password'=>'', 'password_re_enter'=>''];
require_once('../init.php');
require_once('signup.tpl.php');


