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
    <title>床位管理系統-空床狀況</title>
    <link rel="icon" href="../img/FJUH_icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="emptyBed_style.css">
</head>
<body>
    <div class="empty_bed male">
        <h2>13B013</h2>
    </div>
    <div class="empty_bed male">
        <h2>13B021</h2>
    </div>
    <div class="empty_bed female">
        <h2>13B041</h2>
    </div>
    <div class="empty_bed male">
        <h2>13B053</h2>
    </div>
    <div class="empty_bed male">
        <h2>13B063</h2>
    </div>
    <div class="empty_bed none">
        <h2>13B071</h2>
    </div>
    <div class="empty_bed none">
        <h2>13B073</h2>
    </div>
    <div class="empty_bed female">
        <h2>13B083</h2>
    </div>
    <div class="empty_bed male">
        <h2>13B092</h2>
    </div>
    <div class="empty_bed male">
        <h2>13B103</h2>
    </div>
    <div class="empty_bed female">
        <h2>13B113</h2>
    </div>
    <div class="empty_bed none">
        <h2>13Bnp3</h2>
    </div>
</body>
</html>