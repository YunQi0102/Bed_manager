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
            height: 230
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
            const translateValue = index % 2 === 0 ? 'translate(-20%, -5%)' : 'translate(20%, 5%)';
            label.style.transform = translateValue; 
        });
    }, 0);
})
.catch(error => console.error('Error fetching data:', error));

// 2門診急診待床數
fetch('outp_emerg_count.php')
.then(response => response.json())
.then(data => {
    console.log(data);
    
    // 轉換數據格式以適應C3.js
    const columns = data.map(item => [item.sourse , item.total_count]);

    // 繪製圓餅圖
    const chart = c3.generate({
        bindto: '#outp_emerg_count',
        size: {
            width: 250,
            height: 230
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
            const translateValue = index % 2 === 0 ? 'translate(-20%, -7%)' : 'translate(20%, 7%)';
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
            height: 230
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
            const translateValue = index % 2 === 0 ? 'translate(-20%, -2%)' : 'translate(20%, 2%)';
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
            height: 230
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
            const translateValue = index % 2 === 0 ? 'translate(18%, 10%)' : 'translate(-18%, -10%)';
            label.style.transform = translateValue; 
        });
    }, 0);
})
.catch(error => console.error('Error fetching data3:', error));

// 5一般加護病房等待人數
var chart = c3.generate({
    bindto: '#vacancy',
    data: {
        columns: [
            ['一般', 7, 10, 5, 8, 6, 3, 9],
            ['加護', 2, 5, 4, 6, 2, 3, 5]
        ],
        type: 'bar'
    },
    size: {
        width: 520,
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

// 6住出院人數
var chart = c3.generate({
    bindto: '#in_out',
    data: {
        columns: [
            ['住院', 30, 21, 26, 20, 16, 24, 20],
            ['出院', 17, 32, 14, 27, 20, 11, 28]
        ],
        type: 'line',
        labels: true
    },
    size: {
        width: 520,
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
        },
        y: {
            tick: {
                values: [0, 10, 20, 30, 40, 50]
            }
        }
    },
    tooltip: {
        show: false
    }
});