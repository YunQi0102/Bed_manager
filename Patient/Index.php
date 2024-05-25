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

if ($Urow) {
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <title>床位管理系統-待床清單</title>
    <link rel="icon" href="../img/FJUH_icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <script>
        function openEmptyBed() {
            window.open('http://localhost/EmptyBedOverview/Index.php', 'emptyBedWindow', 'width=800,height=400,left=350,top=140');
        }
    </script>
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
        <h1 class="subtitle">待床/控床清單</h1>
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
        // 擷取資料
        $sql = "SELECT * FROM list ORDER BY display_order ASC";
        $result = $conn->query($sql);

        // 檢查是否有資料
        if ($result->num_rows > 0) {
            echo "<table id='sortable-table'>
                <thead>
                    <tr class='tr_one'>
                        <th>No.</th>
                        <th>入床</th>
                        <th>病歷號</th>
                        <th>科別</th>
                        <th>來源</th>
                        <th>姓名</th>
                        <th>性別</th>
                        <th>身份</th>
                        <th>就診號</th>
                        <th>醫師</th>
                        <th>電話</th>
                        <th>手機</th>
                        <th>優先序</th>
                        <th>登記住院日</th>
                        <th>登記出院日</th>
                        <th>手術</th>
                        <th>化療</th>
                        <th>重傷</th>
                        <th>加護</th>
                        <th>公床</th>
                        <th>隔離</th>
                        <th>隔離註記</th>
                        <th>備註</th>
                    </tr>
                </thead>
                <tbody>";
            while($row = $result->fetch_assoc()) {
                echo "<tr draggable='true'>
                        <td>".$row["form_id"]."</td>
                        <td>"."<a href='#' onclick='openEmptyBed(); return false;'>選擇床位</a></td>
                        <td>".$row["medical_record_id"]."</td>
                        <td>".$row["department"]."</td>
                        <td>".$row["sourse"]."</td>
                        <td>".$row["patient_name"]."</td>
                        <td>".$row["gender"]."</td>
                        <td>".$row["identity"]."</td>
                        <td>".$row["clinic_number"]."</td>
                        <td>".$row["visa_doctor"]."</td>
                        <td>".$row["telephone_number"]."</td>
                        <td>".$row["phone_number"]."</td>
                        <td>".$row["priorities"]."</td>
                        <td>".$row["reserve_date"]."</td>
                        <td>".$row["discharged_date"]."</td>
                        <td>".$row["operation"]."</td>
                        <td>".$row["chemotherapy"]."</td>
                        <td>".$row["severely_injured"]."</td>
                        <td>".$row["ICU"]."</td>
                        <td>".$row["public_bed"]."</td>
                        <td>".$row["isolation"]."</td>
                        <td>".$row["isolation_note"]."</td>
                        <td>".$row["note"]."</td>
                    </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "0 results";
        }
        $conn->close();
    ?>
</main>
<script src="script.js"></script>
</body>
</html>
