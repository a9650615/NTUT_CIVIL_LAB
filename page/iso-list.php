<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $filter = strlen($_GET['filter']) > 0 ? " AND status='{$_GET['filter']}'" : "";
    if ($_COOKIE['role'] ==$admin) {
        $filter = (strlen($_GET['filter']) > 0 ? "WHERE status='{$_GET['filter']}'" : "");
        $sql_string = "SELECT * FROM iso_list {$filter} INNER JOIN case_list ON iso_list.project_name = case_list.order_id ORDER BY update_date DESC, iso_list.ID DESC";
        $sql_str2 = "SELECT * FROM iso_list ORDER BY ID DESC";
    } else if ($_COOKIE['role'] == 1) {
        $my_order_id = mysqli_query($conn, "SELECT order_id FROM user WHERE ID='{$_COOKIE['userId']}'")->fetch_assoc();
        // echo $my_order_id['order_id'];
        $sql_string = "SELECT * FROM iso_list WHERE project_name='{$my_order_id['order_id']}' {$filter} INNER JOIN case_list ON iso_list.project_name = case_list.order_id ORDER BY update_date DESC, iso_list.ID DESC";
        $sql_str2 = "SELECT * FROM iso_list WHERE project_name='{$my_order_id['order_id']}' ORDER BY ID DESC";
    } else {
        $sql_string = "SELECT * FROM iso_list WHERE user='{$_COOKIE['userId']}' {$filter} ORDER BY update_date DESC, ID DESC";
        $sql_str2 = "SELECT * FROM iso_list WHERE user='{$_COOKIE['userId']}' ORDER BY ID DESC";
    }
    $sql = mysqli_query($conn, $sql_string) or die(mysqli_error($conn));
    $sql2 = mysqli_query($conn, $sql_str2);
    $tot = 0;
    $che = 0;
    $non = 0;
    $ret = 0;
    while($data = $sql2->fetch_assoc()) {
        $tot ++;
        if ($data['status'] == 1)
            $non ++;
        else if ($data['status'] == 2)
            $che ++;
        else if ($data['status'] == 3)
           $ret ++;
    }
?>

    <a href="?" class="no-print">上一頁</a>
                        <p align="center" style="font-size: 35px;">ISO檢查表單總覽</p>
                        <br>
    <div class="col-sm-12 col-md-12 col-mm-12" id="content-menu">   
<br>
<?php
                if ($_COOKIE['role'] == 3 || $_COOKIE['role'] == $admin) {
                    ?>
                    <a href="?page=select_iso_form">新增ISO檢查表單</a>
                    <?php
                }
            ?>
                <div class="menu">
                    <div style="margin: 15px 0;" class="alert alert-secondary" role="alert">
                        <a href="?page=iso_list">全</a>: <?=$tot?> 件 | 
                        <a href="?page=iso_list&filter=2">施工所主管已審核</a>: <?=$che?> 件 | 
                        <a href="?page=iso_list&filter=1">未審核</a>: <?=$non?> 件 | 
                        <a href="?page=iso_list&filter=3">未合格</a>: <?=$ret?> 件 |
                        <a href="?page=iso_list&filter=0">未完成</a>: <?=$ret?> 件
                    </div>
                    <table class="table" style="width: 100%;">
                        <thead>
                            <tr>
                                <td>工程名稱</td>
                                <td>狀態</td>
                                <td>建立時間</td>
                                <td class="no-print">編輯</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($data = $sql->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?=$data['order_name']?>/<?=$data['order_id']?></td>
                                        <td><?php
                                            if ($data['status'] == 0)
                                                echo '<span style="color:red">未完成</span>';
                                            else if ($data['status'] == 1)
                                                echo '<span style="color:blue">未審核</span>';
                                            else if ($data['status'] == 2)
                                                echo '審核完成';
                                            else if ($data['status'] == 3)
                                                echo '<span style="color:red">未合格*</span>';
                                        ?></td>
                                        <td><?=date("Y-m-d",strtotime($data['create_date']))?></td>
                                        <td class="no-print"><?php 
                                            if ($_COOKIE['role'] == 3)
                                            if ($data['status'] == 0 || $data['status'] == 3) {
                                                ?>
                                                <a href="?page=update_iso_list&id=<?=$data['ID']?>">更新</a>
                                                <?php
                                            }
                                            else {
                                                ?>
                                                <a href="?page=view_iso&id=<?=$data['ID']?>">閱覽</a>
                                                <?php
                                            }

                                            if ($_COOKIE['role'] == 1 || $_COOKIE['role'] == $admin) {
                                                if ($data['status'] == 1) {
                                                    ?>
                                                    <a href="?page=check_iso&id=<?=$data['ID']?>">審核</a>
                                                    <?php
                                                }
                                                else if ($data['status'] == 2) {
                                                    ?>
                                                    <a href="?page=view_iso&id=<?=$data['ID']?>">閱覽</a>
                                                    <?php
                                                }
                                                ?>
                                                 <a href="/model/iso_form.php?action=delete&id=<?=$data['ID']?>">刪除</a>
                                                <?php
                                            }
                                        ?></td>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            
          </div>
        </div>
</div>
<?php include './component/footer.php'; ?>