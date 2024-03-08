<div class="bg-pages ">
    <div class="row pad-path">
        <div class="path1-1">
            <span class="font-path-1 underline"><a href="<?php echo site_url('Home'); ?>">หน้าแรก</a></span>
        </div>
        <div class="path2-2">
            <span class="font-path-2 underline"><a href="#">การดำเนินงาน</a></span>
        </div>
    </div>
    <div class="page-center">
        <div class="head-pages-three">
            <span class="font-pages-head-long">ITA การประเมินคุณธรรมและความโปร่งใส</span>
        </div>
    </div>
    <div class="bg-pages-in ">
        <div class="scrollable-container">
                <div class="font-pages-content-head">เรื่อง <?= $rsData->ita_name; ?></div>
                <div class="pages-content break-word mt-2">
                    <span class="font-pages-content-detail"><?= $rsData->ita_detail; ?></span>
                    <a class="font-26" href="<?= $rsData->ita_link; ?>" target="_blank"><?= $rsData->ita_link; ?></a>

                </div>
                <?php foreach ($rsImg as $img) { ?>
                    <div class="col-3 mb-3">
                        <img class="rounded-all" src="<?php echo base_url('docs/img/' . $img->ita_img_img); ?>" width="950px" height="100%">
                    </div>
                <?php } ?>
                <?php foreach ($rsFile as $file) { ?>
                    <div class="row">
                        <div class="col-6">
                            <div class="d-flex justify-content-start">
                                <!-- ในหน้า view -->
                                <a href="<?= base_url('docs/file/' . $file->ita_file_pdf); ?>" target="_blank" onclick="handleDownloadClick(<?= $file->ita_file_id; ?>)">
                                    <img src="<?php echo base_url("docs/s.btn-dowload.png"); ?>">
                                </a>
                                <script>
                                    function handleDownloadClick(ita_file_id) {
                                        // ทำการส่งคำร้องขอ AJAX ไปยัง URL ที่บันทึกการดาวน์โหลด
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('GET', '<?= base_url('Pages/increment_dowload_ita/'); ?>' + ita_file_id, true);
                                        xhr.send();
                                    }
                                </script>
                            </div>
                        </div>
                        <div class="col-6 mt-2">
                            <div class="d-flex justify-content-end">
                                <span class="font-page-detail-view-news">ดาวโหลดแล้ว <?= $file->ita_file_dowload; ?> ครั้ง</span>
                            </div>
                        </div>
                    </div>
                    <div class="blog-text mt-3 mb-5">
                        <object data="<?= base_url('docs/file/' . $file->ita_file_pdf); ?>" type="application/pdf" width="100%" height="1500px"></object>
                    </div>
                <?php } ?>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="d-flex justify-content-start">
                        <span class="font-page-detail-view-news">จำนวนผู้เข้าชม <?= $rsData->ita_view; ?> ครั้ง</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="margin-top-delete-topic d-flex justify-content-end">
                        <a href="<?php echo site_url('Pages/ita'); ?>"><img src="<?php echo base_url("docs/k.btn-back.png"); ?>"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>