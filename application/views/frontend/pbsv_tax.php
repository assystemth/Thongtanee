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
            <span class="font-pages-head">ข้อมูลชำระภาษี</span>
        </div>
    </div>
    <?php foreach ($query as $rs) { ?>
        <div class="bg-pages-in ">
            <div class="scrollable-container">

                <div class="pages-content break-word mt-5">
                    <span class="font-gi-head">ภาษีโรงเรือนและที่ดิน</span><br>
                    <span class="font-gi-content"><?= $rs->pbsv_tax_text; ?></span>
                </div>
                <div class="pages-content break-word mt-5">
                    <span class="font-gi-head">ตารางการชำระภาษีประเภทต่าง ๆ</span><br><br>
                    <div class="page-center-gi">
                        <div>
                            <?php if (!empty($rs->pbsv_tax_img)) : ?>
                                <img src="<?php echo base_url('docs/img/' . $rs->pbsv_tax_img); ?>" width="100%">
                            <?php else : ?>
                                <img src="<?php echo base_url('docs/logo.png'); ?>" width="545px" height="352px">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
            <div class="margin-top-delete-topic d-flex justify-content-end">
                <a href="<?php echo site_url('Home'); ?>"><img src="<?php echo base_url("docs/k.btn-back.png"); ?>"></a>
            </div>
        </div>
    <?php } ?>
</div>
</div>