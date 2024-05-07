<div class="bg-pages ">
    <div class="row pad-path">
        <div class="path1-1 mt-3">
            <span class="font-path-1 underline"><a href="<?php echo site_url('Home'); ?>">หน้าแรก</a></span>
        </div>
        <div class="path2-1 mt-3">
            <span class="font-path-2 underline"><a href="#">E-Service</a></span>
        </div>
        <div class="col">
            <div class="d-flex justify-content-end">
                <div class="form-group">
                    <div class="col-sm-12">
                        <select class="form-select custom-select" id="ChangPagesComplain">
                            <option value="" disabled selected>แจ้งเรื่องทุจริตหน่วยงานภาครัฐ</option>
                            <option value="esv_ods">ยื่นเอกสารออนไลน์</option>
                            <option value="suggestions">รับฟังความคิดเห็น</option>
                            <option value="complain">ร้องเรียน/ร้องทุกข์</option>
                            <option value="follow-complain">ติดตามสถานะเรื่องร้องเรียน</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-pages-news">
        <div class="page-center">
            <div class="head-pages-three">
                <span class="font-pages-head">ช่องทางแจ้งเรื่องทุจริตหน่วยงานภาครัฐ</span>
            </div>
        </div>
        <div class="bg-pages-in-e-service ">
            <div class="pages-form-es-corruption underline">
                <form id="reCAPTCHA3" action=" <?php echo site_url('Pages/add_corruption'); ?> " method="post" class="form-horizontal" enctype="multipart/form-data">
                    <br>
                    <div class="form-group">
                        <div class="col-sm-3 control-label font-e-service-complain">เรื่องเหตุการทุจริต <span class="red-font">*</span></div>
                        <div class="col-sm-12 mt-2">
                            <input type="text" name="corruption_topic" class="form-control font-label-e-service-complain" required placeholder="กรอกเรื่องร้องเรียน...">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group">
                                <div class="col-sm-12 control-label  font-e-service-complain">ชื่อ-นามสกุล <span class="red-font">*</span></div>
                                <div class="col-sm-12 mt-2">
                                    <input type="text" name="corruption_by" class="form-control font-label-e-service-complain" required placeholder="นางสาวน้ำใส ใจชื่นบาน">
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <div class="col-sm-12 control-label  font-e-service-complain">เบอร์โทรศัพท์ <span class="red-font">*</span></div>
                                <div class="col-sm-12 mt-2">
                                    <input type="tel" name="corruption_phone" class="form-control font-label-e-service-complain" required placeholder="กรอกเบอร์โทรศัพท์" pattern="\d{10}" title="กรุณากรอกเบอร์มือถือเป็นตัวเลข 10 ตัว">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <div class="col-sm-12 control-label  font-e-service-complain">อีเมล</div>
                                <div class="col-sm-12 mt-2">
                                    <input type="email" name="corruption_email" class="form-control font-label-e-service-complain" placeholder="example@youremail.com">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="col-sm-2 control-label font-e-service-complain">ที่อยู่ <span class="red-font">*</span></div>
                        <div class="col-sm-12 mt-2">
                            <input type="text" name="corruption_address" class="form-control font-label-e-service-complain" required placeholder="กรอกข้อมูลที่อยู่ของคุณ">
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1" class="form-label font-e-service-complain">รายละเอียด <span class="red-font">*</span></label>
                        <div class="col-sm-12">
                            <textarea name="corruption_detail" class="form-control font-label-e-service-complain" id="exampleFormControlTextarea1" rows="6" required placeholder="กรอกรายละเอียดเพิ่มเติม..."></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="col-sm-7 control-label font-e-service-complain">รูปภาพเพิ่มเติม(สามารถเพิ่มได้หลายรูป)</div>
                        <div class="col-sm-12 mt-2">
                            <input type="file" name="corruption_imgs[]" class="form-control" accept="image/*" multiple >
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-6 font-thx-curruption">
                    <span>ขอขอบพระคุณที่แจ้งเหตุพบเห็นการทุจริตหน่วยงานภาครัฐ</span>
                </div>
                <div class="col-3">
                    <div class="d-flex justify-content-end">
                        <!-- <div class="g-recaptcha" data-sitekey="6LcKoPcnAAAAAKGgUMRtkBs6chDKzC8XOoVnaZg_" data-callback="enableLoginButton"></div> -->
                    </div>
                </div>
                <div class="col-3">
                    <div class="d-flex justify-content-start">
                        <!-- <button type="submit" id="loginBtn" class="btn" disabled><img src="<?php echo base_url("docs/s.btn-add-q-a.png"); ?>"></button> -->
                        <button data-action='submit' data-callback='onSubmit' data-sitekey="6LcfiLYpAAAAAI7_U3nkRRxKF7e8B_fwOGqi7g6x" type="submit" id="loginBtn" class="btn g-recaptcha"><img src="<?php echo base_url("docs/s.btn-add-q-a.png"); ?>"></button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    // เมื่อ reCAPTCHA ผ่านการตรวจสอบ
    // function enableLoginButton() {
    //     document.getElementById("loginBtn").removeAttribute("disabled");
    // }
</script>