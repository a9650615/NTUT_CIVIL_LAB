<?php include './component/header.php'; ?>
<?php
    if ($_GET['success'] == '1') {
        echo '<div class="alert alert-info" role="alert">註冊成功</div>';
    }
?>
<div>
    <div class="box-center">
        註冊頁面
        <form action='/model/user.php' method='post'>
            <label>
                帳號:
                <input type="text" name="acc">
            </label>
            <label>
                密碼：
                <input type="password" name="ps">
            </label>
            <label>
                註冊類型：
                <select name="role">
                    <option value='1'>審核者</option>
                    <option value='2'>監管者</option>
                </select>
            </label>
            <div>
                <input type="submit" value="送出" />
            </div>
        </form>
    </div>
</div>
<?php include './component/footer.php'; ?>