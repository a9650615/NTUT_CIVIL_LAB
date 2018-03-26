<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql = mysqli_query($conn, "SELECT DISTINCT(missing_place) FROM safty_list order by ID desc");
?>
<div class="container">
    <a href="?page=safty">上一頁</a>
    <table class="table" style="margin:auto;">
        <thead>
            <tr>
                <td>工程名稱</td>
                <td>合格率/改善效率</td>
                <td>已完成</td>
                <td>未完成/未改善</td>
                <td>逾期</td>
            </tr>
            <?php
                while ($data = $sql->fetch_assoc()) {
                    $inner_sql = mysqli_query($conn, "SELECT * FROM safty_list WHERE missing_place= '{$data['missing_place']}' order by ID desc");
                    $row_count = mysqli_num_rows($inner_sql);
                    $no_pass = 0;
                    $out_date = 0;
                    $finish = 0;
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
                    }
                    ?>
                    <tr>
                        <td><a href="?page=safty_detail&no=<?=$data['missing_place']?>"><?=$data['missing_place']?></a></td>
                        <td><?=intval((($row_count - $no_pass)/$row_count)*100)?>%/<?=max(0,intval((($row_count - $no_pass - $out_date)/$row_count)*100))?>%</td>
                        <td><?=$finish?></td>
                        <td><?=$no_pass?></td>
                        <td><?=$out_date?></td>
                    </tr>
                    <?php
                }
            ?>
        </thead>
    </table>
</div>
<?php include './component/footer.php'; ?>