<?php 
error_reporting(E_ALL);
require_once ('db_connect.php');

$message = "入力エラーがあります";
    if(isset($_POST['submit'])){
        $id = $_POST['id'] ?? '';
        $team = $_POST['team'] ?? '';
        $sp_name = $_POST['sp_name'] ?? '';
        $description = $_POST['description'] ?? '';

        $sql = 'SELECT picture FROM picture WHERE id=:id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $picture = $stmt->fetch(PDO::FETCH_ASSOC);
        $picture = $picture['picture'];
        // $pdo =null;
        // $stmt = null;
        if($id == ''){
            header('Location: room.php');
        }
        if($sp_name == ''){
            $error['sp_name'] = 'blank';
        }
        //種名が５０文字以上だったら$error配列に'length'を入れる
        if(mb_strlen($sp_name) > 50){
            $error['sp_name'] = 'length';
        }
        //班欄が空欄だったら$error配列に'blank'を入れる
        if($team == ''){
            $error['team'] = 'blank';
        }
        //説明欄が空欄だったら$error配列に'blank'を入れる
        if($description == ''){
            $error['description'] = 'blank';
        }
        //$error配列に値がセットされているかどうか調べる
        //セットされていればedit.tpl.phpを呼び出す
        //この時インターフェイスは$error, ?
        $pbook['picture'] = $picture;
        $pbook['sp_name'] = $sp_name;
        $pbook['team'] = $team;
        $pbook['description'] = $description;
        if(isset($error)){
            require_once ('edit.tpl.php');
        }
        //$errorに値が一つも入っていなければDBに接続する
        if(!isset($error)){
        $sql = 'UPDATE picture 
                SET sp_name = :sp_name, team = :team, description = :description
                WHERE picture.id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':sp_name', $sp_name, PDO::PARAM_STR);
        $stmt->bindValue(':team', $team, PDO::PARAM_STR);
        $stmt->bindValue(':description', $description, PDO::PARAM_STR);
        $stmt->execute();

        $pdo =null;
        $stmt = null;
        }
    }

require_once __DIR__ . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

date_default_timezone_set("Asia/Tokyo");

//ログファイルのパス
$logging_path = __DIR__ . '/log/update_log.log';
$stream = new StreamHandler($logging_path, Logger::INFO);
//出力後、改行するために下記クラスを静止し、パラメーターとしてセットする。
$formatter = new LineFormatter(null, null, true);
$stream->setFormatter($formatter);
$logger = new Logger('pbook/update.php');
$logger->pushHandler($stream);

//下記のようにしないと配列などの値が出力されない
$logger->pushProcessor(function($record){
    $record['extra']['dummy'] = 'hello world';
    return $record;
});

//$arrは出力したいデータ
$logger->addInfo('$pbook:' . dumper($pbook));
$logger->addDebug('$_POST:'.var_export($_POST,true));
$logger->warning('$_picture:'.var_export($picture,true));
$logger->error('エラーメッセージ');

//var_dumpの結果を文字列として出力するために下記関数を追加
function dumper($obj){
    ob_start();//関数の出力のバッファリングをオンにする　？
    var_dump($obj);
    $ret = ob_get_contents();//文字列変数にバッファした内容をコピー
    ob_end_clean();//バッファの内容を消去
    return $ret;
}

   
    if(empty($error)){ 
    $url = "{$team}/index.php";
    header('Location:'.$url);
    exit();
    }

    