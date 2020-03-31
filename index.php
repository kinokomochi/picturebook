<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

require_once('init.php');
$login = checkLoginStatus();
displayLink($login);
$pdo = connectDB();
list($pbooks, $pages) = findAllPbook($pdo, $_GET['team'], $_GET['page']);
//var_dump($pbooks);
var_dump($pages);
//var_dump($_GET);

logD(count($pbooks), 'index');
if($_GET['team'] == "kinoko"){
    $message = "きのこの部屋";
}elseif($_GET['team'] == "sea"){
    $message = "海の部屋";
}elseif($_GET['team'] == "plant"){
    $message = "植物の部屋";
}
require_once('index.tpl.php');