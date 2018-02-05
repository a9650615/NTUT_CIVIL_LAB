<?php include './component/header.php'; ?>
<a href="?page=logout" style="float:right;">登出</a>
<div class="container">
    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="product_index">
          <div class="product_head" data-move-y="-40px"></div>
          
          <div class="product_list">

            <?php
                $role = $_COOKIE['role'];
                $admin = $role == 4;
                if ($role == 1 || $role == 3|| $role == 2 || $admin) {
                    ?>
                    <div class="col-sm-4 col-md-4 col-mm-6 product_img" data-move-y="150px">
                    <a href="?page=quality">
                    <img src="cloud/Qualityimage.png" class="img-thumbnail" ></a>
                    <p class="product_title">
                    <a href="quality-index.html" title="品質改善檢查表">品質改善檢查表</a>
                    </p>
                    </div>
                    <?php
                }
            ?>
            
            <?php
                if ($role == 1 || $role == 3 || $admin) {
                    ?>
                    <div class="col-sm-4 col-md-4 col-mm-6 product_img" data-move-y="150px">
                    <a href="?page=iso_list">
                    <img src="cloud/isoimage.png" class="img-thumbnail" ></a>
                    <p class="product_title">
                    <a href="iso-index.html" title="ISO工務表單">ISO工務表單</a>
                    </p>
                    </div>
                    <?php
                }

                if ($admin) {
                  ?>
                  <div class="col-sm-4 col-md-4 col-mm-6 product_img" data-move-y="150px">
                    <a href="?page=case">
                    <img src="cloud/siteimage.png" class="img-thumbnail" ></a>
                    <p class="product_title">
                    <a href="casefile.php" title="工程資料">工程資料</a>
                    </p>
                  </div>
                  <?php
                }
            ?>
            <div class="col-sm-4 col-md-4 col-mm-6 product_img" data-move-y="150px">
              <a href="?page=safty">
              <img src="cloud/saftyimage.png" class="img-thumbnail"></a>
              <p class="product_title">
              <a href="safty-index.html" title="安全衛生檢查表">安全衛生檢查表 </a>
              </p>
            </div>
            <!--

            <div class="col-sm-4 col-md-4 col-mm-6 product_img" data-move-y="150px">
              <a href="javascript:;">
              <img src="cloud/constructtionimage.png" class="img-thumbnail" ></a>
              <p class="product_title">
              <a href="javascript:;" title="施工日誌">施工日誌</a>
              </p>
            </div>

            <div class="col-sm-4 col-md-4 col-mm-6 product_img" data-move-y="150px">
              <a href="javascript:;">
              <img src="cloud/drawimage.png" class="img-thumbnail" ></a>
              <p class="product_title">
              <a href="javascript:;" title="施工圖說">施工圖說</a>
              </p>
            </div>
           
            <div class="col-sm-4 col-md-4 col-mm-6 product_img" data-move-y="150px">
              <a href="javascript:;">
              <img src="cloud/imageimage.png" class="img-thumbnail" ></a>
              <p class="product_title">
              <a href="javascript:;" title="相片影音">相片影音</a>
              </p>
            </div>

            <div class="col-sm-4 col-md-4 col-mm-6 product_img" data-move-y="150px">
              <a href="javascript:;">
              <img src="cloud/moneyimage.png" class="img-thumbnail" ></a>
              <p class="product_title">
              <a href="javascript:;" title="估驗計價">估驗計價</a>
              </p>
            </div>
           
            <div class="col-sm-4 col-md-4 col-mm-6 product_img" data-move-y="150px">
              <a href="javascript:;">
              <img src="cloud/contractimage.png" class="img-thumbnail" ></a>
              <p class="product_title">
              <a href="javascript:;" title="廠商/業主合約">廠商/業主合約</a>
              </p>
            </div>
                      
            <div class="col-sm-4 col-md-4 col-mm-6 product_img" data-move-y="150px">
              <a href="javascript:;">
              <img src="cloud/textimage.png" class="img-thumbnail" ></a>
              <p class="product_title">
              <a href="javascript:;" title="收發文件資料">收發文件資料</a>
              </p>
            </div>
            -->
            <div class="col-sm-4 col-md-4 col-mm-6 product_img" data-move-y="150px">
              <a href="?page=user">
              <img src="cloud/manager.png" class="img-thumbnail" ></a>
              <p class="product_title">
              <a href="javascript:;" title="會員管理">會員管理</a>
              </p>
            </div>

            </div>
        </div>
      </div>
    </div>
</div>
<?php include './component/footer.php'; ?>