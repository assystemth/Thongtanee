<style>
    #navbar2 {
        background-image: url('<?php echo base_url("docs/k.navbar-stick.png"); ?>');
        background-repeat: no-repeat;
        background-size: 100%;
        height: 123px;
        width: 714px;
        margin-left: 50%;
        transform: translateX(-50%);
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        transition: top 0.3s ease-in-out;
    }

    #navbar2:hover {
        top: 0;
    }

    body:not(:hover) #navbar2 {
        top: -164px;
    }

    @media screen and (max-width: 1200px) {
        #navbar2 {
            display: none;
        }
    }
</style>
<!-- <nav class="navbar navbar2 navbar-expand-lg navbar-dark navbar-center sticky-top" id="navbar2">
    <div class="container">
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
</nav> -->

<script>
    window.onscroll = function() {
        scrollFunction();
    };

    function scrollFunction() {
        if (window.innerWidth > 1200) { // ตรวจสอบว่าขนาดหน้าจอไม่ใช่ขนาดมือถือและเล็กว่า 1200px
            if (document.body.scrollTop > 10 || document.documentElement.scrollTop > 10) {
                document.getElementById("navbar2").style.display = "block";
            } else {
                document.getElementById("navbar2").style.display = "none";
            }
        }
    }
</script>


<div style="position: relative; width: 1280px; ">
    <img src="<?php echo base_url("docs/k.navbar-top.png"); ?>">
    <a href="<?php echo site_url('Home'); ?>" onmouseover="changeImage(`<?php echo base_url('docs/k.item-nav-top1v3-hover.png'); ?>`)" onmouseout="restoreImage(`<?php echo base_url('docs/k.item-nav-top1v3.png'); ?>`)">
        <img src="<?php echo base_url("docs/k.item-nav-top1v3.png"); ?>" alt="" style="position: absolute; top: 20%; left: 70%;">
    </a>
    <a href="<?php echo site_url('Pages/all_web'); ?>" onmouseover="changeImage(`<?php echo base_url('docs/k.item-nav-top2v3-hover.png'); ?>`)" onmouseout="restoreImage(`<?php echo base_url('docs/k.item-nav-top2v3.png'); ?>`)">
        <img src="<?php echo base_url("docs/k.item-nav-top2v3.png"); ?>" alt="" style="position: absolute; top: 20%; left: 79%;">
    </a>
    <a href="<?php echo site_url('Home/login'); ?>" onmouseover="changeImage(`<?php echo base_url('docs/k.item-nav-top3v3-hover.png'); ?>`)" onmouseout="restoreImage(`<?php echo base_url('docs/k.item-nav-top3v3.png'); ?>`)">
        <img src="<?php echo base_url("docs/k.item-nav-top3v3.png"); ?>" alt="" style="position: absolute; top: 20%; left: 89%;">
    </a>
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

<?php
// ฟังก์ชันสำหรับดึงรหัสวิดีโอจาก URL
function get_youtube_video_id($url)
{
    $parsed_url = parse_url($url);
    if (isset($parsed_url['query'])) {
        parse_str($parsed_url['query'], $query_params);
        if (isset($query_params['v'])) {
            return $query_params['v'];
        }
    }
    return null;
}
?>