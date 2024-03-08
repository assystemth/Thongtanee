<?php
defined('BASEPATH') or exit('No direct script access allowed');

class P_cdc_bpsb_backend extends CI_Controller
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
        $this->load->model('p_cdc_bpsb_model');
    }

    public function index()
    {

        $data['query'] = $this->p_cdc_bpsb_model->list_all();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/p_cdc_bpsb', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding_p_cdc_bpsb()
    {

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/p_cdc_bpsb_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    // public function get_departments()
    // {
    //     $group_name = $this->input->post('group_name');
    //     $p_cdc_bpsbDepartments = $this->p_cdc_bpsb_model->get_department_by_group($group_name);
    //     echo json_encode($p_cdc_bpsbDepartments);
    // }


    public function add_p_cdc_bpsb()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // exit;
        $this->p_cdc_bpsb_model->add_p_cdc_bpsb();
        redirect('p_cdc_bpsb_backend', 'refresh');
    }

    public function editing_p_cdc_bpsb($p_cdc_bpsb_id)
    {
        $data['rsedit'] = $this->p_cdc_bpsb_model->read($p_cdc_bpsb_id);
        // $data['p_cdc_bpsbGroup'] = $this->p_cdc_bpsb_model->get_group();
        // echo '<pre>';
        // print_r($data['rsedit']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/p_cdc_bpsb_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit_p_cdc_bpsb($p_cdc_bpsb_id)
    {
        $this->p_cdc_bpsb_model->edit_p_cdc_bpsb($p_cdc_bpsb_id);
        redirect('p_cdc_bpsb_backend', 'refresh');
    }

    public function del_p_cdc_bpsb($p_cdc_bpsb_id)
    {
        $this->p_cdc_bpsb_model->del_p_cdc_bpsb($p_cdc_bpsb_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('p_cdc_bpsb_backend', 'refresh');
    }

    public function updatep_cdc_bpsbStatus()
    {
        $this->p_cdc_bpsb_model->updatep_cdc_bpsbStatus();
    }
}
