<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
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
  </head>
<body>

<div>
<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a href="javascript:;"><img  src="images/logo.png" class="logo" alt="福住建設公司"/></a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-nav-c">
            <li class="dropdown"><a href="javascript:;">雲端資料庫系統</a>
              <a href="javascript:;" id="app_menudown" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-menu-down btn-xs"></span></a>
                <ul class="dropdown-menu nav_small" role="menu">
                  <li><a href="javascript:;">相片影音檔</a></li>
                  <li><a href="javascript:;">合約資料</a></li>
                  <li><a href="iso-index.html">ISO工務表單</a></li>
                  <li><a href="safty-index.html">安衛查驗表</a></li>
                  <li><a href="quality-index.html">品質改善表</a></li>
                  <li><a href="casefile.php">工程資料</a></li>
                  <li><a href="javascript:;">施工圖說</a></li>
                  <li><a href="javascript:;">施工日誌</a></li>
                  <li><a href="javascript:;">收發文資料</a></li>
                  <li><a href="javascript:;">估驗計價</a></li>
                </ul>
            </li>      
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
</header>
</div>

<!--卡位-->
<div class="product_index">
<div class="product_head" data-move-y="-40px"></div>
</div>
 
<div>         
  <table class="Table" align="center">
    <thead>
      <tr>
      <th>工程編號</th>
      <th>工程名稱</th>
      <th>施工所主管</th>
      <th>檢查人員</th>
      <th>承包商名稱</th>
      </tr>
    </thead>
    <tfoot>
      <tr>
      <td colspan="5">
        <div class="links">
          <a href="#">&laquo;</a>
          <a class="active" href="#">1</a> 
          <a href="#">2</a> 
          <a href="#">3</a> 
          <a href="#">4</a> <a href="#">&raquo;</a>
        </div>
      </td>
      </tr>
    </tfoot>
    <tbody>
      <?php
      header("Content-Type:text/html; charset=utf-8");
      $server='localhost';
      $id='root';
      $pwd='2ugidjal';
      $dbname='test';       
      $link = mysqli_connect($server, $id, $pwd, $dbname) or die("無法登入MySQL資料庫!<br>");  
      //選擇資料庫 (必須）          
      $dbname='test';
      mysqli_select_db($link, $dbname)  or die("無法取得資料庫內容!"); 

      //指定SQL查詢字串 (必須）
      $sql = "SELECT * FROM 工程資料";  
      //送出查詢的SQL指令 (必須）
      $result = mysqli_query($link, $sql);  
      //顯示查詢結果 (必須）    
      while( $row = mysqli_fetch_array($result)  )
        { 
          echo "<tr>";
          echo "<td> $row[0] </td>".
               "<td> $row[1] </td>". 
               "<td> $row[2] </td>".
               "<td> $row[3] </td>".
               "<td> $row[4] </td>";
          echo "</tr>";} ?>
    </tbody>
  </table>
    <div align="center">
      <?php 
      //顯示統計結果 (必須）
        $total_records = mysqli_num_rows($result);
        echo "本頁共: $total_records 筆<br>";
      ?>
    </div>
</div> 

  <footer>
    <div style="float: bottom" class="copyright">
      <a href="https://goo.gl/62oaHV" target="_blank">地址：台北市中山區龍江路五十九號一樓</a>
      <br>電話：(02)2752-1313 &nbsp;傳真：(02)2752-1310&nbsp;
      <p class="copyright_p">CopyRight 2017 All Right Reserved 福住建設公司</p>
    </div>
  </footer>

    <script src="js/jquery.smoove.min.js"></script>
    <script>$('.product_head,.product_img,.process,.about_left,.about_img,.news_head,.news_index').smoove({offset:'10%'});</script>
  <nav class="navbar navbar-default navbar-fixed-bottom footer_nav">

          <div class="foot_nav"><a href="tel:0227521313">
          <span class="glyphicon glyphicon-phone btn-lg" aria-hidden="true"></span>致電</a>
          </div>
          <div class="foot_nav" aria-hidden="true" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="glyphicon glyphicon-th-list btn-lg"></span>分類</div>
          <div class="foot_nav">
            <a id="gototop" href="javascript:;">
            <span class="glyphicon glyphicon-circle-arrow-up btn-lg" aria-hidden="true"></span>回頂部</a>
          </div>
  </nav>

    <link rel="stylesheet" type="text/css" href="css/online.css" />

<div class="jiathis_style_32x32">
	<a class="jiathis_button_qzone"></a>
	<a class="jiathis_button_tsina"></a>
	<a class="jiathis_button_tqq"></a>
	<a class="jiathis_button_weixin"></a>
	<a class="jiathis_button_renren"></a>
	<a href="javascript:;" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
</div>
<script type="text/javascript" src="js/jia.js" charset="utf-8"></script>

                   <div class="arrowPanel">
                        <div class="arrow01"></div>
                        <div class="arrow02"></div>
                   </div>

         
    <script type="text/javascript" src="js/online.js"></script>
  </body>
</html><script type="text/javascript">
var winHeight=200;
var timer=null;
function show(){
    document.getElementById("popWin").style.display="block"; 
    timer=setInterval("lift(5)",2);
} 
function hid(){
        timer=setInterval("lift(-5)",2);
} 
function lift(n) { 
    var w=document.getElementById("popWin"); 
    var h=parseInt(w.style.height||w.currentStyle.height);
    if (h<winHeight && n>0 || h>1 && n<0){
        w.style.height=(h+n).toString()+"px"; 
    } 
    else
        {
        w.style.display=(n>0?"block":"none");
                clearInterval(timer);
    } 
} 
window.onload=function(){ 
        setTimeout("show()",1000);
} 
</script>

