<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $filter = $_GET['filter'] ? " AND status='{$_GET['filter']}'" : "";
    if ($_COOKIE['role'] == 1 || $_COOKIE['role'] ==$admin) {
        $filter = ($_GET['filter'] ? "WHERE status='{$_GET['filter']}'" : "");
        $sql_string = "SELECT * FROM iso_list {$filter} ORDER BY ID DESC";
        $sql_str2 = "SELECT * FROM iso_list ORDER BY ID DESC";
    } else {
        $sql_string = "SELECT * FROM iso_list WHERE user='{$_COOKIE['userId']}' {$filter} ORDER BY ID DESC";
        $sql_str2 = "SELECT * FROM iso_list WHERE user='{$_COOKIE['userId']}' ORDER BY ID DESC";
    }
    $sql = mysqli_query($conn, $sql_string);
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
<div class="container">
    <a href="?">上一頁</a>
    <div class="col-xs-12 col-sm-12 col-md-12">   
          <div class="product_index">

            <div class="col-sm-12 col-md-12 col-mm-12" id="content-menu">
                <div class="menu">
                                <?php
                if ($_COOKIE['role'] == 3 || $_COOKIE['role'] == $admin) {
                    ?>
                    <a href="?page=select_iso_form">新增 ISO 表單</a>
                    <?php
                }
            ?>
                    <div>
                    <p align="center" style="font-size: 35px;">ISO工務表單總覽</p>
                    <br>
                    </div>
                    <div style="margin: 15px 0;" class="alert alert-secondary" role="alert">
                        <a href="?page=iso_list">全</a>: <?=$tot?> 件 | 
                        <a href="?page=iso_list&filter=2">施工所主管已審核</a>: <?=$che?> 件 | 
                        <a href="?page=iso_list&filter=1">未審核</a>: <?=$non?> 件 | 
                        <a href="?page=iso_list&filter=3">未合格</a>: <?=$ret?> 件
                    </div>
                    <table class="table" style="width: 100%;">
                        <thead>
                            <tr>
                                <td>工程名稱</td>
                                <td>狀態</td>
                                <td>建立時間</td>
                                <td>編輯</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($data = $sql->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?=$data['project_name']?>/<?=$data['order_id']?></td>
                                        <td><?php
                                            if ($data['status'] == 0)
                                                echo '未完成';
                                            else if ($data['status'] == 1)
                                                echo '未審核';
                                            else if ($data['status'] == 2)
                                                echo '審核完成';
                                            else if ($data['status'] == 3)
                                                echo '未通過';
                                        ?></td>
                                        <td><?=date("Y-m-d",strtotime($data['create_date']))?></td>
                                        <td><?php 
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