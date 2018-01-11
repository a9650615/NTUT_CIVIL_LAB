<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql = mysqli_query($conn, "SELECT * FROM quality_list");
    $lists = $sql->fetch_assoc();
?>
工程項目列表
<a href="?page=create_quality">建立</a>
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
                    <a href="">刪除</a>
                </td>
            </tr>
            <?
        }
    ?>
</tbody>
</table>
<?php include './component/footer.php'; ?>