<div class="bg-pages ">
    <div class="row pad-path">
        <div class="path1-1">
            <span class="font-path-1 underline"><a href="<?php echo site_url('Home'); ?>">หน้าแรก</a></span>
        </div>
        <div class="path2-1">
            <span class="font-path-2 underline"><a href="#">E-service</a></span>
        </div>

    </div>
    <div class="container-pages-news">
        <div class="page-center">
            <div class="head-pages">
                <span class="font-pages-head">กระทู้ถาม - ตอบ</span>
            </div>
        </div>
        <div class="bg-pages-in-e-service ">
            <div class="pages-form-es-complain-q-a underline">
                <form action=" <?php echo site_url('Pages/add_q_a'); ?> " method="post" class="form-horizontal" enctype="multipart/form-data">
                    <br>
                    <div class="form-group">
                        <div class="col-sm-12 control-label font-e-service-complain">หัวข้อคำถาม</div>
                        <div class="col-sm-12 mt-2">
                            <input type="text" name="q_a_msg" class="form-control font-label-e-service-complain" required placeholder="กรอกคำถาม...">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <div class="col-sm-2 control-label font-e-service-complain">ชื่อ</div>
                                <div class="col-sm-12 mt-2">
                                    <input type="text" name="q_a_by" class="form-control font-label-e-service-complain" required placeholder="กรอกชื่อผู้ตั้งกระทู้">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <div class="col-sm-2 control-label font-e-service-complain">อีเมล</div>
                                <div class="col-sm-12 mt-2">
                                    <input type="email" name="q_a_email" class="form-control font-label-e-service-complain" required placeholder="example@youremail.com">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1" class="form-label font-e-service-complain">รายละเอียด</label>
                        <div class="col-sm-12">
                            <textarea name="q_a_detail" class="form-control font-label-e-service-complain" id="exampleFormControlTextarea1" rows="6" placeholder="กรอกรายละเอียดเพิ่มเติม..."></textarea>
                        </div>
                    </div>
                    <br>
            </div>
            <div class="row">
                <div class="col-9">
                    <div class="d-flex justify-content-end">
                        <div class="g-recaptcha" data-sitekey="6LcKoPcnAAAAAKGgUMRtkBs6chDKzC8XOoVnaZg_" data-callback="enableLoginButton"></div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="d-flex justify-content-start">
                        <button type="submit" id="loginBtn" class="btn" disabled><img src="<?php echo base_url("docs/s.btn-add-q-a.png"); ?>"></button>
                    </div>
                </div>
            </div>
            </form>
            <div class="margin-top-delete d-flex justify-content-end">
            <a href="<?php echo site_url('Pages/q_a'); ?>"><img src="<?php echo base_url("docs/k.btn-back.png"); ?>"></a>
        </div>
        </div>
    </div>
</div>

<script>
    // เมื่อ reCAPTCHA ผ่านการตรวจสอบ
    function enableLoginButton() {
        document.getElementById("loginBtn").removeAttribute("disabled");
    }
</script>