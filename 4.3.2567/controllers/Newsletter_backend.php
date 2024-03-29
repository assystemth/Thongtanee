<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Newsletter_backend extends CI_Controller
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
        $this->load->model('newsletter_model');
    }

    public function index()
    {
        $newsletter = $this->newsletter_model->list_all();

        foreach ($newsletter as $files) {
            $files->file = $this->newsletter_model->list_all_pdf($files->newsletter_id);
        }

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/newsletter', ['newsletter' => $newsletter]);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/newsletter_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function add()
    {
        $this->newsletter_model->add();
        redirect('Newsletter_backend');
    }


    public function editing($newsletter_id)
    {
        $data['rsedit'] = $this->newsletter_model->read($newsletter_id);
        $data['rsFile'] = $this->newsletter_model->read_file($newsletter_id);
        $data['rsImg'] = $this->newsletter_model->read_img($newsletter_id);
        // echo '<pre>';
        // print_r($data['rsfile']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/newsletter_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit($newsletter_id)
    {
        $this->newsletter_model->edit($newsletter_id);
        redirect('Newsletter_backend');
    }

    public function update_newsletter_status()
    {
        $this->newsletter_model->update_newsletter_status();
    }

    public function del_pdf($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->newsletter_model->del_pdf($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_img($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->newsletter_model->del_img($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_newsletter($newsletter_id)
    {
        $this->newsletter_model->del_newsletter_img($newsletter_id);
        $this->newsletter_model->del_newsletter_pdf($newsletter_id);
        $this->newsletter_model->del_newsletter($newsletter_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('Newsletter_backend');
    }
}
