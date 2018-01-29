<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $case_sql = mysqli_query($conn, "SELECT * FROM case_list ORDER BY ID desc");
?>
<div class="container">
    <h1>新增檢查表</h1>
    <form method="post" action="/model/iso_form.php?action=create">
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
                        <select name="project_name" required>
                            <?php
                            while($data = $case_sql -> fetch_assoc()) {
                                ?>
                                <option value="<?=$data['order_id']?>"><?=$data['order_name']?></option>
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