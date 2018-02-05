<?php require_once './component/header.php'; ?>
<?php
    include './model/sql.php';
    $sql_case_name = mysqli_query($conn, "SELECT `order_name` FROM case_list");
    $sql_case_contractor = mysqli_query($conn, "SELECT `contractor` FROM case_list");
?>
<div class="container">
    <form action="/model/safty.php?action=create" method="post" enctype="multipart/form-data">
        <table class="table">
            <tr>
                <td>
                    <select name="missing_place" required>
                        <option value="">缺失項目</option>
                        <?php 
                            while ($data = $sql_case_name->fetch_assoc()) {
                                ?>
                                <option><?=$data['order_name']?></option>
                                <?php
                            }
                        ?>
                    </select><br>
                    <select name="missing_company" required>
                        <option value="">缺失廠商</option>
                        <?php 
                            while ($data = $sql_case_contractor->fetch_assoc()) {
                                ?>
                                <option><?=$data['contractor']?></option>
                                <?php
                            }
                        ?>
                    </select>
                </td>
                <td>
                    選擇照片：<input type="file" name="missing_image" required/>
                </td>
            </tr>
            <tr>
                <td>
                    查驗位置
                    <br>
                    <input type="text" name="check_place" required />
                    <br>
                    罰款項目
                    <br>
                    <select name="fine" style="max-width:300px;" required>
                        <option value="">罰款項目</option>
                        <option value="11">11_未參加協議組織會議</option>
                        <option value="12">12_未設置勞工安全衛生管理員或業務、作業主管證照</option>
                        <option value="13">13_未設置工地常駐勞安業務、作業主管人員於現場監督勞工作業</option>
                        <option value="14">14_未依規定佩掛工作證</option>
                        <option value="15">15_任何經現場安衛主管人員認定不妥之行為，經指示要求改善未改善者</option>
                        <option value="16">16_未繳交勞工名冊、一般勞工教育訓綀六小時證明、勞工保險卡、體格檢表</option>
                        <option value="17">17_作業人員未簽署工作安全紀律承諾書者</option>
                        <option value="21">21_進入工地未佩戴安全帽</option>
                        <option value="22">22_高架作業時未佩戴安全帶並正確使用</option>
                        <option value="23">23_穿著拖鞋進入工地作業</option>
                        <option value="24">24_在工地內打赤膊，服裝不整，經勸導不從者</option>
                        <option value="25">25_未在規定之區域內吸煙</option>
                        <option value="26">26_未在所設置之臨時廁內大小便者</option>
                        <option value="27">27_在工地製造生活垃圾，未依規定集中丟棄至指定處所者</option>
                        <option value="28">28_攜帶含酒精之飲料進入工地者</option>
                        <option value="29">29_其他違反工作安全紀律承諾書者</option>
                        <option value="31">31_開口作業未佩戴安全帶</option>
                        <option value="32">32_鋼構高架作業未佩安全帶</option>
                        <option value="33">33_施工架、鋼樑擺放物料、工具未穩妥綁紮固結</option>
                        <option value="34">34_施工架配件臨時拆除後，未立即復原</option>
                        <option value="35">35_開口處吊料人員未佩戴安全帽及安全帶</option>
                        <option value="36">36_使用不符規定之移動式施工架者</option>
                        <option value="37">37_使用不符規定之上下設備、爬梯、合梯者</option>
                        <option value="38">38_高架工作平台上使用上下設備、爬梯、合梯工作者</option>
                        <option value="41">41_護欄、護蓋板、安全防墬網等臨時拆除後，未立即復原</option>
                        <option value="42">42_開口邊緣2公尺內堆放物料或工具</option>
                        <option value="43">43_開口護蓋上堆放物料、雜物或工具</option>
                        <option value="44">44_開口安全防墬網上掉落之物料、雜物或工具未立即清除 </option>
                        <option value="45">45_電梯直井開口吊料、傾倒垃圾未依照規定申請、安全防護、啟閉電梯柵門</option>
                        <option value="46">46_高差2公尺以上開口邊緣跨越警示線工作未申請者</option>
                        <option value="51">51_電線橫越地面時浸泡水中未予架高</option>
                        <option value="52">52_未使用插頭、直接以裸線掛接於插座或電錶箱內</option>
                        <option value="53">53_未設置漏電斷路器及接地線、分電盤、電動機具</option>
                        <option value="54">54_交流電焊機未設有自動電擊防整裝置</option>
                        <option value="55">55_電動機具絕緣不良，造成漏電斷路器跳脫，影響供電及作業</option>
                        <option value="56">56_電源直接接於總開關未經漏電斷路器者</option>
                        <option value="57">57_未經許可自行拆裝或操作臨時供電設備</option>
                        <option value="61">61_吊車無檢查合格證</option>
                        <option value="62">62_吊鉤無安全防滑舌片</option>
                        <option value="63">63_吊車無過捲揚、過負荷裝置</option>
                        <option value="71">71_吊車操作人員無訓綀合格證</option>
                        <option value="72">72_吊掛操作人員無訓綀合格證</option>
                        <option value="73">73_吊掛作業未指派專人負責指揮與隔離</option>
                        <option value="81">81_工作地點四周未保持清潔、亂丟垃圾</option>
                        <option value="82">82_地下室開挖時，車輛未沖洗，駛出工區造成道路污染</option>
                        <option value="91">91_氧氣、乙炔鋼瓶未直立固定並橫佈倒置</option>
                        <option value="92">92_氧氣、乙炔鋼瓶未依規定儲存、搬運、標示</option>
                        <option value="93">93_易燃物、爆裂物儲存時未依規定設置滅火設施</option>
                        <option value="94">94_其他違反安全衛生規定或合約規定</option>
                        <option value="95">95_侷限空間內作業未依規定報備、未設置作業主管指揮作業</option>
                        <option value="96">96_侷限空間內作業未依規定佩戴個人防護具、設置安全設施、通風設備</option>
                        <option value="97">97_移動式施工架上有作業人員時，移動施工架</option>
                        <option value="98">98_物料儲存堆積高度超過1.8公尺</option>
                        <option value="99">99_鋼筋、鐵管、鋼樑等物料以直立靠牆暫放</option>
                        <option value="910">910_水電管料未以管架存放或散置於工區內</option>
                        <option value="911">911_大型管料、鋼樑、RC製品、機具設備等存放位設置防傾倒、滾動裝置</option>
                        <option value="912">912_門窗材料、石材、玻璃等形式物料未穩固靠牆存放並設置防傾倒裝置</option>
                        <option value="913">913_物料存放有接觸土壤未設置適當間隔</option>
                        <option value="914">914_物料存放位置之底部有傾斜、靠近開口邊緣、鬆軟不</option>
                        <option value="915">915_供作模板支撐之材料，不得有明顯之損壞、變形或腐蝕</option>
                        <option value="916">916_以可調式鋼管為模板支撐時，不得連接使用</option>
                        <option value="917">917_以可調式鋼管為模板支撐時，高度超過3.5公尺，應每隔2公尺設置水平繫條</option>
                        <option value="918">918_水平繫條未與牆、柱等構造物或模版穩固連接以防止支柱移位</option>
                        <option value="919">919_以可調式鋼管為模板支撐時，以鋼筋取代制式金屬插銷</option>
                        <option value="920">920_其他違反營造安全衛生設施標準第九章鋼筋混凝土作業規定</option>
                        <option value="921">921_有機溶劑物品未有物質安全資料表或GHS標示</option>
                        <option value="1001">1001_經主管機關第一次通知改善者</option>
                        <option value="1002">1002_群聚飲用含酒精之飲料者</option>
                        <option value="1003">1003_屢犯仍未改善且不服從糾正者</option>
                        <option value="1004">1004_未經許可擅自操作機具設備造成損壞或人員傷亡者</option>
                        <option value="1005">1005_經主管機關通知罰款者</option>
                    </select>
                </td>
                <td>
                    
                </td>
            </tr>
            <tr>
                <td>
                    現況說明：
                    <textarea rows="3" cols="20" name="other"></textarea>
                </td>
                <td></td>
            </tr>
        </table>
        <input value="送出" type="submit" />
    </form>
</div>
<?php require_once './component/footer.php'; ?>