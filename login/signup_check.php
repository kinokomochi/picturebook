<?php 

require_once('../db_connect.php');
require_once('../function.php');

//signup.phpから値を受とる
//「登録確認画面へ」が押されていたら、値を変数に渡す
if(isset($_POST['submit'])){
    //同時に$_POSTに値がセットされているか確かめる。
    $name = $_POST['name'] ?? '';
    $image = $_FILES['name']['image'] ?? '';
    $introduction = $_POST['introduction'] ?? '';
    $year = $_POST['year'] ?? '';
    $month = $_POST['month'] ?? '';
    $day = $_POST['day'] ?? '';
    $gender = $_POST['gender'] ?? '';    
    $team = $_POST['team'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $password_re_enter = $_POST['password_re_enter'] ?? '';
    //validationチェック $errorにそれぞれのエラー内容の値を入れる
    $error = [];
    if($name == ''){
        $error['name'] = 'blank';
    }
    if(mb_strlen($name) > 20){
        $error['name'] = 'length';
    }
    if($image = ''){
        $error['image'] = 'blank';
    }
    
    $filename = $_FILES['image']['name'];
    if(!empty($filename)){
        $ext = substr($filename, -3);
        if($ext != 'jpg' && $ext != 'JPG' && $ext != 'png' && $ext != 'PNG'){
            $error['image'] = 'type';
        }
    }
    if($introduction == ''){
        $error['introduction'] = 'blank';
    }
    if(checkdate(intval($month), intval($day), intval($year)) == false){
        $error['birthday'] = 'failed';
    }
    if($gender == ''){
        $error['gender'] = 'blank';
    }
    // if($male = '' && $female == '' && $unselected == ''){
    //     $error['gender'] = 'blank';
    // }
    if($email == ''){
        $error['email'] = 'blank';
    }
    if($email != '' && filter_var($email, FILTER_VALIDATE_EMAIL) === false){
        $error['email'] = 'failed';
    }
    //IDの重複チェック
    if($email != ''){
        $sql = 'SELECT * FROM user WHERE email = :email';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $member = $stmt->fetch();

        $pdo = null;
        $stmt = null;
    
        if(!empty($member)) {
                $error['email'] = 'duplicate';
            }
    }
    if($password == ''){
        $error['password'] = 'blank';
    }
    //半角英小文字大文字数字をそれぞれ１種類以上含む８文字以上20文字以下
    if((!preg_match("/\A(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{8,20}+\z/", $password)) && $password != ''){
        $error['password'] = 'illegal';
    }
    // if(count(mb_convert_kana($password)) > 0){
    //     $error['password'] = 'kana';
    // }
    if($password_re_enter == ''){
        $error['password_re_enter'] = 'blank';
    } 
    // if(count(mb_convert_kana($password_re_enter)) > 0){
    //     $error['password_re_enter'] = 'kana';
    // }
    if($password != $password_re_enter){
        $error['password'] = 'failed';
    }
  
    //$errorが空でなければsignup_check.tpl.phpを呼び出す
    //書き直しの場合はsignup.tpl.phpを呼び出す
    if(!empty($error)){
        $message = '入力内容に不備があります';
        require('signup.tpl.php');
    }
    if(empty($error)){
        session_start();
        $_SESSION['join'] = $_POST;
        $password = password_hash($password, PASSWORD_BCRYPT);
        $password_re_enter = password_hash($password_re_enter, PASSWORD_BCRYPT);

        $image = date('YmdHis') . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], '/Applications/XAMPP/xamppfiles/htdocs/pbook/files/'.$image);
        $message = '以下の内容で登録しますか？';
        require_once('signup_check.tpl.php');

    }  
       // $sql = 'INSERT INTO user FROM pbooks'
    
    @var_dump($_POST);
    echo "\n";
    @var_export($_SESSION);
    echo "\n";
    @var_dump($error);


}



//signup_complete.phpに移動
//不正なアクセスであればroom.phpに移動
require_once __DIR__ . '/../vendor/autoload.php';
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

date_default_timezone_set("Asia/Tokyo");

//ログファイルのパス
$logging_path = __DIR__ . '/../log/signup_check_log.log';
$stream = new StreamHandler($logging_path, Logger::DEBUG);
//出力後、改行するために下記クラスを静止し、パラメーターとしてセットする。
$formatter = new LineFormatter(null, null, true);
$stream->setFormatter($formatter);
$logger = new Logger('pbook/log/signup_check.php');
$logger->pushHandler($stream);

//下記のようにしないと配列などの値が出力されない
$logger->pushProcessor(function($record){
    $record['extra']['dummy'] = '';
    return $record;
});

//$arrは出力したいデータ
//if(!isset($pbook) || !isset($_POST)){
@$logger->addInfo('$birthdayの中身:' . dumper(($password)));
@$logger->addDebug('$memberの中身'.var_export($member, true));
@$logger->warning('$emailの中身:'.dumper($matches));
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


