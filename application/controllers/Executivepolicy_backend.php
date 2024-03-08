<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Executivepolicy_backend extends CI_Controller
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
        $this->load->model('executivepolicy_model');
    }

    public function index()
    {
        $data['query'] = $this->executivepolicy_model->list_all();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/executivepolicy', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function editing($executivepolicy_id)
    {
        $data['rsedit'] = $this->executivepolicy_model->read($executivepolicy_id);
        // echo '<pre>';
        // print_r($data['rsedit']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/executivepolicy_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit($executivepolicy_id)
    {
        $this->executivepolicy_model->edit($executivepolicy_id);
        redirect('executivepolicy_backend');
    }
}
