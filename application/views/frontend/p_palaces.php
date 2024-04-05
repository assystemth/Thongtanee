<div class="bg-pages ">
    <div class="row pad-path">
        <div class="path1-1">
            <span class="font-path-1 underline"><a href="<?php echo site_url('Home'); ?>">หน้าแรก</a></span>
        </div>
        <div class="path2-3">
            <span class="font-path-2 underline"><a href="#">โครงสร้างบุคลากร</a></span>
        </div>
    </div>
    <div class="page-center">
        <div class="head-pages">
            <span class="font-pages-head">ทำเนียบเทศบาลธงธานี</span>
        </div>
    </div>
        <div class="scrollable-container-p mt-5">
            <?php foreach ($query as $rs) { ?>
                <div>
                    <img src="<?php echo base_url('docs/img/' . $rs->p_palaces_img); ?>" width="100%" height="100%">
                </div>
            <?php  } ?>
        </div>
    </div>
</div>