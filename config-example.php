<?php

//Kiem tra truy cap
const _ximen = 1;


const _MODULES = 'dashboard';
const _ACTION = 'index';



//Khai bao database;

const _host = 'localhost';
const _db = 'quanlyprovis';
const _user = 'tai_khoan';
const _passowrd = 'dien_mat_khau';
const _driver = 'mysql';

//debug error

const _debug = true;

// host

define('_HOST_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/DoAN');
define('_HOST_URL_TEMPLATE', _HOST_URL . '/template');



// path

define('_PATH_URL', __DIR__);
define('_PATH_URL_TEMPLATE', _PATH_URL . '/template');




// echo _HOST_URL;
// echo '<br/>';
// echo _HOST_URL_TEMPLATE;
// echo '<br/>';
// echo _PATH_URL;
// echo '<br/>';
// echo _PATH_URL_TEMPLATE;
