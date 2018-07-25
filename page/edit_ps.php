<?php include './component/header.php'; ?>
<?php
if ($_GET['error'] == '1') {
    echo '<div class="alert alert-danger" role="alert">更改失敗</div>';
}
?>
<div class="container">
  <a style="font-size: 25px;"  href="?">上一頁</a>
  <p  align="center" style="font-size: 35px">修改密碼</p>
  <br>


    <div >

        <form action="/model/user.php?action=edit_ps" method="post">
            <label>
                輸入舊密碼:
                <input type="password" name="old_ps">
            </label> 
            <br>
            <br>
            <label>
                輸入新密碼:
                <input type="password" name="new_ps">
            </label>
              <br>
            <br>
            <label>
                確認新密碼:
                <input type="password" name="check_ps">
            </label>
            <br>
            <br>
            <div>
                <input type="submit" value="送出"/>
            </div>
        </form>
    </div>
</div>
<?php include './component/footer.php'; ?>