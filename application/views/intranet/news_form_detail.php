<!-- ส่วนทางขวา -->
<div class="flex-item-right-form">
    <div class="form-detail">
        <div class="d-flex justify-content-end">
            <?php if ($_SESSION['m_level'] == 1 || $_SESSION['m_level'] == 2 || $_SESSION['m_fname'] == $rsedit->intra_news_by) : ?>
                <a class="btn btn-success mr-2" href="<?= site_url('System_intranet/editing/' . $rsedit->intra_news_id); ?>"><i class="bi bi-pencil-square fa-lg"></i>แก้ไข</a>
                <a class="btn btn-danger mr-5" href="#" role="button" onclick="confirmDelete(<?= $rsedit->intra_news_id; ?>);"><i class="bi bi-trash fa-lg"></i>ลบ</a>
                <script>
                    function confirmDelete(intra_news_id) {
                        Swal.fire({
                            title: 'กดเพื่อยืนยัน?',
                            text: "คุณจะไม่สามรถกู้คืนได้อีก!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'ใช่, ต้องการลบ!',
                            cancelButtonText: 'ยกเลิก' // เปลี่ยนข้อความปุ่ม Cancel เป็นภาษาไทย
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "<?= site_url('System_intranet/del_intra_news/'); ?>" + intra_news_id;
                            }
                        });
                    }
                </script>
            <?php endif; ?>
            <a href="<?php echo site_url('System_intranet'); ?>" style="color: black;">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                </svg>
            </a>
        </div>
        <div class="scrollable-bar">
            <div class="text-center">
                <img src="<?= base_url('docs/intranet/img/' . $rsedit->intra_news_img); ?>" width="600" height="300">
                <br>
                <div class="mt-4"></div>
                <span class="font-24b black"><?= $rsedit->intra_news_topic; ?></span>
                <br>
                <span class="font-20 black"><?= $rsedit->intra_news_detail; ?></span>
                <?php foreach ($rsFile as $file) { ?>
                    <a class="btn btn-info btn-sm mb-2" href="<?= base_url('docs/intranet/file/' . $file->intra_news_file_pdf); ?>" target="_blank">ดูไฟล์ <?= $file->intra_news_file_pdf; ?></a>
                    <br>
                <?php } ?>
                <br>
                <div class="row mt-5">
                    <?php foreach ($rsImg as $img) { ?>
                        <div class="col-3 mb-3">
                            <a href="<?= base_url('docs/intranet/img/' . $img->intra_news_img_img); ?>" data-lightbox="image-1">
                                <img class="rounded-all" src="<?= base_url('docs/intranet/img/' . $img->intra_news_img_img); ?>" width="220px" height="220px">
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>