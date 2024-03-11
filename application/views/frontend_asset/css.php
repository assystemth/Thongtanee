<style>
  body {
    padding: 0;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  main {
    margin: 0 auto;
    padding: 0;
    width: 100%;
    max-width: 1280px;
    /* กำหนดความกว้างสูงสุดที่ 1280px */
    height: auto;
  }

  /* สำหรับโทรศัพท์ */
  @media (min-width: 280px) and (max-width: 319px) {
    main {
      transform: scale(0.22);
      transform-origin: top left;
      height: 2000px;
    }
  }

  /* สำหรับโทรศัพท์ */
  @media (min-width: 320px) and (max-width: 359px) {
    main {
      transform: scale(0.25);
      transform-origin: top left;
      height: 2000px;
    }
  }

  /* สำหรับโทรศัพท์ */
  @media (min-width: 360px) and (max-width: 374px) {
    main {
      transform: scale(0.285);
      transform-origin: top left;
      height: 2000px;
    }
  }

  /* สำหรับโทรศัพท์ */
  @media (min-width: 375px) and (max-width: 379px) {
    main {
      transform: scale(0.295);
      transform-origin: top left;
      height: 2000px;
    }
  }

  /* สำหรับโทรศัพท์ */
  @media (min-width: 380px) and (max-width: 411px) {
    main {
      transform: scale(0.31);
      transform-origin: top left;
      height: 2000px;
    }
  }

  /* สำหรับโทรศัพท์ */
  @media (min-width: 412px) and (max-width: 419px) {
    main {
      transform: scale(0.325);
      transform-origin: top left;
      height: 2000px;
    }
  }

  /* สำหรับโทรศัพท์ */
  @media (min-width: 420px) and (max-width: 450px) {
    main {
      transform: scale(0.336);
      transform-origin: top left;
      height: 2000px;
    }
  }

  @media (min-width: 451px) and (max-width: 480px) {
    main {
      transform: scale(0.36);
      transform-origin: top left;
      height: 2000px;
    }
  }

  /* สำหรับ iPad และ Tablet */
  @media (min-width: 481px) and (max-width: 539px) {
    main {
      transform: scale(0.4);
      transform-origin: top left;
      height: 2000px;
    }
  }

  /* สำหรับ iPad และ Tablet */
  @media (min-width: 540px) and (max-width: 546px) {
    main {
      transform: scale(0.422);
      transform-origin: top left;
      height: 2000px;
    }
  }

  @media (min-width: 547px) and (max-width: 640px) {
    main {
      transform: scale(0.45);
      transform-origin: top left;
      height: 2000px;
    }
  }

  @media (min-width: 641px) and (max-width: 711px) {
    main {
      transform: scale(0.5);
      transform-origin: top left;
      height: 2000px;
    }
  }

  /* สำหรับ iPad และ Tablet */
  @media (min-width: 712px) and (max-width: 767px) {
    main {
      transform: scale(0.56);
      transform-origin: top left;
      height: 2000px;
    }
  }

  /* สำหรับจอ 7.9 นิ้ว */
  @media (min-width: 768px) and (max-width: 818px) {
    main {
      transform: scale(0.6);
      transform-origin: top left;
      height: 2000px;
    }
  }

  /* สำหรับจอ 9.7 นิ้ว */
  @media (min-width: 819px) and (max-width: 911px) {
    main {
      transform: scale(0.64);
      transform-origin: top left;
      height: 2000px;
    }
  }

  @media (min-width: 912px) and (max-width: 1023px) {
    main {
      transform: scale(0.72);
      transform-origin: top left;
      height: 2000px;
    }
  }

  /* สำหรับจอ 10 นิ้ว */
  @media (min-width: 1024px) and (max-width: 1076px) {
    main {
      transform: scale(0.8);
      transform-origin: top left;
      height: 2000px;
    }
  }

  @media (min-width: 1077px) and (max-width: 1119px) {
    main {
      transform: scale(0.558);
      transform-origin: top left;
      height: 2000px;
    }
  }

  @media (min-width: 1120px) and (max-width: 1199px) {
    main {
      transform: scale(0.58);
      transform-origin: top left;
      height: 2000px;
    }
  }


  /* color-all color สีทั้งหมด ****************************************************** */
  .white {
    color: #fff;
  }

  .gray {
    color: gray;
  }

  .red {
    color: red;
  }

  .green {
    color: green;
  }

  .color-q-a {
    color: #005930;
    leading-trim: both;
    text-edge: cap;
    font-feature-settings: 'clig' off, 'liga' off;
    font-family: Kanit;
    font-size: 20.098px;
    font-style: normal;
    font-weight: 500;
    line-height: 13.398px;
    /* 66.667% */
  }

  /* ******************************************************************************* */

  .nav-text-color-2 {
    background-image: linear-gradient(to top, #F9B502, #FADB8d, #FDCE34);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.2);
  }

  /* background: linear-gradient(to bottom,
        #0F1A2F 0%,
        #2F3C69 25%,
        #AEB9CD 50%,
        #2F3C69 75%,
        #1A2541 100%
      ); */

  .navbar2 {
    background-image: url('<?php echo base_url("docs/k.navbar-stick.png"); ?>');
    background-repeat: no-repeat;
    background-size: 100%;
    height: 123px;
    width: 714px;
    margin-left: 23%;
  }

  .full-screen-img {
    background-image: url('<?php echo base_url("docs/chang.jpg"); ?>');
    background-repeat: no-repeat;
    background-size: 100%;
    height: 1080px;
    width: 1920px;
    margin-top: -10%;
  }

  .welcome {
    background-image: url('<?php echo base_url("docs/t.welcome.gif"); ?>');
    background-repeat: no-repeat;
    background-size: 100%;
    margin-top: -115px;
    z-index: 1;
    width: 1280px;
    height: 690px;
  }


  .tab-container {
    background-image: url('<?php echo base_url("docs/k.run-text4.png"); ?>');
    background-repeat: no-repeat;
    background-size: 100%;
    height: 51px;
    width: 1200px;
    /* top: -100px; */
    position: relative;
    overflow: hidden;
    z-index: 1;
    margin-left: 79px;
    margin-top: -15px;
  }

  .text-run-update {
    position: absolute;
    bottom: 0;
    right: 0;
    display: flex;
    flex-direction: row;
    gap: 5%;
    text-align: right;
    direction: rtl;
    white-space: nowrap;
    /* ป้องกันข้อความขึ้นบรรทัดใหม่ */
    z-index: 1;
    animation: textRunUpdate 30s linear infinite;
    font-size: 19px;
    color: #082555;
  }

  @keyframes textRunUpdate {
    0% {
      transform: translateX(100%);
    }

    100% {
      transform: translateX(-100%);
    }
  }

  .bg-main {
    background-image: url('<?php echo base_url("docs/t.bg-main.jpg"); ?>');
    background-repeat: no-repeat;
    background-size: 100%;
    height: 850px;
    width: 1280px;
    z-index: 1;
  }

  .vision {
    background-image: url('<?php echo base_url("docs/t.bg-vision.png"); ?>');
    background-repeat: no-repeat;
    background-size: 100%;
    height: 815px;
    width: 1280px;
    z-index: 2;
    margin-top: -71px;
    padding-top: 250px;
    padding-left: 40px;
    padding-right: 40px;
  }

  .head-activity {
    background-image: url('<?php echo base_url("docs/t.bg-nav-mid.png"); ?>');
    background-repeat: no-repeat;
    background-size: 100%;
    height: 64px;
    width: 1280px;
    z-index: 1;
  }

  .carousel {
    margin-left: 55px;
    top: 18px;
  }

  .carousel-item img {
    width: 997px;
    /* กำหนดความกว้างเป็น 500px */
    height: 572px;
    /* จัดกลางรูปภาพใน Carousel */

  }

  .content-banner {
    margin-right: 120px;
    margin-left: 5%;
    z-index: 1;
    position: relative;
    margin-top: 30px;
  }

  .frame-main {
    position: absolute;
    z-index: 2;
    margin-left: 35px;
  }

  .bg-activity {
    background-image: url('<?php echo base_url("docs/t.bg-activity2.jpg"); ?>');
    background-repeat: no-repeat;
    background-size: 100%;
    height: 2860px;
    width: 1280px;
    margin: auto;
  }

  .card-activity {
    /* border-radius: 24px;
    background-color: #FDF5E1; */
    height: 261px;
    width: 215px;
    margin: 25px 5px;
    /* border: 2px solid #EABA48;
    box-shadow: 2px 2px 4px rgba(0, 0, 0, .2); */
  }

  .card-activity img {
    width: 180px;
    height: 160px;
    border-radius: 24px;
  }

  .text-activity {
    color: #FFF;
    text-align: center;
    text-shadow: 0px 3.213px 3.213px rgba(0, 0, 0, 0.25);
    font-family: Kanit;
    font-size: 16.063px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
  }

  .text-activity-time {
    color: #FFF;
    font-family: Kanit;
    font-size: 12.85px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
  }

  .box-activity {
    height: 90px;
    width: 180px;
  }

  .dropdown-container {
    position: relative;
    display: inline-block;
    width: 1280px;
    margin-left: -18px;
    margin-top: -5px;
  }

  .dropdown-content {
    background-image: url('<?php echo base_url("docs/t.bg-nav-content.png"); ?>');
    background-repeat: no-repeat;
    background-size: 100%;
    display: none;
    position: absolute;
    width: 1280px;
    height: 413px;
    z-index: 2;
    margin-left: 3px;
  }

  .dropdown-content ul {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    /* แบ่งออกเป็น 3 columns ที่มีขนาดเท่ากัน */

  }

  .dropdown-content a {
    color: #000;
    font-family: Kanit;
    font-size: 20px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
  }

  .dropdown-item:hover {
    color: #0FC2C0;
    font-family: Kanit;
    font-size: 20px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
  }

  .no-bullets {
    list-style: none;
    padding: 0;
    margin: 0;
  }


  .content-activity {
    margin-left: 11.5%;
    margin-top: 11%;
    margin-right: 3%;

  }

  /* 
  .card-activity {
    border-radius: 25px;
  } */

  .mar-left-17 {
    margin-left: 17%;
  }

  .mar-left-12 {
    margin-left: 12%;
  }

  .mar-left-8 {
    margin-left: 8%;
  }

  .mar-left-9 {
    margin-left: 9%;
  }

  .mar-left-7 {
    margin-left: 7%;
  }

  .mar-left-5 {
    margin-left: 5%;
  }

  .mar-left-3 {
    margin-left: 3%;
  }

  .mar-top-19 {
    margin-top: 19%;
  }

  .mar-top-17 {
    margin-top: 17%;
  }

  .mar-top-130 {
    margin-top: 130px;
  }

  .underline {
    text-decoration: none;
  }

  .underline a {
    text-decoration: none;
  }

  .bg-news2 {
    background-image: url('<?php echo base_url("docs/bg-new2.png"); ?>');
    background-repeat: no-repeat;
    background-size: 100%;
    background-position: center center;
    height: 1070px;
    width: 1920px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .content-news-bg {
    height: 730px;
    width: 1166px;
    border-radius: 23.878px;
    background: rgba(255, 255, 255, 0.40);
    box-shadow: 0px 0px 7.023px 0px rgba(63, 62, 47, 0.25);
    padding: 1% 4%;
    margin-left: 59px;
    margin-top: 130px;
  }

  .content-news-bg-two {
    height: 730px;
    width: 1166px;
    border-radius: 23.878px;
    background: rgba(255, 255, 255, 0.40);
    box-shadow: 0px 0px 7.023px 0px rgba(63, 62, 47, 0.25);
    padding: 1% 4%;
    margin-left: 59px;
    margin-top: 160px;

  }

  .tab-container2 {
    display: flex;
  }

  .tab-link {
    cursor: pointer;
    padding: 15px 20px;
    /* border: 1px solid #ccc; */
    margin-left: -35px;
  }

  .tab-link-two {
    cursor: pointer;
    padding: 15px 20px;
    /* border: 1px solid #ccc; */
    margin-left: -35px;
  }

  .tab-content {
    display: none;
    padding: 20px;
    margin-top: -10px;
    /* border: 1px solid #ccc; */
    /* width: 1505px; */
    /* margin-left: 1%; */
  }

  .tab-content-two {
    display: none;
    padding: 20px;
    margin-top: -10px;
    /* border: 1px solid #ccc; */
    /* width: 1505px; */
    /* margin-left: 1%; */
  }

  .content-news-detail {
    border-radius: 34px;
    background: #FFF;
    box-shadow: 0px 0px 6.712px 0px rgba(0, 109, 188, 0.25);
    height: 54px;
    flex-shrink: 0;
    padding: 20px 20px;
    font-size: 19px;
    font-weight: bold;
    margin-bottom: 40px;
    margin-top: -25px;
  }

  .text-news {
    max-height: 2em;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    color: #000;
    font-family: Kanit;
    font-size: 22px;
    font-style: normal;
    font-weight: 400;
    line-height: 35.114px;
    margin-top: -12px;
    /* 138.889% */
  }

  .text-news-time {
    color: #000;
    font-family: Kanit;
    font-size: 22px;
    font-style: normal;
    font-weight: 400;
    line-height: 35.114px;
    margin-top: -12px;
    /* 138.889% */
  }

  .bg-otop {
    background-image: url('<?php echo base_url("docs/t.bg-otop3.jpg"); ?>');
    background-repeat: no-repeat;
    background-size: 100%;
    background-position: center center;
    width: 1280px;
    height: 797px;
  }

  .otop-content {
    margin-top: -25px;
    margin-left: 85px;
    max-width: 1120px;
  }

  .slick-prev-otop,
  .slick-next-otop {
    position: absolute;
    top: 45%;
    transform: translateY(-50%);
    z-index: 1;
    /* ตั้งค่า z-index เพื่อให้ปุ่มอยู่ข้างบนของเนื้อหา */
    cursor: pointer;
  }

  .slick-prev-otop {
    left: -60px;
    /* ปรับระยะห่างด้านซ้าย */
  }

  .slick-next-otop {
    right: -110px;
    /* ปรับระยะห่างด้านขวา */
  }

  .slick-carousel-otop {
    margin: 20px 0;
    /* ปรับระยะห่างด้านบนและด้านล่างของเนื้อหา */
  }

  .slick-carousel-otop img {
    margin-right: 50px;
    /* ระยะห่างระหว่างรูปภาพ */
  }

  .zoom-otop:hover img {
    transform: scale(1.2);
    /* 1.1 คือขนาดที่คุณต้องการขยาย */
    transition: transform 0.3s ease;
    /* เพิ่มการเปลี่ยนแปลงด้วยการใช้ transition */
  }

  .zoom-travel:hover img {
    transform: scale(1.07);
    /* 1.1 คือขนาดที่คุณต้องการขยาย */
    transition: transform 0.3s ease;
    /* เพิ่มการเปลี่ยนแปลงด้วยการใช้ transition */
  }

  .bg-travel {
    background-image: url('<?php echo base_url("docs/t.bg-travel.jpg"); ?>');
    background-repeat: no-repeat;
    background-size: 100%;
    width: 1280px;
    height: 720px;
  }

  .travel-content {
    max-width: 1120px;
    margin-top: -25px;
    margin-left: 85px;
  }

  .slick-prev,
  .slick-next {
    position: absolute;
    top: 42%;
    transform: translateY(-50%);
    z-index: 1;
    /* ตั้งค่า z-index เพื่อให้ปุ่มอยู่ข้างบนของเนื้อหา */
    cursor: pointer;
  }

  .slick-prev {
    left: -60px;
    /* ปรับระยะห่างด้านซ้าย */
  }

  .slick-next {
    right: -110px;
    /* ปรับระยะห่างด้านขวา */
  }

  .slick-carousel {
    margin: 20px 0;
    /* ปรับระยะห่างด้านบนและด้านล่างของเนื้อหา */
  }

  .slick-carousel img {
    margin-right: 50px;
    /* ระยะห่างระหว่างรูปภาพ */
  }

  .text-travel {
    color: #CA942B;
    -webkit-text-stroke: 1px black;
    font-family: Kanit;
    font-size: 36.024px;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
  }

  .image-with-shadow-travel {
    border-radius: 30.145px;
    border: 4.433px solid var(--Style, #CA942B);
    background: url(<path-to-image>), lightgray 50% / cover no-repeat, url(<path-to-image>), lightgray 50% / cover no-repeat;
    box-shadow: 3.546px 3.546px 8.866px 0px rgba(0, 0, 0, 0.25);
  }

  .up-down {
    width: auto;
    /* max-width: 100%; */
    position: relative;
    animation-name: up-down;
    animation-duration: 4s;
    animation-iteration-count: infinite;
    /* ทำให้ animation เล่นตลอดไป */
    padding-top: 13%;
  }

  .bg-page-bottom {
    background-image: url('<?php echo base_url("docs/t.bg-page-btm2.jpg"); ?>');
    background-repeat: no-repeat;
    background-size: 100%;
    width: 1280px;
    height: 2040px;
    z-index: 1;
  }

  .font-e-service-32 {
    color: #693708;
    text-align: center;
    text-shadow: 0px 2.668px 6.671px rgba(0, 0, 0, 0.25);
    font-family: Kanit;
    font-size: 32px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
  }

  .font-e-service-25 {
    color: var(--text, #EEE);
    -webkit-text-stroke-width: 0.30000001192092896;
    -webkit-text-stroke-color: #000;
    font-family: Kanit;
    font-size: 22px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
  }

  .bg-eservice {
    background-image: url('<?php echo base_url("docs/bg-eservice2.png"); ?>');
    background-repeat: no-repeat;
    background-size: 100%;
    background-position: center center;
    height: 552px;
    width: 820px;
    margin-bottom: 20%;
  }

  .bg-view {
    border-radius: 34px;
    border: 5px solid var(--Radial, #90BCBB);
    background: #FFF;
    width: 350px;
    height: 413px;
    flex-shrink: 0;
    /* box-shadow: 0px 0px 6px 0px rgba(0, 0, 0, 0.25); */

  }

  .head-view {
    padding: 10px;
    padding-top: 15px;
  }

  .font-view {
    color: #015958;
    text-shadow: 0px 0px 2px rgba(0, 0, 0, 0.25);
    font-family: Kanit;
    font-size: 24px;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
  }

  .content-view {
    margin-top: -50px;
  }

  .card-view {
    color: #000;
    font-family: Kanit;
    font-size: 16px;
    font-style: normal;
    font-weight: 300;
  }

  .bg-q-a {
    width: 370px;
    height: 460px;
    flex-shrink: 0;
    border-radius: 20.394px;
    background: #FFFBF1;
    box-shadow: 0px 0px 6px 0px rgba(0, 0, 0, 0.25);
    margin-top: 35px;
  }

  .font-q-a-home-head {
    color: #693708;
    text-shadow: 0px 0px 6px rgba(0, 0, 0, 0.25);
    font-family: Kanit;
    font-size: 24px;
    font-style: normal;
    font-weight: 600;
    line-height: 46.41px;
    /* 193.374% */
  }

  .head-q-a {
    padding: 10px;
    padding-top: 15px;
  }

  .font-q-a-home-form {
    color: #693708;
    font-family: Kanit;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 29.47px;
    /* 245.583% */
  }

  .content-q-a {
    padding: 15px;
    margin-top: -25px;
  }

  .input-home-q-a {
    border-radius: 14px;
    border: 1px solid #693708;
    color: var(--, #6D758F);
    leading-trim: both;
    text-edge: cap;
    font-feature-settings: 'clig' off, 'liga' off;
    font-family: Kanit;
    font-size: 14px;
    font-style: normal;
    font-weight: 300;
    line-height: 7.975px;
    /* 78.491% */
  }

  .bg-like {
    border-radius: 34px;
    border: 5px solid var(--Style, #90BCBB);
    background: #FFF;
    width: 339px;
    height: 413px;
    flex-shrink: 0;
    margin-left: 20px;
  }

  .head-like {
    padding: 10px;
    padding-top: 20px;
  }

  .font-like {
    color: #015958;
    text-shadow: 0px 0px 2px rgba(0, 0, 0, 0.25);
    font-family: Kanit;
    font-size: 24px;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
  }

  .content-like {
    padding-top: 25px;
    padding-left: 30px;
  }

  .border-like {
    border: 1.2px solid #006DBC;
  }



  .form-check {
    width: 100%;
    height: 100%;
    font-size: 28px;
  }

  .font-like-label {
    color: #000;
    text-shadow: 0px 1.2px 2.399px rgba(0, 0, 0, 0.25);
    font-family: Inter;
    font-size: 16.795px;
    font-style: normal;
    font-weight: 300;
    line-height: 29.991px;
    /* 178.571% */
  }

  .progress-bar {
    border-radius: 6.671px;
    background: var(--unnamed, linear-gradient(180deg, #04C7C3 -14.71%, #79F7F5 18.72%, #4AE4E1 52.2%, #04C3C0 109.3%));
    box-shadow: 0px 1.334px 1.334px 0px rgba(0, 0, 0, 0.10);
    width: 57%;
    height: 20px;
  }

  .green-border {
    border: 1px solid green;
    border-radius: 4px;
    padding: 5px;
  }

  /* swipper link icon ************************************************** */
  .swiper {
    /* background-image: url('<?php echo base_url("docs/s.bg-link.png"); ?>');
    background-size: 100%;
    background-position: center;
    background-repeat: no-repeat; */
    width: 1000px;
    height: 715px;
    padding-top: 280px;
    padding-bottom: 280px;
    padding-left: 60px;
    padding-right: 30px;
    z-index: 5;
    margin-top: -240px;
  }

  .custom-button-prev {
    position: absolute;
    left: -5px;
    /* ปรับตำแหน่งตามที่คุณต้องการ */
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    z-index: 100;
  }

  .custom-button-next {
    position: absolute;
    right: -8px;
    /* ปรับตำแหน่งตามที่คุณต้องการ */
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    z-index: 100;
  }

  /* เปลี่ยนสีของ "swiper-pagination" เมื่อเป็นสถานะ "active" เป็นสีเหลือง */
  /* .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active {
    background-color: yellow;
  } */
  /* 
  .swiper-button-prev,
  .swiper-button-next {
    color: #FADB8D;
  } */

  /* ********************************************************************************** */
  /* เส้นสี เส้นยาว border-line ******************************************************** */
  .border-yellow {
    border: 4px solid yellow;
    border-radius: 15px;
    padding: 5px;
  }

  .border-gray {
    border: 1px solid #D3D3D3;
    border-radius: 15px;
    margin-top: 10px;
    margin-bottom: 10px;
  }

  .border-flcp {
    width: 669.399px;
    height: 0.67px;
    background: rgba(0, 0, 0, 0.25);
    margin-top: 10px;
    margin-bottom: 10px;
    margin-left: -45px;
  }

  .border-gray-332 {
    margin-top: 10px;
    margin-bottom: 10px;
    width: 331.744px;
    height: 0.672px;
    background: #000;
  }

  .border-q-a {
    width: 870px;
    height: 0.67px;
    background: #000;
  }

  /* ********************************************************************************** */


  .footer {
    background-image: url('<?php echo base_url("docs/t.bg-footer2.png"); ?>');
    background-repeat: no-repeat;
    background-size: 100%;
    background-position: center center;
    min-height: 284px;
    width: 1280px;
    position: relative;
    z-index: 2;
    /* เพิ่มบรรทัดนี้ */
    margin-top: -135px;
  }

  .credit {
    /* ให้ข้อความที่อยู่ข้างใน div นี้ไปอยู่ชิดล่างกลาง */
    position: relative;
    bottom: 0;
    left: 35%;
    transform: translateX(-25%);
    text-align: center;
    font-size: 24px;
    width: 1000px;
    height: auto;
    padding-top: 150px;
  }

  .font-footer {
    color: #EEE;
    text-align: center;
    text-shadow: 0px 2.685px 6.712px rgba(0, 0, 0, 0.25);
    font-family: Kanit;
    font-size: 18.75px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
  }

  .map-home {
    border: 6px solid white;
    border-radius: 15px;
  }

  .map-contact {
    border-radius: 22.86px;
    background: rgba(255, 255, 255, 0.50);
    box-shadow: 0px 0px 6.724px 0px rgba(0, 0, 0, 0.25);
    width: 917.108px;
    height: 638.748px;
    padding: 21.516px;
    gap: 6.724px;
    flex-shrink: 0;
  }

  .bg-pages-all-web {
    background-image: url('<?php echo base_url("docs/s.bg-other.jpg"); ?>');
    background-repeat: no-repeat;
    background-size: 100%;
    width: 1280px;
    height: 2000px;
    position: relative;
    margin-top: 230px;
  }

  .bg-pages {
    /* background-image: url('<?php echo base_url("docs/t.bg-other.jpg"); ?>');
    background-repeat: no-repeat;
    background-size: 100%; */
    background-color: #fff;
    width: 1280px;
    height: 1520px;
    position: relative;
    border-left: 1px solid #0FC2C0;
    border-right: 1px solid #0FC2C0;
  }

  .bg-pages-p {
    width: 1270px;
    height: auto;
    position: relative;
  }

  .bg-pages-news {
    background-image: url('<?php echo base_url("docs/s.bg-other.jpg"); ?>');
    background-repeat: no-repeat;
    background-size: 100%;
    width: 1280px;
    height: 1750px;
    position: relative;
    margin-top: 230px;
  }

  .bg-pages-e-service {
    background-image: url('<?php echo base_url("docs/s.bg-other.jpg"); ?>');
    background-repeat: no-repeat;
    background-size: 100%;
    width: 1280px;
    height: 1800px;
    position: relative;
    margin-top: 230px;
  }

  .bg-pages-in {
    /* background-color: white; */
    margin-top: 40px;
    margin-bottom: 5%;
    padding-left: 7%;
    padding-right: 7%;
    border-radius: 22.86px;
    /* background: rgba(253, 245, 225, 0.80);
    box-shadow: 0px 0px 6.724px 0px rgba(0, 0, 0, 0.25); */
    height: 1420px;
    width: 1280px;
    padding-top: 45px;
  }

  .bg-pages-in-e-service {
    height: 1362px;
    width: 1069px;
    padding-top: 15px;
    padding-left: 80px;
  }

  .bg-pages-in-activity {
    background-color: white;
    margin-top: 40px;
    margin-bottom: 5%;
    padding-left: 4%;
    padding-right: 2%;
    border-radius: 22.86px;
    background: rgba(253, 245, 225, 0.80);
    box-shadow: 0px 0px 6.724px 0px rgba(0, 0, 0, 0.25);
    height: 1362px;
    width: 1123px;
    padding-top: 45px;
  }

  .bg-pages-in-gi {
    background-color: white;
    margin-top: 40px;
    margin-bottom: 5%;
    padding-left: 5%;
    padding-right: 5%;
    border-radius: 22.86px;
    background: rgba(253, 245, 225, 0.80);
    box-shadow: 0px 0px 6.724px 0px rgba(0, 0, 0, 0.25);
    height: 1362px;
    width: 1069px;
    padding-top: 50px;
  }

  .bg-pages-web {
    background-image: url('<?php echo base_url("docs/bg-page2.png"); ?>');
    background-repeat: no-repeat;
    background-size: 100%;
    background-position: center center;
    width: 1920px;
    height: 3373;
    /* เพิ่มบรรทัดนี้ */
    margin-top: 5%;
  }

  .bg-pages-in-web {
    /* background-color: white; */
    margin-top: 40px;
    margin-bottom: 5%;
    padding-left: 5%;
    padding-right: 2%;
    border-radius: 22.86px;
    /* background: rgba(253, 245, 225, 0.80);
    box-shadow: 0px 0px 6.724px 0px rgba(0, 0, 0, 0.25); */
    height: 1470px;
    width: 1069px;
    padding-top: 25px;
  }

  .bg-pages-in-e-service-add {
    background-color: white;
    margin-top: 40px;
    margin-bottom: 5%;
    border-radius: 22.86px;
    background: #CDF6F6;
    box-shadow: 0px 0px 6.724px 0px rgba(0, 0, 0, 0.25);
    height: 1500px;
    width: 1069px;
    padding-top: 10px;
    padding-left: 80px;
  }

  .bg-pages-in-e-service-q-a-top {
    height: auto;
    width: 1069px;
    padding-top: 15px;
    padding-left: 80px;
  }

  .bg-pages-in-e-service-flcp {
    height: 1362px;
    width: 1069px;
    padding-top: 15px;
    padding-left: 190px;
  }

  .bg-pages-ita {
    /* background-color: white; */
    margin-top: 40px;
    margin-bottom: 5%;
    border-radius: 22.86px;
    /* background: rgba(253, 245, 225, 0.80); */
    /* box-shadow: 0px 0px 6.724px 0px rgba(0, 0, 0, 0.25); */
    height: 1362px;
    width: 1069px;
  }

  .pad-path {
    margin-left: 20px;
    padding-top: 30px;
  }

  .path1-1 {
    background-image: url('<?php echo base_url("docs/t.path1-1.png"); ?>');
    background-size: 100%;
    background-repeat: no-repeat;
    width: 98px;
    height: 32px;
    z-index: 3;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .path2-1 {
    background-image: url('<?php echo base_url("docs/t.path2-1.png"); ?>');
    background-size: 100%;
    background-repeat: no-repeat;
    width: 138px;
    height: 32px;
    z-index: 2;
    margin-left: -20px;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .path2-2 {
    background-image: url('<?php echo base_url("docs/t.path2-2.png"); ?>');
    background-size: 100%;
    background-repeat: no-repeat;
    width: 182px;
    height: 32px;
    z-index: 2;
    margin-left: -20px;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .path2-3 {
    background-image: url('<?php echo base_url("docs/t.path2-3.png"); ?>');
    background-size: 100%;
    background-repeat: no-repeat;
    width: 240px;
    height: 32px;
    z-index: 2;
    margin-left: -20px;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .path2-4 {
    background-image: url('<?php echo base_url("docs/s.path2-4.png"); ?>');
    background-size: 100%;
    background-repeat: no-repeat;
    width: 230px;
    height: 40px;
    z-index: 2;
    margin-left: -27px;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .font-path-1 {
    color: #EEE;
    font-family: Kanit;
    font-size: 17px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
    margin-left: -10px;
    margin-top: -7px;
  }

  .font-path-2 {
    color: #002D53;
    font-family: Kanit;
    font-size: 17px;
    font-style: normal;
    font-weight: 300;
    line-height: normal;
    margin-left: -10px;
    margin-top: -5px;
  }

  .page-center {
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    /* เพิ่ม flex-direction เป็น column */
  }

  .page-center-gi {
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    /* เพิ่ม flex-direction เป็น column */
  }

  .head-pages {
    background-image: url('<?php echo base_url("docs/t.head-pages1v2.png"); ?>');
    background-size: 100%;
    width: 422px;
    height: 96px;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .head-pages-two {
    background-image: url('<?php echo base_url("docs/t.head-pages2v2.png"); ?>');
    background-size: 100%;
    width: 650px;
    height: 96px;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .head-pages-three {
    background-image: url('<?php echo base_url("docs/t.head-pages3v2.png"); ?>');
    background-size: 100%;
    width: 999px;
    height: 96px;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  /* .head-pages {
    background-image: url('<?php echo base_url("docs/s.head-pages.png"); ?>');
    background-size: 100%;
    width: 402px;
    height: 63px;
    margin-top: 35px;
    margin-bottom: 50px;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
  } */

  .font-pages-head {
    color: #023535;
    text-shadow: 0px 2.685px 6.712px rgba(0, 0, 0, 0.25);
    font-family: Kanit;
    font-size: 30px;
    font-style: normal;
    font-weight: 500;
    line-height: 26.494px;
    /* 88.313% */
    margin-top: -5px;
  }

  .font-pages-head-long {
    color: #023535;
    text-shadow: 0px 2.685px 6.712px rgba(0, 0, 0, 0.25);
    font-family: Kanit;
    font-size: 26px;
    font-style: normal;
    font-weight: 500;
    line-height: 26.494px;
    margin-top: -5px;
  }

  .font-pages-head-long2 {
    color: #023535;
    text-shadow: 0px 2.685px 6.712px rgba(0, 0, 0, 0.25);
    font-family: Kanit;
    font-size: 23px;
    font-style: normal;
    font-weight: 500;
    line-height: 26.494px;
    margin-top: -5px;
  }

  .font-pages-content-head {
    color: #000;
    leading-trim: both;
    text-edge: cap;
    font-family: Kanit;
    font-size: 24px;
    font-style: normal;
    font-weight: 500;
    line-height: 33.421px;
    /* 139.254% */
  }

  .font-pages-content-detail {
    color: #000;
    leading-trim: both;
    text-edge: cap;
    font-family: Kanit;
    font-size: 22px;
    font-style: normal;
    font-weight: 300;
    line-height: 33.421px;
  }

  .font-laws-head {
    color: #000;
    font-family: Kanit;
    font-size: 22px;
    font-style: normal;
    font-weight: 500;
    line-height: 33.624px;
    /* 152.838% */
  }

  .font-laws-content {
    color: #000;
    font-family: Kanit;
    font-size: 20px;
    font-style: normal;
    font-weight: 300;
    line-height: 33.624px;
  }

  .search {
    margin-top: 10%;
    margin-right: 5%;
  }

  .page-content-otop {
    margin: 5%;
    /* background: gray; */
  }

  .span-head {
    font-size: 20px;
    font-weight: 500;
  }

  /* fontsize-all font-all fontsize ขนาดตัวหนังสือ ******************************************************* */
  .dropdown-trigger {
    color: #000;
    text-shadow: 0px 2.685px 2.685px rgba(0, 0, 0, 0.25);
    -webkit-text-stroke-width: 0.30000001192092896;
    -webkit-text-stroke-color: #000;
    font-family: Kanit;
    font-size: 22px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
  }

  .red-font {
    color: #F00;
    font-feature-settings: 'clig' off, 'liga' off;
    font-family: Kanit;
    font-size: 22px;
    font-style: normal;
    font-weight: 400;
    line-height: 14.238px;
  }

  .font-e-service-head {
    color: #000;
    text-align: center;
    leading-trim: both;
    text-edge: cap;
    font-feature-settings: 'clig' off, 'liga' off;
    font-family: Kanit;
    font-size: 24px;
    font-style: normal;
    font-weight: 500;
    line-height: 34px;
  }

  .font-e-service-danger {
    color: #F33;
    leading-trim: both;
    text-edge: cap;
    font-feature-settings: 'clig' off, 'liga' off;
    font-family: Kanit;
    font-size: 19px;
    font-style: normal;
    font-weight: 400;
    line-height: 24px;
    /* 120% */
  }

  .font-e-service-top {
    color: #000;
    text-align: center;
    leading-trim: both;
    text-edge: cap;
    font-feature-settings: 'clig' off, 'liga' off;
    font-family: Kanit;
    font-size: 20px;
    font-style: normal;
    font-weight: 300;
    line-height: 34px;
    /* 170% */
  }

  .font-e-service-content {
    color: #000;
    leading-trim: both;
    text-edge: cap;
    font-family: Kanit;
    font-size: 22px;
    font-style: normal;
    font-weight: 400;
    line-height: 25px;
    /* 113.636% */
  }

  .font-e-service-how {
    color: #FFF;
    leading-trim: both;
    text-edge: cap;
    font-feature-settings: 'clig' off, 'liga' off;
    font-family: Kanit;
    font-size: 24px;
    font-style: normal;
    font-weight: 600;
    line-height: 26.796px;
    /* 111.648% */
  }

  .font-head-topic {
    color: #693708;
    leading-trim: both;
    text-edge: cap;
    font-family: Kanit;
    font-size: 24px;
    font-style: normal;
    font-weight: 500;
    line-height: 25px;
    /* 104.167% */
    padding-left: 20px;

  }

  .font-ita-head {
    color: #693708;
    font-family: Kanit;
    font-size: 24px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
    padding-left: 30px;
  }

  .font-ita-content {
    color: #000;
    font-family: Kanit;
    font-size: 22px;
    font-style: normal;
    font-weight: 300;
    line-height: normal;
    padding-left: 50px;
  }

  .font-q-a-list {
    color: #000;
    leading-trim: both;
    text-edge: cap;
    font-feature-settings: 'clig' off, 'liga' off;
    font-family: Kanit;
    font-size: 21.438px;
    font-style: normal;
    font-weight: 500;
    /* 68.75% */
    padding-top: -30px;
  }

  .font-q-a-chat-color {
    color: #082555;
    leading-trim: both;
    text-edge: cap;
    font-feature-settings: 'clig' off, 'liga' off;
    font-family: Kanit;
    font-size: 20.098px;
    font-style: normal;
    font-weight: 500;
    line-height: 13.398px;
    /* 66.667% */
  }

  .font-q-a-chat-black {
    color: #000;
    leading-trim: both;
    text-edge: cap;
    font-feature-settings: 'clig' off, 'liga' off;
    font-family: Kanit;
    font-size: 21.438px;
    font-style: normal;
    font-weight: 300;
    line-height: 24.787px;
    /* 115.625% */
  }

  .font-contact-1 {
    color: #002D53;
    text-align: center;
    font-family: Kanit;
    font-size: 24px;
    font-style: normal;
    font-weight: 500;
    line-height: 33.559px;
    /* 139.829% */
  }

  .font-contact-2 {
    color: #000;
    font-family: Kanit;
    font-size: 24px;
    font-style: normal;
    font-weight: 300;
    line-height: 33.559px;
  }

  .font-contact-map {
    color: #000;
    leading-trim: both;
    text-edge: cap;
    font-family: Kanit;
    font-size: 26.895px;
    font-style: normal;
    font-weight: 600;
    line-height: 26.541px;
    /* 98.684% */
  }

  .font-pages-heads-img {
    color: #000;
    font-family: Kanit;
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
    line-height: 24.863px;
    /* 155.394% */
  }

  .font-pages-details-img {
    color: #6C757D;
    font-family: Kanit;
    font-size: 15.5px;
    font-style: normal;
    font-weight: 300;
    line-height: 17.076px;
  }

  .font-page-detail-head {
    color: #000;
    leading-trim: both;
    text-edge: cap;
    font-feature-settings: 'clig' off, 'liga' off;
    font-family: Kanit;
    font-size: 24px;
    font-style: normal;
    font-weight: 500;
    line-height: 26.796px;
    /* 111.648% */
  }

  .font-page-detail-time-img {
    color: #6D758F;
    font-family: Kanit;
    font-size: 20px;
    font-style: normal;
    font-weight: 400;
    line-height: 187.5%;
    /* 37.5px */
  }

  .font-page-detail-content-img {
    color: #000;
    font-family: Kanit;
    font-size: 22px;
    font-style: normal;
    font-weight: 300;
    line-height: 33.618px;
    /* 152.811% */
  }

  .font-page-detail-view-img {
    color: #6D758F;
    text-align: center;
    font-family: Kanit;
    font-size: 20px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
  }

  .font-page-detail-view-news {
    color: #6D758F;
    text-align: center;
    font-family: Kanit;
    font-size: 20px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
  }

  .font-pages-content {
    color: #000;
    font-family: Kanit;
    font-size: 22px;
    font-style: normal;
    font-weight: 400;
    margin-left: -15px;
    padding-top: 7px;
  }

  .font-otop-head {
    color: #000;
    font-family: Kanit;
    font-size: 26.796px;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
  }

  .font-otop-content {
    color: #000;
    font-family: Kanit;
    font-size: 24.116px;
    font-style: normal;
    font-weight: 300;
    line-height: normal;
  }

  .font-p-name {
    color: #000;
    text-align: center;
    font-family: Kanit;
    font-size: 22px;
    font-style: normal;
    font-weight: 300;
    line-height: normal;
  }

  .font-p-rank {
    color: #000;
    font-family: Kanit;
    font-size: 22px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
  }

  .font-p-detail {
    color: #000;
    text-align: center;
    font-family: Kanit;
    font-size: 22px;
    font-style: normal;
    font-weight: 300;
    line-height: normal;
  }

  .font-head-all-web {
    color: var(--main, #082555);
    font-family: Kanit;
    font-size: 22px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
  }

  .font-content-all-web {
    color: #000;
    text-align: center;
    font-family: Kanit;
    font-size: 20px;
    font-style: normal;
    font-weight: 300;
    line-height: 8px;
    /* 40% */
  }

  .font-e-service-complain {
    color: #000;
    font-feature-settings: 'clig' off, 'liga' off;
    font-family: Kanit;
    font-size: 21.442px;
    font-style: normal;
    font-weight: 500;
    line-height: 14.238px;
    /* 66.4% */
  }

  .font-label-e-service-complain {
    color: var(--text, var(--, #6D758F));
    leading-trim: both;
    text-edge: cap;
    font-feature-settings: 'clig' off, 'liga' off;
    font-family: Kanit;
    font-size: 18.762px;
    font-style: normal;
    font-weight: 300;
    line-height: 14.238px;
    /* 75.886% */
  }

  .font-thx-curruption {
    padding-top: 25px;
    color: #000;
    leading-trim: both;
    text-edge: cap;
    font-feature-settings: 'clig' off, 'liga' off;
    font-family: Kanit;
    font-size: 17px;
    font-style: normal;
    font-weight: 500;
    line-height: 13.401px;
  }

  .font-flcp-sd {
    color: var(--, #6D758F);
    font-family: Kanit;
    font-size: 21.442px;
    font-style: normal;
    font-weight: 300;
    line-height: normal;
  }

  .font-color-flcp {
    font-family: Kanit;
    font-size: 21.442px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
  }

  .font-time-flcp {
    color: #000;
    font-family: Kanit;
    font-size: 21.442px;
    font-style: normal;
    font-weight: 300;
    line-height: normal;
  }

  .font-12 {
    color: #693708;
    text-align: center;
    leading-trim: both;
    text-edge: cap;
    font-feature-settings: 'clig' off, 'liga' off;
    font-family: Inter;
    font-size: 12.643px;
    font-style: normal;
    font-weight: 500;
    line-height: 12.265px;
    /* 97.004% */
  }

  .font-18 {
    font-size: 18;
  }

  .font-20 {
    font-size: 20px;
  }

  .font-24 {
    font-size: 24px;
  }


  .font-24b {
    font-size: 24px;
    font-weight: bold;
  }

  .font-egp {
    font-size: 18px;
  }

  .font-26 {
    font-size: 20px;
  }

  .font-26b {
    font-size: 26px;
    font-weight: bold;
  }

  .font-28 {
    font-size: 28px;
  }

  .font-28b {
    font-size: 28px;
    font-weight: bold;
  }

  .font-30 {
    font-size: 30px;
  }

  .font-30b {
    font-size: 30px;
    font-weight: bold;
  }

  .font-32 {
    font-size: 32px;
  }

  .font-32b {
    font-size: 32px;
    font-weight: bold;
  }

  .font-34b {
    font-size: 34px;
    font-weight: bold;
  }

  .font-36 {
    font-size: 36px;
  }

  .font-36b {
    font-size: 36px;
  }

  /* **************************************************************************** */
  hr {
    border-top: 2px solid gray;
    /* เปลี่ยนสีเส้นเหนียวตามที่คุณต้องการ */
  }

  .span-time-pages-img {
    color: #6D758F;
    font-family: Kanit;
    font-size: 15px;
    font-style: normal;
    font-weight: 400;
    margin-top: -40px;
  }

  .span-time-pages-img-detail {
    color: #062AAA;
    text-align: center;
    leading-trim: both;
    text-edge: cap;
    font-feature-settings: 'clig' off, 'liga' off;
    font-family: Kanit;
    font-size: 15px;
    font-style: normal;
    font-weight: 500;
    line-height: 11.697px;
    /* 77.979% */
    margin-top: -40px;

  }

  .span-time-pages-news {
    color: #6D758F;
    font-family: Kanit;
    font-size: 20px;
    font-style: normal;
    font-weight: 300;
    line-height: normal;
    margin-top: 6px;
    margin-left: 15px;
  }

  .span-time2 {
    margin-left: 8px;
    font-size: 14px;
    color: gray;
  }

  .span-time-q-a {
    color: #082555;
    font-family: Kanit;
    font-size: 16.078px;
    font-style: normal;
    font-weight: 400;
    line-height: 187.5%;
    /* 30.146px */
  }

  .span-time-home {
    color: #693708;
    font-family: Inter;
    font-size: 12px;
    font-style: normal;
    font-weight: 500;
    line-height: 22.299px;
    /* 222.222% */
  }

  /* ลิมิตการแสดงผล limit-font *************************************************** */
  .three-line-ellipsis {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    /* จำนวนบรรทัดที่ต้องการให้แสดง */
    -webkit-box-orient: vertical;
    white-space: normal;
  }

  .two-line-ellipsis {
    /* margin-bottom: 10px; */
    /* max-height: 3em; */
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
  }

  .one-line-ellipsis {
    /* margin-bottom: 10px; */
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
  }

  /* **************************************************************************** */

  .col-8 {
    word-wrap: break-word;
  }

  .break-word {
    word-wrap: break-word;
  }

  .page-border-otop {
    border-radius: 34px;
    border: 1px solid #6D758F;
    background: var(--PDF, rgba(159, 218, 255, 0.25));
    box-shadow: 10px 10px 10px 0px rgba(0, 0, 0, 0.15);
    padding-left: 50px;
    padding-top: 30px;
    padding-bottom: 30px;
  }

  /* ปุ่ม next page pagination ******************************************** */

  .pagination {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .pagination li {
    margin: 0 5px;
    font-size: 21px;
    font-weight: bold;
  }

  .pagination .page-item.active .page-link {
    background-color: #023535;
    /* สีเขียว */
    border-color: #023535;
    color: #fff;
  }

  .pagination-item {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 51px;
    height: 51px;
    overflow: hidden;
    border-radius: 50%;
    background-image: url('<?php echo base_url("docs/s.pages-next-pre.png"); ?>');
    background-size: 100% 100%;
    /* แก้เป็น 100% 100% */
    background-repeat: no-repeat;
    /* เพิ่มบรรทัดนี้ */
    background-position: center;
  }

  .pagination .page-link {
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #000;
    border-radius: 50%;
    background-size: cover;
  }


  .pagination .page-link:hover {
    color: #F1F3F7;
    background-color: #07834D;
  }


  .page-border-travel {
    border-radius: 34px;
    background: #FFF;
    box-shadow: 0px 4px 10px 0px rgba(0, 0, 0, 0.25);
    margin-bottom: 30px;
    width: 221.881px;
    height: 282.394px;
    flex-shrink: 0;
  }

  .page-border-activity {
    border-radius: 34px;
    background: #FFF;
    box-shadow: 0px 4px 10px 0px rgba(0, 0, 0, 0.25);
    margin-bottom: 30px;
    width: 221.064px;
    height: 281.354px;
    flex-shrink: 0;
  }

  /* รูปภาพโค้ง border-radius-img ******************************************************8* */
  .rounded-top-left-right {
    border-top-left-radius: 34px;
    border-top-right-radius: 34px;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
  }

  .border-radius34 {
    width: 209.09px;
    height: 201.71px;
    flex-shrink: 0;
    border-radius: 9.413px;
    background: url(<path-to-image>), lightgray -92.394px -1.345px / 171.655% 103.333% no-repeat;
    box-shadow: 0px 2.689px 2.689px 0px rgba(0, 0, 0, 0.10);
  }

  .border-radius34 {
    border-radius: 34px;
    width: 100%;
    height: 100%;
  }

  .border-radius-travel {
    border-radius: 34px;
    margin-left: -15px;
  }

  /* ************************************************************************* */

  .margin-top-delete {
    margin-top: 20px;
  }

  .margin-top-delete-topic {
    margin-top: -30px;
  }

  .margin-top-delete-q-a {
    margin-right: 90px;
    margin-top: -10px;

  }

  .margin-top-delete-travel {
    margin-top: -5px;

  }

  .pages-select-pdf {
    border-radius: 34px;
    background: rgba(170, 255, 250, 0.25);
    box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
    padding: 15px;
    margin-bottom: 15px;
    width: 100%;
    flex-shrink: 0;

  }

  .pages-select-e-gp {
    border-radius: 16.042px;
    /* border: 0.668px solid var(--02, #ECB23F); */
    background: #CDF6F6;
    padding: 15px;
    margin-bottom: 15px;
    flex-shrink: 0;

  }

  .pages-select-q_a {
    width: 888.986px;
    height: auto;
    padding: 13.398px 13.398px 13.398px 16.078px;
    gap: 6.699px;
    flex-shrink: 0;
    border-radius: 22.777px;
    background: #CDF6F6;
    box-shadow: 0px 0px 6.699px 0px rgba(0, 0, 0, 0.25);
  }

  .pages-select-q_a-add {
    margin-top: 40px;
    margin-bottom: 5%;
    padding-left: 5%;
    padding-right: 5%;
    border-radius: 17.085px;
    background: rgba(253, 245, 225, 0.80);
    box-shadow: 0px 0px 6.701px 0px rgba(0, 0, 0, 0.25);
    height: 600px;
    width: 914px;
  }

  .pages-select-q-a-chat {
    margin-top: 40px;
    margin-bottom: 5%;
    padding-left: 5%;
    padding-right: 5%;
    border-radius: 17.085px;
    background: #CDF6F6;
    box-shadow: 0px 0px 6.701px 0px rgba(0, 0, 0, 0.25);
    height: 260px;
    width: 914px;
  }

  .pages-form-es-complain {
    margin-top: 40px;
    margin-bottom: 5%;
    padding-left: 5%;
    padding-right: 5%;
    border-radius: 17.085px;
    background: #CDF6F6;
    box-shadow: 0px 0px 6.701px 0px rgba(0, 0, 0, 0.25);
    height: 600px;
    width: 914px;
  }

  .pages-form-es-complain-q-a {
    margin-top: 40px;
    margin-bottom: 5%;
    padding-left: 5%;
    padding-right: 5%;
    border-radius: 17.085px;
    background: #CDF6F6;
    box-shadow: 0px 0px 6.701px 0px rgba(0, 0, 0, 0.25);
    height: 350px;
    width: 914px;
  }

  .pages-form-es-corruption {
    margin-top: 40px;
    margin-bottom: 5%;
    padding-left: 5%;
    padding-right: 5%;
    border-radius: 17.085px;
    background: #CDF6F6;
    box-shadow: 0px 0px 6.701px 0px rgba(0, 0, 0, 0.25);
    height: 515px;
    width: 914px;
  }

  .pages-follow-complain {
    margin-top: 40px;
    margin-bottom: 5%;
    padding-left: 5%;
    padding-right: 5%;
    border-radius: 17.085px;
    background: #CDF6F6;
    box-shadow: 0px 0px 6.701px 0px rgba(0, 0, 0, 0.25);
    height: 320px;
    width: 667px;
  }

  .pages-follow-complain-detail {
    margin-top: 40px;
    margin-bottom: 5%;
    padding-left: 5%;
    padding-right: 5%;
    border-radius: 17.085px;
    background: rgba(253, 245, 225, 0.80);
    box-shadow: 0px 0px 6.701px 0px rgba(0, 0, 0, 0.25);
    height: auto;
    width: 667px;
  }

  .pages-select-e-service {
    border: 1px solid #6D758F;
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 30px;
  }

  .pages-form-es-complain {
    margin-top: 40px;
    margin-bottom: 5%;
    padding-left: 5%;
    padding-right: 5%;
    border-radius: 17.085px;
    background: #CDF6F6;
    box-shadow: 0px 0px 6.701px 0px rgba(0, 0, 0, 0.25);
    height: 600px;
    width: 914px;
  }

  .detail-q-a {
    width: 914px;
    height: auto;
    padding: 21.438px;
    flex-direction: column;
    align-items: flex-start;
    gap: 13.398px;
    flex-shrink: 0;
    border-radius: 22.777px;
    background: #CDF6F6;
    box-shadow: 0px 0px 6.699px 0px rgba(0, 0, 0, 0.25);
  }

  /* scroll bar เลื่อนซ้ายขวา เลื่อนบนล่าง ****************************************************** */
  .scrollable-container {
    margin-top: 30px;
    max-height: 1000px;
    overflow-y: scroll;
    overflow-x: hidden;
    margin-bottom: 40px;
  }


  .scrollable-container-news {
    max-height: 1250px;
    overflow-y: scroll;
    overflow-x: hidden;
    margin-bottom: 40px;
  }

  .scrollable-container-e-service {
    max-height: 1250px;
    overflow-y: scroll;
    overflow-x: hidden;
    margin-bottom: 40px;
    padding-left: 2%;
  }

  .scrollable-container-500 {
    max-height: 500px;
    overflow-y: scroll;
    overflow-x: hidden;
    margin-bottom: 40px;
  }

  .scrollable-container-550 {
    max-height: 550px;
    overflow-y: scroll;
    overflow-x: hidden;
    margin-bottom: 40px;
  }

  .scrollable-container-otop {
    max-height: 350px;
    overflow-y: scroll;
    overflow-x: hidden;
    margin-bottom: 40px;
    margin-top: 10px;
  }

  .scrollable-container-eGP {
    max-height: 1500px;
    overflow-y: scroll;
    overflow-x: hidden;
    margin-bottom: 40px;
    margin-top: 20px;
  }

  .scrollable-container-gi {
    max-height: 850px;
    overflow-y: scroll;
    overflow-x: hidden;
    margin-bottom: 40px;
    margin-top: 10px;
  }

  .scrollable-container-p {
    max-height: 1200px;
    overflow-y: scroll;
    overflow-x: hidden;
    margin-bottom: 40px;
    margin-top: 10px;
  }

  /* กำหนดสไตล์ scroll bar สำหรับ WebKit (Chrome, Safari) */
  ::-webkit-scrollbar {
    height: 5px;
    width: 5px;
  }

  ::-webkit-scrollbar-track {
    border-radius: 33.559px;
    background: #FFF;
    box-shadow: 0px 2.685px 2.685px 0px rgba(0, 0, 0, 0.25);
  }

  ::-webkit-scrollbar-thumb {
    border-radius: 33.559px;
    background: #082555;
    box-shadow: 0px 2.685px 2.685px 0px rgba(0, 0, 0, 0.25);
  }

  ::-webkit-scrollbar-thumb:hover {
    background: #888;
  }

  /* scroll bar เลื่อนซ้ายขวา เลื่อนบนล่าง ****************************************************** */

  .content-e-service {
    margin-top: 50px;
  }

  /* ให้ทุุกอย่างที่อยู่ใน bg background มันอยู่ตรงกลาง ******************************************** */
  .bg-personnel-s {
    background-image: url('<?php echo base_url("docs/k.bg-personnel.png"); ?>');
    background-repeat: no-repeat;
    background-size: 100%;
    width: 198px;
    height: 238px;
    display: grid;
    place-items: center;
  }

  .rounded-image-s {
    width: 188px;
    height: 229px;
  }

  /* รูปบุคลากรแบบวงกลม personnel */
  /* .bg-personnel-m {
    background-image: url('<?php echo base_url("docs/bg-personnel-s.png"); ?>');
    background-repeat: no-repeat;
    background-size: 100%;
    width: 298px;
    height: 298px;
    display: grid;
    place-items: center;
  }

  .rounded-image-m {
    width: 250px;
    height: 270px;
    clip-path: ellipse(55% 50% at 50% 50%);
  } */

  .center-center {
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .show {
    z-index: 999;
    display: none;
  }

  .show .overlay {
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, .66);
    position: fixed;
    top: 0;
    left: 0;
    z-index: 10;
  }

  .show .img-show {
    width: 1000px;
    height: 700px;
    background: #FFF;
    position: absolute;
    /* เปลี่ยนเป็น position: absolute; */
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    overflow: hidden;
    z-index: 999;

  }

  @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
    .show .img-show {
      width: 1000px;
      height: 700px;
      left: 50%;
      transform: translate(-50%, -50%);
      margin-top: 40%;
    }
  }

  .img-show img {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
  }

  select.custom-select {
    color: #082555;
    font-family: Kanit;
    font-size: 20.102px;
    font-style: normal;
    font-weight: 500;
    line-height: 42.294px;
    background-image: url('<?php echo base_url("docs/icon-down.png"); ?>');
  }

  select.custom-select option {
    color: black;
  }

  .input-radius {
    border-radius: 20px;
    background: #fff;
    text-align: center;
    height: 47px;
  }

  .test {
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .flex-nowrap {
    display: flex;
    flex-wrap: nowrap;
  }

  .container-pages {
    padding-left: 110px;
    padding-right: 105px;
  }

  .container-pages-news {
    padding-left: 110px;
    padding-right: 110px;
  }

  .container-pages-detail {
    padding-left: 100px;
    padding-right: 100px;
  }

  .border-radius24 {
    border-radius: 100px;
    background: url(<path-to-image>), lightgray -1.724px 0px / 101.139% 100% no-repeat;
    box-shadow: 1.337px 1.337px 2.005px 0px rgba(0, 0, 0, 0.25);
    width: 50.131px;
    height: 50.439px;
    flex-shrink: 0;
  }

  .style-col-img {
    margin-top: -3px;
  }

  .font-gi-head {
    color: #082555;
    font-family: Kanit;
    font-size: 24px;
    font-style: normal;
    font-weight: 500;
    line-height: 24px;
  }

  .font-gi-content {
    color: #000;
    font-family: Kanit;
    font-size: 22px;
    font-style: normal;
    font-weight: 300;
    line-height: 24px;
  }

  .font-gi-target {
    color: #000;
    font-family: Kanit;
    font-size: 22px;
    font-style: normal;
    font-weight: 300;
    line-height: 24px;
  }

  .pad-left-35 {
    padding-left: 35px;
  }

  .mar-fb {
    margin-top: 120px;
  }

  .mar-es-intra {
    padding-top: 55px;
  }

  .mar-ita {
    padding-top: 10px;
  }

  .mar-right-10 {
    margin-right: 10px;
  }

  #SubmitLike {
    border: none;
    padding: 0;
    background: none;
    cursor: pointer;
  }

  #confirmButton {
    border: none;
    padding: 0;
    background: none;
    cursor: pointer;
  }

  #loginBtn {
    border: none;
    padding: 0;
    background: none;
    cursor: pointer;
  }

  .btn-ita-open {
    color: #fff;
    background: #06C8B1;
    font-size: 20px;
    font-weight: 500;
    font-family: kanit;
    border-radius: 25px;
    width: 91px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0px 2px 0px 2px rgba(0, 0, 0, 0.15);
  }

  .btn-ita-open:hover {
    color: #693708;
    background: #06BCC8;
    font-size: 20px;
    font-weight: 500;
    font-family: kanit;
  }

  .bg-ita-color {
    border-top: 1px solid #ECB23F;
    border-bottom: 1px solid #ECB23F;
    background: #FFF4D0;
    padding-bottom: 20px;
  }

  .page-travel-content {
    height: 140px;
  }

  .pagination-next-prev {
    padding-right: 50px;
  }

  .font-head-travel {
    color: #000;
    leading-trim: both;
    text-edge: cap;
    font-feature-settings: 'clig' off, 'liga' off;
    font-family: Inter;
    font-size: 26.895px;
    font-style: normal;
    font-weight: 600;
    line-height: 26.895px;
    /* 100% */
  }

  .laws_ral_content {
    padding-left: 20px;
  }

  .dot-laws::before {
    content: '\2022';
    /* รหัสของ bullet point */
    color: black;
    /* สีของ bullet point */
    display: inline-block;
    width: 1em;
    /* ขนาดของ bullet point */
    margin-right: 0.5em;
    /* ระยะห่างระหว่าง bullet point กับข้อความ */
  }

  .pl-30 {
    padding-left: 30px;
  }

  .bg-how-e-service {
    background-image: url('<?php echo base_url("docs/bg-how-e-service.png"); ?>');
    background-repeat: no-repeat;
    background-size: 100%;
    width: 848px;
    height: 70px;
    display: flex;
    /* หรือใช้ display: grid; */
    align-items: center;
    /* หรือใช้ justify-content: center; ถ้าใช้ display: grid; */
    margin-left: 15px;
    padding-left: 40px;
  }

  .bg-head-e-service {
    border-radius: 50px;
    background: #FFFCF1;
    box-shadow: 2px 2px 10px 0px rgba(0, 0, 0, 0.25);
    width: 418px;
    height: 70px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    margin-top: 30px;
    padding-left: 30px;

  }

  .bg-content-e-service {
    border-radius: 34px;
    background: #FFFCF1;
    width: 848px;
    height: auto;
    flex-shrink: 0;
    box-shadow: 2px 2px 10px 0px rgba(0, 0, 0, 0.25);
    margin-top: 20px;
    padding: 15px 50px;
  }

  .pl-13p {
    padding-left: 13%;
  }

  .pl-20 {
    padding-left: 20px;
  }

  .bg-video {
    background-image: url('<?php echo base_url("docs/k.bg-video2.jpg"); ?>');
    background-repeat: no-repeat;
    background-size: 100%;
    height: 2170px;
    width: 1280px;
    margin: auto;
  }

  .bg-content-video {
    background-image: url('<?php echo base_url("docs/k.bg-frame-video.png"); ?>');
    background-repeat: no-repeat;
    background-size: 100%;
    height: 334px;
    width: 528px;
    margin: auto;
    margin-top: 35px;
    padding-left: 23px;
    padding-top: 17px;
  }

  .text-content-travel {
    color: #F9CC42;
    text-shadow: -1px 0 #014674, 0 2px #014674,
      2px 0 #014674, 0 -1px #014674;
    font-family: Kanit;
    font-size: 32px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
  }

  .text-content-otop {
    color: #F9CC42;
    /* text-shadow: -1px 0 #014674, 0 2px #014674,
      2px 0 #014674, 0 -1px #014674; */
    font-family: Kanit;
    font-size: 32px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
  }

  .bg-qa-list {
    background-image: url('<?php echo base_url("docs/t-bg-qa-list.png"); ?>');
    background-repeat: no-repeat;
    background-size: 100%;
    height: 513px;
    width: 702px;
    margin: auto;
    padding: 95px 22px;
  }

  .bg-content-qa-list {
    padding: 0 16.529px;
    align-items: center;
    gap: 38.018px;
    align-self: stretch;
    border-radius: 82.647px;
    border: 1px solid #006DBC;
    background: #FFF;
    width: 653px;
    height: 42px;
  }

  .font-qa-list-content {
    color: #000;
    leading-trim: both;
    text-edge: cap;
    font-feature-settings: 'clig' off, 'liga' off;
    font-family: Kanit;
    font-size: 14.876px;
    font-style: normal;
    font-weight: 400;
  }

  .font-qa-list-content-name {
    color: #000;
    leading-trim: both;
    text-edge: cap;
    font-feature-settings: 'clig' off, 'liga' off;
    font-family: Kanit;
    font-size: 13.224px;
    font-style: normal;
    font-weight: 300;
  }

  .image-slide-stick-mid {
    position: fixed;
    top: 35%;
    left: 0;
    bottom: 0;
    overflow-y: auto;
    z-index: 9999;
    /* ตั้งค่า z-index ที่มากกว่าปุ่มปิด */
    width: 410px;
  }

  .close-button-slide-mid {
    position: absolute;
    top: 0;
    right: 0;
    /* สีปุ่มปิด */
    border: none;
    cursor: pointer;
  }
  .font-ita-content-detail {
    color: #000;
    font-family: Kanit;
    font-size: 20px;
    font-style: normal;
    padding-left: 150px;
  }
</style>