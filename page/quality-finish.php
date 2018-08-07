<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql = mysqli_query($conn, "SELECT DISTINCT(No) FROM quality_list order by ID desc");
?>
<br>
<a style="font-size: 25px;" href="?page=quality">上一頁</a>
<p style="font-size: 35px" align="center">合格/改善效率</p><br>
<div class="col-sm-12 col-md-12 col-mm-12" id="content-menu">

    <table class="table" style="margin:auto;">
        <thead>
            <tr>
                <td>工程名稱</td>
                <td>合格率/改善效率</td>
                <td>已完成</td>
                <td>未合格/未改善</td>
                <td>逾期</td>
                <td>總件數</td>
            </tr>
            <?php
                while ($data = $sql->fetch_assoc()) {
                    $inner_sql = mysqli_query($conn, "SELECT * FROM quality_list WHERE No= '{$data['No']}' order by ID desc");
                    $case_sql = mysqli_query($conn, "SELECT * FROM case_list WHERE order_id='{$data['No']}'");
                    $case_data = $case_sql -> fetch_assoc();
                    $row_count = mysqli_num_rows($inner_sql);
                    $no_pass = 0;
                    $out_date = 0;
                    $resolve = 0;
                    $total = 0;
                    while ($dd = $inner_sql -> fetch_assoc()) {
                        if ($dd['status'] != 1) {
                            $no_pass ++;
                        }
                        if ($dd['status'] == 1) {
                            $resolve ++;
                        }
                        if (strtotime($dd['resolve_date']) < time()) {
                            $out_date ++;
                        }
                        $total ++;
                    }
                    ?>
                    <tr>
                        <td><a href="?page=quailty_detail&no=<?=$data['No']?>"><?=$case_data['order_name']?></a></td>
                        <td><?=intval((($total - $no_pass)/$total)*100)?>%/<?=max(0,intval((($total - $no_pass - $out_date)/$total)*100))?>%</td>
                        <td><?=$resolve?></td>
                        <td><?="{$no_pass}/{$out_date}"?></td>
                        <td><?="{$out_date}"?></td>
                        <td><?="{$total}"?></td>
                    </tr>
                    <?php
                }
            ?>
        </thead>
    </table>
</div>
<br>
    <p style="font-size: 20px" align="center">合格率＝[(總件數－未合格件數)／總件數]*100%</p><br>
    <p style="font-size: 20px" align="center">改善效率＝[(總件數－未合格件數－逾期件數)／總件數]*100%</p><br>
<?php include './component/footer.php'; ?>