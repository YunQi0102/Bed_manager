<?php
    session_start();

    // 檢查使用者是否已登入
    if (!isset($_SESSION['account'])) {
        // 若使用者未登入，定向到登入頁面
        header("Location: http://localhost");
        exit();
    }

    // 確認使用者的身份
    if ($_SESSION['identity'] !== "醫師") {
        // 若使用者為住中，因無此頁使用權限只能回到首頁
        header("Location: http://localhost/Home.php");
        exit();
    }

    $account = $_SESSION['account'];
    $identity = $_SESSION['identity'];

    // 資料庫連線
    require_once('../connect.php');
    
    // 從表單獲取資料
    $medical_record_id = $_POST['medical_record_id'];
    $department = $_POST['department'];
    $sourse = $_POST['sourse'];
    
    if(empty($_POST['medical_record_id']) || empty($_POST['department']) || empty($_POST['sourse'])) {
        echo "<script>alert('資料有缺漏，請填寫完整。'); history.back();</script>";
        exit(); // 終止程序
    }

    $db_check = "SELECT * FROM form WHERE (medical_record_id = '$medical_record_id')";
    $check_result = mysqli_query($conn, $db_check);
    $form_row = mysqli_fetch_array($check_result);
    
    if($form_row) {
        if($_POST['medical_record_id'] == $form_row['medical_record_id']) {
            echo "<script>alert('此病人已登記過，請重新確認索引號。'); history.back();</script>";
            exit(); // 終止程序
        }
    }

    // 從資料庫查詢資料
    $sql = "SELECT * FROM patients WHERE (medical_record_id = '$medical_record_id')";
    $retval = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($retval);

    if($row) {
        $Usql = "SELECT * FROM users WHERE (account = '$account')";
        $Uretval = mysqli_query($conn, $Usql);
        $Urow = mysqli_fetch_array($Uretval);
        
        if($Urow) {
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <title>床位管理系統-住院登記</title>
    <link rel="icon" href="../img/FJUH_icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="Fstyle.css">
</head>
<body>
<header>
    <div>
        <img src="..\img\FJUHlogo.jpg" alt="a hospital's logo">
        <h1>輔大醫院-床位管理系統</h1>
        <div class="current_time"></div>
        <div class="logout">
            <a href="..\logout.php"><img src="..\img\logout.png"></a>
        </div>
        <h1 class="subtitle">預約住院登記及處理</h1>
    </div>
</header>
<main>
    <nav>
        <ul>
        <li><a href="http://localhost/Home.php" style="padding-top: 10px;">
                <img src="..\img\LOGO_home.png" width="33px" class="first_img"><img src="..\img\LOGO_home2.png" width="33px" class="second_img"><br><br>首頁</a></li>
            <li><a href="http://localhost/Dashboard/Index.php">
                <img src="..\img\LOGO_dashboard.png" width="30px" class="first_img" style="top: 134px; left: 23px;"><img src="..\img\LOGO_dashboard2.png" width="30px" class="second_img" style="top: 134px; left: 23px;"><br><br>儀表板</a></li>
            <li><a href="http://localhost/Register/Index.php">
                <img src="..\img\LOGO_register.png" width="33px" class="first_img"><img src="..\img\LOGO_register2.png" width="33px" class="second_img"><br><br>登記</a></li>
            <li><a href="http://localhost/FloorSelect/Index.php">
                <img src="..\img\LOGO_bed.png" width="35px" class="first_img" style="left: 20.5px;"><img src="..\img\LOGO_bed2.png" width="35px" class="second_img" style="left: 20.5px;"><br><br>病床</a></li>
            <li><a href="http://localhost/Patient/Index.php">
                <img src="..\img\LOGO_patient.png" width="35px" class="first_img" style="left: 20.5px;"><img src="..\img\LOGO_patient2.png" width="35px" class="second_img" style="left: 20.5px;"><br><br>名單</a></li>
            <p class="user"><u><?php echo $identity; ?><br><?php echo $Urow['user_name'];} ?></u></p>
            <p>最後更新<span class="update_date"></span><br><span class="update_time"></span></p>
        </ul>
    </nav>
    <form class="out" action="insert.php" method="post">
    <p>基本資料</p>
    <table>
        <tr>
            <td style="width: 35%;">索引號：
                <input type="number" name="medical_record_id" class="insert" readonly=true 
                    value="<?php echo $medical_record_id; ?>">
            </td>
            <td style="width: 35%;">病患來源：
                <input type="text" name="sourse" class="insert" readonly=true 
                    value="<?php echo $sourse; ?>">
            </td>
            <td style="width: 30%;">科別：
                <input type="text" name="department" class="insert" readonly=true 
                    value="<?php echo $department; ?>">
            </td>
        </tr>
        <tr>
            <td>病患姓名：
                <input type="text" name="patient_name" class="insert" readonly=true 
                    value="<?php echo $row['name']; ?>">
            </td>
            <td>性別：
                <input type="text" name="gender" class="insert" readonly=true 
                    value="<?php if($row['gender'] == 1) { echo "男"; } else { echo "女"; } ?>">
            </td>
            <td>身份：
                <input type="text" name="identity" class="insert" readonly=true 
                    value="<?php echo $row['identity']; ?>">
            </td>
        </tr>
        <tr>
            <td>就診號：
                <input type="number" name="clinic_number" class="insert" readonly=true 
                    value="<?php echo $row['clinic_number']; ?>">
            </td>
            <td>簽證醫師：
                <input type="text" name="visa_doctor" class="insert" readonly=true 
                    value="<?php echo $row['doctor']; ?>">
            </td>
        </tr>
        <tr>
            <td>連絡電話：
                <input type="tel" name="telephone_number" class="input" maxlength="10" autocomplete="off" value="<?php echo $row['telephone_number']; ?>">
            </td>
            <td>登記住院日：
                <input type="date" name="reserve_date" class="input" style="width: 120px;">
            </td>
            <td>優先順序：
                <select class="input" name="priorities">
                    <option disabled selected>請選擇順序</option>
                    <option>VIP</option>
                    <option>開刀</option>
                    <option>化療</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>手機號碼：
                <input type="tel" name="phone_number" class="input" maxlength="10" autocomplete="off" value="<?php echo $row['phone_number']; ?>">
            </td>
            <td>登記出院日：
                <input type="date" name="discharged_date" class="input" style="width: 120px;">
            </td>
        </tr>
        <tr>
            <td>隔離與否：
                <input type="radio" name="isolation" id="isolate_yes" value="是">
                <label for="isolate_yes">是</label>
                <input type="radio" name="isolation" id="isolate_no" value="否" checked="true">
                <label for="isolate_no">否</label>
            </td>
            <td>重大傷病：
                <input type="radio" name="severely_injured" id="severe_yes" value="是">
                <label for="severe_yes">是</label>
                <input type="radio" name="severely_injured" id="severe_no" value="否" checked="true">
                <label for="severe_no">否</label>
            </td>
            <td>加護病房：
                <input type="radio" name="ICU" id="intensive_care_yes" value="是">
                <label for="intensive_care_yes">是</label>
                <input type="radio" name="ICU" id="intensive_care_no" value="否" checked="true">
                <label for="intensive_care_no">否</label>
            </td>
        </tr>
        <tr>
            <td>簽住公床：
                <input type="radio" name="public_bed" id="public_yes" value="是">
                <label for="public_yes">是</label>
                <input type="radio" name="public_bed" id="public_no" value="否" checked="true">
                <label for="public_no">否</label>
            </td>
            <td>手術住院：
                <input type="radio" name="operation" id="surgery_yes" value="是">
                <label for="surgery_yes">是</label>
                <input type="radio" name="operation" id="surgery_no" value="否" checked="true">
                <label for="surgery_no">否</label>
            </td>
            <td>化療住院：
                <input type="radio" name="chemotherapy" id="chemotherapy_yes" value="是">
                <label for="chemotherapy_yes">是</label>
                <input type="radio" name="chemotherapy" id="chemotherapy_no" value="否" checked="true">
                <label for="chemotherapy_no">否</label>
            </td>
        </tr>
        <tr>
            <td>隔離註記：
                <textarea name="isolation_note" class="input remark_iso" rows="3" autocomplete="off"></textarea>
            </td>
            <td colspan="2">備註：
                <textarea name="note" class="input remark" rows="3" autocomplete="off"></textarea>
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
    
    $conn->close();
?>
