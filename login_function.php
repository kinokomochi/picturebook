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

function makeUserFromPost(){
    $user['email'] = $_POST['email'] ?? '';
    $user['password'] = $_POST['password'] ?? '';
    return $user;
}

function validateUser($user){
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
