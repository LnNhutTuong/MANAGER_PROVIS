<?php

if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}

try{
    if(class_exists('PDO')){
        $options=array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ); 
        $dsn= _driver.':host='._host."; dbname="._db;
        $conn = new PDO($dsn , _user, _password, $options);
    }    
}catch (Exception $ex){
    require './modules/error/404.php';
    die();
}