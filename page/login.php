<?php include './component/header.php'; ?>
<?php
    if ($_GET['success'] == '1') {
        ?>
        <div class='alert alert-info' role='alert'><?=$_GET['forget']=='1'?'修改成功':'登入成功'?></div>
        <?php
    }
    if ($_GET['error'] == '1') {
        ?>
        <div class='alert alert-danger' role='alert'><?=$_GET['forget']=='1'?'修改失敗':'登入失敗'?></div>
        <?php
    }
?>
<div>
    <a href="?page=register">註冊</a>
    <a href="?page=login">登入</a>
</div>
<div>
    <div class="box-center">
    <?php
        if (empty($_GET['forget'])) {
            ?>
                登入頁面
                <form action='/model/user.php?action=login' method='post'>
                    <label>
                        員工編號:
                        <input type="text" name="acc">
                    </label>
                    <label>
                        密碼：
                        <input type="password" name="ps">
                    </label>
                    <div>
                        <a href="?page=login&forget=1">忘記密碼</a>
                        <input type="submit" value="送出" />
                    </div>
                </form>
                <?php
        }
        else {
            ?>
            忘記密碼/重設密碼
            <form action='/model/user.php?action=forget' method='post'>
                <label>
                    Email:
                    <input type="email" name="email">
                </label>
                <label>
                    修改的密碼:
                    <input type="password" name="ps">
                </label>
                <div>
                    <input type="submit" value="修改" />
                </div>
            </form>
            <?php
        }
        ?>
        </div>
</div>
<?php include './component/footer.php'; ?>