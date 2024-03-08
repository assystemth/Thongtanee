<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ita_year_backend extends CI_Controller
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
        $this->load->model('ita_year_model');
    }

    public function index()
    {

        $data['query'] = $this->ita_year_model->list_all();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/ita_year', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/ita_year_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function add()
    {
        $this->ita_year_model->add();
        redirect('ita_year_backend', 'refresh');
    }

    public function editing($ita_year_id)
    {
        $data['rsedit'] = $this->ita_year_model->read($ita_year_id);

        // echo '<pre>';
        // print_r($data['rsedit']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/ita_year_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit($ita_year_id)
    {
        $this->ita_year_model->edit($ita_year_id);
        redirect('ita_year_backend', 'refresh');
    }

    public function del_ita_year($ita_year_id)
    {
        $this->ita_year_model->del_ita_year($ita_year_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('ita_year_backend', 'refresh');
    }

    public function updateita_yearStatus()
    {
        $this->ita_year_model->updateita_yearStatus();
    }
}
