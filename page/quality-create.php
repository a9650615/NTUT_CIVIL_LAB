<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $data = array();
    if ($_GET['id']) {
        $sql = mysqli_query($conn, "SELECT * FROM quality_list WHERE ID={$_GET['id']}");
        $data = $sql->fetch_assoc();
    }
    $case_sql = mysqli_query($conn, "SELECT * FROM case_list");
?>
<br>
<a href="?page=quality"><span>上一頁</span></a>
<p align="center" style="font-size: 35px;">建立品質改善表單</p> 
<div class="container">    
    <div class="row">
        <!--md=電腦 mm=手機 共12格 -->
      <div class="col-xs-12 col-sm-12 col-md-12">
        <form id="quality_form" action="/model/quality_list.php?action=<?=($_GET['id'])?"edit":"create"?>&id=<?=$_GET['id']?>" method="post" enctype="multipart/form-data">
            <div align="center" class="product_index">
                <table  class="New">
                    <tbody >
                        <tr>
                            <td>
                                工程名稱：<!--秀出資料庫內容 -->
                                <!-- <input autocomplete="off" name="name" required type="text" value="<?=$data['name']?>" /> -->
                                <select id="order_name" name="name" required>
                                <option></option>
                                <?php
                                    while ($d = $case_sql -> fetch_assoc()) {
                                        ?>
                                        <option <?=($data['No']==$d['order_id']?"selected":"")?> data-id="<?=$d['order_id']?>"><?=$d['order_name']?></option>
                                        <?php
                                    }
                                ?>
                                </select>

                            <br>
                            工程編號：
                            <input style="border:none; background-color: transparent;" autocomplete="off" name="no" id="no" required value="<?=$data['No']?>" />

                                
                            </td>
                        </tr>
                        <tr>
                            <td>本單編號：<!--想自動輸出--><input style="border:none; background-color: transparent;" autocomplete="off" name="order" id="order_id" readonly required type="text" value="<?=$_GET['id']?$data['order_id']:uniqid(rand())?>" /><!-- 顯示mysql row+1 -->
                            <br/>
                            </td>
                        </tr>
                        <tr>
                            <td>查驗日期：<input style="border:none; background-color: transparent;" value="<?=$data['check_date'] ?? date("Y-m-d")?>" type="date" required readonly name="check_date">
                            <br>改善期限：<input value="<?=$data['resolve_date']?>" type="date" required name="resolve_date">前
                            <br/>
                            <br>
                            改善確認：
                            <select name="status">
                                <option value="0" <?=($data['status']=='0')?"selected":""?>>未改善</option>
                                <option value="1" <?=($data['status']=='1')?"selected":""?>>已改善</option>
                                <option value="2" <?=($data['status']=='2')?"selected":""?>>未合格</option>
                            </select>

                        </td>
                        </tr>
                        <tr>
                            <td><br>查驗位置：<br><input type="text" value="<?=$data['floor']?>" required autocomplete="off" name="floor" />樓
                            <br><input value="<?=$data['other']?>" required type="text" autocomplete="off" name="other" />(其他位置備註)
                            <br><br>
                                缺失修正方式：
                                <select name="fix_type">
                                    <option>紀錄照片</option>
                                </select>
                            </td>
                        <tr>
                            <td>現況說明：<br><textarea rows="3" required name="now_status" cols="25"><?=$data['now_status']?></textarea>
                                <br>
                                改善建議：<br><textarea rows="3"  name="feedback" cols="25"><?=$data['feedback']?></textarea></td>
                        </tr>
                        <tr>
                            <td>施工現況<!--插入圖片-->
                                <div style="position:relative;">
                                    <canvas id="drawing" style="position:absolute; left: 0; height: 0; width:100%; height:100%;"></canvas>
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
                                </div>
                                <input type="file" name="image" <?=($_GET['id']?"":"required")?> onchange="openFile(event)" accept="image/*"/>
                                <script type="text/javascript">
                                    let canvas = document.getElementById('drawing');
                                    let ctx = canvas.getContext('2d');
                                        function openFile(event){
                                            var input = event.target; //取得上傳檔案
                                            var reader = new FileReader(); //建立FileReader物件
                                            reader.readAsDataURL(input.files[0]); //以.readAsDataURL將上傳檔案轉換為base64字串
                                            reader.onload = function(){ //FileReader取得上傳檔案後執行以下內容
                                            var dataURL = reader.result; //設定變數dataURL為上傳圖檔的base64字串
                                            $('#output').attr('src', dataURL).show(); //將img的src設定為dataURL並顯示
                                            };
                                        }
                                    $('#output').load(() => {
                                        canvas.width = $('#output').width()
                                        canvas.height = document.getElementById('output').clientHeight;
                                    })
                                    // Set up mouse events for drawing
                                    let drawing = false;
                                    let mousePos = { x:0, y:0 };
                                    let lastPos = mousePos;
                                    canvas.addEventListener("mousedown", function (e) {
                                            drawing = true;
                                    lastPos = getMousePos(canvas, e);
                                    }, false);
                                    canvas.addEventListener("mouseup", function (e) {
                                    drawing = false;
                                    }, false);
                                    canvas.addEventListener("mousemove", function (e) {
                                    mousePos = getMousePos(canvas, e);
                                    renderCanvas();
                                    }, false);
                                    
                                    function renderCanvas() {
                                        if (drawing) {
                                            ctx.moveTo(lastPos.x, lastPos.y);
                                            ctx.lineTo(mousePos.x, mousePos.y);
                                            ctx.strokeStyle = '#ff0000';
                                            ctx.lineWidth = 5;
                                            ctx.stroke();
                                            lastPos = mousePos;
                                        }
                                    }
                                    // Get the position of the mouse relative to the canvas
                                    function getMousePos(canvasDom, mouseEvent) {
                                    var rect = canvasDom.getBoundingClientRect();
                                    return {
                                        x: mouseEvent.clientX - rect.left,
                                        y: mouseEvent.clientY - rect.top
                                    };
                                    }
                                        // Set up touch events for mobile, etc
                                    canvas.addEventListener("touchstart", function (e) {
                                            mousePos = getTouchPos(canvas, e);
                                    var touch = e.touches[0];
                                    var mouseEvent = new MouseEvent("mousedown", {
                                        clientX: touch.clientX,
                                        clientY: touch.clientY
                                    });
                                    canvas.dispatchEvent(mouseEvent);
                                    }, false);
                                    canvas.addEventListener("touchend", function (e) {
                                    var mouseEvent = new MouseEvent("mouseup", {});
                                    canvas.dispatchEvent(mouseEvent);
                                    }, false);
                                    canvas.addEventListener("touchmove", function (e) {
                                    var touch = e.touches[0];
                                    var mouseEvent = new MouseEvent("mousemove", {
                                        clientX: touch.clientX,
                                        clientY: touch.clientY
                                    });
                                    canvas.dispatchEvent(mouseEvent);
                                    }, false);

                                    // Get the position of a touch relative to the canvas
                                    function getTouchPos(canvasDom, touchEvent) {
                                    var rect = canvasDom.getBoundingClientRect();
                                    return {
                                        x: touchEvent.touches[0].clientX - rect.left,
                                        y: touchEvent.touches[0].clientY - rect.top
                                    };
                                    }
                                    let upload = () => {
                                        var formData = new FormData();
                                        canvas.toBlob((blob) => {
                                            formData.append('img', blob);
                                            formData.append('order_id', $('#order_id').val());
                                            $.ajax({
                                                url: "/model/canvasUpload.php?action=create_quality",
                                                type: "POST",
                                                data: formData,
                                                processData: false,
                                                contentType: false
                                            }).done(function(respond){
                                                // alert(respond);
                                                $('#sub').click()
                                            });
                                        })
                                    }
                                </script>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <div style="font-size:25px;" class="col-sm-4 col-md-12 col-mm-12"> 
                <br>
                <button type="button" onclick="upload()" class="button button-block" />送出</button>
                <input type="submit" id="sub" style="display: none;"/>
            </div>
        </form>
      </div>
    </div>
    <script>
        $('#order_name').change(function() {
            console.log($(this).find(':selected').attr('data-id'))
            $('#no').val($(this).find(':selected').attr('data-id'))
        })
    </script>
</div>
<?php include './component/footer.php'; ?>