<?php
defined('BASEPATH') or exit('No direct script access allowed');

class P_executives_backend extends CI_Controller
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
        $this->load->model('p_executives_model');
    }

    public function index()
    {

        $data['query_one'] = $this->p_executives_model->p_executives_one();
        $data['query_under_one'] = $this->p_executives_model->p_executives_under_one();
        // $data['query'] = $this->p_executives_model->list_all();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/p_executives', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding_p_executives()
    {

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/p_executives_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    // public function get_departments()
    // {
    //     $group_name = $this->input->post('group_name');
    //     $p_executivesDepartments = $this->p_executives_model->get_department_by_group($group_name);
    //     echo json_encode($p_executivesDepartments);
    // }


    public function add_p_executives()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // exit;
        $this->p_executives_model->add_p_executives();
        redirect('p_executives_backend', 'refresh');
    }

    public function editing_p_executives($p_executives_id)
    {
        $data['rsedit'] = $this->p_executives_model->read($p_executives_id);
        // $data['allcolumn'] = $this->p_executives_model->getAllColumn($p_executives_id);
        // $data['p_executivesGroup'] = $this->p_executives_model->get_group();
        // echo '<pre>';
        // print_r($data['rsedit']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/p_executives_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit_p_executives($p_executives_id)
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // exit;
        $this->p_executives_model->edit_p_executives($p_executives_id);
        redirect('p_executives_backend', 'refresh');
    }

    public function del_p_executives($p_executives_id)
    {
        $this->p_executives_model->del_p_executives($p_executives_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('p_executives_backend', 'refresh');
    }
}
