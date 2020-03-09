<?php 
session_start();
require_once('function.php');
if(($_SESSION['id']) && ($_SESSION['time']) + 3600 > time()){

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        var_dump($_GET);
        // $sp_name = $_GET['sp_name'];
        // $team = $_GET['team'];
        // $picture = $_GET['picture'];
        // $description = $_GET['description'];
    }else{
        header('Location: room.php');
    }
   //echo $id;
    require_once ('db_connect.php');
    $sql = 'SELECT sp_name, team, picture, description FROM picture WHERE picture.id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);    
    $stmt->execute();
    $pbook = $stmt->fetch(PDO::FETCH_ASSOC);

    $pdo = null;
    $stmt = null;

}
require_once __DIR__ . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

date_default_timezone_set("Asia/Tokyo");

//ログファイルのパス
$logging_path = __DIR__ . '/log/edit_log.log';
$stream = new StreamHandler($logging_path, Logger::DEBUG);
//出力後、改行するために下記クラスを静止し、パラメーターとしてセットする。
$formatter = new LineFormatter(null, null, true);
$stream->setFormatter($formatter);
$logger = new Logger('pbook/edit.php');
$logger->pushHandler($stream);

//下記のようにしないと配列などの値が出力されない
$logger->pushProcessor(function($record){
    $record['extra']['dummy'] = 'hello world';
    return $record;
});

//$arrは出力したいデータ
@$logger->addInfo('$pbook:' . dumper($pbook));
@$logger->addDebug('$_POST:'.$_POST);
@$logger->warning('警告メッセージ');
@$logger->error('エラーメッセージ');

//var_dumpの結果を文字列として出力するために下記関数を追加
function dumper($obj){
    ob_start();//関数の出力のバッファリングをオンにする　？
    var_dump($obj);
    $ret = ob_get_contents();//文字列変数にバッファした内容をコピー
    ob_end_clean();//バッファの内容を消去
    return $ret;
}
//var_dump($_GET);


    
    $message = "図鑑編集";



    require_once ('edit.tpl.php');
