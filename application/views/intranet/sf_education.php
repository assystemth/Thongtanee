<!-- ส่วนทางขวา -->


<div id="popupInsert" class="popup">
    <div class="popup-content">
        <h4 class="black"><b>เพิ่มข้อมูล</b></h4>
        <form action="<?php echo site_url('Intra_share_file/add_sf_education'); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
            <br>
            <div class="form-group row container">
                <div class="col-sm-1 control-label font-18">ชื่อไฟล์</div>
                <div class="col-sm-6">
                    <input type="text" name="intra_sf_education_name" required class="form-control">
                </div>
            </div>
            <br>
            <div class="form-group row container">
                <div class="col-sm-1 control-label font-18">เอกสาร</div>
                <div class="col-sm-6">
                    <input type="file" name="intra_sf_education_pdf" class="form-control" accept=".pdf, .docx, .xls, .doc" required>
                    <span class="red">เฉพาะไฟล์ .pdf, .docx, .xls, .doc</span>
                </div>
            </div>
            <br>
            <div class="form-group row container">
                <div class="col-sm-1 control-label"></div>
                <div class="col-sm-5">
                    <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                    <a class="btn btn-danger" href="<?= site_url('Intra_share_file/sf_education'); ?>" role="button">ยกเลิก</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="flex-item-right-share-file">
    <div class="row">
        <div class="col-6 mt-5">
            <img src="<?php echo base_url("docs/intranet/folder.png"); ?>" width="auto" style="max-width: 100%;">
            <span class="font-folder-detail mx-3">กองการศึกษา</span>
        </div>
        <div class="col-6 mt-5">
            <div class="d-flex justify-content-end">
                <a href="#" class="popup-insert" data-target="#popupInsert">
                    <img src="<?php echo base_url("docs/intranet/btn-intra-add-file.png"); ?>" width="auto" style="max-width: 100%;">
                </a>
            </div>
        </div>
    </div>


    <div class="box-folder-detail mt-4">
        <div class="row">
            <div class="col-sm-6">
                ชื่อ
            </div>
            <div class="col-sm-2">
                วันที่
            </div>
            <div class="col-sm-2">
                ผู้อัพโหลด
            </div>
            <div class="col-sm-1">
                &nbsp;
            </div>
        </div>

        <div class="row">
            <?php
            $count = count($query);
            $itemsPerPage = 10; // จำนวนรายการต่อหน้า
            $totalPages = ceil($count / $itemsPerPage);

            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

            $startIndex = ($currentPage - 1) * $itemsPerPage;
            $endIndex = min($startIndex + $itemsPerPage - 1, $count - 1);

            for ($i = $startIndex; $i <= $endIndex; $i++) {
                $rs = $query[$i];

                // ดึงข้อมูลของไฟล์
                $fileInfo = pathinfo($rs->intra_sf_education_pdf);

                // ตรวจสอบลงท้ายของไฟล์
                $fileExtension = strtolower($fileInfo['extension']);

                // กำหนดรูปภาพตามลงท้ายของไฟล์
                $iconImage = "";
                if ($fileExtension === 'pdf') {
                    $iconImage = "docs/intranet/icon-pdf-intra.png";
                } elseif ($fileExtension === 'doc' || $fileExtension === 'docx') {
                    $iconImage = "docs/intranet/icon-doc-intra.png";
                } elseif ($fileExtension === 'xls') {
                    $iconImage = "docs/intranet/icon-xls-intra.png";
                }
            ?>
                <div class="col-sm-6 mt-2">
                    <span class="black font-20 limit-font-one">
                        <a class="underline" href="<?php echo base_url('docs/intranet/file/' . $rs->intra_sf_education_pdf); ?>" download>
                            <img src="<?php echo base_url($iconImage); ?>" width="25">
                            <?= $rs->intra_sf_education_name; ?>
                        </a>
                    </span>
                </div>
                <div class="col-sm-2 mt-2">
                    <span class="font-18">
                    <?php
                        // ในการใช้งาน setThaiMonth
                        $date = new DateTime($rs->intra_sf_education_datesave);
                        $day_th = $date->format('d');
                        $month_th = setThaiMonth($date->format('F')); // เรียกใช้ setThaiMonth สำหรับชื่อเดือน
                        $year_th = $date->format('Y') + 543; // เพิ่มขึ้น 543 ปี
                        $formattedDate = "$day_th $month_th $year_th"; // วันที่และเดือนเป็นภาษาไทย
                        echo $formattedDate;
                        ?>
                    </span>
                </div>
                <div class="col-sm-2 mt-2">
                    <span class="font-18"><?= $rs->intra_sf_education_by; ?></span>
                </div>
                <div class="col-sm-2 mt-2 white">

                <?php if ($_SESSION['m_level'] == 1 || $_SESSION['m_level'] == 2 || $_SESSION['m_fname'] == $rs->intra_sf_education_by) : ?>
                    <div class="d-flex justify-content-end">
                        <a href="#" class="btn btn-danger btn-sm" role="button" onclick="confirmDelete(<?= $rs->intra_sf_education_id; ?>);"><i class="bi bi-trash fa-lg mx-2"></i>ลบ</a>
                    </div>
                    <?php endif; ?>

                    <script>
                        function confirmDelete(intra_sf_education_id) {
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
                                    window.location.href = "<?= site_url('Intra_share_file/del_sf_education/'); ?>" + intra_sf_education_id;
                                }
                            });
                        }
                    </script>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-2">
            <a href="<?= site_url('Intra_share_file'); ?>" class="underline">
                <img src="<?php echo base_url("docs/intranet/btn-intra-back.png"); ?>" width="auto" style="max-width: 100%;">
            </a>
        </div>
        <div class="col-sm-8">
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


</div>