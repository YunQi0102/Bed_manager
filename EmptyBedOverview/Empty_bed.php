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
    <?php
        require_once('..\connect.php');

        // 查詢所有空床
        $sql = "SELECT 
                bed_basic.nursing_station,
                bed_basic.ward_num,
                bed_basic.bed_num,
                patients.gender
                FROM bed_basic
                LEFT JOIN patients ON bed_basic.medical_record_id = patients.medical_record_id
                WHERE bed_basic.usable = 1 AND bed_basic.medical_record_id IS NULL";
        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                $bed_number = $row['nursing_station'].str_pad($row['ward_num'], 2, '0', STR_PAD_LEFT).$row['bed_num'];
                $gender_class = 'empty_bed';

                // 查詢該房間其他床位
                $ward_sql = "SELECT patients.gender FROM bed_basic
                            LEFT JOIN patients ON bed_basic.medical_record_id = patients.medical_record_id
                            WHERE (bed_basic.nursing_station = '{$row['nursing_station']}') AND (bed_basic.ward_num = '{$row['ward_num']}') AND (patients.gender IS NOT NULL)
                            LIMIT 1";
                $ward_result = mysqli_query($conn, $ward_sql);

                if ($ward_result->num_rows > 0) {
                    $ward_row = $ward_result->fetch_assoc();
                    
                    if ($ward_row['gender'] === "1") {
                        $gender_class = 'male';
                    } elseif ($ward_row['gender'] === "0") {
                        $gender_class = 'female';
                    }
                }

                echo '<div class="empty_bed '.$gender_class.'">';
                echo '<h2>'.$bed_number.'</h2>';
                echo '</div>';
            }

        } else {
            echo "目前無空床位";
        }
    ?>
</body>
</html>