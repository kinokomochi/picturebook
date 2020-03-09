<?php
require_once('../function.php');
$message = "ログインフォーム";
//require_once('login.tpl.php');
//dbと接続する
try{
require_once('../db_connect.php');
$msg = "接続成功";
}catch(PDOException $e){
    $connect = false;
    $msg = "接続失敗";
}
//セッション開始する
session_start();

//ログインボタンが押された時の処理↓
if(isset($_POST['submit'])){
//バリデーションチェック用の$errorを使う
//ユーザーID（メールアドレス）のチェック
//$email = isset($_POST['email']) ? $_POST['email'] : '';
$email = $_POST['email'] ?? '';
//$password = isset($_POST['password']) ? $_POST['password'] : '';
$password = $_POST['password'] ?? '';
 //アドレス蘭が空の時、$errorに’blank'を入れる
    if($email == ''){
        $error['email'] = 'blank';
    }
    //パスワードが空の時、$errorに'blank'を入れる
    if($password == ''){
        $error['password'] = 'blank';
    }
    //$errorがある場合、入力画面に戻る
    if(isset($error)){
        require_once('login.tpl.php');
    }
//$errorが空であれば、IDがDBに登録された情報と一致するか認証する
//つまり、DBから入力されたデータが存在するか検索する
    if(!isset($error)){
        $sql = 'SELECT * FROM user  
                WHERE email = :email';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR_CHAR);
        $stmt->execute();
        $member = $stmt->fetch(PDO::FETCH_ASSOC);
        $pdo = null;
        $stmt = null;
        //DBにレコードが存在しないつまりユーザーがいない場合はエラーを吐く
        if(!$member){
            $error['email'] = 'empty';
        }
        //DBに検索したレコードが存在したら、PWが一致するか調べる
        if(isset($member) && $member != ''){
            if(password_verify($_POST['password'], $member['password'])){
            //取得したレコードのメールアドレスをセッションに格納
            //$_SESSION['email'] = $member['email'];
            $_SESSION['id'] = $member['id'];
            $_SESSION['time'] = time();

            //元いたページにリダイレクトするか確認ページにリダイレクトする
            require_once('login_check.tpl.php');
            }else{
                $error['login'] = 'failed';
                require_once('login.tpl.php');
            }
        }else{
            $error['login'] = 'failed';
            require_once('login.tpl.php');
        }
    }
}else{
    header('Location:../room.php');
}
    
    

       


    






//認証が成功すればroom.phpに移動する。
//失敗したら再入力画面に移動する(tplを再度呼び出す)

//ログ
require_once __DIR__ . '/../vendor/autoload.php';
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

date_default_timezone_set("Asia/Tokyo");

//ログファイルのパス
$logging_path = __DIR__ . '/../log/login_check_log.log';
$stream = new StreamHandler($logging_path, Logger::DEBUG);
//出力後、改行するために下記クラスを静止し、パラメーターとしてセットする。
$formatter = new LineFormatter(null, null, true);
$stream->setFormatter($formatter);
$logger = new Logger('pbook/login.php');
$logger->pushHandler($stream);

//下記のようにしないと配列などの値が出力されない
$logger->pushProcessor(function($record){
    $record['extra']['dummy'] = 'hello world';
    return $record;
});

//$arrは出力したいデータ
$logger->addInfo('request_info ' . dumper($_POST));
$logger->Debug('$member'.dumper($member));
//if(isset($error)){
$logger->warning('$_SESSIONの値'.dumper($_SESSION));
//}
$logger->error('$_COOKIEの値'.dumper($_COOKIE));

//var_dumpの結果を文字列として出力するために下記関数を追加
function dumper($obj){
    ob_start();//関数の出力のバッファリングをオンにする　？
    var_dump($obj);
    $ret = ob_get_contents();//文字列変数にバッファした内容をコピー
    ob_end_clean();//バッファの内容を消去
    return $ret;
}