<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Procurement_backend extends CI_Controller
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
        $this->load->model('procurement_model');
    }

    public function index()
    {
        $procurement = $this->procurement_model->list_all();

        foreach ($procurement as $files) {
            $files->file = $this->procurement_model->list_all_pdf($files->procurement_id);
        }

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/procurement', ['procurement' => $procurement]);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/procurement_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function add()
    {
        $this->procurement_model->add();
        redirect('procurement_backend');
    }


    public function editing($procurement_id)
    {
        $data['rsedit'] = $this->procurement_model->read($procurement_id);
        $data['rsFile'] = $this->procurement_model->read_file($procurement_id);
        $data['rsImg'] = $this->procurement_model->read_img($procurement_id);
        // echo '<pre>';
        // print_r($data['rsfile']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/procurement_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit($procurement_id)
    {
        $this->procurement_model->edit($procurement_id);
        redirect('procurement_backend');
    }

    public function update_procurement_status()
    {
        $this->procurement_model->update_procurement_status();
    }

    public function del_pdf($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->procurement_model->del_pdf($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_img($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->procurement_model->del_img($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_procurement($procurement_id)
    {
        $this->procurement_model->del_procurement_img($procurement_id);
        $this->procurement_model->del_procurement_pdf($procurement_id);
        $this->procurement_model->del_procurement($procurement_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('procurement_backend');
    }
}
