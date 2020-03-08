<?php 
session_start();
    require_once ('../db_connect.php');
    require_once '../function.php';

    $sql = 'SELECT * FROM picture INNER JOIN user 
            ON picture.user_id = user.id WHERE picture.team = "sea"';
    $stmt = $pdo->prepare($sql);
    // $stmt->bindValue(':sp_name', $sp_name, PDO::PARAM_STR);
    // $stmt->bindValue(':description', $description, PDO::PARAM_STR);
    $stmt->execute();
    $pbooks = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $pbooks[] = $row;
        $id = $row['user_id'];
    }
    $pdo = null;
    $stmt = null;

    $message = "海の部屋";



    require_once ('../index.tpl.php');
