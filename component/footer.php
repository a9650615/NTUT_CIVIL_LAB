</div>



  <footer>
    <div class="copyright">
      <a href="https://goo.gl/62oaHV" target="_blank">地址：台北市中山區龍江路59號一樓</a>
      <br>電話：(02)2752-1313 &nbsp;傳真：(02)2752-1310&nbsp;
      <p class="copyright_p">CopyRight 2017 All Right Reserved 福住建設公司</p>
    </div>
  </footer>

    <script src="js/jquery.smoove.min.js"></script>
    <script>$('.product_head,.product_img,.process,.about_left,.about_img,.news_head,.news_index')
              .smoove({offset:'10%'});</script>
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
  <script type="text/javascript">
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
</html>