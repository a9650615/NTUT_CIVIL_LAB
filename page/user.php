<?php include './component/header.php'; ?>
<?php
    if ($_GET['success'] == '1') {
        echo '<div class="alert alert-info" role="alert">更改成功</div>';
    }
    require_once './model/sql.php';
    $sql = mysqli_query($conn, "SELECT * FROM user WHERE ID='{$_COOKIE['userId']}'");
    $data = $sql->fetch_assoc();
?>
<a href="?page=logout" style="float:right;">登出</a>
<div class="container">
    <div>
        會員資料 <a href="?page=edit_ps">修改密碼</a>
        <ul class="list-group">
            <li class="list-group-item">會員帳號:<?=$data['acc']?></li>
            <li class="list-group-item">會員名稱:<?=$data['name']?></li>
            <li class="list-group-item">工程 ID:<?=$data['order_id']?></li>
        </ul>
    </div>
    <a href="?">回上一頁</a>
</div>
<?php include './component/footer.php'; ?>