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
    <title>床位管理系統-病床總覽</title>
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
        <h1 class="subtitle">病床總覽 13B</h1>
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
        // 資料庫連線
        require_once('../connect.php');
        
        // 設定全部床位資訊
        $beds = array();
        for ($ward_num = 1; $ward_num <= 11; $ward_num++) {
            for ($bed_num = 1; $bed_num <= 3; $bed_num++) {
                $beds[] = array("nursing_station" => "13B", "ward_num" => $ward_num, "bed_num" => $bed_num);
            }
        }
        array_push($beds, array("nursing_station" => "13B", "ward_num" => 12, "bed_num" => 1));
        array_push($beds, array("nursing_station" => "13B", "ward_num" => 13, "bed_num" => 1));
        array_push($beds, array("nursing_station" => "13B", "ward_num" => 14, "bed_num" => 1));
        
        // 定義函數
        function bedControler($conn, $nursing_station, $ward_num, $bed_num) {
            $sql = "SELECT * FROM bed_basic 
                    WHERE nursing_station = '$nursing_station' AND ward_num = $ward_num AND bed_num = $bed_num";
            $result = $conn->query($sql);
        
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $usable = $row['usable'];
                if ($usable == 1) {     // 床位可用
                    $form_id = $row['form_id'];
                    if ($form_id != null) {
                        $form_query = "SELECT patient_name, discharged_date, gender FROM form WHERE form_id = $form_id";
                        $form_result = $conn->query($form_query);
                        if ($form_result->num_rows > 0) {
                            $form_row = $form_result->fetch_assoc();
                            $patient_name = $form_row['patient_name'];
                            $discharged_date = $form_row['discharged_date'];
                            $gender = $form_row['gender'];
                            if ($gender == "男性") {
                                echo "<button style='background-color: #BBE7FF;'>$patient_name<br>$discharged_date</button>";
                            } else {
                                echo "<button style='background-color: #FFBBE5;'>$patient_name<br>$discharged_date</button>";
                            }
                        }
                    } else {
                        echo "<button style='background-color: white;'></button>";
                    }
                } else {    // 床位不可用
                    echo "<button style='background-color: #d6d6d6;'></button>";
                }
                $result->free();
            } else {
                echo "找不到床位資訊";
            }
        }
    ?>
    <div class="out">
        <div class="div1">
            <button class="ward_num btn1">13B01</button>
            <?php
                $start_index = 0;
                $end_index = 2;
                
                // 迴圈處理床位資訊
                for ($i = $start_index; $i <= $end_index; $i++) {
                    $nursing_station = $beds[$i]['nursing_station'];
                    $ward_num = $beds[$i]['ward_num'];
                    $bed_num = $beds[$i]['bed_num'];
                    bedControler($conn, $nursing_station, $ward_num, $bed_num);
                }
            ?>
        </div>
        <div class="div1">
            <button class="ward_num">13B02</button>
            <?php
                $start_index = 3;
                $end_index = 5;
                
                // 迴圈處理床位資訊
                for ($i = $start_index; $i <= $end_index; $i++) {
                    $nursing_station = $beds[$i]['nursing_station'];
                    $ward_num = $beds[$i]['ward_num'];
                    $bed_num = $beds[$i]['bed_num'];
                    bedControler($conn, $nursing_station, $ward_num, $bed_num);
                }
            ?>
        </div>
        <div class="div1">
            <button class="ward_num btn3">13B03</button>
            <?php
                $start_index = 6;
                $end_index = 8;
                
                // 迴圈處理床位資訊
                for ($i = $start_index; $i <= $end_index; $i++) {
                    $nursing_station = $beds[$i]['nursing_station'];
                    $ward_num = $beds[$i]['ward_num'];
                    $bed_num = $beds[$i]['bed_num'];
                    bedControler($conn, $nursing_station, $ward_num, $bed_num);
                }
            ?>
        </div>
        <div class="div1">
            <button class="ward_num">13B04</button>
            <?php
                $start_index = 9;
                $end_index = 11;
                
                // 迴圈處理床位資訊
                for ($i = $start_index; $i <= $end_index; $i++) {
                    $nursing_station = $beds[$i]['nursing_station'];
                    $ward_num = $beds[$i]['ward_num'];
                    $bed_num = $beds[$i]['bed_num'];
                    bedControler($conn, $nursing_station, $ward_num, $bed_num);
                }
            ?>
        </div>
        <div class="div1">
            <button class="ward_num">13B05</button>
            <?php
                $start_index = 12;
                $end_index = 14;
                
                // 迴圈處理床位資訊
                for ($i = $start_index; $i <= $end_index; $i++) {
                    $nursing_station = $beds[$i]['nursing_station'];
                    $ward_num = $beds[$i]['ward_num'];
                    $bed_num = $beds[$i]['bed_num'];
                    bedControler($conn, $nursing_station, $ward_num, $bed_num);
                }
            ?>
        </div>
        <div class="div1">
            <button class="ward_num">13B06</button>
            <?php
                $start_index = 15;
                $end_index = 17;
                
                // 迴圈處理床位資訊
                for ($i = $start_index; $i <= $end_index; $i++) {
                    $nursing_station = $beds[$i]['nursing_station'];
                    $ward_num = $beds[$i]['ward_num'];
                    $bed_num = $beds[$i]['bed_num'];
                    bedControler($conn, $nursing_station, $ward_num, $bed_num);
                }
            ?>
        </div>
        <div class="div1">
            <button class="ward_num">13B07</button>
            <?php
                $start_index = 18;
                $end_index = 20;
                
                // 迴圈處理床位資訊
                for ($i = $start_index; $i <= $end_index; $i++) {
                    $nursing_station = $beds[$i]['nursing_station'];
                    $ward_num = $beds[$i]['ward_num'];
                    $bed_num = $beds[$i]['bed_num'];
                    bedControler($conn, $nursing_station, $ward_num, $bed_num);
                }
            ?>
        </div>
    <br>
        <div class="div2">
            <button class="ward_num">13B08</button>
            <?php
                $start_index = 21;
                $end_index = 23;
                
                // 迴圈處理床位資訊
                for ($i = $start_index; $i <= $end_index; $i++) {
                    $nursing_station = $beds[$i]['nursing_station'];
                    $ward_num = $beds[$i]['ward_num'];
                    $bed_num = $beds[$i]['bed_num'];
                    bedControler($conn, $nursing_station, $ward_num, $bed_num);
                }
            ?>
        </div>
        <div class="div2">
            <button class="ward_num">13B09</button>
            <?php
                $start_index = 24;
                $end_index = 26;
                
                // 迴圈處理床位資訊
                for ($i = $start_index; $i <= $end_index; $i++) {
                    $nursing_station = $beds[$i]['nursing_station'];
                    $ward_num = $beds[$i]['ward_num'];
                    $bed_num = $beds[$i]['bed_num'];
                    bedControler($conn, $nursing_station, $ward_num, $bed_num);
                }
            ?>
        </div>
        <div class="div2">
            <button class="ward_num">13B10</button>
            <?php
                $start_index = 27;
                $end_index = 29;
                
                // 迴圈處理床位資訊
                for ($i = $start_index; $i <= $end_index; $i++) {
                    $nursing_station = $beds[$i]['nursing_station'];
                    $ward_num = $beds[$i]['ward_num'];
                    $bed_num = $beds[$i]['bed_num'];
                    bedControler($conn, $nursing_station, $ward_num, $bed_num);
                }
            ?>
        </div>
        <div class="div2">
            <button class="ward_num">13B11</button>
            <?php
                $start_index = 30;
                $end_index = 32;
                
                // 迴圈處理床位資訊
                for ($i = $start_index; $i <= $end_index; $i++) {
                    $nursing_station = $beds[$i]['nursing_station'];
                    $ward_num = $beds[$i]['ward_num'];
                    $bed_num = $beds[$i]['bed_num'];
                    bedControler($conn, $nursing_station, $ward_num, $bed_num);
                }
            ?>
        </div>
        <div class="div1 neg_div">
            <button class="neg_ward_num">負壓01</button>
            <?php
                $nursing_station = $beds[33]["nursing_station"];
                $ward_num = $beds[33]["ward_num"];
                $bed_num = $beds[33]["bed_num"];
                bedControler($conn, $nursing_station, $ward_num, $bed_num);
            ?>
        </div>
        <div class="div1 neg_div">
            <button class="neg_ward_num">負壓02</button>
            <?php
                $nursing_station = $beds[34]["nursing_station"];
                $ward_num = $beds[34]["ward_num"];
                $bed_num = $beds[34]["bed_num"];
                bedControler($conn, $nursing_station, $ward_num, $bed_num);
            ?>
        </div>
        <div class="div1 neg_div">
            <button class="neg_ward_num">負壓03</button>
            <?php
                $nursing_station = $beds[35]["nursing_station"];
                $ward_num = $beds[35]["ward_num"];
                $bed_num = $beds[35]["bed_num"];
                bedControler($conn, $nursing_station, $ward_num, $bed_num);
            ?>
        </div>
    </div>
</main>
<?php $conn->close(); ?>
<script src="script.js"></script>
</body>
</html>