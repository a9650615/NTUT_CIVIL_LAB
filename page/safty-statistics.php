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
    $case_limit = "";
    if ($_COOKIE['role'] == 1 || $_COOKIE['role'] == 3) {
        $user_case = mysqli_query($conn, "SELECT order_id FROM user WHERE ID='{$_COOKIE['userId']}'")->fetch_assoc()['order_id'];
        $case_limit = "AND case_id='{$user_case}'";
    }
    $in_one_month = "WHERE MONTH(check_date) = MONTH('{$year}-{$month}-1') AND YEAR(check_date) = YEAR('{$year}-{$month}-1')";
    // echo $in_one_month;
    $data_month_total = mysqli_query($conn, "SELECT * FROM safty_list {$in_one_month} {$case_limit}");
    $data_month_finish = mysqli_query($conn, "SELECT * FROM safty_list {$in_one_month} {$case_limit} AND status=1");
    $data_month_outdate = mysqli_query($conn, "SELECT * FROM safty_list {$in_one_month} {$case_limit} AND status!=1 AND resolve_date < now()");
    $data_month_fine = mysqli_query($conn, "SELECT * FROM safty_list {$in_one_month} {$case_limit} AND fine!=1");
    $data_month_fine_outdate = mysqli_query($conn, "SELECT * FROM safty_list {$in_one_month} {$case_limit} AND fine!=1 AND resolve_date < now()");
    $season = 4 - intval((12-date('m', $timestamp)) / 3)-1;
    $season_start = date('Y', $timestamp)."-".($season*3+1)."-1";
    $season_end = date('Y', $timestamp)."-".($season*3+3)."-30";
    // echo intval((12-date('m', $timestamp)) / 3)+1;
    // echo date('m', $timestamp).'---'.$season_start.'---'.$season_end;
    $in_one_season = "WHERE check_date BETWEEN '{$season_start}' AND '{$season_end}'";
    $data_season_total = mysqli_query($conn, "SELECT * FROM safty_list {$in_one_season} {$case_limit}");
    $data_season_finish = mysqli_query($conn, "SELECT * FROM safty_list {$in_one_season} {$case_limit} AND status=1");
    $data_season_outdate = mysqli_query($conn, "SELECT * FROM safty_list {$in_one_season} {$case_limit} AND status!=1 AND resolve_date < now()");
    $data_season_fine = mysqli_query($conn, "SELECT * FROM safty_list {$in_one_season} {$case_limit} AND fine!=1");
    $data_season_fine_outdate = mysqli_query($conn, "SELECT * FROM safty_list {$in_one_season} {$case_limit} AND fine!=1 AND resolve_date < now()");
    
    $in_one_year = "WHERE YEAR(check_date) = YEAR('{$year}-{$month}-1')";
    $data_year_total = mysqli_query($conn, "SELECT * FROM safty_list {$in_one_year} {$case_limit}");
    $data_year_finish = mysqli_query($conn, "SELECT * FROM safty_list {$in_one_year} {$case_limit} AND status=1");
    $data_year_outdate = mysqli_query($conn, "SELECT * FROM safty_list {$in_one_year} {$case_limit} AND status!=1 AND resolve_date < now()");
    $data_year_fine= mysqli_query($conn, "SELECT * FROM safty_list {$in_one_year} {$case_limit} AND fine!=1");
    $data_year_fine_outdate = mysqli_query($conn, "SELECT * FROM safty_list {$in_one_year} {$case_limit} AND fine!=1 AND resolve_date < now()");
?>
<a href="?page=safty">上一頁</a>
<div class="col-sm-12 col-md-12 col-mm-12" id="content-menu">
    <a href="?page=<?=$_GET['page']?>&year=<?=date('Y', $timestamp) - 1?>">上一年</a> ||
    <a href="?page=<?=$_GET['page']?>&year=<?=date('m', $timestamp)==1?date('Y', $timestamp)-1:date('Y', $timestamp)?>&month=<?=date('m', $timestamp)==1?12:date('m', $timestamp)-1?>">上一月</a> ||
    <a href="?page=<?=$_GET['page']?>&year=<?=date('m', $timestamp)==12?date('Y', $timestamp)+1:date('Y', $timestamp)?>&month=<?=date('m', $timestamp)==12?1:date('m', $timestamp)+1?>">下一月</a> ||
    <a href="?page=<?=$_GET['page']?>&year=<?=date('Y', $timestamp) + 1?>">下一年</a>
    <h2><?=$month?>月 || <?=$season+1?>季 || <?=$year?>年統計</h2>
    <table class="table" style="margin:auto;width: 100%;">
        <thead>
            <tr>
                <td>時間長度</td>
                <td>總件數</td>
                <td>完成數</td>
                <td>過期數</td>
                <td>罰款件數</td>
                <td>罰款過期數</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>月</td>
                <td><?=mysqli_num_rows($data_month_total)?></td>
                <td><?=mysqli_num_rows($data_month_finish)?></td>
                <td><?=mysqli_num_rows($data_month_outdate)?></td>
                <td><?=mysqli_num_rows($data_month_fine)?></td>
                <td><?=mysqli_num_rows($data_month_fine_outdate)?></td>
            </tr>
            <tr>
                <td>季</td>
                <td><?=mysqli_num_rows($data_season_total)?></td>
                <td><?=mysqli_num_rows($data_season_finish)?></td>
                <td><?=mysqli_num_rows($data_season_outdate)?></td>
                <td><?=mysqli_num_rows($data_season_fine)?></td>
                <td><?=mysqli_num_rows($data_season_fine_outdate)?></td>
            </tr>
            <tr>
                <td>年</td>
                <td><?=mysqli_num_rows($data_year_total)?></td>
                <td><?=mysqli_num_rows($data_year_finish)?></td>
                <td><?=mysqli_num_rows($data_year_outdate)?></td>
                <td><?=mysqli_num_rows($data_year_fine)?></td>
                <td><?=mysqli_num_rows($data_year_fine_outdate)?></td>
            </tr>
        </tbody>
    </table>
</div>
<?php
    include './component/footer.php';
?>