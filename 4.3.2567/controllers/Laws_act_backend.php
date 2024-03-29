<?php
defined('BASEPATH') or exit('No direct script access allowed');

class laws_act_backend extends CI_Controller
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
        $this->load->model('laws_act_model');
    }

    public function index()
    {

        $data['query'] = $this->laws_act_model->list_all();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/laws_act', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/laws_act_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function add()
    {
        $this->laws_act_model->add();
        redirect('laws_act_backend', 'refresh');
    }

    public function editing($laws_act_id)
    {
        $data['rsedit'] = $this->laws_act_model->read($laws_act_id);

        // echo '<pre>';
        // print_r($data['rsedit']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/laws_act_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit($laws_act_id)
    {
        $this->laws_act_model->edit($laws_act_id);
        redirect('laws_act_backend', 'refresh');
    }

    public function del_laws_act($laws_act_id)
    {
        $this->laws_act_model->del_laws_act($laws_act_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('laws_act_backend', 'refresh');
    }

    public function updatelaws_actStatus()
    {
        $this->laws_act_model->updatelaws_actStatus();
    }
}
