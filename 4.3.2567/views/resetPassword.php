<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Design by foolishdeveloper.com -->
    <link rel="icon" href="<?php echo base_url("docs/logo.png"); ?>" type="image/x-icon">
    <title>อบต.สว่าง ระบบแอดมิน</title>
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
            height: 400px;
            width: 700px;
            /* background-color: rgba(255, 255, 255, 0.13); */
            background-color: rgba(255, 255, 255, 0.0);
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
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
            border-radius: 3px;
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
            width: 60%;
            background-color: #4c97ee;
            color: black;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 20%;
            margin-top: 3%;
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
            background-image: url('<?php echo base_url("docs/s.bg-admin.jpg"); ?>');
            /* Full height */
            height: 100%;
            /* Center the image horizontally and vertically */
            background-position: center center;
            /* Do not repeat the background image */
            background-repeat: no-repeat;
            /* Cover the entire div with the background image */
            background-size: contain;
        }

        form h4 {
            font-size: 25px;
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

        .forgotpwd {
            display: block;
            height: 18px;
            margin-top: 3%;
            margin-left: 40%;
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
        input[type="text"][placeholder]+i.fa-envelope {
            position: absolute;
            left: 23%;
            top: 26%;
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
        input[type="password"][placeholder]+i.new {
            position: absolute;
            left: 23%;
            top: 42%;
            transform: translateY(-50%);
            color: #979797;
            /* สีของไอคอน */
            pointer-events: none;
            /* ปิดการเชื่อมต่อแบบการคลิกกับไอคอน */
            padding-right: 10px;
            border-right: 1px solid #ccc;
            /* เพิ่มเส้นขอบด้านขวา */
        }

        /* กำหนดรูปแบบสำหรับไอคอนใน input */
        input[type="password"][placeholder]+i.confirm {
            position: absolute;
            left: 23%;
            top: 58%;
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
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="bg">

        <!-- <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div> -->
        <form action="<?php echo base_url('user/changePassword'); ?>" method="post">
            <h4>รหัสผ่านใหม่ของคุณ</h4>

            <label for="email"></label>
            <input type="text" name="email" id="email" placeholder="ใส่อีเมลของคุณอีกครั้ง" required>
            <i class="fa-solid fa-envelope"></i>

            <label for="new_password"></label>
            <input type="password" name="new_password" id="new_password" placeholder="รหัสผ่านใหม่ของคุณ" required>
            <i class="fa-solid fa-lock new"></i>

            <label for="confirm_password"></label>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="ยืนยันรหัสผ่านใหม่" required>
            <i class="fa-solid fa-lock confirm"></i>

            <button type="submit" class="loginBtn" id="loginBtn">บันทึกรหัสผ่านใหม่</button>

            <a class="forgotpwd" href="<?php echo site_url('Home/login'); ?>">กลับสู่หน้าเข้าสู่ระบบ</a>
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

    </script>
</body>

</html>