<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql = mysqli_query($conn, "SELECT * FROM quality_list WHERE ID={$_GET['id']}");
    $data = $sql->fetch_assoc();
?>
<div class="container">
    <h2>現況檢查</h2>
    <div class="col">
        <div>
            工程編號： <?=$data['No']?>
        </div>
        <div>
            工程名稱： <?=$data['name']?>
        </div>
        <div>
            現況說明： <?=$data['now_status']?>
        </div>
        <div>
            改善建議： <?=$data['feedback']?>
        </div>
        <div>
            <?php
            $status = "未改善";
            if ($data['status'] == 1)
                $status = "已改善";
            if ($data['status'] == 2)
                $status = "未合格";
            ?>
            改善狀況： <?=$status?>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div>施工現況： </div><img style="max-width: 100%; max-height: 400px;" src="upload_space/<?=$data['now_image']?>" />
            </div>
            <div class="col-sm-12 col-md-6">
                <div>修正狀況： </div><img style="max-width: 100%; max-height: 400px;" src="upload_space/<?=$data['resolve_image']?>" />
            </div>
        </div>
        <div style="margin: 15px 0;" class="alert alert-secondary" role="alert">
            是否已改善?
            <a href="model/quality_list.php?action=check_status&data=success&id=<?=$_GET['id']?>" class="btn btn-primary">已改善</a>
            <a href="model/quality_list.php?action=check_status&data=cancel&id=<?=$_GET['id']?>" class="btn btn-danger">仍未改善</a>
            <a href="?page=quality" style="float: right; padding: 5px;">回上一頁</a>
        </div>
    </div>
</div>
<?php include './component/footer.php'; ?>