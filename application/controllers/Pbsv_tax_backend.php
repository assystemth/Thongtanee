<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pbsv_tax_backend extends CI_Controller
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
        $this->load->model('pbsv_tax_model');
    }

    public function index()
    {
        $data['query'] = $this->pbsv_tax_model->list_all();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/pbsv_tax', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function editing($pbsv_tax_id)
    {
        $data['rsedit'] = $this->pbsv_tax_model->read($pbsv_tax_id);

        // echo '<pre>';
        // print_r($data['rsedit']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/pbsv_tax_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit($pbsv_tax_id)
    {
        $this->pbsv_tax_model->edit($pbsv_tax_id);
        redirect('pbsv_tax_backend');
    }
}
