<!-- ใช้จ่ายงบประมาณ ******************************************************** -->
<script>
    // ข้อมูลจาก Controller
    var monthlyData = <?php echo json_encode($sum_project_money_by_project_status_end_y2567); ?>;

    // สร้างตัวแปรเก็บข้อมูลเงินรวมของแต่ละเดือน
    var sumMoneyData = [];
    // ลูปเพื่อดึงค่าเงินรวมของแต่ละเดือนและใส่ลงใน sumMoneyData
    for (var i = 0; i < monthlyData.length; i++) {
        sumMoneyData.push(monthlyData[i].sum_money);
    }

    // ข้อมูลจาก Controller
    var monthlyDataProcess = <?php echo json_encode($sum_project_money_by_project_status_process_y2567); ?>;

    // สร้างตัวแปรเก็บข้อมูลเงินรวมของแต่ละเดือน
    var sumMoneyDataProcess = [];
    // ลูปเพื่อดึงค่าเงินรวมของแต่ละเดือนและใส่ลงใน sumMoneyData
    for (var i = 0; i < monthlyDataProcess.length; i++) {
        sumMoneyDataProcess.push(monthlyDataProcess[i].sum_money);
    }

    const DATA_COUNT2567 = 12;
    const labels2567 = ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];
    const data2567 = {
        labels: labels2567,
        datasets: [{
                label: 'สิ้นสุดสัญญา',
                data: sumMoneyData,
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
            },
            {
                label: 'ระหว่างดำเนินการ',
                data: sumMoneyDataProcess,
                borderColor: 'rgb(54, 162, 235)',
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
            }
        ]
    };

    const config2567 = {
        type: 'line',
        data: data2567,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                // title: {
                //     display: true,
                //     text: 'Chart.js Line Chart'
                // }
            }
        },
    };

    const myChart_tmt_budjet_2567 = new Chart(
        document.getElementById('myChart_tmt_budjet_2567'),
        config2567
    );
</script>
<script>
    // ข้อมูลจาก Controller
    var monthlyData = <?php echo json_encode($sum_project_money_by_project_status_end_y2566); ?>;

    // สร้างตัวแปรเก็บข้อมูลเงินรวมของแต่ละเดือน
    var sumMoneyData = [];
    // ลูปเพื่อดึงค่าเงินรวมของแต่ละเดือนและใส่ลงใน sumMoneyData
    for (var i = 0; i < monthlyData.length; i++) {
        sumMoneyData.push(monthlyData[i].sum_money);
    }

    // ข้อมูลจาก Controller
    var monthlyDataProcess = <?php echo json_encode($sum_project_money_by_project_status_process_y2566); ?>;

    // สร้างตัวแปรเก็บข้อมูลเงินรวมของแต่ละเดือน
    var sumMoneyDataProcess = [];
    // ลูปเพื่อดึงค่าเงินรวมของแต่ละเดือนและใส่ลงใน sumMoneyData
    for (var i = 0; i < monthlyDataProcess.length; i++) {
        sumMoneyDataProcess.push(monthlyDataProcess[i].sum_money);
    }

    const DATA_COUNT2566 = 12;
    const labels2566 = ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];
    const data2566 = {
        labels: labels2566,
        datasets: [{
                label: 'สิ้นสุดสัญญา',
                data: sumMoneyData,
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
            },
            {
                label: 'ระหว่างดำเนินการ',
                data: sumMoneyDataProcess,
                borderColor: 'rgb(54, 162, 235)',
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
            }
        ]
    };

    const config2566 = {
        type: 'line',
        data: data2566,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                // title: {
                //     display: true,
                //     text: 'Chart.js Line Chart'
                // }
            }
        },
    };

    const myChart_tmt_budjet_2566 = new Chart(
        document.getElementById('myChart_tmt_budjet_2566'),
        config2566
    );

    const chartVersion2566 = document.getElementById('chartVersion2566');
    chartVersion2566.innerText = Chart.version;
</script>
<script>
    // ข้อมูลจาก Controller
    var monthlyData = <?php echo json_encode($sum_project_money_by_project_status_end_y2565); ?>;

    // สร้างตัวแปรเก็บข้อมูลเงินรวมของแต่ละเดือน
    var sumMoneyData = [];
    // ลูปเพื่อดึงค่าเงินรวมของแต่ละเดือนและใส่ลงใน sumMoneyData
    for (var i = 0; i < monthlyData.length; i++) {
        sumMoneyData.push(monthlyData[i].sum_money);
    }

    // ข้อมูลจาก Controller
    var monthlyDataProcess = <?php echo json_encode($sum_project_money_by_project_status_process_y2565); ?>;

    // สร้างตัวแปรเก็บข้อมูลเงินรวมของแต่ละเดือน
    var sumMoneyDataProcess = [];
    // ลูปเพื่อดึงค่าเงินรวมของแต่ละเดือนและใส่ลงใน sumMoneyData
    for (var i = 0; i < monthlyDataProcess.length; i++) {
        sumMoneyDataProcess.push(monthlyDataProcess[i].sum_money);
    }

    const DATA_COUNT2565 = 12;
    const labels2565 = ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];
    const data2565 = {
        labels: labels2565,
        datasets: [{
                label: 'สิ้นสุดสัญญา',
                data: sumMoneyData,
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
            },
            {
                label: 'ระหว่างดำเนินการ',
                data: sumMoneyDataProcess,
                borderColor: 'rgb(54, 162, 235)',
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
            }
        ]
    };

    const config2565 = {
        type: 'line',
        data: data2565,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                // title: {
                //     display: true,
                //     text: 'Chart.js Line Chart'
                // }
            }
        },
    };

    const myChart_tmt_budjet_2565 = new Chart(
        document.getElementById('myChart_tmt_budjet_2565'),
        config2565
    );
</script>
<script>
    // กราฟงบประมาณ ******************************************************************
    google.charts.load('current', {
        'packages': ['corechart']
    });

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Year');
        data.addColumn('number', 'ราคากลาง');
        data.addColumn({
            type: 'string',
            role: 'annotation'
        });
        data.addColumn('number', 'ราคาชนะประมูล');
        data.addColumn({
            type: 'string',
            role: 'annotation'
        });

        data.addRows([
            ['2567', <?php echo $sum_price_build_money_y2567; ?>, numberFormat(<?php echo $sum_price_build_money_y2567; ?>), <?php echo $sum_money_y2567; ?>, numberFormat(<?php echo $sum_money_y2567; ?>)],
            ['2566', <?php echo $sum_price_build_money_y2566; ?>, numberFormat(<?php echo $sum_price_build_money_y2566; ?>), <?php echo $sum_money_y2566; ?>, numberFormat(<?php echo $sum_money_y2566; ?>)],
            ['2565', <?php echo $sum_price_build_money_y2565; ?>, numberFormat(<?php echo $sum_price_build_money_y2565; ?>), <?php echo $sum_money_y2565; ?>, numberFormat(<?php echo $sum_money_y2565; ?>)]
        ]);

        // Set chart options
        var options = {
            title: 'จำนวนเงินรวมทุกโครงการ',
            hAxis: {
                // title: 'ปี',
                titleTextStyle: {
                    color: 'black'
                }
            },
            colors: ['#FF62D3', '#5174EE'], // กำหนดสีของกราฟ
            backgroundColor: '#fff', // กำหนดสีพื้นหลังของกราฟ
            legend: {
                position: 'bottom', // เลื่อนป้ายกำกับ (label) ไปไว้ด้านล่างของกราฟ
                textStyle: {
                    color: '#A7A7A7'
                } // กำหนดสีของตัวหนังสือในป้ายกำกับ
            },
        };

        // Instantiate and draw the chart.
        var chart = new google.visualization.ColumnChart(document.getElementById('ChartBudget'));
        chart.draw(data, options);

        // Function to format numbers with commas every three digits
        function numberFormat(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " บาท";
        }
    }
</script>
<script>
    // กราฟโครงการ ******************************************************************
    const yValue1 = <?php echo $sum_money_y2567; ?>;
    const xValue1 = <?php echo $count_id_y2567; ?>;
    const yValue2 = <?php echo $sum_money_y2566; ?>;
    const xValue2 = <?php echo $count_id_y2566; ?>;
    const yValue3 = <?php echo $sum_money_y2565; ?>;
    const xValue3 = <?php echo $count_id_y2565; ?>;

    new Chart("ChartProject", {
        type: "line",
        data: {
            datasets: [{
                label: 'ปีงบประมาณ 2567',
                borderColor: "#61A3E0",
                pointStyle: 'circle', // เปลี่ยนรูปแบบของ label เป็นวงกลม
                data: [{
                    x: 0,
                    y: 0
                }, {
                    x: xValue1,
                    y: yValue1
                }]
            }, {
                label: 'ปีงบประมาณ 2566',
                borderColor: "rgba(255,0,0,1)",
                pointStyle: 'circle', // เปลี่ยนรูปแบบของ label เป็นวงกลม
                data: [{
                    x: 0,
                    y: 0
                }, {
                    x: xValue2,
                    y: yValue2
                }]
            }, {
                label: 'ปีงบประมาณ 2565',
                borderColor: "rgba(0,255,0,1)",
                pointStyle: 'circle', // เปลี่ยนรูปแบบของ label เป็นวงกลม
                data: [{
                    x: 0,
                    y: 0
                }, {
                    x: xValue3,
                    y: yValue3
                }]
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 15000000,
                        callback: function(value, index, values) {
                            return value.toLocaleString();
                        }
                    }
                }],
                xAxes: [{
                    type: 'linear',
                    ticks: {
                        min: 0,
                        max: 300,
                        callback: function(value, index, values) {
                            return value.toLocaleString();
                        }
                    },
                    display: true
                }]
            },
            legend: {
                position: 'bottom', // เลื่อนป้ายกำกับ (label) ไปไว้ด้านล่างของกราฟ
                labels: {
                    boxWidth: 12, // กำหนดขนาดของกรอบของ legend
                    usePointStyle: true // ใช้รูปแบบของจุดแทนสัญลักษณ์ของ legend
                }
            }
        }
    });
</script>
<script>
    // เรื่องร้องเรียน 
    $(document).ready(function() {
        var obj = {
            values: [
                <?php echo $total_complain_year; ?>,
                <?php echo $total_complain_success; ?>,
                <?php echo $total_complain_operation; ?>,
                <?php echo $total_complain_accept; ?>,
                <?php echo $total_complain_doing; ?>,
                <?php echo $total_complain_wait; ?>,
                <?php echo $total_complain_cancel; ?>
            ],
            colors: ['#F5900A', '#DBFFDD', '#FFA085', '#CFE5FF', '#CFD7FE', '#FFD361', '#FFE3E3'],
            animation: true,
            animationSpeed: 10,
            fillTextData: false,
            fillTextColor: '#fff',
            fillTextAlign: 1.35,
            fillTextPosition: 'inner',
            doughnutHoleSize: 50,
            doughnutHoleColor: '#fff',
            offset: 0,
            pie: 'normal',
            isStrokePie: {
                stroke: 20,
                overlayStroke: true,
                overlayStrokeColor: '#eee',
                strokeStartEndPoints: 'Yes',
                strokeAnimation: true,
                strokeAnimationSpeed: 40,
                fontSize: '60px',
                textAlignement: 'center',
                fontFamily: 'Arial',
                fontWeight: 'bold'
            }
        };

        var values = obj.values;
        var colors = obj.colors;

        for (var i = 0; i < values.length; i++) {
            var cardId = "card" + values[i];
            var card = $("#" + cardId);
            if (card) {
                card.css("background-color", colors[i]);
            }
        }


        generatePieGraph('myCanvas', obj);
    });
</script>