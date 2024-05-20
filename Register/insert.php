<?php
    // 資料庫連線
    require_once('../connect.php');

    // 獲取不可為空資料
    $nullunables = array('medical_record_id', 'department', 'sourse', 'patient_name', 'gender', 'identity', 'clinic_number', 'visa_doctor', 'phone_number');
    foreach ($nullunables as $nullunable) {
        ${$nullunable} = isset($_POST[$nullunable]) ? $_POST[$nullunable] : NULL;
    }

    // 獲取可為空資料
    $nullables = array('telephone_number', 'priorities', 'reserve_date', 'discharged_date', 'operation', 'chemotherapy', 'severely_injured', 'ICU', 'public_bed', 'isolation', 'isolation_note', 'note');
    foreach ($nullables as $nullable) {
        ${$nullable} = isset($_POST[$nullable]) ? $_POST[$nullable] : NULL;
    }
    
    // 獲取目前最大的form_id，將AUTO_INCREMENT設置為最大值+1
    $result = $conn->query("SELECT MAX(form_id) AS max_id FROM form");
    $row = $result->fetch_assoc();
    $max_id = $row['max_id'];
    $sql_auto_increment = "ALTER TABLE form AUTO_INCREMENT = ".($max_id + 1);

    if ($conn->query($sql_auto_increment) === TRUE) {

        // 插入資料
        $sql = "INSERT INTO form (medical_record_id, department, sourse, patient_name, gender, identity, clinic_number, visa_doctor, telephone_number, phone_number, priorities, reserve_date, discharged_date, operation, chemotherapy, severely_injured, ICU, public_bed, isolation, isolation_note, note) 
                VALUES ('$medical_record_id','$department','$sourse','$patient_name','$gender','$identity','$clinic_number','$visa_doctor','$telephone_number','$phone_number','$priorities','$reserve_date','$discharged_date','$operation','$chemotherapy','$severely_injured','$ICU','$public_bed','$isolation','$isolation_note','$note')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('登記成功'); location.href='http://localhost/Patient/index.php';</script>";
        } else {
            echo "<script>alert('登記失敗');</script>" . $conn->error;
        }
    } else {
        echo "<script>alert('AUTO_INCREMENT設置失敗');</script>";
    }
    
    // 釋放結果集
    mysqli_free_result($result);

    $conn->close();
?>
