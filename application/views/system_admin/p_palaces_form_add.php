<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-7">
            <h4>เพิ่มข้อมูลทำเนียบเทศบาลธงธานี</h4>
            <form action=" <?php echo site_url('p_palaces_backend/add_p_palaces'); ?> " method="post" class="form-horizontal" enctype="multipart/form-data">
                <br>
                <!-- <div class="form-group row">
                    <div class="col-sm-2 control-label">ชื่อ</div>
                    <div class="col-sm-6">
                        <input type="text" name="p_palaces_name" required class="form-control">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-2 control-label">link</div>
                    <div class="col-sm-6">
                        <input type="text" name="p_palaces_link" class="form-control">
                    </div>
                </div>
                <br> -->
                <div class="form-group row">
                    <div class="col-sm-2 control-label">เพิ่มรูปภาพผังเว็บไซต์</div>
                    <div class="col-sm-6">
                        <input type="file" name="p_palaces_img" class="form-control" accept="image/*" required>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-2 control-label"></div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                        <a class="btn btn-danger" href="<?php echo site_url('p_palaces_backend'); ?>">ยกเลิก</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>