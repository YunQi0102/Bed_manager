<?php
$servername = "localhost";
$username = "id21555547_zyq";
$password = "Qi0102qi.";
$dbname = "id21555547_bedmanager";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
};
?>