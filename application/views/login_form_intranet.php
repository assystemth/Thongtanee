<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Design by foolishdeveloper.com -->
    <link rel="icon" href="<?php echo base_url("docs/k.logo.png"); ?>" type="image/x-icon">

    <title>เทศบาลตำบลกาบเชิง ระบบอินทราเน็ต</title>
    <!-- icon -->
    <link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <style media="screen">
        *,
        *:before,
        *:after {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            margin: 0px;
            padding: 0px;
            font-family: 'Kanit', sans-serif;
            font-weight: 300;
            background-color: #080710;

        }

        .background {
            width: 430px;
            height: 520px;
            position: absolute;
            transform: translate(-50%, -50%);
            left: 50%;
            top: 50%;
        }

        .background .shape {
            height: 200px;
            width: 200px;
            position: absolute;
            border-radius: 50%;
        }

        .shape:first-child {
            background: linear-gradient(#1845ad,
                    #23a2f6);
            left: -80px;
            top: -80px;
        }

        .shape:last-child {
            background: linear-gradient(to right,
                    #ff512f,
                    #f09819);
            right: -30px;
            bottom: -80px;
        }

        form {
            height: 534px;
            width: 647px;
            /* background-color: rgba(255, 255, 255, 0.13); */
            background-color: rgba(255, 255, 255, 0.0);
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
            border-radius: 24px;
            backdrop-filter: blur(3px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
            padding: 20px 10px;
        }

        form * {
            font-family: 'Kanit', sans-serif;
            color: white;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }

        form h3 {
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 15px;
            font-size: 16px;
            font-weight: 500;
            margin-left: 20%;
        }

        input {
            display: block;
            height: 50px;
            width: 60%;
            background-color: white;
            /* background-color: rgba(255, 255, 255, 0.25); */
            border-radius: 10px;
            padding: 0 10px;
            font-size: 14px;
            font-weight: 300;
            align-items: center;
            margin-left: 20%;
            color: #979797;
        }

        ::placeholder {
            color: #979797;
        }

        button {
            margin-top: 50px;
            width: 49.5%;
            background-color: #4c97ee;
            color: black;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 15px;
            cursor: pointer;
            margin-left: 20%;
            margin-top: 3%;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            /* เพิ่มเงาด้านล่าง */
        }


        .social {
            margin-top: 30px;
            display: flex;
        }

        .social div {
            background: red;
            width: 150px;
            border-radius: 3px;
            padding: 5px 10px 10px 5px;
            background-color: rgba(255, 255, 255, 0.27);
            color: #eaf0fb;
            text-align: center;
        }

        .social div:hover {
            background-color: rgba(255, 255, 255, 0.47);
        }

        .social .fb {
            margin-left: 25px;
        }

        .social i {
            margin-right: 4px;
        }

        .bg {
            /* The image used */
            background-image: url('<?php echo base_url("docs/k.bg-intranet.jpg"); ?>');
            /* Full height */
            height: 100vh;
            /* Center the image horizontally and vertically */
            background-position: center center;
            /* Do not repeat the background image */
            background-repeat: no-repeat;
            /* Cover the entire div with the background image */
            background-size: cover;
        }

        form h4 {
            font-size: 30px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
        }

        form span {
            display: block;
            /* ทำให้ <span> เป็น block element */
            /* font-size: 25px; */
            text-align: center;
            margin: 0 auto;
            /* จัดตำแหน่งตรงกลางในแนวนอน */
            /* padding: 10px 0; */
            /* เพิ่มการเว้นระยะข้างบนและล่าง */
        }

        form img {
            display: block;
            text-align: center;
            margin: 0 auto;
        }

        .form-check-input {
            display: block;
            height: 18px;
            margin-left: -8%;
            margin-top: 15px;
        }

        .form-check-label {
            display: block;
            height: 18px;
            margin-top: -3%;
            margin-left: 25%;
            color: #fff;
        }

        .forgotpwd {
            display: block;
            height: 18px;
            margin-top: -3%;
            margin-left: 65%;
            color: #fff;

        }

        .g-recaptcha {
            display: block;
            margin-left: 20%;
            margin-top: 3%;
        }

        /* กำหนดรูปแบบสำหรับ input ที่มี placeholder */
        input[type="text"][placeholder] {
            padding-left: 50px;
            /* ปรับระยะห่างซ้ายเพื่อให้มีพื้นที่สำหรับไอคอน */
            background-position: left center;
            /* กำหนดตำแหน่งของไอคอน */
            background-repeat: no-repeat;
            /* หยุดการทำซ้ำของพื้นหลัง */
            background-size: 20px auto;
            /* กำหนดขนาดของไอคอน */
        }

        /* กำหนดรูปแบบสำหรับไอคอนใน input */
        input[type="text"][placeholder]+i.fa-user {
            position: absolute;
            left: 23%;
            top: 37.3%;
            transform: translateY(-50%);
            color: #979797;
            /* สีของไอคอน */
            pointer-events: none;
            /* ปิดการเชื่อมต่อแบบการคลิกกับไอคอน */
            padding-right: 10px;
            border-right: 1px solid #ccc;
            /* เพิ่มเส้นขอบด้านขวา */
        }

        /* กำหนดรูปแบบสำหรับ input ที่มี placeholder */
        input[type="password"][placeholder] {
            padding-left: 50px;
            /* ปรับระยะห่างซ้ายเพื่อให้มีพื้นที่สำหรับไอคอน */
            background-position: left center;
            /* กำหนดตำแหน่งของไอคอน */
            background-repeat: no-repeat;
            /* หยุดการทำซ้ำของพื้นหลัง */
            background-size: 20px auto;
            /* กำหนดขนาดของไอคอน */
        }

        /* กำหนดรูปแบบสำหรับไอคอนใน input */
        input[type="password"][placeholder]+i.fa-lock {
            position: absolute;
            left: 23%;
            top: 49%;
            transform: translateY(-50%);
            color: #979797;
            /* สีของไอคอน */
            pointer-events: none;
            /* ปิดการเชื่อมต่อแบบการคลิกกับไอคอน */
            padding-right: 10px;
            border-right: 1px solid #ccc;
            /* เพิ่มเส้นขอบด้านขวา */
        }

        .loginBtn {
            color: white;
        }

        .cookie-banner {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #fff;
            color: #333;
            text-align: center;
            padding: 5px;
            font-size: 14px;
            z-index: 999;
            display: none;
            margin-left: 25%;
            margin-right: 25%;
            margin-bottom: 1%;
        }

        #acceptCookies {
            background: #4c97ee;
            color: #fff;
            border: none;
            left: 45%;
            padding: 5px 15px;
            font-size: 14px;
            cursor: pointer;
            margin: 5px;
            width: 100px;
            height: 30px;
            border-radius: 5px;
        }

        #closeBanner {
            position: absolute;
            top: -17%;
            left: 48%;
            background: transparent;
            color: #333;
            border: none;
            padding: 5px 15px;
            font-size: 18px;
            cursor: pointer;
        }

        h4 {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            /* ปรับค่าตามที่คุณต้องการ */
        }
    </style>
</head>

<body>
    <div class="bg">

        <!-- <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div> -->
        <form action="<?php echo site_url('Login_intranet/check2'); ?>" method="post">
            <!-- ตรวจสอบว่ามีค่าในคุกกี้ remember หรือไม่ -->
            <?php if (isset($_COOKIE['remember'])) {
                $remember_data = json_decode($_COOKIE['remember'], true);
                $remember_id = $remember_data['id'];
                $remember_password = $remember_data['data'];
            } else {
                $remember_id = '';
                $remember_password = '';
            } ?>
            <img src="docs/k.logo.png" alt="" height="20%">
            <!-- <span>ยินดีต้อนรับสู่ระบบ</span> -->
            <h4>ยินดีต้อนรับสู่ระบบอินทราเน็ต</h4>

            <label for="username"></label>
            <input type="text" name="m_username" placeholder="ชื่อผู้ใช้งาน" id="username">
            <i class="fa-solid fa-user"></i>

            <label for="password"></label>
            <input type="password" name="m_password" placeholder="รหัสผ่าน" id="password">
            <i class="fa-solid fa-lock"></i>

            <input class="form-check-input" type="checkbox" name="remember_me" id="rememberMe">
            <label class="form-check-label" for="rememberMe">จดจำรหัสผ่าน</label>
            <a class="forgotpwd" href="<?php echo site_url('user/forgotPassword'); ?>">ลืมรหัสผ่าน ?</a>
            <!-- <a href="<?php echo site_url('Qrcodetest'); ?>">qr code</a> -->

            <div style="margin-left: 10%;" >
                <div class="g-recaptcha" data-sitekey="6LcKoPcnAAAAAKGgUMRtkBs6chDKzC8XOoVnaZg_" data-callback="enableLoginButton"></div>
                <button type="submit" class="loginBtn" id="loginBtn" disabled>เข้าสู่ระบบ</button>
            </div>

            
            <!-- <div class="social">
          <div class="go"><i class="fab fa-google"></i>  Google</div>
          <div class="fb"><i class="fab fa-facebook"></i>  Facebook</div>
        </div> -->
        </form>
    </div>


    <script src="https://www.google.com/recaptcha/api.js?hl=th"></script>
    <!-- boostrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <!-- เพิ่มลิงก์ไปยัง jQuery -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- icon  -->
    <script src="https://kit.fontawesome.com/74345a2175.js" crossorigin="anonymous"></script>
    <script>
        // เมื่อ reCAPTCHA ผ่านการตรวจสอบ
        function enableLoginButton() {
            document.getElementById("loginBtn").removeAttribute("disabled");
        }

    //     document.addEventListener("DOMContentLoaded", function() {
    //         // สร้างคอนสตรักสำหรับ cookieBanner
    //         const cookieBanner = document.createElement("div");
    //         cookieBanner.className = "cookie-banner";
    //         cookieBanner.innerHTML = `
    //     <button id="closeBanner" onclick="closeCookieBanner()">&times;</button>
    //     <br>
    //     เว็บไซต์ของเรามีการเก็บ cookies ซึ่งเก็บข้อมูลว่าคุณใช้งานเว็บไซต์ของเราอย่างไรและช่วยให้เราจดจำคุณได้ และนำมาสู่การทำให้ประสบการณ์การใช้เว็บไซต์ดียิ่งขึ้น
    //     <a href="<?php echo site_url('user/privacy'); ?>">( อ่านข้อมูลเพิ่มเติมที่นี่ )</a>       
    //     <br><br>
    //     <button id="acceptCookies">ยอมรับ</button>
    //     <br>
    // `;

    //         document.body.appendChild(cookieBanner);
    //         // เมื่อผู้ใช้คลิกปุ่ม "ยอมรับ"
    //         const acceptCookiesButton = document.getElementById("acceptCookies");
    //         acceptCookiesButton.addEventListener("click", function() {
    //             localStorage.setItem("cookieConsent", "true");
    //             cookieBanner.style.display = "none";
    //         });

    //         // เมื่อผู้ใช้คลิกปุ่ม "ปิด"
    //         const closeBannerButton = document.getElementById("closeBanner");
    //         closeBannerButton.addEventListener("click", function() {
    //             localStorage.setItem("cookieConsent", "true");
    //             cookieBanner.style.display = "none";
    //         });

    //         // ตรวจสอบคุกกี้ว่าผู้ใช้ได้ยินยอมหรือไม่
    //         if (localStorage.getItem("cookieConsent") !== "true") {
    //             cookieBanner.style.display = "block";
    //         }
    //     });
    </script>
</body>

</html>