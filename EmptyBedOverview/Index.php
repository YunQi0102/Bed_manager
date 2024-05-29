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

    $medical_record_id = isset($_GET['medical_record_id']) ? $_GET['medical_record_id'] : null;

    if ($medical_record_id === null) {
        die("未提供病歷號");
    }
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <title>床位管理系統-床位安排</title>
    <link rel="icon" href="../img/FJUH_icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <script>
        function openBedOverview(floor) {
            var medicalRecordId = "<?php echo $medical_record_id; ?>";
            window.location.href = 'http://localhost/EmptyBedOverview/Empty_bed.php?medical_record_id=' + medicalRecordId + '&floor=' + floor;
        }
    </script>
</head>
<body>
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
        <button onclick="openBedOverview('13B')">13B</button>
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
    </div>
</body>
</html>