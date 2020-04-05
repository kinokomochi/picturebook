<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';
require_once('init.php');
$login = checkLoginStatus();
displayLink($login);

//index.phpからpostされてきた値を受け取る
//$keyword = assignmentKeyword();

//検索ワードを含む種名の投稿をDBから探し出す
$pdo = connectDB();
list($pbooks, $pages, $total) = searchPbook($pdo, $_GET['keyword'], $_GET['page']);
require_once('search.tpl.php');
