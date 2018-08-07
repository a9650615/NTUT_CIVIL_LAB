<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql = mysqli_query($conn, "SELECT DISTINCT(missing_place) FROM safty_list order by ID desc");
?>
<br>
<a style="font-size: 25px;" href="?page=safty">上一頁</a>
<p style="font-size: 35px" align="center">合格/改善效率</p><br>
<div class="col-sm-12 col-md-12 col-mm-12" id="content-menu">
    
    <table class="table" style="margin:auto;width: 100%">
        <thead>
            <tr>
                <td>工程名稱</td>
                <td>合格率 / <span style="color:#f65d51;" >改善效率</span></td>
                <td>已完成</td>
                <td>未合格/未改善</td>
                <td>逾期</td>
                <td>罰款件數</td>
            </tr>
            <?php
                while ($data = $sql->fetch_assoc()) {
                    $inner_sql = mysqli_query($conn, "SELECT * FROM safty_list {$search} WHERE fine='1' AND missing_place='{$data['missing_place']}' ORDER BY ID DESC");
                    $other_sql = mysqli_query($conn, "SELECT * FROM safty_list {$search} WHERE fine!='1' AND missing_place='{$data['missing_place']}' ORDER BY ID DESC");
                    $row_count = mysqli_num_rows($inner_sql);
                    $other_count = mysqli_num_rows($other_sql);
                    $no_pass = 0;
                    $out_date = 0;
                    $finish = 0;
                    $total = 0;
                    while ($dd = $inner_sql -> fetch_assoc()) {
                        if ($dd['status'] != 1) {
                            $no_pass ++;
                        }
                        if ($dd['status'] == 1) {
                            $finish ++;
                        }
                        if (strtotime($dd['resolve_date']) < time()) {
                            $out_date ++;
                        }
                        // if ($dd['status'] != 1) {
                        //     $no_pass ++;
                        // }
                        $total ++;
                    }

                    while ($dd = $other_sql -> fetch_assoc()) {
                        if ($dd['status'] != 1) {
                            $no_pass ++;
                        }
                        if ($dd['status'] == 1) {
                            $finish ++;
                        }
                        if (strtotime($dd['resolve_date']) < time()) {
                            $out_date ++;
                        }
                        // if ($dd['status'] != 1) {
                        //     $no_pass ++;
                        // }
                        $total ++;
                    }
                    ?>
                    <tr>
                        <td><a href="?page=safty_detail&no=<?=$data['missing_place']?>"><?=$data['missing_place']?></a></td>
                        <td><?=intval((($total - $no_pass)/$total)*100)?>% / 
                            <span style="color:#f65d51;" >
                                <?=max(0,intval((($total - $no_pass - $out_date)/$total)*100))?>%
                            </span></td>
                        <td><?=$finish?></td>
                        <td><?=$no_pass?></td>
                        <td><?=$out_date?></td>
                        <td><?=$other_count?></td>
                    </tr>
                    <?php
                }
            ?>
        </thead>
    </table>
</div>
<?php include './component/footer.php'; ?>