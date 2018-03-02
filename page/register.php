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
        <p class="font2">註冊頁面</p>
        <form action='/model/user.php?action=register' method='post'>
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
                <input type="submit" value="送出" />
            </div>
        </form>
    <div style="text-align: center;">
        <br><a class="gradient-button gradient-button-4 font " href="?page=login">回到登入頁面</a>
    </div>
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

    .gradient-button-4 {background-image: linear-gradient(to right, #00d2ff 0%, #3a7bd5 51%, #00d2ff 100%)}
    .gradient-button-4:hover { background-position: right center; }

    .font { font-size: 35px; color: #FFF}
    .font2 { font-size: 35px; color: #000}

<?php include './component/footer.php'; ?>