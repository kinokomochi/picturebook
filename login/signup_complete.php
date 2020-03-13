<?php
session_start();
require_once('../db_connect.php');
// var_dump($_SESSION);

if(isset($_POST['submit'])){
    $name = $_POST['name'] ?? '';
    $image = $_FILES['name']['image'] ?? '';
    $introduction = $_POST['introduction'] ?? '';
    $birthday = $_POST['birthday'];
    $team = $_POST['team'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    //$password_re_enter = $_POST['password_re_enter'] ?? '';
    
    $sql = 'INSERT INTO user (nickname, image, introduction, team, email, birthday, gender,  password) 
            VALUES (:nickname, :image, :introduction, :team, :email, :birthday, :gender, :password)';
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nickname', $name, PDO::PARAM_STR);
    $stmt->bindValue(':image', $image, PDO::PARAM_STR);
    $stmt->bindValue(':introduction', $introduction, PDO::PARAM_STR);
    $stmt->bindValue(':team', $team, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':birthday', $birthday, PDO::PARAM_STR);
    $stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->execute();
    // $ret = $stmt->execute();
    // if ( $ret === false ) {
    //     var_export($stmt->errorInfo());
    //     exit;
    // }
    $sql = 'SELECT * FROM user  
                WHERE email = :email';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR_CHAR);
        $stmt->execute();
        $member = $stmt->fetch(PDO::FETCH_ASSOC);
        $pdo = null;
        $stmt = null;
        //DBにレコードが存在しないつまりユーザーがいない場合はエラーを吐く
        
        $_SESSION['id'] = $member['id'];
        $_SESSION['time'] = time();
    
        $pdo = null;
        $stmt = null;
        if(isset($_SESSION['return_uri'])){
            $uri = $_SESSION['return_uri'];
            unset($_SESSION['return_uri']);
            header('Location:'.$uri);
        }else{
            require_once('signup_complete.tpl.php');
        }
}else{
    header('Location:XAMPP/htdocs/pbook/room.php');
}




require_once __DIR__ . '/../vendor/autoload.php';
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

date_default_timezone_set("Asia/Tokyo");

//ログファイルのパス
$logging_path = __DIR__ . '/../log/signup_complete_log.log';
$stream = new StreamHandler($logging_path, Logger::INFO);
//出力後、改行するために下記クラスを静止し、パラメーターとしてセットする。
$formatter = new LineFormatter(null, null, true);
$stream->setFormatter($formatter);
$logger = new Logger('pbook/log/signup_complete.php');
$logger->pushHandler($stream);

//下記のようにしないと配列などの値が出力されない
$logger->pushProcessor(function($record){
    $record['extra']['dummy'] = '';
    return $record;
});

//$arrは出力したいデータ
//if(!isset($pbook) || !isset($_POST)){
@$logger->addInfo('$_POSTの中身:' . dumper($_POST));
@$logger->addDebug(var_export($password, true));
@$logger->warning('$birthdayの中身:'.dumper($stmt));
//}
//$logger->error('$_FILES:'. var_export($_FILES['file']['tmp_name'], true));

//var_dumpの結果を文字列として出力するために下記関数を追加
function dumper($obj){
    ob_start();//関数の出力のバッファリングをオンにする　？
    var_dump($obj);
    $ret = ob_get_contents();//文字列変数にバッファした内容をコピー
    ob_end_clean();//バッファの内容を消去
    return $ret;
}
