<div class="bg-pages">
    <div class="row pad-path">
        <div class="path1-1">
            <span class="font-path-1 underline"><a href="<?php echo site_url('Home'); ?>">หน้าแรก</a></span>
        </div>
        <div class="path2-2">
            <span class="font-path-2 underline"><a href="#">ข่าว e-GP</a></span>
        </div>
    </div>
    <div class="container-pages-news">
        <div class="page-center">
            <div class="head-pages">
                <span class="font-pages-head">ข่าวจัดซื้อจัดจ้าง e-GP</span>
            </div>
        </div>
        <!-- <div style="padding-top: 30px;"></div> -->
        <div class="scrollable-container">

            <?php foreach ($q2567 as $egp) { ?>
                <div class="pages-select-e-gp underline">
                    <div class="row">
                        <div class="col-2" style="padding-left: 30px;">
                            <img src="<?php echo base_url("docs/e-gp.png"); ?>" style="width: 94px; height:63px;">
                        </div>
                        <div class="col-10">
                            <span class="font-24">
                                <a href="https://process3.gprocurement.go.th/egp2procmainWeb/jsp/procsearch.sch?servlet=gojsp&proc_id=ShowHTMLFile&processFlows=Procure&projectId=<?= $egp->project_id; ?>&templateType=W2&temp_Announ=A&temp_itemNo=0&seqNo=1" target="_blank"> <?= $egp->project_name; ?></a>
                                <br><span><strong><?= "เผยแพร่เมื่อวันที่" ?>:</strong> <?php
                                                                                        // สมมติว่าค่าที่ได้รับมาจากตัวแปร $rs['doc_date'] อยู่ในรูปแบบ "10 ม.ค. 67"
                                                                                        $dateStr = $egp->transaction_date;

                                                                                        // แปลงเดือนจากชื่อไทยย่อเป็นชื่อเต็ม
                                                                                        $thaiMonths = [
                                                                                            'ม.ค.' => 'มกราคม',
                                                                                            'ก.พ.' => 'กุมภาพันธ์',
                                                                                            'มี.ค.' => 'มีนาคม',
                                                                                            'เม.ย.' => 'เมษายน',
                                                                                            'พ.ค.' => 'พฤษภาคม',
                                                                                            'มิ.ย.' => 'มิถุนายน',
                                                                                            'ก.ค.' => 'กรกฎาคม',
                                                                                            'ส.ค.' => 'สิงหาคม',
                                                                                            'ก.ย.' => 'กันยายน',
                                                                                            'ต.ค.' => 'ตุลาคม',
                                                                                            'พ.ย.' => 'พฤศจิกายน',
                                                                                            'ธ.ค.' => 'ธันวาคม',
                                                                                        ];

                                                                                        // แปลงเดือนใน $dateStr โดยใช้การแทนที่จาก array $thaiMonths
                                                                                        foreach ($thaiMonths as $shortMonth => $fullMonth) {
                                                                                            if (strpos($dateStr, $shortMonth) !== false) {
                                                                                                $dateStr = str_replace($shortMonth, $fullMonth, $dateStr);
                                                                                                break; // ออกจาก loop เมื่อเจอการแทนที่แล้ว
                                                                                            }
                                                                                        }

                                                                                        // แปลงปีคริสต์ศักราช (สองหลัก) เป็นปีพุทธศักราช (สี่หลัก)
                                                                                        preg_match('/\d{2}$/', $dateStr, $matches);
                                                                                        if ($matches) {
                                                                                            $year = $matches[0]; // ดึงตัวเลขสองหลักท้ายสุด ซึ่งคือปีในรูปแบบ 67
                                                                                            $fullYear = (int)$year < 50 ? '25' . $year : '25' . $year; // เพิ่ม '25' ข้างหน้าปี
                                                                                            $dateStr = str_replace($year, $fullYear, $dateStr); // แทนที่ปีด้วยปีที่เพิ่ม '25' ข้างหน้า
                                                                                        }

                                                                                        // แสดงผลลัพธ์
                                                                                        echo $dateStr; // ตัวอย่างเช่น "10 มกราคม 2567"
                                                                                        ?></span>
                            </span>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php foreach ($q2566 as $egp) { ?>
                <div class="pages-select-e-gp underline">
                    <div class="row">
                        <div class="col-2" style="padding-left: 30px;">
                            <img src="<?php echo base_url("docs/e-gp.png"); ?>" style="width: 94px; height:63px;">
                        </div>
                        <div class="col-10">
                            <span class="font-24">
                                <a href="https://process3.gprocurement.go.th/egp2procmainWeb/jsp/procsearch.sch?servlet=gojsp&proc_id=ShowHTMLFile&processFlows=Procure&projectId=<?= $egp->project_id; ?>&templateType=W2&temp_Announ=A&temp_itemNo=0&seqNo=1" target="_blank"> <?= $egp->project_name; ?></a>
                                <br><span><strong><?= "เผยแพร่เมื่อวันที่" ?>:</strong> <?php
                                                                                        // สมมติว่าค่าที่ได้รับมาจากตัวแปร $rs['doc_date'] อยู่ในรูปแบบ "10 ม.ค. 67"
                                                                                        $dateStr = $egp->transaction_date;

                                                                                        // แปลงเดือนจากชื่อไทยย่อเป็นชื่อเต็ม
                                                                                        $thaiMonths = [
                                                                                            'ม.ค.' => 'มกราคม',
                                                                                            'ก.พ.' => 'กุมภาพันธ์',
                                                                                            'มี.ค.' => 'มีนาคม',
                                                                                            'เม.ย.' => 'เมษายน',
                                                                                            'พ.ค.' => 'พฤษภาคม',
                                                                                            'มิ.ย.' => 'มิถุนายน',
                                                                                            'ก.ค.' => 'กรกฎาคม',
                                                                                            'ส.ค.' => 'สิงหาคม',
                                                                                            'ก.ย.' => 'กันยายน',
                                                                                            'ต.ค.' => 'ตุลาคม',
                                                                                            'พ.ย.' => 'พฤศจิกายน',
                                                                                            'ธ.ค.' => 'ธันวาคม',
                                                                                        ];

                                                                                        // แปลงเดือนใน $dateStr โดยใช้การแทนที่จาก array $thaiMonths
                                                                                        foreach ($thaiMonths as $shortMonth => $fullMonth) {
                                                                                            if (strpos($dateStr, $shortMonth) !== false) {
                                                                                                $dateStr = str_replace($shortMonth, $fullMonth, $dateStr);
                                                                                                break; // ออกจาก loop เมื่อเจอการแทนที่แล้ว
                                                                                            }
                                                                                        }

                                                                                        // แปลงปีคริสต์ศักราช (สองหลัก) เป็นปีพุทธศักราช (สี่หลัก)
                                                                                        preg_match('/\d{2}$/', $dateStr, $matches);
                                                                                        if ($matches) {
                                                                                            $year = $matches[0]; // ดึงตัวเลขสองหลักท้ายสุด ซึ่งคือปีในรูปแบบ 67
                                                                                            $fullYear = (int)$year < 50 ? '25' . $year : '25' . $year; // เพิ่ม '25' ข้างหน้าปี
                                                                                            $dateStr = str_replace($year, $fullYear, $dateStr); // แทนที่ปีด้วยปีที่เพิ่ม '25' ข้างหน้า
                                                                                        }

                                                                                        // แสดงผลลัพธ์
                                                                                        echo $dateStr; // ตัวอย่างเช่น "10 มกราคม 2567"
                                                                                        ?></span>
                            </span>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php foreach ($q2565 as $egp) { ?>
                <div class="pages-select-e-gp underline">
                    <div class="row">
                        <div class="col-2" style="padding-left: 30px;">
                            <img src="<?php echo base_url("docs/e-gp.png"); ?>" style="width: 94px; height:63px;">
                        </div>
                        <div class="col-10">
                            <span class="font-24">
                                <a href="https://process3.gprocurement.go.th/egp2procmainWeb/jsp/procsearch.sch?servlet=gojsp&proc_id=ShowHTMLFile&processFlows=Procure&projectId=<?= $egp->project_id; ?>&templateType=W2&temp_Announ=A&temp_itemNo=0&seqNo=1" target="_blank"> <?= $egp->project_name; ?></a>
                                <br><span><strong><?= "เผยแพร่เมื่อวันที่" ?>:</strong> <?php
                                                                                        // สมมติว่าค่าที่ได้รับมาจากตัวแปร $rs['doc_date'] อยู่ในรูปแบบ "10 ม.ค. 67"
                                                                                        $dateStr = $egp->transaction_date;

                                                                                        // แปลงเดือนจากชื่อไทยย่อเป็นชื่อเต็ม
                                                                                        $thaiMonths = [
                                                                                            'ม.ค.' => 'มกราคม',
                                                                                            'ก.พ.' => 'กุมภาพันธ์',
                                                                                            'มี.ค.' => 'มีนาคม',
                                                                                            'เม.ย.' => 'เมษายน',
                                                                                            'พ.ค.' => 'พฤษภาคม',
                                                                                            'มิ.ย.' => 'มิถุนายน',
                                                                                            'ก.ค.' => 'กรกฎาคม',
                                                                                            'ส.ค.' => 'สิงหาคม',
                                                                                            'ก.ย.' => 'กันยายน',
                                                                                            'ต.ค.' => 'ตุลาคม',
                                                                                            'พ.ย.' => 'พฤศจิกายน',
                                                                                            'ธ.ค.' => 'ธันวาคม',
                                                                                        ];

                                                                                        // แปลงเดือนใน $dateStr โดยใช้การแทนที่จาก array $thaiMonths
                                                                                        foreach ($thaiMonths as $shortMonth => $fullMonth) {
                                                                                            if (strpos($dateStr, $shortMonth) !== false) {
                                                                                                $dateStr = str_replace($shortMonth, $fullMonth, $dateStr);
                                                                                                break; // ออกจาก loop เมื่อเจอการแทนที่แล้ว
                                                                                            }
                                                                                        }

                                                                                        // แปลงปีคริสต์ศักราช (สองหลัก) เป็นปีพุทธศักราช (สี่หลัก)
                                                                                        preg_match('/\d{2}$/', $dateStr, $matches);
                                                                                        if ($matches) {
                                                                                            $year = $matches[0]; // ดึงตัวเลขสองหลักท้ายสุด ซึ่งคือปีในรูปแบบ 67
                                                                                            $fullYear = (int)$year < 50 ? '25' . $year : '25' . $year; // เพิ่ม '25' ข้างหน้าปี
                                                                                            $dateStr = str_replace($year, $fullYear, $dateStr); // แทนที่ปีด้วยปีที่เพิ่ม '25' ข้างหน้า
                                                                                        }

                                                                                        // แสดงผลลัพธ์
                                                                                        echo $dateStr; // ตัวอย่างเช่น "10 มกราคม 2567"
                                                                                        ?></span>
                            </span>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php foreach ($q2564 as $egp) { ?>
                <div class="pages-select-e-gp underline">
                    <div class="row">
                        <div class="col-2" style="padding-left: 30px;">
                            <img src="<?php echo base_url("docs/e-gp.png"); ?>" style="width: 94px; height:63px;">
                        </div>
                        <div class="col-10">
                            <span class="font-24">
                                <a href="https://process3.gprocurement.go.th/egp2procmainWeb/jsp/procsearch.sch?servlet=gojsp&proc_id=ShowHTMLFile&processFlows=Procure&projectId=<?= $egp->project_id; ?>&templateType=W2&temp_Announ=A&temp_itemNo=0&seqNo=1" target="_blank"> <?= $egp->project_name; ?></a>
                                <br><span><strong><?= "เผยแพร่เมื่อวันที่" ?>:</strong> <?php
                                                                                        // สมมติว่าค่าที่ได้รับมาจากตัวแปร $rs['doc_date'] อยู่ในรูปแบบ "10 ม.ค. 67"
                                                                                        $dateStr = $egp->transaction_date;

                                                                                        // แปลงเดือนจากชื่อไทยย่อเป็นชื่อเต็ม
                                                                                        $thaiMonths = [
                                                                                            'ม.ค.' => 'มกราคม',
                                                                                            'ก.พ.' => 'กุมภาพันธ์',
                                                                                            'มี.ค.' => 'มีนาคม',
                                                                                            'เม.ย.' => 'เมษายน',
                                                                                            'พ.ค.' => 'พฤษภาคม',
                                                                                            'มิ.ย.' => 'มิถุนายน',
                                                                                            'ก.ค.' => 'กรกฎาคม',
                                                                                            'ส.ค.' => 'สิงหาคม',
                                                                                            'ก.ย.' => 'กันยายน',
                                                                                            'ต.ค.' => 'ตุลาคม',
                                                                                            'พ.ย.' => 'พฤศจิกายน',
                                                                                            'ธ.ค.' => 'ธันวาคม',
                                                                                        ];

                                                                                        // แปลงเดือนใน $dateStr โดยใช้การแทนที่จาก array $thaiMonths
                                                                                        foreach ($thaiMonths as $shortMonth => $fullMonth) {
                                                                                            if (strpos($dateStr, $shortMonth) !== false) {
                                                                                                $dateStr = str_replace($shortMonth, $fullMonth, $dateStr);
                                                                                                break; // ออกจาก loop เมื่อเจอการแทนที่แล้ว
                                                                                            }
                                                                                        }

                                                                                        // แปลงปีคริสต์ศักราช (สองหลัก) เป็นปีพุทธศักราช (สี่หลัก)
                                                                                        preg_match('/\d{2}$/', $dateStr, $matches);
                                                                                        if ($matches) {
                                                                                            $year = $matches[0]; // ดึงตัวเลขสองหลักท้ายสุด ซึ่งคือปีในรูปแบบ 67
                                                                                            $fullYear = (int)$year < 50 ? '25' . $year : '25' . $year; // เพิ่ม '25' ข้างหน้าปี
                                                                                            $dateStr = str_replace($year, $fullYear, $dateStr); // แทนที่ปีด้วยปีที่เพิ่ม '25' ข้างหน้า
                                                                                        }

                                                                                        // แสดงผลลัพธ์
                                                                                        echo $dateStr; // ตัวอย่างเช่น "10 มกราคม 2567"
                                                                                        ?></span>
                            </span>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php foreach ($q2563 as $egp) { ?>
                <div class="pages-select-e-gp underline">
                    <div class="row">
                        <div class="col-2" style="padding-left: 30px;">
                            <img src="<?php echo base_url("docs/e-gp.png"); ?>" style="width: 94px; height:63px;">
                        </div>
                        <div class="col-10">
                            <span class="font-24">
                                <a href="https://process3.gprocurement.go.th/egp2procmainWeb/jsp/procsearch.sch?servlet=gojsp&proc_id=ShowHTMLFile&processFlows=Procure&projectId=<?= $egp->project_id; ?>&templateType=W2&temp_Announ=A&temp_itemNo=0&seqNo=1" target="_blank"> <?= $egp->project_name; ?></a>
                                <br><span><strong><?= "เผยแพร่เมื่อวันที่" ?>:</strong> <?php
                                                                                        // สมมติว่าค่าที่ได้รับมาจากตัวแปร $rs['doc_date'] อยู่ในรูปแบบ "10 ม.ค. 67"
                                                                                        $dateStr = $egp->transaction_date;

                                                                                        // แปลงเดือนจากชื่อไทยย่อเป็นชื่อเต็ม
                                                                                        $thaiMonths = [
                                                                                            'ม.ค.' => 'มกราคม',
                                                                                            'ก.พ.' => 'กุมภาพันธ์',
                                                                                            'มี.ค.' => 'มีนาคม',
                                                                                            'เม.ย.' => 'เมษายน',
                                                                                            'พ.ค.' => 'พฤษภาคม',
                                                                                            'มิ.ย.' => 'มิถุนายน',
                                                                                            'ก.ค.' => 'กรกฎาคม',
                                                                                            'ส.ค.' => 'สิงหาคม',
                                                                                            'ก.ย.' => 'กันยายน',
                                                                                            'ต.ค.' => 'ตุลาคม',
                                                                                            'พ.ย.' => 'พฤศจิกายน',
                                                                                            'ธ.ค.' => 'ธันวาคม',
                                                                                        ];

                                                                                        // แปลงเดือนใน $dateStr โดยใช้การแทนที่จาก array $thaiMonths
                                                                                        foreach ($thaiMonths as $shortMonth => $fullMonth) {
                                                                                            if (strpos($dateStr, $shortMonth) !== false) {
                                                                                                $dateStr = str_replace($shortMonth, $fullMonth, $dateStr);
                                                                                                break; // ออกจาก loop เมื่อเจอการแทนที่แล้ว
                                                                                            }
                                                                                        }

                                                                                        // แปลงปีคริสต์ศักราช (สองหลัก) เป็นปีพุทธศักราช (สี่หลัก)
                                                                                        preg_match('/\d{2}$/', $dateStr, $matches);
                                                                                        if ($matches) {
                                                                                            $year = $matches[0]; // ดึงตัวเลขสองหลักท้ายสุด ซึ่งคือปีในรูปแบบ 67
                                                                                            $fullYear = (int)$year < 50 ? '25' . $year : '25' . $year; // เพิ่ม '25' ข้างหน้าปี
                                                                                            $dateStr = str_replace($year, $fullYear, $dateStr); // แทนที่ปีด้วยปีที่เพิ่ม '25' ข้างหน้า
                                                                                        }

                                                                                        // แสดงผลลัพธ์
                                                                                        echo $dateStr; // ตัวอย่างเช่น "10 มกราคม 2567"
                                                                                        ?></span>
                            </span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>