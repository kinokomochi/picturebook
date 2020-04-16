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
        $user['newImage'] = $_FILES['newImage']['name'] ?? '';
        return $user;
    }

    function emptyImgError(){
        $error = ['newImage'=>''];
        return $error;
    }

    function profileEmptyError(){
        $error = ['nickname'=>'', 'image'=>'', 'introduction'=>'', 'birthday'=>'',
                 'gender'=>'', 'team'=>''];
                 return $error;
    }

    function profileHasError($error){
        return $error['nickname'] != ''
            || $error['image'] != ''
            || $error['introduction'] != ''
            || $error['birthday'] != ''
            || $error['gender'] != ''
            || $error['team'] != '';
    }

    function emailHasError($error){
        return $error['email'] != '';
    }
    
    function validateMyImage($user){
        $error = emptyImgError();
        if($user['newImage'] == ''){
            $error['newImage'] = 'blank';
        }elseif($user['newImage']){
            $ext = pathinfo($user['newImage'], PATHINFO_EXTENSION);
            if($ext != 'jpg' && $ext != 'JPG' && $ext != 'jpeg' && $ext != 'JPEG' && $ext != 'png' && $ext != 'PNG'){
                $error['newImage'] = 'type';
            }
        }
        return $error;
    }

    function updateNewImage($pdo, $id, $newImage){
        $sql = 'UPDATE user SET image = :image WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':image', $newImage, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
    }

    function makeNewProfileFromPost(){
        $user['nickname'] = $_POST['nickname'] ?? '';
        $user['introduction'] = $_POST['introduction'] ?? '';
        $user['year'] = $_POST['year'] ?? '';
        $user['month'] = $_POST['month'] ?? '';
        $user['day'] = $_POST['day'] ?? '';
        $user['birthday'] = $_POST['birthday'] ?? '';
        $user['gender'] = $_POST['gender'] ?? '';    
        $user['team'] = $_POST['team'] ?? '';
        return $user;
    }

    function validateNewProfile($user){
        $error = profileEmptyError();
        if($user['nickname'] == ''){
            $error['nickname'] = 'blank';
        }elseif(mb_strlen($user['nickname']) > 20){
            $error['nickname'] = 'length';
        }
        if($user['introduction'] == ''){
            $error['introduction'] = 'blank';
        }
        if(checkdate(intval($user['month']), intval($user['day']), intval($user['year'])) == false){
            $error['birthday'] = 'failed';
        }
        if($user['gender'] == ''){
            $error['gender'] = 'blank';
        }
        if($user['team'] == ''){
            $error['team'] = 'blank';
        }
        return $error;
    }
    
    function updateProfile($pdo, $id, $user){
        $sql = 'UPDATE user SET nickname = :nickname, introduction = :introduction, 
        team = :team, birthday = :birthday, gender = :gender WHERE id = :id ';
    
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->bindValue(':nickname', $user['nickname'], PDO::PARAM_STR);
        $stmt->bindValue(':introduction', $user['introduction'], PDO::PARAM_STR);
        $stmt->bindValue(':team', $user['team'], PDO::PARAM_STR);
        $stmt->bindValue(':birthday', $user['birthday'], PDO::PARAM_STR);
        $stmt->bindValue(':gender', $user['gender'], PDO::PARAM_STR);
        $stmt->execute();
        return $user;
    }

    function findUserEmail($pdo, $id){
        $sql = 'SELECT email
        FROM user WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
        
    function makeNewEmailFromPost(){
        $user['email'] = $_POST['email'] ?? '';
        return $user;
    }

    function validateNewEmail($pdo, $user){
        $error = ['email'=>''];

        if($user['email'] == ''){
            $error['email'] = 'blank';
        }
        if($user['email'] != '' && filter_var($user['email'], FILTER_VALIDATE_EMAIL) === false){
            $error['email'] = 'failed';
        }
        
        //IDの重複チェック
        if($error['email'] == ''){
            $sql = 'SELECT email FROM user WHERE email = :email';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':email', $user['email'], PDO::PARAM_STR);
            $stmt->execute();
            $e = $stmt->fetch();
            if(!empty($e)){
                $error['email'] = 'duplicate';
            }
            
        }
        return $error;
    }

    function updateEmail($pdo, $id, $email){
        $sql = 'UPDATE user SET email = :email WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
    }

    function makeNewPassFromPost(){
        $user['currentPass'] = $_POST['currentPass'] ?? '';
        $user['newPass'] = $_POST['newPass'] ?? '';
        $user['password_re_enter'] = $_POST['password_re_enter'] ?? '';
        return $user;
    }

    function validateCurrentPass($pdo, $id, $user){
        $error ['currentPass'] ='';

        if($user['currentPass'] == ''){
            $error['currentPass'] = 'blank';
        }else{
            $sql = 'SELECT password FROM user WHERE id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $pw = $stmt->fetch(PDO::FETCH_COLUMN);
            //$pw = strval($pw['password']);
            logD($pw, '$pw:');
            $currentPass = strval($user['currentPass']);
            logD($currentPass, '$currentPass');
            if(!password_verify($currentPass, $pw)){
                $error['currentPass'] = 'notpass';
            }
        }
        return $error;
    }

    function validateNewPass($pdo, $user){
        $error = ['newPass'=>'', 'password_re_enter'=>'', 'password'=>''];

        if($user['newPass'] == ''){
            $error['newPass'] = 'blank';
        }elseif
        ( 
        !ctype_alnum($user['newPass'])
        || !preg_match('/[a-z]/', $user['newPass']) //小文字が1文字以上含まれているか
        || !preg_match('/[A-Z]/', $user['newPass']) //大文字が1文字以上含まれているか
        || !preg_match('/[0-9]/', $user['newPass']) //半角数字が1文字以上含まれているか
        || mb_strlen($user['newPass']) < 8 //8文字未満ならエラー
        || mb_strlen($user['newPass']) > 20 //20文字より大きいならエラー
        )
    {
        $error['newPass'] = 'illegal';
    }
    if($user['password_re_enter'] == ''){
        $error['password_re_enter'] = 'blank';
    } 
    if($user['newPass'] != $user['password_re_enter']){
        $error['password'] = 'failed';
    }
    return $error;
}
    function HasPasswordError($cerror, $nerror){
        return $cerror['currentPass'] != ''
            || $nerror['newPass'] != ''
            || $nerror['password_re_enter'] != '';
    }

    function updatePW($pdo, $id, $newPass){
        $sql = 'UPDATE user SET password = :password WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':password', $newPass, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        logD($newPass, 'updatePW, $newPass');
    }

    function deleteUserPost($pdo, $id){
        $sql = 'DELETE  FROM picture  WHERE user_id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    function deleteUser($pdo, $id){
        $sql = 'DELETE  FROM user  WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
