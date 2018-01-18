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

header("Location: /?page={$page}");
