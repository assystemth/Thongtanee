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
                <div class="pages-content break-word mt-2 laws_ral_content">
                    <?php foreach ($query as $rs) { ?>
                        <span class="font-laws-content dot-laws"><?= $rs->laws_rl_file_topic; ?></span><br>
                        <span class="pl-30">:</span>
                        <a class="font-laws-content" target="_blank" href="<?php echo base_url('docs/file/' . $rs->laws_rl_file_file); ?>"><?= $rs->laws_rl_file_name; ?></a>
                        <br>
                        <div style="padding-top: 40px;"></div>
                    <?php   } ?>
                </div>
            </div>
        </div>
    </div>
</div>