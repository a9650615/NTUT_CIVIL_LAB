<?php
include './sql.php';
$keys = array();
$has_all_data = true;
$page = 'safty';

switch ($_GET['action']) {
    case 'create':
        $keys = array('missing_place', 'missing_company', 'missing_image', 'check_place', 'fine');
        break;
    case 'update':
        $keys = array('image');
        break;
}

foreach ($keys as $key) {
    if (empty($_POST[$key]) && empty($_FILES[$key])) {
        $has_all_data = false;
        // echo $key;
    }
}

if ($_GET['action'] == 'create' && $has_all_data) {
    $target_dir = "../upload_space/";
    $imageFileType = strtolower(pathinfo($_FILES["missing_image"]["name"],PATHINFO_EXTENSION));
    // $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $file_name = md5(microtime()) .'.'. $imageFileType;
    $target_file = $target_dir . $file_name;
    if (move_uploaded_file($_FILES["missing_image"]["tmp_name"], $target_file)) {
        // echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
    } else {
        // echo "Sorry, there was an error uploading your file.";
    }
    $sql = mysqli_query($conn, "INSERT INTO safty_list(`missing_place`, `missing_company`, `check_place`, `fine`, `other`, `image`, `resolve_image`,`resolve_date`, `check_date`, `case_id`,`fine_people`,`has_pay`)
        VALUES ('{$_POST['missing_place']}', '{$_POST['missing_company']}', '{$_POST['check_place']}', '{$_POST['fine']}', '{$_POST['other']}', '{$file_name}', '','{$_POST['resolve_date']}', '{$_POST['check_date']}', '{$_POST['case_id']}', '{$_POST['fine_people']}','')
    ");
}

if ($_GET['action'] == 'update' && $has_all_data) {
    $target_dir = "../upload_space/";
    $imageFileType = strtolower(pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION));
    // $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $file_name = md5(microtime()) .'.'. $imageFileType;
    $target_file = $target_dir . $file_name;
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
    } else {
        // echo "Sorry, there was an error uploading your file.";
    }
    $sql = mysqli_query($conn, "UPDATE safty_list SET `resolve_image`='{$file_name}', `status`='3' WHERE ID='{$_GET['id']}'");
    $page = "update_safty&id={$_GET['id']}";
}

if ($_GET['action']=='update_data') {
    $sql = mysqli_query($conn, "UPDATE safty_list 
        SET 
            `missing_place`='{$_POST['missing_place']}',
            `missing_company`='{$_POST['missing_company']}',
            `check_place`='{$_POST['check_place']}',
            `fine`='{$_POST['fine']}',
            `other`='{$_POST['other']}',
            `status`='{$_POST['status']}',
            `resolve_date`='{$_POST['resolve_date']}',
            `check_date`='{$_POST['check_date']}',
            `case_id`='{$_POST['case_id']}',
            `fine_people`='{$_POST['fine_people']}'
     WHERE ID='{$_GET['id']}'");
}

if ($_GET['action'] == 'check_status') {
    $data = 2;
    if ($_GET['data']=='success') {
        $data = 1;
    }
    $sql = mysqli_query($conn, "UPDATE safty_list SET `status`='{$data}' WHERE ID='{$_GET['id']}'");
}

if ($_GET['action']=='delete') {
    $sql = mysqli_query($conn, "DELETE FROM safty_list WHERE ID='{$_GET['id']}'");
}

if ($_GET['action'] == 'check_has_pay') {
    $sql = mysqli_query($conn, "UPDATE safty_list SET `has_pay`='{$_GET['data']}' WHERE ID='{$_GET['id']}'");
    $page='safty_overview';
}

header("Location: /?page={$page}");