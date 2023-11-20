var Today = new Date();
var day  = Today.getDay();
var day_list = ['日', '一', '二', '三', '四', '五', '六'];
document.querySelector(".current_time").innerHTML = Today.getFullYear()+ "年" + (Today.getMonth()+1) + "月" + Today.getDate() + "日" + ' 星期' + day_list[day] + " " + Today.getHours() + " : " + Today.getMinutes();

const clickbtn2 = document.querySelector(".two");
clickbtn2.addEventListener('click', toRegister);
function toRegister() {
    window.location="//127.0.0.1:5501/Register/index.html";
};