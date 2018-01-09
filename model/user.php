<?php
include './sql.php';
$keys = array('acc', 'ps', 'email' , 'role');
$has_all_data = true;
$page = 'register&error=1';

foreach ($keys as $key) {
    if (empty($_POST[$key])) {
        $has_all_data = false;
    }
}

if ($has_all_data == true) {
    $ps = md5($_POST['ps']);
    if (mysqli_query($conn, "INSERT INTO user(`acc`, `ps`, `email`, `role`) VALUES('{$_POST['acc']}','{$ps}', '{$_POST['email']}','{$_POST['role']}')")) {
        // echo "success";
    } else {
        // echo 'error'.mysqli_error($conn);
    }
    $page = 'register&success=1';
}

header("Location: /?page={$page}");