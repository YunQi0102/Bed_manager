<?php 
    require_once('..\connect.php');

    $sql = "SELECT 
            CASE 
            WHEN form_id IS NULL OR form_id = '' THEN 'Empty' 
            ELSE 'Not Empty' 
            END as form_status, 
            COUNT(*) as total_count 
            FROM bed_basic 
            WHERE usable = '1'
            GROUP BY form_status";
    
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