<?php 
session_start();
require_once('function.php');
// var_dump($_SESSION);
if(!isset($_SESSION['id'])){
    $_SESSION['return_uri'] =  "http://localhost/pbook/new.php";
    header('Location:login/login.php');
    exit;
}

if(($_SESSION['id']) && ($_SESSION['time']) + 3600 > time()){
require_once ('db_connect.php');//DBに接続
$id = $_SESSION['id'];
//DBからログインしているメンバーのuser.idを取得してpicture.user_idと紐付けたい。　
$sql = 'SELECT * FROM user WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$member = $stmt->fetch();
$pdo = null;
$stmt = null;

// require_once __DIR__ . '/vendor/autoload.php';
// use Monolog\Logger;
// use Monolog\Handler\StreamHandler;
// use Monolog\Formatter\LineFormatter;

// date_default_timezone_set("Asia/Tokyo");

// //ログファイルのパス
// $logging_path = __DIR__ . '/log/new_log.log';
// $stream = new StreamHandler($logging_path, Logger::INFO);
// //出力後、改行するために下記クラスを静止し、パラメーターとしてセットする。
// $formatter = new LineFormatter(null, null, true);
// $stream->setFormatter($formatter);
// $logger = new Logger('pbook/new.php');
// $logger->pushHandler($stream);

// //下記のようにしないと配列などの値が出力されない
// $logger->pushProcessor(function($record){
//     $record['extra']['dummy'] = 'hello world';
//     return $record;
// });

// //$arrは出力したいデータ
// $logger->addInfo('request_info ' . dumper($_POST));
// $logger->addDebug(dumper($_POST));
// if(isset($error)){
// $logger->warning(dumper($error));
// }
// //$logger->error('エラーメッセージ');

// //var_dumpの結果を文字列として出力するために下記関数を追加
// function dumper($obj){
//     ob_start();//関数の出力のバッファリングをオンにする　？
//     var_dump($obj);
//     $ret = ob_get_contents();//文字列変数にバッファした内容をコピー
//     ob_end_clean();//バッファの内容を消去
//     return $ret;
// }

    //$error = [];
    $message = "図鑑登録";
    require_once ('new.tpl.php');
}