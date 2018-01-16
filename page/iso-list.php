<?php include './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql_string = "SELECT * FROM iso_list WHERE user='{$_COOKIE['userId']}'";
    $sql = mysqli_query($conn, $sql_string);
?>
<div class="container">
    <a href="?">上一頁</a>
    <div class="col-xs-12 col-sm-12 col-md-12">   
          <div class="product_index">
            <a href="?page=select_iso_form">新增 ISO 表單</a>
            <div align="center">
              <h1>ISO工務表單</h1>

                  <!-- Search Google -->
                  <!--
                  <form method="get" action="http://www.google.com.tw/custom" target="_blank">
                  <input type="text" name="q" size="20">
                  <input type="submit" name="sa" value="搜尋">
                  <input type="hidden" name="domains" value="http://3to3.myds.me/runapp/iso-index.html">
                  <input type="hidden" name="sitesearch" value="http://3to3.myds.me/runapp/iso-index.html">
                  </form>
                  -->
                  <!-- Search Google -->
            </div>
            <br>
            <div class="col-sm-4 col-md-12 col-mm-12" id="content-menu">
                <div class="menu">
                    <div>
                    <h2 style="color: red">已建檔ISO工務表單總覽</h2>
                    </div>
                    <table class="table" style="width: 100%;">
                        <thead>
                            <tr>
                                <td>表單名稱</td>
                                <td>狀態</td>
                                <td>建立時間</td>
                                <td>編輯</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($data = $sql->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?=$data['project_name']?></td>
                                        <td><?php
                                            if ($data['status'] == 0)
                                                echo '未完成';
                                        ?></td>
                                        <td><?=date("Y-m-d",strtotime($data['create_date']))?></td>
                                        <td><?php 
                                            if ($data['status'] == 0) {
                                                ?>
                                                <a href="#">更新</a>
                                                <?php
                                            }
                                        ?></td>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            
          </div>
        </div>
</div>
<?php include './component/footer.php'; ?>