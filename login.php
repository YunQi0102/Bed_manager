<?php
    // 資料庫連線
    require_once('connect.php');

    $account = $_POST['account'];
    $password = $_POST['password'];
    
    if (empty($_POST['account']) || empty($_POST['password'])) {
        echo "<script>alert('請輸入帳號及密碼。'); history.back();</script>";
        exit(); // 終止程序
    }
    
    $sql = "SELECT * FROM login WHERE (account = '$account' AND password = '$password')";
    $retval = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($retval);  

    if($row) {
        header('Location: Home.html');
    } else {
        echo "<script>alert('帳號或密碼有誤，請重新確認！'); history.back();</script>";
        exit(); // 終止程序
    }
    
    // 釋放結果集
    mysqli_free_result($retval);
    // 中斷連接資料庫
    $conn->close();
?>