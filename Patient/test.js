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

// 手動排序
const table = document.getElementById('sortable-table');

const placeholder = document.createElement('tr');
placeholder.classList.add('placeholder');
placeholder.innerHTML = '<td></td>';

table.addEventListener('dragstart', handleDragStart);
table.addEventListener('dragover', handleDragOver);
table.addEventListener('drop', handleDrop);

function handleDragStart(e) {
  e.target.classList.add('dragging');
  e.dataTransfer.effectAllowed = 'move';
  e.dataTransfer.setData('text/html', e.target.innerHTML);
}

function handleDragOver(e) {
  e.preventDefault();
  const draggingElement = document.querySelector('.dragging');
  const targetElement = e.target.closest('tr');
  
  if (targetElement && draggingElement !== targetElement) {
    const bounding = targetElement.getBoundingClientRect();
    const offset = bounding.y + (bounding.height / 2);
    const nextSibling = (e.clientY - bounding.y > bounding.height / 2) ? targetElement.nextElementSibling : targetElement;
    
    table.insertBefore(placeholder, nextSibling);
  }
}

function handleDrop(e) {
  e.stopPropagation();
  const draggingElement = document.querySelector('.dragging');
  
  if (placeholder) {
    table.insertBefore(draggingElement, placeholder);
    draggingElement.classList.remove('dragging');
    placeholder.remove();
  }
}

table.querySelectorAll('tr').forEach(row => {
  row.addEventListener('dragstart', handleDragStart);
  row.addEventListener('dragover', handleDragOver);
  row.addEventListener('drop', handleDrop);
});