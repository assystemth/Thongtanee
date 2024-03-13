<!-- ส่วนทางขวา -->
<div class="flex-item-right">
    <div class="all-report mt-5">
        <h4 class="font-topic-all-report">รายงานภาพรวม</h4>
        <div class="card-all-report mt-3">
            <h5 class="font-head-all-report">ภาพรวมแจ้งเรื่องร้องเรียน ประจำปี 2567</h5>
            <div class="row">
                <div class="col-sm-4">
                    <div class="mypiechart" style="text-align: center; display: flex; justify-content: center; align-items: center;">
                        <canvas id="myCanvas" width="200px" height="280px"></canvas>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="box-content-report1 mt-4">
                        <div class="row">
                            <div class="col-sm-6">
                                <span class="font-detail-all-report">จำนวนเรื่องร้องเรียน</span>
                            </div>
                            <div class="col-sm-6 d-flex justify-content-end">
                                <span class="font-detail-all-report">1234</span>
                            </div>
                        </div>
                    </div>
                    <div class="box-content-report2 mt-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <span class="font-detail-all-report">ดำเนินการเรียบร้อย</span>
                            </div>
                            <div class="col-sm-6 d-flex justify-content-end">
                                <span class="font-detail-all-report">1234</span>
                            </div>
                        </div>
                    </div>
                    <div class="box-content-report3 mt-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <span class="font-detail-all-report">รอดำเนินการ</span>
                            </div>
                            <div class="col-sm-6 d-flex justify-content-end">
                                <span class="font-detail-all-report">1234</span>
                            </div>
                        </div>
                    </div>
                    <div class="box-content-report4 mt-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <span class="font-detail-all-report">รับเรื่องแล้ว</span>
                            </div>
                            <div class="col-sm-6 d-flex justify-content-end">
                                <span class="font-detail-all-report">1234</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="box-content-report5 mt-4">
                        <div class="row">
                            <div class="col-sm-6">
                                <span class="font-detail-all-report">กำลังดำเนินการ</span>
                            </div>
                            <div class="col-sm-6 d-flex justify-content-end">
                                <span class="font-detail-all-report">1234</span>
                            </div>
                        </div>
                    </div>
                    <div class="box-content-report6 mt-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <span class="font-detail-all-report">รอรับเรื่อง</span>
                            </div>
                            <div class="col-sm-6 d-flex justify-content-end">
                                <span class="font-detail-all-report">1234</span>
                            </div>
                        </div>
                    </div>
                    <div class="box-content-report7 mt-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <span class="font-detail-all-report">ยกเลิก</span>
                            </div>
                            <div class="col-sm-6 d-flex justify-content-end">
                                <span class="font-detail-all-report">1234</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="all-complain mt-5">
        <h4 class="font-topic-all-report">เรื่องร้องเรียน</h4>
        <div class="card-all-complain">
            <div class="row">
                <div class="col-sm-3">
                    <p class="small-font">เรื่อง</p>
                </div>
                <div class="col-sm-3">
                    <p class="small-font">ผู้แจ้ง</p>
                </div>
                <div class="col-sm-3">
                    <p class="small-font">สถานะ</p>
                </div>
                <div class="col-sm-3">
                    &nbsp;
                </div>
            </div>
            <div class="row">
                <?php foreach ($rs_complain as $key => $rs) { ?>
                    <?php
                    // สร้าง class สำหรับเส้นทางซ้าย
                    $line_class = ($key % 2 == 0) ? 'line-complain-left1' : 'line-complain-left2';
                    ?>

                    <div class="col-sm-3 <?= $line_class; ?>">
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
                    <div class="col-sm-3 mt-2">
                        <p class="small-font limit-font-one" style="font-size: 13px;"><?= $rs->complain_by; ?></p>
                    </div>
                    <div class="col-sm-2 mt-2">
                        <p class="small-font text-center" style=" font-size: 14px; background-color:
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
                border-radius: 12.887px; /* เพิ่มเส้นโค้ง */
                padding: 5px; /* เพิ่มขอบรอบตัวอักษร */
                ">
                            <?= $rs->complain_status; ?>
                        </p>
                    </div>
                    <div class="col-sm-2 mt-2 text-center">
                        <a href="<?= site_url('Intra_report/complain_detail/' . $rs->complain_id); ?>"><span style="color: #AA8DFF;"><i class="fa fa-eye" aria-hidden="true"></i> view</span></a>
                    </div>
                <?php } ?>
                <div class="col-sm-1 mt-2 text-center">
                    <a href="<?= site_url('Intra_report/complain_all'); ?>" class="btn btn-all-complain">ดูทั้งหมด </a>
                </div>
            </div>
        </div>
    </div>

</div>