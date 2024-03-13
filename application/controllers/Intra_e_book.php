<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Intra_e_book extends CI_Controller
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
        $this->load->model('Intra_e_book_model');
    }
    public function index()
    {
        $data['query'] = $this->Intra_e_book_model->list_all();

        $this->load->view('intranet_templat/header_e_book');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/e_book', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function search()
    {
        $search_term = $this->input->post('search_term');

        // ถ้ามีคำค้นหา
        if (!empty($search_term)) {
            $data['query'] = $this->Intra_e_book_model->search($search_term);
        } else {
            // ถ้าไม่มีคำค้นหา ดึงข้อมูลทั้งหมด
            $data['query'] = $this->Intra_e_book_model->list_all();
        }

        $this->load->view('intranet_templat/header_e_book');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/e_book', $data);
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
        $this->Intra_e_book_model->add();
        redirect('Intra_e_book', 'refresh');
    }

    public function del_intra_e_book($intra_e_book_id)
    {
        $this->Intra_e_book_model->del_intra_e_book($intra_e_book_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('Intra_e_book', 'refresh');
    }

    public function e_book_detail($intra_e_book_id)
    {
        $data['rsedit'] = $this->Intra_e_book_model->read($intra_e_book_id);

        $this->load->view('intranet_templat/header_e_book');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/e_book_detail', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function increment_download($intra_e_book_id)
    {
        $this->Intra_e_book_model->increment_download($intra_e_book_id);
    }
}
