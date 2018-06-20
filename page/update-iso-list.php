<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql = mysqli_query($conn, "SELECT * FROM iso_list WHERE ID = '{$_GET['id']}'");
    $info = $sql->fetch_assoc();
    $quest = mysqli_query($conn, "SELECT * FROM iso_data_sheet WHERE order_id = '{$info['order_id']}' ORDER BY list_id");
    $last = mysqli_query($conn, "SELECT max(order_count) as count FROM iso_list_history WHERE follow_id='{$_GET['id']}'")->fetch_assoc();
    $now_version = isset($_GET['version'])?$_GET['version']:$last['count'];
    $ls = mysqli_query($conn, "SELECT * FROM iso_list_history WHERE follow_id='{$_GET['id']}' and order_count='{$now_version}'")->fetch_assoc();
    $value_data = mysqli_query($conn, "SELECT * FROM iso_select_list WHERE order_list = '{$_GET['id']}' and history_id='{$now_version}' ORDER BY list_id");
    $select_data = [];
    $images = [];
    while ($sel_d = $value_data->fetch_assoc()) {
        $select_data[$sel_d['list_id']] = $sel_d['value'];
        $images[$sel_d['list_id']] = explode(',',  $sel_d['image'], -1);
    }
?>
<div class="container">
    <a class="no-print" href="?page=iso_list">上一頁</a>
    <div>
        <div class="no-print">
        <?php
            // if ($_GET['page'] == 'view_iso') {

            // }
            if ($now_version > 0) {
                ?>
                <a href="?page=<?="{$_GET['page']}&id={$_GET['id']}&version=".($now_version-1)?>">第 <?=($now_version)?> 版</a>
                <?php
            }
            if ($now_version < $last['count'] - 1) {
                ?>
                <a href="?page=<?="{$_GET['page']}&id={$_GET['id']}&version=".($now_version+1)?>">下一版</a>
                <?php
            } else if ($now_version == $last['count'] - 1) {
                ?>
                <a href="?page=<?="{$_GET['page']}&id={$_GET['id']}&version=".($now_version+1)?>">最終版</a>
                <?php
            }
        ?>
        </div>
        <?php
            if ($info['status'] == 3) {
                ?>
                <div style="margin: 15px 0;" class="alert alert-danger" role="alert">
                未合格原因 : <?=$ls['other']?>
                </div>
                <?php
            }
        ?>
        <table class="New">
            <tbody>
                <tr>
                    <td>
                        檢查表單號碼<br>
                        <?=$info['order_id'] ?>
                    </td>
                    <td>
                        工程名稱<br>
                        <?=$info['project_name']?>
                    </td>
                </tr>
                <tr>
                    <td>
                        承包商<br>
                        <?=$info['contractor']?>
                    </td>
                    <td>
                        施工樓層/分區：<br>
                        <?=$info['floor']?>
                    </td>
                </tr>
                <?php
                    if ($info['status'] != 3) {
                        ?>
                        <tr>
                            <td>
                                綜合評語：<br>
                                <?=$ls['comment']?>
                            </td>
                            <td>
                                備註：<br>
                                <?=$ls['other']?>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
        <form method="post" action="/model/iso_form.php?action=update&id=<?=$_GET['id']?>&order_id=<?=$info['order_id']?>" enctype="multipart/form-data">
            <table class="New">
                <?php
                    while($data = $quest->fetch_assoc()) {
                        $value = $select_data[$data['list_id']];
                        if (!is_numeric($value)) $value = "-1";
                        ?>
                        <tr>
                            <td><?=$data['list_id']?></td>
                            <td style="word-wrap:break-word;"><?=$data['check_item']?></td>
                            <td>
                                <label><input type="radio" value="2" name="state[<?=$data['list_id']?>]" <?=($_GET['page']=='check_iso'||$_GET['page']=='view_iso')?"disabled":""?> <?=($value=="2"&&$info['status'] !== 3)?"checked":""?>>通過</label>
                                <label><input type="radio" value="1" name="state[<?=$data['list_id']?>]" <?=($_GET['page']=='check_iso'||$_GET['page']=='view_iso')?"disabled":""?> <?=(($value=="1"||$value=="-1")&&$info['status'] !== 3)?"checked":""?>>未通過</label>
                                <label><input type="radio" value="0" name="state[<?=$data['list_id']?>]" <?=($_GET['page']=='check_iso'||$_GET['page']=='view_iso')?"disabled":""?> <?=($value=="0" || $info['status'] == 3)?"checked":""?>>無此項目</label>
                            </td>
                            <td class="no-print">
                            <?php
                                if ($info['status'] == 0 || $info['status'] == 3 || $_GET['page'] == 'view_iso') {
                                        ?>
                                        <?php
                                            if ($_GET['page'] == 'update_iso_list') {
                                                ?>
                                                <label class="btn btn-default">
                                                    上傳圖片
                                                    <input class="file_selecter" type="file" multiple name="image[<?=$data['list_id']?>][]" style="display: none;">
                                                </label>
                                                <div class="viewer"></div>
                                                <?php
                                            }
                                        ?>
                                        <?php
                                        
                                    }
                                    if (count($images[$data['list_id']])) {
                                        foreach ($images[$data['list_id']] as $key => $val) {
                                            ?>
                                            <div style="min-width: 70px;"><a style="font-size: 14px;" href="upload_space/<?=$val?>" target="_new">查看圖片</a></div>
                                            <?php
                                        }
                                    }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
            </table>
            <script>
                let getData = (file) => new Promise((resolve, reject) => {
                    let reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = () => resolve(reader);
                })
                $(document).ready(() => {
                    $('.file_selecter').change(async function(e) {
                        $(this).parents('td').find('.viewer').html('')
                        // console.log($(this).parents('td').find('.viewer'))
                        for (let i in this.files) {
                            if (this.files.hasOwnProperty(i)) {
                                let rend = await getData(this.files[i]);
                                $(this).parents('td').find('.viewer').append(`<div style="min-width: 70px;"><a href="${rend.result}" target="_new"><img style="max-width:200px;" src="${rend.result}" /></a></div>`)
                            }
                        }
                        if (this.files && this.files.length > 0) {
                            $(this).parent().addClass('selected')
                        } else {
                            $(this).parent().removeClass('selected')
                        }
                    })
                })
            </script>
            <style>
                .selected {
                    background: #42e5f4;
                }
            </style>
            <?php
                if ($last['count'] > 0) {
                    $user = mysqli_query($conn, "SELECT * FROM user WHERE ID = '{$ls['user']}'")->fetch_assoc();
                    $checker = mysqli_query($conn, "SELECT * FROM user WHERE ID = '{$ls['checker']}'")->fetch_assoc();
                    ?>
                    <div>
                        更新人員: <?=$user['name']?>
                        審核人員: <?=$checker['name']?>
                    </div>
                    <?
                }
            ?>
            <?php
                if ($_GET['page']=='update_iso_list') {
                    ?>
                    <label style="width: 100%;">
                        未通過說明
                        <textarea style="width: 100%; height: 50px;" name="other"><?=$ls['other']?></textarea>
                    </label>
                    <input type="submit" value="送出" >
                    <?php
                }
                if (($_COOKIE['role'] == 1||$_COOKIE['role']==4) && $info['status'] == 1) {
                    ?>
                    <div style="margin: 15px 0;" class="alert alert-secondary" id="check_iso" role="alert">
                        審核狀態
                        <a data-data="2" data-id="<?=$_GET['id']?>" href="#" class="btn btn-primary">通過</a>
                        <a data-data="3" data-id="<?=$_GET['id']?>" href="#" class="btn btn-danger">未合格</a>
                        <a href="?page=iso_list" style="float: right; padding: 5px;">回上一頁</a>
                    </div>
                    <script>
                        $(document).on('click','#check_iso > a', function(e) {
                            e.preventDefault();
                            let id = $(this).attr('data-id')
                            let data = $(this).attr('data-data')
                            console.log(data, id)
                            $('#comment_form').show().attr('action', `/model/iso_form.php?action=check_iso&data=${data}&id=${id}`)
                            if (data == 3)
                                $('#common_comment').hide()
                            else 
                                $('#common_comment').show()
                        })
                    </script>
                    <?php
                }
                if ($_GET['page']=='view_iso') {
                    $creater = mysqli_query($conn, "SELECT * FROM user WHERE ID='{$info['user']}'")->fetch_assoc();
                    $checker = mysqli_query($conn, "SELECT * FROM user WHERE ID='{$ls['checker']}'")->fetch_assoc();
                    ?>
                    <div class="row">
                        <div class="col col-xs-6">建單人員:<span style="text-decoration:underline;"><?=$creater['name']?></span></div>
                        <div class="col col-xs-6">審核人員:<span style="text-decoration:underline;"><?=$checker['name']?></span></div>
                    </div>
                    <?php
                }
            ?>
        </form>
        <form method="post" id="comment_form" style="display: none;">
            <div id="common_comment" >
                綜合評語：<br>
                <textarea name="comment"></textarea>
            </div>
            <div>
                其他備註／若為未合格請輸入原因：<br>
                <textarea name="other"></textarea>
            </div>
            <input value="送出" type="submit" >
        </form>
        <style>
            label {
                font-weight: 100;
                font-size: 16px;
            }
        </style>
    </div>
</div>
<?php include './component/footer.php'; ?>