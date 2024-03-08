<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Plan_pds3y_backend extends CI_Controller
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
        $this->load->model('plan_pds3y_model');
    }

    public function index()
    {
        $plan_pds3y = $this->plan_pds3y_model->list_all();

        foreach ($plan_pds3y as $files) {
            $files->file = $this->plan_pds3y_model->list_all_pdf($files->plan_pds3y_id);
        }

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/plan_pds3y', ['plan_pds3y' => $plan_pds3y]);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/plan_pds3y_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function add()
    {
        $this->plan_pds3y_model->add();
        redirect('plan_pds3y_backend');
    }


    public function editing($plan_pds3y_id)
    {
        $data['rsedit'] = $this->plan_pds3y_model->read($plan_pds3y_id);
        $data['rsFile'] = $this->plan_pds3y_model->read_file($plan_pds3y_id);
        $data['rsImg'] = $this->plan_pds3y_model->read_img($plan_pds3y_id);
        // echo '<pre>';
        // print_r($data['rsfile']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/plan_pds3y_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit($plan_pds3y_id)
    {
        $this->plan_pds3y_model->edit($plan_pds3y_id);
        redirect('plan_pds3y_backend');
    }

    public function update_plan_pds3y_status()
    {
        $this->plan_pds3y_model->update_plan_pds3y_status();
    }

    public function del_pdf($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->plan_pds3y_model->del_pdf($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_img($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->plan_pds3y_model->del_img($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_plan_pds3y($plan_pds3y_id)
    {
        $this->plan_pds3y_model->del_plan_pds3y_img($plan_pds3y_id);
        $this->plan_pds3y_model->del_plan_pds3y_pdf($plan_pds3y_id);
        $this->plan_pds3y_model->del_plan_pds3y($plan_pds3y_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('plan_pds3y_backend');
    }
}
