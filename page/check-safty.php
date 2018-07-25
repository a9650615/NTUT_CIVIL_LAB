<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql = mysqli_query($conn, "SELECT * FROM safty_list WHERE ID={$_GET['id']}");
    $data = $sql->fetch_assoc();
?>
<div class="container">
    <a href="?page=safty">上一頁</a>
    <p align="center" style="font-size: 35px;">現況檢查</p>
    <br>
    <div class="col">
        <div>
            查驗位置 ： <?=$data['check_place']?>
        </div>
        <div>
            工程名稱 ： <?=$data['missing_place']?>
        </div>
        <div>
            缺失廠商 ： <?=$data['missing_company']?>
        </div>
        <div>
            罰款項目 ： 
                <?php require_once './model/fine_list.php';
                    $fine = array();
                    foreach ($FINE_LIST as $key => $val) {
                        if ($data['fine'] == $key) {
                        $fine = $val;
                        echo $val['text'];
                        break;}}
                ?>
        </div>
        <div>
            <?php
            $status = "未改善";
            if ($data['status'] == 1)
                $status = "已改善";
            if ($data['status'] == 2)
                $status = "未合格";
            ?>
            改善狀況 ： <?=$status?>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div>工地現況 ： </div>
                <div style="position:relative;">
                    <canvas id="drawing" style="position:absolute; left: 0; height: 0; width:100%; height:100%;z-index:5;"></canvas>
                    <img onerror="this.style='display:none'" id="update_img" src="upload_space/safty_<?=$_GET['id']?>_create.png?a=<?=rand()?>" style="max-width:100%; position:absolute;width:100%; height:100%;" />
                    <img style="max-width: 100%; max-height: 400px;" src="upload_space/<?=$data['image']?>" />
                </div>
            </div>
            <?php
                if ($data['resolve_image']) {
                    ?>
                    <div class="col-sm-12 col-md-6">
                        <div>修正狀況 ： </div><img style="max-width: 100%; max-height: 400px;" src="upload_space/<?=$data['resolve_image']?>" />
                    </div>
                    <?php
                }
            ?>
        </div>
        <?php
         if ($_COOKIE['role'] == 5) {
            ?>
            <div style="margin: 15px 0;" class="alert alert-secondary" role="alert">
                是否已完成改善?
                <a href="model/safty.php?action=check_status&data=success&id=<?=$_GET['id']?>" class="btn btn-primary">確認改善</a>
                <a href="model/safty.php?action=check_status&data=cancel&id=<?=$_GET['id']?>" class="btn btn-danger">
                未合格</a>
            </div>
            <?php
         }
        ?>
    </div>
</div>
<?php include './component/footer.php'; ?>