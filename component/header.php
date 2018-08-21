<!DOCTYPE html>
<html lang="zh-Hant-TW">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>福住建設股份有限公司</title>
    <link href="css/bootstrap1.css" rel="stylesheet">
    <link href="css/bxslider.css" rel="stylesheet">
    <link href="css/style-cloud.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bxslider.min.js"></script>
    <script src="js/common.js"></script>
    <script src="js/bootstrap.js"></script>
  <!--下拉選單引入-->
  <script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/menu_min.js"></script>
  <script type="text/javascript">
  $(document).ready(function (){
    $(".menu ul li").menu();
  }); 
  </script> 
  <link rel="stylesheet" type="text/css" href="css/menu-css_YMD.css">
  <link rel="stylesheet" type="text/css" href="css/menu-style_YMD.css"> 
  <link rel="stylesheet" type="text/css" href="css/custom.css"> 
  <link rel="manifest" href="manifest.json">
  <meta name="application-name" content="福住建設測試雛型">
  <link rel="icon" sizes="225x224" href="icon.png">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="viewport" content="width=device-width">
  <link rel="apple-touch-icon" href="icon-white.png">
  <link rel="apple-touch-icon" sizes="152x152" href="icon-white.png">
  <link rel="apple-touch-icon" sizes="180x180" href="icon-white.png">
  <link rel="apple-touch-icon" sizes="167x167" href="icon-white.png">
  <meta name="apple-mobile-web-app-title" content="福住建設股份有限公司APP">
  <meta name="apple-mobile-web-app-status-bar-style" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
<body>

  <?php
    require_once './model/sql.php';
    $sql = mysqli_query($conn, "SELECT * FROM user WHERE ID='{$_COOKIE['userId']}'");
    $data = $sql->fetch_assoc();
?>

<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="javascript:;"><img style="width:80%" src="images/logo.png" class="logo" alt="福住建設公司"/></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-nav-c">
            <li class="dropdown"><a href="index.php">應用雛型系統</a>
              <a href="javascript:;" id="app_menudown" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-menu-down btn-xs"></span></a>
                <ul class="dropdown-menu nav_small" role="menu">
                  <li>            
                    <?php
                      $role = $_COOKIE['role'];
                      if ( $role == 1) {
                          ?>
                          <p style="color:black;font-size: 20px" ><?=$data['name']?> 施工所主管， 您好</p>
                          <?php 
                      }?>

                      <?php
                      $role = $_COOKIE['role'];
                      if ( $role == 2) {
                          ?>
                          <p style="color:black;font-size: 20px" ><?=$data['name']?> 品質稽核， 您好</p>
                          <?php
                      }?>

                      <?php
                      $role = $_COOKIE['role'];
                      if ( $role == 3) {
                          ?>
                          <p style="color:black;font-size: 20px" ><?=$data['name']?> 現場工程師， 您好</p>
                          <?php
                      }?>

                      <?php
                      $role = $_COOKIE['role'];
                      $admin = $role == 4;
                      if ( $role == 4) {
                          ?>
                          <p style="color:black;font-size: 20px" ><?=$data['name']?> 經理/公司主管， 您好</p>
                          <?php
                      }?>

                      <?php
                      $role = $_COOKIE['role'];
                      if ( $role == 5) {
                          ?>
                          <p style="color:black;font-size: 20px" ><?=$data['name']?> 安衛稽核， 您好</p>
                          <?php
                      }?>         
                  </li>

                  <br>

                  <?php
                    $role = $_COOKIE['role'];
                    if ( $role == 1 || $role == 3 || $admin) {
                        ?>
                      <li><a href="?page=iso_list">ISO工務表單</a></li>
                        <?php
                      }?>

                   <?php
                    $role = $_COOKIE['role'];
                    if ( $role == 1 || $role == 3 || $role == 5 || $admin) {
                        ?>
                        <li><a href="?page=safty">安衛查驗表</a></li>
                        <?php
                      }?> 

                   <?php
                    $role = $_COOKIE['role'];
                    if ($role == 1 || $role == 3|| $role == 2 || $admin) {
                        ?>
                        <li><a href="?page=quality">品質改善表</a></li>
                        <?php
                      }?> 

                   <?php
                    $role = $_COOKIE['role']; 
                    $admin = $role == 4;
                    if ($admin) {
                        ?>
                        <li><a href="?page=case">工程資料</a></li>
                        <?php
                      }?>

                        <li><a href="?page=user" >個人資料管理</a></li>
                        <li><a href="?page=logout" title="登出">登出</a></li>

                </ul>
            </li>      
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
</header>

<div class="product_bg">