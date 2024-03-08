<!-- ส่วนทางขวา -->
<div class="flex-item-right">
    <div class="d-flex justify-content-end mb-4 mt-5">
        <a href="#" class="popup-insert" data-target="#popupInsert">
            <img src="<?php echo base_url("docs/btn-intra-add-file.png"); ?>" width="auto" style="max-width: 100%;">
        </a>
    </div>

    <div id="popupInsert" class="popup">
        <div class="popup-content">
            <h4 class="black"><b>เพิ่มข้อมูลคำสั่ง/ประกาศ</b></h4>
            <form action="<?php echo site_url('Intra_announce/add'); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                <br>
                <div class="form-group row container">
                    <div class="col-sm-1 control-label font-18">ชื่อไฟล์</div>
                    <div class="col-sm-6">
                        <input type="text" name="intra_announce_name" required class="form-control">
                    </div>
                </div>
                <br>
                <div class="form-group row container">
                    <div class="col-sm-1 control-label font-18">เอกสาร</div>
                    <div class="col-sm-6">
                        <input type="file" name="intra_announce_pdf" class="form-control" accept=".pdf, .docx, .xls, .doc" required>
                        <span class="red">เฉพาะไฟล์ .pdf, .docx, .xls, .doc</span>
                    </div>
                </div>
                <br>
                <div class="form-group row container">
                    <div class="col-sm-1 control-label"></div>
                    <div class="col-sm-5">
                        <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                        <a class="btn btn-danger" href="<?= site_url('Intra_announce'); ?>" role="button">ยกเลิก</a>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <?php
    $count = count($query);
    $itemsPerPage = 5; // จำนวนรายการต่อหน้า
    $totalPages = ceil($count / $itemsPerPage);

    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

    $startIndex = ($currentPage - 1) * $itemsPerPage;
    $endIndex = min($startIndex + $itemsPerPage - 1, $count - 1);

    for ($i = $startIndex; $i <= $endIndex; $i++) {
        $rs = $query[$i];

        // ดึงข้อมูลของไฟล์
        $fileInfo = pathinfo($rs->intra_announce_pdf);

        // ตรวจสอบลงท้ายของไฟล์
        $fileExtension = strtolower($fileInfo['extension']);

        // กำหนดรูปภาพตามลงท้ายของไฟล์
        $iconImage = "";
        if ($fileExtension === 'pdf') {
            $iconImage = "docs/icon-pdf-intra.png";
        } elseif ($fileExtension === 'doc' || $fileExtension === 'docx') {
            $iconImage = "docs/icon-doc-intra.png";
        } elseif ($fileExtension === 'xls') {
            $iconImage = "docs/icon-xls-intra.png";
        }
    ?>
        <div class="file-pdf">
            <div class="row">
                <div class="col-sm-1">
                    <img src="<?php echo base_url($iconImage); ?>" width="80%">
                </div>
                <div class="col-sm-5">
                    <span>ชื่อ</span><br>
                    <a class="underline" href="<?php echo base_url('docs/intranet/file/' . $rs->intra_announce_pdf); ?>" download>
                        <span class="black font-20 limit-font-one"><?= $rs->intra_announce_name; ?></span>
                    </a>
                </div>
                <div class="col-sm-2">
                    <span>วันที่</span><br>
                    <span class="font-18">
                        <?php
                        // ในการใช้งาน setThaiMonth
                        $date = new DateTime($rs->intra_announce_datesave);
                        $day_th = $date->format('d');
                        $month_th = setThaiMonth($date->format('F')); // เรียกใช้ setThaiMonth สำหรับชื่อเดือน
                        $year_th = $date->format('Y') + 543; // เพิ่มขึ้น 543 ปี
                        $formattedDate = "$day_th $month_th $year_th"; // วันที่และเดือนเป็นภาษาไทย
                        echo $formattedDate;
                        ?>
                    </span>
                </div>
                <div class="col-sm-2">
                    <span>ผู้อัพโหลด</span><br>
                    <span class="font-18"><?= $rs->intra_announce_by; ?></span>
                </div>
                <div class="col-sm-2">
                    <div class="d-flex justify-content-end">
                        <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical" style="font-size:30px; color: gray;"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li>
                                <a class="dropdown-item" target="_blank" href="<?php echo base_url('docs/intranet/file/' . $rs->intra_announce_pdf); ?>">
                                    <img src="<?php echo base_url("docs/icon-open-intra.png"); ?>" width="20">
                                    &nbsp; เปิด</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?php echo base_url('docs/intranet/file/' . $rs->intra_announce_pdf); ?>" download>
                                    <img src="<?php echo base_url("docs/icon-download-intra.png"); ?>" width="20">
                                    &nbsp; ดาวโหลด</a>
                            </li>

                            <?php if ($_SESSION['m_level'] == 1 || $_SESSION['m_level'] == 2 || $_SESSION['m_fname'] == $rs->intra_announce_by) : ?>
                                <li>
                                    <a class="dropdown-item" href="#" ole="button" onclick="confirmDelete(<?= $rs->intra_announce_id; ?>);">
                                        <img src="<?php echo base_url("docs/icon-del-intra.png"); ?>" width="20">
                                        &nbsp; ลบ</a>
                                    <script>
                                        function confirmDelete(intra_announce_id) {
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
                                                    window.location.href = "<?= site_url('Intra_announce/del_intra_announce/'); ?>" + intra_announce_id;
                                                }
                                            });
                                        }
                                    </script>
                                </li>
                            <?php endif; ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="d-flex justify-content-center mt-5">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php if ($currentPage > 1) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($currentPage < $totalPages) : ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>