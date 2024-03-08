<style>
    body {
        padding: 0;
        margin: 0;

    }

    main {
        margin: 0 auto;
        padding: 0;
        width: 100%;
        max-width: 1280px;
        /* กำหนดความกว้างสูงสุดที่ 1280px */
        height: 2000px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .bg-header {
        /* The image used */
        background-image: url('<?php echo base_url("docs/s.navbar-intranet.png"); ?>');
        width: 1280px;
        height: 62px;
        /* Center the image horizontally and vertically */
        background-position: center center;
        /* Do not repeat the background image */
        background-repeat: no-repeat;
        /* Cover the entire div with the background image */
        background-size: cover;
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
    .form__icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #6D758F;
        /* เลือกสีที่ต้องการ */
        z-index: 2;
        cursor: pointer;
    }

    .search {
        margin-right: 1%;
        width: 336px;
        height: 35px;
    }

    .searchTerm {
        border-radius: 84.414px;
        box-shadow: 0px 0px 4px 0px rgba(0, 0, 0, 0.15);
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
        background-color: #F8F8F8;
        width: 1280px;
    }

    .flex-item-left {
        flex: 0 0 22%;
        /* 30% ของขนาดเริ่มต้นของ container */
        background-color: #309b4d;
        color: #E4E4E4;
        /* เพิ่มสีพื้นหลังเพื่อดูง่ายขึ้น */
    }

    .flex-item-right {
        flex: 1;
        /* รับพื้นที่ที่เหลือทั้งหมด */
        /* background-color: #f8f8f8; */
        margin-left: 30px;
        margin-top: 50px;
        border-radius: 34px;
        background: #FFF;
        box-shadow: 0px 4px 1px 0px rgba(0, 0, 0, 0.08);
    }

    .flex-item-right-share-file {
        flex: 1;
        /* รับพื้นที่ที่เหลือทั้งหมด */
        /* background-color: #f8f8f8; */
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
        background-size: cover cover; */
        background-color: #E4E4E4;
        height: 1138px;
        width: 240px;
    }



    .border-navbar {
        border: 1px solid white;
        width: 80%;
        margin-left: auto;
        margin-right: auto;
    }

    .navbar-right {
        margin-left: 20%;
        padding-right: 9px;
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
        background-color: #6BBF4D;
        /* สีเขียว */
        border-color: #6BBF4D;
        color: #fff;
    }

    .pagination .page-link {
        color: #000;
        background-color: #F1F3F7;

    }

    .pagination .page-link:hover {
        color: #F1F3F7;
        background-color: #07834D;
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

    .credit {
        background: linear-gradient(180deg, #6BBF4D 28.67%, #07834D 100%);
        height: 80px;
        padding-top: 20px;
    }

    /* .footer {
        background-image: url('<?php echo base_url("docs/s.bg-footer.png"); ?>');
        background-repeat: no-repeat;
        background-size: 100%;
        background-position: center center;
        min-height: 425px;
        width: 1280px;
        position: relative;
        z-index: 2;
        margin-top: -350px;
    } */

    /* เอา ::marker ออกจาก dropdown menu */
    .dropdown-menu li {
        list-style-type: none;
    }

    /* ปรับ margin ของแต่ละรายการเพื่อให้ไม่มีระยะห่าง */
    .dropdown-menu li a {
        margin: 0;
    }

    .bg-notify {
        background: #fff;
        border-radius: 50%;
        width: 41.37px;
        height: 39px;
        flex-shrink: 0;
    }

    .input-group {
        display: flex;
    }

    .input-group-prepend {
        margin-right: 10px;
        /* ปรับตำแหน่งของ icon ตามความต้องการ */
        display: flex;
        align-items: center;
    }

    .fa-bell {
        transform: scale(1.5);
        /* ปรับขนาดตามที่ต้องการ */
    }

    .btn-navbar {
        color: var(--, #6D758F);
        font-family: Kanit;
        font-size: 18px;
        font-style: normal;
        font-weight: 400;
        line-height: 50px;
        width: 206px;
        height: 41.718px;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .btn-navbar:hover {
        width: 206px;
        height: 41.718px;
        flex-shrink: 0;
        fill: #FFF;
        filter: drop-shadow(2px 4px 4px rgba(0, 0, 0, 0.15));
        color: #FFBA5E;
        font-family: Kanit;
        font-size: 18px;
        font-style: normal;
        font-weight: 500;
        line-height: 50px;
        background-color: #FFF;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .btn-navbar.active {
        width: 206px;
        height: 41.718px;
        flex-shrink: 0;
        fill: #FFF;
        filter: drop-shadow(2px 4px 4px rgba(0, 0, 0, 0.15));
        color: #FFF;
        font-family: Kanit;
        font-size: 18px;
        font-style: normal;
        font-weight: 500;
        line-height: 50px;
        background-color: #FFBA5E;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .banner{
        width: 1280px;
        height: 373px;
        z-index: 1 ;
    }

    .navbar-bottom{
        z-index: 5;
        margin-top: -20px;
    }
</style>