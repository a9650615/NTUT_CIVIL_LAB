<?php require_once './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql_case_name = mysqli_query($conn, "SELECT `order_name` FROM case_list");
    $sql_case_contractor = mysqli_query($conn, "SELECT `contractor` FROM case_list");
    $data_sql = mysqli_query($conn, "SELECT * FROM safty_list WHERE ID='{$_GET['id']}'");
    $next_id = mysqli_query($conn, "SELECT max(ID) FROM safty_list")->fetch_assoc();
    $d = $data_sql->fetch_assoc();
    $id = $next_id['max(ID)'];
?>
<div class="container">
    <form action="/model/safty.php?action=<?=($_GET['id']?"update_data&id={$_GET['id']}":"create")?>" method="post" enctype="multipart/form-data">
        <table class="table">
            <tr>
                <td>
                    <select name="missing_place" required>
                        <option value="">缺失項目</option>
                        <?php 
                            while ($data = $sql_case_name->fetch_assoc()) {
                                ?>
                                <option <?=($data['order_name']==$d['missing_place']?"selected":"")?>><?=$data['order_name']?></option>
                                <?php
                            }
                        ?>
                    </select><br>
                    <select name="missing_company" required>
                        <option value="">缺失廠商</option>
                        <?php 
                            while ($data = $sql_case_contractor->fetch_assoc()) {
                                ?>
                                <option <?=($data['contractor']==$d['missing_company']?"selected":"")?>><?=$data['contractor']?></option>
                                <?php
                            }
                        ?>
                    </select>
                </td>
                <td>
                    <?php 
                        if (!$_GET['id']) {
                            ?>
                            <div style="position:relative;">
                                <canvas id="drawing" style="position:absolute; left: 0; height: 0; width:100%; height:100%;z-index:5;"></canvas>
                                <img onerror="this.style='display:none'" id="update_img" src="upload_space/<?=$data['order_id']?>_update.png?a=<?=rand()?>" style="max-width:100%; position:absolute;width:100%; height:100%;" />
                                <?php
                                    if ($d['image']) {
                                        ?>
                                        <img id="output" src="upload_space/<?=$d['image']?>" style="max-width:100%;" />
                                        <?php
                                    }
                                    else {
                                        ?>
                                        <img id="output" style="max-width:100%;" />
                                        <?php
                                    }
                                ?>
                            </div>
                            選擇照片：<input type="file" name="missing_image" onchange="openFile(event)" <?=($_GET['id'?"":"required"])?>/>
                            <?php
                        } else {
                            ?>
                            <div style="position:relative;">
                                <canvas id="drawing" style="position:absolute; left: 0; height: 0; width:100%; height:100%;z-index:5;"></canvas>
                                <img onerror="this.style='display:none'" id="update_img" src="upload_space/safty_<?=$_GET['id']?>_create.png?a=<?=rand()?>" style="max-width:100%; position:absolute;width:100%; height:100%;" />
                                <?php
                                    if ($d['image']) {
                                        ?>
                                        <img id="output" src="upload_space/<?=$d['image']?>" style="max-width:100%;" />
                                        <?php
                                    }
                                    else {
                                        ?>
                                        <img id="output" style="max-width:100%;" />
                                        <?php
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    查驗位置
                    <br>
                    <input type="text" name="check_place" required value="<?=$d['check_place']?>"/>
                    <br>
                    罰款項目
                    <br>
                    <select name="fine" style="max-width:300px;" required>
                        <option value="">罰款項目</option>
                        <?php
                            require_once './model/fine_list.php';
                            foreach ($FINE_LIST as $key => $val) {
                                ?>
                                <option <?=($d['fine'] == $key?"selected":"")?> value="<?=$key?>"><?=$val?></option>
                                <?php
                            }
                        ?>
                    </select>
                </td>
                <td>
                    
                </td>
            </tr>
            <tr>
                <td>
                    現況說明：
                    <textarea rows="3" cols="20" name="other"><?=$d['other']?></textarea>
                </td>
                <td></td>
            </tr>
        </table>
        <input value="送出" type="button" onclick="upload()"/>
        <input value="送出" id="sub" type="submit" style="display:none;" />
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
                        formData.append('order_id', '<?=($_GET['id'])?$_GET['id']:($id+1)?>');
                        $.ajax({
                            url: "/model/canvasUpload.php?action=create_safty",
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
    </form>
</div>
<?php require_once './component/footer.php'; ?>