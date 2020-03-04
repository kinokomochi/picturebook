<?php 

require_once('../db_connect.php');
require_once('../function.php');

//signup.phpから値を受とる
//「登録確認画面へ」が押されていたら、値を変数に渡す
if(isset($_POST['submit'])){
    //同時に$_POSTに値がセットされているか確かめる。
    $name = $_POST['name'] ?? '';
    $image = $_FILES['name']['image'] ?? '';
    $year = $_POST['year'] ?? '';
    $month = $_POST['month'] ?? '';
    $day = $_POST['day'] ?? '';
    $team = $_POST['team'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $password_re_enter = $_POST['password_re_enter'] ?? '';
    //validationチェック $errorにそれぞれのエラー内容の値を入れる
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
            $error = 'type';
        }
    }
    if(checkdate(intval($month), intval($day), intval($year)) == false){
        $error['birthday'] = 'failed';
    }
    if($email == ''){
        $error['email'] = 'blank';
    }
    if($password == ''){
        $error['password'] = 'blank';
    }
    if($password_re_enter == ''){
        $error['password_re_enter'] = 'blank';
    } 
    if($password != $password_re_enter){
        $error['password'] = 'failed';
    }
    
    //$errorが空でなければsignup_check.tpl.phpを呼び出す
    //書き直しの場合はsignup.tpl.phpを呼び出す
    if(isset($error)){
        $message = '入力内容に不備があります';
        require_once('signup.tpl.php');
    }
    
    if(!isset($error)){
        $password = password_hash($password, PASSWORD_BCRYPT);
        $password_re_enter = password_hash($password_re_enter, PASSWORD_BCRYPT);

        $image = date('YmdHis') . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], '/Applications/XAMPP/xamppfiles/htdocs/pbook/files/'.$image);
        // $_POST['name'] = $name;
        // $_FILES['image']['name'] = $image;
        // $_POST['birthday'] = $birthday ?? '';
        // $_POST['team'] = $team;
        // $_POST['email'] = $email;
        // $_POST['password'] = $password;
        // $_POST['password_re_enter'] = $password_re_enter;

        $message = '以下の内容で登録しますか？';
        require_once('signup_check.tpl.php');

        
       // $sql = 'INSERT INTO user FROM pbooks'
    }
    @var_dump($password);
    @var_dump($password_re_enter);
    //var_dump($error);


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
$stream = new StreamHandler($logging_path, Logger::INFO);
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
@$logger->addInfo('$birthdayの中身:' . dumper(isset($birthday)));
@$logger->addDebug(var_export($_FILES['image']['name'], true));
@$logger->warning('$errorの中身:'.dumper($error));
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

