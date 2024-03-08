<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Design by foolishdeveloper.com -->
    <link rel="icon" href="<?php echo base_url("docs/logo.png"); ?>" type="image/x-icon">

    <title>องค์การบริหารส่วนตำบลสว่าง</title>
    <!-- icon -->
    <link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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

        .bg {
            /* The image used */
            background-image: url('<?php echo base_url("docs/s.bg-before-internet1.jpg"); ?>');
            /* Full height */
            height: 100vh;
            /* Center the image horizontally and vertically */
            background-position: center center;
            /* Do not repeat the background image */
            background-repeat: no-repeat;
            /* Cover the entire div with the background image */
            background-size: cover;
        }

        .bg-content {
            width: 749px;
            height: 534px;
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

        h2 {
            color: #FFF;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.25);
            font-family: Kanit;
            font-style: normal;
            font-weight: 500;
            line-height: 48.167px;
            /* 185.258% */
        }

        h3 {
            color: #FFF;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.25);
            font-family: Kanit;
            font-style: normal;
            font-weight: 500;
            line-height: 48.167px;
            margin-top: -20px;
        }
    </style>
</head>

<body>
    <main>
        <div class="bg">
            <div class="bg-content">
                <div class="text-center mt-4">
                    <img src="<?php echo base_url("docs/logo.png"); ?>" width="120" height="120">
                    <div class="mt-3">
                        <h2>องค์การบริหารส่วนตำบลสว่าง</h2>
                        <h3>อ.โพนทอง จ.ร้อยเอ็ด</h3>
                    </div>
                </div>
                <div class="d-flex justify-content-between" style="margin-left: 60px; margin-right: 50px; margin-top: 70px;">
                    <a href="<?php echo site_url('Login_intranet'); ?>">
                        <img src="<?php echo base_url("docs/s.btn-login-intranet.png"); ?>" width="260px" height="78px">
                    </a>
                    <a href="<?php echo site_url('User'); ?>">
                        <img src="<?php echo base_url("docs/s.btn-login-admin.png"); ?>" width="260px" height="78px">
                    </a>
                </div>
            </div>
        </div>
    </main>
</body>


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