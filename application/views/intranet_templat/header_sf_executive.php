<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="X-UA-Compatible" content="ie=edge" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cdbootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cdbootstrap/css/cdb.min.css" />
<script src="https://cdn.jsdelivr.net/npm/cdbootstrap/js/cdb.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/cdbootstrap/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/9d1d9a82d2.js" crossorigin="anonymous"></script> -->
    <link rel="icon" href="<?php echo base_url("docs/logo.png"); ?>" type="image/x-icon">

    <title>เทศบาลธงธานี - ระบบอินทราเน็ต</title>
    <!-- boostrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- icon -->
    <link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
    <!-- icon boostrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- CKEditor word -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <!-- sweetalert 2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.min.css">
    <!-- CCTV video -->
    <link href="https://vjs.zencdn.net/7.14.3/video-js.css" rel="stylesheet">
    <script src="https://vjs.zencdn.net/7.14.3/video.js"></script>


    <!-- admin Dashboard -->
    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?= base_url('asset/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="<?= base_url(); ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body>

    <!-- Main Content -->
    <!-- <div id="content"></div> -->
    <div class="bg-header">
        <div class="d-flex justify-content-end" style="padding-top: 0.7%;">
            <!-- <div class="search">
                <form id="searchForm" action="<?= site_url('Intra_share_file/search_sf_executive'); ?>" method="post">
                    <div class="input-group">
                        <input type="text" name="search_term" class="searchTerm form-control" placeholder="ค้นหา">
                        <div class="input-group-append">
                            <button type="submit" class="searchButton btn btn-outline">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div> -->
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="row" style="width: 220px;">
                        <div class="col-6" >
                            <span class="font-header-name limit-font-one"><?php echo $this->session->userdata('m_fname'); ?>&nbsp;<?php echo $this->session->userdata('m_lname'); ?></span>
                            <span class="font-rank-name limit-font-one">
                                <?php
                                $m_level = $this->session->userdata('m_level');
                                if ($m_level == 1) {
                                    echo "System Admin";
                                } elseif ($m_level == 2) {
                                    echo "Super Admin";
                                } elseif ($m_level == 3) {
                                    echo "ทำเนียบเทศบาลธงธานี";
                                } elseif ($m_level == 4) {
                                    echo "คณะผู้บริหาร";
                                } elseif ($m_level == 5) {
                                    echo "สมาชิกสภาตำบล";
                                } elseif ($m_level == 6) {
                                    echo "หัวหน้าส่วนราชการ";
                                } elseif ($m_level == 7) {
                                    echo "พนักงานเทศบาล";
                                } elseif ($m_level == 8) {
                                    echo "สำนักปลัด";
                                } elseif ($m_level == 9) {
                                    echo "กองคลัง";
                                } elseif ($m_level == 10) {
                                    echo "กองช่าง";
                                } elseif ($m_level == 11) {
                                    echo "กองประปา";
                                } elseif ($m_level == 12) {
                                    echo "กองสาธารณสุขและสิ่งแวดล้อม";
                                } elseif ($m_level == 13) {
                                    echo "กองการศึกษาศาสนาและวัฒนธรรม";
                                } else {
                                    echo "ตำแหน่งไม่ถูกต้อง";
                                }
                                ?>
                            </span>
                        </div>
                        <div class="col-6">
                            <img class="img-profile rounded-circle" src="<?php echo base_url('docs/img/') . $this->session->userdata('m_img'); ?>">
                        </div>
                    </div>
                </a>

                <div class="dropdown-menu" aria-labelledby="userDropdown">
                    <!-- Dropdown เนื้อหาที่นี่ -->
                    <!-- <a class="dropdown-item" href="<?php echo site_url('system_admin/profile'); ?>">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile
                    </a> -->
                    <div class="row">
                        <div class="col-3">
                            <img class="img-profile rounded-circle" src="<?php echo base_url('docs/img/') . $this->session->userdata('m_img'); ?>">
                        </div>
                        <div class="col-9">
                            <span class="font-dropdown-name"><?php echo $this->session->userdata('m_fname'); ?>&nbsp;<?php echo $this->session->userdata('m_lname'); ?></span>
                            <br><span class="">
                                <?php
                                $m_level = $this->session->userdata('m_level');
                                if ($m_level == 1) {
                                    echo "System Admin";
                                } elseif ($m_level == 2) {
                                    echo "Super Admin";
                                } elseif ($m_level == 3) {
                                    echo "ทำเนียบเทศบาลธงธานี";
                                } elseif ($m_level == 4) {
                                    echo "คณะผู้บริหาร";
                                } elseif ($m_level == 5) {
                                    echo "สมาชิกสภาตำบล";
                                } elseif ($m_level == 6) {
                                    echo "หัวหน้าส่วนราชการ";
                                } elseif ($m_level == 7) {
                                    echo "พนักงานเทศบาล";
                                } elseif ($m_level == 8) {
                                    echo "สำนักปลัด";
                                } elseif ($m_level == 9) {
                                    echo "กองคลัง";
                                } elseif ($m_level == 10) {
                                    echo "กองช่าง";
                                } elseif ($m_level == 11) {
                                    echo "กองประปา";
                                } elseif ($m_level == 12) {
                                    echo "กองสาธารณสุขและสิ่งแวดล้อม";
                                } elseif ($m_level == 13) {
                                    echo "กองการศึกษาศาสนาและวัฒนธรรม";
                                } else {
                                    echo "ตำแหน่งไม่ถูกต้อง";
                                }
                                ?>
                            </span>
                        </div>
                    </div>
                    <!-- เพิ่มรายการเมนูอื่น ๆ ตามต้องการ -->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo site_url('System_intranet/profile'); ?>">
                        ข้อมูลส่วนตัว
                    </a>
                    <a class="dropdown-item" href="<?php echo site_url('Login_intranet/logout'); ?>">
                        Logout
                    </a>
                </div>
            </div>

            <!-- <a class="logout" href="<?php echo site_url('Login_intranet/logout'); ?>" onclick="return confirm('ยืนยัน');">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                </svg>
            </a> -->
        </div>
    </div>
    <!-- End of Topbar -->

    <div class="welcome">
    </div>
    <div class="welcome-btm">
        <img src="<?= base_url('docs/intranet/btm-welcome19v2.png'); ?>" style="max-width: 100%; height: auto;">
    </div>


    <div class="menu flex-container">