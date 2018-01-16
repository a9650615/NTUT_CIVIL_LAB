<?php
include './sql.php';
$keys = array();
$has_all_data = true;
$page = 'iso_list';

switch ($_GET['action']) {
    case 'create':
        $keys = array('project_name', 'order_id', 'contractor');
        break;
    case 'edit':
        $keys = array();
        break;
    case 'update':
        $keys = array();
        break;
}

foreach ($keys as $key) {
    if (empty($_POST[$key]) && empty($_FILES[$key])) {
        $has_all_data = false;
        // echo $key;
    }
}

if ($_GET['action'] == 'create') {
    if ($has_all_data) {
        $date = date('Y-m-d');
        $sql = "INSERT INTO iso_list (`project_name`, `order_id`, `contractor`, `floor`, `status`, `user`) VALUES('{$_POST['project_name']}', '{$_POST['order_id']}', '{$_POST['contractor']}', '{$_POST['floor']}', '0', '{$_COOKIE['userId']}')";
        if (mysqli_query($conn, $sql)) {

        }
    } else {
        $page = "create_iso&order_id={$_POST['order_id']}";
    }
}

header("Location: /?page={$page}");