<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guide_work_backend extends CI_Controller
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
        $this->load->model('guide_work_model');
    }

    public function index()
    {
        $guide_work = $this->guide_work_model->list_all();

        foreach ($guide_work as $files) {
            $files->file = $this->guide_work_model->list_all_pdf($files->guide_work_id);
        }

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/guide_work', ['guide_work' => $guide_work]);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/guide_work_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function add()
    {
        $this->guide_work_model->add();
        redirect('Guide_work_backend');
    }


    public function editing($guide_work_id)
    {
        $data['rsedit'] = $this->guide_work_model->read($guide_work_id);
        $data['rsFile'] = $this->guide_work_model->read_file($guide_work_id);
        $data['rsImg'] = $this->guide_work_model->read_img($guide_work_id);
        // echo '<pre>';
        // print_r($data['rsfile']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/guide_work_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit($guide_work_id)
    {
        $this->guide_work_model->edit($guide_work_id);
        redirect('Guide_work_backend');
    }

    public function update_guide_work_status()
    {
        $this->guide_work_model->update_guide_work_status();
    }

    public function del_pdf($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->guide_work_model->del_pdf($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_img($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->guide_work_model->del_img($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_guide_work($guide_work_id)
    {
        $this->guide_work_model->del_guide_work_img($guide_work_id);
        $this->guide_work_model->del_guide_work_pdf($guide_work_id);
        $this->guide_work_model->del_guide_work($guide_work_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('Guide_work_backend');
    }
}
