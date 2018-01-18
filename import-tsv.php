<?php
include 'model/sql.php';
if(!file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name'])) {
    echo 'No upload';
}
else {
    move_uploaded_file($_FILES["file"]["tmp_name"], 'upload_space/inputfile.txt');
    echo '<table><tr><td>第幾項</td><td>內容</td><td>是否新增(否為已重複)</td></tr><tbody>';
    $handle = fopen("upload_space/inputfile.txt", "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            // process the line read.
            $split = explode('.', $line);
            if (is_numeric($split[0])) {
                $con_str = '';
                foreach ($split as $index => $str) {
                    if ($index > 0)
                    $con_str .= (($index>1)?'.':'').$str;
                }
                $search = mysqli_query($conn, "SELECT * FROM iso_data_sheet WHERE order_id = '{$_POST['order_id']}' and list_id = '{$split[0]}'");
                $search_res = mysqli_num_rows($search);
                $sql = "INSERT INTO iso_data_sheet(`order_id`,`list_id`,`check_item`) VALUES('{$_POST['order_id']}', '{$split[0]}', '{$con_str}')";
                echo $sql.'<br>';
                $isIns = '是';
                if ($search_res) {
                    $isIns = '否';
                } else {
                    mysqli_query($conn, $sql);
                }
                echo "<tr><td>{$split[0]}</td><td>{$con_str}</td><td>{$isIns}</td></tr>";
                // echo $split[0].'<br>';
                // echo $split[1].'<br>';
            }
        }
    echo '</tbody></table>';
        fclose($handle);
    } else {
        // error opening the file.
    } 
}

?>
iso 確認資料新增器
<form action="" method="post" enctype="multipart/form-data">
工程ID: <input name="order_id" /><br>
<input type="file" name="file" />
<input type="submit" />
</form>