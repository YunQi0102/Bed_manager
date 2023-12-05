<?php
    // 資料庫連線
    require_once('../connect.php');
    
    $medical_record_id = $department = $sourse = $patient_name = $gender = $identity = $clinic_number = $visa_doctor = $telephone_number = $phone_number = $reserve_date = $isolation = $reserve_days = $isolation_note = $priorities = $discharged_date = $operation = $chemotherapy = $severely_injured = $ICU = $public_bed = $note = "";
    
    // 從表單獲取資料
    $medical_record_id = $_POST['medical_record_id'];
    $department = $_POST['department'];
    $sourse = $_POST['sourse'];
    $patient_name = $_POST['patient_name'];
    $gender = $_POST['gender'];
    $identity = $_POST['identity'];
    $clinic_number = $_POST['clinic_number'];
    // $register_datetime = $_POST['register_datetime'];
    $visa_doctor = $_POST['visa_doctor'];
    $telephone_number = $_POST['telephone_number'];
    $phone_number = $_POST['phone_number'];
    $reserve_date = $_POST['reserve_date'];
    // $reserve_time = $_POST['reserve_time'];
    $isolation = $_POST['isolation'];
    $reserve_days = $_POST['reserve_days'];
    $isolation_note = $_POST['isolation_note'];
    $priorities = $_POST['priorities'];
    $discharged_date = $_POST['discharged_date'];
    $operation = $_POST['operation'];
    $chemotherapy = $_POST['chemotherapy'];
    $severely_injured = $_POST['severely_injured'];
    $ICU = $_POST['ICU'];
    $public_bed = $_POST['public_bed'];
    $note = $_POST['note'];
    
    // 插進資料庫
    $sql = "INSERT INTO form (medical_record_id, department, sourse, patient_name, gender, identity, clinic_number, visa_doctor, telephone_number, phone_number, reserve_date, isolation, reserve_days, isolation_note, priorities, discharged_date, operation, chemotherapy, severely_injured, ICU, public_bed, note) VALUES ('$medical_record_id','$department','$sourse','$patient_name','$gender','$identity','$clinic_number','$visa_doctor','$telephone_number','$phone_number','$reserve_date','$isolation','$reserve_days','$isolation_note','$priorities','$discharged_date','$operation','$chemotherapy','$severely_injured','$ICU','$public_bed','$note')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('登記成功'); location.href='https://yunqi0102.000webhostapp.com/Home.php';</script>";
    } else {
        echo "<script>alert('登記失敗');</script>" . $conn->error;
    }
    
    // 中斷連接資料庫
    $conn->close();
?>
