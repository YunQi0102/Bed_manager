<?php 
    require_once('..\connect.php');

    $sql = "SELECT 
            CASE 
            WHEN ICU = '是' THEN '加護'
            ELSE '一般'
            END as icu_status, 
            COUNT(*) as total_count 
            FROM list 
            GROUP BY icu_status";
    
    $result = $conn->query($sql);
    
    $data = array();
    if ($result->num_rows > 0) {
        // 輸出每行數據
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    } 
    $conn->close();

    // 將資料轉換為JSON格式
    header('Content-Type: application/json');
    echo json_encode($data);
?>