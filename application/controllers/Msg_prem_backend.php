<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Msg_prem_backend extends CI_Controller
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
        $this->load->model('msg_prem_model');
    }

    public function index()
    {
        $data['query'] = $this->msg_prem_model->list_all();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/msg_prem', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function editing($msg_prem_id)
    {
        $data['rsedit'] = $this->msg_prem_model->read($msg_prem_id);
        // echo '<pre>';
        // print_r($data['rsedit']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/msg_prem_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit($msg_prem_id)
    {
        $this->msg_prem_model->edit($msg_prem_id);
        redirect('msg_prem_backend');
    }
}
