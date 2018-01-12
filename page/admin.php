<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql = mysqli_query($conn, "SELECT * FROM quality_list ORDER BY ID DESC");
?>
<div>
    工程項目列表
    <a href="?page=create_quality">建立</a>
    <table class="table" style="margin:auto;">
        <thead>
            <tr>
                <th>工程名稱</th>
                <th>狀態<span style="float:right;">* (改善現況已更新)</span></th>
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
                            if ($data['resolve_image'] != "")
                            echo "*";
                        ?>
                        </td>
                        <td>
                            <a href="?page=update_quality&id=<?=$data['ID']?>">編輯</a>
                            <a href="">刪除</a>
                        </td>
                    </tr>
                    <?
                }
            ?>
        </tbody>
    </table>
</div>
<?php include './component/footer.php'; ?>