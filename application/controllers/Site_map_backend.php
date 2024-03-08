<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Site_map_backend extends CI_Controller
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
        $this->load->model('site_map_model');
    }

    public function index()
    {

        $data['query'] = $this->site_map_model->list_all();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/site_map', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding_site_map()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/site_map_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function add_site_map()
    {
        $this->site_map_model->add_site_map();
        redirect('site_map_backend', 'refresh');
    }

    public function editing_site_map($site_map_id)
    {
        $data['rsedit'] = $this->site_map_model->read($site_map_id);

        // echo '<pre>';
        // print_r($data['rsedit']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/site_map_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit_site_map($site_map_id)
    {
        $this->site_map_model->edit_site_map($site_map_id);
        redirect('site_map_backend', 'refresh');
    }

    public function del_site_map($site_map_id)
    {
        $this->site_map_model->del_site_map($site_map_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('site_map_backend', 'refresh');
    }

    public function updatesite_mapStatus()
    {
        $this->site_map_model->updatesite_mapStatus();
    }
}
