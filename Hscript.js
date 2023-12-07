window.onload = function() {
    current_time();
}

function current_time() {
    var Today = new Date();
    var day_list = ['日', '一', '二', '三', '四', '五', '六'];
    document.querySelector(".current_time").innerHTML = Today.getFullYear() + "年" + (Today.getMonth()+1) +  "月" + Today.getDate() + "日" + " 星期" + day_list[Today.getDay()] + " " + Today.toLocaleTimeString([], { hour12: false, hour: "2-digit", minute: "2-digit", second: "2-digit" });
    setTimeout('current_time()',1000);
}

const clickbtn2 = document.querySelector(".two");
clickbtn2.addEventListener('click', toRegister);
function toRegister() {
    window.location="https://yunqi0102.000webhostapp.com/Register/";
}

const clickbtn3 = document.querySelector(".three");
clickbtn3.addEventListener('click', toFloorSelect);
function toFloorSelect() {
    window.location="https://yunqi0102.000webhostapp.com/FloorSelect/";
}

const clickbtn4 = document.querySelector(".four");
clickbtn4.addEventListener('click', toPatientList);
function toPatientList() {
    window.location="https://yunqi0102.000webhostapp.com/Patient/index.php";
}