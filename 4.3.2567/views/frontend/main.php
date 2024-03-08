<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>องค์การบริหารส่วนตำบลสว่าง</title>
    <link rel="icon" href="<?php echo base_url("docs/logo.png"); ?>" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
    body {
        height: 100vh;
    }
</style>

<body>

    <div id="image-container" class="position-relative text-center">
        <img id="special-image" class="img-fluid">
        <div class="buttons position-absolute top-50 start-50 translate-middle">
            <script>
                const loyKrathongDayStart = new Date("2023-11-22"); // วันลอยกระทง
                const loyKrathongDayEnd = new Date("2023-11-30");
                const dadDayStart = new Date("2023-12-1"); // วันพ่อ
                const dadDayEnd = new Date("2023-12-7");
                const newyearDayStart = new Date("2023-12-25"); // วันปีใหม่
                const newyearDayEnd = new Date("2024-01-2");
                const siriwanbirthDayStart = new Date("2024-01-4"); // วันเกิดเจ้าฟ้าสิริวัณ
                const siriwanbirthDayEnd = new Date("2024-01-8");
                const kidDayStart = new Date("2024-01-9"); // วันเด็ก
                const kidDayEnd = new Date("2024-01-15");
                const king10DayStart = new Date("2024-02-16"); // วันพ่อ
                const king10DayEnd = new Date("2024-02-17");
                const today = new Date();

                if (window.innerWidth < 600) {
                    window.location.href = '<?= base_url('Home') ?>';
                } else if ((today >= loyKrathongDayStart && today <= loyKrathongDayEnd) || (today >= dadDayStart && today <= dadDayEnd) ||
                    (today >= newyearDayStart && today <= newyearDayEnd) || (today >= siriwanbirthDayStart && today <= siriwanbirthDayEnd) ||
                    (today >= kidDayStart && today <= kidDayEnd) || (today >= king10DayStart && today <= king10DayEnd)) {
                    if (today >= loyKrathongDayStart && today <= loyKrathongDayEnd) {
                        document.getElementById("special-image").src = "docs/loykratong.jpg";
                        document.write('<a href="' + '<?= base_url('Home') ?>' + '"><img src="docs/to-web.png" alt="เข้าสู่เว็บไซต์" style="width: 17vw; height: auto; margin: 0 auto; margin-top: 170%;"></a>');
                    } else if (today >= dadDayStart && today <= dadDayEnd) {
                        document.getElementById("special-image").src = "docs/dad_day.jpg"; // เพิ่มรูปภาพสำหรับวันพ่อ
                        document.write('<a href="' + '<?= base_url('Home') ?>' + '"><img src="docs/to-web.png" alt="เข้าสู่เว็บไซต์" style="width: 17vw; height: auto; margin: 0 auto; margin-top: 250%;"></a>');
                        // document.write('<div style="display: flex; justify-content: space-between;">');
                        // document.write('<a href="' + '<?= base_url('Home') ?>' + '"><img src="docs/to-web.png" alt="เข้าสู่เว็บไซต์" style="width: 300px; height: auto; margin: 0 auto; margin-top: 260%;"></a>');
                        // document.write('<a target="_blank" href="' + 'https://wellwishes.royaloffice.th/' + '"><img src="docs/out-web.png" alt="ลงนามถวายพระพร" style="width: 300px; height: auto; margin: 0 auto; margin-top: 260%;"></a>');
                        // document.write('</div>');
                    } else if (today >= newyearDayStart && today <= newyearDayEnd) {
                        document.getElementById("special-image").src = "docs/newyear_day2.jpg"; // เพิ่มรูปภาพสำหรับวันปีใหม่
                        document.write('<a href="' + '<?= base_url('Home') ?>' + '"><img src="docs/to-web.png" alt="เข้าสู่เว็บไซต์" style="width: 17vw; height: auto; margin: 0 auto; margin-top: 210%;"></a>');
                    } else if (today >= siriwanbirthDayStart && today <= siriwanbirthDayEnd) {
                        document.getElementById("special-image").src = "docs/siriwanbirth_day.jpg"; // วันเกิดเจ้าฟ้าสิริวัณ
                        document.write('<a href="' + '<?= base_url('Home') ?>' + '"><img src="docs/to-web.png" alt="เข้าสู่เว็บไซต์" style="width: 12vw; height: auto; margin: 0 auto; margin-top: 235%;"></a>');
                    } else if (today >= kidDayStart && today <= kidDayEnd) {
                        document.getElementById("special-image").src = "docs/kid_day2.jpg"; // วันเด็ก
                        document.write('<a href="' + '<?= base_url('Home') ?>' + '"><img src="docs/to_web_kid_day.png" alt="เข้าสู่เว็บไซต์" style="width: 12vw; height: auto; margin: 0 auto; margin-top: 200%;"></a>');
                    } else if (today >= king10DayStart && today <= king10DayEnd) {
                        document.getElementById("special-image").src = "https://assystem.co.th/Day/Sawang/king10.jpeg"; // เพิ่มรูปภาพสำหรับวันพ่อ
                        // document.write('<a href="' + '<?= base_url('Home') ?>' + '"><img src="docs/to-web.png" alt="เข้าสู่เว็บไซต์" style="width: 17vw; height: auto; margin: 0 auto; margin-top: 250%;"></a>');
                        document.write('<div style="display: flex; justify-content: space-between; margin-left:33%; ">');
                        document.write('<a target="_blank" href="' + 'https://wellwishes.royaloffice.th/' + ' "style="width: 50vw; height: 30vh; margin: 0 auto; margin-top: 50%;" ></a>');
                        document.write('<a href="' + '<?= base_url('Home') ?>' + '"  style="width: 50vw; height: 30vh; margin: 0 auto; margin-top: 50%; "></a>');
                        document.write('</div>');
                    }
                } else {
                    window.location.href = '<?= base_url('Home') ?>';
                }
            </script>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

</body>

</html>