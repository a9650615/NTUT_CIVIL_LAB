<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $data = array();
    if ($_GET['id']) {
        $sql = mysqli_query($conn, "SELECT * FROM quality_list WHERE ID={$_GET['id']}");
        $data = $sql->fetch_assoc();
    }
?>
<div class="container">    
    <div class="row">
        <!--md=電腦 mm=手機 共12格 -->
      <div class="col-xs-12 col-sm-12 col-md-12">
        <form action="/model/quality_list.php?action=create" method="post" enctype="multipart/form-data">
            <div class="product_index">
                <table class="New">
                    <tbody>
                        <tr>
                            <td>工程編號：<br/>
                            <input autocomplete="off" name="no" required type="text" value="<?=$data['No']?>" />
                            </td>
                            <td>
                                工程名稱：<!--秀出資料庫內容 -->
                                <input autocomplete="off" name="name" required type="text" value="<?=$data['name']?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>本單編號：<!--想自動輸出-->
                            <br/><input autocomplete="off" name="order" required type="text" /><!-- 顯示mysql row+1 --></td>
                            <td>改善確認：<br/>
                            <select name="status">
                                <option value="0">未改善</option>
                                <option value="1">已改善</option>
                                <option value="2">未合格</option>
                            </select></td>
                        </tr>
                        <tr>
                            <td>查驗日期：<br><input value="<?=$data['check_date']?>" type="date" required name="check_date"></td>
                            <td>改善期限：<br><input value="<?=$data['resolve_date']?>" type="date" required name="resolve_date">前</td>
                        </tr>
                        <tr>
                            <td>查驗位置：<br><input type="text" value="<?=$data['floor']?>" required autocomplete="off" name="floor" />樓
                            <br><input value="<?=$data['other']?>" type="text" autocomplete="off" name="other" />(其他備註)</td>
                            <td>
                                缺失修正方式：<br>
                                <select name="how">
                                    <option value="Taipei">紀錄照片</option>
                                    <option value="Taoyuan">11</option>
                                    <option value="Hsinchu">11</option>
                                    <option value="Miaoli">11</option>
                                </select>
                            </td>
                        <tr>
                            <td>現況說明：<br><textarea rows="3" required name="now_status" cols="25"><?=$data['now_status']?></textarea></td>
                            <td>改善建議：<br><textarea rows="3" name="feedback" cols="25"><?=$data['feedback']?></textarea></td>
                        </tr>
                        <tr>
                            <td>施工現況<!--插入圖片-->
                                <?php
                                    if ($data['now_image']) {
                                        ?>
                                        <img id="output" required width="100%" src="upload_space/<?=$data['now_image']?>" />
                                        <?php
                                    } else {
                                        ?>
                                        <img id="output" required width="100%" style="display:none" />
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
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <div style="font-size:25px;" class="col-sm-4 col-md-12 col-mm-12"> 
                <button type="submit" class="button button-block" name="save" />確定送出</button>
                <a href="?page="><span style="float: right;" >回上一頁</span>
            </div>
        </form>
      </div>
    </div>
</div>
<?php include './component/footer.php'; ?>