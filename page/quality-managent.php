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
?>
<div>
    <h4 style="display: inline-block;">工程項目列表</h4>
    <a href="?page=create_quality">建立</a>
    <a href="?page=logout" style="float:right;">登出</a>
    <div>
        <form method="get" actions="?">
            篩選 : 
            <select name="filter">
                <option value="">全部</option>
                <option value="0" <?=$_GET['filter']=='0'?"selected":""?>>未改善</option>
                <option value="1" <?=$_GET['filter']=='1'?"selected":""?>>已改善</option>
                <option value="2" <?=$_GET['filter']=='2'?"selected":""?>>未合格</option>
            </select>
            <input type="submit" value="篩選" />
        </form>
    </div>
    <table class="table" style="margin:auto;">
        <thead>
            <tr>
                <th>工程名稱</th>
                <th>查驗日期/改善期限</th>
                <th width="20%">狀態<span style="float:right;">*(已更新)</span></th>
                <th>是否逾期</th>
                <th>閱覽</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while ($data = $sql->fetch_assoc()) {
                    $status = "未改善";
                    if ($data['status'] == 1)
                        $status = "已改善";
                    if ($data['status'] == 2)
                        $status = "未合格";
                    ?>
                    <tr>
                        <td><a href="?name=<?=$data['name']?>"><?=$data['name']?></a></td>
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
                                }
                                else 
                                {
                                    echo '否';
                                }
                            ?>
                        </td>
                        <td>
                            <!--<a href="?page=update_quality&id=<?=$data['ID']?>">編輯</a>
                            <a href="model/quality_list.php?action=delete&id=<?=$data['ID']?>">刪除</a>-->
                            <a href="?page=quality_view&id=<?=$data['ID']?>">閱覽</a>
                        </td>
                    </tr>
                    <?
                }
            ?>
        </tbody>
    </table>
</div>
<?php include './component/footer.php'; ?>