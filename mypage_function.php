<?php
    
    function findUserInfo($pdo, $id){
        $sql = 'SELECT user.id, nickname, image, introduction, birthday, 
        gender, user.team, email, picture.id, sp_name, picture, 
        description, picture.team, user_id
        FROM user LEFT JOIN picture 
        ON user.id = picture.user_id WHERE user.id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function findUserPost($pdo, $id){
        $sql = 'SELECT picture.id, sp_name, picture, 
        description, picture.team, user_id
        FROM user LEFT JOIN picture 
        ON user.id = picture.user_id WHERE user.id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function makeUserImageFromPost(){
        $user['image'] = $_FILES['image']['name'] ?? '';
        return $user;
    }

    function emptyImgError(){
        $error = ['image'=>''];
        return $error;
    }
    function validateMyImage($user){
        $error = emptyImgError();
        if($user['image'] == ''){
            $error['image'] = 'blank';
        }elseif($user['image']){
            $ext = pathinfo($user['image'], PATHINFO_EXTENSION);
            if($ext != 'jpg' && $ext != 'JPG' && $ext != 'jpeg' && $ext != 'JPEG' && $ext != 'png' && $ext != 'PNG'){
                $error['image'] = 'type';
            }
        }
        return $error;
    }
