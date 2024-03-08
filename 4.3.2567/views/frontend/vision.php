<div class="bg-pages">
    <div class="container-pages-detail">
        <div class="page-center">
            <div class="head-pages">
                <span class="font-pages-head">วิสัยทัศน์และพันธกิจ</span>
            </div>
        </div>
        <div class="row">
            <div class="path1-1">
                <span class="font-path-1 underline"><a href="<?php echo site_url('Home'); ?>">หน้าแรก</a></span>
            </div>
            <div class="path2-2">
                <span class="font-path-2 underline"><a href="#">ข้อมูลทั่วไป</a></span>
            </div>
        </div>
        <?php foreach ($qVision as $rs) { ?>
            <div class="bg-pages-in ">
                <div class="page-center-gi">
                    <div>
                        <?php if (!empty($rs->vision_img)) : ?>
                            <img src="<?php echo base_url('docs/img/' . $rs->vision_img); ?>" width="545px" height="352px">
                        <?php else : ?>
                            <img src="<?php echo base_url('docs/logo.png'); ?>" width="545px" height="352px">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="scrollable-container-gi">
                    <div class="pages-content break-word mt-5">
                        <span class="font-gi-head">วิสัยทัศน์</span><br>
                        <span class="font-gi-content"><?= $rs->vision_vision; ?></span>
                    </div>
                    <div class="pages-content break-word mt-5">
                        <span class="font-gi-head">พันธกิจ</span><br>
                        <span class="font-gi-content"><?= $rs->vision_pantajit; ?></span>
                    </div>
                </div>
                <div class="margin-top-delete-topic d-flex justify-content-end">
                    <a href="<?php echo site_url('Home'); ?>"><img src="<?php echo base_url("docs/s.btn-back.png"); ?>"></a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>