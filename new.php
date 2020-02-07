<?php 

// require_once __DIR__ . '/vendor/autoload.php';

// use Monolog\Logger;
// use Monolog\Handler\StreamHandler;

// $logger = new Logger('picture');
// $logger->pushHandler(new StreamHandler(__DIR__ . 'log/debug.log', Logger::DEBUG));

// $logger->debug('デバッグレベル');
// $logger->debug(__DIR__);
// $logger->warning('警告。実行時には問題ないが正常とも言えない何らかの予期しない問題');
// $logger->error('エラー。即時アクションは必要ないが監視されるべきであるランタイムエラー');
// $logger->critical('クリティカルなエラー。アプリケーションのコンポーネントが使用できない、予期しない例外など');
// $logger->emergency('緊急。システムが使用不能である');

    require_once ('db_connect.php');

    
    $pdo = null;
    $stmt = null;

    $message = "図鑑登録";



    require_once ('new.tpl.php');
