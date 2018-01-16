<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql = mysqli_query($conn, "SELECT DISTINCT(No) FROM quality_list order by ID desc");
?>
<div class="container">
    <a href="?page=quality">上一頁</a>
    <table class="table" style="margin:auto;">
        <thead>
            <tr>
                <td>工程編號</td>
                <td>合格率</td>
                <td>改善率</td>
            </tr>
            <?php
                while ($data = $sql->fetch_assoc()) {
                    $inner_sql = mysqli_query($conn, "SELECT * FROM quality_list WHERE No= '{$data['No']}' order by ID desc");
                    $row_count = mysqli_num_rows($inner_sql);
                    $no_pass = 0;
                    $out_date = 0;
                    while ($dd = $inner_sql -> fetch_assoc()) {
                        if ($dd['status'] != 1) {
                            $no_pass ++;
                            if (strtotime($dd['resolve_date']) < time()) {
                                $out_date ++;
                            }
                        }
                    }
                    ?>
                    <tr>
                        <td><a href="?page=quailty_detail&no=<?=$data['No']?>"><?=$data['No']?></a></td>
                        <td><?=intval((($row_count - $no_pass)/$row_count)*100)?></td>
                        <td><?=max(0,intval((($row_count - $no_pass - $out_date)/$row_count)*100))?></td>
                    </tr>
                    <?php
                }
            ?>
        </thead>
    </table>
</div>
<?php include './component/footer.php'; ?>