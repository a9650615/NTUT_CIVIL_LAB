<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $year = $_GET['year']? $_GET['year']: date('Y');
    $month = $_GET['month']? $_GET['month']: date('m');
    if ($_GET['year']) {
        $timestamp = strtotime("{$_GET['year']}/{$month}/1");
    } else {
        $timestamp = time();
    }
    $in_one_month = "WHERE MONTH(check_date) = MONTH('{$year}-{$month}-1') AND YEAR(check_date) = YEAR('{$year}-{$month}-1')";
    $data_month_total = mysqli_query($conn, "SELECT * FROM quality_list {$in_one_month}");
    $data_month_finish = mysqli_query($conn, "SELECT * FROM quality_list {$in_one_month} AND status=1");
    $data_month_outdate = mysqli_query($conn, "SELECT * FROM quality_list {$in_one_month} AND status!=1 AND check_date < now()");
    $season = 4 - intval((12-date('m', $timestamp)) / 3)-1;
    $season_start = date('Y', $timestamp)."-".($season*3+1)."-1";
    $season_end = date('Y', $timestamp)."-".($season*3+3)."-30";
    $in_one_season = "WHERE check_date BETWEEN '{$season_start}' AND '{$season_end}'";
    $data_season_total = mysqli_query($conn, "SELECT * FROM quality_list {$in_one_season}");
    $data_season_finish = mysqli_query($conn, "SELECT * FROM quality_list {$in_one_season} AND status=1");
    $data_season_outdate = mysqli_query($conn, "SELECT * FROM quality_list {$in_one_season} AND status!=1 AND check_date < now()");
    
    $in_one_year = "WHERE YEAR(check_date) = YEAR('{$year}-{$month}-1')";
    $data_year_total = mysqli_query($conn, "SELECT * FROM quality_list {$in_one_year}");
    $data_year_finish = mysqli_query($conn, "SELECT * FROM quality_list {$in_one_year} AND status=1");
    $data_year_outdate = mysqli_query($conn, "SELECT * FROM quality_list {$in_one_year} AND status!=1 AND check_date < now()");
?>
<a href="?page=quality">上一頁</a>
<div class="col-sm-12 col-md-12 col-mm-12 container">
    <a href="?page=<?=$_GET['page']?>&year=<?=date('Y', $timestamp) - 1?>">上一年</a>
    <a href="?page=<?=$_GET['page']?>&year=<?=date('m', $timestamp)==1?date('Y', $timestamp)-1:date('Y', $timestamp)?>&month=<?=date('m', $timestamp)==1?12:date('m', $timestamp)-1?>">上一月 ( 單一月份 )</a>
    <a href="?page=<?=$_GET['page']?>&year=<?=date('m', $timestamp)==12?date('Y', $timestamp)+1:date('Y', $timestamp)?>&month=<?=date('m', $timestamp)==12?1:date('m', $timestamp)+1?>">下一月 ( 單一月份 )</a>
    <a href="?page=<?=$_GET['page']?>&year=<?=date('Y', $timestamp) + 1?>">下一年</a>
    <h2><?=$month?>月/<?=$season+1?>季/<?=$year?>年統計</h2>
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