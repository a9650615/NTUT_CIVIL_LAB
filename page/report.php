<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql = mysqli_query($conn, "SELECT * FROM (SELECT order_id, ID as user_id FROM `user` WHERE ID={$_COOKIE['userId']}) u INNER JOIN quality_list ON quality_list.No = u.order_id 
    ORDER BY ID DESC");
    $row_count = mysqli_num_rows($sql);
    $no_pass = 0;
    $out_date = 0;
?>
<a href="/">上一頁</a>
<div style="text-align: right;">
    <a href="?page=logout">登出</a>
</div>
<div class="alert alert-info" style="width: 80%; margin: auto; margin-top: 10px;" role="alert">
    共 <?=$row_count?> 筆資料
</div>
<table class="table" style="margin:auto;">
<thead>
    <tr>
        <th>工程名稱</th>
        <th>查驗日期/改善期限</th>
        <th width="20%">狀態<span style="float:right;">*(已更新)</span></th>
        <th>是否逾期</th>
        <th>更新</th>
    </tr>
</thead>
<tbody>
    <?php
        while ($data = $sql->fetch_assoc()) {
            $status = "未改善";
            if ($data['status'] == 1)
                $status = "已改善";
            else {
                $no_pass ++;
                if ($data['status'] == 2)
                    $status = "未合格";
            }
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
                            if ($data['status'] != 1)
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
<div class="alert alert-info" style="width: 80%; margin: auto; margin-top: 10px;" role="alert">
    合格率: <?=intval((($row_count - $no_pass)/$row_count)*100)?>%,改善率: <?=max(0,intval((($row_count - $out_date)/$row_count)*100))?>%
</div>
<?php include './component/footer.php'; ?>
