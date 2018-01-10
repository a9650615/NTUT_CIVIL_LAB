<?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    if (!empty($_COOKIE['userId']) && !empty($_COOKIE['role'])) {
        $role = $_COOKIE['role'];
        if ($role == 1) {
            if ($_GET['page'] == 'create_quality') {
                require_once './page/quality-create.php';
            }
            else
                require_once './page/admin.php';
        } else {
            require_once './page/report.php';
        }
    } else {
        if ($_GET['page'] == 'register') {
            require_once './page/register.php';
        }
        if ($_GET['page'] == 'login') {
            require_once './page/login.php';
        }
    }
