<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Canon_rcsp_backend extends CI_Controller
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
        $this->load->model('canon_rcsp_model');
    }

    public function index()
    {
        $canon_rcsp = $this->canon_rcsp_model->list_all();

        foreach ($canon_rcsp as $files) {
            $files->file = $this->canon_rcsp_model->list_all_pdf($files->canon_rcsp_id);
        }

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/canon_rcsp', ['canon_rcsp' => $canon_rcsp]);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/canon_rcsp_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function add()
    {
        $this->canon_rcsp_model->add();
        redirect('canon_rcsp_backend');
    }


    public function editing($canon_rcsp_id)
    {
        $data['rsedit'] = $this->canon_rcsp_model->read($canon_rcsp_id);
        $data['rsFile'] = $this->canon_rcsp_model->read_file($canon_rcsp_id);
        $data['rsImg'] = $this->canon_rcsp_model->read_img($canon_rcsp_id);
        // echo '<pre>';
        // print_r($data['rsfile']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/canon_rcsp_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit($canon_rcsp_id)
    {
        $this->canon_rcsp_model->edit($canon_rcsp_id);
        redirect('canon_rcsp_backend');
    }

    public function update_canon_rcsp_status()
    {
        $this->canon_rcsp_model->update_canon_rcsp_status();
    }

    public function del_pdf($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->canon_rcsp_model->del_pdf($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_img($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->canon_rcsp_model->del_img($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_canon_rcsp($canon_rcsp_id)
    {
        $this->canon_rcsp_model->del_canon_rcsp_img($canon_rcsp_id);
        $this->canon_rcsp_model->del_canon_rcsp_pdf($canon_rcsp_id);
        $this->canon_rcsp_model->del_canon_rcsp($canon_rcsp_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('canon_rcsp_backend');
    }
}
