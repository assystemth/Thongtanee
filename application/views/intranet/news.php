<!-- ส่วนทางขวา -->
<div class="flex-item-right">
   <div class="d-flex justify-content-end" style="margin-top: 2%;">
   <div class="search">
            <form id="searchForm" action="<?= site_url('Intra_announce/search'); ?>" method="post">
                <div class="input-group">
                    <input type="text" name="search_term" class="searchTerm form-control" placeholder="ค้นหา">
                    <div class="input-group-append">
                        <button type="submit" class="searchButton btn btn-outline">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
      <a href="<?= site_url('System_intranet/adding'); ?>">
         <img src="<?php echo base_url("docs/intranet/btn-intra-add-news.png"); ?>" width="auto" style="max-width: 100%;">
      </a>
   </div>
   <div class="row mt-4">
      <?php
      $count = count($query);
      $itemsPerPage = 3; // จำนวนรายการต่อหน้า
      $totalPages = ceil($count / $itemsPerPage);

      $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

      $startIndex = ($currentPage - 1) * $itemsPerPage;
      $endIndex = min($startIndex + $itemsPerPage - 1, $count - 1);

      for ($i = $startIndex; $i <= $endIndex; $i++) {
         $rs = $query[$i];
      ?>
         <div class="col-sm-4">
            <a href="<?= site_url('System_intranet/detail/' . $rs->intra_news_id); ?>" class="underline">
               <img src="<?= base_url('docs/intranet/img/' . $rs->intra_news_img); ?>" width="100%" height="50%">
               <div class="mt-4">
                  <span class="font-24b black limit-font-two"><?= $rs->intra_news_topic; ?></span>
                  <div class="d-flex justify-content-start mt-2">
                     <span class="font-20 gray">
                        <?php
                        // ในการใช้งาน setThaiMonth
                        $date = new DateTime($rs->intra_news_datesave);
                        $day_th = $date->format('d');
                        $month_th = setThaiMonth($date->format('F')); // เรียกใช้ setThaiMonth สำหรับชื่อเดือน
                        $year_th = $date->format('Y') + 543; // เพิ่มขึ้น 543 ปี
                        $formattedDate = "$day_th $month_th $year_th"; // วันที่และเดือนเป็นภาษาไทย
                        echo $formattedDate;
                        ?>
                     </span>
                  </div>
                  <div class="border-gray-100 mb-3"></div>
                  <span class="font-20 gray limit-font-five"><?= $rs->intra_news_detail; ?></span>
               </div>
            </a>
         </div>
      <?php } ?>
   </div>

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