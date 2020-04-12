<?php
class Mypage {

    public function checkLoginStatus(){
        if(isset($_SESSION['id']) && ($_SESSION['time'] + 3600)  > time()){
            echo  "ようこそ！" . $_SESSION['name'] . "さん！\n<br>";
            return true;
        }else{
            $_SESSION = array();
            if(ini_get("session.use_cookies")){
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000, 
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']
            );
            }
            session_destroy();
            setcookie('password', '', time()-3600);
            setcookie('id', '', time()-3600);
            header('Location:./../login/login.php');
        }
    }

    public function connectDB() {
        return new PDO(DSN, DBUSER, DBPASS, [
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES=>false,
            PDO::MYSQL_ATTR_INIT_COMMAND=>"SET time_zone='Asia/ToKyo'",
        ]);
    }

    public function findUser($pdo, $id){
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

    public function findPbooks($pdo, $id){
        $sql = 'SELECT picture.id, sp_name, picture, 
        description, picture.team, user_id
        FROM user LEFT JOIN picture 
        ON user.id = picture.user_id WHERE user.id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}