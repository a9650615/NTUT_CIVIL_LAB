<?php include './component/header.php'; ?>
<div class="container">
    <form method="post" action="/model/case.php?action=create">
        <table class="table">
            <tr>
                <td>工程編號</td>
                <td><label><input type="text" name="order_id"></label></td>
            </tr>
            <tr>
                <td>工程名稱</td>
                <td><label><input type="text" name="order_name"></label></td>
            </tr>
            <tr>
                <td>施工所主管</td>
                <td><label><input type="text" name="supervisor"></label></td>
            </tr>
            <tr>
                <td>檢查人員</td>
                <td><label><input type="text" name="checker"></label></td>
            </tr>
            <tr>
                <td>承包商名稱</td>
                <td><label><input type="text" name="contractor"></label></td>
            </tr>
        </table>
        <input type="submit" value="新增" />
    </form>
</div>
<?php include './component/footer.php'; ?>