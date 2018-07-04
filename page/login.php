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
    <div  class="box-center">
    <?php
        if (empty($_GET['forget'])) {
            ?>
                <p style="font-size: 35px;" class="font2">登入頁面</p> 

                <form style="font-size: 20px;"  action='/model/user.php?action=login' method='post'>
                    <label>
                        <br>員工編號：
                        <input type="text" name="acc">
                    </label>
                    <label>
                        密碼：
                        <input type="password" name="ps">
                    </label>

                    <div>
                    	<br>
                    	<input type="submit" style="font-size: 25px;" value="登入" />
                        <a style="float:right" href="?page=login&forget=1">忘記密碼</a>
                        <br>
                     <a style="float:right" href="?page=register">進入註冊頁面</a>
                    </div>
                </form>
                <?php
        }
        else {
            ?>
            <p style="font-size: 35px;"  class="font2">忘記/重設密碼</p>
            <form style="font-size: 20px;" action='/model/user.php?action=forget' method='post'>
                <label>
                    <br>Email:
                    <input type="email" name="email">
                </label>
                <label>
                    修改的密碼:
                    <input type="password" name="ps">
                </label>
                <div>
                    <input type="submit" style="font-size: 25px;" value="修改" />
                    <a style="float:right" href="?page=login">回到登入頁面</a>
                </div>
            </form>
            <?php
        }
        ?>
        </div>

</div>


<?php include './component/footer.php'; ?>