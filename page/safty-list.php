<?php require_once './component/header.php'; ?>
<?php
    include './model/sql.php';

?>
<div class="col-sm-12 col-md-12 col-mm-12" id="content-menu">
    <a href="?page=safty_form">新增安衛罰款</a>
    <div class="menu">
        <div>
        <h2 style="color: red">已建檔安衛罰款總覽</h2>
        </div>
        <table class="table" style="width: 100%;">
            <thead>
                <tr>
                    <td>查驗位置</td>
                    <td>缺失地點</td>
                    <td>缺失廠商</td>
                    <td>發款項目</td>
                    <td>編輯</td>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<?php require_once './component/footer.php'; ?>
