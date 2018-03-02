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
                    <br>(其他位置備註)<?=$data['other']?></td>
                    <td>
                        缺失修正方式：<?=$data['fix_type']?>
                    </td>
                <tr>
                    <td>現況說明：<?=$data['now_status']?></td>
                    <td>改善建議：<?=$data['feedback']?></td>
                </tr>
                <tr>
                    <td>施工現況<!--插入圖片-->
                        <div style="position:relative;">
                            <img onerror="this.style='display:none'" src="upload_space/<?=$data['order_id']?>_create.png" style="max-width:100%; position:absolute;width:100%; height:100%;" />
                            <img onerror="this.style='display:none'" src="upload_space/<?=$data['now_image']?>" style="max-width:100%;" />
                        </div>
                    </td>
                    <td>
                    <?php
                        if ($_COOKIE['role'] == 1 || $_COOKIE['role'] == 3) {
                            ?>
                            修正狀況:
                            <div style="position:relative;">
                                <canvas id="drawing" style="position:absolute; left: 0; height: 0; width:100%; height:100%;z-index:5;"></canvas>
                                <img onerror="this.style='display:none'" id="update_img" src="upload_space/<?=$data['order_id']?>_update.png?a=<?=rand()?>" style="max-width:100%; position:absolute;width:100%; height:100%;" />
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
                            </div>
                            <input type="file" name="image" onchange="openFile(event)" accept="image/*" />
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
                                    $(document).ready(() => {
                                        canvas.width = $('#output').width()
                                        canvas.height = document.getElementById('output').clientHeight;
                                    })
                                    // Set up mouse events for drawing
                                    let drawing = false;
                                    let mousePos = { x:0, y:0 };
                                    let lastPos = mousePos;
                                    canvas.addEventListener("mousedown", function (e) {
                                            drawing = true;
                                            $('#update_img').hide()
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
                                            formData.append('order_id', '<?=$data['order_id']?>');
                                            $.ajax({
                                                url: "/model/canvasUpload.php?action=update_quality",
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
                            <?php
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
                <input type="submit" id="sub" style="display: none;"/>
                <?php
                    if ($data && ($_COOKIE['role'] == 1 || $_COOKIE['role'] == 3)) {
                        ?>
                        <button type="button" onclick="upload()" class="button button-block" name="save" />確定更新</button>
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