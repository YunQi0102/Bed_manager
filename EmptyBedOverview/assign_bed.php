<?php
    session_start();

    // 檢查使用者是否已登入
    if (!isset($_SESSION['account'])) {
        header("Location: http://localhost");
        exit();
    }

    // 確認使用者的身份
    if ($_SESSION['identity'] !== "住中") {
        header("Location: http://localhost/Home.php");
        exit();
    }

    require_once('..\connect.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $medical_record_id = $_POST['medical_record_id'];
        $bed_number = $_POST['bed_number'];

        // 確認參數是否存在
        if (empty($medical_record_id) || empty($bed_number)) {
            die("Invalid input");
        }

        // 更新床位資訊
        $sql = "UPDATE bed_basic
                SET medical_record_id = ?, usable = 1
                WHERE CONCAT(nursing_station, LPAD(ward_num, 2, '0'), bed_num) = ? AND usable = 1";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $medical_record_id, $bed_number);

        if ($stmt->execute()) {
            // 床位分配成功
            echo "<script>
                    alert('排床成功');
                    window.opener.location.href = 'http://localhost/WardOverview/index.php';
                    window.close();
                </script>";
        } else {
            // 分配病床時發生錯誤
            echo "<script>
                    alert('排床失敗: " . addslashes($stmt->error) . "');
                    window.opener.location.reload(); // 刷新主視窗
                    window.close();
                </script>";
        }

        $stmt->close();
        $conn->close();
    } else {
        die("Invalid request method");
    }
?>