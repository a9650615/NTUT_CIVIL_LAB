<?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    // error_reporting(E_ALL);
    // error_reporting(E_ALL);
    ini_set('display_errors', 1);
    if ($_GET['page'] == 'logout') {
        setcookie('role', '', time()+3600*24, '/', $_SERVER['SERVER_NAME']);
        setcookie('userId', '', time()+3600*24, '/', $_SERVER['SERVER_NAME']);
        header('Location: /');
    }
    else
    if (!empty($_COOKIE['userId']) && !empty($_COOKIE['role'])) {
        $role = $_COOKIE['role'];
        if ($role == 1) {
            if ($_GET['page'] == 'create_quality' || $_GET['page'] == 'update_quality') {
                require_once './page/quality-create.php';
            }
            else if ($_GET['page'] == 'check_status') {
                require_once './page/check-page.php';
            }
            else
                require_once './page/admin.php';
        } else {
            if ($_GET['page'] == 'update_quality') {
                require_once './page/quality-update.php';
            }
            else {
                require_once './page/report.php';
            }
        }
    } else {
        if ($_GET['page'] == 'register') {
            require_once './page/register.php';
        }
        if ($_GET['page'] == 'login' || $_GET['page'] == '') {
            require_once './page/login.php';
        }
    }
