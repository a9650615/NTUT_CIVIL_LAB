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
    <div class="box-center">
    <?php
        if (empty($_GET['forget'])) {
            ?>
                <p class="font2">登入頁面</p> 

                <form   action='/model/user.php?action=login' method='post'>
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
                    	<input type="submit" value="登入" />
                        <a style="float:right" href="?page=login&forget=1">忘記密碼</a>
                    </div>
                </form>
                <?php
        }
        else {
            ?>
            <p class="font2">忘記/重設密碼</p>
            <form action='/model/user.php?action=forget' method='post'>
                <label>
                    <br>Email:
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
	<div style="text-align: center;">
		<br>
	    <a class="gradient-button gradient-button-3 font " href="?page=register">進入註冊頁面</a>
	</div>
</div>

<style type="text/css">
	.gradient-button {
    margin: 10px;
    font-family: "Arial Black", Gadget, sans-serif;   
    padding: 15px;
    text-align: center;
    text-transform: uppercase;
    transition: 0.5s;
    background-size: 200% auto;
    box-shadow: 0 0 20px #eee;
    border-radius: 10px;
    width: 240px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    transition: all 0.3s cubic-bezier(.25,.8,.25,1);
    cursor: pointer;
    display: inline-block;
    border-radius: 25px;
	}

	.gradient-button:hover{
    box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
    margin: 8px 10px 12px;
	}

	.gradient-button-3 {background-image: linear-gradient(to right, #7474BF 0%, #348AC7 51%, #7474BF 100%)}
	.gradient-button-3:hover { background-position: right center; }

	.font {text-decoration:none; font-size: 35px; color: #FFF}
	.font2 { font-size: 35px; color: #000}

</style>
<?php include './component/footer.php'; ?>