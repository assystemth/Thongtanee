<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-7">
            <h4>แก้ไขข้อมูลสารจากนายก</h4>
            <form action=" <?php echo site_url('msg_pres_backend/edit/' . $rsedit->msg_pres_id); ?> " method="post" class="form-horizontal" enctype="multipart/form-data">
                <br>
                <div class="form-group row">
                    <div class="col-sm-3 control-label">เรื่อง</div>
                    <div class="col-sm-9">
                        <input type="text" name="msg_pres_name" id="msg_pres_name" class="form-control" value="<?= $rsedit->msg_pres_name; ?>">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-3 control-label">ไฟล์เอกสารเพิ่มเติม</div>
                    <div class="col-sm-6">
                        <a class="btn btn-info btn-sm mb-2" href="<?= base_url('docs/file/' . $rsedit->msg_pres_pdf); ?>" target="_blank">ดูไฟล์ <?= $rsedit->msg_pres_pdf; ?></a>
                        <br>
                        <input type="file" name="msg_pres_pdf" class="form-control mt-1" accept="application/pdf" multiple>
                        <span class="black-add">สามารถอัพโหลดได้หลายไฟล์</span>
                        <br>
                        <span class="red-add">(เฉพาะไฟล์ PDF)</span>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-2 control-label"></div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                        <a class="btn btn-danger" href="<?php echo site_url('msg_pres_backend'); ?>">ยกเลิก</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>