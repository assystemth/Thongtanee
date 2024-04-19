<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-7">
            <h4>แก้ไขข้อมูลหลักเกณฑ์การบริหารและพัฒนาทรัพยากรบุคคล</h4>
            <form action=" <?php echo site_url('operation_cdm_backend/edit/' . $rsedit->operation_cdm_id); ?> " method="post" class="form-horizontal" enctype="multipart/form-data">
                <br>
                <div class="form-group row">
                    <div class="col-sm-3 control-label">หัวข้อ <span class="red-add">*</span></div>
                    <div class="col-sm-9">
                        <select class="form-control" name="operation_cdm_ref_id" required>
                            <option value="<?php echo $rsedit->operation_cdm_ref_id; ?>"><?php echo $rsedit->operation_cdm_type_name; ?></option>
                            <option value="" disabled>เลือกข้อมูล
                                <?php foreach ($rs_type as $rs) { ?>
                            <option value="<?php echo $rs->operation_cdm_type_id; ?>"><?php echo $rs->operation_cdm_type_name; ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-3 control-label">เรื่อง <span class="red-add">*</span></div>
                    <div class="col-sm-9">
                        <input type="text" name="operation_cdm_name" id="operation_cdm_name" class="form-control" value="<?= $rsedit->operation_cdm_name; ?>">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-3 control-label">รายละเอียด</div>
                    <div class="col-sm-9">
                        <textarea name="operation_cdm_detail" id="operation_cdm_detail"><?= $rsedit->operation_cdm_detail; ?></textarea>
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
                        <input type="datetime-local" name="operation_cdm_date" id="operation_cdm_date" class="form-control" value="<?= $rsedit->operation_cdm_date; ?>" required>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-3 control-label">ไฟล์เอกสารเพิ่มเติม</div>
                    <div class="col-sm-6">
                        <?php if (!empty($rsFile)) { ?>
                            <?php foreach ($rsFile as $file) { ?>
                                <a class="btn btn-info btn-sm mb-2" href="<?= base_url('docs/file/' . $file->operation_cdm_file_pdf); ?>" target="_blank">ดูไฟล์ <?= $file->operation_cdm_file_pdf; ?></a>
                                <a class="btn btn-danger btn-sm mb-2" href="#" role="button" onclick="confirmDelete(<?= $file->operation_cdm_file_id; ?>, '<?= $file->operation_cdm_file_pdf; ?>');">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                                    </svg> ลบไฟล์
                                </a>
                                <br>
                            <?php } ?>
                        <?php } ?>
                        <script>
                            function confirmDelete(file_id, file_name) {
                                Swal.fire({
                                    title: 'คุณแน่ใจหรือไม่?',
                                    text: 'คุณต้องการลบไฟล์ ' + file_name + ' ใช่หรือไม่?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'ใช่, ต้องการลบ!',
                                    cancelButtonText: 'ยกเลิก'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // หลังจากคลิกยืนยันให้เรียก Controller ที่ใช้ในการลบไฟล์ PDF
                                        window.location.href = "<?= site_url('operation_cdm_backend/del_pdf/'); ?>" + file_id;
                                    }
                                });
                            }
                        </script>
                        <input type="file" name="operation_cdm_file_pdf[]" class="form-control mt-1" accept="application/pdf" multiple>
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