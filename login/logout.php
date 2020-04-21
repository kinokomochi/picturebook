<?php
require_once __DIR__ . '/../vendor/autoload.php';

session_start();
$save = $_SESSION['save'];

var_dump($_SESSION);
$_SESSION = array();
if(ini_get("session.use_cookies") && $save == 'off'){
    $params = session_get_cookie_params();
    setcookie('str', '', time() - 6050000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    unset($_COOKIE['str']);
    unset($_COOKIE);
    logD($_COOKIE['str'], 'logout cookie');
}
var_dump($_COOKIE);
exit;

session_destroy();
session_start();
header('Location:../room.php');
exit;


