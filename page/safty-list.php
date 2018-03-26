<?php require_once './component/header.php'; ?>
<?php
    include './model/sql.php';
    $search = '';
    if ($_GET['filter']) {
        $search = "WHERE status = '{$_GET['filter']}'";
    }
    $sql = mysqli_query($conn, "SELECT * FROM safty_list {$search} WHERE fine='1' ORDER BY ID DESC");
?>
<a href="/">上一頁</a>
<div class="col-sm-12 col-md-12 col-mm-12" id="content-menu">
    <?php
        if ($_COOKIE['role']==5 || $_COOKIE['role']==$admin) {
            ?>
            <a style="font-size: 25px;" href="?page=safty_form">新增安衛罰款</a>
            <p align="center" style="font-size: 35px;">安衛罰款總覽</p>
            <?php
        }
        $row_count = 0;
        $no_pass = 0;
        $out_date = 0;
    ?>
    
    <form method="get" actions="?">
        <br>
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

        </div>
        <table class="table" style="width: 100%;">
            <thead>
                <tr>
                    <td>工程名稱</td>
                    <!-- <td>缺失廠商</td> -->
                    <!-- <td>狀態</td> -->
                    <td>查驗日/改善日</td>
                    <td>是否逾期</td>
                    <td>編輯</td>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($data = $sql->fetch_assoc()) {
                        $row_count ++;
                        if (strtotime($data['resolve_date']) < time()) {
                            $out_date ++;
                        }
                    ?>
                    <tr>
                        <td><?=$data['missing_place']?></td>
                        <!-- <td><?=$data['missing_company']?></td> -->
                        <!-- <td><?php 
                            $status = "<span style='color: red;'>未改善</span>";
                            if ($data['status'] == 1)
                                $status = "已改善";
                            else {
                                    $no_pass ++;
                                    if ($data['status'] == 2) {
                                        $status = "<span style='color: red;'>未合格</span>";
                                    }
                                    else if ($data['status'] == 3) {
                                        $status = "審核中";
                                    }
                            }
                            echo $status;
                        ?></td> -->
                        <td><?=$data['check_date']?>/<?=$data['resolve_date']?></td>
                        <td>
                            <?=((strtotime($data['resolve_date']) < time()&&$data['status']!=1)?"是":"否")?>
                        </td>
                        <td>
                            <?php 
                                if ($_COOKIE['role'] == $admin) {
                                    ?>
                                    <a href='?page=check_safty&id=<?=$data['ID']?>'>預覽</a>
                                    <?php
                                }
                                if ($_COOKIE['role'] == 5 || $_COOKIE['role'] == $admin) {
                                    ?>
                                    <a href="?page=safty_form&id=<?=$data['ID']?>">編輯</a>
                                    <a href="./model/safty.php?action=delete&id=<?=$data['ID']?>">刪除</a>
                                    <?php
                                }
                            ?>
                            <?php
                                if ($data['resolve_image'] != "" && ($data['status'] == 3 || $data['status'] == 2) && $_COOKIE['role'] == 5)
                                    echo "<span style='color:red;'>*</span><a href='?page=check_safty&id={$data['ID']}'>檢查</a>";
                                if (($data['status'] == 0 || $data['status'] == 2 || $data['status']==3)&&$_COOKIE['role']==3) {
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
    <div class="alert alert-info" style="width: 100%; margin: auto; margin-top: 10px;" role="alert">
        合格率: <?=intval((($row_count - $no_pass)/$row_count)*100)?>%,改善效率: <?=max(0,intval((($row_count - $no_pass - $out_date)/$row_count)*100))?>%
        （<a href="?page=safty_finish">合格/改善效率</a>）(<a href="?page=safty_company">缺失廠商統計</a>) (<a href="?page=safty_overview">罰款總覽</a>)
    </div>
</div>
<?php require_once './component/footer.php'; ?>
