<?php
    // error_reporting(E_ALL);
    // error_reporting(E_ALL);
    ini_set('display_errors', 1);
    error_reporting(E_ERROR);
    // error_reporting(E_ERROR | E_WARNING | E_PARSE);
    if ($_GET['page'] == 'logout') {
        setcookie('role', '', time()+3600*24, '/', $_SERVER['SERVER_NAME']);
        setcookie('userId', '', time()+3600*24, '/', $_SERVER['SERVER_NAME']);
        header('Location: /');
    }
    else if ($_GET['page'] == 'user' && !empty($_COOKIE['userId'])) {
        require_once './page/user.php';
    }
    else if ($_GET['page'] == 'edit_ps' && !empty($_COOKIE['userId'])) {
        require_once './page/edit_ps.php';
    }
    else
    if (!empty($_COOKIE['userId']) && !empty($_COOKIE['role'])) {
        $role = $_COOKIE['role'];
        if ($role == 1) {
            if ($_GET['page'] == 'update_quality') {
                require_once './page/quality-update.php';
            }
            else if ($_GET['page'] == 'quality_view') {
                require_once './page/quality-update.php';
            }
            else if ($_GET['page'] == 'quality') {
                require_once './page/report.php';
            }
            else if ($_GET['page'] == 'iso_list') {
                require_once './page/iso-list.php';
            }
            else if ($_GET['page'] == 'create_iso') {
                require_once './page/create-iso.php';
            }
            else if ($_GET['page'] == 'iso_comment') {
                require_once './page/iso-comment.php';
            }
            else if ($_GET['page'] == 'update_iso_list'||$_GET['page'] == 'check_iso'||$_GET['page'] == 'view_iso') {
                require_once './page/update-iso-list.php';
            }
            else
                require_once './page/index_panel.php';
        } 
        else if ($role == 2) {
            if ($_GET['page'] == 'create_quality') {
                require_once './page/quality-create.php';
            }
            else if ($_GET['page'] == 'create_quality' || $_GET['page'] == 'update_quality') {
                require_once './page/quality-create.php';
            }
            else if ($_GET['page'] == 'quality') {
                require_once './page/quality-managent.php';
            }
            else if ($_GET['page'] == 'quality_view') {
                require_once './page/quality-update.php';
            }
            else if ($_GET['page'] == 'quality_finish') {
                require_once './page/quality-finish.php';
            }
            else if ($_GET['page'] == 'quailty_detail') {
                require_once './page/quality-detail.php';
            }
            else if ($_GET['page'] == 'check_status') {
                require_once './page/check-page.php';
            }
            else {
                require_once './page/index_panel.php';
            }
        }
        else if ($role == 3) {
            if ($_GET['page'] == 'create_iso') {
                require_once './page/create-iso.php';
            }
            else if ($_GET['page'] == 'update_iso_list'||$_GET['page'] == 'view_iso') {
                require_once './page/update-iso-list.php';
            }
            else if ($_GET['page'] == 'iso_list') {
                require_once './page/iso-list.php';
            }
            else if ($_GET['page'] == 'select_iso_form') {
                require_once './page/select-iso.php';
            }
            else if ($_GET['page'] == 'check_status') {
                require_once './page/check-page.php';
            }
            else if ($_GET['page'] == 'quality_view') {
                require_once './page/quality-update.php';
            }
            else if ($_GET['page'] == 'quality') {
                require_once './page/report.php';
            }
            else if ($_GET['page'] == 'update_quality') {
                require_once './page/quality-update.php';
            }
            else if ($_GET['page'] == 'safty') {
                require_once './page/safty-list.php';
            }
            else if ($_GET['page'] == 'safty_form') {
                require_once './page/safty-form.php';
            }
            else if ($_GET['page'] == 'update_safty') {
                require_once './page/update-safty.php';
            }
            else if ($_GET['page'] == 'check_safty') {
                require_once './page/check-safty.php';
            }
            else {
                require_once './page/index_panel.php';
            }
        }
        else if ($role == 5) {
            if ($_GET['page'] == 'safty') {
                require_once './page/safty-list.php';
            }
            else if ($_GET['page'] == 'safty_form') {
                require_once './page/safty-form.php';
            }
            else if ($_GET['page'] == 'update_safty') {
                require_once './page/update-safty.php';
            }
        }
        else {
            if ($_GET['page'] == 'create_quality' || $_GET['page'] == 'update_quality') {
                require_once './page/quality-create.php';
            }
            else if ($_GET['page'] == 'check_status') {
                require_once './page/check-page.php';
            }
            else if ($_GET['page'] == 'quality_view') {
                require_once './page/quality-update.php';
            }
            else if ($_GET['page'] == 'quality') {
                require_once './page/quality-managent.php';
            }
            else if ($_GET['page'] == 'quality_finish') {
                require_once './page/quality-finish.php';
            }
            else if ($_GET['page'] == 'quailty_detail') {
                require_once './page/quality-detail.php';
            }
            else if ($_GET['page'] == 'iso_list') {
                require_once './page/iso-list.php';
            }
            else if ($_GET['page'] == 'create_iso') {
                require_once './page/create-iso.php';
            }
            else if ($_GET['page'] == 'update_iso_list'||$_GET['page'] == 'check_iso'||$_GET['page'] == 'view_iso') {
                require_once './page/update-iso-list.php';
            }
            else if ($_GET['page'] == 'case') {
                require_once './page/case.php';
            }
            else if ($_GET['page'] == 'create_case') {
                require_once './page/create-case.php';
            }
            else if ($_GET['page'] == 'edit_case') {
                require_once './page/create-case.php';
            }
            else if ($_GET['page'] == 'iso_comment') {
                require_once './page/iso-comment.php';
            }
            else if ($_GET['page'] == 'safty') {
                require_once './page/safty-list.php';
            }
            else if ($_GET['page'] == 'safty_form') {
                require_once './page/safty-form.php';
            }
            else if ($_GET['page'] == 'update_safty') {
                require_once './page/update-safty.php';
            }
            else
                require_once './page/index_panel.php';
        }
    }
    else {
        if ($_GET['page'] == 'register') {
            require_once './page/register.php';
        }
        if ($_GET['page'] == 'login' || $_GET['page'] == '') {
            require_once './page/login.php';
        }
    }
