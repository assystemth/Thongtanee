<?php
defined('BASEPATH') or exit('No direct script access allowed');

class P_palace_backend extends CI_Controller
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
        $this->load->model('p_palace_model');
    }

    public function index()
    {

        $data['query'] = $this->p_palace_model->list_all();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/p_palace', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding_p_palace()
    {

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/p_palace_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    // public function get_departments()
    // {
    //     $group_name = $this->input->post('group_name');
    //     $p_palaceDepartments = $this->p_palace_model->get_department_by_group($group_name);
    //     echo json_encode($p_palaceDepartments);
    // }


    public function add_p_palace()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // exit;
        $this->p_palace_model->add_p_palace();
        redirect('p_palace_backend', 'refresh');
    }

    public function editing_p_palace($p_palace_id)
    {
        $data['rsedit'] = $this->p_palace_model->read($p_palace_id);
        // $data['allcolumn'] = $this->p_palace_model->getAllColumn($p_palace_id);
        // $data['p_palaceGroup'] = $this->p_palace_model->get_group();
        // echo '<pre>';
        // print_r($data['rsedit']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/p_palace_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit_p_palace($p_palace_id)
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // exit;
        $this->p_palace_model->edit_p_palace($p_palace_id);
        redirect('p_palace_backend', 'refresh');
    }

    public function del_p_palace($p_palace_id)
    {
        $this->p_palace_model->del_p_palace($p_palace_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('p_palace_backend', 'refresh');
    }
}
