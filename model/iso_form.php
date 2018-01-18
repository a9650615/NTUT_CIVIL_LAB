<?php
include './sql.php';
$keys = array();
$has_all_data = true;
$page = 'iso_list';

switch ($_GET['action']) {
    case 'create':
        $keys = array('project_name', 'order_id', 'contractor');
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
        if ($data = mysqli_query($conn, $sql)) {
            mysqli_query($conn, "INSERT INTO iso_list_history(`list_id`, `follow_id`, `order_count`) VALUES('{$conn->insert_id}', '{$conn->insert_id}', '0')");
        }
    } else {
        $page = "create_iso&order_id={$_POST['order_id']}";
    }
}

if ($_GET['action'] == 'update') {
    $d = mysqli_query($conn, "SELECT `status` FROM iso_list WHERE ID='{$_GET['id']}'")->fetch_assoc();
    $max_succ = mysqli_query($conn, "SELECT max(list_id) as m FROM iso_data_sheet WHERE order_id='{$_GET['order_id']}'")->fetch_assoc();
    $last = mysqli_query($conn, "SELECT max(order_count) as count FROM iso_list_history WHERE follow_id='{$_GET['id']}'")->fetch_assoc();
    $id = $_GET['id'];
    if ($d['status'] == 3) {
        $need_back = $last['count'] + 1;
        mysqli_query($conn, "INSERT INTO iso_list_history(`list_id`, `follow_id`, `order_count`) VALUES('{$_GET['id']}', '{$_GET['id']}', '{$need_back}')");
        $id = $need_back;
    } else {
        $id = $last['count'];
    }
    // echo $id;
    // $max_succ->fetch_assoc();
    $max = $max_succ['m'];
    $total_count = 0;
    foreach ($_POST['state'] as $key => $value) {
        $search_sql = mysqli_query($conn, "SELECT * FROM iso_select_list WHERE list_id='{$key}' and order_list='{$_GET['id']}' and history_id='{$id}'");
        $count = mysqli_num_rows($search_sql);
        if ($value=="2") $total_count++;
        if ($count == 0 || $d['status'] == 3) {
            mysqli_query($conn, "INSERT INTO iso_select_list(`list_id`, `order_list`, `value`, `history_id`) VALUES('{$key}','{$_GET['id']}','{$value}', '{$id}')");
        } else {
            mysqli_query($conn, "UPDATE iso_select_list SET `value`='{$value}' WHERE list_id='{$key}' and order_list='{$_GET['id']}' and history_id='{$id}' ");
        }
    }
    if ($total_count >= $max) {
        mysqli_query($conn, "UPDATE iso_list SET `status`='1' WHERE ID ='{$_GET['id']}' ");
    } else {
        mysqli_query($conn, "UPDATE iso_list SET `status`='0' WHERE ID ='{$_GET['id']}' ");
    }
}

if ($_GET['action'] == 'check_iso') {
    mysqli_query($conn, "UPDATE iso_list SET `status`='{$_GET['data']}}' WHERE ID ='{$_GET['id']}' ");
}

if ($_GET['action'] == 'delete') {
    mysqli_query($conn, "DELETE FROM iso_list WHERE ID='{$_GET['id']}'");
}

header("Location: /?page={$page}");