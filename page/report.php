<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql = mysqli_query($conn, "SELECT * FROM quality_list");
    $lists = $sql->fetch_assoc();
?>
<table class="table">
<thead>
    <tr>
        <th>工程名稱</th>
        <th>狀態</th>
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
                <td><?=$status?></td>
                <td>
                    <?php
                        if ($data['status'] != 1)
                        {
                            ?>
                            <a href="?page=update_quality">更新狀態</a>
                            <?
                        }
                    ?>
                </td>
            </tr>
            <?
        }
    ?>
</tbody>
</table>
<?php include './component/footer.php'; ?>
