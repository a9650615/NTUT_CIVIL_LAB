<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql_string = "SELECT * FROM quality_list";
    if ((string) $_GET['filter'] != '' || (string) $_GET['name'] != '' ) {
        $search = true;
    }
    if ((string) $_GET['filter'] != '' && (string) $_GET['name'] == '' ) {
        if ($_GET['filter'] == 'expired') {
            $sql_string = $sql_string . " WHERE `resolve_date` < CURRENT_DATE()";
        } else {
            $sql_string = $sql_string . " WHERE status='{$_GET['filter']}'";
        }
        if ($_GET['name']) {
            $sql_string = $sql_string . " No='{$_GET['name']}'";
        }
    } else if ((string) $_GET['name'] != '' && (string) $_GET['filter'] == '') {
        $sql_string = $sql_string . " WHERE No='{$_GET['name']}'";
    } else if ((string) $_GET['name'] != '' && (string) $_GET['filter'] != '') {
        if ($_GET['filter'] == 'expired') {
            $sql_string = $sql_string . " WHERE No='{$_GET['name']}' and `resolve_date` < CURRENT_DATE()";
        } else {
            $sql_string = $sql_string . " WHERE No='{$_GET['name']}' and status='{$_GET['filter']}'";
        }
    }

    if ($_GET['year'] != '' || $_GET['month'] != '') {
        $limit = [];
        if ($_GET['year']!='') {
            array_push($limit, "year(check_date) = '{$_GET['year']}'");
        }
        if ($_GET['month']!='') {
            array_push($limit, "month(check_date) = '{$_GET['month']}'");
        }
        $catstring = implode(" AND ", $limit);
        if ($search) {
            $sql_string = $sql_string." AND ".$catstring;
        } else {
            $sql_string = $sql_string." WHERE ".$catstring;
        }
        $search = true;
    }

    $resort = "";
    if ((string) $_GET['first'] != '') {
        $resort = "case when ID = {$_GET['first']} then 0 else 1 end,";
    }
    $sql_string = $sql_string . " ORDER BY {$resort} update_at DESC, ID DESC";
    // echo $sql_string;
    $sql = mysqli_query($conn, $sql_string);
    $case_sql = mysqli_query($conn, "SELECT * FROM case_list");
    $row_count = mysqli_num_rows($sql);
    $no_pass = 0;
    $out_date = 0;
    $all_years = mysqli_query($conn, "SELECT DISTINCT year(check_date) as `year` FROM quality_list");
?>
    <a href="?">上一頁</a>
<p align="center" style="font-size: 35px;">品質改善表單總覽</p>
<BR>
<div class="col-sm-12 col-md-12 col-mm-12" id="content-menu">
<BR>
    <?php
        if ($_GET['role'] != 1 && $_GET['role'] != 3) {
            ?>
            <a style="font-size: 25px" href="?page=create_quality">新增品質改善表</a>
            <?php
        }
    ?>
    <br>

    <div class="alert alert-info" style="width: 100%; margin: auto; margin-top: 10px;" role="alert">
        <form method="get" actions="?">
            <input type="hidden" value="quality" name="page" />
            篩選 : 
            <select name="year">
                <option value="">年</option>
                <?php
                    while($years = $all_years -> fetch_assoc()) {
                        ?>
                        <option <?=$_GET['year']==$years['year']?'selected':''?> value="<?=$years['year']?>" ><?=$years['year']?>年</option>
                        <?php
                    }
                ?>
            </select>
            <select name="month">
                <option value="">月</option>
                <?php
                    for($month = 1; $month <= 12; $month ++) {
                        ?>
                        <option <?=$_GET['month']==$month?'selected':''?>  value=<?=$month?>><?=$month?>月</option>
                        <?php
                    }
                ?>
            </select>
            <select name="filter">
                <option value="">全部</option>
                <option value="0" <?=$_GET['filter']=='0'?"selected":""?>>未改善</option>
                <option value="1" <?=$_GET['filter']=='1'?"selected":""?>>已改善</option>
                <option value="2" <?=$_GET['filter']=='2'?"selected":""?>>未合格</option>
                <option value="expired" <?=$_GET['filter']=='expired'?"selected":""?>>逾期</option>
            </select>
            <select name="name">
                <option value="">全部</option>
                <?php
                    while($case = $case_sql->fetch_assoc()) {
                        ?>
                        <option value="<?=$case['order_id']?>" <?=($_GET['name'] == $case['order_id']? "selected" : "")?>><?=$case['order_name']?></option>
                        <?php
                    }
                ?>
            </select>
            <input type="submit" value="篩選" />
        </form>

        共 <?=$row_count?> 筆資料 ( <a href="?page=quality_finish">合格/改善效率 </a> || <a href="?page=quality_statistics">品質月/季/年統計</a> )
    </div>
    <table  class="table" style="margin:auto;width: 100%;">
        <thead>
            <tr>
                <th width="25%">工程名稱</th>
                <th width="25%" >查驗日期/<span style="color:#f65d51;" >改善期限</span></th>
                <th width="17%">狀態(*已更新)<span style="float:right;"></span></th>
                <th width="13%">是否逾期</th>
                <th width="20%">編輯</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while ($data = $sql->fetch_assoc()) {
                    $status = "<span style='color: red;'>未改善</span>";
                    if ($data['status'] == 1)
                        $status = "已改善";
                    else {
                        $no_pass ++;
                        if ($data['status'] == 2)
                            $status = "<span style='color: red;'>未合格</span>";
                    }
                    ?>
                    <tr>
                        <td><a href="?page=<?=$_GET['page']?>&name=<?=$data['name']?>&filter=<?=$_GET['filter']?>"><?=$data['name']?></a>
                        </td>
                        <td style="word-break:break-all;"><span><?=$data['check_date']?> /
                        </span><span style="color:#f65d51;" ><?=$data['resolve_date']?></span>
                        </td>
                        <td><?=$status?>
                        <?php
                            if ($data['resolve_image'] != "" && ($data['status'] == 0 ))
                                echo "<span style='color:red;'>*</span><a href='?page=check_status&id={$data['ID']}'>檢查</a>";
                        ?>
                        </td>
                        <td>
                            <?php
                                if (strtotime($data['resolve_date']) < time()) {
                                    ?><span style="color:#f65d51;" >是</span><?;
                                    // if ($data['status'] != 1)
                                        $out_date ++;
                                }
                                else 
                                {
                                    echo '否';
                                }
                            ?>
                        </td>
                        <td>
                            <?php
                                if ($_COOKIE['role'] == $admin) {
                                    ?>
                                    <a href="?page=update_quality&id=<?=$data['ID']?>">編輯</a>
                                    <a href="model/quality_list.php?action=delete&id=<?=$data['ID']?>">刪除</a>
                                    <?php
                                }
                            ?>
                            <a href="?page=quality_view&id=<?=$data['ID']?>">閱覽</a>
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
    <div class="alert alert-info" style="width: 100%; margin: auto; margin-top: 10px;" role="alert">
    合格率 : <?=intval((($row_count - $no_pass)/$row_count)*100)?>% | [(總件數－未合格及未改善件數)／總件數]*100%<br>
    改善效率 : <?=max(0,intval((($row_count - $no_pass - $out_date)/$row_count)*100))?>% |  改善效率＝[(總件數－未合格及未改善件數－逾期件數)／總件數]*100%
    </div>
</div>
<?php include './component/footer.php'; ?>