<?php
defined('BASEPATH') or exit('No direct script access allowed');

class P_employee_backend extends CI_Controller
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
        $this->load->model('p_employee_model');
    }

    public function index()
    {

        $data['query'] = $this->p_employee_model->list_all();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/p_employee', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding_p_employee()
    {

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/p_employee_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    // public function get_departments()
    // {
    //     $group_name = $this->input->post('group_name');
    //     $p_employeeDepartments = $this->p_employee_model->get_department_by_group($group_name);
    //     echo json_encode($p_employeeDepartments);
    // }


    public function add_p_employee()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // exit;
        $this->p_employee_model->add_p_employee();
        redirect('p_employee_backend', 'refresh');
    }

    public function editing_p_employee($p_employee_id)
    {
        $data['rsedit'] = $this->p_employee_model->read($p_employee_id);
        // $data['allcolumn'] = $this->p_employee_model->getAllColumn($p_employee_id);
        // $data['p_employeeGroup'] = $this->p_employee_model->get_group();
        // echo '<pre>';
        // print_r($data['rsedit']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/p_employee_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit_p_employee($p_employee_id)
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // exit;
        $this->p_employee_model->edit_p_employee($p_employee_id);
        redirect('p_employee_backend', 'refresh');
    }

    public function del_p_employee($p_employee_id)
    {
        $this->p_employee_model->del_p_employee($p_employee_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('p_employee_backend', 'refresh');
    }
}
