<?php require_once './component/header.php'; ?>
<?php
    include './model/sql.php';
    $search = '';
    // if (is_numeric($_GET['filter'])) {
    //     $search = "AND status = '{$_GET['filter']}'";
    // }
    $search = false;
    $sql_string = "SELECT * FROM safty_list";
    if ((string) $_GET['filter'] != '' || (string) $_GET['case_id'] != '' ) {
        $search = true;
    }
    if ((string) $_GET['filter'] != '' && (string) $_GET['case_id'] == '' ) {
        $sql_string = $sql_string . " WHERE status='{$_GET['filter']}'";
        if ($_GET['case_id']) {
            $sql_string = $sql_string . " case_id='{$_GET['case_id']}'";
        }
    } else if ((string) $_GET['case_id'] != '' && (string) $_GET['filter'] == '') {
        $sql_string = $sql_string . " WHERE case_id='{$_GET['case_id']}'";
    } else if ((string) $_GET['case_id'] != '' && (string) $_GET['filter'] != '') {
        $sql_string = $sql_string . " WHERE case_id='{$_GET['case_id']}' and status='{$_GET['filter']}'";
    }

    if ($_COOKIE['role'] == 1 || $_COOKIE['role'] == 3) { 
        $user_case = mysqli_query($conn, "SELECT order_id FROM user WHERE ID='{$_COOKIE['userId']}'")->fetch_assoc()['order_id']; 
        if ($search) {
            $case_limit = " AND case_id='{$user_case}'"; 
        } else {
            $case_limit = " WHERE case_id='{$user_case}'"; 
        }
    } 
    $sql_string = $sql_string . $case_limit . " ORDER BY update_at DESC, ID DESC";
    $sql = mysqli_query($conn, $sql_string);
    $case_sql = mysqli_query($conn, "SELECT * FROM case_list");
?>
<a href="/">上一頁</a>
<p align="center" style="font-size: 35px;">安衛缺失改善總覽</p>
<br>
<div class="col-sm-12 col-md-12 col-mm-12" id="content-menu">

    <?php
        if ($_COOKIE['role']==5 || $_COOKIE['role']==$admin) {
            ?>
            <a style="font-size: 25px;" href="?page=safty_form">新增安衛表單</a>
            
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
        <select name="case_id">
            <option value="">全部</option>
            <?php
                while($case = $case_sql->fetch_assoc()) {
                    ?>
                    <option value="<?=$case['order_id']?>" <?=($_GET['case_id'] == $case['order_id']? "selected" : "")?>><?=$case['order_name']?></option>
                    <?php
                }
            ?>
        </select>
        <input type="submit" value="篩選" />
    </form>
    <div class="menu">
        <div>

        </div>
        <table class="table" style="width: 100%;">
            <thead>
                <tr>
                    <td width="16%">工程名稱</td>
                    <!-- <td>缺失廠商</td> -->
                    <td width="25%">查驗日期/<span style="color:#f65d51;" >改善日期</span></td>
                    <td width="19%">狀態(*已更新)</td>
                    <td width="15%">是否逾期</td>
                    <td width="25%">編輯</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($sql)
                while ($data = $sql->fetch_assoc()) {
                        $row_count ++;
                        if (strtotime($data['resolve_date']) < time()) {
                            $out_date ++;
                        }
                    ?>
                    <tr>
                        <td><?=$data['missing_place']?></td>
                        <!-- <td><?=$data['missing_company']?></td> -->
                        <td><span><?=$data['check_date']?></span>/<span style="color:#f65d51;"><?=$data['resolve_date']?></span></td>
                        <td><?php 
                            $status = "<span style='color: red;'>未改善</span>";
                            if ($data['status'] == 1)
                                $status = "已改善";
                            else {
                                    $no_pass ++;
                                    if ($data['resolve_image'] != "" && ($data['status'] == 2)&& ($_COOKIE['role'] == 5|| $_COOKIE['role']==$admin)) {
                                        $status = "<span style='color: red;'>未合格</span>";
                                    }

                                    else if ($data['resolve_image'] != "" && ($data['status'] == 2)&& ($_COOKIE['role'] == 3|| $_COOKIE['role']==1)) {
                                        $status = "<span style='color: red;'>未合格*</span>";
                                    }


                                    else if ($data['status'] == 3 && ($_COOKIE['role'] == 1|| $_COOKIE['role']==3)) {
                                        $status = "<span style='color:red;'>審核中</span>";
                                    }

                                    else if ($data['resolve_image'] != "" && ($data['status'] == 3 ) && $_COOKIE['role'] == 5) {
                                        $status = "<span style='color:red;'>審核中*</span><a href='?page=check_safty&id={$data['ID']}'>檢查</a>";
                                    }

                            }
                            echo $status;
                        ?></td>
                        <td>
                            <?=((strtotime($data['resolve_date']) < time()&&$data['status']!=1)?"是":"否")?>
                        </td>
                        <td>
                            <?php 
                                if ($_COOKIE['role'] == $admin) {
                                    ?>
                                    <a href="./model/safty.php?action=delete&id=<?=$data['ID']?>">刪除</a>
                                    <?php
                                }
                                if ($_COOKIE['role'] == 5 || $_COOKIE['role'] == $admin) {
                                    ?>
                                    <a href="?page=safty_form&id=<?=$data['ID']?>">編輯</a>
                                    <a href='?page=check_safty&id=<?=$data['ID']?>'>預覽</a>
                                    <?php
                                }
                            ?>
                            <?php
                                if (($data['status'] == 0 || $data['status'] == 2 || $data['status']==3)&&($_COOKIE['role']==3 || $_COOKIE['role']==$admin)) {
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
    <div class="alert alert-info" style="width: 100%; margin: auto; margin-top: 10px;" role="alert">
        <?php
            if ($_COOKIE['role'] != 5) {
                ?>
                合格率: <?=intval((($row_count - $no_pass)/$row_count)*100)?>%／改善效率: <?=max(0,intval((($row_count - $no_pass - $out_date)/$row_count)*100))?>%
                <?php
            }
        ?>
        （<a href="?page=safty_finish">合格/改善效率</a>）(<a href="?page=safty_company">缺失廠商統計</a>) (<a href="?page=safty_overview">罰款總覽</a>)
        (<a href="?page=safty_statistics">月/季/年統計 </a>)
        <br>合格率＝[(總件數－未合格件數)／總件數]*100%
        <br>改善效率＝[(總件數－未合格件數－逾期件數)／總件數]*100%
    </div>
</div>
<?php require_once './component/footer.php'; ?>
