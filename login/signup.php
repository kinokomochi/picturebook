<?php
session_start();
error_reporting(E_ALL);
// var_dump($_SERVER['HTTP_REFERER']);
// var_dump($_SESSION['return_uri']);

$message = "メンバー登録画面";
require_once('../db_connect.php');
require_once('../function.php');
require_once('signup.tpl.php');


