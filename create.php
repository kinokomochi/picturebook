<?php 
error_reporting(E_ALL);
require_once ('db_connect.php');
$message = "入力エラーがあります";

//$file_path = 'files/'. $_FILES['picture']['name'];
    
    if(isset($_POST['submit'])){//登録するボタンが押されているか確認
        $user_id = $_POST['user_id'] ?? '';
        //$_POSTに入っている値を変数に入れる
        // if(isset($_POST['sp_name'])){
        //     $sp_name = $_POST['sp_name'];
        // }else{
        //     $sp_name = '';
        // }
        //このif-else文は以下のように書き替え可
        //$sp_name = isset($_POST['sp_name']) ? $_POST['sp_name'] : '';
        //さらに以下のように簡略化できる
        $sp_name = $_POST['sp_name'] ?? '';
        // if(isset($_POST['team'])){
        //     $team = $_POST['team'];
        // }else{
        //     $team = '';
        // }
        //$team = isset($_POST['team']) ? $_POST['team']: '';
        $team = $_POST['team'] ?? '';
        // if(isset($_FILES['picture']['name'])){
        //     $picture = $_FILES['picture']['name'];
        // }else{
        //     $picture = '';
        // }
        //$picture = isset($_FILES['picture']['name']) ? $_FILES['picture']['name'] : '';
        $picture = $_FILES['picture']['name'] ?? '';
        // if(isset($_POST['description'])){
        //     $description = $_POST['description'];
        // }else{
        //     $description = '';
        // }
        //$description = isset($_POST['description']) ? $_POST['description'] : '';
        $description = $_POST['description'] ?? '';
        //種名欄が空欄だったら$error配列に'blank'を入れる
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
        if($picture == ''){
            $error['picture'] = 'blank';
        }
        $filename = $_FILES['picture']['name'];
        if(!empty($filename)){
            $ext = substr($filename, -3);
            if($ext != 'jpg' && $ext != 'JPG' && $ext != 'png'){
                $error['picture'] = 'type';
            }
        }
        //説明欄が空欄だったら$error配列に'blank'を入れる
        if($description == ''){
            $error['description'] = 'blank';
        }
        //$error配列に値がセットされているかどうか調べる
        //セットされていればnew.tpl.phpを呼び出す
        //この時インターフェイスは$error, ?
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
        $stmt->bindValue(':sp_name', $sp_name, PDO::PARAM_STR);
        $stmt->bindValue(':team', $team, PDO::PARAM_STR);
        $stmt->bindValue(':picture', $picture, PDO::PARAM_STR);
        $stmt->bindValue(':description', $description, PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        //print_r($_FILES);
        $pdo = null;
        $stmt = null;
        }
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
$logger->addInfo('$_POSTの中身:' . dumper($_POST));
$logger->addDebug('$_SESSIONの中身'.var_export($_SESSION, true));
$logger->warning('$user_idの中身:'.$user_id);
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
//var_dump($_GET);  

if(empty($error)){   
    $url = "{$team}/index.php";
    header('Location:'.$url);
    exit();
}

    //require_once ('new.tpl.php');
