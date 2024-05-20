<?php
    session_start();

    // 檢查使用者是否已登入
    if (!isset($_SESSION['account'])) {
        // 若使用者未登入，定向到登入頁面
        header("Location: http://localhost");
        exit();
    }

    $account = $_SESSION['account'];
    $identity = $_SESSION['identity'];

    // 資料庫連線
    require_once('connect.php');

    $sql = "SELECT * FROM users WHERE (account = '$account')";
    $retval = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($retval);
    
    if($row) {
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <title>床位管理系統-首頁</title>
    <link rel="icon" href="../img/FJUH_icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="Hstyle.css">
</head>
<body>
<header>
    <div>
        <img src="..\img\FJUHlogo.jpg" alt="a hospital's logo">
        <h1>輔大醫院-床位管理系統</h1>
        <div class="current_time"></div>
        <div class="logout">
            <a href="logout.php"><img src="..\img\logout.png"></a>
        </div>
        <h1 class="welcome"><u><?php echo $row['user_name']; ?></u> (<?php if ($identity==="住中") {echo "C";} else {echo "D";} ?>)</h1>
        <h1 class="subtitle">首頁</h1>
    </div>
</header>
<main>
    <table>
        <tr>
            <td><button class="one"><span>床位儀表板</span>
                <input type="image" src="..\img\dashboard.png" width="180px" style="border-radius: 10px;"></button></td>
            <td><button class="two" <?php if ($identity === "住中") {
                    echo "disabled id="."disabled";} ?> ><span>床位登記</span>
                <input type="image" src="..\img\register.png" width="155px" style="border-radius: 10px;"></button></td>
            <td><button class="three" <?php if ($identity === "醫師") {
                    echo "disabled id="."disabled";} ?> ><span>床位查詢</span>
                <input type="image" src="..\img\search.png" width="140px" style="border-radius: 10px;"></button></td>
            <td><button class="four" <?php if ($identity === "醫師") {
                    echo "disabled id="."disabled";} ?> ><span>待床/控床清單</span>
                <input type="image" src="..\img\list.png" width="100px" style="border-radius: 10px;"></button></td>
        </tr>
    </table>
</main>
<?php } $conn->close(); ?>
<script src="Hscript.js"></script>
</body>
</html>