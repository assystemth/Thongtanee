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
    <!-- <link rel="icon" href="<?php echo base_url("docs/logo.png"); ?>" type="image/x-icon"> -->

    <title>อบต.สว่าง - ระบบอินทราเน็ต</title>
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

    <div class="main">


        <div class="bg-header">
            <div class="d-flex justify-content-end" style="padding-top: 1%; margin-right: 30px;">
                <div class="search">
                    <form id="searchForm" action="<?= site_url('System_intranet/search'); ?>" method="post">
                        <div class="input-group">
                            <i class="fas fa-search form__icon"></i>
                            <div class="input-group">
                                <input type="text" name="search_term" class="searchTerm form-control" placeholder="         ค้นหา">
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Nav Item - Alerts -->
                <div class="nav-item dropdown no-arrow bg-notify">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left: -5px;">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <span class="badge badge-danger badge-counter">3+</span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Alerts Center
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 12, 2019</div>
                                <span class="font-weight-bold">A new monthly report is ready to download!</span>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-success">
                                    <i class="fas fa-donate text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 7, 2019</div>
                                $290.29 has been deposited into your account!
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-warning">
                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 2, 2019</div>
                                Spending Alert: We've noticed unusually high spending for your account.
                            </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Topbar -->

        <div class="banner" style="z-index: 1;">
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" style="z-index: 10;">
                <div class="carousel-indicators">
                    <?php
                    foreach ($qBanner as $index => $img_banner) {
                        $active = ($index === 0) ? "active" : "";
                        echo '<button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="' . $index . '" class="' . $active . '" aria-current="true" aria-label="Slide ' . ($index + 1) . '"></button>';
                    }
                    ?>
                </div>
                <div class="carousel-inner">
                    <?php foreach ($qBanner as $index => $img_banner) { ?>
                        <div class="carousel-item <?= ($index === 0) ? "active" : ""; ?>" data-bs-interval="5000">
                            <a href="<?= $img_banner->banner_link; ?>" target="_blank">
                                <img src="docs\img\<?= $img_banner->banner_img; ?>" width="auto" height="373px" class="d-block w-100">
                            </a>
                        </div>
                    <?php } ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="navbar-bottom" style="z-index: 5; margin-top: -20px;">
            <img src="docs/s.navbar-bottom.png">
        </div>
        <div class="menu">