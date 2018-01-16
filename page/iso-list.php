<?php include './component/header.php'; ?>
<div class="container">
    <a href="?">上一頁</a>
    <div class="col-xs-12 col-sm-12 col-md-12">   
          <div class="product_index">
            <a href="?page=select_iso_form">新增 ISO 表單</a>
            <div align="center">
              <h1>ISO工務表單</h1>

                  <!-- Search Google -->
                  <form method="get" action="http://www.google.com.tw/custom" target="_blank">
                  <input type="text" name="q" size="20">
                  <input type="submit" name="sa" value="搜尋">
                  <input type="hidden" name="domains" value="http://3to3.myds.me/runapp/iso-index.html">
                  <input type="hidden" name="sitesearch" value="http://3to3.myds.me/runapp/iso-index.html">
                  </form>
                  <!-- Search Google -->
            </div>
            <br>
            <div class="col-sm-4 col-md-12 col-mm-12" id="content-menu">
                <div class="menu">
                  <div>
                    <h2 style="color: red">已建檔ISO工務表單總覽</h2>
                  </div>
                  <ul>
                    <li><a class="active" href="#">106年</a>
                      <ul style="display: none;">
                          <li><a href="#">總計</a></li>
                          <li><a href="#">地面下工程檢查表</a></li>
                          <li><a href="#">地面上工程檢查表</a></li>
                          <li><a href="#">安裝、修飾工程檢查表</a></li>
                          <li><a href="#">配電、給水及消防工程檢查表</a></li>
                          <li><a href="#">測試留存</a>
                            <ul>
                              <li><a href="#">Subitem 1</a></li>
                              <li><a href="#">Subitem 2</a></li>
                              <li><a href="#">Subitem 3</a></li>
                              <li><a href="#">Subitem 4</a></li>
                            </ul>
                          </li>
                      </ul>
                    </li>
                  </ul>
                </div>
            </div>

            
          </div>
        </div>
</div>
<?php include './component/footer.php'; ?>