<div class="bg-pages">
    <div class="row pad-path">
        <div class="path1-1">
            <span class="font-path-1 underline"><a href="<?php echo site_url('Home'); ?>">หน้าแรก</a></span>
        </div>
        <div class="path2-1">
            <span class="font-path-2  underline"><a href="#">ข้อมูลทั่วไป</a></span>
        </div>
    </div>
    <div class="container-pages-news">
        <div class="page-center">
            <div class="head-pages">
                <span class="font-pages-head">ภาพกิจกรรม</span>
            </div>
        </div>
        <div class="row" style="padding-top: 80px;">
            <?php
            $count = count($query);
            $itemsPerPage = 12; // จำนวนรายการต่อหน้า
            $totalPages = ceil($count / $itemsPerPage);

            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

            // ปรับตำแหน่งที่กำหนดค่า $numToShow
            $numToShow = 3; // จำนวนปุ่มที่ต้องการแสดง
            $half = floor($numToShow / 2);

            $startPage = max($currentPage - $half, 1);
            $endPage = min($startPage + $numToShow - 1, $totalPages);

            $startIndex = ($currentPage - 1) * $itemsPerPage;
            $endIndex = min($startIndex + $itemsPerPage - 1, $count - 1);

            for ($i = $startIndex; $i <= $endIndex; $i++) {
                $rs = $query[$i];
            ?>
                <div class="col-3">
                    <div class="page-border-activity">
                        <?php if (!empty($rs->activity_img)) : ?>
                            <img class="rounded-top-left-right" src="<?php echo base_url('docs/img/' . $rs->activity_img); ?>" width="100%" height="155px">
                        <?php else : ?>
                            <img class="rounded-top-left-right" src="<?php echo base_url('docs/logo.png'); ?>" width="100%" height="280px">
                        <?php endif; ?>
                        <div class="page-travel-content" style=" padding: 10px; padding-top: 10px; ">
                            <span class="font-pages-heads-img two-line-ellipsis"><?= $rs->activity_name; ?></span>
                            <!-- <span class="font-pages-details-img two-line-ellipsis"><?= $rs->activity_detail; ?></span> -->
                            <span class="span-time-pages-img"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" fill="currentColor" class="bi bi-calendar-minus-fill" viewBox="0 0 16 16">
                                    <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1 0-1z" />
                                </svg>
                                <?php
                                // ในการใช้งาน setThaiMonth
                                $date = new DateTime($rs->activity_date);
                                $day_th = $date->format('d');
                                $month_th = setThaiMonth($date->format('F')); // เรียกใช้ setThaiMonth สำหรับชื่อเดือน
                                $year_th = $date->format('Y') + 543; // เพิ่มขึ้น 543 ปี
                                $formattedDate = "$day_th $month_th $year_th"; // วันที่และเดือนเป็นภาษาไทย
                                echo $formattedDate;
                                ?>
                            </span>
                            <span class="span-time-pages-img">
                                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                </svg>
                                <?php
                                $date = new DateTime($rs->activity_date);
                                $formattedTime = $date->format('H:i'); // เวลา
                                echo $formattedTime;
                                ?>
                                น.</span>
                        </div>
                        <div class="span-time-pages-img underline d-flex justify-content-end mar-right-10">
                            <a href="<?= site_url('pages/activity_detail/' . $rs->activity_id); ?>">รายละเอียด <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- แสดงปุ่ม Next และ Previous -->
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php if ($currentPage > 1) : ?>
                        <li class="page-item">
                            <a class="page-link-next-pre underline" href="?page=<?php echo $currentPage - 1; ?>" aria-label="Previous">
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
                            <a class="page-link-next-pre underline" href="?page=<?php echo $currentPage + 1; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <div class="margin-top-delete-topic d-flex justify-content-end">
                <a href="<?php echo site_url('Home'); ?>"><img src="<?php echo base_url("docs/k.btn-back.png"); ?>"></a>
            </div>
        </div>
    </div>