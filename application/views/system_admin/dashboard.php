<style>
    .one-line-ellipsis {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }

    .dot_complain1 {
        height: 15px;
        width: 15px;
        background-color: #3F9F52;
        border-radius: 50%;
        display: inline-block;
    }

    .dot_complain2 {
        height: 15px;
        width: 15px;
        background-color: #95C6FF;
        border-radius: 50%;
        display: inline-block;
    }

    .dot_complain3 {
        height: 15px;
        width: 15px;
        background-color: #97BF04;
        border-radius: 50%;
        display: inline-block;
    }

    .dot_complain4 {
        height: 15px;
        width: 15px;
        background-color: #FFD361;
        border-radius: 50%;
        display: inline-block;
    }

    .gray888 {
        color: #888
    }

    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .head-mid {
        font-size: 10px;
    }

    .small-font {
        font-size: 15px;
        color: #aaaaaa;
    }

    .btn-sky {
        color: #07834D;
        background-color: #6BBF4D;
        border-radius: 10px;
        font-size: 12px;
    }

    .cards-container {
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    .cards {
        width: 60px;
        height: 40px;
        text-align: center;
        padding-top: 5px;
        color: #fff;
        font-weight: bold;
        margin-right: 10px;
        /* เพิ่มระยะห่างระหว่าง card ให้เรียงกันแนวนอน */
    }

    svg {
        margin: 0 auto;
        text-align: center;
        width: 100%;
        padding-top: 40px;
    }

    polyline {
        stroke-dasharray: 1000;
        stroke-dashoffset: 1000;
        animation: dash 5s ease-in forwards;
    }

    @keyframes dash {
        to {
            stroke-dashoffset: 0;
        }
    }

    p {
        font-size: 2rem;
        text-align: center;
        color: #efefef;
    }

    .name {
        font-size: .8rem;
        font-weight: light;
    }


    /* ล่างสุดเมนูล่างสุด */

    @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap");

    * {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
    }

    /* ถ้ามันสั้นจะขอบเลื่อน อันนี้ตัวครอบคอบเลื่อน slide แนวนอน สไลด์แนวนอน ****************************************** */

    .main-container {
        background: #fff;
        color: #abafc6;
        border-radius: 5px;
        padding: 20px;
        width: 100%;
        height: 100%;
    }

    .year-stats {
        white-space: nowrap;
        max-height: 200px;
        overflow: hidden;
    }

    .year-stats:hover {
        overflow-x: auto;
    }

    /* SCROLL BAR STYLE (ONLY WORKS IN CHROME) */
    /* Width */
    ::-webkit-scrollbar {
        height: 5px;
        width: 100%;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #3F9F52;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #97BF04;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb {
        background: #97BF04;
    }

    /* ************************************************************************************* */
    .month-group {
        cursor: pointer;
        max-width: 400px;
        height: 110px;
        margin: 10px;
        display: inline-block;
    }

    .bar {
        background-color: #3F9F52;
        width: 20px;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .month-group:hover .bar,
    .selected .bar {
        background: #97BF04;
    }

    .month-group:hover p,
    .selected p {
        color: #97BF04;
    }

    .month {
        color: #000;
    }

    <?php foreach ($users_each_day as $day_data) : ?>.bar.h-<?php echo min(100, $day_data['user_count']); ?> {
        height: <?php echo min(100, $day_data['user_count']); ?>%;
    }

    <?php endforeach; ?>.stats-info {
        margin-top: 15px;
        display: flex;
        align-items: center;
        justify-content: space-around;
        position: relative;
    }

    .graph-container {
        position: relative;
    }

    .percent {
        display: block;
        width: 120px;
        height: 120px;
    }

    .circle {
        stroke: #915db1;
        fill: none;
        stroke-width: 3;
    }

    .circle:nth-child(2) {
        stroke: #e59f3c;
    }

    .circle:nth-child(3) {
        stroke: #5397d6;
    }

    .circle:nth-child(4) {
        stroke: #4cc790;
    }

    .graph-container p {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 12px;
        color: #fff;
        text-align: center;
    }

    .info p {
        margin-bottom: 10px;
    }

    .info span {
        color: #fff;
    }
</style>
<!-- Tasks Card Example -->
<div class="row">
    <div class="col-xl-6 col-md-6">
        <!-- Dropdown Card Example -->
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="py-3 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold text-black ml-4">Storage</h5>
                <a class="open-button btn btn-sky btn-sm mr-3" id="myBtn">
                    Upgrade</a>
            </div>
            <!-- Card Body -->
            <div class="card-body" style="margin-top: -45px;">
                <div class="row">
                    <div class="col-12 mb-2">
                        <?php foreach ($storage as $server) : ?>
                            <?php
                            $serverStorage = $server->server_storage;
                            $serverCurrent = $server->server_current;
                            $percentage = ($serverCurrent / $serverStorage) * 100;
                            $color = 'green'; // เริ่มต้นเป็นสีเขียว (1-69%)
                            if ($percentage >= 70 && $percentage <= 89) {
                                $color = 'orange'; // 70-89% ให้เปลี่ยนเป็นสีส้ม
                            } elseif ($percentage >= 90) {
                                $color = 'red'; // 90% ขึ้นไป ให้เปลี่ยนเป็นสีแดง
                            }
                            ?>

                    </div>
                </div>
                <h5 style="margin-top:5px;">
                    <?php // สามารถแสดงเปอร์เซ็นต์ที่คำนวณได้โดยใช้ $percentage 
                    ?>
                    <?php echo number_format($percentage, 2); ?>%
                </h5>
                <div class="progress progress-sm mr-6">
                    <div class="progress-bar" role="progressbar" style="background-color: <?php echo $color; ?>; width: <?php echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <!-- color: <?php echo $color; ?>; -->
                <div class="mt-3 row">
                    <div class="col-sm-4">
                        <span style="font-size: 13px; color: #888;">Used space: <?php echo number_format($serverCurrent, 2); ?> GB</span>
                    </div>
                    <div class="col-sm-4">
                        <span style="font-size: 13px; color: #888;">Free space: <?php echo number_format($serverStorage - $serverCurrent, 2); ?> GB</span>
                    </div>
                    <div class="col-sm-4">
                        <span style="font-size: 13px; color: #888;">Capacity: <?php echo number_format($serverStorage, 2); ?> GB</span>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>

        <!-- Dropdown Card Example -->
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="py-3 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold text-black ml-4">เรื่องร้องเรียน</h5>
                <div class="dropdown no-arrow mr-3">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <!-- <div class="dropdown-header"></div> -->
                        <a class="dropdown-item" href="<?php echo site_url('Complain_backend'); ?>">เพิ่มเติม</a>
                        <!-- <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a> -->
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body" style="margin-top: -30px;">
                <div class="row">
                    <div class="col-sm-4">
                        &nbsp;
                    </div>
                    <div class="col-sm-2">
                        <p class="small-font">ผู้ร้องเรียน</p>
                    </div>
                    <div class="col-sm-2">
                        <p class="small-font">หมวดหมู่</p>
                    </div>
                    <div class="col-sm-2">
                        <p class="small-font">สถานะ</p>
                    </div>
                    <div class="col-sm-2">
                        &nbsp;
                    </div>
                </div>
                <div class="row">
                    <?php foreach ($rs_complain as $rs) { ?>
                        <div class="col-sm-4">
                            <span class="limit-font-one"><?= $rs->complain_topic; ?></span>
                            <?php
                            // วันที่จากฐานข้อมูลหรือตัวแปรอื่น ๆ
                            $complain_date = $rs->complain_datesave;

                            // แปลงวันที่เป็นวัตถุ DateTime
                            $datetime = new DateTime($complain_date);

                            // วันที่ปัจจุบัน
                            $today = new DateTime();

                            // เปรียบเทียบวันที่
                            if ($datetime->format('Y-m-d') === $today->format('Y-m-d')) {
                                // วันนี้
                                $formatted_date = 'วันนี้';
                            } elseif ($datetime->format('Y-m-d') === $today->modify('-1 day')->format('Y-m-d')) {
                                // เมื่อวาน
                                $formatted_date = 'เมื่อวาน';
                            } else {
                                // วันที่อื่น ๆ
                                $formatted_date = $datetime->format('วันที่ d/m/Y');
                            }

                            // เวลา
                            $formatted_time = $datetime->format('H:i');

                            // แสดงผล
                            ?>
                            <span style="font-size: 13; color: #888;"><?= $formatted_date . ' ' . $formatted_time; ?></span>
                        </div>
                        <div class="col-sm-2 mt-2">
                            <p class="small-font limit-font-one" style="font-size: 13px;"><?= $rs->complain_by; ?></p>
                        </div>
                        <div class="col-sm-2 mt-2">
                            <p class="small-font limit-font-one" style="font-size: 13px;"><?= $rs->complain_type; ?></p>
                        </div>
                        <div class="col-sm-2 mt-2">
                            <p class="small-font" style="font-size: 11px; background-color:
                <?php if ($rs->complain_status === 'รับเรื่องแล้ว') : ?>
                    #D9EAFF;
                <?php elseif ($rs->complain_status === 'กำลังดำเนินการ') : ?>
                    #CFD7FE;
                <?php elseif ($rs->complain_status === 'รอดำเนินการ') : ?>
                    #FFECE7;
                <?php elseif ($rs->complain_status === 'ดำเนินการเรียบร้อย') : ?>
                    #DBFFDD;
                <?php elseif ($rs->complain_status === 'ยกเลิก') : ?>
                    #FFE3E3;
                <?php else : ?>
                    #FFFBDC; /* สีเริ่มต้นหากไม่ตรงกับเงื่อนไขใดๆ */
                <?php endif; ?>
                ; color:
                <?php if ($rs->complain_status === 'รับเรื่องแล้ว') : ?>
                    #4C97EE;
                <?php elseif ($rs->complain_status === 'กำลังดำเนินการ') : ?>
                    #3D5AF1;
                <?php elseif ($rs->complain_status === 'รอดำเนินการ') : ?>
                    #E05A33;
                <?php elseif ($rs->complain_status === 'ดำเนินการเรียบร้อย') : ?>
                    #00B73E;
                <?php elseif ($rs->complain_status === 'ยกเลิก') : ?>
                    #FF0202;
                <?php else : ?>
                    #FFC700; /* สีเริ่มต้นหากไม่ตรงกับเงื่อนไขใดๆ */
                <?php endif; ?>
                border: 1.3px solid
                <?php if ($rs->complain_status === 'รับเรื่องแล้ว') : ?>
                    #4C97EE;
                <?php elseif ($rs->complain_status === 'กำลังดำเนินการ') : ?>
                    #3D5AF1;
                <?php elseif ($rs->complain_status === 'รอดำเนินการ') : ?>
                    #E05A33;
                <?php elseif ($rs->complain_status === 'ดำเนินการเรียบร้อย') : ?>
                    #00B73E;
                <?php elseif ($rs->complain_status === 'ยกเลิก') : ?>
                    #FF0202;
                <?php else : ?>
                    #FFC700; /* สีเริ่มต้นหากไม่ตรงกับเงื่อนไขใดๆ */
                <?php endif; ?>
                ;
                border-radius: 20px; /* เพิ่มเส้นโค้ง */
                padding: 5px; /* เพิ่มขอบรอบตัวอักษร */
                ">
                                <?= $rs->complain_status; ?>
                            </p>
                        </div>
                        <div class="col-sm-2 mt-2 text-center">
                            <a href="<?= site_url('Complain_backend/detail/' . $rs->complain_id); ?>"><i class="fa fa-eye" aria-hidden="true"></i> view</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- Dropdown Card Example -->
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="py-3 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold text-black ml-4">ภาพรวมแจ้งเรื่องร้องเรียน ปี 2567</h5>
                <div class="dropdown no-arrow mr-3">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <!-- <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> -->
                        <br>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <!-- <div class="dropdown-header"></div> -->
                        <a class="dropdown-item" href="#">เพิ่มเติม</a>
                        <!-- <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a> -->
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="mypiechart" style="text-align: center; display: flex; justify-content: center; align-items: center;">
                            <canvas id="myCanvas" width="160px" height="160px"></canvas>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="mt-2"></div>
                        <div class="dot_complain1"></div>
                        <span class="mx-1">จำนวนเรื่องร้องเรียน</span>
                        <span class="mx-4"></span>
                        <span><?php echo $total_complain_year; ?> เรื่อง/ปี</span>
                        <br>
                        <div class="mt-2"></div>
                        <div class="dot_complain2"></div>
                        <span class="mx-1">ดำเนินการเสร็จสิ้น</span>
                        <span class="mx-3"></span>
                        <span class="ml-5"><?php echo $total_complain_success; ?> เรื่อง</span>
                        <br>
                        <div class="mt-2"></div>
                        <div class="dot_complain3"></div>
                        <span class="mx-1">รอดำเนินการ</span>
                        <span class="mx-5"></span>
                        <span class="ml-3"><?php echo $count_complain_operation; ?> เรื่อง</span>
                        <br>
                        <div class="mt-2"></div>
                        <div class="dot_complain4"></div>
                        <span class="mx-1">กำลังดำเนินการ</span>
                        <span class="mx-4"></span>
                        <span class="ml-5"><?php echo $total_complain_doing; ?> เรื่อง</span>
                    </div>
                </div>
            </div>
        </div>



    </div>


    <div class="col-xl-6 col-md-6">
        <!-- Dropdown Card Example -->
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="py-3 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold text-black ml-4">จำนวนผู้เข้าชม</h5>
                <div class="dropdown no-arrow mr-3">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <!-- <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> -->
                        <br>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <!-- <div class="dropdown-header"></div> -->
                        <a class="dropdown-item" href="#">เพิ่มเติม</a>
                        <!-- <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a> -->
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body" style="margin-top: -5px;">
                <?php foreach ($most_viewed_tables as $table) : ?>
                    <div class="col mb-2">
                        <div class="progress mr-2" style="height: 25px">
                            <div class="progress-bar" role="progressbar" style="width: 100%; background-image: linear-gradient(90deg, #F99A42, #FFF1A7, #ffff); border: 1px solid #FFF1A7" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                <div class="d-flex justify-content-start" style="padding-left:20px;">
                                    <span><?= $table->table_name; ?></span>
                                </div>
                                <span style="color: rgb(0, 0, 0); margin-left: 80%;"><?= $table->total_views; ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Dropdown Card Example -->
        <div class="card shadow">
            <!-- Card Header - Dropdown -->
            <div class="py-3 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold text-black ml-4">จำนวนสมาชิกในระบบ</h5>
                <div class="dropdown no-arrow mr-3">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <!-- <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> -->
                        <br>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <!-- <div class="dropdown-header"></div> -->
                        <a class="dropdown-item" href="#">เพิ่มเติม</a>
                        <!-- <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a> -->
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="col mb-3">
                    <div class="progress mr-2" style="height: 25px">
                        <div class="progress-bar" role="progressbar" style="width: 100%; background-image: linear-gradient(90deg, #67A875, #C4DBBA, white); border: 1px solid #C4DBBA" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                            <div class="d-flex justify-content-start" style="padding-left:20px;">
                                <span>คณะผู้บริหาร</span>
                            </div>
                            <span style="color: rgb(0, 0, 0); margin-left: 80%;"><?php echo $count_member_pid_3; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="progress mr-2" style="height: 25px">
                        <div class="progress-bar" role="progressbar" style="width: 100%; background-image: linear-gradient(90deg, #67A875, #C4DBBA, white); border: 1px solid #C4DBBA" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                            <div class="d-flex justify-content-start" style="padding-left:20px;">
                                <span>สมาชิกสภาตำบล</span>
                            </div>
                            <span style="color: rgb(0, 0, 0); margin-left: 80%;"><?php echo $count_member_pid_8; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="progress mr-2" style="height: 25px">
                        <div class="progress-bar" role="progressbar" style="width: 100%; background-image: linear-gradient(90deg, #67A875, #C4DBBA, white); border: 1px solid #C4DBBA" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                            <div class="d-flex justify-content-start" style="padding-left:20px;">
                                <span>หัวหน้าส่วนราชการ</span>
                            </div>
                            <span style="color: rgb(0, 0, 0); margin-left: 80%;"><?php echo $count_member_pid_10; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="progress mr-2" style="height: 25px">
                        <div class="progress-bar" role="progressbar" style="width: 100%; background-image: linear-gradient(90deg, #67A875, #C4DBBA, white); border: 1px solid #C4DBBA" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                            <div class="d-flex justify-content-start" style="padding-left:20px;">
                                <span>สำนักปลัด</span>
                            </div>
                            <span style="color: rgb(0, 0, 0); margin-left: 80%;"><?php echo $count_member_pid_7; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="progress mr-2" style="height: 25px">
                        <div class="progress-bar" role="progressbar" style="width: 100%; background-image: linear-gradient(90deg, #67A875, #C4DBBA, white); border: 1px solid #C4DBBA" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                            <div class="d-flex justify-content-start" style="padding-left:20px;">
                                <span>กองคลัง</span>
                            </div>
                            <span style="color: rgb(0, 0, 0); margin-left: 80%;"><?php echo $count_member_pid_5; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="progress mr-2" style="height: 25px">
                        <div class="progress-bar" role="progressbar" style="width: 100%; background-image: linear-gradient(90deg, #67A875, #C4DBBA, white); border: 1px solid #C4DBBA" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                            <div class="d-flex justify-content-start" style="padding-left:20px;">
                                <span>กองช่าง</span>
                            </div>
                            <span style="color: rgb(0, 0, 0); margin-left: 80%;"><?php echo $count_member_pid_6; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="progress mr-2" style="height: 25px">
                        <div class="progress-bar" role="progressbar" style="width: 100%; background-image: linear-gradient(90deg, #67A875, #C4DBBA, white); border: 1px solid #C4DBBA" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                            <div class="d-flex justify-content-start" style="padding-left:20px;">
                                <span>กองสวัสดิการสังคม</span>
                            </div>
                            <span style="color: rgb(0, 0, 0); margin-left: 80%;"><?php echo $count_member_pid_11; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="progress mr-2" style="height: 25px">
                        <div class="progress-bar" role="progressbar" style="width: 100%; background-image: linear-gradient(90deg, #67A875, #C4DBBA, white); border: 1px solid #C4DBBA" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                            <div class="d-flex justify-content-start" style="padding-left:20px;">
                                <span>หน่วยตรวจสอบภายใน</span>
                            </div>
                            <span style="color: rgb(0, 0, 0); margin-left: 80%;"><?php echo $count_member_pid_4; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- The Modal -->
<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <h5>เลือกความความจำที่ต้องการอัพเกรด</h5>
        <form method="post" action="<?php echo base_url('system_admin/update_upload_limit'); ?>">
            <input type="hidden" name="server_storage" value="10"> <!-- ส่งค่าเพิ่มขนาดพื้นที่ที่จำกัดเป็น 20MB -->
            <button class="btn btn-light" type="submit">10GB</button>
        </form>

        <form method="post" action="<?php echo base_url('system_admin/update_upload_limit'); ?>">
            <input type="hidden" name="server_storage" value="15"> <!-- ส่งค่าเพิ่มขนาดพื้นที่ที่จำกัดเป็น 200MB -->
            <button class="btn btn-light" type="submit">15GB</button>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-xl-5 col-md-5 mb-5">

    </div>
</div>
<div class="col-xl-4 col-md-4 mb-2">

</div>
<div class="col-xl-3 col-md-3 mb-4">

</div>
</div>


<script src="<?= base_url('asset/'); ?>rpie.js"></script>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    var obj = {
        values: [<?php echo $total_complain_year; ?>, <?php echo $total_complain_success; ?>, <?php echo $count_complain_operation; ?>, <?php echo $total_complain_doing; ?>],
        colors: ['#3F9F52', '#95C6FF ', '#97BF04', '#FFD361', '#9E9E9E'],
        animation: true, // Takes boolean value & default behavious is false
        animationSpeed: 10, // Time in miliisecond & default animation speed is 20ms
        fillTextData: false, // Takes boolean value & text is not generate by default 
        fillTextColor: '#fff', // For Text colour & default colour is #fff (White)
        fillTextAlign: 1.35, // for alignment of inner text position i.e. higher values gives closer view to center & default text alignment is 1.85 i.e closer to center
        fillTextPosition: 'inner', // 'horizontal' or 'vertical' or 'inner' & default text position is 'horizontal' position i.e. outside the canvas
        doughnutHoleSize: 50, // Percentage of doughnut size within the canvas & default doughnut size is null
        doughnutHoleColor: '#fff', // For doughnut colour & default colour is #fff (White)
        offset: 0, // Offeset between two segments & default value is null
        pie: 'normal', // if the pie graph is single stroke then we will add the object key as "stroke" & default is normal as simple as pie graph
        isStrokePie: {
            stroke: 20, // Define the stroke of pie graph. It takes number value & default value is 20
            overlayStroke: true, // Define the background stroke within pie graph. It takes boolean value & default value is false
            overlayStrokeColor: '#eee', // Define the background stroke colour within pie graph & default value is #eee (Grey)
            strokeStartEndPoints: 'Yes', // Define the start and end point of pie graph & default value is No
            strokeAnimation: true, // Used for animation. It takes boolean value & default value is true
            strokeAnimationSpeed: 40, // Used for animation speed in miliisecond. It takes number & default value is 20ms
            fontSize: '60px', // Used to define text font size & default value is 60px
            textAlignement: 'center', // Used for position of text within the pie graph & default value is 'center'
            fontFamily: 'Arial', // Define the text font family & the default value is 'Arial'
            fontWeight: 'bold' //  Define the font weight of the text & the default value is 'bold'
        }
    };

    var values = obj.values;
    var colors = obj.colors;

    for (var i = 0; i < values.length; i++) {
        var cardId = "card" + values[i];
        var card = document.getElementById(cardId);
        if (card) {
            card.style.backgroundColor = colors[i];
        }
    }

    //Generate myCanvas		
    generatePieGraph('myCanvas', obj);
</script>


<script type="text/javascript">


</script>