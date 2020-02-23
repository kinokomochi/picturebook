<?php 
//error_reporting(E_ALL);
require_once ('db_connect.php');
$message = "入力エラーがあります";

//$file_path = 'files/'. $_FILES['picture']['name'];
    
    if(isset($_POST['submit'])){
        if($_POST['sp_name'] == ''){
            $error['sp_name'] = 'blank';
        }
        if(mb_strlen($_POST['sp_name']) > 50){
            $error['sp_name'] = 'length';
        }
        if($_POST['team'] == ''){
            $error['team'] = 'blank';
        }
        $filename = $_FILES['picture']['name'];
        if(!empty($filename)){
            $ext = substr($filename, -3);
            if($ext != 'jpg' && $ext != 'JPG' && $ext != 'png'){
                $error['picture'] = 'type';
            }
        }
        if($_POST['description'] == ''){
            $error['description'] = 'blank';
        }

        if(!empty($error)){
            require_once ('new.tpl.php');
            
        }
        if(empty($error)){
            $sp_name = $_POST['sp_name'];
            $team = $_POST['team'];
            $picture = date('YmdHis') . $_FILES['picture']['name'];
            move_uploaded_file($_FILES['picture']['tmp_name'], '../files/' . $picture);
            $description = $_POST['description'];
            // /echo $_FILES['picture']['name'];
        }
    $sql = 'INSERT INTO picture (sp_name, team, picture, description)
            VALUES (:sp_name, :team, :picture, :description)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':sp_name', $sp_name, PDO::PARAM_STR);
    $stmt->bindValue(':team', $team, PDO::PARAM_STR);
    $stmt->bindValue(':picture', $picture, PDO::PARAM_STR);
    $stmt->bindValue(':description', $description, PDO::PARAM_STR);
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
$stream = new StreamHandler($logging_path, Logger::INFO);
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
if(!isset($pbook) || !isset($_POST)){
$logger->addInfo('request_info ' . dumper($_POST));
$logger->addDebug(var_export($_FILES['picture']['name']));
$logger->warning(dumper($_POST['picture']));
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
    
    $url = "{$team}/index.php";
    header('Location:'.$url);
    exit();


    //require_once ('new.tpl.php');
