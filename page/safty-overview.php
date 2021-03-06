<?php require_once './component/header.php'; ?>
<?php
    include './model/sql.php';
    $search = '';
    if ($_GET['filter']) {
        $search = "WHERE status = '{$_GET['filter']}'";
    }
    if ($_COOKIE['role'] == 3 || $_COOKIE['role'] == 1) {
        $user_order_id = mysqli_query($conn, "SELECT * FROM user WHERE ID='{$_COOKIE['userId']}'")->fetch_assoc()['order_id'];
        $sql = mysqli_query($conn, "SELECT * FROM safty_list {$search} WHERE fine!='1' AND case_id='{$user_order_id}' ORDER BY ID DESC");
    } else {
        $sql = mysqli_query($conn, "SELECT * FROM safty_list {$search} WHERE fine!='1' ORDER BY ID DESC");
    }
?>
<a href="/?page=safty">上一頁</a>
<p align="center" style="font-size: 35px;">安衛罰款總覽</p>
<br>
<div class="col-sm-12 col-md-12 col-mm-12" id="content-menu">

    <?php
        /*if ($_COOKIE['role']==5 || $_COOKIE['role']==$admin) {
            ?>
            <a style="font-size: 25px;" href="?page=safty_form">新增安衛罰款</a>
            <?php
        }*/
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
            <option value="0" <?=$_GET['filter']=='0'?"selected":""?>>未付款</option>
            <option value="1" <?=$_GET['filter']=='1'?"selected":""?>>已付款</option>
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
                    <td>缺失廠商</td>
                    <td>罰款項目</td>
                    <td>總額</td>
                    <td>付款狀態</td>
                    <td>開單日期</td>
                    <!-- <td>狀態</td> -->
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
                        <td><?=$data['missing_company']?></td>
                        <!--td><?php 
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
                        ?></td>-->
                        <td>
                        <?php
                        require_once './model/fine_list.php';
                        $fine = array();
                        foreach ($FINE_LIST as $key => $val) {
                            if ($data['fine'] == $key) {
                                $fine = $val;
                                echo $val['text'];
                                break;
                            }
                        }
                        ?>
                        </td>
                        <td><?=$fine['price']*$data['fine_people']?></td>
                        <td><?php
                            if ($data['has_pay']) {
                                echo '已付款';
                            } else {
                                if ($data['status'] == 3 && $data['resolve_image'] != '') {
                                    echo "審核中";
                                } else {
                                    echo "<span style='color: red;'>未付款</span>";
                                }
                            }
                        ?></td>
                        <td><?=$data['create_date']?></td>
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
                                    echo "<span style='color:red;'>*</span><a href='?page=safty_form&id={$data['ID']}'>檢查</a>";
                                if (($data['status'] == 0 || $data['status'] == 2)&&$_COOKIE['role']==3) {
                                    ?>
                                    <a href="?page=update_safty&id=<?=$data['ID']?>">回覆</a>
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
    <!-- <div class="alert alert-info" style="width: 100%; margin: auto; margin-top: 10px;" role="alert">
        合格率: <?=intval((($row_count - $no_pass)/$row_count)*100)?>%,改善效率: <?=max(0,intval((($row_count - $no_pass - $out_date)/$row_count)*100))?>%
        （<a href="?page=safty_finish">合格/改善效率</a>）(<a href="?page=safty_company">缺失廠商統計</a>)
    </div> -->
</div>
<?php require_once './component/footer.php'; ?>
