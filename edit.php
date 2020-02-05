<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        // $sp_name = $_GET['sp_name'];
        // $team = $_GET['team'];
        // $picture = $_GET['picture'];
        // $description = $_GET['description'];
    }

    require_once ('.gitignore/db_connect.php');
    $sql = 'SELECT sp_name, team, picture, description FROM picture WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);    
    $stmt->execute();
    $pbook = $stmt->fetch(PDO::FETCH_ASSOC);

    $pdo = null;
    $stmt = null;

    $message = "図鑑編集";



    require_once ('edit.tpl.php');
