<?php
    header('Access-Control-Allow-Origin: *');
    // header("Content-Type: application/json");
    function autoload($class){
        require 'entidad/'.$class.'.php';
    }
    spl_autoload_register('autoload');

    $res = new users("marcos",123, "../db.json");
    $data = (array) ["user"=> "MIguel", "name"=> 3, "pwd"=>754, "age"=> 0];
    $data2 = (array) ["id"=> "VcmJ6"];
    echo json_encode($res->postUser($data2));
    // echo json_encode($res->getUser());
    // echo json_encode($res->tokenId());

?>