<style>
    body {
        margin: 0px;
        padding: 0px;
        font-family: 'Kanit', sans-serif;
        background: #F8F8F8;
    }

    .bg-header {
        /* The image used */
        background-image: url('<?php echo base_url("docs/intranet/navbar-intranet19v4.png"); ?>');
        background-size: contain;
        background-repeat: no-repeat;
        width: 100%;
        height: 7.7vh;
        z-index: 2;

    }

    .welcome {
        background-image: url('<?php echo base_url("docs/intranet/welcome19v2.jpg"); ?>');
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        z-index: 1;
        width: 100%;
        height: 44.2vh;
    }

    .welcome-btm {
        width: 100%;
        height: 10vh;
        margin-top: -75px;
        z-index: 2;
    }



    /* สีทั้งหมด color-all ********************************************************************  */
    .black {
        color: #000;
    }

    .font-gray-static {
        color: #6D758F;
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

    .white {
        color: white;
    }

    /* ************************************************************************************** */

    /* ตัวอักษรทั้งหมด font-all ****************************************************************  */
    .font-16 {
        font-size: 16px;
    }

    .font-18 {
        font-size: 18px;
    }

    .font-20 {
        font-size: 20px;
    }

    .font-24b {
        font-size: 24px;
        font-weight: bold;
    }

    .font-head {
        font-size: 35px;
        font-weight: bold;
    }

    /* ************************************************************************************** */

    /* เส้นทั้งหมด line-all ********************************************************************  */
    .border-gray-100 {
        border: 1px solid #888;
        width: 100%;
    }

    /* ****************************************************************************************** */

    /* กำหนดการแสดงผลตัวอักษร limit-text limit-font ************************************************************  */
    .limit-font-one {
        /* margin-bottom: 10px; */
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }

    .limit-font-two {
        /* margin-bottom: 10px; */
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .limit-font-four {
        /* margin-bottom: 10px; */
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
    }

    .limit-font-five {
        /* margin-bottom: 10px; */
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 5;
        -webkit-box-orient: vertical;
    }

    .limit-font-six {
        /* margin-bottom: 10px; */
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 6;
        -webkit-box-orient: vertical;
    }

    /* ****************************************************************************** */

    /* scroll bar เลื่อนซ้ายขวา เลื่อนบนล่าง ****************************************************** */
    .scrollable-bar {
        max-height: 90%;
        overflow-x: hidden;
        overflow-y: scroll;
    }

    /* .scrollable-process {
        max-height: 1200px;
        overflow-x: auto;
        overflow-y: scroll;
        margin-top: 50px;
    } */



    /* กำหนดสไตล์ scroll bar สำหรับ WebKit (Chrome, Safari) */
    ::-webkit-scrollbar {
        height: 5px;
        width: 5px;
    }

    ::-webkit-scrollbar-track {
        background: #fff;
    }

    ::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #888;
    }

    /* scroll bar เลื่อนซ้ายขวา เลื่อนบนล่าง ****************************************************** */

    .search {
        margin-right: 1%;

    }

    .searchTerm {
        border-radius: 15px;

    }

    .searchButton {
        border-radius: 15px;
        background-color: #fff;
        color: #888;
        transition: color 0.3s ease;
    }

    .searchButton:hover {
        color: #fff;
        background-color: greenyellow;

    }

    .logout {
        color: #fff;
        transition: color 0.3s ease;
        /* เพิ่ม transition เพื่อทำให้สีเปลี่ยนไปมาอย่างนุ่มนวล */
    }

    .logout:hover {
        color: greenyellow;
    }

    .menu {
        display: flex;
        margin-top: 1.6%;
        height: 110vh;
        background-color: #F4F4F4;
    }

    .flex-item-left {
        flex: 0 0 20%;
        background-color: #F8F8F8;
        color: #fff;
        /* เพิ่มสีพื้นหลังเพื่อดูง่ายขึ้น */
    }

    .flex-item-right {
        flex: 1;
        /* รับพื้นที่ที่เหลือทั้งหมด */
        /* background-color: #E4E4E4; */
        margin-left: 5%;
        margin-right: 5%;
    }

    .flex-item-right-share-file {
        flex: 1;
        /* รับพื้นที่ที่เหลือทั้งหมด */
        /* background-color: #F8F8F8; */
        margin-left: 2%;
        margin-right: 2%;
    }

    .flex-item-right-form {
        flex: 1;
        /* รับพื้นที่ที่เหลือทั้งหมด */
        /* background-color: #f8f8f8; */
        margin-left: 4%;
        margin-right: 4%;
    }

    .bg-navbar {
        /* background-image: url('<?php echo base_url("docs/bg-intra-navbar3.png"); ?>');
        background-repeat: no-repeat;
        background-size: cover cover;
        height: 100%; */
        background-color: #F8F8F8;
    }



    .border-navbar {
        border: 1px solid white;
        width: 80%;
        margin-left: auto;
        margin-right: auto;
    }

    .navbar-right {
        margin-left: 10%;
        padding-right: 10px;
    }

    .box-folder {
        padding: 20px;
        border: 1px solid #E6E6E6;
        border-radius: 24px;

        /* เงาด้านล่าง กับ ขวา ตัวสุดท้ายคือความใหญ่ หรือ blur */
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        /* เงาด้านล่าง กับ ซ้าย */
        /* box-shadow: -2px 2px 5px rgba(0, 0, 0, 0.2); */
        /* เงาทั้ง4ด้าน เงาทุกด้าน */
        /* box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2),
                -5px -5px 10px rgba(0, 0, 0, 0.2); */
    }

    .box-folder-detail {
        padding: 20px;
        border: 1px solid #E6E6E6;
        border-radius: 24px;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        height: 67vh;
    }

    .font-folder {
        font-size: 24px;
        color: #000;
    }

    .font-folder-detail {
        font-size: 26px;
        color: #000;
        font-weight: bold;
    }

    .underline {
        text-decoration: none;
    }

    .underline:hover {
        text-decoration: none;
    }

    .break-word {
        word-wrap: break-word;
    }

    .file-pdf {
        padding: 20px;
        border: 1px solid #E6E6E6;
        border-radius: 15px;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);

    }

    .form-add {
        margin-top: 4%;
        padding: 20px;
        border: 1px solid #E6E6E6;
        border-radius: 15px;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        height: 85%;
    }

    .form-detail {
        margin-top: 4%;
        padding: 10px 20px;
        border: 1px solid #E6E6E6;
        border-radius: 15px;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        height: 80vh;
    }

    /* ปุ่ม next page pagination ******************************************** */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .pagination li {
        margin: 0 5px;
        font-size: 30px;
        font-weight: bold;

    }

    .pagination .page-item.active .page-link {
        background-color: #0FC2C0;
        /* สีเขียว */
        border-color: #0FC2C0;
        color: #fff;
    }

    .pagination .page-link {
        color: #000;
        background-color: #F1F3F7;

    }

    .pagination .page-link:hover {
        color: #000;
        background-color: #E9E9E9;
    }

    .popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 80%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1;
        overflow: auto;
        margin-left: 21.5%;
        margin-top: 5%;
    }

    .popup-content {
        background-color: #fff;
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 70%;
        border-radius: 24px;
    }

    .red-add {
        color: red;
        font-size: 14px;
    }

    .footer {
        background-image: url('<?php echo base_url("docs/intranet/bg-footer19.png"); ?>');
        background-size: contain;
        background-repeat: no-repeat;
        width: 100vw;
        height: 34vh;
        z-index: 2;
        padding-top: 150px;
    }

    .font-footer {
        font-size: 19px;
        color: #000;
    }

    /* .credit {
        background-image: url('<?php echo base_url("docs/intranet/bg-footer19.png"); ?>');
        background-size: contain;
        background-repeat: no-repeat;
        width: 100vw;
        height: 10vh;
        z-index: 2;
    } */

    .card-all-report {
        border-radius: 14px;
        background: #FFF;
        box-shadow: 0px 4px 0px 0px rgba(0, 0, 0, 0.15);
        width: 100%;
        height: auto;
        padding: 25px 30px;
    }

    .font-topic-all-report {
        color: #000;
        font-family: Kanit;
        font-size: 30px;
        font-style: normal;
        font-weight: 1000;
        line-height: 31.685px;
        /* 176.027% */
    }

    .font-head-all-report {
        color: #000;
        font-family: Kanit;
        font-size: 24px;
        font-style: normal;
        font-weight: 400;
        line-height: 16.894px;
        /* 93.858% */
    }

    .font-detail-all-report {
        color: #000;
        font-family: Kanit;
        font-size: 18px;
        font-style: normal;
        font-weight: 300;
        line-height: normal;
    }

    .box-content-report1 {
        filter: drop-shadow(2px 4px 4px rgba(0, 0, 0, 0.15));
        width: 100%;
        height: 50px;
        border: solid 2px #F5900A;
        padding: 8px 15px;
        border-radius: 14px;
    }

    .box-content-report2 {
        filter: drop-shadow(2px 4px 4px rgba(0, 0, 0, 0.15));
        width: 100%;
        height: 50px;
        border: solid 2px #DBFFDD;
        padding: 8px 15px;
        border-radius: 14px;
    }

    .box-content-report3 {
        filter: drop-shadow(2px 4px 4px rgba(0, 0, 0, 0.15));
        width: 100%;
        height: 50px;
        border: solid 2px #FFA085;
        padding: 8px 15px;
        border-radius: 14px;
    }

    .box-content-report4 {
        filter: drop-shadow(2px 4px 4px rgba(0, 0, 0, 0.15));
        width: 100%;
        height: 50px;
        border: solid 2px #CFE5FF;
        padding: 8px 15px;
        border-radius: 14px;
    }

    .box-content-report5 {
        filter: drop-shadow(2px 4px 4px rgba(0, 0, 0, 0.15));
        width: 100%;
        height: 50px;
        border: solid 2px #CFD7FE;
        padding: 8px 15px;
        border-radius: 14px;
    }

    .box-content-report6 {
        filter: drop-shadow(2px 4px 4px rgba(0, 0, 0, 0.15));
        width: 100%;
        height: 50px;
        border: solid 2px #FFD361;
        padding: 8px 15px;
        border-radius: 14px;
    }

    .box-content-report7 {
        filter: drop-shadow(2px 4px 4px rgba(0, 0, 0, 0.15));
        width: 100%;
        height: 50px;
        border: solid 2px #FFE3E3;
        padding: 8px 15px;
        border-radius: 14px;
    }

    .card-all-complain {
        border-radius: 14px;
        background: #FFF;
        box-shadow: 0px 4px 0px 0px rgba(0, 0, 0, 0.15);
        width: 100%;
        height: auto;
        padding: 25px 30px;
    }

    .limit-font-one {
        /* margin-bottom: 10px; */
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }

    .btn-all-complain {
        border-radius: 14px;
        background: #FFBA5D;
        width: 103px;
        height: 38.351px;
        flex-shrink: 0;
        color: #fff;
    }

    .btn-all-complain:hover {
        background: #FFBA5D;
        color: #fff;
    }

    .line-complain-left1 {
        border-left: solid 3px #875DFF;
        height: 40px;
    }

    .line-complain-left2 {
        border-left: solid 3px #F5900A;
        height: 40px;
    }

    .bg-complain-all {
        border-radius: 34px;
        background: #FFF;
        box-shadow: 0px 4px 1px 0px rgba(0, 0, 0, 0.08);
        width: 100%;
        height: auto;
        padding: 25px 30px;
    }

    .font-topic-all-complain {
        color: #000;
        font-family: Kanit;
        font-size: 24px;
        font-style: normal;
        font-weight: 1000;
        line-height: 31.685px;
        /* 176.027% */
    }

    .scrollable-container {
        max-height: 90vh;
        overflow-y: scroll;
        overflow-x: hidden;
        margin-bottom: 40px;
    }
    .pad-30{
        padding-top: 30px;
    }
    .pad-10{
        padding-top: 10px;
    }
</style>