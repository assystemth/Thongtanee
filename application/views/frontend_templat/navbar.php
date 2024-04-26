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

    .search {
        width: 250px;
        position: absolute;
        top: -15%;
        left: 77%;
    }

    .gsc-search-button-v2 {
        /* background-color: #007bff; */
        /* ปรับสีพื้นหลังของปุ่มค้นหาเป็นสีฟ้า */
        color: #ffffff;
        /* ปรับสีของข้อความในปุ่มเป็นสีขาว */
        padding: 5px 10px;
        /* ปรับการเรียงขนาดของปุ่ม */
        border-radius: 5px;
        /* ปรับรูปร่างของปุ่มเป็นรูปแบบวงกลม */
        border: none;
        /* ลบเส้นขอบของปุ่ม */
    }

    .gsc-search-button-v2 svg {
        fill: #523003;
        /* ปรับสีของไอคอนเป็นสีขาว */
        width: 20px;
        /* ปรับขนาดของไอคอนเป็น 15px */
        height: 20px;
        /* ปรับขนาดของไอคอนเป็น 15px */
    }

    .gsc-control-cse {
        background-color: transparent;
        border: none;
    }

    .gsc-search-button-v2:hover {
        /* background-color: #0056b3; */
        /* color: ; */
        /* ปรับสีของปุ่มเมื่อเม้าส์ hover */
    }

    /* ซ่อนข้อความ "เพิ่มประสิทธิภาพโดย Google" */
    .gsc-input-box .gsc-input {
        color: transparent;
    }

    /* เพิ่ม placeholder แทนข้อความ "เพิ่มประสิทธิภาพโดย Google" */
    .gsc-input-box::before {
        content: 'ค้นหา';
        color: #000;
        /* เปลี่ยนสีข้อความ placeholder ตามต้องการ */
        position: absolute;
        top: 12px;
        /* ปรับตำแหน่งตามต้องการ */
        left: 10px;
        /* ปรับตำแหน่งตามต้องการ */
        z-index: -1;
        /* สร้างข้อความ placeholder ให้อยู่ต่ำกว่า input */
    }


    .gsc-control {
        font-family: arial, sans-serif;
        background-color: lightblue !important;
        width: 500px;
        border-radius: 3rem;
        padding: 7px 20px !important;
    }

    .gsc-input {
        padding: 0px !important;
    }

    .gsc-input-box {
        border: 1px solid #dfe1e5;
        background: #fff;
        border-radius: 2rem;
        padding: 1px 10px;
        position: relative;
    }

    #gsc-i-id1 {
        color: #000 !important;
        line-height: 1.2 !important;
        background: none !important;
        font-size: 1rem !important;
    }

    .gsc-search-button-v2 {
        padding: 0.5rem !important;
        cursor: pointer;
        border-radius: 50%;
        position: absolute;
        margin-left: -33px;
        margin-top: -18px;
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

     // เปลี่ยนคำเป็นคำว่า ค้นหา
     window.onload = function() {
        var placeHolderText = "ค้นหา";
        var searchBox = document.querySelector("#gsc-i-id1");
        var searchButton = document.querySelector(".gsc-search-button-v2 svg title");
        searchBox.placeholder = placeHolderText;
        searchBox.title = placeHolderText;
        searchButton.innerHTHL = placeHolderText;
    }

    // ค้นหาซ่อน / แสดงผล
    function toggleSearch() {
        var searchContainer = document.getElementById('searchContainer');
        var searchImage = document.getElementById('searchImage');

        if (searchContainer.style.display === 'none') {
            searchContainer.style.display = 'block'; // แสดง div
            searchImage.style.display = 'none'; // ซ่อนรูป
        } else {
            searchContainer.style.display = 'none'; // ซ่อน div
            searchImage.style.display = 'block'; // แสดงรูป
        }
    }

    function changeImage(imageUrl) {
        document.getElementById('searchImage').src = imageUrl;
    }

    function restoreImage(imageUrl) {
        document.getElementById('searchImage').src = imageUrl;
    }
</script>


<div style="position: relative; width: 1280px; ">
    <img src="<?php echo base_url("docs/t.navbar-top.png"); ?>">
    <a href="<?php echo site_url('Home'); ?>" onmouseover="changeImage(`<?php echo base_url('docs/k.item-nav-top1v3-hover.png'); ?>`)" onmouseout="restoreImage(`<?php echo base_url('docs/k.item-nav-top1v3.png'); ?>`)">
        <img src="<?php echo base_url("docs/k.item-nav-top1v3.png"); ?>" alt="" style="position: absolute; top: 20%; left: 67%;">
    </a>
    <a href="<?php echo site_url('Pages/all_web'); ?>" onmouseover="changeImage(`<?php echo base_url('docs/k.item-nav-top2v3-hover.png'); ?>`)" onmouseout="restoreImage(`<?php echo base_url('docs/k.item-nav-top2v3.png'); ?>`)">
        <img src="<?php echo base_url("docs/k.item-nav-top2v3.png"); ?>" alt="" style="position: absolute; top: 20%; left: 77%;">
    </a>
    <a href="<?php echo site_url('Home/login'); ?>" onmouseover="changeImage(`<?php echo base_url('docs/k.item-nav-top3v3-hover.png'); ?>`)" onmouseout="restoreImage(`<?php echo base_url('docs/k.item-nav-top3v3.png'); ?>`)">
        <img src="<?php echo base_url("docs/k.item-nav-top3v3.png"); ?>" alt="" style="position: absolute; top: 20%; left: 88%;">
    </a>
    <div class="search">
        <a href="#" id="searchShow" onclick="toggleSearch()">
            <img id="searchImage" src="<?php echo base_url("docs/search.png"); ?>" style="position: absolute; top: 10%; left: 84%;" onmouseover="changeImage('<?php echo base_url('docs/search-hover.png'); ?>')" onmouseout="restoreImage('<?php echo base_url('docs/search.png'); ?>')">
        </a>
        <div id="searchContainer" style="display: none;">
            <div class="gcse-search"></div>
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