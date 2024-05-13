    <!-- ส่วนทางซ้าย -->
    <div class="flex-item-left">
        <div class="bg-navbar">
            <!-- <div class="mb-4 text-center" style="padding-top: 20px;">
                <span class="font-head"><b>งานบริการภายใน</b></span>
            </div>
            <div class="border-navbar"></div> -->


            <div class="navbar-right">
                <a class="navbar-link" data-image-src="<?php echo base_url("docs/intranet/nav-intranet-btn-hover1.png"); ?>" href="<?php echo site_url('System_intranet'); ?>">
                    <img src="<?php echo base_url("docs/intranet/nav-intranet-btn1.png"); ?>" width="100%" height="100%" style="padding-top: 13%;">
                </a>
                <br>
                <a class="navbar-link" data-image-src="<?php echo base_url("docs/intranet/nav-intranet-btn-hover2.png"); ?>" href="<?php echo site_url('Intra_form'); ?>">
                    <img src="<?php echo base_url("docs/intranet/nav-intranet-btn2.png"); ?>" width="100%" height="100%" style="padding-top: 5%;">
                </a>
                <br>
                <a class="navbar-link" data-image-src="<?php echo base_url("docs/intranet/nav-intranet-btn-hover3.png"); ?>" href="<?php echo site_url('Intra_announce'); ?>">
                    <img src="<?php echo base_url("docs/intranet/nav-intranet-btn3.png"); ?>" width="100%" height="100%" style="padding-top: 5%;">
                </a>
                <br>
                <a class="navbar-link" data-image-src="<?php echo base_url("docs/intranet/nav-intranet-btn-hover4.png"); ?>" href="<?php echo site_url('Intra_discipline'); ?>">
                    <img src="<?php echo base_url("docs/intranet/nav-intranet-btn4.png"); ?>" width="100%" height="100%" style="padding-top: 5%;">
                </a>
                <br>
                <a class="navbar-link" data-image-src="<?php echo base_url("docs/intranet/nav-intranet-btn-hover5.png"); ?>" href="<?php echo site_url('Intra_share_file'); ?>">
                    <img src="<?php echo base_url("docs/intranet/nav-intranet-btn5.png"); ?>" width="100%" height="100%" style="padding-top: 5%;">
                </a>
                <br>
                <a class="navbar-link" data-image-src="<?php echo base_url("docs/intranet/nav-intranet-btn-hover6.png"); ?>" href="<?php echo site_url('Intra_gallery'); ?>">
                    <img src="<?php echo base_url("docs/intranet/nav-intranet-btn6.png"); ?>" width="100%" height="100%" style="padding-top: 5%;">
                </a>
                <br>
                <a class="navbar-link" data-image-src="<?php echo base_url("docs/intranet/nav-intranet-btn-hover7.png"); ?>" href="<?php echo site_url('Intra_e_book'); ?>">
                    <img src="<?php echo base_url("docs/intranet/nav-intranet-btn7.png"); ?>" width="100%" height="100%" style="padding-top: 5%;">
                </a>
                <br>
                <a class="navbar-link" data-image-src="<?php echo base_url("docs/intranet/nav-intranet-btn-hover8.1.png"); ?>" href="<?php echo site_url('Intra_egp'); ?>">
                    <img src="<?php echo base_url("docs/intranet/nav-intranet-btn8.1.png"); ?>" width="100%" height="100%" style="padding-top: 5%;">
                </a>
                <br>
                <a class="navbar-link" data-image-src="<?php echo base_url("docs/intranet/nav-intranet-btn-hover8.2.png"); ?>" href="<?php echo site_url('Intra_report'); ?>">
                    <img src="<?php echo base_url("docs/intranet/nav-intranet-btn8.2.png"); ?>" width="100%" height="100%" style="padding-top: 5%;">
                </a>
                <br>
                <a class="navbar-link" data-image-src="<?php echo base_url("docs/intranet/nav-intranet-btn-hover9.png"); ?>" href="<?php echo site_url('Intra_it'); ?>">
                    <img src="<?php echo base_url("docs/intranet/nav-intranet-btn9.png"); ?>" width="100%" height="100%" style="padding-top: 5%;">
                </a>
            </div>
        </div>

    </div>

    <?php
    // ฟังก์ชัน setThaiMonth อยู่นอก foreach loop
    function setThaiMonth($dateString)
    {
        $thaiMonths = [
            'January' => 'มกราคม',
            'February' => 'กุมภาพันธ์',
            'March' => 'มีนาคม',
            'April' => 'เมษายน',
            'May' => 'พฤษภาคม',
            'June' => 'มิถุนายน',
            'July' => 'กรกฎาคม',
            'August' => 'สิงหาคม',
            'September' => 'กันยายน',
            'October' => 'ตุลาคม',
            'November' => 'พฤศจิกายน',
            'December' => 'ธันวาคม',
        ];

        foreach ($thaiMonths as $english => $thai) {
            $dateString = str_replace($english, $thai, $dateString);
        }

        return $dateString;
    }
    ?>