<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mission_backend extends CI_Controller
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
        $this->load->model('mission_model');
    }

    public function index()
    {
        $data['query'] = $this->mission_model->list_all();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/mission', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function editing($mission_id)
    {
        $data['rsedit'] = $this->mission_model->read($mission_id);

        // echo '<pre>';
        // print_r($data['rsedit']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/mission_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit($mission_id)
    {
        $this->mission_model->edit($mission_id);
        redirect('mission_backend');
    }
}
