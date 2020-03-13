<?php
session_start();
require_once('../function.php');

if(isset($_SESSION['id']) && ($_SESSION['time']+3600)>time()){
    //DB接続
    require_once('../db_connect.php');
    //ログインしているメンバーのidに一致するレコードをDBからとってくる
    $sql = 'SELECT user.id, nickname, image, introduction, birthday, 
            gender, user.team, email, picture.id, sp_name, picture, 
            description, picture.team, user_id
            FROM user LEFT JOIN picture 
            ON user.id = picture.user_id WHERE user.id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $_SESSION['id'], PDO::PARAM_STR);
    $stmt->execute();
    $member = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql = 'SELECT user.id, nickname, image, introduction, birthday, 
    gender, user.team, email, picture.id, sp_name, picture, 
    description, picture.team, user_id
    FROM user LEFT JOIN picture 
    ON user.id = picture.user_id WHERE user.id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $_SESSION['id'], PDO::PARAM_STR);
    $stmt->execute();
    $pbooks = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $pbooks[] = $row;
    }


    $message = $member['nickname'].'さんのマイページ';
    require_once('mypage.tpl.php');
}else{
    header('Location:../room.php');
}

// var_dump($pbooks);
// var_dump($member);
// var_dump($_SESSION);