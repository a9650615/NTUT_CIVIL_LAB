<?php include './component/header.php'; ?>   
<div class="container">
        <a href="?page=iso_list">上一頁</a>
    <br>
    <p align="center" style="font-size: 35px;">ISO檢查表單列表</p>
    <style>
    .block{display: none;}
    </style>
    <script>
    $(document).ready(() => {
        $('.page-link').click(function() {
            $('.block').hide()
            $('.'+$(this).attr('data-type')).show()
        })
    })
    </script>
    <div style="margin:auto; text-align: center;">
        <ul class="pagination justify-content-center">
            <li class="page-item"><a class="page-link" data-type="quality" href="#">品質</a></li>
            <li class="page-item"><a class="page-link" data-type="safty" href="#">安衛</a></li>
        </ul>
    </div>
    <div class="quality block">
        <div class="col-sm-4 col-md-6 col-mm-6" id="content-menu">
            <div class="menu">
                <div>
                <h2>品質－地面下工程檢查表</h2>
                </div>
                <ul>
                <li><a class="active" href="#">連續壁與鋼軌樁等</a>
                    <ul style="display: none;">
                        <li><a href="?page=create_iso&order_id=SF-0104-01&name=工地環保措施">SF-0104-01工地環保措施</a></li>
                        <li><a href="?page=create_iso&order_id=SF-0301-01&name=土方工程">SF-0301-01土方工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-0302-01&name=連續壁工程(假設)">SF-0302-01連續壁工程(假設)</a></li>
                        <li><a href="?page=create_iso&order_id=SF-0302-02&name=連續壁工程(鋼筋籠)">SF-0302-02連續壁工程(鋼筋籠)</a></li>
                        <li><a href="?page=create_iso&order_id=SF-0302-03&name=連續壁工程(壁體單元)">SF-0302-03連續壁工程(壁體單元)</a></li>
                        <li><a href="?page=create_iso&order_id=SF-0303-01&name=鋼軌樁工程">SF-0303-01鋼軌樁工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-0303-02&name=擋土板工程">SF-0303-02擋土板工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-0304-01&name=擋土支撐工程">SF-0304-01擋土支撐工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-0305-01&name=安全監測系統">SF-0305-01安全監測系統</a></li>
                        <li><a href="?page=create_iso&order_id=SF-0402-01&name=放樣工程">SF-0402-01放樣工程</a></li>
                        </li>
                    </ul>
                </li>                  
                </ul>
            </div>
        </div>
        <div class="col-sm-4 col-md-6 col-mm-6" id="content-menu">
            <div class="menu">
                <div>
                <h2>品質－地面上工程檢查表</h2>
                </div>
                <ul>
                <li><a class="active" href="#">模板及鋼筋等</a>
                    <ul style="display: none;">
                        <li><a href="?page=create_iso&order_id=SF-0101-01&name=假設工程及安全設施">SF-0101-01假設工程及安全設施</a></li>
                        <li><a href="?page=create_iso&order_id=SF-0102-01&name=建築物拆除工程">SF-0102-01建築物拆除工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-0103-01&name=施工架">SF-0103-01施工架</a></li>
                        <li><a href="?page=create_iso&order_id=SF-0104-01&name=工地環保措施">SF-0104-01工地環保措施</a></li>
                        <li><a href="?page=create_iso&order_id=SF-0305-01&name=安全監測系統">SF-0305-01安全監測系統</a></li>
                        <li><a href="?page=create_iso&order_id=SF-0401-01&name=模板工程">SF-0401-01模板工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-0402-01&name=放樣工程">SF-0402-01放樣工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-0501-01&name=鋼筋工程">SF-0501-01鋼筋工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-0104-01&name=工地環保措施">SF-0104-01工地環保措施</a></li>
                        <li><a href="?page=create_iso&order_id=SF-0305-01&name=安全監測系統">SF-0305-01安全監測系統</a></li>
                        <li><a href="?page=create_iso&order_id=SF-0501-01&name=鋼筋工程">SF-0501-01鋼筋工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-0502-01&name=鋼筋續接器(螺栓式)">SF-0502-01鋼筋續接器(螺栓式)</a></li>
                        <li><a href="?page=create_iso&order_id=SF-0601-01&name=鋼骨工程">SF-0601-01鋼骨工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-0601-02&name=鋼骨工程品管流程">SF-0601-02鋼骨工程品管流程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-0701-01&name=混凝土澆置前工程">SF-0701-01混凝土澆置前工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-0701-02&name=混凝土澆置中工程">SF-0701-02混凝土澆置中工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-0701-03&name=混凝土澆置後工程">SF-0701-03混凝土澆置後工程</a></li>
                        </li>
                    </ul>
                </li>                  
                </ul>
            </div>
        </div>
        <div class="col-sm-4 col-md-6 col-mm-6" id="content-menu">
            <div class="menu">
                <ul>
                <div>
                    <h2>品質－安裝、修飾工程檢查表</h2>
                </div>
                <li><a class="active" href="#">粉刷與玻璃等</a>
                    <ul style="display: none;">
                        <li><a href="?page=create_iso&order_id=SF-0801-01&name=砌磚工程">SF-0801-01砌磚工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-0901-01&name=銅瓦屋頂工程">SF-0901-01銅瓦屋頂工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-1002-01&name=塗膜防水工程">SF-1002-01塗膜防水工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-1003-01&name=合成高分子膠布防水工程">SF-1003-01合成高分子膠布防水工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-1101-01&name=鋁合金門窗工程">SF-1101-01鋁合金門窗工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-1102-01&name=防火門窗工程">SF-1102-01防火門窗工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-1103-01&name=帷幕牆工程">SF-1103-01帷幕牆工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-1104-01&name=門窗安裝工程">SF-1104-01門窗安裝工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-1105-01&name=玻璃及安裝工程">SF-1105-01玻璃及安裝工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-1106-01&name=捲門工程">SF-1106-01捲門工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-1201-01&name=水泥粉刷工程">SF-1201-01水泥粉刷工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-1201-02&name=外牆吊線工程">SF-1201-02外牆吊線工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-1202-01&name=整體粉光工程">SF-1202-01整體粉光工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-1203-01&name=防水水泥粉刷工程">SF-1203-01防水水泥粉刷工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-1204-01&name=磨,洗,斬石子工程">SF-1204-01磨,洗,斬石子工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-1205-01&name=水泥砂漿塞縫及灌漿">SF-1205-01水泥砂漿塞縫及灌漿</a></li>
                        <li><a href="?page=create_iso&order_id=SF-1301-01&name=舖貼石材工程">SF-1301-01舖貼石材工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-1401-01&name=舖貼磁磚">SF-1401-01舖貼磁磚</a></li>
                        <li><a href="?page=create_iso&order_id=SF-1501-01&name=舖貼塑膠飾面工程">SF-1501-01舖貼塑膠飾面工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-1502-01&name=塗抹合成樹脂工程">SF-1502-01塗抹合成樹脂工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-1701-01&name=金屬工程">SF-1701-01金屬工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-1801-01&name=木作工程">SF-1801-01木作工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-1802-01&name=輕鋼架工程">SF-1802-01輕鋼架工程</a></li>
                        <li><a href="?page=create_iso&order_id=SF-1803-01&name=高架地板工程">SF-1803-01高架地板工程</a></li>
                        <li><a href="?page=create_iso&order_id=>SF-1901-01&name=油漆工程">SF-1901-01油漆工程</a></li>
                        </li>
                    </ul>
                </li>
            </div>         
        </div>
        <div class="col-sm-4 col-md-6 col-mm-6" id="content-menu">
            <div class="menu">
                <ul>
                <div>

                    <h2>品質－配電及消防工程檢查表</h2>
                </div>                  
                <li><a a class="active" href="#">電氣及空調等</a>
                    <ul style="display: none;">
                    <li><a href="?page=create_iso&order_id=SF-2102-01&name=電氣工程">SF-2102-01電氣工程</a></li>
                    <li><a href="?page=create_iso&order_id=SF-2103-01&name=消防工程">SF-2103-01消防工程</a></li>
                    <li><a href="?page=create_iso&order_id=SF-2104-01&name=給排水通氣工程">SF-2104-01給排水通氣工程</a></li>
                    <li><a href="?page=create_iso&order_id=SF-2106-01&name=空調機器設備">SF-2106-01空調機器設備</a></li>
                    <li><a href="?page=create_iso&order_id=SF-2106-01&name=空調機器設備">SF-2106-01空調機器設備</a></li>
                    <li><a href="?page=create_iso&order_id=SF-2108-01&name=空調風管工程">SF-2108-01空調風管工程</a></li>
                    <li><a href="?page=create_iso&order_id=SF-2109-01&name=配電及自控">SF-2109-01配電及自控</a></li>
                    <li><a href="?page=create_iso&order_id=SF-2112-01&name=試車維護保養表">SF-2112-01試車維護保養表</a></li>
                    </ul>
                </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="safty block">
        <div class="col-sm-4 col-md-6 col-mm-6" id="content-menu">
            <div class="menu">
                <ul>
                <div>
                    <h2>安衛－地面上工程與環境相關</h2>
                </div>                  
                <li><a a class="active" href="#">模板及鋼筋等</a>
                    <ul style="display: none;">
                    <li><a href="?page=create_iso&order_id=SF-3107-01-16&name=施工架工程作業安全檢查表">SF-3107-01-16施工架工程作業安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-17&name=抽排風工程作業安全檢查表">SF-3107-01-17抽排風工程作業安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-21&name=安全支撐工程作業安全檢查表">SF-3107-01-21安全支撐工程作業安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-22&name=抽排水工程作業安全檢查表">SF-3107-01-22抽排水工程作業安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-23&name=模板工程作業安全檢查表">SF-3107-01-23模板工程作業安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-24&name=鋼筋工程作業安全檢查表">SF-3107-01-24鋼筋工程作業安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-25&name=混凝土工程作業安全檢查表">SF-3107-01-25混凝土工程作業安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-26&name=鋼構工程作業安全檢查表">SF-3107-01-26鋼構工程作業安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=QS-3105&name=局限空間作業安全檢查表">QS-3105局限空間作業安全檢查表</a></li>             
                    </ul>
                </li>
                </ul>
            </div>
        </div>
        <div class="col-sm-4 col-md-6 col-mm-6" id="content-menu">
            <div class="menu">
                <ul>
                <div>
                    <h2>安衛－地面下工程與環境相關</h2>
                </div>                  
                <li><a a class="active" href="#">基樁及土方等</a>
                    <ul style="display: none;">
                    <li><a href="?page=create_iso&order_id=SF-3107-01-18&name=基樁工程作業安全檢查表">SF-3107-01-18基樁工程作業安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-19&name=安全觀測工程作業安全檢查表">SF-3107-01-19安全觀測工程作業安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-20&name=土方工程作業安全檢查表">SF-3107-01-20土方工程作業安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=QS-3105&name=局限空間作業安全檢查表">QS-3105局限空間作業安全檢查表</a></li>             
                    </ul>
                </li>
                </ul>
            </div>
        </div>    
        <div class="col-sm-4 col-md-6 col-mm-6" id="content-menu">
            <div class="menu">
                <ul>
                <div>
                    <h2>安衛－安裝、修飾相關</h2>
                </div>                  
                <li><a a class="active" href="#">泥作及門窗等</a>
                    <ul style="display: none;">
                    <li><a href="?page=create_iso&order_id=SF-3107-01-27&name=泥作工程作業安全檢查表">SF-3107-01-27泥作工程作業安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-28&name=門窗工程作業安全檢查表">SF-3107-01-28門窗工程作業安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-29&name=天花板輕隔間工程作業安全檢查表">SF-3107-01-29天花板輕隔間工程作業安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-30&name=石材工程作業安全檢查表">SF-3107-01-30石材工程作業安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-31&name=油漆工程作業安全檢查表">SF-3107-01-31油漆工程作業安全檢查表</a></li>
                    </ul>
                </li>
                </ul>
            </div>
        </div>   
        <div class="col-sm-4 col-md-6 col-mm-6" id="content-menu">
            <div class="menu">
                <ul>
                <div>
                    <h2>安衛－車輛機械相關</h2>
                </div>                  
                <li><a a class="active" href="#">電焊及堆高機等</a>
                    <ul style="display: none;">
                    <li><a href="?page=create_iso&order_id=SF-3107-01-1&name=車輛系營建機械安全檢查表">SF-3107-01-1車輛系營建機械安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-2&name=一般車輛安全檢查表">SF-3107-01-2一般車輛安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-3&name=電焊機安全檢查表">SF-3107-01-3電焊機安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-4&name=堆高機安全檢查表">SF-3107-01-4堆高機安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-5&name=捲揚裝置安全檢查表">SF-3107-01-5捲揚裝置安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-7&name=移動式起重機作業安全檢查表">SF-3107-01-7移動式起重機作業安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-8&name=固定式起重機作業安全檢查表">SF-3107-01-8固定式起重機作業安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-9&name=固定式起重機爬升作業安全檢查表">SF-3107-01-9固定式起重機爬升作業安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-10&name=固定式起重機拆除作業安全檢查表">SF-3107-01-10固定式起重機拆除作業安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-13&name=電梯施工平台安全檢查表">SF-3107-01-13電梯施工平台安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-34&name=第二種壓力容器(含壓縮機)安全檢查表">SF-3107-01-34第二種壓力容器(含壓縮機)安全檢查表</a></li>              
                    </ul>
                </li>
                </ul>
            </div>
        </div>

        <div class="col-sm-4 col-md-6 col-mm-6" id="content-menu">
            <div class="menu">
                <ul>
                <div>
                    <h2>安衛－器具設備相關</h2>
                </div>                  
                <li><a a class="active" href="#">乙炔及防護具等</a>
                    <ul style="display: none;">
                    <li><a href="?page=create_iso&order_id=SF-3107-01-6&name=乙炔鋼瓶熔接安全檢查表">SF-3107-01-6乙炔鋼瓶熔接安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-11&name=搶救設備設置安全檢查表">SF-3107-01-11搶救設備設置安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-12&name=個人防護具之安全檢查表">SF-3107-01-12個人防護具之安全檢查表</a></li>
                    </ul>
                </li>
                </ul>
            </div>
        </div>
        <div class="col-sm-4 col-md-6 col-mm-6" id="content-menu">
            <div class="menu">
                <ul>
                <div>
                    <h2>安衛－水電氣工程與環境相關</h2>
                </div>                  
                <li><a a class="active" href="#">電梯及消防等</a>
                    <ul style="display: none;">
                    <li><a href="?page=create_iso&order_id=SF-3107-01-14&name=臨時水電工程安全檢查表">SF-3107-01-14臨時水電工程安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-15&name=施工電梯工程作業安全檢查表">SF-3107-01-15施工電梯工程作業安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-32&name=水電消防空調工程作業安全檢查表">SF-3107-01-32水電消防空調工程作業安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=SF-3107-01-33&name=電梯工程作業安全檢查表">SF-3107-01-33電梯工程作業安全檢查表</a></li>
                    <li><a href="?page=create_iso&order_id=QS-3106&name=電氣設備安全檢查表">QS-3106電氣設備安全檢查表</a></li>
                    </ul>
                </li>
                </ul>
            </div>
        </div>
    </div>

    </div>
</div>
<?php include './component/footer.php'; ?>