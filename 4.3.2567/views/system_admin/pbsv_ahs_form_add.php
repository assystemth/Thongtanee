<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-7">
            <h4>เพิ่มข้อมูลหลักประกันสุขภาพตำบลกาเกาะ</h4>
            <form action=" <?php echo site_url('pbsv_ahs_backend/add'); ?> " method="post" class="form-horizontal" enctype="multipart/form-data">
                <br>
                <div class="form-group row">
                    <div class="col-sm-3 control-label">เรื่อง</div>
                    <div class="col-sm-9">
                        <input type="text" name="pbsv_ahs_name" id="pbsv_ahs_name" class="form-control" required>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-3 control-label">รายละเอียด</div>
                    <div class="col-sm-9">
                        <textarea name="pbsv_ahs_detail" id="pbsv_ahs_detail"></textarea>
                        <script>
                            ClassicEditor
                                .create(document.querySelector('#pbsv_ahs_detail'), {
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
                    <div class="col-sm-3 control-label">วันที่อัพโหลด</div>
                    <div class="col-sm-5">
                        <input type="datetime-local" name="pbsv_ahs_date" id="pbsv_ahs_date" class="form-control" required>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-3 control-label">ลิงค์เพิ่มเติม</div>
                    <div class="col-sm-9">
                        <input type="text" name="pbsv_ahs_link" id="pbsv_ahs_link" class="form-control">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-3 control-label">รูปภาพหน้าปก</div>
                    <div class="col-sm-6">
                        <input type="file" name="pbsv_ahs_img" class="form-control" accept="image/*">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-3 control-label">รูปภาพเพิ่มเติม</div>
                    <div class="col-sm-6">
                        <input type="file" name="pbsv_ahs_img_img[]" class="form-control" accept="image/*" multiple>
                        <span class="black-add">สามารถอัพโหลดได้หลายไฟล์</span>
                        <br>
                        <span class="red-add">(เฉพาะไฟล์ .JPG/.JPEG/.PNG)</span>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-3 control-label">ไฟล์เอกสารเพิ่มเติม</div>
                    <div class="col-sm-6">
                        <input type="file" name="pbsv_ahs_file_pdf[]" class="form-control" accept="application/pdf" multiple>
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
                        <a class="btn btn-danger" href="<?= site_url('pbsv_ahs_backend'); ?>" role="button">ยกเลิก</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>