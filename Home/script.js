var Today = new Date();
var Year = Today.getFullYear();
var Month = Today.getMonth();
var Date = Today.getDate();
// var Hour = Today.getHours();
// var Minute = Today.getMinutes();
// var Second = Today.getSeconds();
var day  = Today.getDay();
var day_list = ['日', '一', '二', '三', '四', '五', '六'];

var HMS = Today.toLocaleTimeString([], { hour12: false, hour: "2-digit", minute: "2-digit", second: "2-digit" });

function current() {
    const curr = Year + "年" + (Month + 1) + "月" + Date + "日" + " 星期" + day_list[day] + " " + HMS;
    document.querySelector(".current_time").innerHTML = curr;
    setInterval('current()', 1000);
};

const clickbtn2 = document.querySelector(".two");
clickbtn2.addEventListener('click', toRegister);
function toRegister() {
    window.location="https://yunqi0102.000webhostapp.com/Register/";
};

const clickbtn3 = document.querySelector(".three");
clickbtn3.addEventListener('click', toFloorSelect);
function toFloorSelect() {
    window.location="https://yunqi0102.000webhostapp.com/FloorSelect/";
};