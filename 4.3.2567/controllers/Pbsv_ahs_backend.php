<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pbsv_ahs_backend extends CI_Controller
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
        $this->load->model('pbsv_ahs_model');
    }

    public function index()
    {
        $pbsv_ahs = $this->pbsv_ahs_model->list_all();

        foreach ($pbsv_ahs as $files) {
            $files->file = $this->pbsv_ahs_model->list_all_pdf($files->pbsv_ahs_id);
        }

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/pbsv_ahs', ['pbsv_ahs' => $pbsv_ahs]);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/pbsv_ahs_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function add()
    {
        $this->pbsv_ahs_model->add();
        redirect('pbsv_ahs_backend');
    }


    public function editing($pbsv_ahs_id)
    {
        $data['rsedit'] = $this->pbsv_ahs_model->read($pbsv_ahs_id);
        $data['rsFile'] = $this->pbsv_ahs_model->read_file($pbsv_ahs_id);
        $data['rsImg'] = $this->pbsv_ahs_model->read_img($pbsv_ahs_id);
        // echo '<pre>';
        // print_r($data['rsfile']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/pbsv_ahs_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit($pbsv_ahs_id)
    {
        $this->pbsv_ahs_model->edit($pbsv_ahs_id);
        redirect('pbsv_ahs_backend');
    }

    public function update_pbsv_ahs_status()
    {
        $this->pbsv_ahs_model->update_pbsv_ahs_status();
    }

    public function del_pdf($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->pbsv_ahs_model->del_pdf($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_img($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->pbsv_ahs_model->del_img($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_pbsv_ahs($pbsv_ahs_id)
    {
        $this->pbsv_ahs_model->del_pbsv_ahs_img($pbsv_ahs_id);
        $this->pbsv_ahs_model->del_pbsv_ahs_pdf($pbsv_ahs_id);
        $this->pbsv_ahs_model->del_pbsv_ahs($pbsv_ahs_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('pbsv_ahs_backend');
    }
}
