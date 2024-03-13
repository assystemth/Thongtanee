<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Intra_discipline extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (
            $this->session->userdata('m_level') != 1 &&
            $this->session->userdata('m_level') != 2 &&
            $this->session->userdata('m_level') != 3 &&
            $this->session->userdata('m_level') != 4 &&
            $this->session->userdata('m_level') != 5 &&
            $this->session->userdata('m_level') != 6 &&
            $this->session->userdata('m_level') != 7 &&
            $this->session->userdata('m_level') != 8 &&
            $this->session->userdata('m_level') != 9 &&
            $this->session->userdata('m_level') != 10 &&
            $this->session->userdata('m_level') != 11 &&
            $this->session->userdata('m_level') != 12 &&
            $this->session->userdata('m_level') != 13
        ) {
            redirect('user', 'refresh');
        }
        $this->load->model('Intra_discipline_model');
    }
    public function index()
    {
        $data['query'] = $this->Intra_discipline_model->list_all();

        $this->load->view('intranet_templat/header_discipline');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/discipline', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function add()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($_FILES);
        // echo '</pre>';
        // exit;
        $this->Intra_discipline_model->add();
        redirect('Intra_discipline', 'refresh');
    }

    public function del_intra_discipline($intra_form_id)
    {
        $this->Intra_discipline_model->del_intra_discipline($intra_form_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('Intra_discipline', 'refresh');
    }

    public function search()
    {
        $search_term = $this->input->post('search_term');

        // ถ้ามีคำค้นหา
        if (!empty($search_term)) {
            $data['query'] = $this->Intra_discipline_model->search($search_term);
        } else {
            // ถ้าไม่มีคำค้นหา ดึงข้อมูลทั้งหมด
            $data['query'] = $this->Intra_discipline_model->list_all();
        }

        $this->load->view('intranet_templat/header_discipline');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/discipline', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }
}
