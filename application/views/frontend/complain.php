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
                            <option value="" disabled selected>ร้องเรียน/ร้องทุกข์</option>
                            <option value="follow-complain">ติดตามสถานะเรื่องร้องเรียน</option>
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
            <div class="head-pages">
                <span class="font-pages-head">ร้องเรียน / ร้องทุกข์</span>
            </div>
        </div>
        <div class="bg-pages-in-e-service ">
            <div class="pages-form-es-complain underline">
                <form id="reCAPTCHA3" action=" <?php echo site_url('Pages/add_complain'); ?> " method="post" class="form-horizontal" enctype="multipart/form-data">
                    <br>
                    <br>
                    <div class="form-group">
                        <!-- <div class="col-sm-5 control-label  font-e-service-complain">ประเภทเรื่องที่ต้องการร้องเรียน</div> -->
                        <div class="col-sm-5">
                            <select class="form-select custom-select" name="complain_type" required>
                                <option value="" disabled selected>เลือกหมวดหมู่เรื่องร้องเรียน</option>
                                <option value="ไฟฟ้าสาธารณะ">ไฟฟ้าสาธารณะ</option>
                                <option value="แจ้งเก็บขยะ">แจ้งเก็บขยะ</option>
                                <option value="กลิ่นควัน">กลิ่นควัน</option>
                                <option value="น้ำเสีย">น้ำเสีย</option>
                                <option value="ท่อระบายน้ำ">ท่อระบายน้ำ</option>
                                <option value="ดูดสิ่งปฏิกูล">ดูดสิ่งปฏิกูล</option>
                                <option value="เสียงรบกวน">เสียงรบกวน</option>
                                <option value="พ่นยุง">พ่นยุง</option>
                                <option value="ตรวจสอบอาคาร">ตรวจสอบอาคาร</option>
                                <option value="ถนน">ถนน</option>
                                <option value="ขายของบนทางเท้า">ขายของบนทางเท้า</option>
                                <option value="อื่นๆ">อื่นๆ</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="col-sm-3 control-label font-e-service-complain">เรื่องร้องเรียน <span class="red-font">*</span></div>
                        <div class="col-sm-12 mt-2">
                            <input type="text" name="complain_topic" class="form-control font-label-e-service-complain" required placeholder="กรอกเรื่องร้องเรียน...">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group">
                                <div class="col-sm-12 control-label  font-e-service-complain">ชื่อ-นามสกุล <span class="red-font">*</span></div>
                                <div class="col-sm-12 mt-2">
                                    <input type="text" name="complain_by" class="form-control font-label-e-service-complain" required placeholder="นางสาวน้ำใส ใจชื่นบาน">
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <div class="col-sm-12 control-label  font-e-service-complain">เบอร์โทรศัพท์ <span class="red-font">*</span></div>
                                <div class="col-sm-12 mt-2">
                                    <input type="tel" name="complain_phone" class="form-control font-label-e-service-complain" required placeholder="กรอกเบอร์โทรศัพท์" pattern="\d{10}" title="กรุณากรอกเบอร์มือถือเป็นตัวเลข 10 ตัว">
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <div class="col-sm-12 control-label font-e-service-complain">อีเมล</div>
                                <div class="col-sm-12 mt-2">
                                    <input type="email" name="complain_email" class="form-control font-label-e-service-complain" placeholder="example@youremail.com">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="col-sm-2 control-label  font-e-service-complain">ที่อยู่ <span class="red-font">*</span></div>
                        <div class="col-sm-12 mt-2">
                            <input type="text" name="complain_address" class="form-control font-label-e-service-complain" required placeholder="กรอกข้อมูลที่อยู่ของคุณ">
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1" class="form-label  font-e-service-complain">รายละเอียด <span class="red-font">*</span></label>
                        <div class="col-sm-12">
                            <textarea name="complain_detail" class="form-control font-label-e-service-complain" id="exampleFormControlTextarea1" rows="6" required placeholder="กรอกรายละเอียดเพิ่มเติม..."></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="col-sm-7 control-label font-e-service-complain">รูปภาพเพิ่มเติม(สามารถเพิ่มได้หลายรูป)</div>
                        <div class="col-sm-12 mt-2">
                            <input type="file" name="complain_imgs[]" class="form-control " accept="image/*" multiple>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-9">
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