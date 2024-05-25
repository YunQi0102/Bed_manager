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
// document.addEventListener('DOMContentLoaded', function () {
//     const table = document.getElementById('sortable-table');
//     const placeholder = document.createElement('tr');
//     placeholder.classList.add('placeholder');
//     placeholder.innerHTML = '<td colspan="23"></td>';

//     let dragSrcEl = null;

//     function handleDragStart(e) {
//         e.target.classList.add('dragging');
//         dragSrcEl = e.target;
//         e.dataTransfer.effectAllowed = 'move';
//         e.dataTransfer.setData('text/html', e.target.innerHTML);
//     }

//     function handleDragOver(e) {
//         if (e.preventDefault) {
//             e.preventDefault();
//         }
//         const draggingElement = document.querySelector('.dragging');
//         const targetElement = e.target.closest('tr');
        
//         if (targetElement && draggingElement !== targetElement) {
//             const bounding = targetElement.getBoundingClientRect();
//             const offset = bounding.y + (bounding.height / 2);
//             const nextSibling = (e.clientY - bounding.y > bounding.height / 2) ? targetElement.nextElementSibling : targetElement;
            
//             table.querySelector('tbody').insertBefore(placeholder, nextSibling);
//         }

//         return false;
//     }

//     function handleDrop(e) {
//         if (e.stopPropagation) {
//             e.stopPropagation();
//         }
//         const draggingElement = document.querySelector('.dragging');
        
//         if (placeholder) {
//             table.querySelector('tbody').insertBefore(draggingElement, placeholder);
//             draggingElement.classList.remove('dragging');
//             placeholder.remove();
//         }

//         return false;
//     }

//     function handleDragEnd(e) {
//         e.target.classList.remove('dragging');
//     }

//     table.querySelectorAll('tr[draggable="true"]').forEach(row => {
//         row.addEventListener('dragstart', handleDragStart);
//         row.addEventListener('dragover', handleDragOver);
//         row.addEventListener('drop', handleDrop);
//         row.addEventListener('dragend', handleDragEnd);
//     });
// });

document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById('sortable-table');
    const placeholder = document.createElement('tr');
    placeholder.classList.add('placeholder');
    placeholder.innerHTML = '<td colspan="23"></td>';

    let dragSrcEl = null;

    function handleDragStart(e) {
        e.target.classList.add('dragging');
        dragSrcEl = e.target;
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/html', e.target.innerHTML);
    }

    function handleDragOver(e) {
        if (e.preventDefault) {
            e.preventDefault();
        }
        const draggingElement = document.querySelector('.dragging');
        const targetElement = e.target.closest('tr');
        
        if (targetElement && draggingElement !== targetElement) {
            const bounding = targetElement.getBoundingClientRect();
            const offset = bounding.y + (bounding.height / 2);
            const nextSibling = (e.clientY - bounding.y > bounding.height / 2) ? targetElement.nextElementSibling : targetElement;
            
            table.querySelector('tbody').insertBefore(placeholder, nextSibling);
        }

        return false;
    }

    function handleDrop(e) {
        if (e.stopPropagation) {
            e.stopPropagation();
        }
        const draggingElement = document.querySelector('.dragging');
        
        if (placeholder) {
            table.querySelector('tbody').insertBefore(draggingElement, placeholder);
            draggingElement.classList.remove('dragging');
            placeholder.remove();
        }

        // Send new order to server
        const rows = table.querySelectorAll('tbody tr');
        const order = Array.from(rows).map(row => row.querySelector('td:first-child').textContent);

        fetch('update.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ order: order })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Order updated successfully');
            } else {
                console.error('Failed to update order');
            }
        });

        return false;
    }

    function handleDragEnd(e) {
        e.target.classList.remove('dragging');
    }

    table.querySelectorAll('tr[draggable="true"]').forEach(row => {
        row.addEventListener('dragstart', handleDragStart);
        row.addEventListener('dragover', handleDragOver);
        row.addEventListener('drop', handleDrop);
        row.addEventListener('dragend', handleDragEnd);
    });
});
