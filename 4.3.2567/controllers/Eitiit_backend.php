<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Eitiit_backend extends CI_Controller
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
        $this->load->model('eitiit_model');
    }

    public function index()
    {

        $data['query'] = $this->eitiit_model->list_all();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/eitiit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding_eitiit()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/eitiit_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function add_eitiit()
    {
        $this->eitiit_model->add_eitiit();
        redirect('eitiit_backend', 'refresh');
    }

    public function editing_eitiit($eitiit_id)
    {
        $data['rsedit'] = $this->eitiit_model->read($eitiit_id);

        // echo '<pre>';
        // print_r($data['rsedit']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/eitiit_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit_eitiit($eitiit_id)
    {
        $this->eitiit_model->edit_eitiit($eitiit_id);
        redirect('eitiit_backend', 'refresh');
    }

    public function del_eitiit($eitiit_id)
    {
        $this->eitiit_model->del_eitiit($eitiit_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('eitiit_backend', 'refresh');
    }

    public function updateeitiitStatus()
    {
        $this->eitiit_model->updateeitiitStatus();
    }
}
