<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operation_aa_backend extends CI_Controller
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
        $this->load->model('operation_aa_model');
    }

    public function index()
    {
        $operation_aa = $this->operation_aa_model->list_all();

        foreach ($operation_aa as $files) {
            $files->file = $this->operation_aa_model->list_all_pdf($files->operation_aa_id);
        }

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/operation_aa', ['operation_aa' => $operation_aa]);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/operation_aa_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function add()
    {
        $this->operation_aa_model->add();
        redirect('operation_aa_backend');
    }


    public function editing($operation_aa_id)
    {
        $data['rsedit'] = $this->operation_aa_model->read($operation_aa_id);
        $data['rsFile'] = $this->operation_aa_model->read_file($operation_aa_id);
        $data['rsImg'] = $this->operation_aa_model->read_img($operation_aa_id);
        // echo '<pre>';
        // print_r($data['rsfile']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/operation_aa_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit($operation_aa_id)
    {
        $this->operation_aa_model->edit($operation_aa_id);
        redirect('operation_aa_backend');
    }

    public function update_operation_aa_status()
    {
        $this->operation_aa_model->update_operation_aa_status();
    }

    public function del_pdf($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->operation_aa_model->del_pdf($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_img($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->operation_aa_model->del_img($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_operation_aa($operation_aa_id)
    {
        $this->operation_aa_model->del_operation_aa_img($operation_aa_id);
        $this->operation_aa_model->del_operation_aa_pdf($operation_aa_id);
        $this->operation_aa_model->del_operation_aa($operation_aa_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('operation_aa_backend');
    }
}
