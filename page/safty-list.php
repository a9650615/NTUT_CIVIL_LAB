<?php require_once './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql = mysqli_query($conn, "SELECT * FROM safty_list ORDER BY ID DESC");
?>
<a href="?page=logout" style="float:right;">登出</a>
<div class="col-sm-12 col-md-12 col-mm-12" id="content-menu">
    <a href="?page=safty_form">新增安衛罰款</a>
    <form method="get" actions="?">
        <input type="hidden" value="<?=$_GET['page']?>" name="page" />
        篩選 : 
        <select name="filter">
            <option value="">全部</option>
            <option value="0" <?=$_GET['filter']=='0'?"selected":""?>>未改善</option>
            <option value="1" <?=$_GET['filter']=='1'?"selected":""?>>已改善</option>
            <option value="2" <?=$_GET['filter']=='2'?"selected":""?>>未合格</option>
        </select>
        <input type="submit" value="篩選" />
    </form>
    <div class="menu">
        <div>
        <h2 style="color: red">已建檔安衛罰款總覽</h2>
        </div>
        <table class="table" style="width: 100%;">
            <thead>
                <tr>
                    <td>查驗位置</td>
                    <td>缺失項目</td>
                    <td>缺失廠商</td>
                    <td>狀態</td>
                    <td>編輯</td>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($data = $sql->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?=$data['check_place']?></td>
                        <td><?=$data['missing_place']?></td>
                        <td><?=$data['missing_company']?></td>
                        <td><?php 
                            $status = "未改善";
                            if ($data['status'] == 1)
                                $status = "已改善";
                            else {
                                if ($data['status'] == 2)
                                    $status = "未合格";
                            }
                            echo $status;
                        ?></td>
                        <td>
                            <?php 
                                if ($_COOKIE['role'] == 3 || $_COOKIE['role'] == $admin) {
                                    ?>
                                    <a href="?page=safty_form&id=<?=$data['ID']?>">編輯</a>
                                    <a href="./model/safty.php?action=delete&id=<?=$data['ID']?>">刪除</a>
                                    <?php
                                }
                            ?>
                            <?php
                                if ($data['resolve_image'] != "" && ($data['status'] == 3 || $data['status'] == 2) && $_COOKIE['role'] == 3)
                                    echo "<span style='color:red;'>*</span><a href='?page=check_safty&id={$data['ID']}'>檢查</a>";
                                if (($data['status'] == 0 || $data['status'] == 3)&&$_COOKIE['role']==5) {
                                    ?>
                                    <a href="?page=update_safty&id=<?=$data['ID']?>">更新圖片</a>
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once './component/footer.php'; ?>
