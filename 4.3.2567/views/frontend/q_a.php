<div class="bg-pages ">
    <div class="container-pages-news">
        <div class="page-center">
            <div class="head-pages">
                <span class="font-pages-head">กระทู้ถาม - ตอบ</span>
            </div>
        </div>
        <div class="row">
            <div class="path1-2">
                <span class="font-path-1 underline"><a href="<?php echo site_url('Home'); ?>">หน้าแรก</a></span>
            </div>
            <div class="path2-1">
                <span class="font-path-2 underline"><a href="#">E-service</a></span>
            </div>
        </div>
        <div class="bg-pages-in-e-service ">

            <div class="mt-4">
                <a href="<?php echo site_url('Pages/addding_q_a'); ?>"><img src="<?php echo base_url("docs/s.btn-q-a.png"); ?>"></a>
            </div>
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
                <div class="pages-select-q_a mt-3 underline">
                    <div class="row">
                        <div class="col-8">
                            <a href="<?php echo site_url('Pages/q_a_chat/' . $rs->q_a_id); ?>">
                                <span class="font-q-a-list two-line-ellipsis"><?= $rs->q_a_msg; ?></span>
                            </a>
                        </div>
                        <div class="col-4" style="margin-top: -10px;">
                            <div class="d-flex justify-content-end">
                                <span class="span-time-q-a">ผู้ตั้งกระทู้ : <?= $rs->q_a_by; ?></span>
                            </div>
                            <div class="d-flex justify-content-end">
                                <span class="span-time-q-a"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="16" fill="currentColor" class="bi bi-calendar-minus-fill" viewBox="0 0 16 16">
                                        <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1 0-1z" />
                                    </svg>
                                    <?php
                                    $date = new DateTime($rs->q_a_datesave);
                                    $formattedDate = $date->format('d F Y'); // วันที่เป็นเดือนภาษาไทย
                                    echo $formattedDate;
                                    ?>
                                </span>&nbsp;
                                <span class="span-time-q-a">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                    </svg>
                                    <?php
                                    $date = new DateTime($rs->q_a_datesave);
                                    $formattedTime = $date->format('H:i'); // เวลา
                                    echo $formattedTime;
                                    ?>
                                    น.</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- แสดงปุ่ม Pagination -->
            <div class="pagination-container d-flex justify-content-between mt-3">
                <div class="pagination-pages">
                    <ul class="pagination">
                        <!-- แสดงปุ่ม "กลับไปหน้าแรก" ถ้าหน้าปัจจุบันไม่ได้ต่อเนื่องจากหน้าแรก -->
                        <?php
                        $numToShow = 3; // จำนวนปุ่มที่ต้องการแสดง
                        $half = floor($numToShow / 2);

                        // ปุ่มหน้าเริ่มต้น
                        $startPage = max($currentPage - $half, 1);

                        // ปุ่มหน้าสุดท้าย
                        $endPage = min($startPage + $numToShow - 1, $totalPages);

                        // แสดงปุ่ม "กลับไปหน้าแรก" ถ้าหน้าปัจจุบันไม่ได้ต่อเนื่องจากหน้าแรก
                        if ($currentPage - $numToShow > -1) {
                        ?>
                            <li class="page-item pagination-item">
                                <a class="page-link" href="?page=1">1</a>
                            </li>
                            <li class="page-item pagination-item disabled">
                                <span class="page-link">...</span>
                            </li>
                        <?php
                        }

                        // แสดงปุ่มหน้า
                        for ($i = $startPage; $i <= $endPage; $i++) {
                        ?>
                            <li class="page-item pagination-item <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php
                        }

                        // แสดงปุ่ม "..." ถ้าหน้าไม่ได้ต่อเนื่อง
                        if ($endPage < $totalPages) {
                        ?>
                            <li class="page-item pagination-item disabled">
                                <span class="page-link">...</span>
                            </li>
                        <?php
                        }

                        // แสดงปุ่มสุดท้าย
                        if ($endPage < $totalPages) {
                        ?>
                            <li class="page-item pagination-item <?php echo ($totalPages == $currentPage) ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $totalPages; ?>"><?php echo $totalPages; ?></a>
                            </li>
                        <?php
                        }
                        ?>

                    </ul>
                </div>
                <!-- ปุ่ม Next และ Previous -->
                <div class="pagination-next-prev row" style="list-style-type: none; margin-right: 50px;">
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
            <div class="margin-top-delete-topic d-flex justify-content-end">
                <a href="<?php echo site_url('Home'); ?>"><img src="<?php echo base_url("docs/s.btn-back.png"); ?>"></a>
            </div>
        </div>
    </div>
</div>