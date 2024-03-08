<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Plan_pdl_backend extends CI_Controller
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
        $this->load->model('plan_pdl_model');
    }

    public function index()
    {
        $plan_pdl = $this->plan_pdl_model->list_all();

        foreach ($plan_pdl as $files) {
            $files->file = $this->plan_pdl_model->list_all_pdf($files->plan_pdl_id);
        }

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/plan_pdl', ['plan_pdl' => $plan_pdl]);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/plan_pdl_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function add()
    {
        $this->plan_pdl_model->add();
        redirect('plan_pdl_backend');
    }


    public function editing($plan_pdl_id)
    {
        $data['rsedit'] = $this->plan_pdl_model->read($plan_pdl_id);
        $data['rsFile'] = $this->plan_pdl_model->read_file($plan_pdl_id);
        $data['rsImg'] = $this->plan_pdl_model->read_img($plan_pdl_id);
        // echo '<pre>';
        // print_r($data['rsfile']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/plan_pdl_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit($plan_pdl_id)
    {
        $this->plan_pdl_model->edit($plan_pdl_id);
        redirect('plan_pdl_backend');
    }

    public function update_plan_pdl_status()
    {
        $this->plan_pdl_model->update_plan_pdl_status();
    }

    public function del_pdf($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->plan_pdl_model->del_pdf($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_img($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->plan_pdl_model->del_img($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_plan_pdl($plan_pdl_id)
    {
        $this->plan_pdl_model->del_plan_pdl_img($plan_pdl_id);
        $this->plan_pdl_model->del_plan_pdl_pdf($plan_pdl_id);
        $this->plan_pdl_model->del_plan_pdl($plan_pdl_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('plan_pdl_backend');
    }
}
