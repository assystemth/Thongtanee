<!-- ส่วนทางขวา -->
<div id="popupInsert" class="popup">
    <div class="popup-content">
        <h4 class="black"><b>เพิ่มคลังรูปภาพ</b></h4>
        <form action="<?php echo site_url('Intra_gallery/add'); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
            <br>
            <div class="form-group row container">
                <div class="col-sm-3 control-label font-18">ชื่อคลังรูปภาพ</div>
                <div class="col-sm-6">
                    <input type="text" name="intra_gallery_name" required class="form-control">
                </div>
            </div>
            <br>
            <div class="form-group row container">
                <div class="col-sm-3 control-label font-18">รูปภาพ (เพิ่มได้หลายรูป)</div>
                <div class="col-sm-6">
                    <input type="file" name="intra_gallery_img_img[]" class="form-control" accept="image/*" multiple>
                    <span class="red">เฉพาะไฟล์ .jpg, .jpeg, .png</span>
                </div>
            </div>
            <br>
            <div class="form-group row container">
                <div class="col-sm-3 control-label font-18">วิดีโอ (เพิ่มได้หลายวิดีโอ)</div>
                <div class="col-sm-6">
                    <input type="file" name="intra_gallery_video_video[]" class="form-control" accept="video/*" multiple>
                </div>
            </div>
            <br>
            <div class="form-group row container">
                <div class="col-sm-1 control-label"></div>
                <div class="col-sm-5">
                    <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                    <a class="btn btn-danger" href="<?= site_url('Intra_gallery'); ?>" role="button">ยกเลิก</a>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="flex-item-right-share-file">
    <div class="mt-4" style="width: 50%;">
        <!-- Dropdown Card Example -->
        <div class="card shadow mb-4" style="border-radius: 20px;">
            <!-- Card Header - Dropdown -->
            <div class="py-3 d-flex flex-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold text-black ml-4">พื้นที่ให้บริการ</h5>
                <!-- <a class="open-button btn btn-sky btn-sm mr-3" id="myBtn">
                        Upgrade</a> -->
            </div>
            <!-- Card Body -->
            <div class="card-body" style="margin-top: -45px;">
                <div class="row">
                    <div class="col-12 mb-2">
                        <?php foreach ($storage as $server) : ?>
                            <?php
                            $serverStorage = $server->server_storage;
                            $serverCurrent = $server->server_current;
                            $percentage = ($serverCurrent / $serverStorage) * 100;
                            $color = 'green'; // เริ่มต้นเป็นสีเขียว (1-69%)
                            if ($percentage >= 70 && $percentage <= 89) {
                                $color = 'orange'; // 70-89% ให้เปลี่ยนเป็นสีส้ม
                            } elseif ($percentage >= 90) {
                                $color = 'red'; // 90% ขึ้นไป ให้เปลี่ยนเป็นสีแดง
                            }
                            ?>

                    </div>
                </div>
                <h5 style="margin-top:20px;">
                    <!-- <?php
                            ?>
                        <?php echo number_format($percentage, 2); ?>% -->
                </h5>
                <div class="progress progress-sm mr-6">
                    <div class="progress-bar" role="progressbar" style="background-color: <?php echo $color; ?>; width: <?php echo $percentage; ?>%" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <!-- color: <?php echo $color; ?>; -->
                <div class="mt-3 row">
                    <div class="col-sm-4">
                        <div class="d-flex justify-content-start">
                            <span style="font-size: 13px; color: #888;">Used space: <?php echo number_format($serverCurrent, 2); ?> GB</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="d-flex justify-content-center">
                            <span style="font-size: 13px; color: #888;">Free space: <?php echo number_format($serverStorage - $serverCurrent, 2); ?> GB</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="d-flex justify-content-end">
                            <span style="font-size: 13px; color: #888;">Capacity: <?php echo number_format($serverStorage, 2); ?> GB</span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end mb-4" style="margin-top: 2%;">
        <a href="#" class="popup-insert" data-target="#popupInsert">
            <img src="<?php echo base_url("docs/btn-intra-add-storage-img-video.png"); ?>" width="auto" style="max-width: 100%;">
        </a>
    </div>

    <?php
    $count = count($query);
    $itemsPerPage = 4; // จำนวนรายการต่อหน้า
    $totalPages = ceil($count / $itemsPerPage);

    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

    $startIndex = ($currentPage - 1) * $itemsPerPage;
    $endIndex = min($startIndex + $itemsPerPage - 1, $count - 1);

    for ($i = $startIndex; $i <= $endIndex; $i++) {
        $rs = $query[$i];
    ?>
        <div class="file-pdf">
            <div class="row">
                <div class="col-sm-1">
                    <img src="<?php echo base_url("docs/folder.png"); ?>" width="100%">
                </div>
                <div class="col-sm-5">
                    <span>ชื่อ</span><br>
                    <a class="underline" href="<?= site_url('Intra_gallery/detail/' . $rs->intra_gallery_id); ?>">
                        <span class="black font-20 limit-font-one"><?= $rs->intra_gallery_name; ?></span>
                    </a>
                </div>
                <div class="col-sm-2">
                    <span>วันที่</span><br>
                    <span class="font-18">
                        <?php
                        // ในการใช้งาน setThaiMonth
                        $date = new DateTime($rs->intra_gallery_datesave);
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
                    <span class="font-18"><?= $rs->intra_gallery_by; ?></span>
                </div>
                <div class="col-sm-2">
                    <div class="d-flex justify-content-end">
                        <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical" style="font-size:30px; color: gray;"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="<?= site_url('Intra_gallery/detail/' . $rs->intra_gallery_id); ?>">
                                    <img src="<?php echo base_url("docs/icon-open-intra.png"); ?>" width="20">
                                    &nbsp; เปิด</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?php echo site_url('Intra_gallery/download_all_images/' . $rs->intra_gallery_id); ?>">
                                    <img src="<?php echo base_url("docs/icon-download-intra.png"); ?>" width="20">
                                    &nbsp; ดาวน์โหลดทั้งหมด
                                </a>
                            </li>

                            <?php if ($_SESSION['m_level'] == 1 || $_SESSION['m_level'] == 2 || $_SESSION['m_fname'] == $rs->intra_gallery_by) : ?>
                                <li>
                                    <a class="dropdown-item" href="#" ole="button" onclick="confirmDelete(<?= $rs->intra_gallery_id; ?>);">
                                        <img src="<?php echo base_url("docs/icon-del-intra.png"); ?>" width="20">
                                        &nbsp; ลบ</a>
                                    <script>
                                        function confirmDelete(intra_gallery_id) {
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
                                                    window.location.href = "<?= site_url('Intra_gallery/del_intra_gallery/'); ?>" + intra_gallery_id;
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