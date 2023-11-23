<?php
// 連接資料庫
$servername = "localhost";
$username = "id21555547_zyq";
$password = "Qi0102qi.";
$dbname = "id21555547_bedmanager";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

// 從前端獲取資料
$medical_record_id = $_POST['medical_record_id'];
$department = $_POST['department'];
$sourse = $_POST['sourse'];

// 插入資料表
$sql = "INSERT INTO register (medical_record_id, department, sourse) VALUES ('$medical_record_id', '$department', '$sourse')";

if ($conn->query($sql) === TRUE) {
    header("Location: https://yunqi0102.000webhostapp.com/Form/");
} else {
    $alert = "插入資料失敗";
    echo "<script>alert('$alert');</script>" . $conn->error;
}

// 中斷連接資料庫
$conn->close();
?>