<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operation_sp_backend extends CI_Controller
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
        $this->load->model('operation_sp_model');
    }

    public function index()
    {
        $operation_sp = $this->operation_sp_model->list_all();

        foreach ($operation_sp as $files) {
            $files->file = $this->operation_sp_model->list_all_pdf($files->operation_sp_id);
        }

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/operation_sp', ['operation_sp' => $operation_sp]);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/operation_sp_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function add()
    {
        $this->operation_sp_model->add();
        redirect('operation_sp_backend');
    }


    public function editing($operation_sp_id)
    {
        $data['rsedit'] = $this->operation_sp_model->read($operation_sp_id);
        $data['rsFile'] = $this->operation_sp_model->read_file($operation_sp_id);
        $data['rsImg'] = $this->operation_sp_model->read_img($operation_sp_id);
        // echo '<pre>';
        // print_r($data['rsfile']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/operation_sp_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit($operation_sp_id)
    {
        $this->operation_sp_model->edit($operation_sp_id);
        redirect('operation_sp_backend');
    }

    public function update_operation_sp_status()
    {
        $this->operation_sp_model->update_operation_sp_status();
    }

    public function del_pdf($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->operation_sp_model->del_pdf($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_img($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->operation_sp_model->del_img($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_operation_sp($operation_sp_id)
    {
        $this->operation_sp_model->del_operation_sp_img($operation_sp_id);
        $this->operation_sp_model->del_operation_sp_pdf($operation_sp_id);
        $this->operation_sp_model->del_operation_sp($operation_sp_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('operation_sp_backend');
    }
}
