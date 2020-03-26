<?php
function loginEmptyError(){
    $error = ['email'=>'', 'password'=>'', 'login'=>''];
    return $error;
}

function loginHasError($error){
    return $error['email'] != ''
        || $error['password'] != ''
        || $error['login'] != '';
}

function makeLoginUserFromPost(){
    $user['email'] = $_POST['email'] ?? '';
    $user['password'] = $_POST['password'] ?? '';
    return $user;
}

function validateLoginUser($user){
    $error = loginEmptyError();
    if($user['email'] == ''){
        $error['email'] = 'blank';
    }
    if($user['password'] == ''){
        $error['password'] = 'blank';
    }
    return $error;
}
function lookUpUser($pdo, $email){
    $sql = 'SELECT id, email, password FROM user  
            WHERE email = :email';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function signupEmptyError(){
    $error = ['name'=>'', 'image'=>'', 'introduction'=>'', 'birthday'=>'',
             'gender'=>'', 'team'=>'', 'email'=>''];
             return $error;
}
function signupEmptyPasswordError(){
    $passwordError = ['password'=>'', 'password_re_enter'=>''];
}
function signupHasError($error){
    return $error['name'] != ''
        || $error['image'] != ''
        || $error['introduction'] != ''
        || $error['birthday'] != ''
        || $error['gender'] != ''
        || $error['team'] != ''
        || $error['email'] != '';
}
function signupHasPasswordError($passwordError){
    return $passwordError['password'] != ''
    || $passwordError['password_re_enter'] != '';
}
function makeSignupUserFromPost(){
    $user['name'] = $_POST['name'] ?? '';
    $user['image'] = $_FILES['image']['name'] ?? '';
    $user['introduction'] = $_POST['introduction'] ?? '';
    $user['year'] = $_POST['year'] ?? '';
    $user['month'] = $_POST['month'] ?? '';
    $user['day'] = $_POST['day'] ?? '';
    $user['birthday'] = $_POST['birthday'] ?? '';
    $user['gender'] = $_POST['gender'] ?? '';    
    $user['team'] = $_POST['team'] ?? '';
    $user['email'] = $_POST['email'] ?? '';
    $user['password'] = $_POST['password'] ?? '';
    $user['password_re_enter'] = $_POST['password_re_enter'] ?? '';
    return $user;
}

function validateSignupUser($pdo, $user){
    $error = signupEmptyError();
    if($user['name'] == ''){
        $error['name'] = 'blank';
    }
    if(mb_strlen($user['name']) > 20){
        $error['name'] = 'length';
    }
    if($user['image'] = ''){
        $error['image'] = 'blank';
    }
    if($user['image']){
        $ext = substr($user['image'], -3);
        if($ext != 'jpg' && $ext != 'JPG' && $ext != 'png' && $ext != 'PNG'){
            $error['image'] = 'type';
        }
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
    if($user['email'] == ''){
        $error['email'] = 'blank';
    }
    if($user['email'] != '' && filter_var($user['email'], FILTER_VALIDATE_EMAIL) === false){
        $error['email'] = 'failed';
    }
    
    //IDの重複チェック
    $sql = 'SELECT email FROM user WHERE email = :email';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $user['email'], PDO::PARAM_STR);
    $stmt->execute();
    $e = $stmt->fetch();
    if(!empty($e)){
         $error['email'] = 'duplicate';
    }
    return $error;
}

function validatePW($user){
    $passwordError = signupEmptyPasswordError();
    if($user['password'] == ''){
        $passwordError['password'] = 'blank';
    //半角英小文字大文字数字をそれぞれ１種類以上含む８文字以上20文字以下
    //全角、記号、半角カナが含まれていればエラー
    }elseif
        ( 
        !ctype_alnum($user['password'])
        || !preg_match('/[a-z]/', $user['password']) //小文字が1文字以上含まれているか
        || !preg_match('/[A-Z]/', $user['password']) //大文字が1文字以上含まれているか
        || !preg_match('/[0-9]/', $user['password']) //半角数字が1文字以上含まれているか
        || mb_strlen($user['password']) < 8 //8文字以下ならエラー
        || mb_strlen($user['password']) > 20 //20文字以上ならエラー
        )
    {
        $passwordError['password'] = 'illegal';
    }
    if($user['password_re_enter'] == ''){
        $passwordError['password_re_enter'] = 'blank';
    } 
    if($user['password'] != $user['password_re_enter']){
        $passwordError['password'] = 'failed';
    }
    return $passwordError;
}

function saveUser($pdo, $user){
    $sql = 'INSERT INTO user (nickname, image, introduction, team, email, birthday, gender,  password) 
    VALUES (:nickname, :image, :introduction, :team, :email, :birthday, :gender, :password)';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nickname', $user['name'], PDO::PARAM_STR);
    $stmt->bindValue(':image', $user['image'], PDO::PARAM_STR);
    $stmt->bindValue(':introduction', $user['introduction'], PDO::PARAM_STR);
    $stmt->bindValue(':team', $user['team'], PDO::PARAM_STR);
    $stmt->bindValue(':email', $user['email'], PDO::PARAM_STR);
    $stmt->bindValue(':birthday', $user['birthday'], PDO::PARAM_STR);
    $stmt->bindValue(':gender', $user['gender'], PDO::PARAM_STR);
    $stmt->bindValue(':password', $user['password'], PDO::PARAM_STR);
    $stmt->execute();
    return $user;
}

function returnOrMovePage($id, $moveUri){
    $_SESSION['id'] = $id;
    $_SESSION['time'] = time();
    $_SESSION['token'] = null;
    if(isset($_SESSION['return_uri'])){
        $returnUri = $_SESSION['return_uri'];
        unset($_SESSION['return_uri']);
        return header('Location:'.$returnUri);
    }else{
        return require_once($moveUri);
    }

}