<!-- ส่วนทางขวา -->
<div class="flex-item-right-form">
    <div class="form-add">
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-7">
                    <h4 class="black"><b>เพิ่มข้อมูลข่าวประชาสัมพันธ์</b></h4>
                    <form action=" <?php echo site_url('System_intranet/add'); ?> " method="post" class="form-horizontal" enctype="multipart/form-data">
                        <br>
                        <div class="form-group row">
                            <div class="col-sm-2 control-label">เรื่อง</div>
                            <div class="col-sm-9">
                                <input type="text" name="intra_news_topic" required class="form-control">
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-sm-2 control-label">รายละเอียด</div>
                            <div class="col-sm-9">
                                <textarea name="intra_news_detail" id="intra_news_detail"></textarea>
                                <script>
                                    ClassicEditor
                                        .create(document.querySelector('#intra_news_detail'), {
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
                            <div class="col-sm-2 control-label">รูปหน้าปก</div>
                            <div class="col-sm-9">
                                <input type="file" name="intra_news_img" class="form-control" accept="image/*" required>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-sm-2 control-label">รูปภาพเพิ่มเติม</div>
                            <div class="col-sm-9">
                                <input type="file" name="intra_news_img_img[]" class="form-control" accept="image/*" multiple>
                                <span class="black-add">สามารถอัพโหลดได้หลายไฟล์</span>
                                <br>
                                <span class="red-add">(เฉพาะไฟล์ .JPG/.JPEG/.PNG)</span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-sm-2 control-label">ไฟล์เอกสารเพิ่มเติม</div>
                            <div class="col-sm-9">
                                <input type="file" name="intra_news_file_pdf[]" class="form-control" accept="application/pdf" multiple>
                                <span class="black-add">สามารถอัพโหลดได้หลายไฟล์</span>
                                <br>
                                <span class="red-add">(เฉพาะไฟล์ PDF)</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2 control-label"></div>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                                <a class="btn btn-danger" href="<?php echo site_url('System_intranet'); ?>">ยกเลิก</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>