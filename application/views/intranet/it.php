<!-- ส่วนทางขวา -->
<div class="flex-item-right">
    <div class="row">
        <!-- <?php foreach ($api_data1 as $service): ?>
            <div>
                <h2><?php echo $service['service_title']; ?></h2>
                <p><?php echo $service['service_intro']; ?></p>
                <img src="<?php echo $service['service_img']; ?>" alt="<?php echo $service['service_title']; ?>">
                <p><?php echo $service['service_detail']; ?></p>
                <p>Date: <?php echo $service['service_date']; ?></p>
            </div>
        <?php endforeach; ?> -->
        <!-- <br>
        <?php foreach ($api_data2 as $sale): ?>
            <div>
                <h2><?php echo $sale['sale_fname']; ?></h2>
                <p><?php echo $sale['sale_lname']; ?></p>
                <img src="<?php echo $sale['sale_img']; ?>" alt="<?php echo $service['service_title']; ?>">
                <p><?php echo $sale['sale_nickname']; ?></p>
                <p><?php echo $sale['sale_phone']; ?></p>
            </div>
        <?php endforeach; ?> -->



        <h4 class="font-topic-all-it mt-5">ผลิตภัณฑ์</h4>
        <div class="col-9">
            <div class="row">
                <?php foreach ($api_data1 as $service): ?>
                    <div class="col-4 mt-4 mb-3">
                        <div class="card-all-it">
                            <div class="row">
                                <img src="https://www.assystem.co.th/asset/img_services/<?php echo $service['service_img']; ?>"
                                    style="border-radius: 30px;">
                                <div class="text-center">
                                    <h5 class="card-service-top"><?php echo $service['service_title']; ?></h5>
                                    <p class="card-service limit-font-five mt-3"><?php echo $service['service_intro']; ?>
                                    </p>
                                    <a href="https://www.assystem.co.th/service/detail/<?php echo $service['service_id']; ?>"
                                        target="blank" class="btn btn-all-it">เพิ่มเติม
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-3 mt-4">
            <div class="all-complain">
                <div class="card-all-it2">
                    <h5 class="card-sale text-center" style="margin-top: -15px;">สอบถามข้อมูล<br>
                        บริษัท เอเอส ซิสเต็ม จำกัด<br>
                        โทร : 043-009-848</h5>
                    <?php foreach ($api_data2 as $sale): ?>
                        <div class="row" style="margin-left: 25px;">
                            <div class="col-9">
                                <img class="sale-img"
                                    src="https://www.assystem.co.th/asset/img_sale/<?php echo $sale['sale_img']; ?>">
                                <div class="text-center">
                                    <p class="card-sale mt-1"><?php echo $sale['sale_phone']; ?></p>
                                    <p class="card-sale" style="margin-top: -20px;">(<?php echo $sale['sale_nickname']; ?>)
                                    </p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="dropdown-sale dropleft">
                                    <div data-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </div>
                                    <div class="dropdown-menu" style="margin-left: 15px;">
                                    <div class="border-gray">
                                        <span><i class="bi bi-person detail-sale" style="font-size:25px"></i></span><span class="dropdown-top">ข้อมูล</span><br>
                                    </div>
                                        <div class="detail-sale2">

                                            <!-- <p>ชื่อ <?php echo $sale['sale_fname']; ?> นามสกุล
                                                <?php echo $sale['sale_lname']; ?>
                                            </p> -->
                                            <!-- <p>E-mail <?php echo $sale['sale_email']; ?></p> -->
                                            <!-- <p>Line <?php echo $sale['sale_line']; ?></p> -->

                                            <span class="font-sale-gray">ชื่อ </span>&nbsp;<span class="font-sale-black"><?php echo $sale['sale_fname']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="font-sale-gray"> นามสกุล</span>&nbsp;<span class="font-sale-black"> <?php echo $sale['sale_lname']; ?></span><br>
                                            <span class="font-sale-gray" >E-mail </span><span class="font-sale-black"><?php echo $sale['sale_email']; ?></span><br>
                                            <span class="font-sale-gray">Line </span><span class="font-sale-black"><?php echo $sale['sale_line']; ?></span>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

</div>