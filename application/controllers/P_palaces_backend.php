<?php
defined('BASEPATH') or exit('No direct script access allowed');

class p_palaces_backend extends CI_Controller
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
        $this->load->model('p_palaces_model');
    }

    public function index()
    {

        $data['query'] = $this->p_palaces_model->list_all();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/p_palaces', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding_p_palaces()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/p_palaces_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function add_p_palaces()
    {
        $this->p_palaces_model->add_p_palaces();
        redirect('p_palaces_backend', 'refresh');
    }

    public function editing_p_palaces($p_palaces_id)
    {
        $data['rsedit'] = $this->p_palaces_model->read($p_palaces_id);

        // echo '<pre>';
        // print_r($data['rsedit']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/p_palaces_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit_p_palaces($p_palaces_id)
    {
        $this->p_palaces_model->edit_p_palaces($p_palaces_id);
        redirect('p_palaces_backend', 'refresh');
    }

    public function del_p_palaces($p_palaces_id)
    {
        $this->p_palaces_model->del_p_palaces($p_palaces_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('p_palaces_backend', 'refresh');
    }

    public function updatep_palacesStatus()
    {
        $this->p_palaces_model->updatep_palacesStatus();
    }
}
