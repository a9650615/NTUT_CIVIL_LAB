<?php require_once './component/header.php'; ?>
<div class="container">
    <form action="/model/safety.php" method="post">
        <table class="table">
            <tr>
                <td>
                    <select name="missing_place">
                        <option value="">缺失地點</option>
                    </select><br>
                    <select name="missing_compony">
                        <option value="">缺失廠商</option>
                    </select>
                </td>
                <td>
                    選擇照片：<input type="file" name="missing_image" />
                </td>
            </tr>
            <tr>
                <td>
                    查驗位置
                    <br>
                    <input type="text" name="check_place" />
                    <br>
                    罰款項目
                    <br>
                    <select>
                        <option value="">罰款項目</option>
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