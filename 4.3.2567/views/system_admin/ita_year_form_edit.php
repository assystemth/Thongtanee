<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-7">
            <h4>แก้ไขข้อมูล ITA ประจำปี</h4>
            <form action=" <?php echo site_url('ita_year_backend/edit/' . $rsedit->ita_year_id); ?> " method="post" class="form-horizontal" enctype="multipart/form-data">
                <br>
                <div class="form-group row">
                    <div class="col-sm-2 control-label">ปี</div>
                    <div class="col-sm-10">
                        <input type="text" name="ita_year_year" class="form-control" value="<?= $rsedit->ita_year_year; ?>">
                    </div>
                </div>
                <br>
                <?php for ($i = 1; $i <= 43; $i++) : ?>
                    <div class="form-group row">
                        <div class="col-sm-2 control-label">ชื่อข้อมูล</div>
                        <div class="col-sm-10">
                            <input type="text" name="ita_year_name<?= $i; ?>" class="form-control" value="<?= $rsedit->{'ita_year_name' . $i}; ?>" readonly>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-sm-2 control-label">ลิงค์</div>
                        <div class="col-sm-10">
                            <input type="text" name="ita_year_link<?= $i; ?>" class="form-control" value="<?= $rsedit->{'ita_year_link' . $i}; ?>">
                        </div>
                    </div>
                    <br>
                <?php endfor; ?>
                <div class="form-group row">
                    <div class="col-sm-2 control-label"></div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                        <a class="btn btn-danger" href="<?php echo site_url('ita_year_backend'); ?>">ยกเลิก</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>