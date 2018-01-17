<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql = mysqli_query($conn, "SELECT * FROM iso_list WHERE ID = '{$_GET['id']}'");
    $info = $sql->fetch_assoc();
    $quest = mysqli_query($conn, "SELECT * FROM iso_data_sheet WHERE order_id = '{$info['order_id']}' ORDER BY list_id");
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
            </tbody>
        </table>
        <form action="/model/iso_form.php?action=update&id=<?=$_GET['id']?>">
            <table class="New">
                <?php
                    $counter = 0;
                    while($data = $quest->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?=$data['list_id']?></td>
                            <td><?=$data['check_item']?></td>
                            <td>
                                <label><input type="radio" name="state[<?=$counter?>]">通過</label>
                                <label><input type="radio" name="state[<?=$counter?>]">未通過</label>
                                <label><input type="radio" name="state[<?=$counter?>]" checked>未確認</label>
                            </td>
                        </tr>
                        <?php
                        $counter ++;
                    }
                ?>
            </table>
            <input type="submit" value="更新" >
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