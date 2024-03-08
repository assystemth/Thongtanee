<style>
    #navbar2 {
        position: fixed;
        z-index: 20;
        /* ให้มีความสูงกว่า content ทั่วไป */
        margin-left: 285px;
    }

    @media screen and (max-width: 1280px) {
        #navbar2 {
            display: none;
        }
    }
</style>
<div style="position: relative; margin-top: -25px; width: 1280px; margin-bottom:80px;">
    <img src="<?php echo base_url("docs/s.bg-navbar-other.png"); ?>" alt="" width="auto" style="max-width: 100%; position: absolute;">
    <nav class="navbar navbar2 navbar-expand-lg navbar-dark navbar-center sticky-top" id="navbar2">
        <div class="container">
            <!-- <div class="collapse navbar-collapse d-flex justify-content-center"> -->
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link mx-3 nav-text-color-2" aria-current="page" href="<?php echo site_url('Home'); ?>">
                            <img src="<?php echo base_url("docs/k.btn-stick1.png"); ?>" style="position: absolute; top: 51%; left: 102px;">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-3 nav-text-color-2" href="<?php echo site_url('Pages/all_web'); ?>">
                            <img src="<?php echo base_url("docs/k.btn-stick2.png"); ?>" style="position: absolute; top: 51%; left: 310px;">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-3 nav-text-color-2" href="<?php echo site_url('Home/login'); ?>">
                            <img src="<?php echo base_url("docs/k.btn-stick3.png"); ?>" style="position: absolute; top: 51%; left: 540px;"></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var navbar = document.getElementById("navbar2");

        document.body.addEventListener("mouseenter", function() {
            navbar.style.display = "block";
        });

        document.body.addEventListener("mouseleave", function() {
            navbar.style.display = "none";
        });
    });
</script>

<!-- <a href="<?php echo site_url('Home'); ?>">
        <img src="<?php echo base_url("docs/s.item-nav-top1.2.png"); ?>" alt="" style="position: absolute; top: 8%; left: 57%;" width="161" height="58">
    </a>
    <a href="<?php echo site_url('Pages/all_web'); ?>">
        <img src="<?php echo base_url("docs/s.item-nav-top2.2.png"); ?>" alt="" style="position: absolute; top: 8%; left: 71%;" width="162" height="58">
    </a>
    <a href="<?php echo site_url('Pages/contact'); ?>">
        <img src="<?php echo base_url("docs/s.item-nav-top3.2.png"); ?>" alt="" style="position: absolute; top: 8%; left: 85%;" width="162" height="58">
    </a> -->

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

function setThaiMonthAbbreviation($dateString)
{
    $thaiMonths = [
        'January' => 'ม.ค.',
        'February' => 'ก.พ.',
        'March' => 'มี.ค.',
        'April' => 'เม.ย.',
        'May' => 'พ.ค.',
        'June' => 'มิ.ย.',
        'July' => 'ก.ค.',
        'August' => 'ส.ค.',
        'September' => 'ก.ย.',
        'October' => 'ต.ค.',
        'November' => 'พ.ย.',
        'December' => 'ธ.ค.',
    ];

    foreach ($thaiMonths as $english => $thai) {
        $dateString = str_replace($english, $thai, $dateString);
    }

    return $dateString;
}
?>