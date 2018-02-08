<?php require_once './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql_case_name = mysqli_query($conn, "SELECT `order_name` FROM case_list");
    $sql_case_contractor = mysqli_query($conn, "SELECT `contractor` FROM case_list");
    $data_sql = mysqli_query($conn, "SELECT * FROM safty_list WHERE ID='{$_GET['id']}'");
    $d = $data_sql->fetch_assoc();
?>
<div class="container">
    <form action="/model/safty.php?action=<?=($_GET['id']?"update_data&id={$_GET['id']}":"create")?>" method="post" enctype="multipart/form-data">
        <table class="table">
            <tr>
                <td>
                    <select name="missing_place" required>
                        <option value="">缺失項目</option>
                        <?php 
                            while ($data = $sql_case_name->fetch_assoc()) {
                                ?>
                                <option <?=($data['order_name']==$d['missing_place']?"selected":"")?>><?=$data['order_name']?></option>
                                <?php
                            }
                        ?>
                    </select><br>
                    <select name="missing_company" required>
                        <option value="">缺失廠商</option>
                        <?php 
                            while ($data = $sql_case_contractor->fetch_assoc()) {
                                ?>
                                <option <?=($data['contractor']==$d['missing_company']?"selected":"")?>><?=$data['contractor']?></option>
                                <?php
                            }
                        ?>
                    </select>
                </td>
                <td>
                    選擇照片：<input type="file" name="missing_image" <?=($_GET['id'?"":"required"])?>/>
                    <?php
                        if ($d['image']) {
                            ?>
                            <img src="/upload_space/<?=$d['image']?>" />
                            <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    查驗位置
                    <br>
                    <input type="text" name="check_place" required value="<?=$d['check_place']?>"/>
                    <br>
                    罰款項目
                    <br>
                    <select name="fine" style="max-width:300px;" required>
                        <option value="">罰款項目</option>
                        <?php
                            require_once './model/fine_list.php';
                            foreach ($FINE_LIST as $key => $val) {
                                ?>
                                <option <?=($d['fine'] == $key?"selected":"")?> value="<?=$key?>"><?=$val?></option>
                                <?php
                            }
                        ?>
                    </select>
                </td>
                <td>
                    
                </td>
            </tr>
            <tr>
                <td>
                    現況說明：
                    <textarea rows="3" cols="20" name="other"><?=$d['other']?></textarea>
                </td>
                <td></td>
            </tr>
        </table>
        <input value="送出" type="submit" />
    </form>
</div>
<?php require_once './component/footer.php'; ?>