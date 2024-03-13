<!-- ส่วนทางขวา -->
<div class="flex-item-right">
    <div class="bg-complain-all mt-5">
        <div class="row">
            <div class="col-sm-4 d-flex justify-content-start">
                <span class="font-topic-all-complain">เรื่องร้องเรียน</span>
            </div>
            <div class="col-sm-4">&nbsp;</div>
            <div class="col-sm-4 d-flex justify-content-end">
                <a href="<?= site_url('Intra_report'); ?>">
                    <img src="<?php echo base_url('docs/intranet/btn-intra-back.png'); ?>" style="max-width: 100%; height: auto;">
                </a>
            </div>
        </div>
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
        <div class="scrollable-container">
            <div class="row">
                <?php foreach ($complains as $rs) { ?>
                    <div class="col-sm-3 ">
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
                    <div class="col-sm-3 mt-2 text-center">
                        <a href="<?= site_url('Intra_report/complain_detail/' . $rs->complain_id); ?>"><span style="color: #AA8DFF;"><i class="fa fa-eye" aria-hidden="true"></i> view</span></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

</div>