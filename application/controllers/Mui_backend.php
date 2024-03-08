<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mui_backend extends CI_Controller
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
        $this->load->model('mui_model');
    }

    public function index()
    {
        $mui = $this->mui_model->list_all();

        foreach ($mui as $files) {
            $files->file = $this->mui_model->list_all_pdf($files->mui_id);
        }

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/mui', ['mui' => $mui]);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/mui_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function add()
    {
        $this->mui_model->add();
        redirect('mui_backend');
    }


    public function editing($mui_id)
    {
        $data['rsedit'] = $this->mui_model->read($mui_id);
        $data['rsFile'] = $this->mui_model->read_file($mui_id);
        $data['rsImg'] = $this->mui_model->read_img($mui_id);
        // echo '<pre>';
        // print_r($data['rsfile']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/mui_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit($mui_id)
    {
        $this->mui_model->edit($mui_id);
        redirect('mui_backend');
    }

    public function update_mui_status()
    {
        $this->mui_model->update_mui_status();
    }

    public function del_pdf($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->mui_model->del_pdf($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_img($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->mui_model->del_img($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_mui($mui_id)
    {
        $this->mui_model->del_mui_img($mui_id);
        $this->mui_model->del_mui_pdf($mui_id);
        $this->mui_model->del_mui($mui_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('mui_backend');
    }
}
