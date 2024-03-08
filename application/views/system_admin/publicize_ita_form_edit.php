<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-7">
            <h4>แก้ไขข้อมูลประชาสัมพันธ์ ITA</h4>
            <form action=" <?php echo site_url('publicize_ita_backend/edit_publicize_ita/' . $rsedit->publicize_ita_id); ?> " method="post" class="form-horizontal" enctype="multipart/form-data">
                <br>
                <div class="form-group row">
                    <div class="col-sm-2 control-label">ชื่อ</div>
                    <div class="col-sm-6">
                        <input type="text" name="publicize_ita_name" required class="form-control" value="<?= $rsedit->publicize_ita_name; ?>">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-2 control-label">link</div>
                    <div class="col-sm-6">
                        <input type="text" name="publicize_ita_link" required class="form-control" value="<?= $rsedit->publicize_ita_link; ?>">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-2 control-label">ไฟล์รูป</div>
                    <div class="col-sm-6">
                        ภาพเก่า <br>
                        <img src="<?= base_url('docs/img/' . $rsedit->publicize_ita_img); ?>" width="220px" height="180">
                        <br>
                        เลือกใหม่
                        <br>
                        <input type="file" name="publicize_ita_img" class="form-control" accept="image/*">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-2 control-label"></div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                        <a class="btn btn-danger" href="<?php echo site_url('publicize_ita_backend'); ?>">ยกเลิก</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>