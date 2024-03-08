<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form_esv_backend extends CI_Controller
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
        $this->load->model('form_esv_model');
    }

    public function index()
    {

        $data['query'] = $this->form_esv_model->list_all();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/form_esv', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/form_esv_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function add()
    {
        $this->form_esv_model->add();
        redirect('form_esv_backend', 'refresh');
    }

    public function editing($form_esv_id)
    {
        $data['rsedit'] = $this->form_esv_model->read($form_esv_id);

        // echo '<pre>';
        // print_r($data['rsedit']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/form_esv_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit($form_esv_id)
    {
        $this->form_esv_model->edit($form_esv_id);
        redirect('form_esv_backend', 'refresh');
    }

    public function del_form_esv($form_esv_id)
    {
        $this->form_esv_model->del_form_esv($form_esv_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('form_esv_backend', 'refresh');
    }

    public function updateform_esvStatus()
    {
        $this->form_esv_model->updateform_esvStatus();
    }
}
