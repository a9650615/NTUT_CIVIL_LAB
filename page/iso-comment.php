<?php include './component/header.php'; ?>
<div class="container">
    <a href="?page=check_iso&id=<?=$_GET['id']?>">上一頁</a>
    <form method="post" action="/model/iso_form.php?action=check_iso&data=<?=$_GET['data']?>&id=<?=$_GET['id']?>">
        <div style="<?=$_GET['data']==3?"display: none;":""?>">
            綜合評語：<br>
            <textarea name="comment"></textarea>
        </div>
        <div>
            其他備註／若為未合格請輸入原因：<br>
            <textarea name="other"></textarea>
        </div>
        <input value="送出" type="submit" >
    </form>
</div>
<?php include './component/footer.php'; ?>