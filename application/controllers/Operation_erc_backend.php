<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operation_erc_backend extends CI_Controller
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
        $this->load->model('operation_erc_model');
    }

    public function index()
    {
        $operation_erc = $this->operation_erc_model->list_all();

        foreach ($operation_erc as $pdf) {
            $pdf->pdf = $this->operation_erc_model->list_all_pdf($pdf->operation_erc_id);
        }
        foreach ($operation_erc as $doc) {
            $doc->doc = $this->operation_erc_model->list_all_doc($doc->operation_erc_id);
        }


        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/operation_erc', ['operation_erc' => $operation_erc]);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/operation_erc_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function add()
    {
        $this->operation_erc_model->add();
        redirect('operation_erc_backend');
    }


    public function editing($operation_erc_id)
    {
        $data['rsedit'] = $this->operation_erc_model->read($operation_erc_id);
        $data['rsPdf'] = $this->operation_erc_model->read_pdf($operation_erc_id);
        $data['rsDoc'] = $this->operation_erc_model->read_doc($operation_erc_id);
        $data['rsImg'] = $this->operation_erc_model->read_img($operation_erc_id);
        // echo '<pre>';
        // print_r($data['rsfile']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/operation_erc_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit($operation_erc_id)
    {
        $this->operation_erc_model->edit($operation_erc_id);
        redirect('operation_erc_backend');
    }

    public function update_operation_erc_status()
    {
        $this->operation_erc_model->update_operation_erc_status();
    }

    public function del_pdf($pdf_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $pdf_id
        $this->operation_erc_model->del_pdf($pdf_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_doc($doc_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $doc_id
        $this->operation_erc_model->del_doc($doc_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_img($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->operation_erc_model->del_img($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_operation_erc($operation_erc_id)
    {
        $this->operation_erc_model->del_operation_erc_img($operation_erc_id);
        $this->operation_erc_model->del_operation_erc_pdf($operation_erc_id);
        $this->operation_erc_model->del_operation_erc_doc($operation_erc_id);
        $this->operation_erc_model->del_operation_erc($operation_erc_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('operation_erc_backend');
    }
}
