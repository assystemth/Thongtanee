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

<script>
  // คำหยาบ vulgar **********************************
  $(document).ready(function() {
    // เมื่อคลิกปุ่ม "จัดการ"
    $(".popup-insert").click(function() {
      var target = $(this).data("target");
      $(target).show();
    });

    // เมื่อคลิกปุ่ม "ยกเลิก"
    $(".cancel-button").click(function() {
      var target = $(this).data("target");
      $(target).hide();
    });
  });

  // ***************************************************

  document.addEventListener("DOMContentLoaded", function() {
    var currentPage = '<?php echo current_url(); ?>';
    var navbarLinks = document.querySelectorAll('.navbar-link');

    navbarLinks.forEach(function(link) {
      var linkHref = link.getAttribute('href');
      var linkImageSrc = link.getAttribute('data-image-src');

      // ตรวจสอบว่า URL ของลิงก์ตรงกับหน้าที่กำลังใช้งานหรือไม่
      if (currentPage.includes(linkHref)) {
        link.classList.add('active');
        changeImage(linkImageSrc, link);
      }

      // เพิ่ม Event Listener เพื่อตรวจสอบการคลิกทุกรายการ
      link.addEventListener('click', function(event) {
        navbarLinks.forEach(function(innerLink) {
          innerLink.classList.remove('active');
        });

        link.classList.add('active');
        changeImage(linkImageSrc, link);
      });
    });
  });

  function changeImage(src, link) {
    var img = link.querySelector('img');
    img.src = src;
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
</script>