<!-- ส่วนทางขวา -->


<div id="popupInsert" class="popup">
    <div class="popup-content">
        <h4 class="black"><b>เพิ่มรูปภาพ</b></h4>
        <form action="<?php echo site_url('Intra_gallery/add_img/' . $rsedit->intra_gallery_id); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
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
                    <a class="btn btn-danger cancel-button" href="#" data-target="#popupInsert" role="button">ยกเลิก</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="flex-item-right-share-file">
    <div class="row">
        <div class="col-6 mt-5">
            <img src="<?php echo base_url("docs/intranet/album.png"); ?>" width="auto" style="max-width: 100%;">
            <span class="font-folder-detail mx-3"><?= $rsedit->intra_gallery_name; ?></span>
        </div>
        <div class="col-6 mt-5">
            <div class="d-flex justify-content-end">
                <a href="#" class="popup-insert" data-target="#popupInsert">
                    <img src="<?php echo base_url("docs/intranet/btn-intra-add-img-video.png"); ?>" width="auto" style="max-width: 100%;">
                </a>
            </div>
        </div>
    </div>

    <div class="box-folder-detail mt-4">
        <div class="row mt-3" style="margin-left: 65px; margin-right: 30px;">

            <?php
            // Combine image and video data
            $combinedData = array_merge($rsimg, $rsvideo);

            $count = count($combinedData);
            $itemsPerPage = 6; // จำนวนรายการต่อหน้า
            $totalPages = ceil($count / $itemsPerPage);

            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

            $startIndex = ($currentPage - 1) * $itemsPerPage;
            $endIndex = min($startIndex + $itemsPerPage - 1, $count - 1);

            for ($i = $startIndex; $i <= $endIndex; $i++) {
                $currentItem = $combinedData[$i];
            ?>

                <!-- Your HTML code for displaying the item -->
                <div class="col-sm-4" style="height: 31vh;">
                    <?php if (isset($currentItem->intra_gallery_img_id)) : ?>
                        <!-- Display image -->
                        <a href="<?= base_url('docs/intranet/img/' . $currentItem->intra_gallery_img_img); ?>" data-lightbox="image-1">
                        <img src="<?= base_url('docs/intranet/img/' . $currentItem->intra_gallery_img_img); ?>" width="90%" height="80%">
                        </a>
                        <br>
                        <div class="row mt-3">
                            <div class="col-6">
                                <?= $currentItem->intra_gallery_img_img; ?>
                            </div>
                            <div class="col-6">
                                <?php if ($_SESSION['m_level'] == 1 || $_SESSION['m_level'] == 2 || $_SESSION['m_fname'] == $currentItem->intra_gallery_img_by) : ?>
                                    <div class="d-flex justify-content-end mr-5">
                                        <a class="btn btn-danger btn-sm" href="#" role="button" onclick="confirmDeleteImg(<?= $currentItem->intra_gallery_img_id; ?>, '<?= $currentItem->intra_gallery_img_img; ?>');">
                                            <i class="bi bi-trash fa-lg mx-2"></i>ลบ
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <script>
                                    function confirmDeleteImg(file_id, file_name) {
                                        Swal.fire({
                                            title: 'คุณแน่ใจหรือไม่?',
                                            text: 'คุณต้องการลบไฟล์ ' + file_name + ' ใช่หรือไม่?',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'ใช่, ต้องการลบ!',
                                            cancelButtonText: 'ยกเลิก'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                // หลังจากคลิกยืนยันให้เรียก Controller ที่ใช้ในการลบไฟล์ PDF
                                                window.location.href = "<?= site_url('Intra_gallery/del_img/'); ?>" + file_id;
                                            }
                                        });
                                    }
                                </script>
                            </div>
                        </div>
                    <?php elseif (isset($currentItem->intra_gallery_video_id)) : ?>
                        <!-- Display video -->
                        <video width="90%" height="80%" controls>
                            <source src="<?= base_url('docs/intranet/video/' . $currentItem->intra_gallery_video_video); ?>" type="video/mp4">
                        </video>
                        <br>
                        <div class="row mt-3">
                            <div class="col-6">
                                <?= $currentItem->intra_gallery_video_video; ?>
                            </div>
                            <div class="col-6">
                                <?php if ($_SESSION['m_level'] == 1 || $_SESSION['m_level'] == 2 || $_SESSION['m_fname'] == $currentItem->intra_gallery_video_by) : ?>
                                    <div class="d-flex justify-content-end mr-5">
                                        <a class="btn btn-danger btn-sm" href="#" role="button" onclick="confirmDeleteVideo(<?= $currentItem->intra_gallery_video_id; ?>, '<?= $currentItem->intra_gallery_video_video; ?>');">
                                            <i class="bi bi-trash fa-lg mx-2"></i>ลบ
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <script>
                                    function confirmDeleteVideo(file_id, file_name) {
                                        Swal.fire({
                                            title: 'คุณแน่ใจหรือไม่?',
                                            text: 'คุณต้องการลบไฟล์ ' + file_name + ' ใช่หรือไม่?',
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'ใช่, ต้องการลบ!',
                                            cancelButtonText: 'ยกเลิก'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                // หลังจากคลิกยืนยันให้เรียก Controller ที่ใช้ในการลบไฟล์ PDF
                                                window.location.href = "<?= site_url('Intra_gallery/del_video/'); ?>" + file_id;
                                            }
                                        });
                                    }
                                </script>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php } ?>

        </div>
    </div>

    <div class="row mt-3">
        <div class="col-sm-2">
            <a href="<?= site_url('Intra_gallery'); ?>" class="underline">
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