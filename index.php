<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start(); //Tao moi session hoac tiep tuc da ton tai
ob_start(); //tranh loi vat cua header, cookies,...



//----------NHUNG-----------
require_once 'config.php';

//-----------LOG OUT
// Chỉ chạy logout này khi action=logout VÀ module KHÔNG được set
if (isset($_GET['action']) && $_GET['action'] == 'logout' && !isset($_GET['module'])) {
    session_destroy();
    header('Location: ' . _HOST_URL);
    exit();
}


//------includes
// database
require_once './includes/connect.php';
require_once './includes/database.php';

//session
require_once './includes/session.php';
require_once './template/playouts/index.php';

//mail
require_once './includes/mailer/Exception.php';
require_once './includes/mailer/PHPMailer.php';
require_once './includes/mailer/SMTP.php';

//function php
require_once './includes/function.php';

// url
$module = _MODULES;
$action = _ACTION;

if (!empty($_GET['module'])) {
    $module = $_GET['module'];
}

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$path = 'modules/' . $module . '/' . $action . '.php';

if (!empty($path)) {

    if (file_exists($path)) {
        require_once $path;
    } else {

        require_once './modules/error/404.php';
    }
} else {

    require_once './modules/error/500.php';
}
