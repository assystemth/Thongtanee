<div class="bg-pages">
	        <div class="row pad-path">
            <div class="path1-1">
                <span class="font-path-1 underline"><a href="<?php echo site_url('Home'); ?>">หน้าแรก</a></span>
            </div>
            <div class="path2-2">
                <span class="font-path-2 underline"><a href="#">ITA ประจำปี</a></span>
            </div>
        </div>
    <div class="container-pages-news">
        <div class="page-center">
            <div class="head-pages-two">
                <span class="font-pages-head">การประเมินคุณธรรมและความโปร่งใส ITA</span>
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
                        <img class="border-radius24" src="<?php echo base_url('docs/k.logo.png'); ?>" width="94px" height="63px">
                    </div>
                    <div class="col-9 font-pages-content">
                        <a href="<?php echo site_url('Pages/ita_year_detail/' . $rs->ita_year_id); ?>">
                            <span class="one-line-ellipsis">ITA ประจำปี <?= $rs->ita_year_year; ?></span>
                        </a>
                    </div>
                    <div class="col-2 span-time-pages-news">
                        <span>
                        </span>
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
            <a href="<?php echo site_url('Pages/ita_all'); ?>"><img src="<?php echo base_url("docs/k.btn-back.png"); ?>"></a>
        </div>
    </div>
</div>