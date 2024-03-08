<div class="bg-pages ">
    <div class="container-pages-detail">
        <div class="page-center">
            <div class="head-pages">
                <span class="font-pages-head">จดหมายข่าว</span>
            </div>
        </div>
        <div class="row">
            <div class="path1-1">
                <span class="font-path-1 underline"><a href="<?php echo site_url('Home'); ?>">หน้าแรก</a></span>
            </div>
            <div class="path2-2">
                <span class="font-path-2 underline"><a href="#">จดหมายข่าว</a></span>
            </div>
            <div class="margin-top-delete d-flex justify-content-end">
                <a href="<?php echo site_url('Pages/newsletter'); ?>"><img src="<?php echo base_url("docs/s.btn-back.png"); ?>"></a>
            </div>
        </div>
        <div class="bg-pages-in ">
            <div class="scrollable-container-news">
                <div class="font-pages-content-head">เรื่อง <?= $rsData->newsletter_name; ?></div>
                <div class="pages-content break-word mt-2">
                    <span class="font-pages-content-detail"><?= $rsData->newsletter_detail; ?></span>
                    <a class="font-26" href="<?= $rsData->newsletter_link; ?>" target="_blank"><?= $rsData->newsletter_link; ?></a>
                    <div class="d-flex justify-content-end">
                        <span class="font-page-detail-view-news">จำนวนผู้เข้าชม <?= $rsData->newsletter_view; ?> ครั้ง</span>
                    </div>
                </div>
                <?php foreach ($rsImg as $img) { ?>
                    <div class="col-3 mb-3">
                        <img class="rounded-all" src="<?php echo base_url('docs/img/' . $img->newsletter_img_img); ?>" width="950px" height="100%">
                    </div>
                <?php } ?>
                <?php foreach ($rsFile as $file) { ?>
                    <div class="row">
                        <div class="col-6">
                            <div class="d-flex justify-content-start">
                                <!-- ในหน้า view -->
                                <a href="<?= base_url('docs/file/' . $file->newsletter_file_pdf); ?>" target="_blank" onclick="handleDownloadClick(<?= $file->newsletter_file_id; ?>)">
                                    <img src="<?php echo base_url("docs/s.btn-dowload.png"); ?>">
                                </a>
                                <script>
                                    function handleDownloadClick(newsletter_file_id) {
                                        // ทำการส่งคำร้องขอ AJAX ไปยัง URL ที่บันทึกการดาวน์โหลด
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('GET', '<?= base_url('Pages/increment_dowload_newsletter/'); ?>' + newsletter_file_id, true);
                                        xhr.send();
                                    }
                                </script>
                            </div>
                        </div>
                        <div class="col-6 mt-2">
                            <div class="d-flex justify-content-end">
                                <span class="font-page-detail-view-news">ดาวโหลดแล้ว <?= $file->newsletter_file_dowload; ?> ครั้ง</span>
                            </div>
                        </div>
                    </div>
                    <div class="blog-text mt-3 mb-5">
                        <object data="<?= base_url('docs/file/' . $file->newsletter_file_pdf); ?>" type="application/pdf" width="100%" height="1500px"></object>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>