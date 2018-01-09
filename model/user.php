<?php
include './sql.php';
$keys = array();
$check_register = array('acc', 'ps', 'email' , 'role');
$has_all_data = true;
$page = 'register&error=1';

switch ($_GET['action']) {
    case 'register':
        $keys = $check_register;
        break;
    case 'login':
        $keys = array('acc', 'ps');
        break;
    case 'forget':
        $keys = array('email', 'ps');
        break;
}

foreach ($keys as $key) {
    if (empty($_POST[$key])) {
        $has_all_data = false;
    }
}

if ($_GET['action'] == 'register' && $has_all_data == true) {
    $ps = md5($_POST['ps']);
    if (mysqli_query($conn, "INSERT INTO user(`acc`, `ps`, `email`, `role`) VALUES('{$_POST['acc']}','{$ps}', '{$_POST['email']}','{$_POST['role']}')")) {
        // echo "success";
    } else {
        // echo 'error'.mysqli_error($conn);
    }
    $page = 'register&success=1';
}

if ($_GET['action'] == 'login' && $has_all_data == true) {
    $ps = md5($_POST['ps']);
    $sql = mysqli_query($conn, "SELECT * FROM user where acc='{$_POST['acc']}' and ps='{$ps}'");
    if (mysqli_data_seek($sql, 0)) {
        $data = mysqli_fetch_assoc($sql);
        setcookie("userId", $data['ID'], time()+3600*24, '/', $_SERVER['SERVER_NAME']);
        setcookie("role", $data['role'], time()+3600*24, '/', $_SERVER['SERVER_NAME']);
        $page = 'login&success=1';
        // echo "success";
    } else {
        // echo 'error'.mysqli_error($conn);
        $page = 'login&error=1';
    }
} else if ($_GET['action'] == 'login') {
    $page = 'login&error=1';
}

if ($_GET['action'] == 'forget' && $has_all_data == true) {
    $ps = md5($_POST['ps']);
    mysqli_query($conn, "UPDATE `user` SET ps='{$ps}' WHERE email='{$_POST['email']}'");
    if (mysqli_affected_rows($conn) > 0) {
        // echo "success";
        $page = 'login&forget=1&success=1';
    } else {
        // echo 'error'.mysqli_error($conn);
        $page = 'login&forget=1&error=1';
    }
} else if ($_GET['action'] == 'forget') {
    $page = 'login&forget=1&error=1';
}

header("Location: /?page={$page}");