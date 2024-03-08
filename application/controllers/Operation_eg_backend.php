<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operation_eg_backend extends CI_Controller
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
        $this->load->model('operation_eg_model');
    }

    public function index()
    {
        $operation_eg = $this->operation_eg_model->list_all();

        foreach ($operation_eg as $files) {
            $files->file = $this->operation_eg_model->list_all_pdf($files->operation_eg_id);
        }

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/operation_eg', ['operation_eg' => $operation_eg]);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/operation_eg_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function add()
    {
        $this->operation_eg_model->add();
        redirect('operation_eg_backend');
    }


    public function editing($operation_eg_id)
    {
        $data['rsedit'] = $this->operation_eg_model->read($operation_eg_id);
        $data['rsFile'] = $this->operation_eg_model->read_file($operation_eg_id);
        $data['rsImg'] = $this->operation_eg_model->read_img($operation_eg_id);
        // echo '<pre>';
        // print_r($data['rsfile']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/operation_eg_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit($operation_eg_id)
    {
        $this->operation_eg_model->edit($operation_eg_id);
        redirect('operation_eg_backend');
    }

    public function update_operation_eg_status()
    {
        $this->operation_eg_model->update_operation_eg_status();
    }

    public function del_pdf($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->operation_eg_model->del_pdf($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_img($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->operation_eg_model->del_img($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_operation_eg($operation_eg_id)
    {
        $this->operation_eg_model->del_operation_eg_img($operation_eg_id);
        $this->operation_eg_model->del_operation_eg_pdf($operation_eg_id);
        $this->operation_eg_model->del_operation_eg($operation_eg_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('operation_eg_backend');
    }
}
