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
        <div class="detail" style="padding-left: 20px;">
            <div class="pad-10"></div>
            <span>เรื่องร้องเรียน case ที่ : <?= $qcomplain->complain_id; ?></span><br>
            <div class="pad-30"></div>
            <span>เรื่อง : <?= $qcomplain->complain_topic; ?></span><br>
            <div class="pad-30"></div>
            <span>รายละเอียด : <?= $qcomplain->complain_detail; ?></span><br>
            <div class="pad-30"></div><div class="pad-30"></div>
            <div>
                <span>รูปภาพ :&nbsp;</span>
                <?php foreach ($qimg as $image) : ?>
                    <img src="<?= base_url('docs/img/' . $image->complain_img_img); ?>" alt="Complain Image" width="100">
                <?php endforeach; ?>
            </div><br>
            <div class="pad-30"></div>
            <span>ผู้แจ้ง : <?= $qcomplain->complain_by; ?></span><br>
            <div class="pad-30"></div>
            <span>ติดต่อ : <?= $qcomplain->complain_phone; ?></span><br>
            <div class="pad-30"></div>
            <span>วันที่ : <?= date('d/m/Y H:i', strtotime($qcomplain->complain_datesave . '+543 years')) ?> น.</span><br>
            <div class="pad-30"></div>
            <span>สถานะ :</span>&nbsp;<span class="small-font text-center" style=" font-size: 14px; background-color:
                <?php if ($qcomplain->complain_status === 'รับเรื่องแล้ว') : ?>
                    #D9EAFF;
                <?php elseif ($qcomplain->complain_status === 'กำลังดำเนินการ') : ?>
                    #CFD7FE;
                <?php elseif ($qcomplain->complain_status === 'รอดำเนินการ') : ?>
                    #FFECE7;
                <?php elseif ($qcomplain->complain_status === 'ดำเนินการเรียบร้อย') : ?>
                    #DBFFDD;
                <?php elseif ($qcomplain->complain_status === 'ยกเลิก') : ?>
                    #FFE3E3;
                <?php else : ?>
                    #FFFBDC; /* สีเริ่มต้นหากไม่ตรงกับเงื่อนไขใดๆ */
                <?php endif; ?>
                ; color:
                <?php if ($qcomplain->complain_status === 'รับเรื่องแล้ว') : ?>
                    #4C97EE;
                <?php elseif ($qcomplain->complain_status === 'กำลังดำเนินการ') : ?>
                    #3D5AF1;
                <?php elseif ($qcomplain->complain_status === 'รอดำเนินการ') : ?>
                    #E05A33;
                <?php elseif ($qcomplain->complain_status === 'ดำเนินการเรียบร้อย') : ?>
                    #00B73E;
                <?php elseif ($qcomplain->complain_status === 'ยกเลิก') : ?>
                    #FF0202;
                <?php else : ?>
                    #FFC700; /* สีเริ่มต้นหากไม่ตรงกับเงื่อนไขใดๆ */
                <?php endif; ?>
                border: 1.3px solid
                <?php if ($qcomplain->complain_status === 'รับเรื่องแล้ว') : ?>
                    #4C97EE;
                <?php elseif ($qcomplain->complain_status === 'กำลังดำเนินการ') : ?>
                    #3D5AF1;
                <?php elseif ($qcomplain->complain_status === 'รอดำเนินการ') : ?>
                    #E05A33;
                <?php elseif ($qcomplain->complain_status === 'ดำเนินการเรียบร้อย') : ?>
                    #00B73E;
                <?php elseif ($qcomplain->complain_status === 'ยกเลิก') : ?>
                    #FF0202;
                <?php else : ?>
                    #FFC700; /* สีเริ่มต้นหากไม่ตรงกับเงื่อนไขใดๆ */
                <?php endif; ?>
                ;
                border-radius: 12.887px; /* เพิ่มเส้นโค้ง */
                padding: 5px; /* เพิ่มขอบรอบตัวอักษร */
                ">
                <?= $qcomplain->complain_status; ?>
            </span>
        </div>
    </div>

</div>