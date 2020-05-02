<?php
function checkLoginStatus(){
    if(isset($_SESSION['id']) && ($_SESSION['time'] + 3600)  > time()){
        return true;
    }else{
        $_SESSION = array();
        if(ini_get("session.use_cookies")){
            $params = session_get_cookie_params();
            setcookie('email', '', time() - 6050000, 
            $params['path'], $params['domain'],
            $params['secure'], $params['httponly']
        );
        }
        session_destroy();
        session_start();

        return false;
    }
}
function displayLink($login){
    if($login){
        echo "<p><a href=\"".URL_ROOT."new.php\">写真投稿</a></p>";
        echo "<p><a href=\"".URL_ROOT."login/logout.php\">ログアウト</a></p>";
    }elseif(!$login){
        echo "<p><a href=\"".URL_ROOT."login/login.php\">ログイン</a></p>";
        echo "<p><a href=\"".URL_ROOT."login/signup.php\">メンバー登録</a></p>";
    }
}
function loginEmptyError(){
    $error = ['email'=>'', 'password'=>''];
    return $error;
}

function loginHasError($error){
    return $error['email'] != ''
        || $error['password'] != '';
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
    $sql = 'SELECT id, nickname, email, password FROM user  
            WHERE email = :email';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function signupEmptyError(){
    $error = ['nickname'=>'', 'image'=>'', 'introduction'=>'', 'birthday'=>'',
             'gender'=>'', 'team'=>''];
             return $error;
}
function signupEmptyPasswordError(){
    $passwordError = ['password'=>'', 'password_re_enter'=>''];
    return $passwordError;
}
function signupHasError($error){
    return $error['nickname'] != ''
        || $error['image'] != ''
        || $error['introduction'] != ''
        || $error['birthday'] != ''
        || $error['gender'] != ''
        || $error['team'] != '';
}

function signupHasEmailError($emailError){
    return $emailError['email'] != '';
}
function signupHasPasswordError($passwordError){
    return $passwordError['password'] != ''
    || $passwordError['password_re_enter'] != '';
}
function makeSignupUserFromPost(){
    if(isset($_POST['image'])){
        $user['image'] = $_POST['image'] ?? '';
    }else{
        $user['image'] = $_FILES['image']['name'] ?? '';
    }
    $user['nickname'] = $_POST['nickname'] ?? '';
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

function validateSignupUser($user){
    $error = signupEmptyError();
    if($user['nickname'] == ''){
        $error['nickname'] = 'blank';
    }elseif(mb_strlen($user['nickname']) > 20){
        $error['nickname'] = 'length';
    }
    if($user['image'] == ''){
        $error['image'] = 'blank';
    }elseif($user['image']){
        $ext = pathinfo($user['image'], PATHINFO_EXTENSION);
        if($ext != 'jpg' && $ext != 'JPG' && $ext != 'jpeg' && $ext != 'JPEG' && $ext != 'png' && $ext != 'PNG'){
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
    return $error;
}

function validateEmail($pdo, $user){
    $emailError = ['email'=>''];

    if($user['email'] == ''){
        $emailError['email'] = 'blank';
    }
    if($user['email'] != '' && filter_var($user['email'], FILTER_VALIDATE_EMAIL) === false){
        $emailError['email'] = 'failed';
    }
    
    //IDの重複チェック
    if($emailError['email'] == ''){
        $sql = 'SELECT email FROM user WHERE email = :email';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $user['email'], PDO::PARAM_STR);
        $stmt->execute();
        $e = $stmt->fetch();
        if(!empty($e)){
            $emailError['email'] = 'duplicate';
        }
        
    }
    return $emailError;
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
        || mb_strlen($user['password']) < 8 //8文字未満ならエラー
        || mb_strlen($user['password']) > 20 //20文字より大きいならエラー
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
    $stmt->bindValue(':nickname', $user['nickname'], PDO::PARAM_STR);
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

function setCookieAndSession($id, $name){
    if(!isset($_POST['save'])){
        $_SESSION['save'] = 'off';
    }
    elseif(isset($_POST['save']) && $_POST['save'] == 'on'){
        $str = $_POST['email'] . '<<>>' . $_POST['password'];
        $str = openssl_encrypt($str, 'aes-256-ecb', 'engWe99r41');
        $str = base64_encode($str);
        setcookie('str', $str, time()+60*60*24*7, COOKIE_PATH, COOKIE_DOMAIN, false, true);
        $_SESSION['save'] = 'on';
    }
    $_SESSION['id'] = $id;
    $_SESSION['nickname'] = $name;
    $_SESSION['time'] = time();
    $_SESSION['token'] = null;
}
function returnOrMovePage($moveUri){
    if(isset($_SESSION['return_uri'])){
        $returnUri = $_SESSION['return_uri'];
        unset($_SESSION['return_uri']);
        return header('Location:'.$returnUri);
    }else{
        return require_once($moveUri);
    }
}

class CsrfValidator {

    const HASH_ALGO = 'sha256';

    public static function generate()
    {
        if(session_status() === PHP_SESSION_NONE && session_start() === PHP_SESSION_DISABLED) {
            throw new \BadMethodCallException('Session id not active.');
        }

        return hash(self::HASH_ALGO, session_id());
    }

    public static function validate($token, $throw = false)
    {
        $success = self::generate() === $token;
        if(!$success && $throw) {
            throw new \RuntimeException('CSRF validation failed.', 400);
        }

        return $success;
        
        }

}