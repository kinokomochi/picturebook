<?php

//システム初期化、及び共通関数
require_once('config.php');
require_once('function.php');
require_once('login_function.php');
require_once('url_root.php');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;//シンプルなファイル出力用ハンドラー
use Monolog\Handler\RotatingFileHandler;
//RotatingFileHandler: StreamHandlerを継承したハンドラー。
//ログを日付別のファイルに分割し、一定数より古いものは自動的に削除する。
use Monolog\Formatter\LineFormatter;
//フォーマッターは、ログ行を出力先へ書き出す際のフォーマット処理を担当。
//フォーマッターは1つのハンドラーにつき1つだけ設定できる。

function _newLogger(){
    //ロガーをインスタンス化する際に付与する識別名がチャンネルと呼ばれる
    //チャンネル名　ロガーインスタンスの１つ１つがチャンネルに相当
    $logger = new Logger('pbook');
    $logger->setTimezone(new DateTimeZone('Asia/Tokyo'));
    //ハンドラーは物理的なログ出力処理を担当。様々なハンドラーがある。
    //1つのロガーに複数のハンドラーを登録できる。
    $handler = new RotatingFileHandler(__DIR__. '/log/access.log', 3, LOGLEVEL);
    $handler->setFormatter(new LineFormatter(
        "%datetime%[%level_name%] %message% \n", 'H:i:s'));
    $logger->pushHandler($handler);
    if(DEBUG){
        $handler = new StreamHandler(__DIR__.'/log/debug.log', Logger::DEBUG);
        $handler->setFormatter(new LineFormatter(
            "%datetime%[%level_name%]%extra.file%(%extra.line%):%message% \n",
            'H:i:s.v', true));
        $logger->pushHandler($handler);
    }
    //プロセッサーはロガーやハンドラーに対して、ログ行ごとの付加情報の処理を担当
    //ロガー及びハンドラー1つに対して、複数のプロセッサーを登録出来る。
    $logger->pushProcessor(function($rec){
        if(DEBUG) {
            $depth = 5; //スタックフレームの制限数 スタック：データ後入れ先出しのやつ
            $bt = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, $depth);//PHPバックトレースを生成。
            $rec['extra']['file'] = basename($bt[$depth-1]['file']); //basename: パスの最後にある名前の部分を返す
            $rec['extra']['line'] = $bt[$depth-1]['line']; 
        }
        $rec['level_name'] = substr($rec['level_name'], 0, 1); //文字列 $rec['level_name'] の0から1バイト分までを返す
        return $rec;
    });
    return $logger;
}
function logE($msg) {
    $logger = _newLogger();
    $msg .= ' - ' . $_SERVER['REQUEST_URI'];
    $logger->error($msg);
}
function logI($msg) {
    $logger = _newLogger();
    $logger->info($msg);
}
function logD($msgOrArray, $caption=null) {
    $logger = _newLogger();
    $msg = is_string($msgOrArray) ? $msgOrArray : var_export($msgOrArray, true);
    if(!is_null($caption)) $msg = $caption . '=' . $msg;
    $logger->debug($msg);
}

function connectDB() {
    return new PDO(DSN, DBUSER, DBPASS, [
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES=>false,
        PDO::MYSQL_ATTR_INIT_COMMAND=>"SET time_zone='Asia/ToKyo'",
    ]);
}