<?php
    session_start();

    // 檢查使用者是否已登入
    if (!isset($_SESSION['account'])) {
        // 若使用者未登入，定向到登入頁面
        header("Location: http://localhost");
        exit();
    }

    // 確認使用者的身份
    if ($_SESSION['identity'] !== "住中") {
        // 若使用者為醫師，因無此頁使用權限只能回到首頁
        header("Location: http://localhost/Home.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <title>床位管理系統-床位狀況</title>
    <link rel="icon" href="../img/FJUH_icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
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
        <h1 class="subtitle">13B01</h1>
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
            <p>最後更新<span class="update_date"></span><br><span class="update_time"></span></p>
        </ul>
    </nav>
    <div class="status">
        <div class="bed">
            <h2 class="male">13B011</h2>
            <h3>郭宏儒 <span class="dept">神經外科</span></h3>
            <table>
                <tr>
                    <td>主治：許亦晴醫師</td>
                    <td>病歷號：421542</td>
                </tr>
                <tr>
                    <td>入院日：2024/02/01</td>
                    <td>身分證：P124720842</td>
                </tr>
                <tr>
                    <td>出院日：2024/06/23</td>
                    <td>電話：0954154251</td>
                </tr>
            </table>
            <h3 class="note"><span class="surg">手術</span></h3>
        </div>

        <div class="bed">
            <h2 class="male">13B012</h2>
            <h3>張彥霖 <span class="dept">神經外科</span></h3>
            <table>
                <tr>
                    <td>主治：許亦晴醫師</td>
                    <td>病歷號：125412</td>
                </tr>
                <tr>
                    <td>入院日：2024/03/14</td>
                    <td>身分證：A137331777</td>
                </tr>
                <tr>
                    <td>出院日：2024/06/04</td>
                    <td>電話：0954154251</td>
                </tr>
            </table>
            <h3 class="note"><span class="chem">化療</span></h3>
        </div>
        <div class="empty_bed">
            <h2 class="female">13B013</h2>
            <h3>空床</h3>
        </div>
    </div>
</main>
<script src="script.js"></script>
</body>
</html>