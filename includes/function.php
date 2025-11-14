<?php

if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}

function layout($layoutName)
{
    // echo  _PATH_URL_TEMPLATE . '/playouts/' . $layoutName . '.php';
    if (file_exists(_PATH_URL_TEMPLATE . '/playouts/' . $layoutName . '.php')) {
        require_once _PATH_URL_TEMPLATE . '/playouts/' . $layoutName . '.php';
    }
}



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//send email
function sendMail($emailTo, $subject, $content)
{

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'tuong_dpm235495@student.agu.edu.vn';                     //SMTP username
        $mail->Password   = 'xdrstbcctqtyfrfi';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('tuong_dpm235495@student.agu.edu.vn', 'MegaMIND');
        $mail->addAddress($emailTo);     //Add a recipient

        // $mail->addAddress('ellen@example.com');             
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');        
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    

        //Content
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;

        return $mail->send(); //gửi mail
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }   
}

//is POST?
function isPost()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        return true;
    }
    return false;
}

//is GET?
function isGet()
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        return true;
    }
    return false;
}

//Filter data ('get')
function filterData($method = '')
{
    $filterArray = [];
    
    if (empty($method)) {
        if (isGet()) {
            if (!empty($_GET)) {
                foreach ($_GET as $key => $value) {
                    $key = strip_tags($key);
                    if (is_array($value)) {
                        $filterArray[$key] = filter_var(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $filterArray[$key] = filter_var(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }
        if (isPost()) {
            if (!empty($_POST)) {
                foreach ($_POST as $key => $value) {
                    $key = strip_tags($key);
                    if (is_array($value)) {
                        $filterArray[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $filterArray[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        } else {
            if ($method == 'get') {
                if (!empty($_GET)) {
                    foreach ($_GET as $key => $value) {
                        $key = strip_tags($key);
                        if (is_array($value)) {
                            $filterArray[$key] = filter_var(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                        } else {
                            $filterArray[$key] = filter_var(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                        }
                    }
                }
            } else if ($method == 'post') {
                if (!empty($_POST)) {
                    foreach ($_POST as $key => $value) {
                        $key = strip_tags($key);
                        if (is_array($value)) {
                            $filterArray[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                        } else {
                            $filterArray[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                        }
                    }
                }
            }
        }
    }

    return $filterArray;
}

//validate email
function validateEmail($email)
{
    // $checkEmail = [];__
    if (!empty($email)) {
        $checkEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    return $checkEmail;
}

//validate int
function validateInt($number)
{ 
    if (!empty($number)) {
        $checkNumber = filter_var($number, FILTER_VALIDATE_INT);
    }
    return $checkNumber;
    
}

//validate phone
function validatePhone($nPhone)
{
    $fnumberPhone = false;
    $checkPhone = false;
    $lenPhone = false;

    if ($nPhone[0] == '0') {
        $fnumberPhone = true;
        $nPhone = substr($nPhone, 1);
    }

    if (validateInt($nPhone)) {
        $checkPhone = true;
    }

    if (strlen($nPhone) == 9) {
        $lenPhone = true;
    }

    if ($fnumberPhone && $checkPhone && $lenPhone) {
        return true;
    }

    return false;
}

//Error

function getMsg($msg, $type = 'success')
{
    echo '<div class="m-0 p-0 " style="color:' . $type . ';block-size: 10px;">';
    echo $msg;
    echo '</div> ';
}

?>
<!-- <div style="">skibi</div> -->