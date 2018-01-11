<?php
include './sql.php';
$keys = array();
$has_all_data = true;
$page = '';

switch ($_GET['action']) {
    case 'create':
        $keys = array('no', 'name', 'order' , 'check_date', 'resolve_date', 'floor', 'now_status', 'feedback');
        break;
}

foreach ($keys as $key) {
    if (empty($_POST[$key])) {
        $has_all_data = false;
    }
}

if ($has_all_data && $_GET['action'] == 'create') {
    $target_dir = "../upload_space/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
    } else {
        // echo "Sorry, there was an error uploading your file.";
    }
    $sql = mysqli_query($conn, "INSERT INTO 
    quality_list(`No`, `name`, `order_id`, `status`, `check_date`, `resolve_date`, `floor`, `other`, `now_status`, `feedback`)
    VALUES ('{$_POST['no']}', '{$_POST['name']}', '{$_POST['order']}', '{$_POST['status']}', '{$_POST['check_date']}', '{$_POST['resolve_date']}', '{$_POST['floor']}', '{$_POST['other']}', '{$_POST['now_status']}', '{$_POST['feedback']}')
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

header("Location: /?page={$page}");