<?php
    function authenticateUser($account, $password) {
        // 資料庫連線
        require_once('connect.php');
        session_start();

        $account = $_POST['account'];
        $password = $_POST['password'];

        if (empty($_POST['account']) || empty($_POST['password'])) {
            echo "<script>alert('請輸入帳號及密碼。'); history.back();</script>";
            exit(); // 終止程序
        }

        $sql = "SELECT * FROM users WHERE (account = '$account' AND password = '$password')";
        $retval = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($retval);
        
        // 返回 true 表示用戶驗證成功，否則返回 false
        if ($row) {
            if ($row['user_identity'] === "醫師") {
                $_SESSION['account'] = $account;
                $_SESSION['identity'] = "doctor";
                return true;
            } elseif ($row['user_identity'] === "住中") {
                $_SESSION['account'] = $account;
                $_SESSION['identity'] = "inpatient_center";
                return true;
            } else {
                return false;
            }
        } else {
            echo "<script>alert('帳號或密碼有誤，請重新確認！'); history.back();</script>";
            exit(); // 終止程序
        }
    }

    // 處理登入表單提交
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $account = $_POST['account'];
        $password = $_POST['password'];

        if (authenticateUser($account, $password)) {        
            // 登入成功，根據用戶身份關閉不同按鈕
            if ($_SESSION['identity'] === "doctor" || $_SESSION['identity'] === "inpatient_center") {
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <title>床位管理系統-首頁</title>
    <link rel="icon" href="../img/FJUH_icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="Hstyle.css">
</head>
<body>
<header>
    <div>
        <img src="..\img\FJUHlogo.jpg" alt="a hospital's logo">
        <h1>輔大醫院-床位管理系統</h1>
        <h1 class="subtitle">首頁</h1>
        <div class="current_time"></div>
    </div>
</header>
<main>
    <table>
        <tr>
            <td><button class="one"><span>床位儀表板</span>
                <input type="image" src="..\img\dashboard.png" width="180px" style="border-radius: 10px;"></button></td>
            <td><button class="two" <?php if (isset($_SESSION['identity'])) {
                if ($_SESSION['identity'] === "inpatient_center") {
                    echo "disabled id="."disabled";} ?> ><span>床位登記</span>
                <input type="image" src="..\img\register.png" width="155px" style="border-radius: 10px;"></button></td>
            <td><button class="three" <?php 
                if ($_SESSION['identity'] === "doctor") {
                    echo "disabled id="."disabled";} ?> ><span>床位查詢</span>
                <input type="image" src="..\img\search.png" width="140px" style="border-radius: 10px;"></button></td>
            <td><button class="four" <?php 
                if ($_SESSION['identity'] === "doctor") {
                    echo "disabled id="."disabled";}} ?> ><span>待床/控床清單</span>
                <input type="image" src="..\img\list.png" width="100px" style="border-radius: 10px;"></button></td>
        </tr>
    </table>
</main>
<script src="Hscript.js"></script>
</body>
</html>

<?php
                exit();
            }
        }
    }
?>