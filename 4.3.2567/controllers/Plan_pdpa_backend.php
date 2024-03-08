<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Plan_pdpa_backend extends CI_Controller
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
        $this->load->model('plan_pdpa_model');
    }

    public function index()
    {
        $plan_pdpa = $this->plan_pdpa_model->list_all();

        foreach ($plan_pdpa as $files) {
            $files->file = $this->plan_pdpa_model->list_all_pdf($files->plan_pdpa_id);
        }

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/plan_pdpa', ['plan_pdpa' => $plan_pdpa]);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/plan_pdpa_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function add()
    {
        $this->plan_pdpa_model->add();
        redirect('plan_pdpa_backend');
    }


    public function editing($plan_pdpa_id)
    {
        $data['rsedit'] = $this->plan_pdpa_model->read($plan_pdpa_id);
        $data['rsFile'] = $this->plan_pdpa_model->read_file($plan_pdpa_id);
        $data['rsImg'] = $this->plan_pdpa_model->read_img($plan_pdpa_id);
        // echo '<pre>';
        // print_r($data['rsfile']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/plan_pdpa_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit($plan_pdpa_id)
    {
        $this->plan_pdpa_model->edit($plan_pdpa_id);
        redirect('plan_pdpa_backend');
    }

    public function update_plan_pdpa_status()
    {
        $this->plan_pdpa_model->update_plan_pdpa_status();
    }

    public function del_pdf($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->plan_pdpa_model->del_pdf($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_img($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->plan_pdpa_model->del_img($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_plan_pdpa($plan_pdpa_id)
    {
        $this->plan_pdpa_model->del_plan_pdpa_img($plan_pdpa_id);
        $this->plan_pdpa_model->del_plan_pdpa_pdf($plan_pdpa_id);
        $this->plan_pdpa_model->del_plan_pdpa($plan_pdpa_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('plan_pdpa_backend');
    }
}
