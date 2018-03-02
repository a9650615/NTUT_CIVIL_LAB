<?php include './component/header.php'; ?>
<?php
    if ($_GET['success'] == '1') {
        echo '<div class="alert alert-info" role="alert">更改成功</div>';
    }
    require_once './model/sql.php';
    $sql = mysqli_query($conn, "SELECT * FROM user WHERE ID='{$_COOKIE['userId']}'");
    $data = $sql->fetch_assoc();
?>
<div class="container">
    <div>
        <p style="font-size: 35px">員工資料</p> <br> 
        <ul class="list-group">
            <li class="list-group-item">員工編號:<?=$data['acc']?></li>
            <li class="list-group-item">員工姓名:<?=$data['name']?></li>
            <li class="list-group-item">所屬工程編號:<?=$data['order_id']?></li>
        </ul>
        <a style="float:right;" href="?page=edit_ps">修改密碼</a>
    </div>
    <a href="?">回上一頁</a>
</div>
<?php include './component/footer.php'; ?>