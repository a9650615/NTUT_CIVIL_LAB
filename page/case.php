<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql = mysqli_query($conn, "SELECT * FROM case_list ORDER BY ID desc");
?>

<a  href="/">上一頁</a>
<p align="center" style="font-size: 35px;">工程資料總覽</p>

<BR>
<div  class="col-sm-12 col-md-12 col-mm-12" id="content-menu">

<br>
    <a style="font-size: 25px" href="?page=create_case">新增工程資料</a>
    <table class="table" align="center">
        <br><br>
        <thead>
        <tr>
            <th>工程編號</th>
            <th>工程名稱</th>
            <th>施工所主管</th>
            <!-- <th>檢查人員</th> -->
            <th>承包商名稱</th>
            <th>編輯</th>
        </tr>
        </thead>
        <tbody>
            <?php
                while($data = $sql->fetch_assoc()) {
                    $contractor_list = mysqli_query($conn, "SELECT * FROM contractor_list WHERE case_id='{$data['ID']}' ")
                    ?>
                    <tr>
                        <td><?=$data['order_id']?></td>
                        <td><?=$data['order_name']?></td>
                        <td><?=$data['supervisor']?></td>
                        <!-- <td><?=$data['checker']?></td> -->
                        <td><?php
                            while($con = $contractor_list->fetch_assoc()) {
                                echo $con['name'].'<br>';
                            }
                        ?></td>
                        <td>
                            <a href="?page=contractor_edit&id=<?=$data['ID']?>">編輯承包商</a>
                            <br>
                            <a href="?page=edit_case&id=<?=$data['ID']?>">編輯工程資料</a>
                            <br>
                            <a href="/model/case.php?action=delete&id=<?=$data['ID']?>">刪除</a>
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
</div>
<?php include './component/footer.php'; ?>