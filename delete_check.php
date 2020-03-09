<?php 
require_once('function.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $team = $_GET['team'];
    }
    
    require_once ('db_connect.php');
    $sql = 'SELECT * FROM picture WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $pbook = $stmt->fetch(PDO::FETCH_ASSOC);
    $pdo =null;
    $stmt = null;
    require_once __DIR__ . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

date_default_timezone_set("Asia/Tokyo");


//ログファイルのパス
$logging_path = __DIR__ . '/log/delete_check_log.log';
$stream = new StreamHandler($logging_path, Logger::INFO);
//出力後、改行するために下記クラスを静止し、パラメーターとしてセットする。
$formatter = new LineFormatter(null, null, true);
$stream->setFormatter($formatter);
$logger = new Logger('pbook/delete_check.php');
$logger->pushHandler($stream);

//下記のようにしないと配列などの値が出力されない
$logger->pushProcessor(function($record){
    $record['extra']['dummy'] = 'hello world';
    return $record;
});

//$arrは出力したいデータ
$logger->addInfo('request_info ' . dumper($_GET));
$logger->addDebug('SQL:' . $sql);
if(!isset($pbook)){
$logger->warning('パラメーター確認' . var_export($pbook, true));
}
//$logger->error('エラーメッセージ');

//var_dumpの結果を文字列として出力するために下記関数を追加
function dumper($obj){
    ob_start();//関数の出力のバッファリングをオンにする　？
    var_dump($obj);
    $ret = ob_get_contents();//文字列変数にバッファした内容をコピー
    ob_end_clean();//バッファの内容を消去
    return $ret;
}
//var_dump($_GET);
    
    

    $message = "この投稿を削除しますか？";

    
    require_once ('delete_check.tpl.php');
