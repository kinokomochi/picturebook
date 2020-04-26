<?php
require_once __DIR__ . '/../vendor/autoload.php';

session_start();
$save = $_SESSION['save'];

$_SESSION = array();
if(ini_get("session.use_cookies") && $save == 'off'){
    $params = session_get_cookie_params();
    setcookie('str', '', time() - 6050000, COOKIE_PATH, $params['domain'], $params['secure'], $params['httponly']);
    logD($_COOKIE['str'], 'logout cookie');
}

session_destroy();
session_start();
header('Location:../room.php');
exit;


