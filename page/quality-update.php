<?php include './component/header.php'; ?>
<div class="container">    
    <div class="row">
        <!--md=電腦 mm=手機 共12格 -->
      <div class="col-xs-12 col-sm-12 col-md-12">
        <form action="/model/quality_list.php?action=update&id=<?=$_GET['id']?>" method="post" enctype="multipart/form-data">
            <div class="product_index">
<?php
    include './model/sql.php';
    if ($_GET['id']) {
        $sql = mysqli_query($conn, "SELECT * FROM quality_list WHERE ID={$_GET['id']}");
        $data = $sql->fetch_assoc();
    }
    if ($data) {
        ?>
        <table class="New">
            <tbody>
                <tr>
                    <td style="width: 50%;">工程編號：<?=$data['No']?><br/>
                    </td>
                    <td>
                        工程名稱：<?=$data['name']?><!--秀出資料庫內容 -->
                    </td>
                </tr>
                <tr>
                    <td>本單編號：<?=$data['order_id']?><!--想自動輸出-->
                    <br/><!-- 顯示mysql row+1 --></td>
                    <td>改善確認：
                    <?php
                        if ($data['status'] == 0) {
                            echo "未改善";
                        } else if ($data['status'] == 1) {
                            echo "已改善";
                        } else {
                            echo "未合格";
                        }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td>查驗日期：<?=$data['check_date']?></td>
                    <td>改善期限：<?=$data['resolve_date']?><br>前</td>
                </tr>
                <tr>
                    <td>查驗位置：<?=$data['floor']?>樓
                    <br>(其他備註)<?=$data['now_status']?></td>
                    <td>
                        缺失修正方式：
                    </td>
                <tr>
                    <td>現況說明：<?=$data['now_status']?></td>
                    <td>改善建議：<?=$data['feedback']?></td>
                </tr>
                <tr>
                    <td>施工現況<!--插入圖片-->
                        <img src="upload_space/<?=$data['now_image']?>" style="max-width:100%;" />
                    </td>
                    <td>
                    <?php
                        if ($_COOKIE['role'] == 2) {
                            ?>
                            修正狀況:
                            <?php
                                if ($data['resolve_image']) {
                                    ?>
                                    <img id="output" src="upload_space/<?=$data['resolve_image']?>" style="max-width:100%;" />
                                    <?php
                                }
                                else {
                                    ?>
                                    <img id="output" style="max-width:100%;" />
                                    <?php
                                }
                            ?>
                            <input type="file" name="image" onchange="openFile(event)" />
                            <script type="text/javascript">
                                    function openFile(event){
                                        var input = event.target; //取得上傳檔案
                                        var reader = new FileReader(); //建立FileReader物件
                                        reader.readAsDataURL(input.files[0]); //以.readAsDataURL將上傳檔案轉換為base64字串
                                        reader.onload = function(){ //FileReader取得上傳檔案後執行以下內容
                                        var dataURL = reader.result; //設定變數dataURL為上傳圖檔的base64字串
                                        $('#output').attr('src', dataURL).show(); //將img的src設定為dataURL並顯示
                                        };
                                    }
                            </script>
                            <?
                        }
                    ?>
                    
                    </td>
                </tr>
            </tbody>
        </table>
        <?php
    }
?>
            </div>
            <br>
            <div style="font-size:25px;" class="col-sm-12 col-md-12 col-mm-12">
                <?php
                    if ($data && $_COOKIE['role'] == 2) {
                        ?>
                        <button type="submit" class="button button-block" name="save" />確定更新</button>
                        <?php
                    } else if (!$data) {
                        ?>
                        找不到表單
                        <?php
                    }
                ?>
                <a href="?page=quality"><span style="float: right;" >回上一頁</span>
            </div>
        </form>
      </div>
    </div>
</div>
<?php include './component/footer.php'; ?>