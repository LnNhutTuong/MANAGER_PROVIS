<?php

if (!defined('_ximen')) {
    die('---TRUY CAP KHONG HOP LE---');
}


//set session
function setSession($key, $value)
{
    if (!empty(session_id())) {
        $_SESSION[$key] = $value;
        return true;
    }

    return false;
}

//get session
function getSession($key)
{
    if (!empty($key)) {
        if (isset(($_SESSION[$key]))) {
            return $_SESSION[$key];
        }
    } else {
        return $_SESSION;
    }
    return  false;
}

//xoa session
function removeSession($key)
{
    if (!empty($key)) {
        if (isset(($_SESSION[$key]))) {
            unset($_SESSION[$key]);
        }
        return true;
    } else {
        session_destroy();
        return true;
    }
    return false;
}

//tao session flash
function createSessionFlash($key, $value)
{
    $key = $key . '|FLASH|';
    $rel = setSession($key, $value);
    return $rel;
}

//lay session flash
function getSessionFlash($key)
{
    $flashKey = $key . '|FLASH|';
    $rel = getSession($flashKey);
    if ($rel !== false) { // Chỉ xóa session nếu nó tồn tại
         removeSession($flashKey);  
    }
    return $rel;
}