<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loadform_backend extends CI_Controller
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
        $this->load->model('loadform_model');
    }

    public function index()
    {
        $loadform = $this->loadform_model->list_all();

        foreach ($loadform as $files) {
            $files->file = $this->loadform_model->list_all_pdf($files->loadform_id);
        }

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/loadform', ['loadform' => $loadform]);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/loadform_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function add()
    {
        $this->loadform_model->add();
        redirect('loadform_backend');
    }


    public function editing($loadform_id)
    {
        $data['rsedit'] = $this->loadform_model->read($loadform_id);
        $data['rsFile'] = $this->loadform_model->read_file($loadform_id);
        $data['rsImg'] = $this->loadform_model->read_img($loadform_id);
        // echo '<pre>';
        // print_r($data['rsfile']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/loadform_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit($loadform_id)
    {
        $this->loadform_model->edit($loadform_id);
        redirect('loadform_backend');
    }

    public function update_loadform_status()
    {
        $this->loadform_model->update_loadform_status();
    }

    public function del_pdf($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->loadform_model->del_pdf($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_img($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->loadform_model->del_img($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_loadform($loadform_id)
    {
        $this->loadform_model->del_loadform_img($loadform_id);
        $this->loadform_model->del_loadform_pdf($loadform_id);
        $this->loadform_model->del_loadform($loadform_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('loadform_backend');
    }
}
