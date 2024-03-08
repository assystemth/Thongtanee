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
            <span class="font-pages-head">ตราสัญลักษณ์</span>
        </div>
    </div>
    <?php foreach ($qemblem as $rs) { ?>
        <div class="bg-pages-in ">
            <div class="scrollable-container">
                <div class="page-center-gi">
                    <div>
                        <?php if (!empty($rs->emblem_img)) : ?>
                            <img src="<?php echo base_url('docs/img/' . $rs->emblem_img); ?>" width="545px" height="352px">
                        <?php else : ?>
                            <img src="<?php echo base_url('docs/logo.png'); ?>" width="545px" height="352px">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="pages-content break-word mt-5">
                    <span class="font-gi-head">ลักษณะของดวงตราและเครื่องหมาย</span><br>
                    <span class="font-gi-content"><?= $rs->emblem_text1; ?></span>
                </div>
                <div class="pages-content break-word mt-5">
                    <span class="font-gi-head">เหตุผลประกอบ</span><br>
                    <span class="font-gi-content"><?= $rs->emblem_text2; ?></span>
                </div>
                <div class="pages-content break-word mt-5">
                    <span class="font-gi-head">ความหมาย</span><br>
                    <span class="font-gi-content"><?= $rs->emblem_text3; ?></span>
                </div>
                <div class="pages-content break-word mt-5">
                    <span class="font-gi-head">ประวัติความเป็นมาตำบลกาบเชิง</span><br>
                    <span class="font-gi-content"><?= $rs->emblem_text4 ; ?></span>
                </div>
            </div>
            <div class="margin-top-delete-topic d-flex justify-content-end">
                <a href="<?php echo site_url('Home'); ?>"><img src="<?php echo base_url("docs/k.btn-back.png"); ?>"></a>
            </div>
        </div>
    <?php } ?>
</div>
</div>