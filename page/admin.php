<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql_string = "SELECT * FROM quality_list";
    if ((string) $_GET['filter'] != '') {
        $sql_string = $sql_string . " WHERE status='{$_GET['filter']}'";
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
                <option></option>
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
                <th width="30%">狀態<span style="float:right;">* (改善現況已更新)</span></th>
                <th>編輯</th>
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
                        <td><?=$data['name']?></td>
                        <td><?=$status?>
                        <?php
                            if ($data['resolve_image'] != "" && ($data['status'] == 0 || $data['status'] == 2))
                                echo "<span style='color:red;'>*</span><a href='?page=check_status&id={$data['ID']}'>檢查</a>";
                        ?>
                        </td>
                        <td>
                            <a href="?page=update_quality&id=<?=$data['ID']?>">編輯</a>
                            <a href="model/quality_list.php?action=delete&id=<?=$data['ID']?>">刪除</a>
                        </td>
                    </tr>
                    <?
                }
            ?>
        </tbody>
    </table>
</div>
<?php include './component/footer.php'; ?>