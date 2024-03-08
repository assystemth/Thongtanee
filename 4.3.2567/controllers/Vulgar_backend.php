<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vulgar_backend extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
        $this->load->model('vulgar_model');
        if (
            $this->session->userdata('m_level') != 1 &&
            $this->session->userdata('m_level') != 2 &&
            $this->session->userdata('m_level') != 3 &&
            $this->session->userdata('m_level') != 4
        ) {
            redirect('user', 'refresh');
        }
    }

    public function index()
    {
        // print_r($_SESSION);
        $data['query'] = $this->vulgar_model->list();
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // exit;
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/vulgar', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }
    public function add()
    {
        // 		echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // exit;

        $this->vulgar_model->add();
        redirect('vulgar_backend', 'refresh');
    }

    public function editing($vulgar_id)
    {
        $data['rsedit'] = $this->vulgar_model->read($vulgar_id);

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/vulgar_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }
    public function edit($vulgar_id)
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // exit;
        $this->vulgar_model->edit($vulgar_id);
        redirect('vulgar_backend', 'refresh');
    }

    public function del($vulgar_id)
    {
        // print_r($_POST);
        $this->vulgar_model->del($vulgar_id);
        redirect('vulgar_backend', 'refresh');
    }
}
