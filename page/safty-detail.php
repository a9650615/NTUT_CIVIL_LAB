<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql = mysqli_query($conn, "SELECT * FROM safty_list WHERE fine='1' AND missing_place='{$_GET['no']}' order by ID desc");
    $row_count = mysqli_num_rows($sql);
    $out_date = 0;
    $no_pass = 0;
?>
<div class="container">
    <a href="?page=safty_finish">上一頁</a>
    <table class="table" style="margin:auto;">
        <thead>
            <tr>
                <th>工程名稱</th>
                <th>狀態</th>
                <th>是否逾期</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($data = $sql -> fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?=$data['missing_place']?></td>
                        <td><?php
                            $status = "<span style='color:red'>未改善</span>";
                            if ($data['status'] == 1)
                                $status = "已改善";
                            else {
                                $no_pass ++;
                                if ($data['status'] == 2)
                                    $status = "<span style='color:red'>未合格</span>";
                            }
                            echo $status;
                        ?></td>
                        <td><?php
                                if (strtotime($data['resolve_date']) < time()) {
                                    echo '是';
                                    //if ($data['status'] != 1)
                                        $out_date ++;
                                }
                                else 
                                {
                                    echo '否';
                                }
                            ?></td>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
    <div class="alert alert-info" style="width: 80%; margin: auto; margin-top: 10px;" role="alert">
        合格率: <?=intval((($row_count - $no_pass)/$row_count)*100)?>% ／改善效率: <?=max(0,intval((($row_count - $no_pass - $out_date)/$row_count)*100))?>%
    </div>
</div>

<?php include './component/footer.php'; ?>