<?php
// 資料庫連線
require_once('../connect.php');

if (empty($_POST['medical_record_id']) || empty($_POST['department']) || empty($_POST['sourse'])) {
    $alert = "資料有缺漏，請填寫完整。";
    echo "<script>alert('$alert'); history.back();</script>";
    exit();   // 終止程序
};

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
};

// 中斷連接資料庫
$conn->close();
?>