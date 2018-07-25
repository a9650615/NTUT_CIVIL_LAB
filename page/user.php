<?php include './component/header.php'; ?>
<?php
    if ($_GET['success'] == '1') {
        echo '<div class="alert alert-info" role="alert">更改成功</div>';
    }
    require_once './model/sql.php';
    $sql = mysqli_query($conn, "SELECT * FROM user WHERE ID='{$_COOKIE['userId']}'");
    $data = $sql->fetch_assoc();
?>

<!--<option value='1'>施工所主管</option>
    <option value='5'>安全衛生稽核人員</option>
    <option value='2'>品質改善稽核人員</option>
    <option value='3'>現場工程師</option>
    <option value='4'>經理 / 公司主管</option>
-->

<div class="container">
  <a style="font-size: 25px;"  href="?">上一頁</a>
    <div>
        <p  align="center" style="font-size: 35px">員工資料</p> <br> 
        <ul class="list-group">
            <li class="list-group-item">
                    <?php
                      $role = $_COOKIE['role'];
                      if ( $role == 1) {
                          ?>
                          <?=$data['name']?> 施工所主管，您好
                          <?php
                      }?>

                      <?php
                      $role = $_COOKIE['role'];
                      if ( $role == 2) {
                          ?>
                          <?=$data['name']?> 品質稽核，您好
                          <?php
                      }?>
                      <?php
                      $role = $_COOKIE['role'];
                      if ( $role == 3) {
                          ?>
                          <?=$data['name']?> 現場工程師，您好
                          <?php 
                      }?>

                      <?php
                      $role = $_COOKIE['role'];
                      $admin = $role == 4;
                      if ( $role == 4) {
                          ?>
                          <?=$data['name']?> 經理/公司主管，您好
                          <?php
                      }?>                      
                      <?php
                      $role = $_COOKIE['role'];
                      if ( $role == 5) {
                          ?>
                          <?=$data['name']?> 安衛稽核，您好
                          <?php
                      }?>         

            <li class="list-group-item">員工編號 : <?=$data['acc']?></li>
            <li class="list-group-item">員工姓名 : <?=$data['name']?></li>
            
            <? $role = $_COOKIE['role'];
            if ( $role == 1|| $role== 3) { ?>
            <li class="list-group-item">所屬工程編號 : <?=$data['order_id']?></li>
            <?  }  ?>

        </ul>
        <a href="?page=edit_ps">修改密碼</a>
    </div>
</div>
<?php include './component/footer.php'; ?>