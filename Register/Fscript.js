window.onload = function() {
    current_time();
    register_datetime();
}

function current_time() {
    var Today = new Date();
    var day_list = ['日', '一', '二', '三', '四', '五', '六'];
    document.querySelector(".current_time").innerHTML = Today.getFullYear() + "年" + (Today.getMonth()+1) +  "月" + Today.getDate() + "日" + " 星期" + day_list[Today.getDay()] + " " + Today.toLocaleTimeString([], { hour12: false, hour: "2-digit", minute: "2-digit", second: "2-digit" });
    setTimeout('current_time()',1000);
}

function register_datetime() {
    var Today = new Date();
    document.querySelector("#register_datetime").innerHTML = Today.getFullYear() + "/" + (Today.getMonth()+1) +  "/" + Today.getDate() + " " + Today.toLocaleTimeString([], { hour12: false, hour: "2-digit", minute: "2-digit", second: "2-digit" });
    setTimeout('register_datetime()',1000);
}

var Today = new Date();
document.querySelector(".update_date").innerHTML = Today.toLocaleDateString([], { month: "2-digit", day: "2-digit" });
document.querySelector(".update_time").innerHTML = Today.toLocaleTimeString([], { hour12: false, hour: "2-digit", minute: "2-digit" });