<?php include './component/header.php'; ?>
<div class="container">    
    <div class="row">
        <!--md=電腦 mm=手機 共12格 -->
      <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="product_index">
<?php
    include './model/sql.php';
    if ($_GET['id']) {
        $sql = mysqli_query($conn, "SELECT * FROM safty_list WHERE ID={$_GET['id']}");
        $data = $sql->fetch_assoc();
    }
    if ($data) {
        ?>
            <form action="/model/safty.php?action=update&id=<?=$_GET['id']?>" method="post" enctype="multipart/form-data">
                <table class="table" width="width:100%;">
                    <tr>
                        <td style="min-width:200px;">
                            缺失項目: <?=$data['missing_place']?><br>
                            缺失廠商: <?=$data['missing_company']?>
                        </td>
                        <td>
                            現況照片: <img style="max-width:100%;" src="upload_space/<?=$data['image']?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            查驗位置:<?=$data['check_place']?>
                            <br>
                            罰款項目: <?=$data['fine']?>
                        </td>
                        <td>
                            <?php
                                if ($data['resolve_image']) {
                                    ?>
                                    <img src="upload_space/<?=$data['resolve_image']?>" style="max-width:100%;" />
                                    <?php
                                }
                            ?>
                            更新照片：<input type="file" name="image" required/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            現況說明：<?=$data['other']?>
                        </td>
                        <td></td>
                    </tr>
                </table>
                <?php
    }
    ?>
        </div>
        <br>
        <div style="font-size:25px;" class="col-sm-12 col-md-12 col-mm-12">
            <input type="submit" id="sub" style="display: none;"/>
            <?php
                if ($data && ($_COOKIE['role'] == 1 || $_COOKIE['role'] == 3)) {
                    ?>
                    <input value="送出" type="submit" />
                    <?php
                } else if (!$data) {
                    ?>
                    找不到表單
                    <?php
                }
                ?>
            <a href="?page=safty"><span style="float: right;" >回上一頁</span>
        </form>
        </div>
      </div>
    </div>
</div>
<?php include './component/footer.php'; ?>