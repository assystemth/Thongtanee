<?php
defined('BASEPATH') or exit('No direct script access allowed');

class P_maintenance_backend extends CI_Controller
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
        $this->load->model('p_maintenance_model');
    }

    public function index()
    {

        $data['query_one'] = $this->p_maintenance_model->p_maintenance_one();
        $data['query_under_one'] = $this->p_maintenance_model->p_maintenance_under_one();
        // $data['query'] = $this->p_maintenance_model->list_all();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/p_maintenance', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding_p_maintenance()
    {

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/p_maintenance_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    // public function get_departments()
    // {
    //     $group_name = $this->input->post('group_name');
    //     $p_maintenanceDepartments = $this->p_maintenance_model->get_department_by_group($group_name);
    //     echo json_encode($p_maintenanceDepartments);
    // }


    public function add_p_maintenance()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // exit;
        $this->p_maintenance_model->add_p_maintenance();
        redirect('p_maintenance_backend', 'refresh');
    }

    public function editing_p_maintenance($p_maintenance_id)
    {
        $data['rsedit'] = $this->p_maintenance_model->read($p_maintenance_id);
        // $data['p_maintenanceGroup'] = $this->p_maintenance_model->get_group();
        // echo '<pre>';
        // print_r($data['rsedit']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/p_maintenance_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit_p_maintenance($p_maintenance_id)
    {
        $this->p_maintenance_model->edit_p_maintenance($p_maintenance_id);
        redirect('p_maintenance_backend', 'refresh');
    }

    public function del_p_maintenance($p_maintenance_id)
    {
        $this->p_maintenance_model->del_p_maintenance($p_maintenance_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('p_maintenance_backend', 'refresh');
    }

    public function updatep_maintenanceStatus()
    {
        $this->p_maintenance_model->updatep_maintenanceStatus();
    }
}
