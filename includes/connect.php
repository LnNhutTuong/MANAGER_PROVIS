<?php

if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}

<<<<<<< HEAD
$conn = new mysqli(_host, _user, _password, _db,);
=======
$conn = new mysqli(_host, _user, _passowrd, _db);
>>>>>>> 59bd93d1d1914835dff96babe3a4b828c8438eef

// Check connection
if ($conn->connect_error) {
    require './modules/error/404.php';
    die();
}
