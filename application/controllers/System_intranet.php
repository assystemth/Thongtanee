<?php
defined('BASEPATH') or exit('No direct script access allowed');

class System_intranet extends CI_Controller
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
        // $this->load->model('space_model');
        // $this->load->model('member_model');
        // $this->load->model('camera_model');
        // $this->load->model('wifi_model');
        // $this->load->model('report_model');
        // $this->load->model('complain_model');
        // $this->load->model('news_model');
        // $this->load->model('activity_model');
        // $this->load->model('food_model');
        // $this->load->model('travel_model');
        // $this->load->model('q_a_model');

        $this->load->model('Intra_news_model');
        $this->load->model('banner_model');
        $this->load->model('member_model');
    }
    public function index()
    {
        $data['query'] = $this->Intra_news_model->list_all();
        $data['qBanner'] = $this->banner_model->banner_frontend();

        $this->load->view('intranet_templat/header_news', $data);
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/news', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function adding()
    {
        $this->load->view('intranet_templat/header_news');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/news_form_add');
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function add()
    {
        $this->Intra_news_model->add();
        redirect('System_intranet', 'refresh');
    }

    public function detail($intra_news_id)
    {
        $data['rsedit'] = $this->Intra_news_model->read($intra_news_id);
        // echo '<pre>';
        // print_r($data['rsedit']);
        // echo '</pre>';
        // exit();
        $this->load->view('intranet_templat/header_news');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/news_form_detail', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function editing($intra_news_id)
    {
        $data['rsedit'] = $this->Intra_news_model->read($intra_news_id);
        $data['rsFile'] = $this->Intra_news_model->read_file($intra_news_id);
        $data['rsImg'] = $this->Intra_news_model->read_img($intra_news_id);

        $this->load->view('intranet_templat/header_news');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/news_form_edit', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function del_pdf($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->Intra_news_model->del_pdf($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_img($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->Intra_news_model->del_img($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }
    public function edit($intra_news_id)
    {
        $this->Intra_news_model->edit($intra_news_id);
        redirect('System_intranet', 'refresh');
    }

    public function del_intra_news($intra_news_id)
    {
        $this->Intra_news_model->del_intra_news_img($intra_news_id);
        $this->Intra_news_model->del_intra_news_pdf($intra_news_id);
        $this->Intra_news_model->del_intra_news($intra_news_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('System_intranet');
    }

    public function search()
    {
        $search_term = $this->input->post('search_term');

        // ถ้ามีคำค้นหา
        if (!empty($search_term)) {
            $data['query'] = $this->Intra_news_model->search($search_term);
        } else {
            // ถ้าไม่มีคำค้นหา ดึงข้อมูลทั้งหมด
            $data['query'] = $this->Intra_news_model->list_all();
        }

        $this->load->view('intranet_templat/header_news');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/news', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function profile()
    {
        $m_id = $_SESSION['m_id'];

        // echo $m_id;
        // print_r($_SESSION);
        // exit;

        $data['rsedit'] = $this->member_model->read($m_id);

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // exit;

        $this->load->view('intranet_templat/header_news');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/profile', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function edit_Member($m_id)
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // exit;
        $this->member_model->edit_Member($m_id);
        redirect('System_intranet/profile');
    }
}
