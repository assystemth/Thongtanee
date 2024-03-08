<style>
  body {
    margin: 0px;
    padding: 0px;
    font-family: 'Kanit', sans-serif;
    font-weight: 300;
  }

  .bg-gradient-custom {
    background-color: #006DBC;
  }

  .btn-custom {
    background-color: #006DBC;
  }

  .btn-custom:hover {
    background-color: #C1DEFF;
  }

  .white{
    color: #ffff;
  }

  .red-add {
    color: red;
    font-size: 14px;
  }

  .black-add {
    color: gray;
    font-size: 14px;
  }

  .form-group {
    display: flex;
    align-items: center;
  }

  .form-group label {
    flex: 1;
    text-align: right;
    padding-right: 10px;
  }

  .form-group input {
    flex: 2;
  }

  /* เปลี่ยนสีพื้นหลังหน้าเนื้อหา */
  #content {
    background-color: white;
  }

  /* css ของตาราง table */
  /* ปรับแต่งข้อความ "Show X entries" */
  .dataTables_length label {
    font-size: 12px;
    /* ปรับขนาดตัวอักษร */
    display: inline-flex;
    /* จัดเรียงให้อยู่ในแถวเดียวกัน */
    align-items: center;
    /* จัดให้เนื้อหาแนวกึ่งกลางตามแนวดิ่ง */
    margin: auto;
    /* ระยะห่างของข้อความและ dropdown */
  }

  /* ปรับขนาด dropdown */
  .dataTables_length select {
    font-size: 12px;
    /* ปรับขนาดตัวอักษรใน dropdown */
    height: 25px;
    /* ปรับความสูงของ dropdown */
    width: 60px;
    /* ปรับความกว้างของ dropdown */
  }

  /* เปลี่ยนสีพื้นหลังของหัวข้อ th ในตาราง */
  /* #dataTable th {
    background-color: #f5f5f5;
  } */

  /* เปลี่ยนสีพื้นหลังของ th เป็นสีแดง */
  .table th {
    background-color: #f2f2f2;
    /* สีพื้นหลังสำหรับ th */
    color: white;
    /* สีข้อความใน th เพื่อให้อ่านง่าย */
  }

  .limited-text {
    max-width: 10px;
    /* กำหนดความยาวสูงสุดของเซลล์ */
    white-space: nowrap;
    /* ไม่ยอมขึ้นบรรทัดใหม่ */
    overflow: hidden;
    /* ซ่อนข้อความที่เกินความยาว */
    text-overflow: ellipsis;
    /* แสดง ... เมื่อข้อความเกินความยาว */
  }

  /* เพิ่มเส้นขอบด้านซ้ายสุดและขวาสุดของตาราง */
  #newdataTables {
    border-left: 1px solid #a3a3a3;
    /* เส้นขอบด้านซ้ายสุด */
    border-right: 1px solid #a3a3a3;
    /* เส้นขอบด้านขวาสุด */
    border-bottom: 1px solid #a3a3a3;
    border-top: 1px solid #a3a3a3;
  }

  #newdataTables th {
    border-top: 1px solid #a3a3a3;
    /* เส้นขอบด้านซ้าย */
    border-bottom: 1px solid #a3a3a3;
    /* เส้นขอบด้านซ้าย */
  }

  /* เปลี่ยนสีตัวอักษรใน thead เป็นสีดำ */
  #newdataTables thead th {
    color: black;
  }

  .add-btn {
    background-color: #83d37c;
    /* เปลี่ยนสีพื้นหลังปุ่ม */
    color: black;
  }

  /* กำหนดสีเดิมเมื่อ hover */
  .add-btn:hover {
    background-color: #83d37c;
    /* เปลี่ยนสีพื้นหลังปุ่มเป็นสีเดิม */
    color: black;
  }

  /* ตัวหนังสือสีดำ */
  .font-black {
    color: black;
  }

  .file-container {
    display: flex;
    align-items: center;
    justify-content: flex-end;
  }

  .chart-container {
    width: 50%;
    height: 50%;
    margin: auto;
  }

  /* ใช้เพื่อลบเส้นข้างในตาราง */
  .custom-table {
    border-collapse: collapse;
  }

  /* ใช้เพื่อสร้างกรอบโค้งด้านนอกของตาราง */
  .custom-table {
    border-collapse: separate;
    border-spacing: 10px;
    /* ปรับระยะห่างของกรอบโค้ง */
    border-radius: 20px;
    /* ปรับขอบโค้งของกรอบโค้ง */
    overflow: hidden;
    /* ป้องกันขอบโค้งเกินขอบตาราง */
  }

  /* สำหรับเซลล์ในตาราง */
  .custom-table th,
  .custom-table td {
    padding: 8px;
    /* ปรับระยะห่างของข้อมูลภายในเซลล์ */
  }

  /* เปลี่ยนสีพื้นหลังของ th เป็นสีแดง */
  .custom-table th {
    background-color: #fff;
    /* สีพื้นหลังสำหรับ th */
    color: black;
    /* สีข้อความใน th เพื่อให้อ่านง่าย */
  }


  /* เส้นขั้นแนวนอนระหว่าง td ในตาราง */
  .custom-table td {
    border-bottom: 1px solid #ddd;
    /* เปลี่ยนสีและรูปแบบขอบของเส้นขั้นแนวนอน */
  }

  .path {
    font-size: 12px;
    color: #888;
  }

  .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
  }

  .modal-content {
    background-color: #fff;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 600px;
    position: relative;
  }

  /* เริ่มต้น: ปุ่มเล็ก */
  .responsive-btn-ban {
    font-size: 12px;
    padding: 5px 10px;
    /* ปรับขนาดของปุ่มตามที่คุณต้องการ */
  }

  /* ใช้ Flexbox หรือ Grid Layout ให้ปุ่มขยายเมื่อหน้าจอกว้างขึ้น */
  @media screen and (min-width: 1500px) {
    .responsive-btn-ban {
      font-size: 13px;
      /* ปรับขนาดของปุ่มเมื่อหน้าจอกว้างขึ้น */
      padding: 10px 20px;
      /* ปรับขนาดของปุ่มเมื่อหน้าจอกว้างขึ้น */
    }
  }

  .switch {
    --button-width: 3.5em;
    --button-height: 1.5em;
    --toggle-diameter: 1.0em;
    --button-toggle-offset: calc((var(--button-height) - var(--toggle-diameter)) / 2);
    --toggle-shadow-offset: 10px;
    --toggle-wider: 3em;
    --color-grey: #cccccc;
    --color-green: #83d37c;
  }

  .slider {
    display: inline-block;
    width: var(--button-width);
    height: var(--button-height);
    background-color: var(--color-grey);
    border-radius: calc(var(--button-height) / 2);
    position: relative;
    transition: 0.3s all ease-in-out;
  }

  .slider::after {
    content: "";
    display: inline-block;
    width: var(--toggle-diameter);
    height: var(--toggle-diameter);
    background-color: #fff;
    border-radius: calc(var(--toggle-diameter) / 2);
    position: absolute;
    top: var(--button-toggle-offset);
    transform: translateX(var(--button-toggle-offset));
    box-shadow: var(--toggle-shadow-offset) 0 calc(var(--toggle-shadow-offset) * 4) rgba(0, 0, 0, 0.1);
    transition: 0.3s all ease-in-out;
  }

  .switch input[type="checkbox"]:checked+.slider {
    background-color: var(--color-green);
  }

  .switch input[type="checkbox"]:checked+.slider::after {
    transform: translateX(calc(var(--button-width) - var(--toggle-diameter) - var(--button-toggle-offset)));
    box-shadow: calc(var(--toggle-shadow-offset) * -1) 0 calc(var(--toggle-shadow-offset) * 4) rgba(0, 0, 0, 0.1);
  }

  .switch input[type="checkbox"] {
    display: none;
  }

  .switch input[type="checkbox"]:active+.slider::after {
    width: var(--toggle-wider);
  }

  .switch input[type="checkbox"]:checked:active+.slider::after {
    transform: translateX(calc(var(--button-width) - var(--toggle-wider) - var(--button-toggle-offset)));
  }

  .popup {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1;
    overflow: auto;
  }

  .popup-content {
    background-color: #fff;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
  }

  .close-button {
    float: right;
    /* ชิดขวา  */
    color: white;
    display: none;
  }

  .limit-font-one {
    /* margin-bottom: 10px; */
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
  }

  .hide {
    display: none !important;
  }
</style>