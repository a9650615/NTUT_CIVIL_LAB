<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql = mysqli_query($conn, "SELECT * FROM iso_list WHERE ID = '{$_GET['id']}'");
    $info = $sql->fetch_assoc();
    $quest = mysqli_query($conn, "SELECT * FROM iso_data_sheet WHERE order_id = '{$info['order_id']}' ORDER BY list_id");
    $last = mysqli_query($conn, "SELECT max(order_count) as count FROM iso_list_history WHERE follow_id='{$_GET['id']}'")->fetch_assoc();
    $ls = mysqli_query($conn, "SELECT * FROM iso_list_history WHERE follow_id='{$_GET['id']}' ORDER BY order_count DESC")->fetch_assoc();
    $value_data = mysqli_query($conn, "SELECT * FROM iso_select_list WHERE order_list = '{$_GET['id']}' and history_id='{$last['count']}' ORDER BY list_id");
    $select_data = [];
    while ($sel_d = $value_data->fetch_assoc()) {
        $select_data[$sel_d['list_id']] = $sel_d['value'];
    }
?>
<div class="container">
    <a href="?page=iso_list">上一頁</a>
    <div>
        <table class="New">
            <tbody>
                <tr>
                    <td>
                        檢查表單類型<br>
                        <?=$info['order_id']?>
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
            </tbody>
        </table>
        <form method="post" action="/model/iso_form.php?action=update&id=<?=$_GET['id']?>&order_id=<?=$info['order_id']?>">
            <table class="New">
                <?php
                    while($data = $quest->fetch_assoc()) {
                        $value = $select_data[$data['list_id']];
                        if (!is_numeric($value)) $value = "-1";
                        ?>
                        <tr>
                            <td><?=$data['list_id']?></td>
                            <td><?=$data['check_item']?></td>
                            <td>
                                <label><input type="radio" value="2" name="state[<?=$data['list_id']?>]" <?=($_GET['page']=='check_iso'||$_GET['page']=='view_iso')?"disabled":""?> <?=($value=="2")?"checked":""?>>通過</label>
                                <label><input type="radio" value="1" name="state[<?=$data['list_id']?>]" <?=($_GET['page']=='check_iso'||$_GET['page']=='view_iso')?"disabled":""?> <?=($value=="1"||$value=="-1")?"checked":""?>>未通過</label>
                                <label><input type="radio" value="0" name="state[<?=$data['list_id']?>]" <?=($_GET['page']=='check_iso'||$_GET['page']=='view_iso')?"disabled":""?> <?=($value=="0")?"checked":""?>>未確認</label>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
            </table>
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
                    <input type="submit" value="更新" >
                    <?php
                }
                if (($_COOKIE['role'] == 1||$_COOKIE['role']==4) && $info['status'] == 1) {
                    ?>
                    <div style="margin: 15px 0;" class="alert alert-secondary" role="alert">
                        審核狀態
                        <a href="?page=iso_comment&data=2&id=<?=$_GET['id']?>" class="btn btn-primary">已改善</a>
                        <a href="?page=iso_comment&data=3&id=<?=$_GET['id']?>" class="btn btn-danger">仍未改善</a>
                        <a href="?page=iso_list" style="float: right; padding: 5px;">回上一頁</a>
                    </div>
                    <?php
                }
                if ($_GET['page']=='view_iso') {
                    $creater = mysqli_query($conn, "SELECT * FROM user WHERE ID='{$info['user']}'")->fetch_assoc();
                    $checker = mysqli_query($conn, "SELECT * FROM user WHERE ID='{$ls['checker']}'")->fetch_assoc();
                    ?>
                    <div class="row">
                        <div class="col col-xs-6">建單人:<span style="text-decoration:underline;"><?=$creater['name']?></span></div>
                        <div class="col col-xs-6">審核人:<span style="text-decoration:underline;"><?=$checker['name']?></span></div>
                    </div>
                    <?php
                }
            ?>
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