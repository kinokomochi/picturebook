<?php
session_start();
//セッションを破棄する
//セッション変数を全て解除する
$_SESSION = array();
//ログイン情報を記憶しているCookieを削除する
//Note: セッション情報だけでなくセッションを破壊する
if(ini_get("session.use_cookies")){
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, 
    $params['path'], $params['domain'],
    $params['secure'], $params['httponly']
);
}

//最終的にセッションを破壊する
session_destroy();

//Cookie情報も削除
setcookie('password', '', time()-3600);
setcookie('id', '', time()-3600);
session_start();
header('Location:../room.php');
exit();

