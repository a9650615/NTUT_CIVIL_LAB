<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql = mysqli_query($conn, "SELECT * FROM (SELECT order_id, ID as user_id FROM `user` WHERE ID={$_COOKIE['userId']}) u INNER JOIN quality_list ON quality_list.No = u.order_id 
    ORDER BY ID DESC");
?>
<div style="text-align: right;">
    <a href="?page=logout">登出</a>
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
                <td><?=$data['name']?></td>
                <td><span style="width:100px;"><?=$data['check_date']?></span>/<span style="width:100px;"><?=$data['resolve_date']?></span></td>
                <td><?=$status?>
                    <?
                    if ($data['resolve_image'] != "" && ($data['status'] == 0 || $data['status'] == 2))
                        echo "<span style='color:red;'>*</span>";
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
                    <?php
                        if ($data['status'] != 1)
                        {
                            ?>
                            <a href="?page=update_quality&id=<?=$data['ID']?>">更新狀態</a>
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
