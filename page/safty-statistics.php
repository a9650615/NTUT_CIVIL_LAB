<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $in_one_month = "WHERE MONTH(check_date) = MONTH(CURRENT_DATE()) AND YEAR(check_date) = YEAR(CURRENT_DATE())";
    $data_month_total = mysqli_query($conn, "SELECT * FROM safty_list {$in_one_month}");
    $data_month_finish = mysqli_query($conn, "SELECT * FROM safty_list {$in_one_month} AND status=1");
    $data_month_outdate = mysqli_query($conn, "SELECT * FROM safty_list {$in_one_month} AND status!=1 AND check_date < now()");
    $season = 4 - intval(12/date('m'));
    $season_start = date('Y')."-".($season*4)."-1";
    $season_end = date('Y')."-".($season*4+4)."-30";
    $in_one_season = "WHERE check_date BETWEEN '{$season_start}' AND '{$season_end}'";
    $data_season_total = mysqli_query($conn, "SELECT * FROM safty_list {$in_one_season}");
    $data_season_finish = mysqli_query($conn, "SELECT * FROM safty_list {$in_one_season} AND status=1");
    $data_season_outdate = mysqli_query($conn, "SELECT * FROM safty_list {$in_one_season} AND status!=1 AND check_date < now()");
    
    $in_one_year = "WHERE YEAR(check_date) = YEAR(CURRENT_DATE())";
    $data_year_total = mysqli_query($conn, "SELECT * FROM safty_list {$in_one_year}");
    $data_year_finish = mysqli_query($conn, "SELECT * FROM safty_list {$in_one_year} AND status=1");
    $data_year_outdate = mysqli_query($conn, "SELECT * FROM safty_list {$in_one_year} AND status!=1 AND check_date < now()");
?>
<a href="?page=safty">上一頁</a>
<div class="col-sm-12 col-md-12 col-mm-12 container">
    <h2>月/季/年統計</h2>
    <table class="table">
        <thead>
            <tr>
                <td>時間長度</td>
                <td>總件數</td>
                <td>完成數</td>
                <td>過期數</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>月</td>
                <td><?=mysqli_num_rows($data_month_total)?></td>
                <td><?=mysqli_num_rows($data_month_finish)?></td>
                <td><?=mysqli_num_rows($data_month_outdate)?></td>
            </tr>
            <tr>
                <td>季</td>
                <td><?=mysqli_num_rows($data_season_total)?></td>
                <td><?=mysqli_num_rows($data_season_finish)?></td>
                <td><?=mysqli_num_rows($data_season_outdate)?></td>
            </tr>
            <tr>
                <td>年</td>
                <td><?=mysqli_num_rows($data_year_total)?></td>
                <td><?=mysqli_num_rows($data_year_finish)?></td>
                <td><?=mysqli_num_rows($data_year_outdate)?></td>
            </tr>
        </tbody>
    </table>
</div>
<?php
    include './component/footer.php';
?>