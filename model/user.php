<?php
include './sql.php';
$keys = array('acc', 'ps' , 'role');
$has_all_data = true;
$page = 'register';

foreach ($keys as $key) {
    if (empty($_POST[$key])) {
        $has_all_data = false;
    }
}

if ($has_all_data == true) {
    if (mysqli_query($conn, "INSERT INTO user(`acc`, `ps`, `role`) VALUES('{$_POST['acc']}','{$_POST['ps']}','{$_POST['role']}')")) {
        // echo "success";
    } else {
        // echo 'error'.mysqli_error($conn);
    }
    $page = 'register&success=1';
}

header("Location: /?page={$page}");