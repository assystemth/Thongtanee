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
            <span class="font-pages-head-long">LPA การประเมินประสิทธิภาพขององค์กร</span>
        </div>
    </div>
    <div class="bg-pages-in ">
        <div class="scrollable-container">
                <div class="font-pages-content-head">เรื่อง <?= $rsData->lpa_name; ?></div>
                <div class="pages-content break-word mt-2">
                    <span class="font-pages-content-detail"><?= $rsData->lpa_detail; ?></span>
                    <a class="font-26" href="<?= $rsData->lpa_link; ?>" target="_blank"><?= $rsData->lpa_link; ?></a>
                    <?php foreach ($rsImg as $img) { ?>
                        <img class="border-radius34 mb-4" src="<?php echo base_url('docs/img/' . $img->lpa_img_img); ?>" width="950px" height="100%">
                    <?php } ?>
                    <?php foreach ($rsFile as $file) { ?>
                        <div class="row">
                            <div class="col-6 mt-2">
                                <div class="d-flex justify-content-start">
                                    <span class="font-page-detail-view-news">ดาวโหลดแล้ว <?= $file->lpa_file_download; ?> ครั้ง</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex justify-content-end">
                                    <a onclick="downloadFile(event, <?= $file->lpa_file_id; ?>)" href="<?= base_url('docs/file/' . $file->lpa_file_pdf); ?>" download>
                                        <img src="<?php echo base_url("docs/s.btn-download.png"); ?>">
                                    </a>
                                    <script>
                                        function downloadFile(event, lpa_file_id) {
                                            // ทำการส่งคำร้องขอ AJAX ไปยัง URL ที่บันทึกการดาวน์โหลดพร้อมกับ ID
                                            var xhr = new XMLHttpRequest();
                                            xhr.open('GET', '<?= base_url('Pages/increment_download_lpa/'); ?>' + lpa_file_id, true);
                                            xhr.send();

                                            // ทำการเปิดไฟล์ PDF ในหน้าต่างใหม่
                                            window.open(event.currentTarget.href, '_blank');
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="blog-text mt-3 mb-5">
                            <object data="<?= base_url('docs/file/' . $file->lpa_file_pdf); ?>" type="application/pdf" width="100%" height="1500px"></object>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="d-flex justify-content-start">
                        <span class="font-page-detail-view-news">จำนวนผู้เข้าชม <?= $rsData->lpa_view; ?> ครั้ง</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="margin-top-delete-topic d-flex justify-content-end">
                        <a href="<?php echo site_url('Pages/lpa'); ?>"><img src="<?php echo base_url("docs/k.btn-back.png"); ?>"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>