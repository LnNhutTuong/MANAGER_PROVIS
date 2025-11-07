<?php

if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}

$conn = new mysqli(_host, _user, _password, _db,);

// Check connection
if ($conn->connect_error) {
    require './modules/error/404.php';
    die();
}
