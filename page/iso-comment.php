<?php include './component/header.php'; ?>
<div class="container">
    <a href="?page=check_iso&id=<?=$_GET['id']?>">上一頁</a>
    <form method="post" action="/model/iso_form.php?action=check_iso&data=<?=$_GET['data']?>&id=<?=$_GET['id']?>">
        <div>
            填寫綜合評語：<br>
            <textarea name="comment"></textarea>
        </div>
        <div>
            其他：<br>
            <textarea name="other"></textarea>
        </div>
        <input value="送出" type="submit" >
    </form>
</div>
<?php include './component/footer.php'; ?>