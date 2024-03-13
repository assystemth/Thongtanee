<!-- ส่วนทางขวา -->
<div class="flex-item-right">
    <div class="bg-complain-all mt-4">
        <span class="font-head-pdf"><?= $rsedit->intra_discipline_name; ?></span>
        <div class="scrollable-container">
            <div class="row mt-4">
                <div class="col-sm-9 font-download-pdf mt-2">จำนวนดาวน์โหลด <?= $rsedit->intra_discipline_download; ?> ครั้ง</div>
                <div class="col-sm-3">
                    <?php if ($_SESSION['m_level'] == 1 || $_SESSION['m_level'] == 2 || $_SESSION['m_fname'] == $rsedit->intra_discipline_by) : ?>
                        <a class="btn btn-danger" href="#" role="button" onclick="confirmDelete(<?= $rsedit->intra_discipline_id; ?>);"><i class="bi bi-trash fa-lg"></i>ลบ</a>
                        <script>
                            function confirmDelete(intra_discipline_id) {
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
                                        window.location.href = "<?= site_url('System_intranet/del_intra_discipline/'); ?>" + intra_discipline_id;
                                    }
                                });
                            }
                        </script>
                    <?php endif; ?>
                    <a class="btn btn-info" onclick="downloadFile(event, <?= $rsedit->intra_discipline_id; ?>)" href="<?= base_url('docs/intranet/file/' . $rsedit->intra_discipline_pdf); ?>" download>
                        <i class="bi bi-file-earmark-arrow-down-fill fa-lg"></i>ดาวน์โหลด
                    </a>
                    <script>
                        function downloadFile(event, intra_discipline_id) {
                            // ทำการส่งคำร้องขอ AJAX ไปยัง URL ที่บันทึกการดาวน์โหลดพร้อมกับ ID
                            var xhr = new XMLHttpRequest();
                            xhr.open('GET', '<?= base_url('Intra_discipline/increment_download/'); ?>' + intra_discipline_id, true);
                            xhr.send();
                        }
                    </script>
                </div>
            </div>
            <div class="blog-text mt-3 mb-5">
                <object data="<?= base_url('docs/intranet/file/' . $rsedit->intra_discipline_pdf); ?>" type="application/pdf" width="100%" height="1500px"></object>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <a href="<?= site_url('Intra_discipline'); ?>">
                <img src="<?php echo base_url('docs/intranet/btn-intra-back.png'); ?>" style="max-width: 100%; height: auto;">
            </a>
        </div>
    </div>
</div>