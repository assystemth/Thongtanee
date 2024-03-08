<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HotNews_backend extends CI_Controller
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
        $this->load->model('hotNews_model');
    }

    public function index()
    {
        $data['query'] = $this->hotNews_model->list_all();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/hotNews', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function editing_hotNews($hotNews_id)
    {
        $data['rsedit'] = $this->hotNews_model->read($hotNews_id);

        // echo '<pre>';
        // print_r($data['rsedit']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/hotNews_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit_hotNews($hotNews_id)
    {
        $this->hotNews_model->edit_hotNews($hotNews_id);
        redirect('HotNews_backend', 'refresh');
    }

    public function del_hotNews($hotNews_id)
    {
        $this->hotNews_model->del_hotNews($hotNews_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('Hotnews_backend', 'refresh');
    }

    public function updateHotNewsStatus()
    {
        $this->hotNews_model->updateHotNewsStatus();
    }
}
