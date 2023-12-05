<?php
    // 資料庫連線
    require_once('../connect.php');

    if (empty($_POST['medical_record_id']) || empty($_POST['department']) || empty($_POST['sourse'])) {
        echo "<script>alert('資料有缺漏，請填寫完整。'); history.back();</script>";
        exit(); // 終止程序
    }
    
    // 從表單獲取資料
    $medical_record_id = $_POST['medical_record_id'];
    $department = $_POST['department'];
    $sourse = $_POST['sourse'];
    
    // 從資料庫查詢資料
    $sql = "SELECT * FROM patient WHERE (medical_record_id=".$medical_record_id.")";
    $retval = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($retval,MYSQLI_NUM);
    
    date_default_timezone_set('Asia/Taipei');
    $current = date("Y-m-d H:i:s");
    
    if($row) {
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <title>床位管理系統-表單</title>
    <link rel="stylesheet" href="Fstyle.css">
</head>
<body>
<header>
    <div>
        <img src="..\img\FJUHlogo.jpg" alt="a hospital's logo">
        <h1>輔大醫院-床位管理系統</h1>
        <h1 class="subtitle">預約住院登記及處理</h1>
        <div class="current_time"></div>
    </div>
</header>
<main>
    <nav>
        <ul>
            <li><a href="https://yunqi0102.000webhostapp.com/Home.php" style="padding-top: 10px;">
                <img src="..\img\LOGO_home.png" width="33px" class="first_img"><img src="..\img\LOGO_home2.png" width="33px" class="second_img"><br><br>首頁</a></li>
            <li><a href="#">
                <img src="..\img\LOGO_dashboard.png" width="30px" class="first_img" style="top: 134px; left: 23px;"><img src="..\img\LOGO_dashboard2.png" width="30px" class="second_img" style="top: 134px; left: 23px;"><br><br>儀表板</a></li>
            <li><a href="https://yunqi0102.000webhostapp.com/Register/">
                <img src="..\img\LOGO_register.png" width="33px" class="first_img"><img src="..\img\LOGO_register2.png" width="33px" class="second_img"><br><br>登記</a></li>
            <li><a href="https://yunqi0102.000webhostapp.com/FloorSelect/">
                <img src="..\img\LOGO_bed.png" width="35px" class="first_img" style="left: 20.5px;"><img src="..\img\LOGO_bed2.png" width="35px" class="second_img" style="left: 20.5px;"><br><br>病床</a></li>
            <li><a href="https://yunqi0102.000webhostapp.com/Patient/index.php">
                <img src="..\img\LOGO_patient.png" width="35px" class="first_img" style="left: 20.5px;"><img src="..\img\LOGO_patient2.png" width="35px" class="second_img" style="left: 20.5px;"><br><br>名單</a></li>
            <p>最後更新<br><span class="update_date"></span><br><span class="update_time"></span></p>
        </ul>
    </nav>
    <form class="out" action="insert.php" method="post">
    <p>基本資料</p>
    <table>
        <tr>
            <td style="width: 30%;">索引號：
                <input type="number" name="medical_record_id" class="insert" readonly=true 
                    value="<?php echo "{$medical_record_id}"; ?>">
            </td>
            <td>病患來源：
                <input type="text" name="sourse" class="insert" readonly=true 
                    value="<?php echo "{$sourse}"; ?>">
            </td>
            <td style="width: 30%;">科別：
                <input type="text" name="department" class="insert" readonly=true 
                    value="<?php echo "{$department}"; ?>">
            </td>
        </tr>
        <tr>
            <td>病患姓名：
                <input type="text" name="patient_name" class="insert" readonly=true 
                    value="<?php echo "{$row[1]}"; ?>">
            </td>
            <td>性別：
                <input type="text" name="gender" class="insert" readonly=true 
                    value="<?php echo "{$row[2]}"; ?>">
            </td>
            <td>身份：
                <input type="text" name="identity" class="insert" readonly=true 
                    value="<?php echo "{$row[3]}"; ?>">
            </td>
        </tr>
        <tr>
            <td>就診號：
                <input type="number" name="clinic_number" class="insert" readonly=true 
                    value="<?php echo "{$row[4]}"; ?>">
            </td>
            <!--<td>登記日期/時間：-->
                <!--<input type="datetime" name="register_datetime" class="insert" readonly=true-->
                <!--    value="<?php echo $current; ?>">-->
            <!--    <span class="insert"><?php echo $current; ?></span>-->
            <!--</td>-->
            <td>簽證醫師：
                <input type="text" name="visa_doctor" class="insert" readonly=true 
                    value="<?php echo "{$row[5]}"; ?>">
            </td>
            <td>隔離與否：
                <input type="radio" name="isolation" id="isolate_yes" value=1>
                <label for="isolate_yes">是</label>
                <input type="radio" name="isolation" id="isolate_no" value=0>
                <label for="isolate_no">否</label>
            </td>
        </tr>
        <tr>
            <td>連絡電話：
                <input type="tel" name="telephone_number" class="input" maxlength="10" value="0">
            </td>
            <td>預約日期：
                <input type="date" name="reserve_date" class="input" style="width: 120px;">
                <!--<input type="time" name="reserve_time" class="input" style="width: 115px;">-->
            </td>
            <td>離院日期：
                <input type="date" name="discharged_date" class="input" style="width: 110px;">
            </td>
        </tr>
        <tr>
            <td>手機號碼：
                <input type="tel" name="phone_number" class="input" maxlength="10">
            </td>
            <td>預約住院天數：
                <input type="number" name="reserve_days" class="input" min="1" value=null;>
            </td>
        </tr>
        <tr>
            <td>優先順序：
                <select class="input" name="priorities">
                    <option>請選擇順序</option>
                    <option>VIP</option>
                    <option>開刀</option>
                    <option>化療</option>
                </select>
            </td>
            <td>重大傷病：
                <input type="radio" name="severely_injured" id="severe_yes" value=1>
                <label for="severe_yes">是</label>
                <input type="radio" name="severely_injured" id="severe_no" value=0>
                <label for="severe_no">否</label>
            </td>
            <td>簽住公床：
                <input type="radio" name="public_bed" id="public_yes" value=1>
                <label for="public_yes">是</label>
                <input type="radio" name="public_bed" id="public_no" value=0>
                <label for="public_no">否</label>
            </td>
        </tr>
        <tr>
            <td>手術住院：
                <input type="radio" name="operation" id="surgery_yes" value=1>
                <label for="surgery_yes">是</label>
                <input type="radio" name="operation" id="surgery_no" value=0>
                <label for="surgery_no">否</label>
            </td>
            <td>化療住院：
                <input type="radio" name="chemotherapy" id="chemotherapy_yes" value=1>
                <label for="chemotherapy_yes">是</label>
                <input type="radio" name="chemotherapy" id="chemotherapy_no" value=0>
                <label for="chemotherapy_no">否</label>
            </td>
            <td>加護病房：
                <input type="radio" name="ICU" id="intensive_care_yes" value=1>
                <label for="intensive_care_yes">是</label>
                <input type="radio" name="ICU" id="intensive_care_no" value=0>
                <label for="intensive_care_no">否</label>
            </td>
        </tr>
        <tr>
            <td colspan="3">隔離註記：
                <input type="text" name="isolation_note" class="input remark" size="135">
            </td>
        </tr>
        <tr>
            <td colspan="3">備註：
                <input type="text" name="note" class="remark" size="135">
            </td>
        </tr>
    </table>
    <input type="submit" value="確認" class="btn">
    </form>
</main>
<script src="Fscript.js"></script>
</body>
</html>
<?php
    } else {
        echo "<script>alert('索引號填寫錯誤，請重新確認！'); history.back();</script>";
        exit();
    }
    
    // 釋放結果集
    mysqli_free_result($retval);
    // 中斷連接資料庫
    $conn->close();
?>
