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
    $sql = mysqli_query($conn, "INSERT INTO safty_list(`missing_place`, `missing_company`, `check_place`, `fine`, `other`, `image`, `resolve_image`)
        VALUES ('{$_POST['missing_place']}', '{$_POST['missing_company']}', '{$_POST['check_place']}', '{$_POST['fine']}', '{$_POST['other']}', '{$file_name}', '')
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

header("Location: /?page={$page}");