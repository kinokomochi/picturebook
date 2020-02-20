<?php 
    
    session_start();
    require_once __DIR__ . '/../vendor/autoload.php';

    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;
    use Monolog\Formatter\LineFormatter;

    date_default_timezone_set("Asia/Tokyo");


    //ログファイルのパス
    $logging_path = __DIR__ . '/../log/test_log.log';
    $stream = new StreamHandler($logging_path, Logger::INFO);
    //出力後、改行するために下記クラスを静止し、パラメーターとしてセットする。
    $formatter = new LineFormatter(null, null, true);
    $stream->setFormatter($formatter);
    $logger = new Logger('pbook/kinoko/index.php');
    //monologの実体にハンドラーとして出力先を追加していく
    $logger->pushHandler($stream);

    //下記のようにしないと配列などの値が出力されない
    $logger->pushProcessor(function($record){
        $record['extra']['dummy'] = 'hello world';
        return $record;
    });

    //dumperの引数はは出力したいデータ
    $logger->addInfo('request_info ' . dumper($pbooks));
    $logger->debug(__DIR__);
    $logger->warning('警告メッセージ');
    $logger->error('エラーメッセージ');
    
    //var_dumpの結果を文字列として出力するために下記関数を追加
    function dumper($obj){
        ob_start();//関数の出力のバッファリングをオンにする　？
        var_dump($obj);
        $ret = ob_get_contents();//文字列変数にバッファした内容をコピー
        ob_end_clean();//バッファの内容を消去
        return $ret;
    }
    

    $image = date('YmdHis') . $_FILES['picture']['name'];
    move_uploaded_file($_FILES['picture']['tmp_name'],'../files/'. $image);
    $_SESSION['image'] = $image;
    

    require_once ('../db_connect.php');
    $sql = 'SELECT * FROM picture WHERE team = "kinoko"';
    $stmt = $pdo->prepare($sql);
    // $stmt->bindValue(':sp_name', $sp_name, PDO::PARAM_STR);
    // $stmt->bindValue(':description', $description, PDO::PARAM_STR);
    $stmt->execute();
    $pbooks = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $pbooks[] = $row;
    }
    //print_r($pbooks);
    
    $pdo = null;
    $stmt = null;

    $message = "図鑑一覧";



    require_once ('../index.tpl.php');
