<div class="image-slide-stick-mid">
    <a href="https://itas.nacc.go.th/go/eit/1e8vml" target="_blank">
        <img src="docs/eit-slide-midv2.png">
    </a>
    <img src="docs/eit-slide-close.png" class="close-button-slide-mid" onclick="closeImageSlideMid()">
</div>
<div class="welcome">

    <!-- <div class="tab-container">
        <img src="docs/item-news-top.png" width="324" height="100" style="position: absolute; z-index: 2;">
        <div id="marquee-container">
            <div class="marquee">
                <div>
                    <?php
                    $maxIterations = 1000;
                    $iteration = 0;
                    while ($iteration < $maxIterations) {
                        foreach ($qHotnews as $index => $hotnews) {
                            echo '<span>' . $hotnews->hotNews_text . '</span>';
                        }
                        $iteration++;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div> -->
</div>

<!-- <div class="tab-container">
    <div class="rectangle1"><span class="news-update">&nbsp;<i>ข่าวสารอัพเดต</i></span></div>
    <div class="rectangle2"></div>
    <?php foreach ($qHotnews as $hotnews) { ?>
        <div class="running-text"><?= $hotnews->hotNews_text; ?></div>
    <?php } ?>
</div> -->
<!-- วิสัยทัศน์  -->
<div class="vision">
    <div class="row">
        <div class="col-4">
            <div class="d-flex justify-content-center" style="margin-top: -30px;">
                <img class="mark-logo" src="docs/t.item-vision-left1.png">
            </div>
            <div class="d-flex justify-content-center mt-2">
                <img class="mark-logo" src="docs/t.item-vision-left2.png">
            </div>
            <div class="d-flex justify-content-center mt-2">
                <a href="<?php echo site_url('Pages/msg_pres'); ?>" class="zoom-otop">
                    <img class="mark-logo" src="docs/t.item-vision-left3.png">
                </a>
            </div>
        </div>
        <div class="col-8">
            <div class="d-flex justify-content-center" style="margin-top: -30px;">
                <img src="docs/t.item-vision-mid1.png">
            </div>
            <div class="row" style="padding-top: 50px;">
                <div class="col-4">
                    <div class="d-flex justify-content-center">
                        <a href="<?php echo site_url('Pages/ita_all'); ?>" class="zoom-otop">
                            <img class="mark-logo" src="docs/t.item-vision-right1.png">
                        </a>
                    </div>
                    <div class="d-flex justify-content-center mt-5">
                        <a href="#" class="zoom-otop" target="_blank">
                            <img class="mark-logo" src="docs/t.item-vision-right4.png">
                        </a>
                    </div>
                </div>
                <div class="col-4">
                    <div class="d-flex justify-content-center">
                        <a href="#oss" class="zoom-otop">
                            <img class="mark-logo" src="docs/t.item-vision-right2.png">
                        </a>
                    </div>
                    <div class="d-flex justify-content-center mt-5">
                        <a href="<?php echo site_url('Pages/km'); ?>" class="zoom-otop">
                            <img class="mark-logo" src="docs/t.item-vision-right5.png">
                        </a>
                    </div>
                </div>
                <div class="col-4">
                    <div class="d-flex justify-content-center">
                        <a href="https://dbdregcom.dbd.go.th/mainsite/index.php?id=28" class="zoom-otop"
                            target="_blank">
                            <img class="mark-logo" src="docs/t.item-vision-right3.png">
                        </a>
                    </div>
                    <div class="d-flex justify-content-center mt-5">
                        <a href="<?php echo site_url('Pages/laws_all'); ?>" class="zoom-otop">
                            <img class="mark-logo" src="docs/t.item-vision-right6.png">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-main">
    <!-- แทบวิ่ง  -->
    <img src="docs/t.item-news-top4.png" width="285" height="90"
        style="position: absolute; z-index: 2; margin-top: -22px;">

    <div class="tab-container">
        <?php
        $news = $this->HotNews_model->hotnews_frontend();

        echo '<div class="text-run-update">';
        foreach ($news as $item) {
            echo '<p>' . $item->hotNews_text . '</p>';
        }
        echo '</div>';
        ?>
    </div>

    <div class="content-banner mt-4">
        <div class="d-flex justify-content-center">
            <img src="docs/k.img-top-banner.png" alt="">
        </div>
        <img src="docs/k.bg-banner2.png" height="607px" width="1080px" class="frame-main">
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" style="z-index: 10;">
            <div class="carousel-indicators">
                <?php
                foreach ($qBanner as $index => $img_banner) {
                    $active = ($index === 0) ? "active" : "";
                    echo '<button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="' . $index . '" class="' . $active . '" aria-current="true" aria-label="Slide ' . ($index + 1) . '"></button>';
                }
                ?>
            </div>
            <div class="carousel-inner">
                <?php foreach ($qBanner as $index => $img_banner) { ?>
                    <div class="carousel-item <?= ($index === 0) ? "active" : ""; ?>" data-bs-interval="5000">
                        <a href="<?= $img_banner->banner_link; ?>" target="_blank">
                            <img src="docs\img\<?= $img_banner->banner_img; ?>" class="d-block w-100">
                        </a>
                    </div>
                <?php } ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>

<div class="head-activity p-3">
    <div class="dropdown-container">
        <!-- Dropdown 1 -->
        <button class="dropdown-trigger"
            style="border: none; background: none; padding: 0; margin: 0; padding-left: 40px; padding-top: 5px;">
            ข้อมูลทั่วไป
        </button>
        <div class="dropdown-content">
            <ul class="no-bullets mt-4">
                <div class="dropdown-left">
                    <!-- <li>
                            <div class="dropdown-item mb-3 mt-5"><img class="mx-5" src="docs/s.navmid-head1.png"></div>
                        </li> -->
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/history'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;ประวัติความเป็นมา</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/gci'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;ข้อมูลสภาพทั่วไป</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/vision'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;วิสัยทัศน์และพันธกิจ</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/authority'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;อำนาจหน้าที่</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/mission'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;ภารกิจและความรับผิดชอบ</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/executivepolicy'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;นโยบายผู้บริหาร</a></li>
                </div>
                <div class="dropdown-center">
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/ci'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;ข้อมูลชุมชน</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/travel'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;แหล่งท่องเที่ยว</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/otop'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;ผลิตภัณฑ์ชุมชน</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/si'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;ยุทธศาสตร์การพัฒนาด้านโครงสร้างพื้นฐาน</a>
                    </li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/contact'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;ติดต่อเรา</a></li>

                </div>
                <!-- <div class="dropdown-right">
                </div> -->
            </ul>
        </div>

        <!-- Dropdown 2 -->
        <button class="dropdown-trigger"
            style="border: none; background: none; padding: 0; margin: 0; padding-left: 70px; padding-top: 5px;">
            โครงสร้างบุคลากร
        </button>
        <div class="dropdown-content">
            <ul class="no-bullets mt-4">
                <div class="dropdown-left">
                    <!-- <li>
                            <div class="dropdown-item mb-3 mt-5"><img class="mx-5" src="docs/navmid-head21.png"></div>
                        </li> -->

                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/site_map'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;แผนผังโครงสร้างรวม</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/p_palaces'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;ทำเนียบเทศบาลธงธานี</a></li>
                    <!-- <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/p_palace'); ?>"><img src="docs/t.item-img-navmid.png">&nbsp;&nbsp;ทำเนียบเทศบาลธงธานี</a></li> -->
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/p_executives'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;คณะผู้บริหาร</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/p_council'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;สมาชิกเทศบาล</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/p_unit_leaders'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;หัวหน้าส่วนราชการ</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/p_employee'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;พนักงานเทศบาล</a></li>
                </div>
                <div class="dropdown-center">
                    <!-- <li>
                            <div class="dropdown-item mb-3 mt-5"><img class="" src="docs/navmid-head22.png"></div>
                        </li> -->

                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/p_deputy'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;สำนักปลัด</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/p_treasury'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;กองคลัง</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/p_maintenance'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;กองช่าง</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/P_audit'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;กองประปา</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/P_dsab'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;กองสาธารณสุขและสิ่งแวดล้อม</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/p_education'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;กองการศึกษาศาสนาและวัฒนธรรม</a></li>
                </div>
                <!-- <div class="dropdown-right">
                </div> -->

            </ul>
        </div>

        <!-- Dropdown 3 -->
        <button class="dropdown-trigger"
            style="border: none; background: none; padding: 0; margin: 0; padding-left: 75px; padding-top: 5px;">
            แผนงาน
        </button>
        <div class="dropdown-content">
            <ul class="no-bullets mt-4">
                <div class="dropdown-left">
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/plan_pdl'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;แผนพัฒนาท้องถิ่น</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/plan_pc3y'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;แผนอัตรากำลัง 3 ปี</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/plan_pds3y'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;แผนพัฒนาบุคลากร 3 ปี</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/plan_pdpa'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;แผนพัฒนาบุคคลากรประจำปี</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/plan_poa'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;แผนการดำเนินงานประจำปี</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/plan_pcra'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;แผนการจัดเก็บรายได้ประจำปี</a></li>
                </div>
                <div class="dropdown-center">
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/plan_dpy'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;แผนการบริหารและพัฒนาทรัพยากรบุคคลประจำปี</a>
                    </li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/plan_pop'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;แผนปฏิบัติการจัดซื้อจัดจ้าง</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/plan_paca'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;แผนปฏิบัติการป้องกันการทุจริต</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/plan_bgy'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;แผนการใช้จ่ายงบประมาณประจำปี</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/plan_pse'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;แผนการประหยัดพลังงาน</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/plan_pmda'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;แผนป้องกันและบรรเทาสาธารณะภัยประจำปี</a>
                    </li>
                </div>
                <div class="dropdown-right">
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/plan_psi'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;แผนแม่บทสารสนเทศ</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/plan_pae'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;โครงการส่งเสริมกิจกรรมผู้สูงอายุ</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/plan_spgl'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;มาตรฐานกำหมดตำแหน่งพนักงานเทศบาล</a></li>
                </div>
            </ul>
        </div>



        <!-- Dropdown 4 -->
        <button class="dropdown-trigger"
            style="border: none; background: none; padding: 0; margin: 0; padding-left: 90px; padding-top: 5px;">
            มาตรการภายในงาน
        </button>
        <div class="dropdown-content">
            <ul class="no-bullets mt-4">
                <div class="dropdown-left">
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/order'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;คำสั่งเทศบาล</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/announce'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;ประกาศเทศบาล</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/mui'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;มาตรการภายใน</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/guide_work'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;คู่มือการปฏิบัติงาน</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/km'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;Knowledge Management :
                            KM<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; การจัดการความรู้ของท้องถิ่น</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/loadform'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;ดาวน์โหลดแบบฟอร์ม</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/mptae'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;มาตรการส่งเสริมคุณธรรมและความโปร่งใส</a>
                    </li>
                </div>
            </ul>
        </div>


        <!-- Dropdown 5 -->
        <button class="dropdown-trigger"
            style="border: none; background: none; padding: 0; margin: 0; padding-left: 100px; padding-top: 5px;">
            การดำเนินงาน
        </button>
        <div class="dropdown-content">
            <ul class="no-bullets mt-4">
                <div class="dropdown-left">
                    <!-- <li>
                            <div class="dropdown-item mb-3 mt-5"><img class="mx-5" src="docs/navmid-head6.png"></div>
                        </li> -->

                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/operation_reauf'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;รายงานติดตามและประเมินผลแผนพัฒนาท้องถิ่น</a>
                    </li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/operation_rse'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;รายงานผลการประหยัดพลังงาน</a></li>
                    <li><a class="mar-left-9 dropdown-item"
                            href="<?php echo site_url('Pages/operation_rdam_hr'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;การบริหารและพัฒนาทรัพยากรบุคคล</a></li>
                    <li><a class="mar-left-12 dropdown-item"
                            href="<?php echo site_url('Pages/operation_policy_hr'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;นโยบายบริหารทรัพยากรบุคคล</a></li>
                    <li><a class="mar-left-12 dropdown-item"
                            href="<?php echo site_url('Pages/operation_am_hr'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;การดำเนินการตามนโยบายการบริหาร<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ทรัพยากรบุคคล</a>
                    </li>
                    <li><a class="mar-left-12 dropdown-item" href="<?php echo site_url('Pages/operation_omp'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;การออกคำสั่งด้านการบริหารงานบุคคล</a></li>
                    <li><a class="mar-left-12 dropdown-item"
                            href="<?php echo site_url('Pages/operation_cdm_topic'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;หลักเกณฑ์การบริหารและพัฒนา<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ทรัพยากรบุคคล</a>
                    </li>
                </div>
                <div class="dropdown-center">
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/ita_all'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;ITA การประเมินคุณธรรมและความโปร่งใส</a>
                    </li>
                    <li><a class="mar-left-12 dropdown-item" href="<?php echo site_url('Pages/operation_aca'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;การปฏิบัติการป้องกันการทุจริต</a></li>
                    <li><a class="mar-left-12 dropdown-item" href="<?php echo site_url('Pages/operation_mcc'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;การจัดการเรื่องร้องเรียนทุจริต</a></li>
                    <li><a class="mar-left-12 dropdown-item" href="<?php echo site_url('Pages/operation_sap'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;การปฏิบัติงานและการให้บริการ</a></li>
                    <li><a class="mar-left-12 dropdown-item" href="<?php echo site_url('Pages/operation_pgn'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;นโยบายไม่รับของขวัญ no gift policy</a></li>
                    <li><a class="mar-left-12 dropdown-item" href="<?php echo site_url('Pages/operation_po'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;การเปิดโอกาสให้มีส่วนร่วม</a></li>
                    <li><a class="mar-left-12 dropdown-item" href="<?php echo site_url('Pages/operation_eco'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;การเสริมสร้างวัฒนธรรมองค์กร</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/lpa'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;LPA การประเมินประสิทธิภาพขององค์กร</a></li>

                    <!-- <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/operation_am_hr'); ?>"><img src="docs/t.item-img-navmid.png">&nbsp;&nbsp;การดำเนินการบริหารทรัพยากรบุคคล</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/operation_cdm_topic'); ?>"><img src="docs/t.item-img-navmid.png">&nbsp;&nbsp;หลักเกณฑ์และการบริหารและพัฒนา</a></li> -->



                </div>
                <div class="dropdown-right">
                    <li><a class="mar-left-3 dropdown-item" href="<?php echo site_url('Pages/operation_sp'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;สรุปผลการจัดซื้อจัดจ้าง</a></li>
                    <li><a class="mar-left-3 dropdown-item" href="<?php echo site_url('Pages/operation_erc'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;การประเมินความเสี่ยงการทุจริตประพฤติมิชอบ</a>
                    </li>
                    <li><a class="mar-left-3 dropdown-item" href="<?php echo site_url('Pages/operation_amf'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;การดำเนินการเพื่อจัดการความเสี่ยงการทุจริต</a>
                    </li>
                    <li><a class="mar-left-3 dropdown-item" href="<?php echo site_url('Pages/operation_pm'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;การมีส่วนร่วมของผู้บริหาร</a></li>
                    <li><a class="mar-left-3 dropdown-item" href="<?php echo site_url('Pages/operation_aa'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;กิจการสภา</a></li>
            </ul>
        </div>


        <!-- Dropdown 6 -->
        <button class="dropdown-trigger"
            style="border: none; background: none; padding: 0; margin: 0; padding-left: 65px; padding-top: 5px;">
            บริการประชาชน
        </button>
        <div class="dropdown-content">
            <ul class="no-bullets mt-4">
                <div class="dropdown-left">
                    <!-- <li>
                            <div class="dropdown-item mb-3 mt-5"><img class="mx-5" src="docs/navmid-head6.png"></div>
                        </li> -->
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/pbsv_cac'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;ศูนย์ช่วยเหลือประชาชน</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/pbsv_cjc'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;ศูนย์ยุติธรรมชุมชน</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/pbsv_cig'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;ศูนย์ข้อมูลข่าวสารทางราชการ</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/pbsv_sags'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;คู่มือและมาตรฐานการให้บริการ</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/pbsv_dss'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;ข้อมูลเชิงสถิติการให้บริการ</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/pbsv_ae'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;ข้อมูลทะเบียนเบี้ยยังชีพผู้สูงอายุ</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/pbsv_rfc'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;รายงานการสำรวจความพึงพอใจการให้บริการ</a>
                    </li>
                </div>
                <div class="dropdown-center">
                    <!-- <li>
                            <div class="dropdown-item" href="#"><img class="mar-left-9" src="docs/s.item-nav-mid4v2.6.png"></div>
                        </li> -->

                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/pbsv_is'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;ข้อมูลบริการ</a></li>
                    <li><a class="mar-left-9 dropdown-item"
                            href="<?php echo site_url('Pages/adding_suggestions'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;ช่องรับฟังความคิดเห็น</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/q_a'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;กระทู้ถามตอบ (Q&A)</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/Questions'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;คำถามที่พบบ่อย (FAQ)</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/pbsv_oppr'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;งานอาสาสมัครป้องกันภัยฝ่ายพลเรือน
                            (อปพร.)</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/pbsv_ems'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;งานกู้ชีพ / การบริการการแพทย์ฉุกเฉิน
                            (EMS)</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/pbsv_ahs'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;หลักประกันสุขภาพเทศบาลตำบลธงธานี</a></li>
                    <!-- <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/pbsv_ae'); ?>"><img src="docs/t.item-img-navmid.png">&nbsp;&nbsp;เบี้ยผู้สูงอายุ</a></li> -->
                    <!-- <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/pbsv_tax'); ?>"><img src="docs/t.item-img-navmid.png">&nbsp;&nbsp;ข้อมูลการชำระภาษี</a></li> -->
                </div>
                <div class="dropdown-right">
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/pbsv_e_book'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;ดาวน์โหลดแบบฟอร์ม E-Book</a></li>
                    <li><a class="mar-left-9 dropdown-item"
                            href="<?php echo site_url('Pages/adding_corruption'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;แจ้งเรื่องทุจริตหน่วยงานภาครัฐ</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/pbsv_gup'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;คู่มือสำหรับประชาชน</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/pbsv_fp'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;การรับฟังความคิดเห็นของประชาชน</a></li>
                    <li><a class="mar-left-9 dropdown-item" href="<?php echo site_url('Pages/pbsv_ppdp'); ?>"><img
                                src="docs/t.item-img-navmid.png">&nbsp;&nbsp;นโยบายคุ้มครองข้อมูลส่วนบุคคล</a></li>
                </div>
            </ul>
        </div>
    </div>
</div>

<div class="bg-activity">
    <div class="d-flex justify-content-center" style="padding-top: 3%;">
        <img src="docs/t.head-activity.png">
    </div>
    <div class="row d-flex justify-content-center" style="padding-top: 40px; margin-left: 10px;">
        <?php foreach ($qActivity as $activity) { ?>
            <div class="card-activity col-2 ">
                <?php if (!empty($activity->activity_img)): ?>
                    <a href="<?= site_url('pages/activity_detail/' . $activity->activity_id); ?>">
                        <img src="<?php echo base_url('docs/img/' . $activity->activity_img); ?>" width="180px" height="160px" style="border-radius: 24px;">
                    </a>
                <?php else: ?>
                    <a href="<?= site_url('pages/activity_detail/' . $activity->activity_id); ?>">
                        <img src="<?php echo base_url('docs/coverphoto.png'); ?>">
                    </a>
                <?php endif; ?>
                <div class="box-activity">
                    <div class="d-flex justify-content-start mt-2">
                        <span class="text-end text-activity-time">
                            <?php
                            // ในการใช้งาน setThaiMonth
                            $date = new DateTime($activity->activity_date);
                            $day_th = $date->format('d');
                            $month_th = setThaiMonth($date->format('F')); // เรียกใช้ setThaiMonth สำหรับชื่อเดือน
                            $year_th = $date->format('Y') + 543; // เพิ่มขึ้น 543 ปี
                            $formattedDate = "$day_th $month_th $year_th"; // วันที่และเดือนเป็นภาษาไทย
                            echo $formattedDate;
                            ?>
                        </span>
                        <div style="margin-left: 35px;">
                            &nbsp;
                            <?php
                            // วันที่ของข่าว
                            $activity_date = new DateTime($activity->activity_date);

                            // วันที่ปัจจุบัน
                            $current_date = new DateTime();

                            // คำนวณหาความต่างของวัน
                            $interval = $current_date->diff($activity_date);
                            $days_difference = $interval->days;

                            // ถ้ามากกว่า 30 วัน ให้ซ่อนไว้
                            if ($days_difference > 30) {
                                // ไม่แสดงรูปภาพ
                            } else {
                                // แสดงรูปภาพ
                                echo '<img src="docs/activity-new.gif">';
                            }
                            ?>
                        </div>
                    </div>


                    <div class="text-activity underline three-line-ellipsis mt-1">
                        <a href="<?= site_url('pages/activity_detail/' . $activity->activity_id); ?>">
                            <span>
                                <?= strip_tags($activity->activity_name); ?>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="d-flex justify-content-center" style="margin-top: 3%;">
        <a href="<?php echo site_url('pages/activity'); ?>">
            <img src="docs/k.btn-all.png">
        </a>
    </div>

    <div class="content-news-bg-two underline">
        <div class="tab-container2">
            <div class="tab-link-two" onclick="openTabTwo('tabtwo1')">
                <img src="docs/t.news-head1.png" alt="Tab 1">
            </div>
            <div class="tab-link-two" onclick="openTabTwo('tabtwo2')">
                <img src="docs/t.news-head2.png" alt="Tab 2">
            </div>
            <div class="tab-link-two" onclick="openTabTwo('tabtwo3')">
                <img src="docs/t.news-head3.png" alt="Tab 3">
            </div>
            <div class="tab-link-two" onclick="openTabTwo('tabtwo4')">
                <img src="docs/t.news-head4.png" alt="Tab 4">
            </div>
        </div>
        <br>
        <div id="tabtwo1" class="tab-content-two">
            <?php foreach ($qNews as $news) { ?>
                <div class="content-news-detail">
                    <a href="<?php echo site_url('Pages/news_detail/' . $news->news_id); ?>">
                        <div class="row">
                            <div class="col-10">
                                <span class="text-news"><img src="docs/k.logo.png" width="30px" height="34px">&nbsp;&nbsp;
                                    <?= strip_tags($news->news_name); ?>
                                </span>
                            </div>
                            <div class="col-2">
                                <div class="row">
                                    <div class="col-10">
                                        <div class="d-flex justify-content-end ">
                                            <span class="text-news-time">
                                                <?php
                                                // ในการใช้งาน setThaiMonth
                                                $date = new DateTime($news->news_date);
                                                $day_th = $date->format('d');
                                                $month_th = setThaiMonthAbbreviation($date->format('F')); // เรียกใช้ setThaiMonth สำหรับชื่อเดือน
                                                $year_th = $date->format('Y') + 543; // เพิ่มขึ้น 543 ปี
                                                $formattedDate = "$day_th $month_th $year_th"; // วันที่และเดือนเป็นภาษาไทย
                                                echo $formattedDate;
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-2" style="margin-top: -28px; margin-left: -32px;">
                                        <?php
                                        // วันที่ของข่าว
                                        $news_date = new DateTime($news->news_date);

                                        // วันที่ปัจจุบัน
                                        $current_date = new DateTime();

                                        // คำนวณหาความต่างของวัน
                                        $interval = $current_date->diff($news_date);
                                        $days_difference = $interval->days;

                                        // ถ้ามากกว่า 30 วัน ให้ซ่อนไว้
                                        if ($days_difference > 30) {
                                            // ไม่แสดงรูปภาพ
                                        } else {
                                            // แสดงรูปภาพ
                                            echo '<img src="docs/news-new.gif" width="40" height="16">';
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
            <div class="d-flex justify-content-center" style="margin-top: -28px;">
                <a href="<?php echo site_url('pages/news'); ?>">
                    <img src="docs/k.btn-all.png">
                </a>
            </div>
        </div>
        <div id="tabtwo2" class="tab-content-two">
            <div class="content-news-detail">
                <a href="<?php echo site_url('Pages/canon_bgps'); ?>">
                    <span class="text-news"><img src="docs/k.logo.png" width="30px"
                            height="34px">&nbsp;&nbsp;ข้อบัญญัติงบประมาณ</span>
                </a>
            </div>
            <div class="content-news-detail">
                <a href="<?php echo site_url('Pages/canon_chh'); ?>">
                    <span class="text-news"><img src="docs/k.logo.png" width="30px"
                            height="34px">&nbsp;&nbsp;ข้อบัญญัติการควบคุมกิจการที่เป็นอันตรายต่อสุขภาพ</span>
                </a>
            </div>
            <div class="content-news-detail">
                <a href="<?php echo site_url('Pages/canon_ritw'); ?>">
                    <span class="text-news"><img src="docs/k.logo.png" width="30px"
                            height="34px">&nbsp;&nbsp;ข้อบัญญัติการติดตั้งระบบบำบัดน้ำเสียในอาคาร</span>
                </a>
            </div>
            <div class="content-news-detail">
                <a href="<?php echo site_url('Pages/canon_market'); ?>">
                    <span class="text-news"><img src="docs/k.logo.png" width="30px"
                            height="34px">&nbsp;&nbsp;ข้อบัญญัติตลาด</span>
                </a>
            </div>
            <div class="content-news-detail">
                <a href="<?php echo site_url('Pages/canon_rmwp'); ?>">
                    <span class="text-news"><img src="docs/k.logo.png" width="30px"
                            height="34px">&nbsp;&nbsp;ข้อบัญญัติการจัดการสิ่งปฏิกูลและมูลฝอย</span>
                </a>
            </div>
            <div class="content-news-detail">
                <a href="<?php echo site_url('Pages/canon_rcsp'); ?>">
                    <span class="text-news"><img src="docs/k.logo.png" width="30px"
                            height="34px">&nbsp;&nbsp;ข้อบัญญัติหลักเกณฑ์การคัดมูลฝอย</span>
                </a>
            </div>
            <div class="content-news-detail">
                <a href="<?php echo site_url('Pages/canon_rcp'); ?>">
                    <span class="text-news"><img src="docs/k.logo.png" width="30px"
                            height="34px">&nbsp;&nbsp;ข้อบัญญัติการควบคุมการเลี้ยงหรือปล่อยสุนัขและแมว</span>
                </a>
            </div>
        </div>
        <div id="tabtwo3" class="tab-content-two">
            <?php foreach ($qAnnounce as $gw) { ?>
                <div class="content-news-detail">
                    <a href="<?php echo site_url('Pages/announce_detail/' . $gw->announce_id); ?>">
                        <div class="row">
                            <div class="col-10">
                                <span class="text-news"><img src="docs/k.logo.png" width="30px" height="34px">&nbsp;&nbsp;
                                    <?= strip_tags($gw->announce_name); ?>
                                </span>
                            </div>
                            <div class="col-2">
                                <div class="row">
                                    <div class="col-10">
                                        <div class="d-flex justify-content-end ">
                                            <span class="text-news-time">
                                                <?php
                                                // ในการใช้งาน setThaiMonth
                                                $date = new DateTime($gw->announce_date);
                                                $day_th = $date->format('d');
                                                $month_th = setThaiMonthAbbreviation($date->format('F')); // เรียกใช้ setThaiMonth สำหรับชื่อเดือน
                                                $year_th = $date->format('Y') + 543; // เพิ่มขึ้น 543 ปี
                                                $formattedDate = "$day_th $month_th $year_th"; // วันที่และเดือนเป็นภาษาไทย
                                                echo $formattedDate;
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-2" style="margin-top: -28px; margin-left: -32px;">
                                        <?php
                                        // วันที่ของข่าว
                                        $announce_date = new DateTime($gw->announce_date);

                                        // วันที่ปัจจุบัน
                                        $current_date = new DateTime();

                                        // คำนวณหาความต่างของวัน
                                        $interval = $current_date->diff($announce_date);
                                        $days_difference = $interval->days;

                                        // ถ้ามากกว่า 30 วัน ให้ซ่อนไว้
                                        if ($days_difference > 30) {
                                            // ไม่แสดงรูปภาพ
                                        } else {
                                            // แสดงรูปภาพ
                                            echo '<img src="docs/news-new.gif" width="40" height="16">';
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
            <div class="d-flex justify-content-center" style="margin-top: -28px;">
                <a href="<?php echo site_url('Pages/announce'); ?>">
                    <img src="docs/k.btn-all.png">
                </a>
            </div>
        </div>
        <div id="tabtwo4" class="tab-content-two">
            <?php foreach ($qOrder as $gw) { ?>
                <div class="content-news-detail">
                    <a href="<?php echo site_url('Pages/order_detail/' . $gw->order_id); ?>">
                        <div class="row">
                            <div class="col-10">
                                <span class="text-news"><img src="docs/k.logo.png" width="30px" height="34px">&nbsp;&nbsp;
                                    <?= strip_tags($gw->order_name); ?>
                                </span>
                            </div>
                            <div class="col-2">
                                <div class="row">
                                    <div class="col-10">
                                        <div class="d-flex justify-content-end ">
                                            <span class="text-news-time">
                                                <?php
                                                // ในการใช้งาน setThaiMonth
                                                $date = new DateTime($gw->order_date);
                                                $day_th = $date->format('d');
                                                $month_th = setThaiMonthAbbreviation($date->format('F')); // เรียกใช้ setThaiMonth สำหรับชื่อเดือน
                                                $year_th = $date->format('Y') + 543; // เพิ่มขึ้น 543 ปี
                                                $formattedDate = "$day_th $month_th $year_th"; // วันที่และเดือนเป็นภาษาไทย
                                                echo $formattedDate;
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-2" style="margin-top: -28px; margin-left: -32px;">
                                        <?php
                                        // วันที่ของข่าว
                                        $order_date = new DateTime($gw->order_date);

                                        // วันที่ปัจจุบัน
                                        $current_date = new DateTime();

                                        // คำนวณหาความต่างของวัน
                                        $interval = $current_date->diff($order_date);
                                        $days_difference = $interval->days;

                                        // ถ้ามากกว่า 30 วัน ให้ซ่อนไว้
                                        if ($days_difference > 30) {
                                            // ไม่แสดงรูปภาพ
                                        } else {
                                            // แสดงรูปภาพ
                                            echo '<img src="docs/news-new.gif" width="40" height="16">';
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
            <div class="d-flex justify-content-center" style="margin-top: -28px;">
                <a href="<?php echo site_url('Pages/order'); ?>">
                    <img src="docs/k.btn-all.png">
                </a>
            </div>
        </div>
    </div>


    <div class="content-news-bg underline">
        <div class="tab-container2">
            <div class="tab-link" onclick="openTab('tab1')">
                <img src="docs/t.news-head5v2.png" alt="Tab 1">
            </div>
            <div class="tab-link" onclick="openTab('tab2')">
                <img src="docs/t.news-head6v2.png" alt="Tab 2">
            </div>
            <div class="tab-link" onclick="openTab('tab3')">
                <img src="docs/t.news-head7v2.png" alt="Tab 3">
            </div>
            <div class="tab-link" onclick="openTab('tab4')">
                <img src="docs/t.news-head8v2.png" alt="Tab 4">
            </div>
        </div>
        <br>
        <div id="tab1" class="tab-content">
            <?php foreach ($qProcurement as $pcm) { ?>
                <div class="content-news-detail">
                    <a href="<?php echo site_url('Pages/procurement_detail/' . $pcm->procurement_id); ?>">
                        <div class="row">
                            <div class="col-10">
                                <span class="text-news"><img src="docs/k.logo.png" width="30px" height="34px">&nbsp;&nbsp;
                                    <?= strip_tags($pcm->procurement_name); ?>
                                </span>
                            </div>
                            <div class="col-2">
                                <div class="row">
                                    <div class="col-10">
                                        <div class="d-flex justify-content-end ">
                                            <span class="text-news-time">
                                                <?php
                                                // ในการใช้งาน setThaiMonth
                                                $date = new DateTime($pcm->procurement_date);
                                                $day_th = $date->format('d');
                                                $month_th = setThaiMonthAbbreviation($date->format('F')); // เรียกใช้ setThaiMonth สำหรับชื่อเดือน
                                                $year_th = $date->format('Y') + 543; // เพิ่มขึ้น 543 ปี
                                                $formattedDate = "$day_th $month_th $year_th"; // วันที่และเดือนเป็นภาษาไทย
                                                echo $formattedDate;
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-2" style="margin-top: -28px; margin-left: -32px;">
                                        <?php
                                        // วันที่ของข่าว
                                        $procurement_date = new DateTime($pcm->procurement_date);

                                        // วันที่ปัจจุบัน
                                        $current_date = new DateTime();

                                        // คำนวณหาความต่างของวัน
                                        $interval = $current_date->diff($procurement_date);
                                        $days_difference = $interval->days;

                                        // ถ้ามากกว่า 30 วัน ให้ซ่อนไว้
                                        if ($days_difference > 30) {
                                            // ไม่แสดงรูปภาพ
                                        } else {
                                            // แสดงรูปภาพ
                                            echo '<img src="docs/news-new.gif" width="40" height="16">';
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
            <div class="d-flex justify-content-center" style="margin-top: -28px;">
                <a href="<?php echo site_url('Pages/procurement'); ?>">
                    <img src="docs/k.btn-all.png">
                </a>
            </div>
        </div>
        <div id="tab2" class="tab-content">
            <?php
            // เพิ่มตัวแปร $limited_data เพื่อจัดเก็บ array ที่จะใช้กับ array_slice
            $limited_data = [];

            foreach ($json_data as $key1 => $value1):
                if (is_array($value1)):
                    foreach ($value1 as $key2 => $value2):
                        if (is_array($value2)):
                            foreach ($value2 as $key3 => $value3):
                                if ($key3 === 'project_id'):
                                    $url = 'https://process3.gprocurement.go.th/egp2procmainWeb/jsp/procsearch.sch?servlet=gojsp&proc_id=ShowHTMLFile&processFlows=Procure&projectId=' . $value3 . '&templateType=W2&temp_Announ=A&temp_itemNo=0&seqNo=1';
                                endif;
                                if ($key3 === 'project_name'):
                                    // ใส่ข้อมูลลงใน $limited_data
                                    $limited_data[] = [
                                        'url' => $url,
                                        'project_name' => $value3,
                                    ];
                                endif;
                            endforeach;
                        endif;
                    endforeach;
                endif;
                // Add a new line after each subarray at the first level
            endforeach;

            // เรียงลำดับ $limited_data ตาม 'project_id' ล่าสุด
            usort($limited_data, function ($a, $b) {
                return $b['url'] <=> $a['url'];
            });

            // ในกรณีที่ต้องการแสดงเฉพาะ 4 แถวล่าสุด
            $limited_data = array_slice($limited_data, 0, 8);

            // ตรวจสอบว่ามีข้อมูลหรือไม่และแสดงผลลัพธ์
            if (!empty($limited_data)):
                foreach ($limited_data as $data):
                    ?>
                    <div class="content-news-detail">
                        <span class="text-news"><a href="<?= htmlspecialchars($data['url']) ?>" target="_blank">
                                <img src="<?php echo base_url("docs/e-gp.png"); ?>" style="width: 40; height: 40px;">
                                <?= htmlspecialchars($data['project_name']) ?>
                            </a></span>
                    </div>
                    <?php
                endforeach;
            else:
                ?>
                <span class="text-center align-center"
                    style="font-size: 36px;">ไม่สามารถดึงข้อมูลจากระบบจัดซือจัดจ้างภาครัฐได้
                    กรุณาโหลดหน้าเว็บใหม่อีกครั้ง</span>
                <?php
            endif;
            ?>

            <div class="d-flex justify-content-center" style="margin-top: -28px;">
                <a href="<?php echo site_url('Pages/e_gp'); ?>">
                    <img src="docs/k.btn-all.png">
                </a>
            </div>
        </div>
        <div id="tab3" class="tab-content">
            <?php foreach ($qP_reb as $anou) { ?>
                <div class="content-news-detail">
                    <a href="<?php echo site_url('Pages/p_reb_detail/' . $anou->p_reb_id); ?>">
                        <div class="row">
                            <div class="col-10">
                                <span class="text-news"><img src="docs/k.logo.png" width="30px" height="34px">&nbsp;&nbsp;
                                    <?= strip_tags($anou->p_reb_name); ?>
                                </span>
                            </div>
                            <div class="col-2">
                                <div class="row">
                                    <div class="col-10">
                                        <div class="d-flex justify-content-end ">
                                            <span class="text-news-time">
                                                <?php
                                                // ในการใช้งาน setThaiMonth
                                                $date = new DateTime($anou->p_reb_date);
                                                $day_th = $date->format('d');
                                                $month_th = setThaiMonthAbbreviation($date->format('F')); // เรียกใช้ setThaiMonth สำหรับชื่อเดือน
                                                $year_th = $date->format('Y') + 543; // เพิ่มขึ้น 543 ปี
                                                $formattedDate = "$day_th $month_th $year_th"; // วันที่และเดือนเป็นภาษาไทย
                                                echo $formattedDate;
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-2" style="margin-top: -28px; margin-left: -32px;">
                                        <?php
                                        // วันที่ของข่าว
                                        $p_reb_date = new DateTime($anou->p_reb_date);

                                        // วันที่ปัจจุบัน
                                        $current_date = new DateTime();

                                        // คำนวณหาความต่างของวัน
                                        $interval = $current_date->diff($p_reb_date);
                                        $days_difference = $interval->days;

                                        // ถ้ามากกว่า 30 วัน ให้ซ่อนไว้
                                        if ($days_difference > 30) {
                                            // ไม่แสดงรูปภาพ
                                        } else {
                                            // แสดงรูปภาพ
                                            echo '<img src="docs/news-new.gif" width="40" height="16">';
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
            <div class="d-flex justify-content-center" style="margin-top: -28px;">
                <a href="<?php echo site_url('Pages/p_reb'); ?>">
                    <img src="docs/k.btn-all.png">
                </a>
            </div>
        </div>
        <div id="tab4" class="tab-content">
            <?php foreach ($qP_rpo as $anou) { ?>
                <div class="content-news-detail">
                    <a href="<?php echo site_url('Pages/p_rpo_detail/' . $anou->p_rpo_id); ?>">
                        <div class="row">
                            <div class="col-10">
                                <span class="text-news"><img src="docs/k.logo.png" width="30px" height="34px">&nbsp;&nbsp;
                                    <?= strip_tags($anou->p_rpo_name); ?>
                                </span>
                            </div>
                            <div class="col-2">
                                <div class="row">
                                    <div class="col-10">
                                        <div class="d-flex justify-content-end ">
                                            <span class="text-news-time">
                                                <?php
                                                // ในการใช้งาน setThaiMonth
                                                $date = new DateTime($anou->p_rpo_date);
                                                $day_th = $date->format('d');
                                                $month_th = setThaiMonthAbbreviation($date->format('F')); // เรียกใช้ setThaiMonth สำหรับชื่อเดือน
                                                $year_th = $date->format('Y') + 543; // เพิ่มขึ้น 543 ปี
                                                $formattedDate = "$day_th $month_th $year_th"; // วันที่และเดือนเป็นภาษาไทย
                                                echo $formattedDate;
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-2" style="margin-top: -28px; margin-left: -32px;">
                                        <?php
                                        // วันที่ของข่าว
                                        $p_rpo_date = new DateTime($anou->p_rpo_date);

                                        // วันที่ปัจจุบัน
                                        $current_date = new DateTime();

                                        // คำนวณหาความต่างของวัน
                                        $interval = $current_date->diff($p_rpo_date);
                                        $days_difference = $interval->days;

                                        // ถ้ามากกว่า 30 วัน ให้ซ่อนไว้
                                        if ($days_difference > 30) {
                                            // ไม่แสดงรูปภาพ
                                        } else {
                                            // แสดงรูปภาพ
                                            echo '<img src="docs/news-new.gif" width="40" height="16">';
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
            <div class="d-flex justify-content-center" style="margin-top: -28px;">
                <a href="<?php echo site_url('Pages/p_rpo'); ?>">
                    <img src="docs/k.btn-all.png">
                </a>
            </div>
        </div>
    </div>
</div>

<div class="bg-travel">
    <div class="d-flex justify-content-center" style="padding-top: 5%;">
        <img src="docs/t.head-travel.png">
    </div>
    <div class="travel-content">
        <div class="slick-carousel ">
            <?php foreach ($qTravel as $travel) { ?>
                <div class="text-center zoom-travel mt-5">
                    <a href="<?php echo site_url('Pages/travel_detail/' . $travel->travel_id); ?>">
                        <img src="<?php echo base_url('docs/img/' . $travel->travel_img); ?>" width="209px" height="197px"
                            class="image-with-shadow-travel">
                    </a>
                    <br>
                    <div class="d-flex justify-content-center" style="margin-left: 0px; width:209px;">
                        <a class="underline" href="<?php echo site_url('Pages/travel_detail/' . $travel->travel_id); ?>">
                            <span class="text-content-travel">
                                <?= $travel->travel_name; ?>
                            </span>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="d-flex justify-content-center">
            <a href="<?php echo site_url('pages/travel'); ?>">
                <img src="docs/k.btn-all.png">
            </a>
        </div>
    </div>
</div>

<div class="bg-otop">
    <div class="d-flex justify-content-center" style="padding-top: 7%;">
        <img src="docs/t.head-otop.png">
    </div>
    <div class="otop-content">
        <div class="slick-carousel-otop">
            <?php foreach ($qOtop as $otop) { ?>
                <div class="text-center zoom-travel mt-5">
                    <a href="<?php echo site_url('Pages/otop_detail/' . $otop->otop_id); ?>">
                        <img src="<?php echo base_url('docs/img/' . $otop->otop_img); ?>" width="209px" height="197px"
                            class="image-with-shadow-travel">
                    </a>
                    <br>
                    <div class="d-flex justify-content-center" style="margin-left: 0px; width:209px;">
                        <a class="underline" href="<?php echo site_url('Pages/otop_detail/' . $otop->otop_id); ?>">
                            <span class="text-content-otop">
                                <?= $otop->otop_name; ?>
                            </span>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="d-flex justify-content-center">
            <a href="<?php echo site_url('pages/otop'); ?>">
                <img src="docs/k.btn-all.png">
            </a>
        </div>
    </div>
</div>

<div class="bg-page-bottom">
    <div class="d-flex justify-content-center" id="oss">
        <img src="docs/t.head-e-service2.png">
    </div>
    <br>
    <!-- <div class="d-flex justify-content-center">
        <span class="font-e-service-32">บริการยื่นคำร้องออนไลน์ 24 ชั่วโมง</span>
    </div> -->
    <div class="row d-flex justify-content-center underline"
        style="padding-top: 40px; padding-left: 50px; padding-right: 50px;">
        <div class="col-2 text-center">
            <a href="<?php echo site_url('Pages/adding_complain'); ?>" class="zoom-otop">
                <img src="docs/t.menu-e-service1.png">
                <br>
                <span class="font-e-service-25">แจ้งเรื่อง ร้องเรียน</span>
            </a>
        </div>
        <div class="col-2 text-center">
            <a href="<?php echo site_url('Pages/adding_corruption'); ?>" class="zoom-otop">
                <img src="docs/t.menu-e-service2.png">
                <br>
                <span class="font-e-service-25">แจ้งเรื่องทุจริต</span>
            </a>
        </div>
        <div class="col-2 text-center">
            <a href="<?php echo site_url('Pages/adding_suggestions'); ?>" class="zoom-otop">
                <img src="docs/t.menu-e-service3.png">
                <br>
                <span class="font-e-service-25">รับฟังความคิดเห็น</span>
            </a>
        </div>
        <div class="col-2 text-center">
            <a href="<?php echo site_url('Pages/q_a'); ?>" class="zoom-otop">
                <img src="docs/t.menu-e-service4.png">
                <br>
                <span class="font-e-service-25">กระทู้ ถาม-ตอบ</span>
            </a>
        </div>
        <div class="col-2 text-center">
            <a href="<?php echo site_url('Pages/adding_esv_ods'); ?>" class="zoom-otop">
                <img src="docs/t.menu-e-service5.png">
                <br>
                <span class="font-e-service-25">ยื่นเอกสารออรไลน์</span>
            </a>
        </div>
        <div class="col-2 text-center d-flex ">
            <a href="<?php echo site_url('Pages/pbsv_e_book'); ?>" class="zoom-otop">
                <img src="docs/t.menu-e-service6.png">
                <br>
                <span class="font-e-service-25">แบบฟอร์ม e-Book</span>
            </a>
        </div>
    </div>

    <div class="row" style="padding: 70px 60px">
        <div class="col-7">
            <div class="bg-qa-list">
                <?php foreach ($qQ_a as $rs) { ?>
                    <div class="bg-content-qa-list mt-3">
                        <div class="row">
                            <div class="col-9 one-line-ellipsis" style="padding-top: 7px;">
                                <a href="<?php echo site_url('Pages/q_a_chat/' . $rs->q_a_id); ?>">
                                    <span class="font-qa-list-content ">
                                        <?= $rs->q_a_msg; ?>
                                    </span>
                                </a>
                            </div>
                            <div class="col-3 one-line-ellipsis" style="padding-top: 8px;">
                                <span class="font-qa-list-content-name">ผู้ตั้งกระทู้ :
                                    <?= $rs->q_a_by; ?>y
                                </span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="d-flex justify-content-end mt-3">
                    <div class="mx-2">
                        <a href="<?php echo site_url('pages/q_a'); ?>">
                            <img src="docs/k.btn-all-qa.png">
                        </a>
                    </div>
                    <a href="<?php echo site_url('pages/addding_q_a'); ?>">
                        <img src="docs/k.btn-add-qa.png">
                    </a>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-6">
                    <div class="bg-view">
                        <div class="head-view text-center ">
                            <span class="font-view">จำนวนผู้เข้าชมเว็บไซต์</span>
                        </div>
                        <div class="content-view">
                            <div class="mypiechart text-center mt-4">
                                <canvas id="myCanvas" width="150px" height="200px"></canvas>
                            </div>
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-4 d-flex justify-content-end">
                                        <div class="card-view" id="card1"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="18" height="18" fill="currentColor" class="bi bi-person-fill"
                                                viewBox="0 0 16 16" style="color: #046867;">
                                                <path
                                                    d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                            </svg></i>&nbsp;<span>ออนไลน์</span>
                                        </div>
                                    </div>
                                    <div class="col-4"></div>
                                    <div class="col-4  d-flex justify-content-start">
                                        <span class="card-view">
                                            <?php echo $onlineUsersCount; ?>&nbsp;&nbsp;&nbsp;&nbsp;คน
                                        </span>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4 d-flex justify-content-end">
                                        <div class="card-view" style="margin-right: 28px;" id="card1"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16"
                                                style="color: #AEE1F7;">
                                                <path
                                                    d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                            </svg></i>&nbsp;<span>วันนี้</span>
                                        </div>
                                    </div>
                                    <div class="col-4"></div>
                                    <div class="col-4  d-flex justify-content-start">
                                        <span class="card-view">
                                            <?php echo $onlineUsersDay; ?>&nbsp;&nbsp;&nbsp;&nbsp;คน
                                        </span>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4 d-flex justify-content-end">
                                        <div class="card-view" style="margin-right: 12px;" id="card1"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16"
                                                style="color: #FFDF63;">
                                                <path
                                                    d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                            </svg></i>&nbsp;<span>เดือนนี้</span>
                                        </div>
                                    </div>
                                    <div class="col-4"></div>
                                    <div class="col-4  d-flex justify-content-start">
                                        <span class="card-view">
                                            <?php echo $onlineUsersMonth; ?>&nbsp;&nbsp;&nbsp;&nbsp;คน
                                        </span>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4 d-flex justify-content-end">
                                        <div class="card-view" style="margin-right: 8px;" id="card1"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16"
                                                style="color: #727272;">
                                                <path
                                                    d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                            </svg></i>&nbsp;<span>ทั้งหมด</span>
                                        </div>
                                    </div>
                                    <div class="col-4"></div>
                                    <div class="col-4  d-flex justify-content-start">
                                        <span class="card-view">
                                            <?php echo $onlineUsersAll; ?>&nbsp;&nbsp;&nbsp;&nbsp;คน
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="bg-like ">
                        <div class="head-like text-center ">
                            <span class="font-like">แบบสอบถามความพึงพอใจ</span>
                        </div>
                        <div class="content-like">
                            <div class="row">
                                <div class="col-6" style="margin-top: -25px;">
                                    <form action="<?php echo site_url('home/addLike'); ?>" id="FormaddLike"
                                        method="post">
                                        <div class="form-check">
                                            <input class="form-check-input border-like" type="radio" value="ดีมาก"
                                                id="flexCheckDefault1" name="like_name"
                                                onclick="toggleCheckbox('flexCheckDefault1')" />
                                            <label class="form-check-label font-like-label" for="ดีมาก">ดีมาก</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input border-like" type="radio" value="ดี"
                                                id="flexCheckDefault2" name="like_name"
                                                onclick="toggleCheckbox('flexCheckDefault2')" />
                                            <label class="form-check-label font-like-label" for="ดี">ดี</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input border-like" type="radio" value="พอใช้"
                                                id="flexCheckDefault3" name="like_name"
                                                onclick="toggleCheckbox('flexCheckDefault3')" />
                                            <label class="form-check-label font-like-label" for="พอใช้">ปานกลาง</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input border-like" type="radio" value="พอใช้"
                                                id="flexCheckDefault4" name="like_name"
                                                onclick="toggleCheckbox('flexCheckDefault4')" />
                                            <label class="form-check-label font-like-label" for="พอใช้">พอใช้</label>
                                        </div>
                                        <div id="submitSection">
                                            <div class="g-recaptcha" style="margin-left: -15px;"
                                                data-sitekey="6LcKoPcnAAAAAKGgUMRtkBs6chDKzC8XOoVnaZg_"
                                                data-callback="enableSubmit"></div>
                                            <div class="form-group row mt-2">
                                                <div class="col-9" style="z-index:100;">
                                                    <button type="submit" class="btn" id="SubmitLike" disabled><img
                                                            src="docs/k.btn-sent-esv.png"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-6" style="margin-left: -10%; margin-top: -25px;">
                                    <div class="content-like-detail" style="display: none;">
                                        <div style="display: flex; align-items: center;">
                                            <div class="progress-sm mr-6" style="flex: 1; height: 20px;">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: <?= $countExcellent; ?>%;"
                                                    aria-valuenow="<?= $countExcellent; ?>" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                            <span style="font-size: 20px;">&nbsp;
                                                <?= $countExcellent; ?>
                                            </span>
                                        </div>
                                        <div class="mt-3" style="display: flex; align-items: center;">
                                            <div class="progress-sm mr-6" style="flex: 1; height: 20px;">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: <?= $countGood; ?>%;"
                                                    aria-valuenow="<?= $countGood; ?>" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                            <span style="font-size: 20px;">&nbsp;
                                                <?= $countGood; ?>
                                            </span>
                                        </div>
                                        <div class="mt-3" style="display: flex; align-items: center;">
                                            <div class="progress-sm mr-6" style="flex: 1; height: 20px;">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: <?= $countAverage; ?>%;"
                                                    aria-valuenow="<?= $countAverage; ?>" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                            <span style="font-size: 20px;">&nbsp;
                                                <?= $countAverage; ?>
                                            </span>
                                        </div>
                                        <div class="mt-3" style="display: flex; align-items: center;">
                                            <div class="progress-sm mr-6" style="flex: 1; height: 20px;">
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: <?= $countOkay; ?>%;"
                                                    aria-valuenow="<?= $countOkay; ?>" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                            <span style="font-size: 20px;">&nbsp;
                                                <?= $countOkay; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div style="margin-top: -45px; margin-left: 170px;">
                                    <a class="btn" onclick="showContentLikeDetail()"><img
                                            src="docs/k.btn-score.png"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="mt-5" style="z-index: 6;">
                <a href="https://www.nacc.go.th/NACCPPWFC?" target="_blank" rel="noopener noreferrer">
                    <img src="docs/t.raise_the_level_of_will.jpg" width="702px" height="100px">
                </a>
            </div> -->
        </div>

        <div class="col-5 ">
            <!-- <div class="d-flex justify-content-end">
                <div class="fb-page" data-href="https://www.facebook.com/p/%E0%B9%80%E0%B8%9E%E0%B8%88%E0%B9%80%E0%B8%97%E0%B8%A8%E0%B8%9A%E0%B8%B2%E0%B8%A5%E0%B8%95%E0%B8%B3%E0%B8%9A%E0%B8%A5%E0%B8%81%E0%B8%B2%E0%B8%9A%E0%B9%80%E0%B8%8A%E0%B8%B4%E0%B8%87-%E0%B8%88%E0%B8%B1%E0%B8%87%E0%B8%AB%E0%B8%A7%E0%B8%B1%E0%B8%94%E0%B8%AA%E0%B8%B8%E0%B8%A3%E0%B8%B4%E0%B8%99%E0%B8%97%E0%B8%A3%E0%B9%8C-100068962338320/?paipv=0&amp;eav=AfYCD9ii8z2jYOf-yDTAcU0tSdfuES5OG8jVboIwWvJMOFe4IwBXCqB-v9ir_A8V9-Q&amp;_rdr" data-tabs="timeline" data-width="386" data-height="523" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                    <blockquote cite="https://www.facebook.com/p/%E0%B9%80%E0%B8%9E%E0%B8%88%E0%B9%80%E0%B8%97%E0%B8%A8%E0%B8%9A%E0%B8%B2%E0%B8%A5%E0%B8%95%E0%B8%B3%E0%B8%9A%E0%B8%A5%E0%B8%81%E0%B8%B2%E0%B8%9A%E0%B9%80%E0%B8%8A%E0%B8%B4%E0%B8%87-%E0%B8%88%E0%B8%B1%E0%B8%87%E0%B8%AB%E0%B8%A7%E0%B8%B1%E0%B8%94%E0%B8%AA%E0%B8%B8%E0%B8%A3%E0%B8%B4%E0%B8%99%E0%B8%97%E0%B8%A3%E0%B9%8C-100068962338320/?paipv=0&amp;eav=AfYCD9ii8z2jYOf-yDTAcU0tSdfuES5OG8jVboIwWvJMOFe4IwBXCqB-v9ir_A8V9-Q&amp;_rdr" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/p/%E0%B9%80%E0%B8%9E%E0%B8%88%E0%B9%80%E0%B8%97%E0%B8%A8%E0%B8%9A%E0%B8%B2%E0%B8%A5%E0%B8%95%E0%B8%B3%E0%B8%9A%E0%B8%A5%E0%B8%81%E0%B8%B2%E0%B8%9A%E0%B9%80%E0%B8%8A%E0%B8%B4%E0%B8%87-%E0%B8%88%E0%B8%B1%E0%B8%87%E0%B8%AB%E0%B8%A7%E0%B8%B1%E0%B8%94%E0%B8%AA%E0%B8%B8%E0%B8%A3%E0%B8%B4%E0%B8%99%E0%B8%97%E0%B8%A3%E0%B9%8C-100068962338320/?paipv=0&amp;eav=AfYCD9ii8z2jYOf-yDTAcU0tSdfuES5OG8jVboIwWvJMOFe4IwBXCqB-v9ir_A8V9-Q&amp;_rdr">เพจเทศบาลตำบลกาบเชิง จังหวัดสุรินทร์</a></blockquote>
                </div>
            </div> -->
            <div class="d-flex justify-content-end">
<<<<<<< HEAD
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" style="z-index: 10;  margin-top: -15px;">
                    <div class="carousel-indicators">
                        <?php
                        foreach ($qPublicize_ita as $index => $img_banner) {
                            $active = ($index === 0) ? "active" : "";
                            echo '<button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="' . $index . '" class="' . $active . '" aria-current="true" aria-label="Slide ' . ($index + 1) . '"></button>';
                        }
                        ?>
                    </div>
                    <div class="carousel-inner">
                        <?php foreach ($qPublicize_ita as $index => $img_publicize_ita) { ?>
                            <div class="carousel-item <?= ($index === 0) ? "active" : ""; ?>" data-bs-interval="3000">
                                <a href="<?= $img_publicize_ita->publicize_ita_link; ?>" target="_blank">
                                    <img src="docs\img\<?= $img_publicize_ita->publicize_ita_img; ?>" class="d-block "style="height: 550px; width: 370px;">
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <!-- <?php foreach ($qPublicize_ita as $index => $rs) { ?>
                    <a href="<?= $rs->publicize_ita_name; ?>" target="_blank" rel="noopener noreferrer">
                        <img src="<?php echo base_url('docs/img/' . $rs->publicize_ita_img); ?>" width="320px" height="520px">
=======
                <?php foreach ($qPublicize_ita as $index => $rs) { ?>
                    <a href="<?= $rs->publicize_ita_link; ?>" target="_blank" rel="noopener noreferrer">
                        <img src="<?php echo base_url('docs/img/' . $rs->publicize_ita_img); ?>" width="386px"
                            height="546px">
>>>>>>> 0f11bc519b4e1f849d3b46851f93270f58fe290c
                    </a>
                <?php } ?> -->
            </div>
            <div class="d-flex justify-content-end mt-4">
                <a href="https://www.nacc.go.th/NACCPPWFC?" target="_blank" rel="noopener noreferrer">
                    <img src="docs/t.raise_the_level_of_will2.jpg" width="371px" height="128px">
                </a>
            </div>
            <div class="d-flex justify-content-end mt-4">
                <iframe class="map-contact-home" width="366" height="253" frameborder="0"
                    src="https://www.google.com/maps?q=สำนักงานเทศบาลตำบลธงธานี&output=embed" allowfullscreen></iframe>
            </div>
        </div>
    </div>
    <div class="bg-links" style="margin-top: 50px;">
        <div class="text-center">
            <img src="docs/t.head-links.png">
        </div>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><a href="https://www.roiet.go.th/101province/" target="_blank"><img
                            src="docs/s.link-link1.png"></a></div>
                <div class="swiper-slide"><a href="https://www.pao-roiet.go.th/" target="_blank"><img
                            src="docs/t.link-link2.png"></a></div>
                <div class="swiper-slide"><a href="http://www.sasuk101.moph.go.th/" target="_blank"><img
                            src="docs/t.link-link3.png"></a></div>
                <div class="swiper-slide"><a
                        href="https://www.cgd.go.th/cs/internet/internet/%E0%B8%AB%E0%B8%99%E0%B9%89%E0%B8%B2%E0%B8%AB%E0%B8%A5%E0%B8%B1%E0%B8%812.html?page_locale=th_TH"
                        target="_blank"><img src="docs/s.link-link4.png"></a></div>
                <div class="swiper-slide"><a href="https://moi.go.th/moi/" target="_blank"><img
                            src="docs/s.link-link5.png"></a></div>
                <div class="swiper-slide"><a href="https://www.doe.go.th/" target="_blank"><img
                            src="docs/s.link-link6.png"></a></div>
                <div class="swiper-slide"><a href="https://www.nhso.go.th/" target="_blank"><img
                            src="docs/s.link-link7.png"></a></div>
                <div class="swiper-slide"><a href="https://www.roiet.go.th/dumrong/" target="_blank"><img
                            src="docs/s.link-link8.png"></a></div>
                <div class="swiper-slide"><a href="https://www.admincourt.go.th/admincourt/site/09illustration.html"
                        target="_blank"><img src="docs/s.link-link9.png"></a></div>
                <div class="swiper-slide"><a href="https://www.dla.go.th/index.jsp" target="_blank"><img
                            src="docs/s.link-link10.png"></a></div>
                <div class="swiper-slide"><a href="https://info.go.th/" target="_blank"><img
                            src="docs/s.link-link11.png"></a></div>
                <div class="swiper-slide"><a
                        href="https://moi.go.th/moi/about-us/%E0%B8%82%E0%B9%89%E0%B8%AD%E0%B8%A1%E0%B8%B9%E0%B8%A5%E0%B8%97%E0%B8%B1%E0%B9%88%E0%B8%A7%E0%B9%84%E0%B8%9B%E0%B9%80%E0%B8%81%E0%B8%B5%E0%B9%88%E0%B8%A2%E0%B8%A7%E0%B8%81%E0%B8%B1%E0%B8%9A%E0%B8%81/%E0%B8%A1%E0%B8%AB%E0%B8%B2%E0%B8%94%E0%B9%84%E0%B8%97%E0%B8%A2%E0%B8%8A%E0%B8%A7%E0%B8%99%E0%B8%A3%E0%B8%B9%E0%B9%89/"
                        target="_blank"><img src="docs/s.link-link12.png"></a></div>
                <div class="swiper-slide"><a
                        href="https://odloc.go.th/%E0%B8%9B%E0%B8%A3%E0%B8%B0%E0%B8%81%E0%B8%B2%E0%B8%A8%E0%B9%81%E0%B8%A5%E0%B8%B0%E0%B8%84%E0%B8%B3%E0%B8%AA%E0%B8%B1%E0%B9%88%E0%B8%87/%E0%B8%A3%E0%B8%A7%E0%B8%A1%E0%B8%81%E0%B8%8F%E0%B8%AB%E0%B8%A1%E0%B8%B2%E0%B8%A2%E0%B8%97%E0%B8%B5%E0%B9%88%E0%B9%80%E0%B8%81%E0%B8%B5%E0%B9%88%E0%B8%A2%E0%B8%A7%E0%B8%82%E0%B9%89%E0%B8%AD%E0%B8%87/%E0%B8%81%E0%B8%8E%E0%B8%AB%E0%B8%A1%E0%B8%B2%E0%B8%A2%E0%B9%80%E0%B8%81%E0%B8%B5%E0%B9%88%E0%B8%A2%E0%B8%A7%E0%B8%81%E0%B8%B1%E0%B8%9A%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B8%9B%E0%B8%81%E0%B8%84%E0%B8%A3/"
                        target="_blank"><img src="docs/s.link-link13.png"></a></div>
                <div class="swiper-slide"><a href="https://www.oic.go.th/web2017/km/index.html" target="_blank"><img
                            src="docs/s.link-link15.png"></a></div>
            </div>
            <!-- <div class="swiper-pagination"></div> -->
            <!-- <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div> -->
            <div class="custom-button-prev">
                <img src="docs/s.previous-travel.png" alt="Prev">
            </div>
            <div class="custom-button-next">
                <img src="docs/s.next-travel.png" alt="Next">
            </div>
        </div>
    </div>
</div>