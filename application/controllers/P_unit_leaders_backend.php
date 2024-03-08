<?php
defined('BASEPATH') or exit('No direct script access allowed');

class P_unit_leaders_backend extends CI_Controller
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
        $this->load->model('p_unit_leaders_model');
    }

    public function index()
    {

        $data['query'] = $this->p_unit_leaders_model->list_all();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/p_unit_leaders', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding_p_unit_leaders()
    {

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/p_unit_leaders_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    // public function get_departments()
    // {
    //     $group_name = $this->input->post('group_name');
    //     $p_unit_leadersDepartments = $this->p_unit_leaders_model->get_department_by_group($group_name);
    //     echo json_encode($p_unit_leadersDepartments);
    // }


    public function add_p_unit_leaders()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // exit;
        $this->p_unit_leaders_model->add_p_unit_leaders();
        redirect('p_unit_leaders_backend', 'refresh');
    }

    public function editing_p_unit_leaders($p_unit_leaders_id)
    {
        $data['rsedit'] = $this->p_unit_leaders_model->read($p_unit_leaders_id);
        // $data['p_unit_leadersGroup'] = $this->p_unit_leaders_model->get_group();
        // echo '<pre>';
        // print_r($data['rsedit']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/p_unit_leaders_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit_p_unit_leaders($p_unit_leaders_id)
    {
        $this->p_unit_leaders_model->edit_p_unit_leaders($p_unit_leaders_id);
        redirect('p_unit_leaders_backend', 'refresh');
    }

    public function del_p_unit_leaders($p_unit_leaders_id)
    {
        $this->p_unit_leaders_model->del_p_unit_leaders($p_unit_leaders_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('p_unit_leaders_backend', 'refresh');
    }

    public function updatep_unit_leadersStatus()
    {
        $this->p_unit_leaders_model->updatep_unit_leadersStatus();
    }
}
