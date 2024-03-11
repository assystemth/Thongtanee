<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Plan_bgy_backend extends CI_Controller
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
        $this->load->model('plan_bgy_model');
    }

    public function index()
    {
        $plan_bgy = $this->plan_bgy_model->list_all();

        foreach ($plan_bgy as $files) {
            $files->file = $this->plan_bgy_model->list_all_pdf($files->plan_bgy_id);
        }

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/plan_bgy', ['plan_bgy' => $plan_bgy]);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/plan_bgy_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function add()
    {
        $this->plan_bgy_model->add();
        redirect('plan_bgy_backend');
    }


    public function editing($plan_bgy_id)
    {
        $data['rsedit'] = $this->plan_bgy_model->read($plan_bgy_id);
        $data['rsFile'] = $this->plan_bgy_model->read_file($plan_bgy_id);
        $data['rsImg'] = $this->plan_bgy_model->read_img($plan_bgy_id);
        // echo '<pre>';
        // print_r($data['rsfile']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/plan_bgy_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit($plan_bgy_id)
    {
        $this->plan_bgy_model->edit($plan_bgy_id);
        redirect('plan_bgy_backend');
    }

    public function update_plan_bgy_status()
    {
        $this->plan_bgy_model->update_plan_bgy_status();
    }

    public function del_pdf($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->plan_bgy_model->del_pdf($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_img($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->plan_bgy_model->del_img($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_plan_bgy($plan_bgy_id)
    {
        $this->plan_bgy_model->del_plan_bgy_img($plan_bgy_id);
        $this->plan_bgy_model->del_plan_bgy_pdf($plan_bgy_id);
        $this->plan_bgy_model->del_plan_bgy($plan_bgy_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('plan_bgy_backend');
    }
}
