<?php 
session_start();
require_once('function.php');
$pbook = ['id'=>'', 'sp_name'=>'', 'picture'=>'', 'description'=>'',
          'team'=>'', 'user_id'=>''];
var_dump($_SESSION);
if(!isset($_SESSION['id'])){
    $_SESSION['return_uri'] =  "http://localhost/pbook/new.php";
    header('Location:login/login.php');
    exit;
}

if(isset($_SESSION['id']) && ($_SESSION['time']) + 3600 > time()){

$message = "図鑑登録";
require_once ('new.tpl.php');
// var_dump($member);
}
