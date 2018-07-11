<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $data = array();
    if ($_GET['id']) {
        $sql = mysqli_query($conn, "SELECT * FROM case_list WHERE ID='{$_GET['id']}'");
        $data = $sql->fetch_assoc();
    }
?>
<div class="container">
    <form method="post" action="/model/case.php?action=<?=($_GET['id'])?"update&id={$_GET['id']}":"create"?>">
        <table class="table">
            <tr>
                <td>工程編號</td>
                <td><label><input type="text" name="order_id" value="<?=$data['order_id']?>"></label></td>
            </tr>
            <tr>
                <td>工程名稱</td>
                <td><label><input type="text" name="order_name" value="<?=$data['order_name']?>"></label></td>
            </tr>
            <tr>
                <td>施工所主管</td>
                <td><label><input type="text" name="supervisor" value="<?=$data['supervisor']?>"></label></td>
            </tr>
            <!-- <tr>
                <td>檢查人員</td>
                <td><label><input type="text" name="checker" value="<?=$data['checker']?>"></label></td>
            </tr> -->
            <!-- <tr>
                <td>承包商名稱</td>
                <td><label><input type="text" name="contractor" value="<?=$data['contractor']?>"></label></td>
            </tr> -->
        </table>
        <input type="submit" value="<?=($_GET['id'])?"修改":"新增"?>" />
    </form>
</div>
<?php include './component/footer.php'; ?>