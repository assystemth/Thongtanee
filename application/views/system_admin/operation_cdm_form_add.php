<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-7">
            <h4>เพิ่มข้อมูลหลักเกณฑ์การบริหารและพัฒนาทรัพยากรบุคคล</h4>
            <form action=" <?php echo site_url('operation_cdm_backend/add'); ?> " method="post" class="form-horizontal" enctype="multipart/form-data">
                <br>
                <div class="form-group row">
                    <div class="col-sm-3 control-label">หัวข้อ <span class="red-add">*</span></div>
                    <div class="col-sm-5">
                        <select class="form-control" name="operation_cdm_ref_id" required>
                            <option value="">เลือกข้อมูล</option>
                            <?php foreach ($rs_type as $rs) { ?>
                                <option value="<?php echo $rs->operation_cdm_type_id; ?>"><?php echo $rs->operation_cdm_type_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-3 control-label">เรื่อง <span class="red-add">*</span></div>
                    <div class="col-sm-9">
                        <input type="text" name="operation_cdm_name" id="operation_cdm_name" class="form-control" required>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-3 control-label">รายละเอียด</div>
                    <div class="col-sm-9">
                        <textarea name="operation_cdm_detail" id="operation_cdm_detail"></textarea>
                        <script>
                            ClassicEditor
                                .create(document.querySelector('#operation_cdm_detail'), {
                                    toolbar: {
                                        items: [
                                            'undo', 'redo',
                                            '|', 'heading',
                                            '|', 'fontFamily', 'fontSize', 'fontColor', 'fontBackgroundColor',
                                            '|', 'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
                                            '|', 'alignment',
                                            '|', 'bulletedList', 'numberedList', 'todoList',
                                            '|', 'insertTable', 'horizontalLine',
                                            '|', 'removeFormat', 'insertImage', 'insertVideo', 'insertFile',
                                            '|', 'undo', 'redo'
                                        ]
                                    },
                                    shouldNotGroupWhenFull: true
                                })
                                .catch(error => {
                                    console.error(error);
                                });
                        </script>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-3 control-label">วันที่อัพโหลด <span class="red-add">*</span></div>
                    <div class="col-sm-5">
                        <input type="datetime-local" name="operation_cdm_date" id="operation_cdm_date" class="form-control" required>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-3 control-label">ไฟล์เอกสารเพิ่มเติม</div>
                    <div class="col-sm-6">
                        <input type="file" name="operation_cdm_file_pdf[]" class="form-control" accept="application/pdf" multiple>
                        <span class="black-add">สามารถอัพโหลดได้หลายไฟล์</span>
                        <br>
                        <span class="red-add">(เฉพาะไฟล์ PDF)</span>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-3 control-label"></div>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                        <a class="btn btn-danger" onclick="goBack()" role="button">ยกเลิก</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>