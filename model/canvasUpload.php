<?php
    if ($_FILES['img']['tmp_name']) {
        if ($_GET['action'] == 'create_quality') {
            if (move_uploaded_file($_FILES["img"]["tmp_name"], '../upload_space/'.$_POST['order_id'].'_create.png')) {
                echo 'ok';
            } else {
                echo 'fail';
            }
        }
        else if ($_GET['action'] == 'update_quality') {
            if (move_uploaded_file($_FILES["img"]["tmp_name"], '../upload_space/'.$_POST['order_id'].'_update.png')) {
                echo 'ok';
            } else {
                echo 'fail';
            }
        }
    } else {
        echo 'no';
    }