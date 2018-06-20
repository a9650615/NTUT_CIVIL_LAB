<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    if ($_COOKIE['role'] == 3) {
        $user_order_id = mysqli_query($conn, "SELECT * FROM user WHERE ID='{$_COOKIE['userId']}'")->fetch_assoc()['order_id'];
        $sql = mysqli_query($conn, "SELECT DISTINCT(missing_company), missing_place, case_id FROM safty_list WHERE case_id='{$user_order_id}' order by ID desc");
    } else {
        $sql = mysqli_query($conn, "SELECT DISTINCT(missing_company), missing_place, case_id FROM safty_list order by ID desc");
    }
?>
<div class="container">
    <a href="?page=safty">上一頁</a>
    <table class="table" style="margin:auto;">
        <thead>
            <tr>
                <td>工程名稱</td>
                <td>缺失廠商名稱</td>
                <td>罰款件數</td>
                <td>缺失件數</td>
                <td>備註</td>
            </tr>
            <?php
                while ($data = $sql->fetch_assoc()) {
                    $inner_sql_count = mysqli_query($conn, "SELECT * FROM safty_list WHERE missing_company='{$data['missing_company']}' and missing_place='{$data['missing_place']}' and fine='1' order by ID desc");
                    $inner_sql = mysqli_query($conn, "SELECT * FROM safty_list WHERE missing_company='{$data['missing_company']}' and missing_place='{$data['missing_place']}' and fine != '1' order by ID desc");
                    $row_count = mysqli_num_rows($inner_sql_count);
                    $row_count2 = mysqli_num_rows($inner_sql);
                    $no_pass = 0;
                    $out_date = 0;
                    $all_fine = array();
                    while ($dd = $inner_sql -> fetch_assoc()) {
                        array_push($all_fine, $dd['fine']);
                        // if ($dd['status'] != 1 || strtotime($dd['resolve_date']) < time()) {
                        //     $no_pass ++;
                        // }
                    }
                    ?>
                    <tr>
                        <td><?=$data['missing_place']?></td>
                        <td><a href="?page=safty_company_detail&no=<?=$data['missing_company']?>&no2=<?=$data['missing_place']?>"><?=$data['missing_company']?></a></td>
                        <td><?=$row_count2?></td>
                        <td><?=$row_count?></td>
                        <td>
                            <?php
                                require_once './model/fine_list.php';
                                foreach ($all_fine as $v) {
                                    foreach ($FINE_LIST as $i => $val) {
                                        if ($i == $v) {
                                            echo "{$val['text']}<br>";
                                            break;
                                        }
                                    }
                                }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </thead>
    </table>
</div>
<?php include './component/footer.php'; ?>