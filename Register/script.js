var Today = new Date();
var Year = Today.getFullYear();
var Month = Today.getMonth();
var Date = Today.getDate();
var Hour = Today.getHours();
var Minute = Today.getMinutes();
var day  = Today.getDay();
var day_list = ['日', '一', '二', '三', '四', '五', '六'];

document.querySelector(".update_date").innerHTML = (Month + 1) + "/" + Date;
document.querySelector(".update_time").innerHTML = Hour + ":" + Minute;

function current() {
    document.querySelector(".current_time").innerHTML = Year + "年" + (Month + 1) + "月" + Date + "日" + ' 星期' + day_list[day] + " " + Hour + " : " + Minute;
    setTimeout('current()', 60000);
};

const clickbtn = document.querySelector(".btn");
clickbtn.addEventListener('click', LogIn);
function LogIn() {
    alert("登記成功!");
};