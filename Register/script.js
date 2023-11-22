var Today = new Date();
var Year = Today.getFullYear();
var Month = Today.getMonth();
var Date = Today.getDate();
var Hour = Today.getHours();
var Minute = Today.getMinutes();
var Second = Today.getSeconds();
var day  = Today.getDay();
var day_list = ['日', '一', '二', '三', '四', '五', '六'];

var MD = Today.toLocaleDateString([], { month: "2-digit", day: "2-digit" });
var HM = Today.toLocaleTimeString([], { hour12: false, hour: "2-digit", minute: "2-digit"});
var HMS = Today.toLocaleTimeString([], { hour12: false, hour: "2-digit", minute: "2-digit", second: "2-digit" });

document.querySelector(".update_date").innerHTML = MD;
document.querySelector(".update_time").innerHTML = HM;
// document.querySelector(".current_time").innerHTML = Year + "年" + (Month + 1) + "月" + Date + "日" + " 星期" + day_list[day] + " " + Hour + " : " + Minute + " : " + Second;

function current() {
    const curr = Year + "年" + (Month + 1) + "月" + Date + "日" + " 星期" + day_list[day] + " " + HMS;
    document.querySelector(".current_time").innerHTML = curr;
    setInterval('current()', 1000);
};

const clickbtn = document.querySelector(".btn");
clickbtn.addEventListener('click', LogIn);
function LogIn() {
    // event.preventDefault();
    window.location="https://yunqi0102.000webhostapp.com/Form/";
    // location.replace="https://yunqi0102.000webhostapp.com/Form/";
};