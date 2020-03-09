<?php 
error_reporting(E_ALL);
session_start();

    require_once '../function.php';
    require_once __DIR__ . '/../vendor/autoload.php';

    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;
    use Monolog\Formatter\LineFormatter;

    date_default_timezone_set("Asia/Tokyo");


    //ログファイルのパス
    $logging_path = __DIR__ . '/../log/index_log.log';
    $stream = new StreamHandler($logging_path, Logger::INFO);
    //出力後、改行するために下記クラスを静止し、パラメーターとしてセットする。
    $formatter = new LineFormatter(null, null, true);
    $stream->setFormatter($formatter);
    $logger = new Logger('pbook/kinoko/index.php');
    $logger->pushHandler($stream);

    //下記のようにしないと配列などの値が出力されない
    $logger->pushProcessor(function($record){
        $record['extra']['dummy'] = '';
        return $record;
    });

    //dumperの引数はは出力したいデータ
    
    $logger->error(var_export($_FILES, true));
    
    //var_dumpの結果を文字列として出力するために下記関数を追加
    function dumper($obj){
        ob_start();//関数の出力のバッファリングをオンにする　？
        var_dump($obj);
        $ret = ob_get_contents();//文字列変数にバッファした内容をコピー
        ob_end_clean();//バッファの内容を消去
        return $ret;
    }
    if(!isset($_FILES)){
        $logger->warning('画像登録失敗' . var_export($_FILES, true));
    }
    

    // $picture = date('YmdHis') . $_FILES['picture']['name'];
    // move_uploaded_file($_FILES['picture']['tmp_name'],'../files/'. $picture);
    // $_SESSION['picture'] = $picture;
    
    
    require_once ('../db_connect.php');
    $sql = 'SELECT picture.id, picture.team, sp_name, picture, description, user_id, user.nickname  
            FROM picture LEFT JOIN user 
            ON picture.user_id = user.id WHERE picture.team = "kinoko"';
    $stmt = $pdo->prepare($sql);
    // $stmt->bindValue(':sp_name', $sp_name, PDO::PARAM_STR);
    // $stmt->bindValue(':description', $description, PDO::PARAM_STR);
    $stmt->execute();
    $pbooks = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $pbooks[] = $row;
    }

//     $sql = 'SELECT nickname FROM user INNER JOIN picture 
//     ON user.id = picture.user_id WHERE user.id = :id';
//     $stmt = $pdo->prepare($sql);
//     $stmt->bindValue(':id', $id, PDO::PARAM_STR);
//     $stmt->execute();
//     $member = $stmt->fetch(PDO::FETCH_ASSOC);
//     //print_r($pbooks);
//    //var_dump($pbooks);
    

    $pdo = null;
    $stmt = null;

    $message = "きのこの部屋";
    
    //$logger->addInfo('request_info ' . dumper($pbooks));
    $logger->debug('SQL:' . $sql);
    



    require_once ('../index.tpl.php');
