<div class="bg-pages">
    <div class="row pad-path">
        <div class="path1-1">
            <span class="font-path-1 underline"><a href="<?php echo site_url('Home'); ?>">หน้าแรก</a></span>
        </div>
        <div class="path2-3">
            <span class="font-path-2 underline"><a href="#">กฎหมายที่เกี่ยวข้อง</a></span>
        </div>
    </div>
    <div class="container-pages-news">
        <div class="page-center">
            <div class="head-pages">
                <span class="font-pages-head">กฏหมายที่เกี่ยวข้อง</span>
            </div>
        </div>
        <div style="padding-top: 80px;"></div>
        <div class="bg-pages-in ">
            <div class="scrollable-container-news">
                <div class="font-laws-head">พระราชบัญญัติ</div>
                <div class="pages-content break-word mt-2 laws_ral_content">
                    <?php foreach ($query as $rs) { ?>
                        <a class="font-laws-content dot-laws" target="_blank" href="<?php echo base_url('docs/file/' . $rs->laws_act_pdf); ?>"><?= $rs->laws_act_name; ?></a>
                        <br>
                    <?php   } ?>
                </div>
            </div>
        </div>
    </div>
</div>