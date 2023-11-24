<?php
    // 資料庫連線
    require_once('../connect.php');

    if (empty($_POST['medical_record_id']) || empty($_POST['department']) || empty($_POST['sourse'])) {
        echo "<script>alert('資料有缺漏，請填寫完整。'); history.back();</script>";
        exit(); // 終止程序
    }
    
    // 從前端獲取資料
    $medical_record_id = $_POST['medical_record_id'];
    $department = $_POST['department'];
    $sourse = $_POST['sourse'];
    
    // 獲取資料
    $sql = "SELECT * FROM patient WHERE (medical_record_id=".$medical_record_id.")";
    $retval = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($retval, MYSQLI_ASSOC);
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
        <h1>輔大醫院</h1>
        <h1 class="subtitle">預約住院登記及處理</h1>
        <div class="current_time"></div>
    </div>
</header>
<main>
    <nav>
        <ul>
            <li><a href="https://yunqi0102.000webhostapp.com/Home/" style="padding-top: 10px;">
                <img src="..\img\LOGO_home.png" width="33px" class="first_img"><img src="..\img\LOGO_home2.png" width="33px" class="second_img"><br><br>首頁</a></li>
            <li><a href="">
                <img src="..\img\LOGO_dashboard.png" width="30px" class="first_img" style="top: 134px; left: 23px;"><img src="..\img\LOGO_dashboard2.png" width="30px" class="second_img" style="top: 134px; left: 23px;"><br><br>儀表板</a></li>
            <li><a href="https://yunqi0102.000webhostapp.com/Register/">
                <img src="..\img\LOGO_register.png" width="33px" class="first_img"><img src="..\img\LOGO_register2.png" width="33px" class="second_img"><br><br>登記</a></li>
            <li><a href="https://yunqi0102.000webhostapp.com/FloorSelect/">
                <img src="..\img\LOGO_bed.png" width="35px" class="first_img" style="left: 20.5px;"><img src="..\img\LOGO_bed2.png" width="35px" class="second_img" style="left: 20.5px;"><br><br>病床</a></li>
            <p>最後更新<br><span class="update_date"></span><br><span class="update_time"></span></p>
        </ul>
    </nav>
    <form class="out">
    <p>基本資料</p>
    <table>
        <tr>
<?php
    echo "<td>索引號：{$medical_record_id}</td>".
         "<td>病患來源：{$sourse}</td>".
         "<td>科別：{$department}</td>";
?>
        </tr>
        <tr>
<?php
    echo "<td>病患姓名：{$row["name"]}</td>".
         "<td>性別：{$row["gender"]}</td>".
         "<td>身份：{$row["identity"]}</td>"
?>
        </tr>
        <tr>
<?php
    echo "<td>就診號：{$row["clinic_number"]}</td>"
?>
        <td>登記日期/時間：<span class="update_date"></span></td>
<?php
    echo "<td>簽證醫師：{$row["doctor"]}</td>"
?>
        </tr>
        <tr>
            <td>連絡電話：
                <input type="tel" class="input" maxlength="10">
            </td>
            <td>預約日期/時間：
                <input type="date" class="input" style="width: 120px;">
                <input type="time" class="input" style="width: 115px;">
            </td>
            <td>隔離與否：
                <input type="radio" name="isolate" id="isolate_yes">
                <label for="isolate_yes">是</label>
                <input type="radio" name="isolate" id="isolate_no">
                <label for="isolate_no">否</label>
            </td>
        </tr>
        <tr>
            <td>手機號碼：
                <input type="tel" class="input" maxlength="10">
            </td>
            <td>預約住院天數：
                <input type="number" class="input" min="1">
            </td>
            <td rowspan="2">隔離註記：
                <input type="text" class="input remark" style="width: 290px;">
            </td>
        </tr>
        <tr>
            <td>優先順序：
                <select class="input">
                    <option>請選擇順序</option>
                    <option>VIP</option>
                    <option>開刀</option>
                    <option>化療</option>
                </select>
            </td>
            <td>離院日期：
                <input type="date" class="input" style="width: 110px;">
            </td>
        </tr>
        <tr>
            <td style="width: 30%;">手術住院：
                <input type="radio" name="surgery" id="surgery_yes">
                <label for="surgery_yes">是</label>
                <input type="radio" name="surgery" id="surgery_no">
                <label for="surgery_no">否</label>
            </td>
            <td>重大傷病：
                <input type="radio" name="severe" id="severe_yes">
                <label for="severe_yes">是</label>
                <input type="radio" name="severe" id="severe_no">
                <label for="severe_no">否</label>
            </td>
            <td style="width: 30%;">簽住公床：
                <input type="radio" name="public" id="public_yes">
                <label for="public_yes">是</label>
                <input type="radio" name="public" id="public_no">
                <label for="public_no">否</label>
            </td>
        </tr>
        <tr>
            <td>化療住院：
                <input type="radio" name="chemotherapy" id="chemotherapy_yes">
                <label for="chemotherapy_yes">是</label>
                <input type="radio" name="chemotherapy" id="chemotherapy_no">
                <label for="chemotherapy_no">否</label>
            </td>
            <td>加護病房：
                <input type="radio" name="intensive_care" id="intensive_care_yes">
                <label for="intensive_care_yes">是</label>
                <input type="radio" name="intensive_care" id="intensive_care_no">
                <label for="intensive_care_no">否</label>
            </td>
        </tr>
        <tr>
            <td colspan="3">備註：
                <input type="text" class="remark" size="135">
            </td>
        </tr>
    </table>
    <input type="submit" value="確認" class="btn" onclick="location.href='https://yunqi0102.000webhostapp.com/Home/'">
    </form>
</main>
<script src="Fscript.js"></script>
</body>
</html>
<?php
    // 中斷連接資料庫
    $conn->close();
?>