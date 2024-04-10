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
            <span class="font-pages-head-long">สมาชิกสภาเทศบาล</span>
        </div>
    </div>
    <div class="bg-pages-p">
        <div class="scrollable-container">
            <div class="page-center">
                <?php foreach ($query_one as $rs) { ?>
                    <?php if (!empty($rs->p_council_rank)) : ?>
                        <div class="bg-personnel-s">
                            <div class="rounded-image-s">
                            <?php if (!empty($rs->p_council_img)) : ?>
                                        <img src="<?php echo base_url('docs/img/' . $rs->p_council_img); ?>" width="100%" height="100%">
                                    <?php else : ?>
                                        <img src="<?php echo base_url('docs/ex_personnel.png'); ?>" width="100%" height="100%">
                                    <?php endif; ?>                            </div>
                        </div>
                        <div class="mt-3 center-center">
                            <span class="font-p-name">
                                <?php echo !empty($rs->p_council_name) ? $rs->p_council_name : 'ว่าง'; ?>
                            </span>
                            <span class="font-p-detail "><?= $rs->p_council_rank; ?></span>
                            <?php if (!empty($rs->p_council_phone)) : ?>
                                <span class="font-p-detail">เบอร์ <?= $rs->p_council_phone; ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php } ?>
            </div>
            <div class="row " style="margin-top: 25px;">
                <?php foreach ($query_under_one as $rs) : ?>
                    <div class="col-4 col-md-4 mb-3 center-center">
                        <?php if (!empty($rs->p_council_rank)) : ?>
                            <div class="bg-personnel-s">
                                <div class="rounded-image-s">
                                <?php if (!empty($rs->p_council_img)) : ?>
                                        <img src="<?php echo base_url('docs/img/' . $rs->p_council_img); ?>" width="100%" height="100%">
                                    <?php else : ?>
                                        <img src="<?php echo base_url('docs/ex_personnel.png'); ?>" width="100%" height="100%">
                                    <?php endif; ?>                                </div>
                            </div>
                            <span class="font-p-name">
                                <?php echo !empty($rs->p_council_name) ? $rs->p_council_name : 'ว่าง'; ?>
                            </span>
                            <span class="font-p-detail "><?= $rs->p_council_rank; ?></span>
                            <?php if (!empty($rs->p_council_phone)) : ?>
                                <span class="font-p-detail">เบอร์ <?= $rs->p_council_phone; ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- <?php foreach ($rsOne as $rs) { ?>
                    <div class="bg-personnel-s">
                        <div class="rounded-image-s">
                            <img src="<?= base_url('docs/img/' . $rs->p_council_img); ?>" width="100%" height="100%">
                        </div>
                    </div>
                    <div class="mt-3 center-center">
                        <span class="font-p-name"><?= $rs->p_council_name; ?></span>
                        <span class="font-p-detail "><?= $rs->p_council_rank; ?></span>
                        <?php if (!empty($rs->p_council_phone)) : ?>
                            <span class="font-p-detail">เบอร์ <?= $rs->p_council_phone; ?></span>
                        <?php endif; ?>
                    </div>
                <?php } ?>
            </div>
            <div class="scrollable-container-gi">
                <div class="row " style="margin-top: 25px;">
                    <?php foreach ($rsrow1 as $rs) : ?>
                        <div class="col-4 col-md-4 mb-3 center-center">
                            <div class="bg-personnel-s">
                                <div class="rounded-image-s">
                                    <img src="<?= base_url('docs/img/' . $rs->p_council_img); ?>" width="100%" height="100%">
                                </div>
                            </div>
                            <span class="font-p-name"><?= $rs->p_council_name; ?></span>
                            <span class="font-p-detail "><?= $rs->p_council_rank; ?></span>
                            <?php if (!empty($rs->p_council_phone)) : ?>
                                <span class="font-p-detail">เบอร์ <?= $rs->p_council_phone; ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <br>
                <div class="row" style="margin-top: 25px;">
                    <?php foreach ($rsrow2 as $rs) : ?>
                        <div class="col-4 col-md-4 mb-3 center-center">
                            <div class="bg-personnel-s">
                                <div class="rounded-image-s">
                                    <img src="<?= base_url('docs/img/' . $rs->p_council_img); ?>" width="100%" height="100%">
                                </div>
                            </div>
                            <span class="font-p-name "><?= $rs->p_council_name; ?></span>
                            <span class="font-p-detail "><?= $rs->p_council_rank; ?></span>
                            <?php if (!empty($rs->p_council_phone)) : ?>
                                <span class="font-p-detail ">เบอร์ <?= $rs->p_council_phone; ?></span>
                            <?php endif; ?>
                            <br>
                        </div>
                    <?php endforeach; ?>
                </div>
                <br>
                <div class="row " style="margin-top: 25px;">
                    <?php foreach ($rsrow3 as $rs) : ?>
                        <div class="col-4 col-md-4 mb-3 center-center">
                            <div class="bg-personnel-s">
                                <div class="rounded-image-s">
                                    <img src="<?= base_url('docs/img/' . $rs->p_council_img); ?>" width="100%" height="100%">
                                </div>
                            </div>
                            <span class="font-p-name "><?= $rs->p_council_name; ?></span>
                            <span class="font-p-detail "><?= $rs->p_council_rank; ?></span>
                            <?php if (!empty($rs->p_council_phone)) : ?>
                                <span class="font-p-detail ">เบอร์ <?= $rs->p_council_phone; ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <br>
                <div class="row " style="margin-top: 25px;">
                    <?php foreach ($rsrow4 as $rs) : ?>
                        <div class="col-4 col-md-4 mb-3 center-center">
                            <div class="bg-personnel-s">
                                <div class="rounded-image-s">
                                    <img src="<?= base_url('docs/img/' . $rs->p_council_img); ?>" width="100%" height="100%">
                                </div>
                            </div>
                            <span class="font-p-name "><?= $rs->p_council_name; ?></span>
                            <span class="font-p-detail "><?= $rs->p_council_rank; ?></span>
                            <?php if (!empty($rs->p_council_phone)) : ?>
                                <span class="font-p-detail ">เบอร์ <?= $rs->p_council_phone; ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <br>
                <div class="row " style="margin-top: 25px;">
                    <?php foreach ($rsrow5 as $rs) : ?>
                        <div class="col-4 col-md-4 mb-3 center-center">
                            <div class="bg-personnel-s">
                                <div class="rounded-image-s">
                                    <img src="<?= base_url('docs/img/' . $rs->p_council_img); ?>" width="100%" height="100%">
                                </div>
                            </div>
                            <span class="font-p-name "><?= $rs->p_council_name; ?></span>
                            <span class="font-p-detail "><?= $rs->p_council_rank; ?></span>
                            <?php if (!empty($rs->p_council_phone)) : ?>
                                <span class="font-p-detail ">เบอร์ <?= $rs->p_council_phone; ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div> -->
        </div>
        <div class="margin-top-delete-topic d-flex justify-content-end mt-2">
            <a href="<?php echo site_url('Home'); ?>"><img src="<?php echo base_url("docs/k.btn-back.png"); ?>"></a>
        </div>
    </div>
</div>
</div>