<div class="bg-pages ">
    <div class="container-pages-detail">
        <div class="page-center">
            <div class="head-pages-two">
                <span class="font-pages-head">คู่มือและมาตรฐานการให้บริการ</span>
            </div>
        </div>
        <div class="row">
            <div class="path1-1">
                <span class="font-path-1 underline"><a href="<?php echo site_url('Home'); ?>">หน้าแรก</a></span>
            </div>
            <div class="path2-3">
                <span class="font-path-2 underline"><a href="#">บริการประชาชน</a></span>
            </div>
        </div>
        <div class="bg-pages-in ">
            <div class="scrollable-container-news">
                <div class="font-pages-content-head">เรื่อง <?= $rsData->pbsv_sags_name; ?></div>
                <div class="pages-content break-word mt-2">
                    <span class="font-pages-content-detail"><?= $rsData->pbsv_sags_detail; ?></span>
                    <a class="font-26" href="<?= $rsData->pbsv_sags_link; ?>" target="_blank"><?= $rsData->pbsv_sags_link; ?></a>
                    <?php foreach ($rsImg as $img) { ?>
                        <img class="border-radius34 mb-4" src="<?php echo base_url('docs/img/' . $img->pbsv_sags_img_img); ?>" width="950px" height="100%">
                    <?php } ?>
                    <?php foreach ($rsFile as $file) { ?>
                        <div class="row">
                            <div class="col-6 mt-2">
                                <div class="d-flex justify-content-start">
                                    <span class="font-page-detail-view-news">ดาวโหลดแล้ว <?= $file->pbsv_sags_file_download; ?> ครั้ง</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex justify-content-end">
                                    <a onclick="downloadFile(event, <?= $file->pbsv_sags_file_id; ?>)" href="<?= base_url('docs/file/' . $file->pbsv_sags_file_pdf); ?>" download>
                                        <img src="<?php echo base_url("docs/s.btn-download.png"); ?>">
                                    </a>
                                    <script>
                                        function downloadFile(event, pbsv_sags_file_id) {
                                            // ทำการส่งคำร้องขอ AJAX ไปยัง URL ที่บันทึกการดาวน์โหลดพร้อมกับ ID
                                            var xhr = new XMLHttpRequest();
                                            xhr.open('GET', '<?= base_url('Pages/increment_download_pbsv_sags/'); ?>' + pbsv_sags_file_id, true);
                                            xhr.send();

                                            // ทำการเปิดไฟล์ PDF ในหน้าต่างใหม่
                                            window.open(event.currentTarget.href, '_blank');
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="blog-text mt-3 mb-5">
                            <object data="<?= base_url('docs/file/' . $file->pbsv_sags_file_pdf); ?>" type="application/pdf" width="100%" height="1500px"></object>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="d-flex justify-content-start">
                        <span class="font-page-detail-view-news">จำนวนผู้เข้าชม <?= $rsData->pbsv_sags_view; ?> ครั้ง</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="margin-top-delete-topic d-flex justify-content-end">
                        <a href="<?php echo site_url('Pages/pbsv_sags'); ?>"><img src="<?php echo base_url("docs/s.btn-back.png"); ?>"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>