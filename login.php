<?php
    session_start();

    function authenticateUser($account, $password) {
        // 資料庫連線
        require_once('connect.php');

        $account = $_POST['account'];
        $password = $_POST['password'];

        if (empty($_POST['account']) || empty($_POST['password'])) {
            echo "<script>alert('請輸入帳號及密碼。'); history.back();</script>";
            exit(); // 終止程序
        }

        $sql = "SELECT * FROM users WHERE (account = '$account' AND password = '$password')";
        $retval = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($retval);
        
        // 用戶驗證成功返回true
        if ($row) {
            $_SESSION['account'] = $row['account'];
            $_SESSION['identity'] = $row['user_identity'];
            return true;
        } else {
            echo "<script>alert('帳號或密碼有誤，請重新確認！'); history.back();</script>";
            exit(); // 終止程序
        }
        $conn->close();
    }

    // 處理登入表單提交
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $account = $_POST['account'];
        $password = $_POST['password'];

        if (authenticateUser($account, $password)) {
            header("Location: Home.php");
            exit();
        }
    }
?>