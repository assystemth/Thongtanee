<div class="bg-pages ">
    <div class="row pad-path">
        <div class="path1-1">
            <span class="font-path-1 underline"><a href="<?php echo site_url('Home'); ?>">หน้าแรก</a></span>
        </div>
        <div class="path2-2">
            <span class="font-path-2 underline"><a href="#">ข้อมูลทั่วไป</a></span>
        </div>
    </div>
    <div class="page-center">
        <div class="head-pages">
            <span class="font-pages-head">ภาพกิจกรรม</span>
        </div>
    </div>
    <div class="bg-pages-in">
        <div>
            <img src="<?php echo base_url('docs/img/' . $rsActivity->activity_img); ?>" width="100%" height="460">
        </div>
        <div class="scrollable-container-550">
            <div class="page-content-travel mt-4">
                <span class="font-page-detail-head"><?= $rsActivity->activity_name; ?></span>
                <div class="border-gray-332"></div>
                <span class="font-page-detail-time-img"><svg xmlns="http://www.w3.org/2000/svg" width="13" height="14" fill="currentColor" class="bi bi-calendar-minus-fill" viewBox="0 0 16 16">
                        <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1 0-1z" />
                    </svg>
                    <?php
                    // ในการใช้งาน setThaiMonth
                    $date = new DateTime($rsActivity->activity_date);
                    $day_th = $date->format('d');
                    $month_th = setThaiMonth($date->format('F')); // เรียกใช้ setThaiMonth สำหรับชื่อเดือน
                    $year_th = $date->format('Y') + 543; // เพิ่มขึ้น 543 ปี
                    $formattedDate = "$day_th $month_th $year_th"; // วันที่และเดือนเป็นภาษาไทย
                    echo $formattedDate;
                    ?>
                </span>
                &nbsp;
                <span class="font-page-detail-time-img">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="14" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                    </svg>
                    <?php
                    $date = new DateTime($rsActivity->activity_date);
                    $formattedTime = $date->format('H:i'); // เวลา
                    echo $formattedTime;
                    ?>
                    น.</span>
                <br><br>
                <br>
                <span class="font-page-detail-content-img"><?= $rsActivity->activity_detail; ?></span>
                <br><br>
                <div class="popup">
                    <div class="row mt-5">
                        <?php foreach ($rsImg as $img) { ?>
                            <div class="col-3 mb-3">
                                <img class="rounded-all" src="<?php echo base_url('docs/img/' . $img->activity_img_img); ?>" width="209px" height="202px">
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <span class="font-page-detail-view-img">จำนวนผู้เข้าชม : <?= $rsActivity->activity_view; ?></span>
            </div>
            <div class="col-6">
                <div class="margin-top-delete-topic d-flex justify-content-end">
                    <a href="<?php echo site_url('Pages/activity'); ?>"><img src="<?php echo base_url("docs/k.btn-back.png"); ?>"></a>
                </div>
            </div>
        </div>
    </div>
</div>