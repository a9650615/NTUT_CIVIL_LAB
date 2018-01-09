<?php include './component/header.php'; ?>
<div>
    <div class="box-center">
        使用者註冊頁面
        <form action='/model/user.php' method='post'>
            <label>
                帳號:
                <input type="text" name="account">
            </label>
            <label>
                密碼：
                <input type="password">
            </label>
            <label>
                註冊類型：
                <select>
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