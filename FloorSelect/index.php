<?php
    session_start();

    // 檢查使用者是否已登入
    if (!isset($_SESSION['account'])) {
        // 如果使用者未登入，重定向到登入頁面
        header("Location: login.php");
        exit();
    }

    // 確認使用者的身份
    if ($_SESSION['identity'] !== "inpatient_center") {
        // 如果使用者身份不符合要求，重定向到適當的頁面
        // echo "<script>alert('您無瀏覽此頁面之權限，將為你轉至首頁'); </script>";
        header("Location: http://localhost/Home_doctor.html");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <title>床位管理系統-樓層選擇</title>
    <link rel="icon" href="../img/FJUH_icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div>
        <img src="..\img\FJUHlogo.jpg" alt="a hospital's logo">
        <h1>輔大醫院-床位管理系統</h1>
        <h1 class="subtitle">病房狀況查詢</h1>
        <div class="current_time"></div>
    </div>
</header>
<main>
    <nav>
        <ul>
            <li><a href="http://localhost/Home.html" style="padding-top: 10px;">
                <img src="..\img\LOGO_home.png" width="33px" class="first_img"><img src="..\img\LOGO_home2.png" width="33px" class="second_img"><br><br>首頁</a></li>
            <li><a href="#">
                <img src="..\img\LOGO_dashboard.png" width="30px" class="first_img" style="top: 134px; left: 23px;"><img src="..\img\LOGO_dashboard2.png" width="30px" class="second_img" style="top: 134px; left: 23px;"><br><br>儀表板</a></li>
            <li><a href="http://localhost/Register/index.php">
                <img src="..\img\LOGO_register.png" width="33px" class="first_img"><img src="..\img\LOGO_register2.png" width="33px" class="second_img"><br><br>登記</a></li>
            <li><a href="http://localhost/FloorSelect/index.php">
                <img src="..\img\LOGO_bed.png" width="35px" class="first_img" style="left: 20.5px;"><img src="..\img\LOGO_bed2.png" width="35px" class="second_img" style="left: 20.5px;"><br><br>病床</a></li>
            <li><a href="http://localhost/Patient/index.php">
                <img src="..\img\LOGO_patient.png" width="35px" class="first_img" style="left: 20.5px;"><img src="..\img\LOGO_patient2.png" width="35px" class="second_img" style="left: 20.5px;"><br><br>名單</a></li>
            <p>最後更新<span class="update_date"></span><br><span class="update_time"></span></p>
        </ul>
    </nav>
    <div>
        <button>7A</button>
        <button>8A</button>
        <button>8B</button>
        <button>9A</button>
        <button>9B</button>
        <button>10A</button>
        <button>10B</button>
        <button>11A</button>
        <button>11B</button>
        <button>12A</button>
        <button>12B</button>
        <button class="btn">13B</button>
        <button>15A</button>
        <button>3A</button>
        <button>12AG</button>
        <button>14A</button>
        <button>SICU</button>
        <button>MICU</button>
        <button>NICU </button>
        <button>NBC</button>
        <button>PICU</button>
        <button>BR</button>
        <button>AII</button>
        <button>POR</button>
        <button>TEST</button>
    </div>
</main>
<script src="script.js"></script>
</body>
</html>