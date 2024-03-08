<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News_backend extends CI_Controller
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
        $this->load->model('news_model');
    }

    public function index()
    {
        // print_r($_SESSION);
        // exit;
        // $data['query'] = $this->news_model->list_all();
        $news = $this->news_model->list_all();

        foreach ($news as $files) {
            $files->file = $this->news_model->list_all_pdf($files->news_id);
        }

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/news', ['news' => $news]);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function adding()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/news_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function addNews()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($_FILES);
        // echo '</pre>';
        // exit;
        $this->news_model->addNews();
        redirect('news_backend');
    }


    public function editing_News($news_id)
    {
        $data['rsedit'] = $this->news_model->read($news_id);
        // $data['qimg'] = $this->news_model->read_img($news_id);
        $data['rsPdf'] = $this->news_model->read_file($news_id);
        $data['rsImg'] = $this->news_model->read_img($news_id);


        // echo '<pre>';
        // print_r($data['rsedit']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/news_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function editNews($news_id)
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($_FILES);
        // echo '</pre>';
        // exit;
        $this->news_model->editNews($news_id);
        redirect('News_backend');
    }

    public function updateNewsStatus()
    {
        $this->news_model->updateNewsStatus();
    }

    public function del_pdf($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->news_model->del_pdf($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }
    public function del_img($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->news_model->del_img($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function del_news($news_id)
    {
        $this->news_model->del_news_img($news_id);
        $this->news_model->del_news_pdf($news_id);
        $this->news_model->del_news($news_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('News_backend');
    }
}
