<div class="bg-pages">
    <div class="row pad-path">
        <div class="path1-1">
            <span class="font-path-1 underline"><a href="<?php echo site_url('Home'); ?>">หน้าแรก</a></span>
        </div>
        <div class="path2-1">
            <span class="font-path-2 underline"><a href="#">แผนงาน</a></span>
        </div>
    </div>
    <div class="container-pages-news">
        <div class="page-center">
            <div class="head-pages-three">
                <span class="font-pages-head">แผนป้องกันและบรรเทาสาธารณภัยประจำปี</span>
            </div>
        </div>
        <div style="padding-top: 80px;"></div>
        <?php
        $count = count($query);
        $itemsPerPage = 10; // จำนวนรายการต่อหน้า
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
            <div class="pages-select-pdf underline">
                <div class="row">
                    <div class="col-1 style-col-img">
                        <a href="<?php echo site_url('Pages/plan_pmda_detail/' . $rs->plan_pmda_id); ?>">
                            <?php if (!empty($rs->plan_pmda_img)): ?>
                                <img class="border-radius24" src="<?php echo base_url('docs/img/' . $rs->plan_pmda_img); ?>"
                                    width="94px" height="63px">
                            <?php else: ?>
                                <img class="border-radius24" src="<?php echo base_url('docs/logo.png'); ?>" width="94px"
                                    height="63px">
                            <?php endif; ?>
                        </a>
                    </div>
                    <div class="col-9 font-pages-content">
                        <a href="<?php echo site_url('Pages/plan_pmda_detail/' . $rs->plan_pmda_id); ?>">
                            <span class="one-line-ellipsis">
                                <?= $rs->plan_pmda_name; ?>
                            </span>
                        </a>
                    </div>
                    <div class="col-2 span-time-pages-news">
                        <a href="<?php echo site_url('Pages/plan_pmda_detail/' . $rs->plan_pmda_id); ?>">
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="12" height="16" fill="currentColor"
                                    class="bi bi-calendar-minus-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1 0-1z" />
                                </svg>
                                <?php
                                // ในการใช้งาน setThaiMonth
                                $date = new DateTime($rs->plan_pmda_date);
                                $day_th = $date->format('d');
                                $month_th = setThaiMonthAbbreviation($date->format('F')); // เรียกใช้ setThaiMonth สำหรับชื่อเดือน
                                $year_th = $date->format('Y') + 543; // เพิ่มขึ้น 543 ปี
                                $formattedDate = "$day_th $month_th $year_th"; // วันที่และเดือนเป็นภาษาไทย
                                echo $formattedDate;
                                ?>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!-- แสดงปุ่ม Next และ Previous -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php if ($currentPage > 1): ?>
                    <li class="page-item">
                        <a class="page-link-next-pre underline" href="?page=<?php echo $currentPage - 1; ?>"
                            aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>

                <?php if ($currentPage < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link-next-pre underline" href="?page=<?php echo $currentPage + 1; ?>"
                            aria-label="Next">
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