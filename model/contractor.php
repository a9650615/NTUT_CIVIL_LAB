<?php
include './sql.php';
$keys = array();
$has_all_data = true;
$page = 'contractor_edit';

switch ($_GET['action']) {
    case 'create':
        $keys = array();
        break;
    case 'update':
        $keys = array();
        break;
}

if ($_GET['action'] == 'edit_contractor') {
    foreach ($_POST['contractor'] as $id => $contractor) {
        // echo "{$id} ${contractor}";
        $update_sql = "UPDATE contractor_list SET name='{$contractor}' WHERE ID='{$id}'";
        mysqli_query($conn, $update_sql);
    }
    if ($_POST['new_constractor']) {
        $create_sql = "INSERT INTO `contractor_list` (`ID`, `case_id`, `name`) VALUES (NULL, {$_GET['case_id']}, '{$_POST['new_constractor']}')";
        mysqli_query($conn, $create_sql);
    }
    $page = "contractor_edit&id={$_GET['case_id']}";
}

if ($_GET['action'] == 'delete') {
    mysqli_query($conn, "DELETE FROM contractor_list WHERE ID='{$_GET['id']}'");
    $page = "contractor_edit&id={$_GET['case_id']}";
}

header("Location: /?page={$page}");
