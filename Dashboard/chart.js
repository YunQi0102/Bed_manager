// 1空床佔床數
fetch('emp_occu_bed.php')
.then(response => response.json())
.then(data => {
    // 轉換數據格式以適應C3.js
    const columns = data.map(item => [item.form_status === 'Empty' ? '空床' : '佔床', item.total_count]);

    // 繪製圓餅圖
    const chart = c3.generate({
        bindto: '#emp_occu_bed',
        size: {
            width: 250,
            height: 250
        },
        data: {
            columns: columns,
            type: 'pie'
        },
        color: {
            pattern: ['#004b84a5', '#004b84eb']
        },
        pie: {
            label: {
                format: function(value, ratio, id) {
                    return id + "：" + value;
                }
            }
        },
        tooltip: {
            format: {
                title: function (d) { return '目前床數'; },
                value: function (value, ratio, id) {
                    return value;
                }
            }
        }
    });
    setTimeout(function () {
        const labels = document.querySelectorAll('#emp_occu_bed .c3-chart-arc text');
        labels.forEach((label, index) => {
            label.setAttribute('dy', '0.35em');
            const translateValue = index % 2 === 0 ? 'translate(-22%, -5%)' : 'translate(22%, 5%)';
            label.style.transform = translateValue; 
        });
    }, 0);
})
.catch(error => console.error('Error fetching data:', error));

// 2門診急診待床數
fetch('outp_emerg_count.php')
.then(response => response.json())
.then(data => {
    // 檢查數據格式是否正確
    console.log(data);

    // 轉換數據格式以適應C3.js
    const columns = data.map(item => [item.sourse , item.total_count]);

    // 繪製圓餅圖
    const chart = c3.generate({
        bindto: '#outp_emerg_count',
        size: {
            width: 250,
            height: 250
        },
        data: {
            columns: columns,
            type: 'pie'
        },
        color: {
            pattern: ['#004b84a5', '#004b84eb']
        },
        pie: {
            label: {
                format: function(value, ratio, id) {
                return id + "：" + value;
                }
            }
        },
        tooltip: {
            format: {
                title: function (d) { return '待床來源'; },
                value: function (value, ratio, id) {
                    return value;
                }
            }
        }
    });
    setTimeout(function () {
        const labels = document.querySelectorAll('#outp_emerg_count .c3-chart-arc text');
        labels.forEach((label, index) => {
            label.setAttribute('dy', '0.35em');
            const translateValue = index % 2 === 0 ? 'translate(-22%, -10%)' : 'translate(22%, 10%)';
            label.style.transform = translateValue; 
        });
    }, 0);
})
.catch(error => console.error('Error fetching data2:', error));

// 3待床性別數
fetch('wait_gender.php')
.then(response => response.json())
.then(data => {
    // 檢查數據格式是否正確
    console.log(data);

    // 轉換數據格式以適應C3.js
    const columns = data.map(item => [item.gender , item.total_count]);

    // 繪製圓餅圖
    const chart = c3.generate({
        bindto: '#wait_gender',
        size: {
            width: 250,
            height: 250
        },
        data: {
            columns: columns,
            type: 'pie'
        },
        color: {
            pattern: ['#004b84a5', '#004b84eb']
        },
        pie: {
            label: {
                format: function(value, ratio, id) {
                return id + "：" + value;
                }
            }
        },
        tooltip: {
            format: {
                title: function (d) { return '待床性別'; },
                value: function (value, ratio, id) {
                    return value;
                }
            }
        }
    });
    setTimeout(function () {
        const labels = document.querySelectorAll('#wait_gender .c3-chart-arc text');
        labels.forEach((label, index) => {
            label.setAttribute('dy', '0.35em');
            const translateValue = index % 2 === 0 ? 'translate(-22%, -2%)' : 'translate(22%, 2%)';
            label.style.transform = translateValue; 
        });
    }, 0);
})
.catch(error => console.error('Error fetching data3:', error));

// 4一般加護待床數
fetch('gen_icu.php')
.then(response => response.json())
.then(data => {
    // 檢查數據格式是否正確
    console.log(data);

    // 轉換數據格式以適應C3.js
    const columns = data.map(item => [item.icu_status , item.total_count]);

    // 繪製圓餅圖
    const chart = c3.generate({
        bindto: '#gen_icu',
        size: {
            width: 250,
            height: 250
        },
        data: {
            columns: columns,
            type: 'pie'
        },
        color: {
            pattern: ['#004b84eb', '#004b84a5']
        },
        pie: {
            label: {
                format: function(value, ratio, id) {
                return id + "：" + value;
                }
            }
        },
        tooltip: {
            format: {
                title: function (d) { return '待床類別'; },
                value: function (value, ratio, id) {
                    return value;
                }
            }
        }
    });
    setTimeout(function () {
        const labels = document.querySelectorAll('#gen_icu .c3-chart-arc text');
        labels.forEach((label, index) => {
            label.setAttribute('dy', '0.35em');
            const translateValue = index % 2 === 0 ? 'translate(22%, 12%)' : 'translate(-22%, -12%)';
            label.style.transform = translateValue; 
        });
    }, 0);
})
.catch(error => console.error('Error fetching data3:', error));

// 5各科待床人數
fetch('department.php')
.then(response => response.json())
.then(data => {
    console.log(data);

    const columns = data.map(item => [item.department, item.total_count]);

    // 長條圖
    const chart = c3.generate({
        bindto: '#department',
        size: {
            width: 600,
            height: 220
        },
        data: {
            columns: columns,
            type: 'bar',
            labels: true,
            colors: {
                '一般內科': '#ff8e8eeb',
                '一般外科': '#bb8effeb',
                '小兒外科': '#7fe590eb',
                '神經外科': '#ff8ec5eb',
                '胸腔內科': '#8e94ffeb',
                '胸腔外科': '#ffc78eeb',
                '腎臟內科': '#8eccffeb'
              }
        },
        bar: {
            width: {
                ratio: 0.5 // 控制條形的寬度
            }
        },
        axis: {
            x: {
                type: 'category',
                categories: ['待床人數']
            },
            y: {
                tick: {
                    values: [0, 1, 2, 3, 4, 5]
                }
            }
        },
        tooltip: {
            show: false
        }
    });
})
.catch(error => console.error('Error fetching data4:', error));

// 6空床率(36)
var chart = c3.generate({
    bindto: '#vacancy',
    data: {
        columns: [
            ['7A', 2, 5, 4, 6, 2, 3, 5],
            ['8A', 7, 10, 5, 8, 6, 3, 9]
        ],
        type: 'bar',
        labels: true
    },
    size: {
        width: 600,
        height: 220
    },
    bar: {
        width: {
            ratio: 0.5
        }
    },
    axis: {
        x: {
            type: 'category',
            categories: ['5/29', '5/30', '5/31', '6/1', '6/2', '6/3', '6/4']
        }
    },
    tooltip: {
        show: false
    }
});