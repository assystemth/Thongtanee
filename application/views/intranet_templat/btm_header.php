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
                                    echo "คณะผู้บริหาร";
                                } elseif ($m_level == 4) {
                                    echo "สมาชิกสภาเทศบาล";
                                } elseif ($m_level == 5) {
                                    echo "หัวหน้าส่วนราชาการ";
                                } elseif ($m_level == 6) {
                                    echo "สำนักปลัดเทศบาล";
                                } elseif ($m_level == 7) {
                                    echo "กองคลัง";
                                } elseif ($m_level == 8) {
                                    echo "กองช่าง";
                                } elseif ($m_level == 9) {
                                    echo "กองการศึกษา";
                                } elseif ($m_level == 10) {
                                    echo "กองยุทธศาสตร์และงบประมาณ";
                                } elseif ($m_level == 11) {
                                    echo "ศูนย์พัฒนาเด็กเล็กบ้านตาเกาว์ใหม";
                                } elseif ($m_level == 12) {
                                    echo "ศูนย์พัฒนาเด็กเล็กบ้านปราสาทเบง";
                                } elseif ($m_level == 13) {
                                    echo "ศูนย์พัฒนาเด็กเล็กบ้านบักจรัง";
                                } elseif ($m_level == 14) {
                                    echo "ศูนย์พัฒนาเด็กเล็กบ้านน้อยร่มเย็น";
                                } elseif ($m_level == 15) {
                                    echo "ศูนย์พัฒนาเด็กเล็กบ้านกาบเชิง";
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
                                    echo "คณะผู้บริหาร";
                                } elseif ($m_level == 4) {
                                    echo "สมาชิกสภาเทศบาล";
                                } elseif ($m_level == 5) {
                                    echo "หัวหน้าส่วนราชาการ";
                                } elseif ($m_level == 6) {
                                    echo "สำนักปลัดเทศบาล";
                                } elseif ($m_level == 7) {
                                    echo "กองคลัง";
                                } elseif ($m_level == 8) {
                                    echo "กองช่าง";
                                } elseif ($m_level == 9) {
                                    echo "กองการศึกษา";
                                } elseif ($m_level == 10) {
                                    echo "กองยุทธศาสตร์และงบประมาณ";
                                } elseif ($m_level == 11) {
                                    echo "ศูนย์พัฒนาเด็กเล็กบ้านตาเกาว์ใหม";
                                } elseif ($m_level == 12) {
                                    echo "ศูนย์พัฒนาเด็กเล็กบ้านปราสาทเบง";
                                } elseif ($m_level == 13) {
                                    echo "ศูนย์พัฒนาเด็กเล็กบ้านบักจรัง";
                                } elseif ($m_level == 14) {
                                    echo "ศูนย์พัฒนาเด็กเล็กบ้านน้อยร่มเย็น";
                                } elseif ($m_level == 15) {
                                    echo "ศูนย์พัฒนาเด็กเล็กบ้านกาบเชิง";
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
        <img src="<?= base_url('docs/intranet/t.btm-welcome.png'); ?>" style="width: 100%; height: auto;">
    </div>


    <div class="menu flex-container">