<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="icon" href="<?php echo base_url("docs/t.logo.png"); ?>" type="image/x-icon">
  <title>เทศบาลตำบลธงธานี</title>


  <!-- boostrap  -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!-- w3schools -->
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <!-- awesome  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Add Swiper styles -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
  <!-- font  -->
  <link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
  <!-- google map -->
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <!-- ใช้ CSS ของ Swiper -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <link rel="stylesheet" type="text/css" href="./style.css" />

  <!-- sweetalert 2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.min.css">

  <!-- Cookie Consent by https://www.cookiewow.com -->
  <script type="text/javascript" src="https://cookiecdn.com/cwc.js"></script>
  <script id="cookieWow" type="text/javascript" src="https://cookiecdn.com/configs/6QsrB4Cv2uYE2WoAmghffBjz" data-cwcid="6QsrB4Cv2uYE2WoAmghffBjz"></script>

  <!-- สไลด์ Slick Carousel -->
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

  <!-- รูปภาพ preview -->
  <link href="<?= base_url('asset/'); ?>lightbox2/src/css/lightbox.css" rel="stylesheet">
  <link href="<?= base_url('asset/'); ?>swiper/swiper/swiper-bundle.min.css" rel="stylesheet"> 
  <link href="<?= base_url('asset/'); ?>slick/slick-carousel/slick/slick.css" rel="stylesheet"> 
  <link href="<?= base_url('asset/'); ?>boostrap/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> 

   <!-- Search Google -->
   <script async src="https://cse.google.com/cse.js?cx=c38f57088c50147a9"></script>

  <!-- facebook -->
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v19.0" nonce="MXdATBI7"></script>
</head>

<!-- Messenger ปลั๊กอินแชท Code -->
<div id="fb-root"></div>

<!-- Your ปลั๊กอินแชท code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
  var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", "852452498161203");
  chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- Your SDK code -->
<script>
  window.fbAsyncInit = function() {
    FB.init({
      xfbml: true,
      version: 'v19.0'
    });
  };

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = 'https://connect.facebook.net/th_TH/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>

<body>

  <main>

    <div class="show">
      <div class="overlay"></div>
      <div class="img-show">
        <span>X</span>
        <img src="">
      </div>
    </div>