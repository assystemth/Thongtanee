<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Award_backend extends CI_Controller
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
        $this->load->model('award_model');
    }

    public function index()
    {
        $award = $this->award_model->list_all();

        foreach ($award as $files) {
            $files->file = $this->award_model->list_all_pdf($files->award_id);
        }

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/award', ['award' => $award]);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/award_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function add()
    {
        $this->award_model->add();
        redirect('award_backend');
    }


    public function editing($award_id)
    {
        $data['rsedit'] = $this->award_model->read($award_id);
        $data['rsFile'] = $this->award_model->read_file($award_id);
        $data['rsImg'] = $this->award_model->read_img($award_id);
        // echo '<pre>';
        // print_r($data['rsfile']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/award_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit($award_id)
    {
        $this->award_model->edit($award_id);
        redirect('award_backend');
    }

    public function update_award_status()
    {
        $this->award_model->update_award_status();
    }

    public function del_pdf($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->award_model->del_pdf($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_img($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->award_model->del_img($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_award($award_id)
    {
        $this->award_model->del_award_img($award_id);
        $this->award_model->del_award_pdf($award_id);
        $this->award_model->del_award($award_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('award_backend');
    }
}
