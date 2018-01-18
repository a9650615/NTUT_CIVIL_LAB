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
    <a href="?page=register">註冊</a>
    <a href="?page=login">登入</a>
</div>
<div>
    <div class="box-center">
        註冊頁面
        <form action='/model/user.php?action=register' method='post'>
            <label>
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
                    <option value='2'>品質稽核人員</option>
                    <option value='3'>現場工程師</option>
                    <option value='4'>經理 & 公司主管</option>
                </select>
            </label>
            <label id="No">
                工程編號：
                <input type="text" name="order_id" id="order_id">
            </label>
            <div>
                <input type="submit" value="送出" />
            </div>
        </form>
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