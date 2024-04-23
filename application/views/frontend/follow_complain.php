<div class="bg-pages">
    <div class="row pad-path">
        <div class="path1-1">
            <span class="font-path-1 underline"><a href="<?php echo site_url('Home'); ?>">หน้าแรก</a></span>
        </div>
        <div class="path2-1">
            <span class="font-path-2 underline"><a href="#">E-Service</a></span>
        </div>
        <div class="col">
            <div class="d-flex justify-content-end">
                <div class="form-group">
                    <div class="col-sm-12">
                        <select class="form-select custom-select" id="ChangPagesComplain">
                            <option value="" disabled selected>ติดตามสถานะเรื่องร้องเรียน</option>
                            <option value="complain">ร้องเรียน/ร้องทุกข์</option>
                            <option value="esv_ods">ยื่นเอกสารออนไลน์</option>
                            <option value="suggestions">รับฟังความคิดเห็น</option>
                            <option value="corruption">แจ้งเรื่องทุจริตหน่วยงานภาครัฐ</option>

                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-pages-news">
        <div class="page-center">
            <div class="head-pages-two">
                <span class="font-pages-head">ติดตามสถานะเรื่องร้องเรียน</span>
            </div>
        </div>
        <div class="bg-pages-in-e-service-flcp ">
            <div class="pages-follow-complain underline">
                <form id="reCAPTCHA3" action=" <?php echo site_url('Pages/follow_complain'); ?> " method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <br>
                        <div class="col-sm-12 control-label font-e-service-complain text-center">กรุณากรอกหมายเลขเรื่องร้องเรียน</div>
                        <div class="center-center mt-4">
                            <div class="col-sm-4 mb-4">
                                <?php if (!empty($complain_data)) : ?>
                                    <input type="text" name="complain_id" class="form-control font-label-e-service-complain input-radius " required value="<?php echo $complain_data['complain_id']; ?>" placeholder="6600001">
                                <?php else : ?>
                                    <input type="text" name="complain_id" class="form-control font-label-e-service-complain input-radius " required placeholder="6700001">
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-4 mb-3" style="margin-left: -100px;">
                                <!-- <div class="g-recaptcha" data-sitekey="6LcKoPcnAAAAAKGgUMRtkBs6chDKzC8XOoVnaZg_" data-callback="enableLoginButton"></div> -->
                            </div>
                            <div class="col-sm-2" style="margin-left: -50px;">
                                <!-- <button type="submit" id="loginBtn" class="btn" disabled><img src="<?php echo base_url("docs/s.btn-add-q-a.png"); ?>"></button> -->
                                <button data-action='submit' data-callback='onSubmit' data-sitekey="6LcfiLYpAAAAAI7_U3nkRRxKF7e8B_fwOGqi7g6x" type="submit" id="loginBtn" class="btn g-recaptcha"><img src="<?php echo base_url("docs/s.btn-add-q-a.png"); ?>"></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="pages-follow-complain-detail" id="pages-follow-complain-detail" <?php if (!empty($complain_data) || isset($_POST['complain_id'])) : ?>style="display: block;" <?php else : ?>style="display: none;" <?php endif; ?>>
                <?php if (!empty($complain_data)) : ?>
                    <div style="padding-top: 30px;">
                        <span class="font-e-service-complain">เรื่อง : <?php echo $complain_data['complain_topic']; ?></span>
                    </div>
                    <div class="col-sm-10 mt-5" style="margin: auto;">
                        <div class="d-flex justify-content-between" style="margin-left: -50px; margin-right: 65px;">
                            <span class="font-flcp-sd gray">สถานะ</span>
                            <span class="font-flcp-sd gray">วันที่</span>
                        </div>
                    </div>
                    <div class="border-flcp"></div>
                <?php else : ?>
                    <h1 class="red text-center">ไม่พบหมายเลขร้องเรียนที่ท่านเลือก !</h1>
                <?php endif; ?>
                <div class="row">
                    <?php
                    foreach ($complain_details as $detail) :
                        $date = new DateTime($detail['complain_detail_datesave']);
                        $day_th = $date->format('d');
                        $month_names_th = array(
                            1 => 'มกราคม',
                            2 => 'กุมภาพันธ์',
                            3 => 'มีนาคม',
                            4 => 'เมษายน',
                            5 => 'พฤษภาคม',
                            6 => 'มิถุนายน',
                            7 => 'กรกฏาคม',
                            8 => 'สิงหาคม',
                            9 => 'กันยายน',
                            10 => 'ตุลาคม',
                            11 => 'พฤศจิกายน',
                            12 => 'ธันวาคม',
                        );
                        $month_th = $month_names_th[$date->format('n')];
                        $year_th = $date->format('Y') + 543; // เพิ่มขึ้น 543 ปี
                        $formattedDate = "$day_th $month_th $year_th"; // วันที่และเดือนเป็นภาษาไทย
                    ?>
                        <div class="col-sm-7 mb-5">
                            <span class="font-color-flcp" style="color:
                    <?php
                        if ($detail['complain_detail_status'] === 'รับเรื่องแล้ว') {
                            echo '#4C97EE;';
                        } elseif ($detail['complain_detail_status'] === 'กำลังดำเนินการ') {
                            echo '#3D5AF1;';
                        } elseif ($detail['complain_detail_status'] === 'รอดำเนินการ') {
                            echo '#E05A33;';
                        } elseif ($detail['complain_detail_status'] === 'ดำเนินการแก้ไขเรียบร้อย') {
                            echo '#00B73E;';
                        } elseif ($detail['complain_detail_status'] === 'ยกเลิก') {
                            echo '#FF0202;';
                        } else {
                            echo '#FFC700;';
                        }
                    ?>
                    ">
                                <img src="<?php echo base_url("docs/dot.png"); ?>" alt=""> &nbsp; <?php echo $detail['complain_detail_status']; ?>
                            </span>
                            <br>
                            <?php if (!empty($detail['complain_detail_com'])) : ?>
                                <span>(<?php echo $detail['complain_detail_com']; ?>)</span>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-5" style="padding-left: 15%;">
                            <span class="font-time-flcp"><?php echo $formattedDate; ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // เมื่อ reCAPTCHA ผ่านการตรวจสอบ
    // function enableLoginButton() {
    //     document.getElementById("loginBtn").removeAttribute("disabled");
    // }
</script>