<?php include './component/header.php'; ?>
<?php
if ($_GET['error'] == '1') {
    echo '<div class="alert alert-danger" role="alert">更改失敗</div>';
}
?>
<div class="container">
    <div>
        <form action="/model/user.php?action=edit_ps" method="post">
            <label>
                輸入舊密碼:
                <input type="password" name="old_ps">
            </label>
            <label>
                輸入新密碼:
                <input type="password" name="new_ps">
            </label>
            <label>
                確認新密碼:
                <input type="password" name="check_ps">
            </label>
            <div>
                <a href="?page=user">上一頁</a>
                <input type="submit" value="更改"/>
            </div>
        </form>
    </div>
</div>
<?php include './component/footer.php'; ?>