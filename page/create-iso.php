<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $case_sql = mysqli_query($conn, "SELECT * FROM case_list ORDER BY ID desc");
    $user_order = mysqli_query($conn, "SELECT * FROM user WHERE ID='{$_COOKIE['userId']}'")->fetch_assoc();
    if ($_COOKIE['role'] == $admin) {
        //SELECT DISTINCT(case_list.contractor),B.* FROM case_list RIGHT JOIN case_list AS B ON B.contractor = case_list.contractor 
        // $case_contractor = mysqli_query($conn, "SELECT DISTINCT(contractor_list.name) FROM case_list INNER JOIN contractor_list ON case_list.ID = contractor_list.case_id");
        $case_contractor = mysqli_query($conn, "SELECT * FROM contractor_list");
    } else {
        $case_contractor = mysqli_query($conn, "SELECT DISTINCT(contractor_list.name), contractor_list.* FROM case_list INNER JOIN contractor_list ON case_list.ID = contractor_list.case_id WHERE order_id='{$user_order['order_id']}' ");
    }
    $quest = mysqli_query($conn, "SELECT * FROM iso_data_sheet WHERE order_id = '{$_GET['order_id']}' ORDER BY list_id");
?>
<br>
<a href="?page=select_iso_form">上一頁</a>

    <br><p align="center" style="font-size: 35px;">新增 <?=$_GET['name']?$_GET['name']:'ISO'?> 工務表單</p>
    <br>
<div class="container">
    <div class="row">
        <!--md=電腦 mm=手機 共12格 -->
      <div id="content-menu" class=" col-xs-12 col-mm-12 col-md-12">
    <br>
    <form method="post" action="/model/iso_form.php?action=create">
        <table class="table" >
            <tbody>
                <tr>
                    <td>
                        檢查表單類型 :
                        <input type="text" name="order_id" value="<?=$_GET['order_id']?>" readonly autocomplete="off" style="border: #ffffff 1px solid;" >
                    </td>
                    <td>
                        工程名稱 :
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
                                    <option data-case-id="<?=$data['ID']?>" value="<?=$data['order_id']?>"><?=$data['order_name']?></option>
                                    <?php
                                }
                            else {
                                ?>
                                <option data-case-id="<?=$data['ID']?>" value="<?=$one_case['order_id']?>"><?=$one_case['order_name']?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <select id="pre_select_company" style="display: none;">
                        <?php 
                            while($data = $case_contractor->fetch_assoc()) {
                                ?>
                                <option data-case-id="<?=$data['case_id']?>" <?=($data['name']==$d['missing_company']?"selected":"")?>><?=$data['name']?></option>
                                <?php
                            }
                        ?>
                        </select>
                        承包商 :
                        <select name="contractor" require>
                        </select>
                        <script>
                        function showNowOption() {
                            $('select[name=contractor]').html('')
                            let case_id = <?=($_COOKIE['role'] != $admin)?$one_case['ID']:'null'?> || $('select[name=project_name] > option:selected').attr('data-case-id');
                            $('#pre_select_company > option').each((index, element) => {
                                console.log(case_id, $(element).attr('data-case-id'))
                                if ($(element).attr('data-case-id') == case_id) {
                                    $(element).clone().appendTo('select[name=contractor]')
                                }
                            })
                        }
                        showNowOption()
                        $('select[name=project_name]').bind('change', function() {
                            showNowOption()
                        })
                        </script>
                        <!-- <input type="text" name="contractor" autocomplete="off" /> -->
                    </td>
                    <td>
                        施工樓層/分區：
                        <input type="text" style="width: 190px;" name="floor" autocomplete="off" />
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table" class=" col-xs-12 col-mm-12 col-md-12">
            <?php
                while($data = $quest->fetch_assoc()) {
                    $value = $select_data[$data['list_id']];
                    if (!is_numeric($value)) $value = "-1";
                    ?>
                    <tr>
                        <td  ><?=$data['list_id']?></td>
                        <td class="col-mm-7" style="word-wrap:break-word;"><?=$data['check_item']?></td>
                        <td  >
                            <input type="radio" value="2" name="state[<?=$data['list_id']?>]" <?=($_GET['page']=='check_iso'||$_GET['page']=='view_iso')?"disabled":""?> <?=($value=="2"&&$info['status'] !== 3)?"checked":""?>>通過<br>
                            <input type="radio" value="1" name="state[<?=$data['list_id']?>]" <?=($_GET['page']=='check_iso'||$_GET['page']=='view_iso')?"disabled":""?> <?=(($value=="1"||$value=="-1")&&$info['status'] !== 3)?"checked":""?>>未通過<br>
                            <input type="radio" value="0" name="state[<?=$data['list_id']?>]" <?=($_GET['page']=='check_iso'||$_GET['page']=='view_iso')?"disabled":""?> <?=($value=="0" || $info['status'] == 3)?"checked":""?>>無此項目
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </table>
        </div>
        <input type="submit" value="送出" />
    </form>
</div>
</div>
</div>

<?php include './component/footer.php'; ?>