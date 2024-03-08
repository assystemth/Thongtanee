<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-7">
            <h4>แก้ไขข้อมูลผัังเว็บไซต์</h4>
            <form action=" <?php echo site_url('site_map_backend/edit_site_map/' . $rsedit->site_map_id); ?> " method="post" class="form-horizontal" enctype="multipart/form-data">
                <br>
                <!-- <div class="form-group row">
                    <div class="col-sm-2 control-label">ชื่อ</div>
                    <div class="col-sm-6">
                        <input type="text" name="site_map_name" required class="form-control" value="<?= $rsedit->site_map_name; ?>">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-2 control-label">link</div>
                    <div class="col-sm-6">
                        <input type="text" name="site_map_link" required class="form-control" value="<?= $rsedit->site_map_link; ?>">
                    </div>
                </div>
                <br> -->
                <div class="form-group row">
                    <div class="col-sm-2 control-label">ไฟล์รูป</div>
                    <div class="col-sm-6">
                        ภาพเก่า <br>
                        <?php if (!empty($rsedit->site_map_img)) : ?>
                            <img src="<?= base_url('docs/img/' . $rsedit->site_map_img); ?>" width="250px" height="210">
                        <?php else : ?>
                            <img src="<?= base_url('docs/k.logo.png'); ?>" width="250px" height="210">
                        <?php endif; ?>
                        <br>
                        เลือกใหม่
                        <br>
                        <input type="file" name="site_map_img" class="form-control" accept="image/*">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-2 control-label"></div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                        <a class="btn btn-danger" href="<?php echo site_url('site_map_backend'); ?>">ยกเลิก</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>