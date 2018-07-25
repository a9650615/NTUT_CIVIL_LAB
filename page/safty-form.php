<?php require_once './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql_case_name = mysqli_query($conn, "SELECT `order_name`,`order_id`,`ID` FROM case_list");
    // $sql_case_contractor = mysqli_query($conn, "SELECT `contractor` FROM case_list");
    $data_sql = mysqli_query($conn, "SELECT * FROM safty_list WHERE ID='{$_GET['id']}'");
    $next_id = mysqli_query($conn, "SELECT max(ID) FROM safty_list")->fetch_assoc();
    $d = $data_sql->fetch_assoc();
    $id = $next_id['max(ID)'];
    $user_order = mysqli_query($conn, "SELECT * FROM user WHERE ID='{$_COOKIE['userId']}'")->fetch_assoc();
    if ($_COOKIE['role'] == $admin ) {
        //SELECT DISTINCT(case_list.contractor),B.* FROM case_list RIGHT JOIN case_list AS B ON B.contractor = case_list.contractor 
        $case_contractor = mysqli_query($conn, "SELECT DISTINCT(contractor_list.name) FROM case_list INNER JOIN contractor_list ON case_list.ID = contractor_list.case_id ");
    } else {
        $case_contractor = mysqli_query($conn, "SELECT DISTINCT(contractor_list.name) FROM case_list INNER JOIN contractor_list ON case_list.ID = contractor_list.case_id WHERE order_id='{$user_order['order_id']}' ");
    }
?>
    <a  href="?page=safty">上一頁</a>
    <p align="center" style="font-size: 35px;">建立安全衛生表單</p>
<div class="container">
    <br>

    <form action="/model/safty.php?action=<?=($_GET['id']?"update_data&id={$_GET['id']}":"create")?>" method="post" enctype="multipart/form-data">
        <table class="table col-sm-12 col-md-12 col-mm-12">
            <tr>
                <td>
                    工程名稱：<select name="missing_place" required>
                        <option value="">尚未選擇</option>
                        <?php 
                            $caseId = 0;
                            while ($data = $sql_case_name->fetch_assoc()) {
                                if ($data['order_name']==$d['missing_place']) $caseId = $data['order_id'];
                                ?>
                                <option data-id="<?=$data['order_id']?>" <?=($data['order_name']==$d['missing_place']?"selected":"")?>><?=$data['order_name']?></option>
                                <?php
                            }
                        ?>
                    </select><br>
                    工程編號：<input name="case_id" style="border:none; background-color: transparent;" id="case_id" readonly value="<?=$caseId/*.'-'.*/?>" />
                    <br>
                    缺失廠商：<select name="missing_company" required>

                        <?php 
                            while($data = $case_contractor->fetch_assoc()) {
                                print_r($data)
                                ?>
                                <option <?=($data['name']==$d['missing_company']?"selected":"")?>><?=$data['name']?></option>
                                <?php
                            }
                        ?>
                    </select>

                    <script>
                        $('select[name=missing_place]').bind('change', function() {
                            if ($(this).find(':selected').attr('data-id'))
                                // <?=$_GET['id']?$_GET['id']:($id+1)?>-
                                $('#case_id').val(`${$(this).find(':selected').attr('data-id')}`)
                        })
                    </script><br>
                </td>
            </tr>
            <tr>
                <td>
                    查驗位置：
                    <input type="text" name="check_place" required value="<?=$d['check_place']?>"/>
                </td>
                <td>

                        查驗日期：
                        <input type="date"style="border:none; background-color: transparent;" value="<?=$d['check_date'] ?? date("Y-m-d")?>" required readonly name="check_date">

                    <br>

                        改善期限：
                        <input type="date" name="resolve_date" value="<?=$d['resolve_date']?>"/>

                    <br>
                    <?php
                        if ($_GET['id']) {
                            ?>
                            狀態：
                            <select name="status">
                                <option value="0" <?=($d['status']==0?"selected":"")?>>未改善</option>
                                <option value="1" <?=($d['status']==1?"selected":"")?>>已改善</option>
                                <option value="2" <?=($d['status']==2?"selected":"")?>>未合格</option>
                                <option value="3" <?=($d['status']==3?"selected":"")?>>審核中</option>
                            </select>
                            <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    現況說明：
                    <textarea style="vertical-align:text-top;" rows="2" cols="20" name="other"><?=$d['other']?></textarea>
                    <br>
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
                            工地現況：<input type="file" name="missing_image" onchange="openFile(event)" <?=($_GET['id'?"":"required"])?>/>
                            <?php
                        } else {
                            ?>
                            <div style="position:relative;">
                                <img onerror="this.style='display:none'" src="upload_space/safty_<?=$_GET['id']?>_create.png?a=<?=rand()?>" style="max-width:100%; position:absolute;width:100%; height:100%;" />
                                <img src="upload_space/<?=$d['image']?>" style="max-width:100%;" />
                            </div>
                            <input type="file" name="missing_image" onchange="openFile(event)" <?=($_GET['id'?"":"required"])?>/>
                            <div style="position:relative;">
                                <canvas id="drawing" style="position:absolute; left: 0; height: 0; width:100%; height:100%;z-index:5;"></canvas>
                                <img onerror="this.style='display:none'" id="update_img" src="upload_space/safty_<?=$_GET['id']?>_update.png?a=<?=rand()?>" style="max-width:100%; position:absolute;width:100%; height:100%;" />
                                <?php
                                    if ($d['resolve_image']) {
                                        ?>
                                        <img id="output" src="upload_space/<?=$d['resolve_image']?>" style="max-width:100%;" />
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
                <td>
                    罰款項目：
                    <br>
                    <select name="fine" style="max-width:300px;" required>
                        <?php
                            require_once './model/fine_list.php';
                            foreach ($FINE_LIST as $key => $val) {
                                ?>
                                <option <?=($d['fine'] == $key?"selected":"")?> value="<?=$key?>" data-price="<?=$val['price']?>"><?=$val['text']?></option>
                                <?php
                            }
                        ?>
                    </select>
                    <span id="other">
                    <br>
                        罰款金額 <input id="fine_price" style="border:none;border-bottom:1px solid;,background:transparent;width:auto;max-width:50px;" readonly > 元, <input id="people" name="fine_people" type="number" min="1" value="<?=$d['fine_people']||1?>" style="border:none;border-bottom:1px solid;,background:transparent;max-width:40px;" > 人, 共 <label id="total_fine_price"></label> 元  
                    <?php
                        if ($_GET['id'] != '') {
                            ?>
                        <div style="margin: 15px 0;" class="alert alert-secondary" role="alert">
                            <?php
                                if ($d['status']==1) {
                                    ?>
                                    是否付款
                                    <a href="/model/safty.php?action=check_has_pay&data=1&id=<?=$_GET['id']?>" class="btn btn-primary">已付款</a>
                                    <a href="/model/safty.php?action=check_has_pay&adata=0&id=<?=$_GET['id']?>" class="btn btn-danger">仍未付款</a>
                                    <?php
                                } else {
                                    ?>
                                    是否改善
                                    <a href="#" id="has_fix" class="btn btn-primary">已改善</a>
                                    <script>
                                        $('#has_fix').click(() => {
                                            $('select[name=status]').val(1)
                                            upload()
                                        })
                                    </script>
                                    <?php
                                }
                            ?>
                        </div>
                            <?php
                        }
                    ?>
                    </span>
                    <script>
                        let count = _ => {
                            $('#total_fine_price').text($('#people').val() * $('#fine_price').val())
                        }

                        let update = () => {
                            let price = $('select[name=fine]').find(':selected').attr('data-price');
                            $('#fine_price').val(price)
                        }
                        
                        let showOff = _ => {
                            if ($('select[name=fine]').val() == 1) {
                                $('#other').hide()
                            } else $('#other').show()
                        }

                        $(document).ready(_ => {
                            showOff();
                            update();
                            count();
                            $('select[name=fine]').bind('change', function() {
                                showOff();
                                update();
                                count();
                            })

                            $('#people').change(function() {
                                count();
                            })
                        })
                    </script>
                </td>
            </tr>
        </table>
        <input value="送出" type="button" onclick="upload()"/>
        <input value="送出" id="sub" type="submit" style="display:none;" />
        <script>
              let move = false;
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
                    move = true;
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
                        move = true;
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
                        if (move)
                            $.ajax({
                                url: "/model/canvasUpload.php?action=<?=$_GET['id']?'update_safty':'create_safty'?>",
                                type: "POST",
                                data: formData,
                                processData: false,
                                contentType: false
                            }).done(function(respond){
                                // alert(respond);
                                $('#sub').click()
                            });
                        else $('#sub').click()
                    })
                }
        </script>
    </form>
</div>
<?php require_once './component/footer.php'; ?>