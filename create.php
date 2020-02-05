<?php 
require_once ('.gitignore/db_connect.php');
    
    if(isset($_POST['submit'])){
        $sp_name = $_POST['sp_name'];
        $team = $_POST['team'];
        $picture = $_POST['picture'];
        $description = $_POST['description'];
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
