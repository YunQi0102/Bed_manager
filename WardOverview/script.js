window.onload = function() {
    current_time();
}

function current_time() {
    var Today = new Date();
    var day_list = ['日', '一', '二', '三', '四', '五', '六'];
    document.querySelector(".current_time").innerHTML = Today.getFullYear() + "年" + (Today.getMonth()+1) +  "月" + Today.getDate() + "日" + " 星期" + day_list[Today.getDay()] + " " + Today.toLocaleTimeString([], { hour12: false, hour: "2-digit", minute: "2-digit", second: "2-digit" });
    setTimeout('current_time()',1000);
}

var Today = new Date();
document.querySelector(".update_date").innerHTML = Today.toLocaleDateString([], { month: "2-digit", day: "2-digit" });
document.querySelector(".update_time").innerHTML = Today.toLocaleTimeString([], { hour12: false, hour: "2-digit", minute: "2-digit"});

const clickbtn1 = document.querySelector(".btn1");
clickbtn1.addEventListener('click', toWard1);
function toWard1() {
    window.location="http://localhost/Ward/13B01.html";
}

const clickbtn3 = document.querySelector(".btn3");
clickbtn3.addEventListener('click', toWard3);
function toWard3() {
    window.location="http://localhost/Ward/13B03.html";
}