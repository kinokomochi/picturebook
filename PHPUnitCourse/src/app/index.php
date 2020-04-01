<?php
namespace index;
require_once('login_function.php');
class LoginBool{

    public function login() {
        $login = checkLoginStatus();
        return $login;
    }

}