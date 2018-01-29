<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql = mysqli_query($conn, "SELECT * FROM case_list ORDER BY ID desc");
?>
<div class="container">
    <a href="/">上一頁</a> <br>
    <a href="?page=create_case">新增工程</a>
    <table class="Table" align="center">
        <thead>
        <tr>
            <th>工程編號</th>
            <th>工程名稱</th>
            <th>施工所主管</th>
            <th>檢查人員</th>
            <th>承包商名稱</th>
            <th>編輯</th>
        </tr>
        </thead>
        <tbody>
            <?php
                while($data = $sql->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?=$data['order_id']?></td>
                        <td><?=$data['order_name']?></td>
                        <td><?=$data['supervisor']?></td>
                        <td><?=$data['checker']?></td>
                        <td><?=$data['contractor']?></td>
                        <td>
                            <a href="?page=edit_case&id=<?=$data['ID']?>">編輯</a>
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