<div class="bg-pages ">
    <div class="container-pages-news">
        <div class="page-center">
            <div class="head-pages">
                <span class="font-pages-head">ผลิตภัณฑ์ชุมชน</span>
            </div>
        </div>
        <div class="row">
            <div class="path1-1">
                <span class="font-path-1 underline"><a href="<?php echo site_url('Home'); ?>">หน้าแรก</a></span>
            </div>
            <div class="path2-3">
                <span class="font-path-2 underline"><a href="#">ผลิตภัณฑ์ชุมชน</a></span>
            </div>
        </div>
        <div style="padding-top: 40px;"></div>
        <div class="pages-content break-word">
            <?php
            $count = count($qOtop);
            $itemsPerPage = 2; // จำนวนรายการต่อหน้า
            $totalPages = ceil($count / $itemsPerPage);

            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

            $startIndex = ($currentPage - 1) * $itemsPerPage;
            $endIndex = min($startIndex + $itemsPerPage - 1, $count - 1);

            for ($i = $startIndex; $i <= $endIndex; $i++) {
                $rs = $qOtop[$i];
            ?>
                <div class="row page-border-otop">
                    <div class="col-8">
                        <div class="scrollable-container-otop">
                            <span class="font-otop-head"><?= $rs->otop_name; ?></span>
                            <div class="border-gray-332"></div>
                            <div style="padding-bottom: 10px;">
                                <span class="span-time-pages-news"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-calendar-minus-fill" viewBox="0 0 16 16">
                                        <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1 0-1z" />
                                    </svg>
                                    <?php
                                    // ในการใช้งาน setThaiMonth
                                    $date = new DateTime($rs->otop_date);
                                    $day_th = $date->format('d');
                                    $month_th = setThaiMonth($date->format('F')); // เรียกใช้ setThaiMonth สำหรับชื่อเดือน
                                    $year_th = $date->format('Y') + 543; // เพิ่มขึ้น 543 ปี
                                    $formattedDate = "$day_th $month_th $year_th"; // วันที่และเดือนเป็นภาษาไทย
                                    echo $formattedDate;
                                    ?>
                                </span>
                                <span class="span-time-pages-news">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                    </svg>
                                    <?php
                                    $date = new DateTime($rs->otop_date);
                                    $formattedTime = $date->format('H:i'); // เวลา
                                    echo $formattedTime;
                                    ?>
                                    น.</span>
                            </div>
                            <div style="padding-bottom: 10px;">
                                <span class=" font-otop-content three-line-ellipsis"><?= $rs->otop_detail; ?></span>
                            </div>
                            <div class="font-otop-content">
                                <span>ประเภทสินค้า : <?= $rs->otop_type; ?></span><br>
                                <span>ขนาด : <?= $rs->otop_size; ?> เซนติเมตร</span><br>
                                <span>น้ำหนัก : <?= $rs->otop_weight; ?> กิโลกรัม</span><br>
                                <span>ราคา : <?= $rs->otop_price; ?> บาท</span><br>
                                <span>ที่อยู่ : <?= $rs->otop_location; ?></span><br>
                                <span>เบอร์ติดต่อ : <?= $rs->otop_phone; ?></span><br>
                                <span>Facebook : <?= $rs->otop_fb; ?></span><br>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <?php if (!empty($rs->otop_img)) : ?>
                            <img src="<?php echo base_url('docs/img/' . $rs->otop_img); ?>" width="auto" style="max-width: 100%;" height="310px">
                        <?php else : ?>
                            <img src="<?php echo base_url('docs/coverphoto.png'); ?>" width="auto" style="max-width: 100%;" height="310px">
                        <?php endif; ?>
                    </div>
                </div>
                <div style="margin-top: 50px;"></div>
            <?php } ?>
            <!-- แสดงปุ่ม Next และ Previous -->
            <nav aria-label="Page navigation example">
                <div class="pagination-container d-flex justify-content-between">
                    <div class="pagination-pages">
                        <ul class="pagination">
                            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                <li class="page-item pagination-item <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </div>
                    <div class="pagination-next-prev row" style="list-style-type: none;">
                        <div class="col-5">
                            <?php if ($currentPage > 1) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>" aria-label="Previous">
                                        <img src="<?php echo base_url('docs/s.pages-pre2.png'); ?>" alt="Previous" class="pagination-icon">
                                        <span aria-hidden="true"></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </div>
                        <div class="col-5">
                            <?php if ($currentPage < $totalPages) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>" aria-label="Next">
                                        <img src="<?php echo base_url('docs/s.pages-next2.png'); ?>" alt="Next" class="pagination-icon">
                                        <span aria-hidden="true"></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>