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

    $account = $_SESSION['account'];
    $identity = $_SESSION['identity'];

    // 資料庫連線
    require_once('..\connect.php');

    $Usql = "SELECT * FROM users WHERE (account = '$account')";
    $Uretval = mysqli_query($conn, $Usql);
    $Urow = mysqli_fetch_array($Uretval);
    
    if($Urow) {
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <title>床位管理系統-床位狀況</title>
    <link rel="icon" href="../img/FJUH_icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div>
        <img src="..\img\FJUHlogo.jpg" alt="a hospital's logo">
        <h1>輔大醫院-床位管理系統</h1>
        <div class="current_time"></div>
        <div class="logout">
            <a href="..\logout.php"><img src="..\img\logout.png"></a>
        </div>
        <h1 class="subtitle">13B03</h1>
    </div>
</header>
<main>
    <nav>
        <ul>
            <li><a href="http://localhost/Home.php" style="padding-top: 10px;">
                <img src="..\img\LOGO_home.png" width="33px" class="first_img"><img src="..\img\LOGO_home2.png" width="33px" class="second_img"><br><br>首頁</a></li>
            <li><a href="http://localhost/Dashboard/Index.php">
                <img src="..\img\LOGO_dashboard.png" width="30px" class="first_img" style="top: 134px; left: 23px;"><img src="..\img\LOGO_dashboard2.png" width="30px" class="second_img" style="top: 134px; left: 23px;"><br><br>儀表板</a></li>
            <li><a href="http://localhost/Register/Index.php">
                <img src="..\img\LOGO_register.png" width="33px" class="first_img"><img src="..\img\LOGO_register2.png" width="33px" class="second_img"><br><br>登記</a></li>
            <li><a href="http://localhost/FloorSelect/Index.php">
                <img src="..\img\LOGO_bed.png" width="35px" class="first_img" style="left: 20.5px;"><img src="..\img\LOGO_bed2.png" width="35px" class="second_img" style="left: 20.5px;"><br><br>病床</a></li>
            <li><a href="http://localhost/Patient/Index.php">
                <img src="..\img\LOGO_patient.png" width="35px" class="first_img" style="left: 20.5px;"><img src="..\img\LOGO_patient2.png" width="35px" class="second_img" style="left: 20.5px;"><br><br>名單</a></li>
            <p class="user"><u><?php echo $identity; ?><br><?php echo $Urow['user_name'];} ?></u></p>
            <p>最後更新<span class="update_date"></span><br><span class="update_time"></span></p>
        </ul>
    </nav>
    <?php 
        $sql = "SELECT 
                bed_basic.nursing_station,
                bed_basic.ward_num,
                bed_basic.bed_num,
                bed_basic.usable,
                bed_basic.medical_record_id,
                form.department,
                form.visa_doctor,
                form.reserve_date,
                form.discharged_date,
                form.priorities,
                patients.name,
                patients.gender,
                patients.id_card,
                patients.phone_number
                FROM bed_basic
                LEFT JOIN patients ON bed_basic.medical_record_id = patients.medical_record_id
                LEFT JOIN form ON patients.medical_record_id = form.medical_record_id
                WHERE (bed_basic.nursing_station = '13B' AND bed_basic.ward_num = '03')";
        $retval = mysqli_query($conn, $sql);

        if ($retval->num_rows > 0) {
    ?>
    <div class="status">
    <?php 
            while($row = $retval->fetch_assoc()) {

            $bed_number = $row['nursing_station'].str_pad($row['ward_num'], 2, '0', STR_PAD_LEFT).$row['bed_num'];
                
                if ($row['usable']==="0") {
                    echo '<div class="disable_bed">';
                    echo '<h2>'.$bed_number.'</h2>';
                    echo '<h3>未開放床位</h3>';
                    echo '</div>';
                } elseif ($row['usable']==="1" && is_null($row['name'])) {
                    echo '<div class="empty_bed">';
                    echo '<h2>'.$bed_number.'</h2>';
                    echo '<h3>空床</h3>';
                    echo '</div>';
                } else {
                    echo '<div class="bed">';
                    if ($row['gender']==="1") { echo '<h2 class="male">'.$bed_number.'</h2>'; }
                    elseif ($row['gender']==="0") { echo '<h2 class="female">'.$bed_number.'</h2>'; }
                    echo '<h3>'.$row['name'].' <span class="dept">'.$row['department'].'</span></h3>';
                    echo '<table>';
                    echo '<tr><td><b>主治：</b>'.$row['visa_doctor'].'醫師</td><td><b>病歷號：</b>'.$row['medical_record_id'].'</td></tr>';
                    echo '<tr><td><b>入院日：</b>'.$row['reserve_date'].'</td><td><b>身分證：</b>'.$row['id_card'].'</td></tr>';
                    echo '<tr><td><b>出院日：</b>'.$row['discharged_date'].'</td><td><b>電話：</b>'.$row['phone_number'].'</td></tr>';
                    echo '</table><hr>';
                    echo '<h3 class="note"># '.$row['priorities'].'</h3>';
                    echo '</div>';
                }
            }
            echo '</div>';
        } else {
            echo "沒有資料";
        }
        $conn->close();
    ?>
</main>
<script src="script.js"></script>
</body>
</html>