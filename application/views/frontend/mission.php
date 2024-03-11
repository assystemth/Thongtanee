<div class="bg-pages">
    <div class="row pad-path">
        <div class="path1-1">
            <span class="font-path-1 underline"><a href="<?php echo site_url('Home'); ?>">หน้าแรก</a></span>
        </div>
        <div class="path2-2">
            <span class="font-path-2 underline"><a href="#">ข้อมูลทั่วไป</a></span>
        </div>
    </div>
    <div class="page-center">
        <div class="head-pages-two">
            <span class="font-pages-head">ภารกิจและความรับผิดชอบ</span>
        </div>
    </div>
    <div style="padding-top: 80px;"></div>
    <?php foreach ($qMission as $rs) { ?>
        <div class="bg-pages-in ">
            <div class="page-center-gi">
                <div>
                    <?php if (!empty($rs->mission_img)): ?>
                        <img src="<?php echo base_url('docs/img/' . $rs->mission_img); ?>" width="545px" height="352px">
                    <?php else: ?>
                        <img src="<?php echo base_url('docs/logo.png'); ?>" width="545px" height="352px">
                    <?php endif; ?>
                </div>
            </div>
            <div class="scrollable-container-550">
                <div class="pages-content break-word mt-5">
                    <!-- <span class="font-gi-head">อบต. มีหน้าที่ตามพระราชบัญญัติสภาตำบล และองค์การบริหารส่วน ตำบล พ.ศ. 2537 และ แก้ไขเพิ่มเติม (ฉบับที่ 3 พ.ศ. 2542)</span><br> -->
                    <span class="font-gi-content">
                        <?= $rs->mission_detail; ?>
                    </span>
                </div>
            </div>
            <div class="margin-top-delete-topic d-flex justify-content-end">
                <a href="<?php echo site_url('Home'); ?>"><img src="<?php echo base_url("docs/k.btn-back.png"); ?>"></a>
            </div>
        </div>
    <?php } ?>
</div>