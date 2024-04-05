<!-- Include Bootstrap CSS and JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- awesome  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<!-- Add Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<!-- reCAPTCHA2  -->
<script src="https://www.google.com/recaptcha/api.js?hl=th"></script>

<!-- chart พาย  -->
<script src="<?= base_url('asset/'); ?>rpie.js"></script>

<!-- ใช้ JavaScript ของ Swiper -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- ใช้ JavaScript ของ Slick Carousel  -->
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<!-- sweetalert 2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // กดปุ่มแล้วเปลี่ยนสี navbar กลาง *********************************************************************
    $(document).ready(function() {
        var buttons = $('.dropdown-trigger');

        buttons.on('click', function() {
            // ลบ class 'active-button' จาก button ทั้งหมด
            buttons.removeClass('active-button').addClass('inactive-button');

            // เพิ่ม class 'active-button' ที่ถูกคลิก
            $(this).removeClass('inactive-button').addClass('active-button');
        });

        // เพิ่มเหตุการณ์ click สำหรับ document เพื่อลบ class 'active-button' จาก button ทั้งหมด
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.dropdown-trigger').length) {
                buttons.removeClass('active-button').addClass('inactive-button');
            }
        });
    });

    // ปุ่มย้อนกลับของยกเลิก *********************************************************************
    function goBack() {
        window.history.back();
    }
    // **************************************************************************************
    // เมื่อ reCAPTCHA ผ่านการตรวจสอบหน้า home ************************************
    function enableLoginButton() {
        document.getElementById("loginBtn").removeAttribute("disabled");
    }
    // ****************************************************************************

    // ตัวเลื่อนด้านล่างสุด หน้า home ******************************************************
    $(document).ready(function() {
        $(".slick-carousel").slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 5000,
            arrows: true,
            prevArrow: '<img src="docs/k.pre-travel.png" class="slick-prev">',
            nextArrow: '<img src="docs/k.next-travel.png" class="slick-next">'
        });
    });

    $(document).ready(function() {
        $(".slick-carousel-otop").slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 5000,
            arrows: true,
            prevArrow: '<img src="docs/k.pre-travel.png" class="slick-prev-otop">',
            nextArrow: '<img src="docs/k.next-travel.png" class="slick-next-otop">',
            // centerPadding: '0', // ตั้งค่าเป็น '0' หรือค่าบวกที่เหมาะสม
            // variableWidth: true // ปรับความกว้างของภาพตามขนาด
        });
    });
    // ****************************************************************************

    // กดแล้วเปลี่ยนหน้า *******************************************************

    // เพิ่ม event listener สำหรับการเลือกประเภทของการร้องเรียน
    $(document).ready(function() {
        // เพิ่ม event listener สำหรับการเลือกประเภทของการร้องเรียน
        $('#ChangPagesComplain').change(function() {
            var selectedValue = $(this).val();
            console.log('Selected Value:', selectedValue);

            // ทำการ redirect ไปยัง URL ที่ต้องการ
            if (selectedValue) {
                var controllerUrl = ''; // URL ที่ต้องการไป
                switch (selectedValue) {
                    case 'corruption':
                        controllerUrl = '<?php echo site_url('Pages/adding_corruption'); ?>';
                        break;
                    case 'suggestions':
                        controllerUrl = '<?php echo site_url('Pages/adding_suggestions'); ?>';
                        break;
                    case 'complain':
                        controllerUrl = '<?php echo site_url('Pages/adding_complain'); ?>';
                        break;
                    case 'follow-complain':
                        controllerUrl = '<?php echo site_url('Pages/follow_complain'); ?>';
                        break;
                    case 'esv_ods':
                        controllerUrl = '<?php echo site_url('Pages/adding_esv_ods'); ?>';
                        break;
                }

                console.log('Controller URL:', controllerUrl);

                if (controllerUrl) {
                    window.location.href = controllerUrl;
                }
            }
        });
    });
    // ****************************************************************************

    // แสดงรูปภาพใหญ่ *******************************************************
    $(function() {
        "use strict";

        $(".popup img").click(function() {
            var $src = $(this).attr("src");
            $(".show").fadeIn();
            $(".img-show img").attr("src", $src);
        });

        $("span, .overlay").click(function() {
            $(".show").fadeOut();
        });

    });

    // JavaScript to adjust popup position on scroll
    document.addEventListener('scroll', function() {
        var imgShow = document.querySelector('.show .img-show');
        imgShow.style.top = window.innerHeight / 2 + window.scrollY + 'px';
    });

    // ****************************************************************************




    // function setScale() {
    //     const screenWidth = window.innerWidth;
    //     const mainElement = document.querySelector('main');

    //     if (screenWidth <= 768) {
    //         mainElement.style.transform = 'scale(0.22)';
    //     } else if (screenWidth > 768 && screenWidth <= 1420) {
    //         mainElement.style.transform = 'scale(0.67)';
    //     } else if (screenWidth > 1421 && screenWidth <= 1520) {
    //         mainElement.style.transform = 'scale(0.72)';
    //     } else {
    //         mainElement.style.transform = 'scale(1)';
    //     }
    // }
    // window.addEventListener('load', setScale);
    // window.addEventListener('resize', setScale);

    // ฟังก์ชันนี้จะถูกเรียกเมื่อคลิกที่ปุ่ม "แสดงผล"
    function showContentLikeDetail() {
        var contentDetail = document.querySelector('.content-like-detail');

        if (contentDetail) {
            // กำหนดให้ถ้าซ่อนอยู่ให้แสดง และถ้าแสดงอยู่ให้ซ่อน
            contentDetail.style.display = contentDetail.style.display === 'none' ? 'block' : 'none';
            // // แสดง div ที่ถูกซ่อนไว้
            // contentDetail.style.display = 'block';
        }
    }

    // navmid กดแล้วเปลี่ยนรูปภาพ *******************************************************

    // $(document).ready(function() {
    //     // เมื่อคลิกปุ่ม dropdown
    //     $('.dropdown-trigger').click(function() {
    //         // ถ้าปุ่มที่ถูกคลิกไม่มี class 'active' ให้ทำการลบ class 'active' จากทุก dropdown-trigger
    //         if (!$(this).hasClass('active')) {
    //             $('.dropdown-trigger').removeClass('active');

    //             // เปลี่ยนรูปภาพทุก dropdown-trigger เป็นรูปปกติ
    //             $('.dropdown-trigger img').attr('src', function() {
    //                 return $(this).attr('src').replace('-hover.png', '.png');
    //             });

    //             // เปลี่ยนรูปภาพของ dropdown-trigger ที่ถูกคลิกเป็นรูป active
    //             $(this).find('img').attr('src', function() {
    //                 return $(this).attr('src').replace('.png', '-hover.png');
    //             });
    //         }
    //     });

    //     // เมื่อคลิกที่ส่วนอื่นของหน้าเว็บ
    //     $(document).click(function(event) {
    //         // ถ้าคลิกที่ส่วนที่ไม่ใช่ dropdown-trigger ให้ลบ class 'active' และเปลี่ยนรูปภาพทุก dropdown-trigger เป็นรูปปกติ
    //         if (!$(event.target).closest('.dropdown-trigger').length) {
    //             $('.dropdown-trigger').removeClass('active');
    //             $('.dropdown-trigger img').attr('src', function() {
    //                 return $(this).attr('src').replace('-hover.png', '.png');
    //             });
    //         }
    //     });
    // });
    // *****************************************************************************


    // news ข่าว tab-link *******************************************************
    $(document).ready(function() {
        // เรียกใช้ฟังก์ชัน openTab เพื่อให้ Tab 1 เป็น active ทันทีหลังจากโหลดหน้าเว็บ
        openTab('tab1');
    });

    function openTab(tabId) {
        // ซ่อนทุก tab-content ทุกตัว
        $('.tab-content').hide();

        // แสดง tab-content ที่ถูกคลิก
        $('#' + tabId).show();

        // ทำการเปลี่ยนรูปภาพทุก tab-link เป็นรูปปกติ
        $('.tab-link img').each(function() {
            $(this).attr('src', $(this).attr('src').replace('-hover.png', '.png'));
        });

        // ทำการเปลี่ยนรูปภาพของ tab-link ที่ถูกคลิกเป็นรูป active
        $('.tab-link[onclick="openTab(\'' + tabId + '\')"] img').attr('src', function(_, oldSrc) {
            return oldSrc.replace('.png', '-hover.png');
        });
    }

    $(document).ready(function() {
        // เรียกใช้ฟังก์ชัน openTabTwo เพื่อให้ Tab 1 เป็น active ทันทีหลังจากโหลดหน้าเว็บ
        openTabTwo('tabtwo1');
    });

    function openTabTwo(tabId) {
        // ซ่อนทุก tab-content-two ทุกตัว
        $('.tab-content-two').hide();

        // แสดง tab-content-two ที่ถูกคลิก
        $('#' + tabId).show();

        // ทำการเปลี่ยนรูปภาพทุก tab-link เป็นรูปปกติ
        $('.tab-link-two img').each(function() {
            $(this).attr('src', $(this).attr('src').replace('-hover.png', '.png'));
        });

        // ทำการเปลี่ยนรูปภาพของ tab-link ที่ถูกคลิกเป็นรูป active
        $('.tab-link-two[onclick="openTabTwo(\'' + tabId + '\')"] img').attr('src', function(_, oldSrc) {
            return oldSrc.replace('.png', '-hover.png');
        });
    }
    // *****************************************************************************

    // navbar กิจกรรม / ผลงาน *******************************************************
    $(document).ready(function() {
        $('.dropdown-trigger').each(function() {
            var dropdownTrigger = $(this);
            var dropdownContent = dropdownTrigger.next(); // Assuming the dropdown is a sibling element

            dropdownTrigger.on('click', function() {
                if (dropdownContent.css('display') === 'block') {
                    dropdownContent.css('display', 'none');
                } else {
                    dropdownContent.css('display', 'block');
                }
            });

            $(document).on('click', function(e) {
                if (!dropdownContent.is(e.target) && !dropdownTrigger.is(e.target) && dropdownContent.has(e.target).length === 0 && dropdownTrigger.has(e.target).length === 0) {
                    dropdownContent.css('display', 'none');
                }
            });
        });
    });

    // *****************************************************************************

    // navbar คลิกแล้วเปลี่ยนรูปภาพ  *******************************************************
    function changeImage(src) {
        var img = event.target || event.srcElement;
        img.src = src;
    }

    function restoreImage(src) {
        var img = event.target || event.srcElement;
        img.src = src;
    }

    // ความพึงพอใจเว็บ กดไลค์ like
    $(document).ready(function() {
        $('#confirmButton').click(function() {
            // แสดงส่วนที่คุณต้องการ
            $('#submitSection').show();
            // ซ่อนปุ่ม "ยืนยัน"
            $(this).hide();
        });
    });

    // เมื่อ reCAPTCHA ผ่านการตรวจสอบ
    function enableSubmit() {
        document.getElementById("SubmitLike").removeAttribute("disabled");
    }

    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 4,
        grid: {
            rows: 2,
        },
        spaceBetween: 30,
        navigation: {
            nextEl: '.custom-button-next',
            prevEl: '.custom-button-prev',
        },
        autoplay: {
            delay: 4000, // ระยะเวลาในการเลื่อนระหว่างภาพ (มีหน่วยเป็นมิลลิวินาที)
            disableOnInteraction: false, // ถ้ามีการแสดงผลหรือควบคุมเลื่อนด้วยตัวเอง ให้ทำให้เลื่อนอัตโนมัติถูกระงับ
        },
    });

    // หากคุณใช้ JavaScript เพื่อกำหนดตำแหน่ง
    var customButtonPrev = document.querySelector('.custom-button-prev');
    var customButtonNext = document.querySelector('.custom-button-next');


    $(document).ready(function() {
        <?php if ($this->session->flashdata('save_success')) { ?>
            Swal.fire({
                // position: 'center',
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
                // position: 'center',
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

    function closeImageSlideMid() {
        document.querySelector('.image-slide-stick-mid').style.display = 'none';
    }
</script>