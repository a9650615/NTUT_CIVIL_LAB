<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $case_sql = mysqli_query($conn, "SELECT * FROM case_list ORDER BY ID desc");
    $user_order = mysqli_query($conn, "SELECT * FROM user WHERE ID='{$_COOKIE['userId']}'")->fetch_assoc();
?>
<div class="container">
    <br><p align="center" style="font-size: 35px;">新增ISO工務表單</p>
    <br><br><form method="post" action="/model/iso_form.php?action=create">
        <table class="New">
            <tbody>
                <tr>
                    <td>
                        檢查表單類型<br>
                        <input type="text" name="order_id" value="<?=$_GET['order_id']?>" readonly autocomplete="off" style="border: #ffffff 1px solid;" />
                    </td>
                    <td>
                        工程名稱<br>
                        <!-- <input type="text" name="project_name" autocomplete="off" /> -->
                        <?php
                            $one_case = mysqli_query($conn, "SELECT * FROM case_list WHERE order_id = '{$user_order['order_id']}' ")->fetch_assoc();
                            if ($_COOKIE['role'] != $admin)
                                echo $one_case['order_name'];
                        ?>
                        <select name="project_name" required style="<?=($_COOKIE['role'] == $admin)?"":"display: none;"?>">
                            <?php
                            if ($_COOKIE['role'] == $admin)
                                while($data = $case_sql -> fetch_assoc()) {
                                    ?>
                                    <option value="<?=$data['order_name']?>"><?=$data['order_name']?></option>
                                    <?php
                                }
                            else {
                                ?>
                                <option value="<?=$one_case['order_name']?>"><?=$one_case['order_name']?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        承包商<br>
                        <input type="text" name="contractor" autocomplete="off" />
                    </td>
                    <td>
                        施工樓層/分區：<br>
                        <input type="text" name="floor" autocomplete="off" />
                    </td>
                </tr>
            </tbody>
        </table>
        <input type="submit" value="新增" />
        <a href="?page=select_iso_form">上一頁</a>
    </form>
</div>
<?php include './component/footer.php'; ?>