<?php

class Apiview{
    
    function __construct(){
    }


    public function response($data, $status) {
        header("Content-Type: application/json"); //EN EL HEADER PONE
        header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status)); //Y ACA LO MISM EN EL HEADER PONE EL STATUS
        echo json_encode($data);
    }

    private function _requestStatus($code){
        $status = array(
            200 => "OK",
            404 => "Not found",
            500 => "Internal Server Error"
        );
        return (isset($status[$code]))? $status[$code] : $status[500];
    }
    

}