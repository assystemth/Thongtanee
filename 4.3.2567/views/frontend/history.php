<div class="bg-pages ">
    <div class="container-pages-detail">
        <div class="page-center">
            <div class="head-pages">
                <span class="font-pages-head">ประวัติความเป็นมา</span>
            </div>
        </div>
        <div class="row">
            <div class="path1-1">
                <span class="font-path-1 underline"><a href="<?php echo site_url('Home'); ?>">หน้าแรก</a></span>
            </div>
            <div class="path2-1">
                <span class="font-path-2 underline"><a href="#">ข้อมูลทั่วไป</a></span>
            </div>
        </div>
        <?php foreach ($qHistory as $rs) { ?>
            <div class="bg-pages-in">
                <div class="page-center-gi">
                    <div class="mt-5">
                        <?php if (!empty($rs->history_img)) : ?>
                            <img src="<?php echo base_url('docs/img/' . $rs->history_img); ?>" width="545px" height="352px">
                        <?php else : ?>
                            <img src="<?php echo base_url('docs/logo.png'); ?>" width="545px" height="352px">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="scrollable-container-gi">
                    <div class="pages-content break-word mt-5">
                        <span class="font-gi-content"><?= $rs->history_name; ?></span>
                    </div>
                </div>
                <div class="margin-top-delete-topic d-flex justify-content-end">
                    <a href="<?php echo site_url('Home'); ?>"><img src="<?php echo base_url("docs/s.btn-back.png"); ?>"></a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>