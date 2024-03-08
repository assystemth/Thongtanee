<div class="bg-pages ">
    <div class="container-pages-detail">
        <div class="page-center">
            <div class="head-pages">
                <span class="font-pages-head">ข้อมูลสภาพทั่วไป</span>
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
        <div class="bg-pages-in ">
            <div class="page-center-gi">
                <div>
                    <img src="<?php echo base_url('docs/logo.png'); ?>" width="221.881px" height="219.995px">
                </div>
            </div>
            <div class="scrollable-container-gi">
                <?php foreach ($qSi as $rs) { ?>
                    <div class="pages-content break-word mt-5">
                        <span class="font-gi-head"><?= $rs->si_topic; ?></span><br>
                        <div class="font-gi-content mt-4 pl-20">
                            <span class="">เป้าหมาย</span><br>
                            <div class="pl-13p font-gi-content">
                                <span><?= $rs->si_target; ?></span>
                            </div>
                        </div>
                        <div class="font-gi-content mt-4 pl-20">
                            <span class="">แนวทางการพัฒนา</span><br>
                            <div class="pl-13p font-gi-content">
                                <span><?= $rs->si_guide; ?></span>
                            </div>
                        </div>
                        <div class="font-gi-content mt-4 pl-20">
                            <span class="">ตัวชี้วัด</span><br>
                            <div class="pl-13p font-gi-content">
                                <span><?= $rs->si_indicators; ?></span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="margin-top-delete-topic d-flex justify-content-end">
                <a href="<?php echo site_url('Home'); ?>"><img src="<?php echo base_url("docs/s.btn-back.png"); ?>"></a>
            </div>
        </div>
    </div>
</div>