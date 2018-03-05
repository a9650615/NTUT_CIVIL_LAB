<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql_string = "SELECT * FROM quality_list";
    if ((string) $_GET['filter'] != '') {
        $sql_string = $sql_string . " WHERE status='{$_GET['filter']}'";
        if ($_GET['name']) {
            $sql_string = $sql_string . " name='{$_GET['name']}'";
        }
    } else if ((string) $_GET['name'] != '') {
        $sql_string = $sql_string . " WHERE name='{$_GET['name']}'";
    }
    $sql_string = $sql_string . " ORDER BY ID DESC";
    $sql = mysqli_query($conn, $sql_string);
    $row_count = mysqli_num_rows($sql);
    $no_pass = 0;
    $out_date = 0;
?>
<div>
    <p align="center" style="font-size: 35px;">品質改善表單總覽</p>
    <br><br><a style="font-size: 25px" href="?page=create_quality">新增品質改善表</a>
    <a  style="float:right;" href="/">上一頁</a>
    <br>

    <div class="alert alert-info" style="width: 80%; margin: auto; margin-top: 10px;" role="alert">
        <form method="get" actions="?">
            <input type="hidden" value="quality" name="page" />
            篩選 : 
            <select name="filter">
                <option value="">全部</option>
                <option value="0" <?=$_GET['filter']=='0'?"selected":""?>>未改善</option>
                <option value="1" <?=$_GET['filter']=='1'?"selected":""?>>已改善</option>
                <option value="2" <?=$_GET['filter']=='2'?"selected":""?>>未合格</option>
            </select>
            <input type="submit" value="篩選" />
        </form>

        共 <?=$row_count?> 筆資料 ( <a href="?page=quality_finish">合格/改善效率</a> )
    </div>
    <table class="table" style="margin:auto;">
        <thead>
            <tr>
                <th>工程名稱</th>
                <th>查驗日期/改善期限</th>
                <th width="20%">狀態(*=已更新)<span style="float:right;"></span></th>
                <th>是否逾期</th>
                <th>閱覽</th>
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
                        <td><a href="?page=<?=$_GET['page']?>&name=<?=$data['name']?>"><?=$data['name']?></a></td>
                        <td><span style="width:100px;"><?=$data['check_date']?></span>/<span style="width:100px;"><?=$data['resolve_date']?></span></td>
                        <td><?=$status?>
                        <?php
                            if ($data['resolve_image'] != "" && ($data['status'] == 0 || $data['status'] == 2))
                                echo "<span style='color:red;'>*</span><a href='?page=check_status&id={$data['ID']}'>檢查</a>";
                        ?>
                        </td>
                        <td>
                            <?php
                                if (strtotime($data['resolve_date']) < time()) {
                                    echo '是';
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
</div>
<?php include './component/footer.php'; ?>