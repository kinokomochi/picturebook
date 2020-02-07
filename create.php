<?php 
require_once ('db_connect.php');
    
    if(isset($_POST['submit'])){
        $sp_name = htmlspecialchars($_POST['sp_name'], ENT_QUOTES, 'UTF-8');
        $team = htmlspecialchars($_POST['team'], ENT_QUOTES, 'UTF-8');
        $picture = htmlspecialchars($_POST['picture'], ENT_QUOTES, 'utf-8');
        $description = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
    }

    
    $sql = 'INSERT INTO picture (sp_name, team, picture, description)
            VALUES (:sp_name, :team, :picture, :description)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':sp_name', $sp_name, PDO::PARAM_STR);
    $stmt->bindValue(':team', $team, PDO::PARAM_STR);
    $stmt->bindValue(':picture', $picture, PDO::PARAM_STR);
    $stmt->bindValue(':description', $description, PDO::PARAM_STR);
    $stmt->execute();

    
    $pdo = null;
    $stmt = null;

    
    $url = "{$team}/index.php";
    header('Location:'.$url);
    exit();


    //require_once ('new.tpl.php');
