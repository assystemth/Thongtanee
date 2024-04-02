<div class="bg-pages ">
    <div class="row pad-path">
        <div class="path1-1">
            <span class="font-path-1 underline"><a href="<?php echo site_url('Home'); ?>">หน้าแรก</a></span>
        </div>
        <div class="path2-1">
            <span class="font-path-2 underline"><a href="#">ข้อมูลทั่วไป</a></span>
        </div>
    </div>
    <div class="page-center">
        <div class="head-pages">
            <span class="font-pages-head">ข้อมูลสภาพทั่วไป</span>
        </div>
    </div>
    <?php foreach ($qGci as $rs) { ?>
        <div class="bg-pages-in ">
            <div class="scrollable-container">
                <div class="page-center-gi">
                    <div>
                        <?php if (!empty($rs->gci_img)) : ?>
                            <img src="<?php echo base_url('docs/img/' . $rs->gci_img); ?>" width="545px" height="352px">
                        <?php else : ?>
                            <img src="<?php echo base_url('docs/logo.png'); ?>" width="545px" height="352px">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="pages-content break-word mt-5">
                    <span class="font-gi-head">1.ลักษณะที่ตั้ง</span><br>
                    <span class="font-gi-content"><?= $rs->gci_location; ?></span>
                </div>
                <div class="pages-content break-word mt-5">
                    <span class="font-gi-head">2.อาณาเขต</span><br>
                    <span class="font-gi-content"><?= $rs->gci_territory; ?></span>
                </div>
                <div class="pages-content break-word mt-5">
                    <span class="font-gi-head">3.ลักษณะภูมิประเทศ</span><br>
                    <span class="font-gi-content"><?= $rs->gci_terrain; ?></span>
                </div>
                <div class="pages-content break-word mt-5">
                    <span class="font-gi-head">4.พื้นที่องค์การบริหารส่วนเทศบาล</span><br>
                    <span class="font-gi-content"><?= $rs->gci_area; ?></span>
                </div>
            </div>
            <div class="margin-top-delete-topic d-flex justify-content-end">
                <a href="<?php echo site_url('Home'); ?>"><img src="<?php echo base_url("docs/k.btn-back.png"); ?>"></a>
            </div>
        </div>
    <?php } ?>
</div>
</div>