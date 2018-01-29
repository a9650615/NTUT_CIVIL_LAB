<?php
include './sql.php';
$keys = array();
$has_all_data = true;
$page = 'case';

switch ($_GET['action']) {
    case 'create':
        $keys = array('order_id', 'order_name', 'supervisor', 'checker', 'contractor');
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
    mysqli_query($conn, "INSERT INTO case_list(`order_id`, `order_name`, `supervisor`, `checker`, `contractor`) VALUES('{$_POST['order_id']}', '{$_POST['order_name']}' ,'{$_POST['supervisor']}', '{$_POST['checker']}', '{$_POST['contractor']}')");
}

if ($_GET['action'] == 'update') {
    mysqli_query($conn, "UPDATE case_list SET `order_id`='{$_POST['order_id']}', `order_name`='{$_POST['order_name']}', `supervisor`='{$_POST['supervisor']}', `checker`='{$_POST['checker']}', `contractor`='{$_POST['contractor']}' WHERE ID='{$_GET['id']}'");
}

if ($_GET['action'] == 'delete') {
    mysqli_query($conn, "DELETE FROM case_list WHERE ID='{$_GET['id']}'");
}

header("Location: /?page={$page}");
