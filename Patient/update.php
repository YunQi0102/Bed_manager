<?php
    require_once('..\connect.php');

    // 獲取 JSON 格式的請求體
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['order']) && is_array($data['order'])) {
        $order = $data['order'];
        
        foreach ($order as $index => $id) {
            $sql = "UPDATE list SET display_order = ? WHERE form_id = ?";
            $stmt = $conn->prepare($sql);
            // 將索引和 ID 綁定到 prepared statement 的參數
            $stmt->bind_param("ii", $index, $id);
            $stmt->execute();
        }
        
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    $conn->close();
?>