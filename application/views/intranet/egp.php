<!-- ส่วนทางขวา -->
<div class="flex-item-right ">
    <div class="all-report mt-5 scrollable-bar">
        <h4 class="font-topic-all-report">งบประมาณและโครงการ</h4>
        <div class="row">
            <div class="col-sm-6">
                <div class="card-all-report-project mt-3">
                    <span class="font-topic-egp">โครงการ</span>
                    <div class="mt-3">
                        <canvas id="ChartProject" style="width:100%;max-width:1000px; height: 355px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card-all-report-project mt-3">
                    <span class="font-topic-egp">งบประมาณ</span>
                    <div class="mt-3">
                        <div id="ChartBudget" class="budgetChart"></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card-all-report-project mt-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="font-topic-egp">สถานะโครงการ</span>
                        </div>
                        <div class="col-sm-6 d-flex justify-content-end">
                            <div class="dropdown show ">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuLinkStatus" data-bs-toggle="dropdown" aria-expanded="false">
                                    ปีงบประมาณ 2567
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="#" onclick="showChartStatus('chang_chart_status_2567', '2567')">2567</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="showChartStatus('chang_chart_status_2566', '2566')">2566</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="showChartStatus('chang_chart_status_2565', '2565')">2565</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="chang_chart_status_2567" class="mt-3 chang_chart_status" style="border: 1px solid #D8D8D8;">
                        <div class="row">
                            <div class="col-sm-6 text-center">
                                <div class="mt-2"></div>
                                <span class="black font-head-egp">จำนวนเงิน</span>
                                <div class="d-flex justify-content-center mt-2">
                                    <canvas id="ChartStatusMoney2567" style="width:100%;max-width:500px; height: 100%; max-height: 300px;"></canvas>
                                </div>
                                <div class="mt-2"></div>
                                <div>
                                    <span>จำนวนเงินรวม <span class="color-money-chart"><?php echo number_format($sum_money_y2567, 2, '.', ','); ?></span> บาท</span>
                                </div>
                                <div class="mb-2"></div>
                            </div>
                            <div class="col-sm-6 text-center">
                                <div class="mt-2"></div>
                                <span class="black font-head-egp">จำนวนโครงการ</span>
                                <div class="d-flex justify-content-center mt-2">
                                    <canvas id="ChartStatusProject2567" style="width:100%;max-width:500px; height: 100%; max-height: 300px;"></canvas>
                                </div>
                                <div class="mt-2"></div>
                                <div>
                                    <span>โครงการทั้งหมด <span class="color-money-chart"><?php echo $sum_project_status_all_y2567; ?></span> โครงการ</span>
                                </div>
                                <div class="mb-2"></div>
                            </div>
                        </div>
                    </div>
                    <div id="chang_chart_status_2566" class="mt-3 chang_chart_status" style="border: 1px solid #D8D8D8; display: none;">
                        <div class="row">
                            <div class="col-sm-6 text-center">
                                <div class="mt-2"></div>
                                <span class="black font-head-egp">จำนวนเงิน</span>
                                <div class="d-flex justify-content-center mt-2">
                                    <canvas id="ChartStatusMoney2566" style="width:100%;max-width:250px; height: 100%; max-height: 300px;"></canvas>
                                </div>
                                <div class="mt-2"></div>
                                <div>
                                <span>จำนวนเงินรวม <span class="color-money-chart"><?php echo number_format($sum_money_y2566, 2, '.', ','); ?></span> บาท</span>
                                </div>
                                <div class="mb-2"></div>
                            </div>
                            <div class="col-sm-6 text-center">
                                <div class="mt-2"></div>
                                <span class="black font-head-egp">จำนวนโครงการ</span>
                                <div class="d-flex justify-content-center mt-2">
                                    <canvas id="ChartStatusProject2566" style="width:100%;max-width:500px; height: 100%; max-height: 300px;"></canvas>
                                </div>
                                <div class="mt-2"></div>
                                <div>
                                    <span>โครงการทั้งหมด <span class="color-money-chart"><?php echo $sum_project_status_all_y2566; ?></span> โครงการ</span>
                                </div>
                                <div class="mb-2"></div>
                            </div>
                        </div>
                    </div>
                    <div id="chang_chart_status_2565" class="mt-3 chang_chart_status" style="border: 1px solid #D8D8D8;  display: none;">
                        <div class="row">
                            <div class="col-sm-6 text-center">
                                <div class="mt-2"></div>
                                <span class="black font-head-egp">จำนวนเงิน</span>
                                <div class="d-flex justify-content-center mt-2">
                                    <canvas id="ChartStatusMoney2565" style="width:100%;max-width:500px; height: 100%; max-height: 300px;"></canvas>
                                </div>
                                <div class="mt-2"></div>
                                <div>
                                <span>จำนวนเงินรวม <span class="color-money-chart"><?php echo number_format($sum_money_y2565, 2, '.', ','); ?></span> บาท</span>
                                </div>
                                <div class="mb-2"></div>
                            </div>
                            <div class="col-sm-6 text-center">
                                <div class="mt-2"></div>
                                <span class="black font-head-egp">จำนวนโครงการ</span>
                                <div class="d-flex justify-content-center mt-2">
                                    <canvas id="ChartStatusProject2565" style="width:100%;max-width:500px; height: 100%; max-height: 300px;"></canvas>
                                </div>
                                <div class="mt-2"></div>
                                <div>
                                    <span>โครงการทั้งหมด <span class="color-money-chart"><?php echo $sum_project_status_all_y2565; ?></span> โครงการ</span>
                                </div>
                                <div class="mb-2"></div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="d-flex justify-content-center">
                            <canvas id="ChartStatus" style="width:100%; max-width: 400px; height: 100%; max-height: 330px;"></canvas>
                        </div>
                        <div class="mt-2">
                            <span class="font-label-ChartStatus"><span class="dot1"></span>จำนวนเงินรวม</span>
                            <span class="font-label-ChartStatus"><span class="dot2"></span>ระหว่างดำเนินการ</span><br>
                            <span class="font-label-ChartStatus"><span class="dot3"></span>จำนวนเงินรวม</span>
                            <span class="font-label-ChartStatus"><span class="dot4"></span>สิ้นสุดสัญญา</span>
                        </div> -->
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card-all-report-project mt-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="font-topic-egp">ประเภทโครงการ</span>
                        </div>
                        <div class="col-sm-6 d-flex justify-content-end">
                            <div class="dropdown show ">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuLinkType" data-bs-toggle="dropdown" aria-expanded="false">
                                    ปีงบประมาณ 2567
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="#" onclick="showChartType('chang_chart_type_2567', '2567')">2567</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="showChartType('chang_chart_type_2566', '2566')">2566</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="showChartType('chang_chart_type_2565', '2565')">2565</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="chang_chart_type_2567" class="mt-3 chang_chart_type" style="border: 1px solid #D8D8D8;">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <div class="mt-2"></div>
                                <span class="black font-head-egp">จำนวนเงิน</span>
                                <div class="d-flex justify-content-center mt-2">
                                    <canvas id="ChartTypeMoney2567" style="width:100%;max-width:400px; height: 100%; max-height: 280px;"></canvas>
                                </div>
                                <div class="mt-2"></div>
                                <div>
                                    <span>จำนวนเงินรวม <span class="color-money-chart"><?php echo number_format($sum_money_y2567, 2, '.', ','); ?></span> บาท</span>
                                </div>
                                <div class="mb-2"></div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <div class="mt-5"></div>
                                <span class="black font-head-egp">จำนวนโครงการ</span>
                                <div class="d-flex justify-content-center mt-2">
                                    <canvas id="ChartTypeProject2567" style="width:100%;max-width:400px; height: 100%; max-height: 280px;"></canvas>
                                </div>
                                <div class="mt-2"></div>
                                <div>
                                    <span>โครงการทั้งหมด <span class="color-money-chart"><?php echo $sum_project_status_all_y2567; ?></span> โครงการ</span>
                                </div>
                                <div class="mb-2"></div>
                            </div>
                        </div>
                    </div>
                    <div id="chang_chart_type_2566" class="mt-3 chang_chart_type" style="border: 1px solid #D8D8D8; display: none;">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <div class="mt-2"></div>
                                <span class="black font-head-egp">จำนวนเงิน</span>
                                <div class="d-flex justify-content-center mt-2">
                                    <canvas id="ChartTypeMoney2566" style="width:100%;max-width:400px; height: 100%; max-height: 280px;"></canvas>
                                </div>
                                <div class="mt-2"></div>
                                <div>
                                    <span>จำนวนเงินรวม <span class="color-money-chart"><?php echo number_format($sum_money_y2566, 2, '.', ','); ?></span> บาท</span>
                                </div>
                                <div class="mb-2"></div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <div class="mt-5"></div>
                                <span class="black font-head-egp">จำนวนโครงการ</span>
                                <div class="d-flex justify-content-center mt-2">
                                    <canvas id="ChartTypeProject2566" style="width:100%;max-width:400px; height: 100%; max-height: 280px;"></canvas>
                                </div>
                                <div class="mt-2"></div>
                                <div>
                                    <span>โครงการทั้งหมด <span class="color-money-chart"><?php echo $sum_project_status_all_y2566; ?></span> โครงการ</span>
                                </div>
                                <div class="mb-2"></div>
                            </div>
                        </div>
                    </div>
                    <div id="chang_chart_type_2565" class="mt-3 chang_chart_type" style="border: 1px solid #D8D8D8;  display: none;">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <div class="mt-2"></div>
                                <span class="black font-head-egp">จำนวนเงิน</span>
                                <div class="d-flex justify-content-center mt-2">
                                    <canvas id="ChartTypeMoney2565" style="width:100%;max-width:400px; height: 100%; max-height: 280px;"></canvas>
                                </div>
                                <div class="mt-2"></div>
                                <div>
                                    <span>จำนวนเงินรวม <span class="color-money-chart"><?php echo number_format($sum_money_y2565, 2, '.', ','); ?></span> บาท</span>
                                </div>
                                <div class="mb-2"></div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <div class="mt-5"></div>
                                <span class="black font-head-egp">จำนวนโครงการ</span>
                                <div class="d-flex justify-content-center mt-2">
                                    <canvas id="ChartTypeProject2565" style="width:100%;max-width:400px; height: 100%; max-height: 280px;"></canvas>
                                </div>
                                <div class="mt-2"></div>
                                <div>
                                    <span>โครงการทั้งหมด <span class="color-money-chart"><?php echo $sum_project_status_all_y2565; ?></span> โครงการ</span>
                                </div>
                                <div class="mb-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card-all-report-project mt-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="font-topic-egp">วิธีจัดซื้อจัดจ้าง</span>
                        </div>
                        <div class="col-sm-6 d-flex justify-content-end">
                            <div class="dropdown show ">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuLinkPurchase" data-bs-toggle="dropdown" aria-expanded="false">
                                    ปีงบประมาณ 2567
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="#" onclick="showChartPurchase('chang_chart_purchase_2567', '2567')">2567</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="showChartPurchase('chang_chart_purchase_2566', '2566')">2566</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="showChartPurchase('chang_chart_purchase_2565', '2565')">2565</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="chang_chart_purchase_2567" class="mt-3 chang_chart_purchase" style="border: 1px solid #D8D8D8;">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <div class="mt-2"></div>
                                <span class="black font-head-egp">จำนวนเงิน</span>
                                <div class="d-flex justify-content-center mt-2">
                                    <canvas id="ChartPurchaseMoney2567" style="width:100%;max-width:400px; height: 100%; max-height: 280px;"></canvas>
                                </div>
                                <div class="mt-2"></div>
                                <div>
                                    <span>จำนวนเงินรวม <span class="color-money-chart"><?php echo number_format($sum_money_y2567, 2, '.', ','); ?></span> บาท</span>
                                </div>
                                <div class="mb-2"></div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <div class="mt-5"></div>
                                <span class="black font-head-egp">จำนวนโครงการ</span>
                                <div class="d-flex justify-content-center mt-2">
                                    <canvas id="ChartPurchaseProject2567" style="width:100%;max-width:400px; height: 100%; max-height: 280px;"></canvas>
                                </div>
                                <div class="mt-2"></div>
                                <div>
                                    <span>โครงการทั้งหมด <span class="color-money-chart"><?php echo $sum_project_status_all_y2567; ?></span> โครงการ</span>
                                </div>
                                <div class="mb-2"></div>
                            </div>
                        </div>
                    </div>
                    <div id="chang_chart_purchase_2566" class="mt-3 chang_chart_purchase" style="border: 1px solid #D8D8D8; display: none;">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <div class="mt-2"></div>
                                <span class="black font-head-egp">จำนวนเงิน</span>
                                <div class="d-flex justify-content-center mt-2">
                                    <canvas id="ChartPurchaseMoney2566" style="width:100%;max-width:250px; height: 100%; max-height: 280px;"></canvas>
                                </div>
                                <div class="mt-2"></div>
                                <div>
                                    <span>จำนวนเงินรวม <span class="color-money-chart"><?php echo number_format($sum_money_y2566, 2, '.', ','); ?></span> บาท</span>
                                </div>
                                <div class="mb-2"></div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <div class="mt-5"></div>
                                <span class="black font-head-egp">จำนวนโครงการ</span>
                                <div class="d-flex justify-content-center mt-2">
                                    <canvas id="ChartPurchaseProject2566" style="width:100%;max-width:400px; height: 100%; max-height: 280px;"></canvas>
                                </div>
                                <div class="mt-2"></div>
                                <div>
                                    <span>โครงการทั้งหมด <span class="color-money-chart"><?php echo $sum_project_status_all_y2566; ?></span> โครงการ</span>
                                </div>
                                <div class="mb-2"></div>
                            </div>
                        </div>
                    </div>
                    <div id="chang_chart_purchase_2565" class="mt-3 chang_chart_purchase" style="border: 1px solid #D8D8D8;  display: none;">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <div class="mt-2"></div>
                                <span class="black font-head-egp">จำนวนเงิน</span>
                                <div class="d-flex justify-content-center mt-2">
                                    <canvas id="ChartPurchaseMoney2565" style="width:100%;max-width:400px; height: 100%; max-height: 280px;"></canvas>
                                </div>
                                <div class="mt-2"></div>
                                <div>
                                    <span>จำนวนเงินรวม <span class="color-money-chart"><?php echo number_format($sum_money_y2565, 2, '.', ','); ?></span> บาท</span>
                                </div>
                                <div class="mb-2"></div>
                            </div>
                            <div class="col-sm-12 text-center">
                                <div class="mt-5"></div>
                                <span class="black font-head-egp">จำนวนโครงการ</span>
                                <div class="d-flex justify-content-center mt-2">
                                    <canvas id="ChartPurchaseProject2565" style="width:100%;max-width:400px; height: 100%; max-height: 280px;"></canvas>
                                </div>
                                <div class="mt-2"></div>
                                <div>
                                    <span>โครงการทั้งหมด <span class="color-money-chart"><?php echo $sum_project_status_all_y2565; ?></span> โครงการ</span>
                                </div>
                                <div class="mb-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card-all-report-project mt-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <span class="font-topic-egp">ใช้จ่ายงบประมาณ</span>
                        </div>
                        <div class="col-sm-6 d-flex justify-content-end">
                            <div class="dropdown show ">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuLinkBudget" data-bs-toggle="dropdown" aria-expanded="false">
                                    ปีงบประมาณ 2567
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="#" onclick="showChart('myChart_tmt_budjet_2567', '2567')">2567</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="showChart('myChart_tmt_budjet_2566', '2566')">2566</a></li>
                                    <li><a class="dropdown-item" href="#" onclick="showChart('myChart_tmt_budjet_2565', '2565')">2565</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <canvas id="myChart_tmt_budjet_2567" class="chang_tmt_budjet" width="400" height="120"></canvas>
                        <canvas id="myChart_tmt_budjet_2566" class="chang_tmt_budjet" width="400" height="120" style="display: none;"></canvas>
                        <canvas id="myChart_tmt_budjet_2565" class="chang_tmt_budjet" width="400" height="120" style="display: none;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- วิธีจัดซื้อจัดจ้าง ********************************************************* -->
<script>
    // setup
    const dataPurchaseMoney2565 = {
        labels: ['อื่นๆ', 'E-Bidding', 'เฉพาะเจาะจง'],
        datasets: [{
            label: 'จำนวนเงิน',
            data: [<?php echo (is_numeric($sum_money_by_purchase_other_y2565) ? $sum_money_by_purchase_other_y2565 : 0); ?>, <?php echo (is_numeric($sum_money_by_purchase_e_bidding_y2565) ? $sum_money_by_purchase_e_bidding_y2565 : 0); ?>, <?php echo (is_numeric($sum_money_by_purchase_specific_y2565) ? $sum_money_by_purchase_specific_y2565 : 0); ?>],
            backgroundColor: [
                '#48B2DF',
                '#28628E',
                '#30A4FC'
            ],
            borderColor: [
                '#48B2DF',
                '#28628E',
                '#30A4FC'
            ],
            borderWidth: 1
        }]
    };

    // config
    const configPurchaseMoney2565 = {
        type: 'pie',
        data: dataPurchaseMoney2565,
        options: {
            layout: {
                padding: 1
            },
            plugins: {
                legend: {
                    display: false,
                    position: 'bottom', // กำหนดให้ legend อยู่ด้านล่าง
                },
                labels: {
                    // position: 'outside',
                    // outsidePadding: 4,
                    // textMargin: 4,
                    // render: (ctx) => {
                    //     console.log(ctx);
                    // }
                },
                datalabels: {
                    formatter: (value, ctx) => {
                        // ตรวจสอบว่าค่ามีค่าน้อยกว่าหรือเท่ากับศูนย์หรือไม่
                        if (value <= 0) {
                            return ''; // ถ้าน้อยกว่าหรือเท่ากับศูนย์ให้คืนค่าว่างกลับไป
                        } else {
                            // ถ้ามากกว่าศูนย์ให้แสดงผลค่าตามปกติ
                            // return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value + ' บาท';
                             return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' โครงการ';
                        }
                    },
                    color: ['#000', '#000'], // กำหนดสีให้กับ datalabels ตามลำดับของข้อมูลใน labels
                    font: {
                        weight: 'bold',
                        size: 14
                    },
                    anchor: 'end',
                    align: 'start',
                    offset: 20
                }
            }
        },
        plugins: [ChartDataLabels]
    };

    // render init block
    const ChartPurchaseMoney2565 = new Chart(
        document.getElementById('ChartPurchaseMoney2565'),
        configPurchaseMoney2565
    );

    // setup
    const dataPurchaseProject2565 = {
        labels: ['อื่นๆ', 'E-Bidding', 'เฉพาะเจาะจง'],
        datasets: [{
            label: 'จำนวนโครงการ',
            data: [<?php echo (is_numeric($sum_project_by_purchase_other_y2565) ? $sum_project_by_purchase_other_y2565 : 0); ?>, <?php echo (is_numeric($sum_project_by_purchase_e_bidding_y2565) ? $sum_project_by_purchase_e_bidding_y2565 : 0); ?>, <?php echo (is_numeric($sum_project_by_purchase_specific_y2565) ? $sum_project_by_purchase_specific_y2565 : 0); ?>],
            backgroundColor: [
                '#D7B506',
                '#DF4848',
                '#FBBC41'
            ],
            borderColor: [
                '#D7B506',
                '#DF4848',
                '#FBBC41'
            ],
            borderWidth: 1
        }]
    };

    // config
    const configPurchaseProject2565 = {
        type: 'pie',
        data: dataPurchaseProject2565,
        options: {
            layout: {
                padding: 1
            },
            plugins: {
                legend: {
                    display: false,
                    position: 'bottom', // กำหนดให้ legend อยู่ด้านล่าง
                },
                labels: {
                    // position: 'outside',
                    // outsidePadding: 4,
                    // textMargin: 4,
                    // render: (ctx) => {
                    //     console.log(ctx);
                    // }
                },
                datalabels: {
                    formatter: (value, ctx) => {
                        // ตรวจสอบว่าค่ามีค่าน้อยกว่าหรือเท่ากับศูนย์หรือไม่
                        if (value <= 0) {
                            return ''; // ถ้าน้อยกว่าหรือเท่ากับศูนย์ให้คืนค่าว่างกลับไป
                        } else {
                            // ถ้ามากกว่าศูนย์ให้แสดงผลค่าตามปกติ
                            return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value + ' โครงการ';
                        }
                    },
                    color: ['#000', '#000'], // กำหนดสีให้กับ datalabels ตามลำดับของข้อมูลใน labels
                    font: {
                        weight: 'bold',
                        size: 14
                    },
                    anchor: 'end',
                    align: 'start',
                    offset: 20
                }
            }
        },
        plugins: [ChartDataLabels]
    };

    // render init block
    const ChartPurchaseProject2565 = new Chart(
        document.getElementById('ChartPurchaseProject2565'),
        configPurchaseProject2565
    );

    //--------------------------------------------------------------------------------------------------------------------------------------------------

    // setup
    const dataPurchaseMoney2566 = {
        labels: ['อื่นๆ', 'E-Bidding', 'เฉพาะเจาะจง'],
        datasets: [{
            label: 'จำนวนเงิน',
            data: [<?php echo (is_numeric($sum_money_by_purchase_other_y2566) ? $sum_money_by_purchase_other_y2566 : 0); ?>, <?php echo (is_numeric($sum_money_by_purchase_e_bidding_y2566) ? $sum_money_by_purchase_e_bidding_y2566 : 0); ?>, <?php echo (is_numeric($sum_money_by_purchase_specific_y2566) ? $sum_money_by_purchase_specific_y2566 : 0); ?>],
            backgroundColor: [
                '#48B2DF',
                '#28628E',
                '#30A4FC'
            ],
            borderColor: [
                '#48B2DF',
                '#28628E',
                '#30A4FC'
            ],
            borderWidth: 1
        }]
    };

    // config
    const configPurchaseMoney2566 = {
        type: 'pie',
        data: dataPurchaseMoney2566,
        options: {
            layout: {
                padding: 1
            },
            plugins: {
                legend: {
                    display: false,
                    position: 'bottom', // กำหนดให้ legend อยู่ด้านล่าง
                },
                labels: {
                    // position: 'outside',
                    // outsidePadding: 4,
                    // textMargin: 4,
                    // render: (ctx) => {
                    //     console.log(ctx);
                    // }
                },
                datalabels: {
                    formatter: (value, ctx) => {
                        // ตรวจสอบว่าค่ามีค่าน้อยกว่าหรือเท่ากับศูนย์หรือไม่
                        if (value <= 0) {
                            return ''; // ถ้าน้อยกว่าหรือเท่ากับศูนย์ให้คืนค่าว่างกลับไป
                        } else {
                            // ถ้ามากกว่าศูนย์ให้แสดงผลค่าตามปกติ
                            // return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value + ' บาท';
                             return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' โครงการ';
                        }
                    },
                    color: ['#000', '#000'], // กำหนดสีให้กับ datalabels ตามลำดับของข้อมูลใน labels
                    font: {
                        weight: 'bold',
                        size: 14
                    },
                    anchor: 'end',
                    align: 'start',
                    offset: 20
                }
            }
        },
        plugins: [ChartDataLabels]
    };

    // render init block
    const ChartPurchaseMoney2566 = new Chart(
        document.getElementById('ChartPurchaseMoney2566'),
        configPurchaseMoney2566
    );

    // setup
    const dataPurchaseProject2566 = {
        labels: ['อื่นๆ', 'E-Bidding', 'เฉพาะเจาะจง'],
        datasets: [{
            label: 'จำนวนโครงการ',
            data: [<?php echo (is_numeric($sum_project_by_purchase_other_y2566) ? $sum_project_by_purchase_other_y2566 : 0); ?>, <?php echo (is_numeric($sum_project_by_purchase_e_bidding_y2566) ? $sum_project_by_purchase_e_bidding_y2566 : 0); ?>, <?php echo (is_numeric($sum_project_by_purchase_specific_y2566) ? $sum_project_by_purchase_specific_y2566 : 0); ?>],
            backgroundColor: [
                '#D7B506',
                '#DF4848',
                '#FBBC41'
            ],
            borderColor: [
                '#D7B506',
                '#DF4848',
                '#FBBC41'
            ],
            borderWidth: 1
        }]
    };

    // config
    const configPurchaseProject2566 = {
        type: 'pie',
        data: dataPurchaseProject2566,
        options: {
            layout: {
                padding: 1
            },
            plugins: {
                legend: {
                    display: false,
                    position: 'bottom', // กำหนดให้ legend อยู่ด้านล่าง
                },
                labels: {
                    // position: 'outside',
                    // outsidePadding: 4,
                    // textMargin: 4,
                    // render: (ctx) => {
                    //     console.log(ctx);
                    // }
                },
                datalabels: {
                    formatter: (value, ctx) => {
                        // ตรวจสอบว่าค่ามีค่าน้อยกว่าหรือเท่ากับศูนย์หรือไม่
                        if (value <= 0) {
                            return ''; // ถ้าน้อยกว่าหรือเท่ากับศูนย์ให้คืนค่าว่างกลับไป
                        } else {
                            // ถ้ามากกว่าศูนย์ให้แสดงผลค่าตามปกติ
                            return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value + ' โครงการ';
                        }
                    },
                    color: ['#000', '#000'], // กำหนดสีให้กับ datalabels ตามลำดับของข้อมูลใน labels
                    font: {
                        weight: 'bold',
                        size: 14
                    },
                    anchor: 'end',
                    align: 'start',
                    offset: 20
                }
            }
        },
        plugins: [ChartDataLabels]
    };

    // render init block
    const ChartPurchaseProject2566 = new Chart(
        document.getElementById('ChartPurchaseProject2566'),
        configPurchaseProject2566
    );

    //--------------------------------------------------------------------------------------------------------------------------------------------------

    // setup
    const dataPurchaseMoney2567 = {
        labels: ['อื่นๆ', 'E-Bidding', 'เฉพาะเจาะจง'],
        datasets: [{
            label: 'จำนวนเงิน',
            data: [<?php echo (is_numeric($sum_money_by_purchase_other_y2567) ? $sum_money_by_purchase_other_y2567 : 0); ?>, <?php echo (is_numeric($sum_money_by_purchase_e_bidding_y2567) ? $sum_money_by_purchase_e_bidding_y2567 : 0); ?>, <?php echo (is_numeric($sum_money_by_purchase_specific_y2567) ? $sum_money_by_purchase_specific_y2567 : 0); ?>],
            backgroundColor: [
                '#48B2DF',
                '#28628E',
                '#30A4FC'
            ],
            borderColor: [
                '#48B2DF',
                '#28628E',
                '#30A4FC'
            ],
            borderWidth: 1
        }]
    };

    // config
    const configPurchaseMoney2567 = {
        type: 'pie',
        data: dataPurchaseMoney2567,
        options: {
            layout: {
                padding: 1
            },
            plugins: {
                legend: {
                    display: false,
                    position: 'bottom', // กำหนดให้ legend อยู่ด้านล่าง
                },
                labels: {
                    // position: 'outside',
                    // outsidePadding: 4,
                    // textMargin: 4,
                    // render: (ctx) => {
                    //     console.log(ctx);
                    // }
                },
                datalabels: {
                    formatter: (value, ctx) => {
                        // ตรวจสอบว่าค่ามีค่าน้อยกว่าหรือเท่ากับศูนย์หรือไม่
                        if (value <= 0) {
                            return ''; // ถ้าน้อยกว่าหรือเท่ากับศูนย์ให้คืนค่าว่างกลับไป
                        } else {
                            // ถ้ามากกว่าศูนย์ให้แสดงผลค่าตามปกติ
                            // return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value + ' บาท';
                             return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' โครงการ';
                        }
                    },
                    color: ['#000', '#000'], // กำหนดสีให้กับ datalabels ตามลำดับของข้อมูลใน labels
                    font: {
                        weight: 'bold',
                        size: 14
                    },
                    anchor: 'end',
                    align: 'start',
                    offset: 20
                }
            }
        },
        plugins: [ChartDataLabels]
    };

    // render init block
    const ChartPurchaseMoney2567 = new Chart(
        document.getElementById('ChartPurchaseMoney2567'),
        configPurchaseMoney2567
    );

    // setup
    const dataPurchaseProject2567 = {
        labels: ['อื่นๆ', 'E-Bidding', 'เฉพาะเจาะจง'],
        datasets: [{
            label: 'จำนวนโครงการ',
            data: [<?php echo (is_numeric($sum_project_by_purchase_other_y2567) ? $sum_project_by_purchase_other_y2567 : 0); ?>, <?php echo (is_numeric($sum_project_by_purchase_e_bidding_y2567) ? $sum_project_by_purchase_e_bidding_y2567 : 0); ?>, <?php echo (is_numeric($sum_project_by_purchase_specific_y2567) ? $sum_project_by_purchase_specific_y2567 : 0); ?>],
            backgroundColor: [
                '#D7B506',
                '#DF4848',
                '#FBBC41'
            ],
            borderColor: [
                '#D7B506',
                '#DF4848',
                '#FBBC41'
            ],
            borderWidth: 1
        }]
    };

    // config
    const configPurchaseProject2567 = {
        type: 'pie',
        data: dataPurchaseProject2567,
        options: {
            layout: {
                padding: 1
            },
            plugins: {
                legend: {
                    display: false,
                    position: 'bottom', // กำหนดให้ legend อยู่ด้านล่าง
                },
                labels: {
                    // position: 'outside',
                    // outsidePadding: 4,
                    // textMargin: 4,
                    // render: (ctx) => {
                    //     console.log(ctx);
                    // }
                },
                datalabels: {
                    formatter: (value, ctx) => {
                        // ตรวจสอบว่าค่ามีค่าน้อยกว่าหรือเท่ากับศูนย์หรือไม่
                        if (value <= 0) {
                            return ''; // ถ้าน้อยกว่าหรือเท่ากับศูนย์ให้คืนค่าว่างกลับไป
                        } else {
                            // ถ้ามากกว่าศูนย์ให้แสดงผลค่าตามปกติ
                            return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value + ' โครงการ';
                        }
                    },
                    color: ['#000', '#000'], // กำหนดสีให้กับ datalabels ตามลำดับของข้อมูลใน labels
                    font: {
                        weight: 'bold',
                        size: 14
                    },
                    anchor: 'end',
                    align: 'start',
                    offset: 20
                }
            }
        },
        plugins: [ChartDataLabels]
    };

    // render init block
    const ChartPurchaseProject2567 = new Chart(
        document.getElementById('ChartPurchaseProject2567'),
        configPurchaseProject2567
    );
</script>

<!-- ประเภทโครงการ ********************************************************* -->
<script>
    // setup
    const dataTypeMoney2565 = {
        labels: ['เช่า', 'จ้างก่อสร้าง', 'จ้างทำของ/เหมาบริการ', 'ซื้อ'],
        datasets: [{
            label: 'จำนวนเงิน',
            data: [<?php echo (is_numeric($sum_money_by_type_rent_y2565) ? $sum_money_by_type_rent_y2565 : 0); ?>, <?php echo (is_numeric($sum_money_by_type_construction_y2565) ? $sum_money_by_type_construction_y2565 : 0); ?>, <?php echo (is_numeric($sum_money_by_type_s_contractor_y2565) ? $sum_money_by_type_s_contractor_y2565 : 0); ?>, <?php echo (is_numeric($sum_money_by_type_buy_y2565) ? $sum_money_by_type_buy_y2565 : 0); ?>],
            backgroundColor: [
                '#30E8AA',
                '#48B2DF',
                '#28628E',
                '#30A4FC'
            ],
            borderColor: [
                '#30E8AA',
                '#48B2DF',
                '#28628E',
                '#30A4FC'
            ],
            borderWidth: 1
        }]
    };

    // config
    const configTypeMoney2565 = {
        type: 'pie',
        data: dataTypeMoney2565,
        options: {
            layout: {
                padding: 1
            },
            plugins: {
                legend: {
                    display: false,
                    position: 'bottom', // กำหนดให้ legend อยู่ด้านล่าง
                },
                labels: {
                    // position: 'outside',
                    // outsidePadding: 4,
                    // textMargin: 4,
                    // render: (ctx) => {
                    //     console.log(ctx);
                    // }
                },
                datalabels: {
                    formatter: (value, ctx) => {
                        // ตรวจสอบว่าค่ามีค่าน้อยกว่าหรือเท่ากับศูนย์หรือไม่
                        if (value <= 0) {
                            return ''; // ถ้าน้อยกว่าหรือเท่ากับศูนย์ให้คืนค่าว่างกลับไป
                        } else {
                            // ถ้ามากกว่าศูนย์ให้แสดงผลค่าตามปกติ
                            // return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value + ' บาท';
                             return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' โครงการ';
                        }
                    },
                    color: ['#000', '#000'], // กำหนดสีให้กับ datalabels ตามลำดับของข้อมูลใน labels
                    font: {
                        weight: 'bold',
                        size: 14
                    },
                    anchor: 'end',
                    align: 'start',
                    offset: 20
                }
            }
        },
        plugins: [ChartDataLabels]
    };

    // render init block
    const ChartTypeMoney2565 = new Chart(
        document.getElementById('ChartTypeMoney2565'),
        configTypeMoney2565
    );

    // setup
    const dataTypeProject2565 = {
        labels: ['เช่า', 'จ้างก่อสร้าง', 'จ้างทำของ/เหมาบริการ', 'ซื้อ'],
        datasets: [{
            label: 'จำนวนโครงการ',
            data: [<?php echo (is_numeric($sum_project_by_type_rent_y2565) ? $sum_project_by_type_rent_y2565 : 0); ?>, <?php echo (is_numeric($sum_project_by_type_construction_y2565) ? $sum_project_by_type_construction_y2565 : 0); ?>, <?php echo (is_numeric($sum_project_by_type_s_contractor_y2565) ? $sum_project_by_type_s_contractor_y2565 : 0); ?>, <?php echo (is_numeric($sum_project_by_type_buy_y2565) ? $sum_project_by_type_buy_y2565 : 0); ?>],
            backgroundColor: [
                '#CC750F',
                '#FFDD87',
                '#DF4848',
                '#FBBC41'
            ],
            borderColor: [
                '#CC750F',
                '#FFDD87',
                '#DF4848',
                '#FBBC41'
            ],
            borderWidth: 1
        }]
    };

    // config
    const configTypeProject2565 = {
        type: 'pie',
        data: dataTypeProject2565,
        options: {
            layout: {
                padding: 1
            },
            plugins: {
                legend: {
                    display: false,
                    position: 'bottom', // กำหนดให้ legend อยู่ด้านล่าง
                },
                labels: {
                    // position: 'outside',
                    // outsidePadding: 4,
                    // textMargin: 4,
                    // render: (ctx) => {
                    //     console.log(ctx);
                    // }
                },
                datalabels: {
                    formatter: (value, ctx) => {
                        // ตรวจสอบว่าค่ามีค่าน้อยกว่าหรือเท่ากับศูนย์หรือไม่
                        if (value <= 0) {
                            return ''; // ถ้าน้อยกว่าหรือเท่ากับศูนย์ให้คืนค่าว่างกลับไป
                        } else {
                            // ถ้ามากกว่าศูนย์ให้แสดงผลค่าตามปกติ
                            return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value + ' โครงการ';
                        }
                    },
                    color: ['#000', '#000'], // กำหนดสีให้กับ datalabels ตามลำดับของข้อมูลใน labels
                    font: {
                        weight: 'bold',
                        size: 14
                    },
                    anchor: 'end',
                    align: 'start',
                    offset: 20
                }
            }
        },
        plugins: [ChartDataLabels]
    };

    // render init block
    const ChartTypeProject2565 = new Chart(
        document.getElementById('ChartTypeProject2565'),
        configTypeProject2565
    );

    //--------------------------------------------------------------------------------------------------------------------------------------------------

    // setup
    const dataTypeMoney2566 = {
        labels: ['เช่า', 'จ้างก่อสร้าง', 'จ้างทำของ/เหมาบริการ', 'ซื้อ'],
        datasets: [{
            label: 'จำนวนเงิน',
            data: [<?php echo (is_numeric($sum_money_by_type_rent_y2566) ? $sum_money_by_type_rent_y2566 : 0); ?>, <?php echo (is_numeric($sum_money_by_type_construction_y2566) ? $sum_money_by_type_construction_y2566 : 0); ?>, <?php echo (is_numeric($sum_money_by_type_s_contractor_y2566) ? $sum_money_by_type_s_contractor_y2566 : 0); ?>, <?php echo (is_numeric($sum_money_by_type_buy_y2566) ? $sum_money_by_type_buy_y2566 : 0); ?>],
            backgroundColor: [
                '#30E8AA',
                '#48B2DF',
                '#28628E',
                '#30A4FC'
            ],
            borderColor: [
                '#30E8AA',
                '#48B2DF',
                '#28628E',
                '#30A4FC'
            ],
            borderWidth: 1
        }]
    };

    // config
    const configTypeMoney2566 = {
        type: 'pie',
        data: dataTypeMoney2566,
        options: {
            layout: {
                padding: 1
            },
            plugins: {
                legend: {
                    display: false,
                    position: 'bottom', // กำหนดให้ legend อยู่ด้านล่าง
                },
                labels: {
                    // position: 'outside',
                    // outsidePadding: 4,
                    // textMargin: 4,
                    // render: (ctx) => {
                    //     console.log(ctx);
                    // }
                },
                datalabels: {
                    formatter: (value, ctx) => {
                        // ตรวจสอบว่าค่ามีค่าน้อยกว่าหรือเท่ากับศูนย์หรือไม่
                        if (value <= 0) {
                            return ''; // ถ้าน้อยกว่าหรือเท่ากับศูนย์ให้คืนค่าว่างกลับไป
                        } else {
                            // ถ้ามากกว่าศูนย์ให้แสดงผลค่าตามปกติ
                            // return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value + ' บาท';
                             return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' โครงการ';
                        }
                    },
                    color: ['#000', '#000'], // กำหนดสีให้กับ datalabels ตามลำดับของข้อมูลใน labels
                    font: {
                        weight: 'bold',
                        size: 14
                    },
                    anchor: 'end',
                    align: 'start',
                    offset: 20
                }
            }
        },
        plugins: [ChartDataLabels]
    };

    // render init block
    const ChartTypeMoney2566 = new Chart(
        document.getElementById('ChartTypeMoney2566'),
        configTypeMoney2566
    );

    // setup
    const dataTypeProject2566 = {
        labels: ['เช่า', 'จ้างก่อสร้าง', 'จ้างทำของ/เหมาบริการ', 'ซื้อ'],
        datasets: [{
            label: 'จำนวนโครงการ',
            data: [<?php echo (is_numeric($sum_project_by_type_rent_y2566) ? $sum_project_by_type_rent_y2566 : 0); ?>, <?php echo (is_numeric($sum_project_by_type_construction_y2566) ? $sum_project_by_type_construction_y2566 : 0); ?>, <?php echo (is_numeric($sum_project_by_type_s_contractor_y2566) ? $sum_project_by_type_s_contractor_y2566 : 0); ?>, <?php echo (is_numeric($sum_project_by_type_buy_y2566) ? $sum_project_by_type_buy_y2566 : 0); ?>],
            backgroundColor: [
                '#CC750F',
                '#FFDD87',
                '#DF4848',
                '#FBBC41'
            ],
            borderColor: [
                '#CC750F',
                '#FFDD87',
                '#DF4848',
                '#FBBC41'
            ],
            borderWidth: 1
        }]
    };

    // config
    const configTypeProject2566 = {
        type: 'pie',
        data: dataTypeProject2566,
        options: {
            layout: {
                padding: 1
            },
            plugins: {
                legend: {
                    display: false,
                    position: 'bottom', // กำหนดให้ legend อยู่ด้านล่าง
                },
                labels: {
                    // position: 'outside',
                    // outsidePadding: 4,
                    // textMargin: 4,
                    // render: (ctx) => {
                    //     console.log(ctx);
                    // }
                },
                datalabels: {
                    formatter: (value, ctx) => {
                        // ตรวจสอบว่าค่ามีค่าน้อยกว่าหรือเท่ากับศูนย์หรือไม่
                        if (value <= 0) {
                            return ''; // ถ้าน้อยกว่าหรือเท่ากับศูนย์ให้คืนค่าว่างกลับไป
                        } else {
                            // ถ้ามากกว่าศูนย์ให้แสดงผลค่าตามปกติ
                            return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value + ' โครงการ';
                        }
                    },
                    color: ['#000', '#000'], // กำหนดสีให้กับ datalabels ตามลำดับของข้อมูลใน labels
                    font: {
                        weight: 'bold',
                        size: 14
                    },
                    anchor: 'end',
                    align: 'start',
                    offset: 20
                }
            }
        },
        plugins: [ChartDataLabels]
    };

    // render init block
    const ChartTypeProject2566 = new Chart(
        document.getElementById('ChartTypeProject2566'),
        configTypeProject2566
    );

    //--------------------------------------------------------------------------------------------------------------------------------------------------

    // setup
    const dataTypeMoney2567 = {
        labels: ['เช่า', 'จ้างก่อสร้าง', 'จ้างทำของ/เหมาบริการ', 'ซื้อ'],
        datasets: [{
            label: 'จำนวนเงิน',
            data: [<?php echo (is_numeric($sum_money_by_type_rent_y2567) ? $sum_money_by_type_rent_y2567 : 0); ?>, <?php echo (is_numeric($sum_money_by_type_construction_y2567) ? $sum_money_by_type_construction_y2567 : 0); ?>, <?php echo (is_numeric($sum_money_by_type_s_contractor_y2567) ? $sum_money_by_type_s_contractor_y2567 : 0); ?>, <?php echo (is_numeric($sum_money_by_type_buy_y2567) ? $sum_money_by_type_buy_y2567 : 0); ?>],
            backgroundColor: [
                '#30E8AA',
                '#48B2DF',
                '#28628E',
                '#30A4FC'
            ],
            borderColor: [
                '#30E8AA',
                '#48B2DF',
                '#28628E',
                '#30A4FC'
            ],
            borderWidth: 1
        }]
    };

    // config
    const configTypeMoney2567 = {
        type: 'pie',
        data: dataTypeMoney2567,
        options: {
            layout: {
                padding: 1
            },
            plugins: {
                legend: {
                    display: false,
                    position: 'bottom', // กำหนดให้ legend อยู่ด้านล่าง
                },
                labels: {
                    // position: 'outside',
                    // outsidePadding: 4,
                    // textMargin: 4,
                    // render: (ctx) => {
                    //     console.log(ctx);
                    // }
                },
                datalabels: {
                    formatter: (value, ctx) => {
                        // ตรวจสอบว่าค่ามีค่าน้อยกว่าหรือเท่ากับศูนย์หรือไม่
                        if (value <= 0) {
                            return ''; // ถ้าน้อยกว่าหรือเท่ากับศูนย์ให้คืนค่าว่างกลับไป
                        } else {
                            // ถ้ามากกว่าศูนย์ให้แสดงผลค่าตามปกติ
                            // return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value + ' บาท';
                             return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' โครงการ';
                        }
                    },
                    color: ['#000', '#000'], // กำหนดสีให้กับ datalabels ตามลำดับของข้อมูลใน labels
                    font: {
                        weight: 'bold',
                        size: 14
                    },
                    anchor: 'end',
                    align: 'start',
                    offset: 20
                }
            }
        },
        plugins: [ChartDataLabels]
    };

    // render init block
    const ChartTypeMoney2567 = new Chart(
        document.getElementById('ChartTypeMoney2567'),
        configTypeMoney2567
    );

    // setup
    const dataTypeProject2567 = {
        labels: ['เช่า', 'จ้างก่อสร้าง', 'จ้างทำของ/เหมาบริการ', 'ซื้อ'],
        datasets: [{
            label: 'จำนวนโครงการ',
            data: [<?php echo (is_numeric($sum_project_by_type_rent_y2567) ? $sum_project_by_type_rent_y2567 : 0); ?>, <?php echo (is_numeric($sum_project_by_type_construction_y2567) ? $sum_project_by_type_construction_y2567 : 0); ?>, <?php echo (is_numeric($sum_project_by_type_s_contractor_y2567) ? $sum_project_by_type_s_contractor_y2567 : 0); ?>, <?php echo (is_numeric($sum_project_by_type_buy_y2567) ? $sum_project_by_type_buy_y2567 : 0); ?>],
            backgroundColor: [
                '#CC750F',
                '#FFDD87',
                '#DF4848',
                '#FBBC41'
            ],
            borderColor: [
                '#CC750F',
                '#FFDD87',
                '#DF4848',
                '#FBBC41'
            ],
            borderWidth: 1
        }]
    };

    // config
    const configTypeProject2567 = {
        type: 'pie',
        data: dataTypeProject2567,
        options: {
            layout: {
                padding: 1
            },
            plugins: {
                legend: {
                    display: false,
                    position: 'bottom', // กำหนดให้ legend อยู่ด้านล่าง
                },
                labels: {
                    // position: 'outside',
                    // outsidePadding: 4,
                    // textMargin: 4,
                    // render: (ctx) => {
                    //     console.log(ctx);
                    // }
                },
                datalabels: {
                    formatter: (value, ctx) => {
                        // ตรวจสอบว่าค่ามีค่าน้อยกว่าหรือเท่ากับศูนย์หรือไม่
                        if (value <= 0) {
                            return ''; // ถ้าน้อยกว่าหรือเท่ากับศูนย์ให้คืนค่าว่างกลับไป
                        } else {
                            // ถ้ามากกว่าศูนย์ให้แสดงผลค่าตามปกติ
                            return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value + ' โครงการ';
                        }
                    },
                    color: ['#000', '#000'], // กำหนดสีให้กับ datalabels ตามลำดับของข้อมูลใน labels
                    font: {
                        weight: 'bold',
                        size: 14
                    },
                    anchor: 'end',
                    align: 'start',
                    offset: 20
                }
            }
        },
        plugins: [ChartDataLabels]
    };

    // render init block
    const ChartTypeProject2567 = new Chart(
        document.getElementById('ChartTypeProject2567'),
        configTypeProject2567
    );
</script>

<!-- สถานะโครงการ ********************************************************* -->
<script>
    // setup
    const dataStatusMoney2565 = {
        labels: ['สิ้นสุดสัญญา', 'ระหว่างดำเนินการ'],
        datasets: [{
            label: 'จำนวนเงิน',
            data: [<?php echo $sum_money_by_status_process_y2565; ?>, <?php echo $sum_money_by_status_end_y2565; ?>],
            backgroundColor: [
                '#28628E',
                '#30A4FC'
            ],
            borderColor: [
                '#28628E',
                '#30A4FC'
            ],
            borderWidth: 1
        }]
    };

    // config
    const configStatusMoney2565 = {
        type: 'pie',
        data: dataStatusMoney2565,
        options: {
            layout: {
                padding: 1
            },
            plugins: {
                legend: {
                    display: false,
                    position: 'bottom', // กำหนดให้ legend อยู่ด้านล่าง
                },
                labels: {
                    // position: 'outside',
                    // outsidePadding: 40,
                    // textMargin: 20,
                    // render: (ctx) => {
                    //     console.log(ctx);
                    // }
                },
                datalabels: {
                    formatter: (value, ctx) => {
                        // ตรวจสอบว่าค่ามีค่าน้อยกว่าหรือเท่ากับศูนย์หรือไม่
                        if (value <= 0) {
                            return ''; // ถ้าน้อยกว่าหรือเท่ากับศูนย์ให้คืนค่าว่างกลับไป
                        } else {
                            // ถ้ามากกว่าศูนย์ให้แสดงผลค่าตามปกติ
                            // return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value + ' บาท';
                             return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' โครงการ';
                        }
                    },
                    color: ['#000', '#000'], // กำหนดสีให้กับ datalabels ตามลำดับของข้อมูลใน labels
                    font: {
                        weight: 'bold',
                        size: 14
                    },
                    anchor: 'end',
                    align: 'center',
                    offset: 20
                }
            }
        },
        plugins: [ChartDataLabels]
    };

    // render init block
    const ChartStatusMoney2565 = new Chart(
        document.getElementById('ChartStatusMoney2565'),
        configStatusMoney2565
    );

    // setup
    const dataStatusProject2565 = {
        labels: ['สิ้นสุดสัญญา', 'ระหว่างดำเนินการ'],
        datasets: [{
            label: 'จำนวนโครงการ',
            data: [<?php echo $sum_project_status_process_y2565; ?>, <?php echo $sum_project_status_end_y2565; ?>],
            backgroundColor: [
                '#DF4848',
                '#FBBC41'
            ],
            borderColor: [
                '#DF4848',
                '#FBBC41'
            ],
            borderWidth: 1
        }]
    };

    // config
    const configStatusProject2565 = {
        type: 'pie',
        data: dataStatusProject2565,
        options: {
            layout: {
                padding: 1
            },
            plugins: {
                legend: {
                    display: false,
                    position: 'bottom', // กำหนดให้ legend อยู่ด้านล่าง
                },
                labels: {
                    // position: 'outside',
                    // outsidePadding: 4,
                    // textMargin: 4,
                    // render: (ctx) => {
                    //     console.log(ctx);
                    // }
                },
                datalabels: {
                    formatter: (value, ctx) => {
                        // ตรวจสอบว่าค่ามีค่าน้อยกว่าหรือเท่ากับศูนย์หรือไม่
                        if (value <= 0) {
                            return ''; // ถ้าน้อยกว่าหรือเท่ากับศูนย์ให้คืนค่าว่างกลับไป
                        } else {
                            // ถ้ามากกว่าศูนย์ให้แสดงผลค่าตามปกติ
                            return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value + ' โครงการ';
                        }
                    },
                    color: ['#000', '#000'], // กำหนดสีให้กับ datalabels ตามลำดับของข้อมูลใน labels
                    font: {
                        weight: 'bold',
                        size: 14
                    },
                    anchor: 'end',
                    align: 'start',
                    offset: 20
                }
            }
        },
        plugins: [ChartDataLabels]
    };

    // render init block
    const ChartStatusProject2565 = new Chart(
        document.getElementById('ChartStatusProject2565'),
        configStatusProject2565
    );


    // **************************************************************

    // setup
    const dataStatusMoney2566 = {
        labels: ['สิ้นสุดสัญญา', 'ระหว่างดำเนินการ'],
        datasets: [{
            label: 'จำนวนเงิน',
            data: [<?php echo $sum_money_by_status_process_y2566; ?>, <?php echo $sum_money_by_status_end_y2566; ?>],
            backgroundColor: [
                '#28628E',
                '#30A4FC'
            ],
            borderColor: [
                '#28628E',
                '#30A4FC'
            ],
            borderWidth: 1
        }]
    };

    // config
    const configStatusMoney2566 = {
        type: 'pie',
        data: dataStatusMoney2566,
        options: {
            layout: {
                padding: 1
            },
            plugins: {
                legend: {
                    display: false,
                    position: 'bottom', // กำหนดให้ legend อยู่ด้านล่าง
                },
                labels: {
                    // position: 'outside',
                    // outsidePadding: 4,
                    // textMargin: 4,
                    // render: (ctx) => {
                    //     console.log(ctx);
                    // }
                },
                datalabels: {
                    formatter: (value, ctx) => {
                        // ตรวจสอบว่าค่ามีค่าน้อยกว่าหรือเท่ากับศูนย์หรือไม่
                        if (value <= 0) {
                            return ''; // ถ้าน้อยกว่าหรือเท่ากับศูนย์ให้คืนค่าว่างกลับไป
                        } else {
                            // ถ้ามากกว่าศูนย์ให้แสดงผลค่าตามปกติ
                            // return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value + ' บาท';
                             return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' โครงการ';
                        }
                    },
                    color: ['#000', '#000'], // กำหนดสีให้กับ datalabels ตามลำดับของข้อมูลใน labels
                    font: {
                        weight: 'bold',
                        size: 14
                    },
                    anchor: 'end',
                    align: 'start',
                    offset: 20
                }
            }
        },
        plugins: [ChartDataLabels]
    };

    // render init block
    const ChartStatusMoney2566 = new Chart(
        document.getElementById('ChartStatusMoney2566'),
        configStatusMoney2566
    );

    // setup
    const dataStatusProject2566 = {
        labels: ['สิ้นสุดสัญญา', 'ระหว่างดำเนินการ'],
        datasets: [{
            label: 'จำนวนโครงการ',
            data: [<?php echo $sum_project_status_process_y2566; ?>, <?php echo $sum_project_status_end_y2566; ?>],
            backgroundColor: [
                '#DF4848',
                '#FBBC41'
            ],
            borderColor: [
                '#DF4848',
                '#FBBC41'
            ],
            borderWidth: 1
        }]
    };

    // config
    const configStatusProject2566 = {
        type: 'pie',
        data: dataStatusProject2566,
        options: {
            layout: {
                padding: 1
            },
            plugins: {
                legend: {
                    display: false,
                    position: 'bottom', // กำหนดให้ legend อยู่ด้านล่าง
                },
                labels: {
                    // position: 'outside',
                    // outsidePadding: 4,
                    // textMargin: 4,
                    // render: (ctx) => {
                    //     console.log(ctx);
                    // }
                },
                datalabels: {
                    formatter: (value, ctx) => {
                        // ตรวจสอบว่าค่ามีค่าน้อยกว่าหรือเท่ากับศูนย์หรือไม่
                        if (value <= 0) {
                            return ''; // ถ้าน้อยกว่าหรือเท่ากับศูนย์ให้คืนค่าว่างกลับไป
                        } else {
                            // ถ้ามากกว่าศูนย์ให้แสดงผลค่าตามปกติ
                            return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value + ' โครงการ';
                        }
                    },
                    color: ['#000', '#000'], // กำหนดสีให้กับ datalabels ตามลำดับของข้อมูลใน labels
                    font: {
                        weight: 'bold',
                        size: 14
                    },
                    anchor: 'end',
                    align: 'start',
                    offset: 20
                }
            }
        },
        plugins: [ChartDataLabels]
    };

    // render init block
    const ChartStatusProject2566 = new Chart(
        document.getElementById('ChartStatusProject2566'),
        configStatusProject2566
    );


    // **************************************************************

    // setup
    const dataStatusMoney2567 = {
        labels: ['สิ้นสุดสัญญา', 'ระหว่างดำเนินการ'],
        datasets: [{
            label: 'จำนวนเงิน',
            data: [<?php echo $sum_money_by_status_process_y2567; ?>, <?php echo $sum_money_by_status_end_y2567; ?>],
            backgroundColor: [
                '#28628E',
                '#30A4FC'
            ],
            borderColor: [
                '#28628E',
                '#30A4FC'
            ],
            borderWidth: 1
        }]
    };

    // config
    const configStatusMoney2567 = {
        type: 'pie',
        data: dataStatusMoney2567,
        options: {
            layout: {
                padding: 1
            },
            plugins: {
                legend: {
                    display: false,
                    position: 'bottom', // กำหนดให้ legend อยู่ด้านล่าง
                },
                labels: {
                    // position: 'outside',
                    // outsidePadding: 4,
                    // textMargin: 4,
                    // render: (ctx) => {
                    //     console.log(ctx);
                    // }
                },
                datalabels: {
                    formatter: (value, ctx) => {
                        // ตรวจสอบว่าค่ามีค่าน้อยกว่าหรือเท่ากับศูนย์หรือไม่
                        if (value <= 0) {
                            return ''; // ถ้าน้อยกว่าหรือเท่ากับศูนย์ให้คืนค่าว่างกลับไป
                        } else {
                            // ถ้ามากกว่าศูนย์ให้แสดงผลค่าตามปกติ
                            // return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value + ' บาท';
                             return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' โครงการ';
                        }
                    },
                    color: ['#000', '#000'], // กำหนดสีให้กับ datalabels ตามลำดับของข้อมูลใน labels
                    font: {
                        weight: 'bold',
                        size: 14
                    },
                    anchor: 'end',
                    align: 'start',
                    offset: 20
                }
            }
        },
        plugins: [ChartDataLabels]
    };

    // render init block
    const ChartStatusMoney2567 = new Chart(
        document.getElementById('ChartStatusMoney2567'),
        configStatusMoney2567
    );

    // setup
    const dataStatusProject2567 = {
        labels: ['สิ้นสุดสัญญา', 'ระหว่างดำเนินการ'],
        datasets: [{
            label: 'จำนวนโครงการ',
            data: [<?php echo $sum_project_status_process_y2567; ?>, <?php echo $sum_project_status_end_y2567; ?>],
            backgroundColor: [
                '#DF4848',
                '#FBBC41'
            ],
            borderColor: [
                '#DF4848',
                '#FBBC41'
            ],
            borderWidth: 1
        }]
    };

    // config
    const configStatusProject2567 = {
        type: 'pie',
        data: dataStatusProject2567,
        options: {
            layout: {
                padding: 1
            },
            plugins: {
                legend: {
                    display: false,
                    position: 'bottom', // กำหนดให้ legend อยู่ด้านล่าง
                },
                labels: {
                    // position: 'outside',
                    // outsidePadding: 4,
                    // textMargin: 4,
                    // render: (ctx) => {
                    //     console.log(ctx);
                    // }
                },
                datalabels: {
                    formatter: (value, ctx) => {
                        // ตรวจสอบว่าค่ามีค่าน้อยกว่าหรือเท่ากับศูนย์หรือไม่
                        if (value <= 0) {
                            return ''; // ถ้าน้อยกว่าหรือเท่ากับศูนย์ให้คืนค่าว่างกลับไป
                        } else {
                            // ถ้ามากกว่าศูนย์ให้แสดงผลค่าตามปกติ
                            return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value + ' โครงการ';
                        }
                    },
                    color: ['#000', '#000'], // กำหนดสีให้กับ datalabels ตามลำดับของข้อมูลใน labels
                    font: {
                        weight: 'bold',
                        size: 14
                    },
                    anchor: 'end',
                    align: 'start',
                    offset: 20
                }
            }
        },
        plugins: [ChartDataLabels]
    };

    // render init block
    const ChartStatusProject2567 = new Chart(
        document.getElementById('ChartStatusProject2567'),
        configStatusProject2567
    );
</script>

<!-- <script>
    // setup 
    const data = {
        labels: ['สิ้นสุดสัญญา', 'ระหว่างดำเนินการ', 'จำนวนเงินรวม', 'จำนวนเงินรวม'],
        datasets: [{
            label: 'ราคา 1',
            data: [18, 5],
            backgroundColor: [
                '#E18A8A',
                '#90CFFF',
            ],
            // borderColor: [
            //     '#DF4848',
            //     '#30A4FC',
            // ],
            // hoverBackgroundColor: [
            //     '#DF4848',
            //     '#30A4FC',
            // ],
        }, {
            label: 'ราคา 2',
            data: [11, 20],
            backgroundColor: [
                '#FFD27B',
                '#9ADCC6',
            ],
            // borderColor: [
            //     '#FBBC41',
            //     '#30E8AA',
            // ],
            // hoverBackgroundColor: [
            //     '#FBBC41',
            //     '#30E8AA',
            // ],
        }]
    };

    

    // config 
    const config = {
        type: 'doughnut',
        data,
        options: {
            borderWidth: 1,
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                    position: 'bottom', // กำหนดให้ legend อยู่ด้านล่าง
                },
                labels: {
                    position: 'outside',
                    outsidePadding: 4,
                    textMargin: 4,
                    // render: (ctx) => {
                    //     console.log(ctx);
                    // }
                },
                datalabels: {
                    formatter: (value, ctx) => {
                        return ctx.chart.data.labels[ctx.dataIndex] + ': ' + value;
                    },
                    color: ['#DF4848', '#30A4FC', '#FBBC41', '#30E8AA'], // กำหนดสีให้กับ datalabels ตามลำดับของข้อมูลใน labels
                    font: {
                        weight: 'bold',
                        size: 14
                    },
                    anchor: 'center',
                    align: 'center',
                    offset: 8
                }
            }
        },
        plugins: [{
            beforeDraw: function(chart) {
                const ctx = chart.ctx;
                const chartArea = chart.chartArea;

                // คำนวณพิกัด x และ y ของ label จากตำแหน่งมุมของแต่ละข้อมูลในวงกลม
                const xCoor = chartArea.left + chartArea.right / 2;
                const yCoor = chartArea.top + chartArea.bottom / 2;

                ctx.save();
                ctx.font = 'bold 14px sans-serif';
                ctx.fillStyle = '#A7A7A7';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';

                // วาด label
                ctx.fillText('xx โครงการ', xCoor, yCoor);
                ctx.fillText('xx บาท', xCoor, yCoor + 20); // 20 คือความสูงของบรรทัดที่สอง
                ctx.restore();
            }
        }, ChartDataLabels]
    };

    // render init block
    const ChartStatus = new Chart(
        document.getElementById('ChartStatus'),
        config
    );


    // const doughnutLabel = {
    //     id: 'doughnutLabel',
    //     beforeDatasetsDraw(chart, args, pluginOptions) {
    //         const {
    //             ctx,
    //             chartArea,
    //             data
    //         } = chart;

    //         // คำนวณพิกัด x และ y ของ label จากตำแหน่งมุมของแต่ละข้อมูลในวงกลม
    //         const xCoor = chartArea.left + chartArea.right / 2;
    //         const yCoor = chartArea.top + chartArea.bottom / 2;

    //         ctx.save();
    //         ctx.font = 'bold 14px sans-serif';
    //         ctx.fillStyle = '#A7A7A7';
    //         ctx.textAlign = 'center';
    //         ctx.textBaseline = 'middle';

    //         // วาด label
    //         ctx.fillText('xx โครงการ', xCoor, yCoor);
    //         ctx.fillText('xx บาท', xCoor, yCoor + 20); // 20 คือความสูงของบรรทัดที่สอง
    //         ctx.restore();
    //     }
    // }
</script> -->