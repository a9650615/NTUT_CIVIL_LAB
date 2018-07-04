<?php include './component/header.php'; ?>
<?php
    if ($_GET['success'] == '1') {
        echo '<div class="alert alert-info" role="alert">註冊成功</div>';
    }
    if ($_GET['error'] == '1') {
        echo '<div class="alert alert-danger" role="alert">註冊失敗</div>';
    }
?>

<div>
    <div class="box-center">
        <p style="font-size: 35px;" class="font2">註冊頁面</p>
        <form style="font-size: 20px;" action='/model/user.php?action=register' method='post'>
            <label>
                <br>
                員工編號:
                <input type="text" name="acc" required>
            </label>
            <label>
                密碼：
                <input type="password" name="ps" required>
            </label>
            <label>
                確認密碼：
                <input type="password" name="check_ps" required>
            </label>
            <label>
                Email：
                <input type="email" name="email" required>
            </label>
            <label>
                姓名：
                <input type="text" name="name" required>
            </label>
            <label>
                註冊類型：
                <select name="role" id="role">
                    <option value='1'>施工所主管</option>
                    <option value='5'>安全衛生稽核人員</option>
                    <option value='2'>品質改善稽核人員</option>
                    <option value='3'>現場工程師</option>
                    <option value='4'>經理 / 公司主管</option>
                </select>
            </label>
            <label id="No">
                工程編號：
                <input type="text" name="order_id" id="order_id">
            </label>
            <div>
                <br>
                <input type="submit" style="font-size: 25px;" value="送出" />
                <a style="float:right" href="?page=login">回到登入頁面</a>
            </div>
        </form>
        <br>
    </div>
</div>
<script>
    document.getElementById('role').onchange = function(e) {
        if (e.target.value == 1 || e.target.value == 3) {
            document.getElementById('No').style='display:block'
            document.getElementById('order_id').required = true;
        } else {
            document.getElementById('No').style='display:none'
            document.getElementById('order_id').required = false;
        }
    }
</script>


<?php include './component/footer.php'; ?>