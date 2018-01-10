<?php
include './sql.php';
$keys = array();
$has_all_data = true;
$page = 'register&error=1';

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

if ($_GET['action'] == 'create') {
    
}