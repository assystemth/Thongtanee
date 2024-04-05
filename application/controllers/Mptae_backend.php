<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mptae_backend extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (
            $this->session->userdata('m_level') != 1 &&
            $this->session->userdata('m_level') != 2 &&
            $this->session->userdata('m_level') != 3 &&
            $this->session->userdata('m_level') != 4
        ) {
            redirect('user', 'refresh');
        }
        $this->load->model('member_model');
        $this->load->model('space_model');
        $this->load->model('mptae_model');
    }

    public function index()
    {
        $mptae = $this->mptae_model->list_all();

        foreach ($mptae as $files) {
            $files->file = $this->mptae_model->list_all_pdf($files->mptae_id);
        }

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/mptae', ['mptae' => $mptae]);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/mptae_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function add()
    {
        $this->mptae_model->add();
        redirect('mptae_backend');
    }


    public function editing($mptae_id)
    {
        $data['rsedit'] = $this->mptae_model->read($mptae_id);
        $data['rsFile'] = $this->mptae_model->read_file($mptae_id);
        $data['rsImg'] = $this->mptae_model->read_img($mptae_id);
        // echo '<pre>';
        // print_r($data['rsfile']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/mptae_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit($mptae_id)
    {
        $this->mptae_model->edit($mptae_id);
        redirect('mptae_backend');
    }

    public function update_mptae_status()
    {
        $this->mptae_model->update_mptae_status();
    }

    public function del_pdf($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->mptae_model->del_pdf($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_img($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->mptae_model->del_img($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_mptae($mptae_id)
    {
        $this->mptae_model->del_mptae_img($mptae_id);
        $this->mptae_model->del_mptae_pdf($mptae_id);
        $this->mptae_model->del_mptae($mptae_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('mptae_backend');
    }
}
