var Today = new Date();
var day  = Today.getDay();
var day_list = ['日', '一', '二', '三', '四', '五', '六'];
document.querySelector(".current_time").innerHTML = Today.getFullYear()+ "年" + (Today.getMonth()+1) + "月" + Today.getDate() + "日" + ' 星期' + day_list[day] + " " + Today.getHours() + " : " + Today.getMinutes();

const clickbtn = document.querySelector(".btn");
clickbtn.addEventListener('click', LogIn);
function LogIn() {
    alert("登入成功!");
    // open('//yunqi0102.github.io/Bed_manager/Home/index.html'); 失敗
    // window.location="//yunqi0102.github.io/Bed_manager/Home/index.html"; 失敗
};