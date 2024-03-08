<div class="bg-pages-e-service">
    <div class="container-pages-news">
        <div class="page-center">
            <div class="head-pages">
                <span class="font-pages-head">E-service</span>
            </div>
        </div>
        <div class="row">
            <div class="path1-2">
                <span class="font-path-1 underline"><a href="<?php echo site_url('Home'); ?>">หน้าแรก</a></span>
            </div>
            <div class="path2-1">
                <span class="font-path-2 underline"> <a href="#">E-Service</a></span>
            </div>
        </div>
        <div class="bg-pages-in-e-service-add">
            <!-- <div class="scrollable-container-e-service"> -->
            <div class="mt-4"></div>
            <div class="text-center" style="margin-left: -110px;">
                <span class="font-e-service-head">แบบยื่นคำร้อง</span>
            </div>
            <div class="mt-4"></div>
            <span class="font-e-service-top ">ท่านสามารถใช้งานระบบ E-Services ในรูปแบบ One Stop Service โดยคลิกเลือกแบบฟอร์มที่ท่านต้องการ ดังนี้</span>
            <div class="bg-how-e-service mt-4">
                <span class="font-e-service-how">ขั้นตอนที่ 1 ดาวน์โหลดเอกสารออนไลน์</span>
            </div>
            <div class="bg-head-e-service">
                <img src="<?php echo base_url('docs/icon-topic-e-service1.png'); ?>"><span class="font-head-topic">แบบยื่นคำร้อง</span>
            </div>
            <div class="bg-content-e-service">
                <!-- <?php foreach ($query1 as $rs) { ?>
                        <div class="row">
                            <div class="col-9 mt-2">
                                <span class="font-e-service-content">การขอใช้ห้องประชุม หรือสถานที่ราชการ</span>
                            </div>
                            <div class="col-3">
                                <a href="<?php echo base_url('docs/file/' . $rs->form_esv_file); ?>" target="_blank"><img src="<?php echo base_url("docs/btn-e-service-form.png"); ?>"></a>
                            </div>
                        </div>
                    <?php  } ?> -->

                <div class="row mt-1">
                    <div class="col-9 mt-2">
                        <span class="font-e-service-content">เหตุร้องทุกข์</span>
                    </div>
                    <div class="col-3">
                        <a href="<?php echo site_url('Pages/adding_complain'); ?>"><img src="<?php echo base_url("docs/btn-e-service-click.png"); ?>"></a>
                    </div>
                </div>
                <?php foreach ($query2 as $rs) { ?>
                    <div class="row mt-1">
                        <div class="col-9 mt-2">
                            <span class="font-e-service-content">การขอข้อมูลเอกสาร</span>
                        </div>
                        <div class="col-3">
                            <a href="<?php echo base_url('docs/file/' . $rs->form_esv_file); ?>" target="_blank"><img src="<?php echo base_url("docs/btn-e-service-form.png"); ?>"></a>
                        </div>
                    </div>
                <?php  } ?>
                <!-- <?php foreach ($query3 as $rs) { ?>
                        <div class="row mt-1">
                            <div class="col-9 mt-2">
                                <span class="font-e-service-content">ขอความอนุเคราะห์ตามอำนาจหน้าที่ของ อปท.</span>
                            </div>
                            <div class="col-3">
                                <a href="<?php echo base_url('docs/file/' . $rs->form_esv_file); ?>" target="_blank"><img src="<?php echo base_url("docs/btn-e-service-form.png"); ?>"></a>
                            </div>
                        </div>
                    <?php  } ?> -->
            </div>
            <div class="bg-head-e-service">
                <img src="<?php echo base_url('docs/icon-topic-e-service2.png'); ?>"><span class="font-head-topic">การขอจดทะเบียนพาณิชย์</span>
            </div>
            <div class="bg-content-e-service">
                <?php foreach ($query4 as $rs) { ?>
                    <div class="row">
                        <div class="col-9 mt-2">
                            <span class="font-e-service-content">แบบคำขอจดทะเบียนพาณิชย์</span>
                        </div>
                        <div class="col-3">
                            <a href="<?php echo base_url('docs/file/' . $rs->form_esv_file); ?>" target="_blank"><img src="<?php echo base_url("docs/btn-e-service-form.png"); ?>"></a>
                        </div>
                    </div>
                <?php  } ?>
                <?php foreach ($query5 as $rs) { ?>
                    <div class="row mt-1">
                        <div class="col-9 mt-2">
                            <span class="font-e-service-content">เอกสารประกอบการจดทะเบียนพาณิชย์อิเล็กทรอนิกส์</span>
                        </div>
                        <div class="col-3">
                            <a href="<?php echo base_url('docs/file/' . $rs->form_esv_file); ?>" target="_blank"><img src="<?php echo base_url("docs/btn-e-service-form.png"); ?>"></a>
                        </div>
                    </div>
                <?php  } ?>
                <?php foreach ($query6 as $rs) { ?>
                    <div class="row mt-1">
                        <div class="col-9 mt-2">
                            <span class="font-e-service-content">หนังสือมอบอำนาจ</span>
                        </div>
                        <div class="col-3">
                            <a href="<?php echo base_url('docs/file/' . $rs->form_esv_file); ?>" target="_blank"><img src="<?php echo base_url("docs/btn-e-service-form.png"); ?>"></a>
                        </div>
                    </div>
                <?php  } ?>
            </div>
            <div class="bg-head-e-service">
                <img src="<?php echo base_url('docs/icon-topic-e-service3.png'); ?>"><span class="font-head-topic">แบบลงทะเบียนผู้สูงอายุ</span>
            </div>
            <div class="bg-content-e-service">
                <?php foreach ($query7 as $rs) { ?>
                    <div class="row">
                        <div class="col-9 mt-2">
                            <span class="font-e-service-content">แบบลงทะเบียน</span>
                        </div>
                        <div class="col-3">
                            <a href="<?php echo base_url('docs/file/' . $rs->form_esv_file); ?>" target="_blank"><img src="<?php echo base_url("docs/btn-e-service-form.png"); ?>"></a>
                        </div>
                    </div>
                <?php  } ?>
                <?php foreach ($query8 as $rs) { ?>
                    <div class="row mt-1">
                        <div class="col-9 mt-2">
                            <span class="font-e-service-content">หนังสือมอบอำนาจ</span>
                        </div>
                        <div class="col-3">
                            <a href="<?php echo base_url('docs/file/' . $rs->form_esv_file); ?>" target="_blank"><img src="<?php echo base_url("docs/btn-e-service-form.png"); ?>"></a>
                        </div>
                    </div>
                <?php  } ?>
            </div>
            <div class="mt-4">
                <span class="font-e-service-danger"><b>หมายเหตุ</b> โปรดเตรียมไฟล์เอกสารแนบประกอบคำขอให้ครบถ้วน เช่น สำเนาบัตรประชาชน สำเนาทะเบียนบ้าน สำเนาหน้าบัญชีสมุดธนาคาร หนังสือมอบอำนาจพร้อมติดอากร เป็นต้น</span>
            </div>
            <div class="bg-how-e-service mt-4">
                <span class="font-e-service-how">ขั้นตอนที่ 2 ยื่นเอกสารออนไลน์</span>
            </div>
            <div class="bg-content-e-service" style="margin-bottom: 70px;">
                <div class="row">
                    <div class="col-9 mt-2">
                        <span class="font-e-service-content">คลิกเพื่อยื่นเอกสาร</span>
                    </div>
                    <div class="col-3" style="z-index: 3;">
                        <a href="<?php echo site_url('Pages/adding_esv_ods'); ?>"><img src="<?php echo base_url("docs/btn-e-service-click.png"); ?>"></a>
                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div>
    </div>
</div>