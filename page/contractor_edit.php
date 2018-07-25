<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql = mysqli_query($conn, "SELECT * FROM contractor_list WHERE case_id='{$_GET['id']}' ");
    // $data = $sql->fetch_assoc();
?>

<a href="?page=case">上一頁</a>
<p align="center" style="font-size: 35px;">建立承包商資料</p>
<BR>
<div class="col-sm-12 col-md-12 col-mm-12" id="content-menu">
    <form method="post" action="/model/contractor.php?action=edit_contractor&case_id=<?=$_GET['id']?>">
        現有廠商
        <?php
            while ($data = $sql->fetch_assoc()) {
                ?>
                <div>
                    廠商名稱：<input type="text" name="contractor[<?=$data['ID']?>]" value="<?=$data['name']?>" />
                    <a href="/model/contractor.php?action=delete&case_id=<?=$data['case_id']?>&id=<?=$data['ID']?>">刪除</a>
                </div>
                <?php
            }
        ?>
        <hr />
        新增廠商
        <div>
            廠商名稱：<input type="text" name="new_constractor" />
        </div>
        <input type="submit" value="送出" />
    </form>
</div>
<?php include './component/footer.php'; ?>