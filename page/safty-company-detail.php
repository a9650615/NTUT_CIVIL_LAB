<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql = mysqli_query($conn, "SELECT DISTINCT(missing_place) FROM safty_list WHERE missing_company='{$_GET['no']}' order by ID desc");
    $row_count = mysqli_num_rows($sql);
    $out_date = 0;
    $no_pass = 0;
?>
<div class="container">
    <a href="?page=safty_company">上一頁</a>
    <table class="table" style="margin:auto;">
        <thead>
            <tr>
                <th>工程名稱or編號</th>
                <th>合格率/改善率</th>
                <th>已完成(件)</th>
                <th>未完成/未改善(件)</th>
                <th>逾期件數</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($data = $sql -> fetch_assoc()) {
                    $inner_sql = mysqli_query($conn, "SELECT * FROM safty_list WHERE missing_place='{$data['missing_place']}' order by ID desc");
                    $row_count = mysqli_num_rows($inner_sql);
                    $no_pass = 0;
                    $out_date = 0;
                    $finish = 0;
                    while($d = $inner_sql->fetch_assoc()) {
                        if ($d['status'] != 1) {
                            $no_pass ++;
                            if (strtotime($d['resolve_date']) < time()) {
                                $out_date ++;
                            }
                        } else {
                            $finish ++;
                        }
                    }
                    ?>
                    <tr>
                        <td><?=$data['missing_place']?></td>
                        <td>合格率: <?=intval((($row_count - $no_pass)/$row_count)*100)?>%,改善效率: <?=max(0,intval((($row_count - $no_pass - $out_date)/$row_count)*100))?>%</td>
                        <td>
                            <?=$finish?>
                        </td>
                        <td><?=$no_pass?></td>
                        <td><?=$out_date?></td>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
</div>

<?php include './component/footer.php'; ?>