<div class="bg-pages ">
    <div class="container-pages-detail">
        <div class="page-center">
            <div class="head-pages">
                <span class="font-pages-head">ดาวน์โหลดแบบฟอร์ม</span>
            </div>
        </div>
        <div class="row">
            <div class="path1-1">
                <span class="font-path-1 underline"><a href="<?php echo site_url('Home'); ?>">หน้าแรก</a></span>
            </div>
            <div class="path2-1">
                <span class="font-path-2 underline"><a href="#">แบบฟอร์ม</a></span>
            </div>
        </div>
        <div class="bg-pages-in ">
            <div class="scrollable-container-news">
                <div class="font-pages-content-head">เรื่อง <?= $rsData->loadform_name; ?></div>
                <div class="pages-content break-word mt-2">
                    <span class="font-pages-content-detail"><?= $rsData->loadform_detail; ?></span>
                    <a class="font-26" href="<?= $rsData->loadform_link; ?>" target="_blank"><?= $rsData->loadform_link; ?></a>
                </div>
                <?php foreach ($rsImg as $img) { ?>
                    <div class="col-3 mb-3">
                        <img class="rounded-all" src="<?php echo base_url('docs/img/' . $img->loadform_img_img); ?>" width="950px" height="100%">
                    </div>
                <?php } ?>
                <?php foreach ($rsFile as $file) { ?>
                    <div class="row">
                        <div class="col-6 mt-2">
                            <div class="d-flex justify-content-start">
                                <span class="font-page-detail-view-news">ดาวโหลดแล้ว <?= $file->loadform_file_download; ?> ครั้ง</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex justify-content-end">
                                <a onclick="downloadFile(event, <?= $file->loadform_file_id; ?>)" href="<?= base_url('docs/file/' . $file->loadform_file_pdf); ?>" download>
                                    <img src="<?php echo base_url("docs/s.btn-download.png"); ?>">
                                </a>
                                <script>
                                    function downloadFile(event, loadform_file_id) {
                                        // ทำการส่งคำร้องขอ AJAX ไปยัง URL ที่บันทึกการดาวน์โหลดพร้อมกับ ID
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('GET', '<?= base_url('Pages/increment_download_loadform/'); ?>' + loadform_file_id, true);
                                        xhr.send();

                                        // ทำการเปิดไฟล์ PDF ในหน้าต่างใหม่
                                        window.open(event.currentTarget.href, '_blank');
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="blog-text mt-3 mb-5">
                        <object data="<?= base_url('docs/file/' . $file->loadform_file_pdf); ?>" type="application/pdf" width="100%" height="1500px"></object>
                    </div>
                <?php } ?>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="d-flex justify-content-start">
                        <span class="font-page-detail-view-news">จำนวนผู้เข้าชม <?= $rsData->loadform_view; ?> ครั้ง</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="margin-top-delete-topic d-flex justify-content-end">
                        <a href="<?php echo site_url('Pages/loadform'); ?>"><img src="<?php echo base_url("docs/s.btn-back.png"); ?>"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>