<?php
include './sql.php';
$keys = array();
$has_all_data = true;
$page = 'quality';

switch ($_GET['action']) {
    case 'create':
        $keys = array('no', 'name', 'order' , 'check_date', 'resolve_date', 'other', 'image', 'floor', 'now_status', 'feedback');
        break;
    case 'edit':
        $keys = array('no', 'name', 'order' , 'check_date', 'resolve_date', 'floor', 'other', 'now_status', 'feedback');
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

if ($has_all_data && $_GET['action'] == 'create') {
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
    $sql = mysqli_query($conn, "INSERT INTO 
    quality_list(`No`, `name`, `order_id`, `status`, `check_date`, `resolve_date`, `floor`, `other`, `fix_type`, `now_status`, `feedback`, `now_image`)
    VALUES ('{$_POST['no']}', '{$_POST['name']}', '{$_POST['order']}', '{$_POST['status']}', '{$_POST['check_date']}', '{$_POST['resolve_date']}', '{$_POST['floor']}', '{$_POST['other']}', '{$_POST['fix_type']}', '{$_POST['now_status']}', '{$_POST['feedback']}', '{$file_name}')
    ");
    // Check if image file is a actual image or fake image
    // $check = getimagesize($_FILES["image"]["tmp_name"]);
    // if($check !== false) {
    //     echo "File is an image - " . $check["mime"] . ".";
    //     $uploadOk = 1;
    // } else {
    //     echo "File is not an image.";
    //     $uploadOk = 0;
    // }
}

if ($has_all_data && !empty($_GET['id']) && $_GET['action'] == 'edit') {
    $target_dir = "../upload_space/";
    $imageFileType = strtolower(pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION));
    // $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $file_name = md5(microtime()) .'.'. $imageFileType;
    $target_file = $target_dir . $file_name;
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
        $file_sql = ", now_image='{$file_name}'";
    } else {
        // echo "Sorry, there was an error uploading your file.";
    }
    $sql = mysqli_query($conn, "UPDATE quality_list SET 
        No='{$_POST['no']}', name='{$_POST['name']}', order_id='{$_POST['order']}', status='{$_POST['status']}', check_date='{$_POST['check_date']}', resolve_date='{$_POST['resolve_date']}', floor='{$_POST['floor']}', now_status='{$_POST['now_status']}', other='{$_POST['other']}', fix_type='{$_POST['fix_type']}', feedback='{$_POST['feedback']}'{$file_sql} WHERE ID='{$_GET['id']}'");
    $page = "update_quality&id={$_GET['id']}";
}

if ($has_all_data && !empty($_GET['id']) && $_GET['action'] == 'update') {
    $target_dir = "../upload_space/";
    $imageFileType = strtolower(pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION));
    // $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $file_name = md5(microtime()) .'.'. $imageFileType;
    $target_file = $target_dir . $file_name;
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
        $sql = mysqli_query($conn, "UPDATE quality_list SET resolve_image='{$file_name}' WHERE ID='{$_GET['id']}'");
    } else {
        // echo "Sorry, there was an error uploading your file.";
    }
    $page = "update_quality&id={$_GET['id']}";
}

if ($_GET['action'] == 'check_status' && !empty($_GET['id'])) {
    if ($_GET['data'] == 'success') {
        $status = 1;
    } else {
        $status = 2;
    }
    $sql = mysqli_query($conn, "UPDATE quality_list SET status='{$status}' WHERE ID='{$_GET['id']}'");
    $page = "quality_manage";
}

if ($_GET['action'] == 'delete' && $_GET['id']) {
    $sql = mysqli_query($conn, "DELETE FROM quality_list WHERE ID='{$_GET['id']}'");
}

header("Location: /?page={$page}");