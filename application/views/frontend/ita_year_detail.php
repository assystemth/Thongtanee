<div class="bg-pages ">
	        <div class="row pad-path">
            <div class="path1-1">
                <span class="font-path-1 underline"><a href="<?php echo site_url('Home'); ?>">หน้าแรก</a></span>
            </div>
            <div class="path2-2">
                <span class="font-path-2 underline"><a href="#">ปี <?= $query->ita_year_year; ?></a></span>
            </div>
        </div>
    <div class="container-pages-detail">
        <div class="page-center">
            <div class="head-pages-two">
                <span class="font-pages-head">ITA การประเมินคุณธรรมและความโปร่งใส</span>
            </div>
        </div>
        <div class="bg-pages-ita">
            <div class="scrollable-container-550">
                <?php foreach ($query_topic as $rs) { ?>
                    <div class="bg-ita-empty">
                        <div class="d-flex justify-content-start mt-3">
                            <span class="font-ita-head"><?= $rs->ita_year_topic_name; ?></span>
                        </div>
                        <div class="ita-detail-content">
                            <?php
                            $linkDataArray = json_decode('[' . $rs->link_data . ']', true);
                            foreach ($linkDataArray as $linkData) {
                                echo '<span class="font-ita-content">' . $linkData['ita_year_link_name'] . '</span>';
                                echo '<div class="row mt-2">';
                                echo '<div class="col-2">';

                                // ตรวจสอบและแสดงค่าเมื่อมีลิงค์
                                foreach (range(1, 5) as $i) {
                                    $linkKey = 'ita_year_link_link' . $i;
                                    if (!empty($linkData[$linkKey])) {
                                        echo '<span class="font-ita-content-detail">ลิงค์</span><br><br>';
                                    }
                                }

                                echo '</div>';
                                echo '<div class="col-8">';

                                // แสดงลิงค์
                                foreach (range(1, 5) as $i) {
                                    $linkKey = 'ita_year_link_link' . $i;
                                    if (!empty($linkData[$linkKey])) {
                                        echo '<span class="font-ita-content-detail one-line-ellipsis">' . $linkData[$linkKey] . '</span><br><br>';
                                    }
                                }

                                echo '</div>';
                                echo '<div class="col-2">';

                                // แสดงปุ่มเปิดลิงค์
                                foreach (range(1, 5) as $i) {
                                    $linkKey = 'ita_year_link_link' . $i;
                                    if (!empty($linkData[$linkKey])) {
                                        echo '<a class="btn btn-ita-open" target="_blank" href="' . $linkData[$linkKey] . '">เปิด</a><br>';
                                    }
                                }

                                echo '</div>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="margin-top-delete d-flex justify-content-end">
                <a href="<?php echo site_url('Pages/ita_year'); ?>"><img src="<?php echo base_url("docs/k.btn-back.png"); ?>"></a>
            </div>
        </div>
    </div>

    <!-- <div id="popup-ita" class="popup-ita">
        <div class="popup-ita-content">
            <h4><b>test</b></h4>
            <div class="row">
                <div class="col-7">
                    <div class="d-flex justify-content-start">
                        <h5><b>ลิงค์</b></h5>
                        <span id="popup-ita-link"></span>
                    </div>
                </div>
                <div class="col-5">
                    <div class="d-flex justify-content-start">
                        <h5><b>คำอธิบาย</b></h5>
                    </div>
                </div>
            </div>
            <br>
            <div class="d-flex justify-content-end">
                <button class="btn-close-ita" onclick="closePopupIta()">ปิด</button>
            </div>
        </div>
    </div>

    <script>
        function closePopupIta() {
            document.getElementById("popup-ita").style.display = "none";
        }

        function openPopupIta(ita_year_link_id) {
            document.getElementById("popup-ita").style.display = "block";

            $.ajax({
                url: 'Pages/ita_year_link_list/' + ita_year_link_id,
                type: 'GET',
                success: function(response) {
                    // ดำเนินการต่อไปตามที่คุณต้องการ
                    console.log(response);
                    // เรียกฟังก์ชันสำหรับแสดงข้อมูลใน popup
                    displayPopupData(response);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }


        function displayPopupData(data) {
            // แสดงข้อมูลที่ได้รับมาจาก AJAX ใน console
            console.log(data);

            // ตรวจสอบโครงสร้างข้อมูลและดึงค่าที่ต้องการ
            // ตัวอย่างเช่น
            if (data) {
                document.getElementById("popup-ita-link").innerText = data.ita_year_link_link1;
            } else {
                console.error('Invalid data structure:', data);
            }
        }
    </script> -->