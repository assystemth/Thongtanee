    <!-- ส่วนทางซ้าย -->
    <div class="flex-item-left">
        <div class="bg-navbar">
            <!-- <div class="mb-4 text-center" style="padding-top: 20px;">
                <span class="font-head"><b>งานบริการภายใน</b></span>
            </div>
            <div class="border-navbar"></div> -->
            <div class="navbar-right">
                <a class="btn btn-navbar" href="#">
                    ข่าวภายในองค์กร
                </a>
                <br>
                <a class="btn btn-navbar" href="#">
                    แบบฟอร์ม
                </a>
                <br>
                <a class="btn btn-navbar" href="#">
                    คำสั่ง/ประกาศ
                </a>
                <br>
                <a class="btn btn-navbar" href="#">
                    ระเบียบ
                </a>
                <br>
                <a class="btn btn-navbar" href="#">
                    ระบบแชร์ไฟล์
                </a>
                <br>
                <a class="btn btn-navbar" href="#">
                    คลังรูปภาพ/วิดีโอ
                </a>
                <br>
                <a class="btn btn-navbar" href="#">
                    E-Book
                </a>
                <br>
                <a class="btn btn-navbar" href="#">
                    รายงานภาพรวม
                </a>
                <br>
                <a class="btn btn-navbar" href="#">
                    ผลิตภัณฑ์
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