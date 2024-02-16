<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <title>輔大醫院-床位管理系統</title>
    <link rel="stylesheet" href="Hstyle.css">
</head>
<body>
<header>
    <div>
        <img src="..\img\FJUHlogo.jpg" alt="a hospital's logo">
        <h1>輔大醫院-床位管理系統</h1>
        <h1 class="subtitle">首頁</h1>
        <div class="current_time"></div>
    </div>
</header>
<main>
    <table>
        <tr>
            <td><button class="one"><span>床位儀表板</span>
                <input type="image" src="..\img\dashboard.png" width="180px" style="border-radius: 10px;"></button></td>
            <td><button class="two"><span>床位登記</span>
                <input type="image" src="..\img\register.png" width="155px" style="border-radius: 10px;"></button></td>
            <td><button class="three"><span>床位查詢</span>
                <input type="image" src="..\img\search.png" width="140px" style="border-radius: 10px;"></button></td>
            <td><button class="four"><span>待床/控床清單</span>
                <input type="image" src="..\img\list.png" width="100px" style="border-radius: 10px;"></button></td>
        </tr>
    </table>
</main>
<script src="Hscript.js"></script>
</body>
</html>