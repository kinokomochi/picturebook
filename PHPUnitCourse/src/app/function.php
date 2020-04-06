<?php
namespace functions;
require_once('function.php');
class Functions {
    public $error;

    public function h($str){
        $str = "<<>>";
        if(h($str) == "<<>>"){
        echo "NG";
        return false;
        }else{
        echo "OK";
        return true;
        }
    }

    public function emptyError(){
        $error = ['sp_name'=>'', 'team'=>'', 'picture'=>'', 'description'=>''];
        return $error;
    }

    public function hasError(){
        $error = ['sp_name'=>'blank', 'team'=>'blank', 'picture'=>'blank', 'description'=>'blank'];

        if(
        $error['sp_name'] != ''
        || $error['team'] != ''
        || $error['picture'] != ''
        || $error['description'] != ''
        ){
            echo "OK";
            return true;
        }
    }
}
