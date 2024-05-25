<?php 
    require_once('..\connect.php');

    $sql = "SELECT 
            department, 
            COUNT(*) as total_count 
            FROM `list` 
            GROUP BY department";
    
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