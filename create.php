<?php 
session_start();
error_reporting(E_ALL);
require_once ('db_connect.php');
require_once('function.php');
$message = "入力エラーがあります";

    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        header('Location:room.php');
        exit;
    }
    $pbook = assignmentPost();
    $error = validatePbook();
        if(isset($error)){
            require_once ('new.tpl.php');
        }
        //$errorに値が一つも入っていなければDBに接続する
        if(!isset($error)){
            $picture = date('YmdHis') . $_FILES['picture']['name'];
            move_uploaded_file($_FILES['picture']['tmp_name'], '/Applications/XAMPP/xamppfiles/htdocs/pbook/files/'.$picture);

        //入力内容をDBに保存する
        //description青文字なぜか　予約語？
        $sql = 'INSERT INTO picture (sp_name, team, picture, description, user_id)
                VALUES (:sp_name, :team, :picture, :description, :user_id)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':sp_name', $pbook['sp_name'], PDO::PARAM_STR);
        $stmt->bindValue(':team', $pbook['team'], PDO::PARAM_STR);
        $stmt->bindValue(':picture', $pbook['picture'], PDO::PARAM_STR);
        $stmt->bindValue(':description', $pbook['description'], PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $pbook['user_id'], PDO::PARAM_INT);
        $stmt->execute();

        //print_r($_FILES);
        $pdo = null;
        $stmt = null;
        }
    
    require_once __DIR__ . '/vendor/autoload.php';
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;

date_default_timezone_set("Asia/Tokyo");

//ログファイルのパス
$logging_path = __DIR__ . '/log/create_log.log';
$stream = new StreamHandler($logging_path, Logger::DEBUG);
//出力後、改行するために下記クラスを静止し、パラメーターとしてセットする。
$formatter = new LineFormatter(null, null, true);
$stream->setFormatter($formatter);
$logger = new Logger('pbook/create.php');
$logger->pushHandler($stream);

//下記のようにしないと配列などの値が出力されない
$logger->pushProcessor(function($record){
    $record['extra']['dummy'] = '';
    return $record;
});

//$arrは出力したいデータ
//if(!isset($pbook) || !isset($_POST)){
@$logger->addInfo('$pbookの中身:' . dumper($_POST));
@$logger->addDebug('$errorの中身'.var_export($error, true));
//@$logger->warning('$user_idの中身:'.$user_id);
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

if(empty($error)){   
    $url = "{$team}/index.php";
    header('Location:'.$url);
    exit();
}

    //require_once ('new.tpl.php');
