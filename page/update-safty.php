<?php include './component/header.php'; ?>
<div class="container">    
    <div class="row">
        <!--md=電腦 mm=手機 共12格 -->
      <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="product_index">
<?php
    include './model/sql.php';
    if ($_GET['id']) {
        $sql = mysqli_query($conn, "SELECT * FROM safty_list WHERE ID={$_GET['id']}");
        $data = $sql->fetch_assoc();
    }
    if ($data) {
        ?>

<a href="?page=<?=($data['fine']!=='1'?'safty_overview':'safty')?>"><span >上一頁</span></a>
<p align="center" style="font-size: 35px;">回覆安全衛生表單</p> 
<br>           
        <form action="/model/safty.php?action=update&id=<?=$_GET['id']?>" method="post" enctype="multipart/form-data">
                <table class="table" width="width:100%;">
                    <tr>
                        <td>
                            工程名稱: <?=$data['missing_place']?><br>
                            缺失廠商: <?=$data['missing_company']?><br>
                            查驗位置: <?=$data['check_place']?><br>
                            罰款項目:                         
                            <?php 
                                require_once './model/fine_list.php';
                                $fine = array();
                                foreach ($FINE_LIST as $key => $val) {
                                    if ($data['fine'] == $key) {
                                        $fine = $val;
                                        echo $val['text'];
                                        break; }} ?>  <br>
                            現況說明：<?=$data['other']?>                           
                        </td>
                    </tr>
                    <tr>
                        <td>
                            現況照片:
                            <div style="position:relative;">
                                <img onerror="this.style='display:none'"  src="upload_space/safty_<?=$_GET['id']?>_create.png?a=<?=rand()?>" style=" position:absolute;width:50%; height:50%;" />
                                <?php
                                    if ($data['image']) {
                                        ?>
                                        <img src="upload_space/<?=$data['image']?>" style="max-width:50%;" />
                                        <?php
                                    }
                                    else {
                                        ?>
                                        <img style="max-width:50%;" />
                                        <?php
                                    }
                                ?>
                            </div>
                        </td>
                    </tr>

                    <tr>

                        <td>
                            更新照片：
                            <div style="position:relative;">
                                <canvas id="drawing" style="position:absolute; left: 0; height: 0; z-index:5;"></canvas>
                                <img onerror="this.style='display:none'" id="update_img" src="upload_space/safty_<?=$_GET['id']?>_update.png?a=<?=rand()?>" style="max-width:60%; position:absolute;width:60%; height:60%;" />
                                <?php
                                    if ($data['resolve_image']) {
                                        ?>
                                        <img id="output" src="upload_space/<?=$data['resolve_image']?>" style="max-width:60%;" />
                                        <?php
                                    }
                                    else {
                                        ?>
                                        <img id="output" style="max-width:60%;" />
                                        <?php
                                    }
                                ?>
                            </div>
                            <input type="file" name="image" onchange="openFile(event)" required/>
                        </td>
                    </tr>
                </table>
                <?php
    }
    ?>
        </div>
        <br>
        <div style="font-size:25px;" class="col-sm-12 col-md-12 col-mm-12">
            <input type="submit" id="sub" style="display: none;"/>
            <?php
                if ($data && ($_COOKIE['role'] == 1 || $_COOKIE['role'] == 3 || $_COOKIE['role'] == $admin)) {
                    ?>
                    <input value="送出" type="button" onclick="upload()"/>
                    <input value="送出" id="sub" type="submit" style="display:none;" />
                    <?php
                } else if (!$data) {
                    ?>
                    找不到表單
                    <?php
                }
                ?>

        </form>
        
        <script>
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
                    canvas.style.width = $('#output').width()+'px'
                    canvas.style.height = document.getElementById('output').clientHeight+'px';
                    canvas.height = document.getElementById('output').clientHeight;
                })
                $(document).ready(() => {
                    canvas.width = $('#output').width()
                    canvas.height = document.getElementById('output').clientHeight;
                    canvas.style.width = $('#output').width()+'px'
                    canvas.style.height = document.getElementById('output').clientHeight+'px';
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
                        formData.append('order_id', '<?=$_GET['id']?>');
                        $.ajax({
                            url: "/model/canvasUpload.php?action=update_safty",
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
        </div>
      </div>
    </div>
</div>
<?php include './component/footer.php'; ?>