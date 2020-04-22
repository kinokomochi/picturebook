<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';
$login = checkLoginStatus();

//index.phpからpostされてきた値を受け取る
//$keyword = assignmentKeyword();

//検索ワードを含む種名の投稿をDBから探し出す
$pdo = connectDB();
if($_GET['keyword'] != ''){
list($pbooks, $pages, $total) = searchPbook($pdo, $_GET['keyword'], $_GET['page']);
require_once('search.tpl.php');
}elseif($_GET['keyword'] == ''){
    header('Location:'.$_SERVER['HTTP_REFERER']);
}
