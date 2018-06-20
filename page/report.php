<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql_string = "";
    if ((string) $_GET['filter'] != '' && (string) $_GET['name'] == '' ) {
        $sql_string = $sql_string . " WHERE status='{$_GET['filter']}'";
        if ($_GET['name']) {
            $sql_string = $sql_string . " name='{$_GET['name']}'";
        }
    } else if ((string) $_GET['name'] != '' && (string) $_GET['filter'] == '') {
        $sql_string = $sql_string . " WHERE name='{$_GET['name']}'";
    } else if ((string) $_GET['name'] != '' && (string) $_GET['filter'] != '') {
        $sql_string = $sql_string . " WHERE name='{$_GET['name']}' and status='{$_GET['filter']}'";
    }
    $sql = mysqli_query($conn, "SELECT * FROM (SELECT order_id, ID as user_id FROM `user` WHERE ID={$_COOKIE['userId']}) u INNER JOIN quality_list ON quality_list.No = u.order_id 
    {$sql_string} ORDER BY ID DESC");
    $row_count = mysqli_num_rows($sql);
    $no_pass = 0;
    $out_date = 0;
?>
<p align="center" style="font-size: 35px;">品質改善表單總覽</p>
<a href="/">上一頁</a>
<div style="text-align: right;">

</div>
<div class="alert alert-info" style="width: 80%; margin: auto; margin-top: 10px;" role="alert">
    <form method="get" actions="?">
        <input type="hidden" value="quality" name="page" />
        <input type="hidden" value="<?=$_GET['name']?>" name="name" />
        篩選 : 
        <select name="filter">
            <option value="">全部</option>
            <option value="0" <?=$_GET['filter']=='0'?"selected":""?>>未改善</option>
            <option value="1" <?=$_GET['filter']=='1'?"selected":""?>>已改善</option>
            <option value="2" <?=$_GET['filter']=='2'?"selected":""?>>未合格</option>
        </select>
        <input type="submit" value="篩選" />
    </form>
    共 <?=$row_count?> 筆資料
</div>
<table class="table" style="margin:auto;">
<thead>
    <tr>
        <th>工程名稱</th>
        <th>查驗日期/改善期限</th>
        <th width="20%">狀態<span style="float:right;">＊(已更新)</span></th>
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
                <td><a href="?page=<?=$_GET['page']?>&name=<?=$data['name']?>&filter=<?=$_GET['filter']?>"><?=$data['name']?></a></td>
                <td><span style="width:100px;"><?=$data['check_date']?></span>/<span style="width:100px;"><?=$data['resolve_date']?></span></td>
                <td><?=$status?>
                    <?php
                    if ($data['resolve_image'] != "" && ($data['status'] == 0 || $data['status'] == 2))
                        echo "<span style='color:red;'>*</span>";
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
                        if ($data['status'] != 1)
                        {
                            ?>
                            <a href="?page=update_quality&id=<?=$data['ID']?>">更新狀態</a>
                            <?
                        }
                    ?>
                </td>
            </tr>
            <?php
        }
    ?>
</tbody>
</table>
<div class="alert alert-info" style="width: 80%; margin: auto; margin-top: 10px;" role="alert">
    合格率 : <?=intval((($row_count - $no_pass)/$row_count)*100)?>% | [(總件數－未合格件數)／總件數]*100%<br>
    改善效率 : <?=max(0,intval((($row_count - $no_pass - $out_date)/$row_count)*100))?>% |  改善效率＝[(總件數－未合格件數－逾期件數)／總件數]*100%
</div>
<?php include './component/footer.php'; ?>
