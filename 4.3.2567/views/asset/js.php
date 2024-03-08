<!-- Include Bootstrap CSS and JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!-- sweetalert 2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- sb-admin-2 -->
<!-- Bootstrap core JavaScript-->
<script src="<?= base_url(); ?>vendor/jquery/jquery.min.js"></script>
<!-- <script src="<?= base_url(); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

<!-- Core plugin JavaScript-->
<script src="<?= base_url(); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('asset/'); ?>js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<!-- <script src="<?= base_url(); ?>vendor/chart.js/Chart.min.js"></script> -->

<!-- Page level custom scripts -->
<!-- <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script> -->

<!-- Page level plugins -->
<script src="<?= base_url(); ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('asset/'); ?>js/demo/datatables-demo.js"></script>

<!-- Bootstrap core JavaScript-->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    // ปุ่มย้อนกลับของยกเลิก *********************************************************************
    function goBack() {
        window.history.back();
    }
    // **************************************************************************************

    //  เมนูเปิดปิดการแสดงผล navbar **************************************************************
    function toggleCollapse(collapseId) {
        var collapseElement = document.getElementById(collapseId);
        if (collapseElement.classList.contains('show')) {
            collapseElement.classList.remove('show');
        } else {
            collapseElement.classList.add('show');
        }
    }
    // **************************************************************************************

    //  เมนูค้นหา navbar **************************************************************
    function search() {
        var input = document.querySelector('.search-box input').value.toLowerCase();
        var menuList = document.getElementById('menuList');

        var listItems = menuList.getElementsByTagName('li');

        for (var i = 0; i < listItems.length; i++) {
            var listItem = listItems[i];
            var linkText = listItem.textContent.toLowerCase();

            if (input === "" || linkText.includes(input)) {
                listItem.classList.remove('hide');
            } else {
                listItem.classList.add('hide');
            }
        }

        // เพิ่มเงื่อนไขนี้เพื่อซ่อน <ul> ทั้งหมด เมื่อไม่มีการค้นหา
        if (input === "") {
            menuList.classList.add('hide');
        } else {
            menuList.classList.remove('hide');
        }
    }
    // **************************************************************************************

    // Function เพื่อตรวจสอบรหัสผ่านว่าตรงกันหรือไม่
    function checkPassword(form) {
        var password1 = form.password1.value;
        var password2 = form.password2.value;

        // ถ้าช่องรหัสผ่านไม่ถูกกรอก
        if (password1 === '') {
            alert("Please enter Password");
            return false;
        }

        // ถ้าช่องยืนยันรหัสผ่านไม่ถูกกรอก
        else if (password2 === '') {
            alert("Please enter confirm password");
            return false;
        }

        // ถ้าทั้งสองช่องไม่ตรงกัน ให้แจ้งผู้ใช้ และ return false
        else if (password1 !== password2) {
            alert("Password did not match: Please try again...");
            return false;
        }

        // ถ้าทั้งสองช่องตรงกัน return true
        else {
            alert("Password Match: Welcome to Mindphp!");
            return true;
        }
    }
    // ******************************************************************


    // เปิด-ปิด รหัสผ่าน *********************************************************
    function swapPasswordType() {
        var passwordInput = document.getElementById("m_password");

        // เปลี่ยนประเภทของ Input จาก text เป็น password หรือ ngượcกัน
        passwordInput.type = (passwordInput.type === "password") ? "text" : "password";
    }

    function swapPasswordTypeConfirm() {
        var passwordInput = document.getElementById("confirm_password");

        // เปลี่ยนประเภทของ Input จาก text เป็น password หรือ ngượcกัน
        passwordInput.type = (passwordInput.type === "password") ? "text" : "password";
    }
    // ******************************************************************

    // คำหยาบ questions *************************************************
    $(document).ready(function() {
        // เมื่อคลิกปุ่ม "จัดการ"
        $(".insert-questions-btn").click(function() {
            var target = $(this).data("target");
            $(target).show();
        });

        // เมื่อคลิกปุ่ม "ปิด"
        $(".close-button").click(function() {
            var target = $(this).data("target");
            $(target).hide();
        });
    });
    // ******************************************************************

    //member จังหวัด ******************************************************
    $(document).ready(function() {
        $('#province').change(function() {
            var province_name = $(this).val();
            $.ajax({
                url: "<?php echo site_url('member_backend/get_amphurs'); ?>",
                method: "POST",
                data: {
                    province_name: province_name
                },
                dataType: 'json',
                success: function(data) {
                    $('#amphur').html('<option value="">เลือกอำเภอ</option>');
                    $('#tambol').html('<option value="">เลือกตำบล</option>'); // เพิ่มส่วนนี้

                    $.each(data, function(key, value) {
                        $('#amphur').append('<option value="' + value.tambol_aname + '">' + value.tambol_aname + '</option>');
                    });
                }
            });
        });

        $('#amphur').change(function() { // เพิ่มส่วนนี้
            var province_name = $('#province').val();
            var amphur_name = $(this).val();
            $.ajax({
                url: "<?php echo site_url('member_backend/get_tambols'); ?>",
                method: "POST",
                data: {
                    province_name: province_name,
                    amphur_name: amphur_name
                },
                dataType: 'json',
                success: function(data) {
                    $('#tambol').html('<option value="">เลือกตำบล</option>');

                    $.each(data, function(key, value) {
                        $('#tambol').append('<option value="' + value.tambol_tname + '">' + value.tambol_tname + '</option>');
                    });
                }
            });
        });
    });

    // ***************************************************

    //personnel *********************************************
    $(document).ready(function() {
        // เมื่อเลือก "แผนก" ใน dropdown "personnelGroup"
        $('#personnelGroup').change(function() {
            var selectedGroup = $(this).val();
            if (selectedGroup) {
                // ใช้ AJAX เรียกข้อมูล "ส่วนงาน" จาก Controller
                $.ajax({
                    url: '<?php echo site_url('personnel/get_departments'); ?>',
                    type: 'post',
                    data: {
                        group_name: selectedGroup
                    },
                    dataType: 'json',
                    success: function(data) {
                        // เมื่อได้ข้อมูล "ส่วนงาน" ให้เพิ่มลงใน dropdown "personnelDepartment"
                        $('#personnelDepartment').html('<option value="">เลือกส่วนงาน</option>');
                        $.each(data, function(key, value) {
                            $('#personnelDepartment').append('<option value="' + value.pgroup_dname + '">' + value.pgroup_dname + '</option>');
                        });
                    }
                });
            } else {
                // ถ้าไม่มีการเลือก "แผนก" ให้ล้าง dropdown "personnelDepartment"
                $('#personnelDepartment').html('<option value="">เลือกส่วนงาน</option>');
            }
        });
    });


    $(document).ready(function() {
        // เมื่อเลือก "แผนก" ใน dropdown "personnelGroup"
        $('#personnelGroup').change(function() {
            var selectedGroup = $(this).val();
            if (selectedGroup) {
                // ใช้ AJAX เรียกข้อมูล "ส่วนงาน" จาก Controller
                $.ajax({
                    url: '<?php echo site_url('personnelSuper/get_departments'); ?>',
                    type: 'post',
                    data: {
                        group_name: selectedGroup
                    },
                    dataType: 'json',
                    success: function(data) {
                        // เมื่อได้ข้อมูล "ส่วนงาน" ให้เพิ่มลงใน dropdown "personnelDepartment"
                        $('#personnelDepartment').html('<option value="">เลือกส่วนงาน</option>');
                        $.each(data, function(key, value) {
                            $('#personnelDepartment').append('<option value="' + value.pgroup_dname + '">' + value.pgroup_dname + '</option>');
                        });
                    }
                });
            } else {
                // ถ้าไม่มีการเลือก "แผนก" ให้ล้าง dropdown "personnelDepartment"
                $('#personnelDepartment').html('<option value="">เลือกส่วนงาน</option>');
            }
        });
    });


    $(document).ready(function() {
        // เมื่อเลือก "แผนก" ใน dropdown "personnelGroup"
        $('#personnelGroup').change(function() {
            var selectedGroup = $(this).val();
            if (selectedGroup) {
                // ใช้ AJAX เรียกข้อมูล "ส่วนงาน" จาก Controller
                $.ajax({
                    url: '<?php echo site_url('personnelApprove/get_departments'); ?>',
                    type: 'post',
                    data: {
                        group_name: selectedGroup
                    },
                    dataType: 'json',
                    success: function(data) {
                        // เมื่อได้ข้อมูล "ส่วนงาน" ให้เพิ่มลงใน dropdown "personnelDepartment"
                        $('#personnelDepartment').html('<option value="">เลือกส่วนงาน</option>');
                        $.each(data, function(key, value) {
                            $('#personnelDepartment').append('<option value="' + value.pgroup_dname + '">' + value.pgroup_dname + '</option>');
                        });
                    }
                });
            } else {
                // ถ้าไม่มีการเลือก "แผนก" ให้ล้าง dropdown "personnelDepartment"
                $('#personnelDepartment').html('<option value="">เลือกส่วนงาน</option>');
            }
        });
    });
    // ***************************************************


    function showSubmenu(submenuId) {
        var submenu = document.getElementById(submenuId);
        submenu.style.display = "block";

        // ซ่อน ul.logout
        var logoutMenu = document.querySelector(".logout");
        logoutMenu.style.display = "none";
    }

    function hideSubmenu(submenuId) {
        var submenu = document.getElementById(submenuId);
        submenu.style.display = "none";

        // แสดง ul.logout อีกครั้ง
        var logoutMenu = document.querySelector(".logout");
        logoutMenu.style.display = "block";
    }

    $(document).ready(function() {
        <?php if ($this->session->flashdata('save_success')) { ?>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'บันทึกข้อมูลสำเร็จ',
                showConfirmButton: false,
                timer: 1500
            })
        <?php } ?>
    });

    $(document).ready(function() {
        <?php if ($this->session->flashdata('save_error')) { ?>
            Swal.fire({
                icon: 'error',
                title: 'ตรวจพบปัญหา',
                text: 'หน่วยความจำของท่าเต็ม!',
                footer: '<a href="#">ติดต่อผู้ดูแลระบบ?</a>'
            })
        <?php } ?>
    });

    $(document).ready(function() {
        <?php if ($this->session->flashdata('save_maxsize')) { ?>
            Swal.fire({
                icon: 'error',
                title: 'ตรวจพบปัญหา',
                text: 'ขนาดรูปภาพต้องไม่เกิน 1.5MB!',
                footer: '<a href="#">ติดต่อผู้ดูแลระบบ?</a>'
            })
        <?php } ?>
    });

    $(document).ready(function() {
        <?php if ($this->session->flashdata('del_success')) { ?>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'ลบข้อมูลสำเร็จ',
                showConfirmButton: false,
                timer: 1500
            })
        <?php } ?>
    });

    $(document).ready(function() {
        <?php if ($this->session->flashdata('save_again')) { ?>
            Swal.fire({
                icon: 'warning',
                title: 'ตรวจพบปัญหา',
                text: 'มีข้อมูลอยู่แล้ว!',
                footer: '<a href="#">ติดต่อผู้ดูแลระบบ?</a>'
            })
        <?php } ?>
    });

    $(document).ready(function() {
        <?php if ($this->session->flashdata('password_mismatch')) { ?>
            Swal.fire({
                icon: 'warning',
                title: 'ตรวจพบปัญหา',
                text: 'รหัสผ่านไม่ตรงกัน!',
                footer: '<a href="#">ติดต่อผู้ดูแลระบบ?</a>'
            })
        <?php } ?>
    });

    // คอมเม้น comment 
    $(document).ready(function() {
        // ให้ทำงานเมื่อคลิกที่ปุ่ม "แสดงความคิดเห็นตอบกลับ"
        $('.show-reply-btn').on('click', function() {
            // ให้หาความคิดเห็นตอบกลับที่อยู่ในแถวปัจจุบัน
            var $commentRow = $(this).closest('.comment-row');
            var $replyRow = $commentRow.nextUntil('.comment-row', '.reply-row');

            // ถ้าแถวความคิดเห็นตอบกลับยังไม่แสดง
            if ($replyRow.is(':hidden')) {
                $replyRow.show(); // แสดงแถวความคิดเห็นตอบกลับ
            } else {
                $replyRow.hide(); // ซ่อนแถวความคิดเห็นตอบกลับ
            }
        });
    });

    // ปุ่มค้นหาคอมเม้น search comment
    $(document).ready(function() {
        $('#searchButton').click(function() {
            var searchTerm = $('#searchInput').val().toLowerCase();
            if (searchTerm === "") {
                // ถ้าไม่ได้ป้อนคำค้นหา ให้แสดงข้อมูลทั้งหมด
                $('tr.comment-row').show();
            } else {
                // ถ้ามีคำค้นหา ให้ซ่อนแถวที่ไม่ตรง
                $('tr.comment-row').each(function() {
                    var commentText = $(this).find('.limited-text').text().toLowerCase();
                    if (commentText.indexOf(searchTerm) === -1) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                });
            }
        });
    });

    //report_user ******************************************************
    function toggleTable(id) {
        // ซ่อนทุกตารางย่อยทั้งหมด
        var subTables = document.querySelectorAll('.card');
        for (var i = 0; i < subTables.length; i++) {
            subTables[i].style.display = 'none';
        }

        // แสดงตารางที่ถูกคลิก
        var tableToShow = document.getElementById(id);
        tableToShow.style.display = 'block';
    }

    function scrollToTable(id) {
        var target = document.getElementById(id);
        if (target) {
            target.style.display = 'block';
            var offsetTop = target.offsetTop;
            window.scrollTo(0, offsetTop);
        }
    }

    // ***************************************************

    // ปุ่มกดหน้าเรื่องร้องเรียน **********************************
    $(document).ready(function() {
        // ซ่อนทุกปุ่ม "จัดการ"
        $(".update-complain-btn").hide();

        // แสดงปุ่ม "จัดการ" เฉพาะในแถวล่าสุด
        $(".data-row:last .update-complain-btn").show();

        // ถ้าสถานะเป็น "ยกเลิก" หรือ "แก้ไขเรียบร้อย" ให้ซ่อนปุ่มทันที
        $(".data-row").each(function() {
            var status = $(this).find(".complain_status").text().trim(); // แสดงสถานะจากข้อมูลและลบช่องว่างด้านหลังและด้านหน้า
            if (status === 'ยกเลิก' || status === 'แก้ไขเรียบร้อย') {
                $(this).find(".manage-button").hide();
            }
        });
    });

    $(document).ready(function() {
        // เมื่อคลิกปุ่ม "จัดการ"
        $(".update-complain-btn").click(function() {
            var target = $(this).data("target");
            $(target).show();
        });

        // เมื่อคลิกปุ่ม "ปิด"
        $(".close-button").click(function() {
            var target = $(this).data("target");
            $(target).hide();
        });
    });

    $(document).ready(function() {
        // เมื่อคลิกปุ่ม "จัดการ"
        $(".cancel-complain-btn").click(function() {
            var target = $(this).data("target");
            $(target).show();
        });

        // เมื่อคลิกปุ่ม "ปิด"
        $(".close-button").click(function() {
            var target = $(this).data("target");
            $(target).hide();
        });
    });
    // ***************************************************

    // คำหยาบ vulgar **********************************
    $(document).ready(function() {
        // เมื่อคลิกปุ่ม "จัดการ"
        $(".insert-vulgar-btn").click(function() {
            var target = $(this).data("target");
            $(target).show();
        });

        // เมื่อคลิกปุ่ม "ปิด"
        $(".close-button").click(function() {
            var target = $(this).data("target");
            $(target).hide();
        });
    });
    // ***************************************************


    // เพิ่มไฟล์ทีละไฟล์
    function toggleFiles() {
        var file2 = document.getElementById("doc_file2");
        var file3 = document.getElementById("doc_file3");

        if (file2.style.display === "none") {
            file2.style.display = "block";
        } else {
            file3.style.display = "block";
        }
    }
    // ***************************************************

    // ลบไฟล์ทีละไฟล์
    document.addEventListener("DOMContentLoaded", function() {
        const deleteLinks = document.querySelectorAll(".delete-file");

        deleteLinks.forEach(function(link) {
            link.addEventListener("click", function(event) {
                event.preventDefault();
                const fieldName = this.getAttribute("data-field");
                const fileInput = document.querySelector(`input[name="${fieldName}"]`);
                const hiddenInput = document.querySelector(`input[name="${fieldName}_hidden"]`);

                // Clear file input and update hidden input
                fileInput.value = "";
                hiddenInput.value = "";
            });
        });
    });
    // ***************************************************

    // ตาราง table ***************************************
    $(document).ready(function() {
        var thaiLanguage = {
            "emptyTable": "ไม่มีข้อมูลในตาราง",
            "info": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
            "infoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
            "infoThousands": ",",
            "lengthMenu": "แสดง _MENU_ แถว",
            "loadingRecords": "กำลังโหลดข้อมูล...",
            "processing": "กำลังดำเนินการ...",
            "zeroRecords": "ไม่พบข้อมูล",
            "paginate": {
                "first": "หน้าแรก",
                "previous": "ก่อนหน้า",
                "next": "ถัดไป",
                "last": "หน้าสุดท้าย"
            },
            "aria": {
                "sortAscending": ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
                "sortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
            },
            "autoFill": {
                "cancel": "ยกเลิก",
                "fill": "กรอกทุกช่องด้วย",
                "fillHorizontal": "กรอกตามแนวนอน",
                "fillVertical": "กรอกตามแนวตั้ง"
            },
            "buttons": {
                "collection": "ชุดข้อมูล",
                "colvis": "การมองเห็นคอลัมน์",
                "colvisRestore": "เรียกคืนการมองเห็น",
                "copy": "คัดลอก",
                "copyKeys": "กดปุ่ม Ctrl หรือ Command + C เพื่อคัดลอกข้อมูลบนตารางไปยัง Clipboard ที่เครื่องของคุณ",
                "copySuccess": {
                    "_": "คัดลอกช้อมูลแล้ว จำนวน %ds แถว",
                    "1": "คัดลอกข้อมูลแล้ว จำนวน 1 แถว"
                },
                "copyTitle": "คัดลอกไปยังคลิปบอร์ด",
                "csv": "CSV",
                "excel": "Excel",
                "pageLength": {
                    "_": "แสดงข้อมูล %d แถว",
                    "-1": "แสดงข้อมูลทั้งหมด"
                },
                "pdf": "PDF",
                "print": "สั่งพิมพ์",
                "createState": "สร้างสถานะ",
                "removeAllStates": "ลบสถานะทั้งหมด",
                "removeState": "ลบสถานะ",
                "renameState": "เปลี่ยนชื่อสถานะ",
                "savedStates": "บันทึกสถานะ",
                "stateRestore": "คืนค่าสถานะ",
                "updateState": "แก้ไขสถานะ"
            },
            "infoEmpty": "แสดงทั้งหมด 0 to 0 of 0 รายการ",
            "search": "ค้นหา :",
            "thousands": ",",
            "datetime": {
                "amPm": [
                    "เที่ยงวัน",
                    "เที่ยงคืน"
                ],
                "hours": "ชั่วโมง",
                "minutes": "นาที",
                "months": {
                    "0": "มกราคม",
                    "1": "กุมภาพันธ์",
                    "10": "พฤศจิกายน",
                    "11": "ธันวาคม",
                    "2": "มีนาคม",
                    "3": "เมษายน",
                    "4": "พฤษภาคม",
                    "5": "มิถุนายน",
                    "6": "กรกฎาคม",
                    "7": "สิงหาคม",
                    "8": "กันยายน",
                    "9": "ตุลาคม"
                },
                "next": "ถัดไป",
                "seconds": "วินาที",
                "unknown": "ไม่ทราบ",
                "weekdays": [
                    "วันอาทิตย์",
                    "วันจันทร์",
                    "วันอังคาร",
                    "วันพุธ",
                    "วันพฤหัส",
                    "วันศุกร์",
                    "วันเสาร์"
                ],
                "previous": "ก่อนหน้า"
            },
            "decimal": "จุดทศนิยม",
            "editor": {
                "close": "ปิด",
                "create": {
                    "button": "สร้าง",
                    "submit": "สร้างข้อมูล",
                    "title": "สร้างข้อมูลใหม่"
                },
                "edit": {
                    "button": "แก้ไข",
                    "submit": "บันทึก",
                    "title": "แก้ไขข้อมูล"
                },
                "error": {
                    "system": "เกิดข้อผิดพลาดของระบบ (&lt;a target=\"\\\" rel=\"nofollow\" href=\"\\\"&gt;ดูข้อมูลเพิ่มเติม)."
                },
                "remove": {
                    "button": "ลบ",
                    "submit": "ลบข้อมูล",
                    "title": "ลบข้อมูล",
                    "confirm": {
                        "_": "คุณแน่ใจที่จะลบข้อมูล %d รายการนี้ หรือไม่?",
                        "1": "คุณแน่ใจที่จะลบข้อมูลรายการนี้ หรือไม่?"
                    }
                },
                "multi": {
                    "restore": "ยกเลิกการแก้ไข",
                    "title": "หลายค่า",
                    "info": "รายการที่เลือกมีค่าที่แตกต่างกันสำหรับอินพุตนี้ หากต้องการแก้ไขและตั้งค่ารายการทั้งหมดสำหรับการป้อนข้อมูลนี้เป็นค่าเดียวกัน ให้คลิกหรือแตะที่นี่ มิฉะนั้น รายการเหล่านั้นจะคงค่าแต่ละรายการไว้",
                    "noMulti": "อินพุตนี้สามารถแก้ไขทีละรายการได้ แต่ไม่สามารถแก้ไขเป็นส่วนหนึ่งของกลุ่มได้"
                }
            },
            "searchBuilder": {
                "add": "เพิ่มเงื่อนไข",
                "clearAll": "ยกเลิกทั้งหมด",
                "condition": "เงื่อนไข",
                "data": "ข้อมูล",
                "deleteTitle": "ลบเงื่อนไขการกรอง",
                "logicAnd": "และ",
                "logicOr": "หรือ",
                "button": {
                    "0": "สร้างการค้นหา",
                    "_": "ตัวสร้างการค้นหา (%d)"
                },
                "conditions": {
                    "date": {
                        "after": "ก่อน",
                        "before": "ก่อน",
                        "between": "ระหว่าง",
                        "equals": "เท่ากับ",
                        "not": "ไม่",
                        "notEmpty": "ไม่ใช่ระหว่าง"
                    },
                    "number": {
                        "between": "ระหว่าง",
                        "equals": "เท่ากับ",
                        "gt": "มากกว่า",
                        "gte": "มากกว่าเท่ากับ",
                        "lt": "น้อยกว่า",
                        "lte": "น้อยกว่าเท่ากับ",
                        "not": "ไม่",
                        "notBetween": "ไม่ใช่ระหว่าง"
                    },
                    "string": {
                        "contains": "ประกอบด้วย",
                        "endsWith": "ลงท้ายด้วย",
                        "equals": "เท่ากับ",
                        "not": "ไม่",
                        "startsWith": "เริ่มต้นด้วย",
                        "notContains": "ไม่มี",
                        "notStartsWith": "ไม่เริ่มต้นด้วย",
                        "notEndsWith": "ไม่ลงท้ายด้วย"
                    },
                    "array": {
                        "equals": "เท่ากับ",
                        "contains": "เงื้อนไข",
                        "not": "ไม่"
                    }
                },
                "title": {
                    "0": "สร้างการค้นหา",
                    "_": "ตัวสร้างการค้นหา (%d)"
                },
                "value": "ค่า"
            },
            "select": {
                "cells": {
                    "1": "เลือก 1 cell",
                    "_": "เลือก %d cells"
                },
                "columns": {
                    "1": "เลือก 1 column",
                    "_": "เลือก %d columns"
                }
            },
            "stateRestore": {
                "duplicateError": "มีข้อมูลที่ใช้ชื่อนี้แล้ว",
                "emptyError": "ชื่อต้องไม่เป็นค่าว่าง",
                "emptyStates": "ไม่มีสถานะที่บันทึกไว้",
                "removeConfirm": "คุณแน่ใจหรือไม่ว่าต้องการลบ %s",
                "removeError": "ไม่สามารถลบสถานะ"
            }
        };
        var thaiLanguage = $('#reportTableNews').DataTable(); // ระบุตารางที่ต้องการใช้งาน DataTables
        var thaiLanguage = $('#reportTableActivity').DataTable(); // ระบุตารางที่ต้องการใช้งาน DataTables
        var thaiLanguage = $('#reportTableHealth').DataTable(); // ระบุตารางที่ต้องการใช้งาน DataTables
        var thaiLanguage = $('#reportTableTravel').DataTable(); // ระบุตารางที่ต้องการใช้งาน DataTables
        var thaiLanguage = $('#reportTableFood').DataTable(); // ระบุตารางที่ต้องการใช้งาน DataTables
        var thaiLanguage = $('#reportTableOtop').DataTable(); // ระบุตารางที่ต้องการใช้งาน DataTables
        var thaiLanguage = $('#reportTableStore').DataTable(); // ระบุตารางที่ต้องการใช้งาน DataTables
        var thaiLanguage = $('#reportTableStoreUser').DataTable(); // ระบุตารางที่ต้องการใช้งาน DataTables


        $('#newdataTables').DataTable({
            responsive: true,
            language: thaiLanguage
        });
    });
</script>