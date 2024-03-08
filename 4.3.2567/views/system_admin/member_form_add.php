<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-7">
            <h4>เพิ่มข้อมูลสมาชิก</h4>
            <form action=" <?php echo site_url('member_backend/add_Member'); ?> " method="post" class="form-horizontal" enctype="multipart/form-data">
                <div class="form-group row">
                    <div class="col-sm-2 control-label">username</div>
                    <div class="col-sm-5">
                        <input type="text" name="m_username" class="form-control" required>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-2 control-label">Password</div>
                    <div class="col-sm-5">
                        <div class="input-group">
                            <input type="password" id="m_password" name="m_password" class="form-control">
                            <button type="button" class="btn btn-outline-secondary" onclick="swapPasswordType()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-2 control-label">Confirm Password</div>
                    <div class="col-sm-5">
                        <div class="input-group">
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                            <button type="button" class="btn btn-outline-secondary" onclick="swapPasswordTypeConfirm()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-2 control-label">ชื่อตำแหน่งงาน</div>
                    <div class="col-sm-5">
                        <select class="form-control" name="ref_pid" required>
                            <option value="">เลือกข้อมูล</option>
                            <?php foreach ($rspo as $rs) { ?>
                                <option value="<?php echo $rs->pid; ?>"><?php echo $rs->pname; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-2 control-label">E-mail</div>
                    <div class="col-sm-5">
                        <input type="email" name="m_email" class="form-control" required>
                    </div>
                </div>
                <br>
                <!-- <div class="form-group row">
                    <div class="col-sm-2 control-label">คำนำหน้าชื่อ</div>
                    <div class="col-sm-3">
                        <select class="form-control" name="m_fname" required>
                            <option value="">เลือกข้อมูล</option>
                            <option value="นาย">นาย</option>
                            <option value="นางสาว">นางสาว</option>
                            <option value="นาง">นาง</option>
                        </select>
                    </div>
                </div>
                <br> -->
                <div class="form-group row">
                    <div class="col-sm-2 control-label">ชื่อ</div>
                    <div class="col-sm-5">
                        <input type="text" name="m_fname" class="form-control" required>
                        <span class="red">กรุณากรอกคำนำหน้าชื่อ</span>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-2 control-label">นามสกุล</div>
                    <div class="col-sm-5">
                        <input type="text" name="m_lname" class="form-control" required>
                    </div>
                </div>
                <br>
                <!-- <div class="form-group row">
                    <div class="col-sm-2 control-label">เลขบัตรประจำตัวประชาชน</div>
                    <div class="col-sm-4">
                        <input type="text" name="m_number" class="form-control" pattern="\d{13}" title="กรุณากรอกเลขบัตรประจำตัวประชาชนตัวเลข 14 ตัว">
                    </div>
                </div>
                <br> -->
                <div class="form-group row">
                    <div class="col-sm-2 control-label">เบอร์มือถือ</div>
                    <div class="col-sm-4">
                        <input type="text" name="m_phone" class="form-control" required pattern="\d{9,10}" title="กรุณากรอกเบอร์มือถือเป็นตัวเลข 9 หรือ 10 ตัว">
                    </div>
                </div>
                <br>
                <!-- <div class="form-group row">
                    <div class="col-sm-2 control-label">จังหวัด</div>
                    <div class="col-sm-5">
                        <select class="form-control" id="province" name="m_pname">
                            <option value="">เลือกจังหวัด</option>
                            <?php foreach ($provinces as $province) : ?>
                                <option value="<?php echo $province->tambol_pname; ?>"><?php echo $province->tambol_pname; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-2 control-label">อำเภอ</div>
                    <div class="col-sm-5">
                        <select class="form-control" id="amphur" name="m_aname">
                            <option value="">เลือกอำเภอ</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-2 control-label">ตำบล</div>
                    <div class="col-sm-5">
                        <select class="form-control" id="tambol" name="m_tname">
                            <option value="">เลือกตำบล</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-2 control-label">ที่อยู่</div>
                    <div class="col-sm-5">
                        <input type="text" name="m_address" class="form-control">
                    </div>
                </div>
                <br> -->
                <div class="form-group row">
                    <div class="col-sm-2 control-label">รูปโปรไฟล์</div>
                    <div class="col-sm-5">
                        <input type="file" name="m_img" class="form-control" accept="image/*">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-2 control-label"></div>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                        <a class="btn btn-danger" href="<?php echo site_url('member_backend/index'); ?>">ยกเลิก</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>