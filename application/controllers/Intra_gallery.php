<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Intra_gallery extends CI_Controller
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
        $this->load->model('space_model');
        $this->load->model('Intra_gallery_model');
    }
    public function index()
    {
        $data['storage'] = $this->space_model->list_all();
        $data['query'] = $this->Intra_gallery_model->list_all();

        $this->load->view('intranet_templat/header_gallery');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/gallery', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function search()
    {
        $search_term = $this->input->post('search_term');

        // ถ้ามีคำค้นหา
        if (!empty($search_term)) {
            $data['storage'] = $this->space_model->list_all();
            $data['query'] = $this->Intra_gallery_model->search($search_term);
        } else {
            // ถ้าไม่มีคำค้นหา ดึงข้อมูลทั้งหมด
            $data['storage'] = $this->space_model->list_all();
            $data['query'] = $this->Intra_gallery_model->list_all();
        }

        $this->load->view('intranet_templat/header_gallery');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/gallery', $data);
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
        $this->Intra_gallery_model->add();
        redirect('Intra_gallery');
    }

    public function del_intra_gallery($gallery_id)
    {
        $this->Intra_gallery_model->del_intra_gallery($gallery_id);
        $this->Intra_gallery_model->del_intra_gallery_img($gallery_id);
        $this->Intra_gallery_model->del_intra_gallery_video($gallery_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('Intra_gallery');
    }

    // ดาวโหลดรูปภาพทั้งหมดจากคลัง
    public function download_all_images($intra_gallery_id)
    {
        $this->load->library('zip');

        // ดึงชื่อของอัลบั้มจากฐานข้อมูล
        $gallery_info = $this->Intra_gallery_model->read($intra_gallery_id);
        $gallery_name = $gallery_info->intra_gallery_name;

        // ดึงข้อมูลรูปภาพทั้งหมดจาก function read_img
        $images = $this->Intra_gallery_model->read_img($intra_gallery_id);

        // เพิ่มรูปภาพลงใน ZIP
        foreach ($images as $image) {
            $path = FCPATH . 'docs/intranet/img/' . $image->intra_gallery_img_img;
            $this->zip->read_file($path);
        }

        // สร้าง ZIP และดาวน์โหลด
        $this->zip->download($gallery_name . '.zip');
    }

    public function detail($intra_gallery_id)
    {
        $data['rsedit'] = $this->Intra_gallery_model->read($intra_gallery_id);
        $data['rsimg'] = $this->Intra_gallery_model->read_img($intra_gallery_id);
        $data['rsvideo'] = $this->Intra_gallery_model->read_video($intra_gallery_id);

        $this->load->view('intranet_templat/header_gallery');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/gallery_detail', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function del_img($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ img ด้วย $file_id
        $this->Intra_gallery_model->del_img($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }
    public function del_video($file_id)
    {
        // เรียกใช้ฟังก์ชันใน Model เพื่อลบไฟล์ PDF ด้วย $file_id
        $this->Intra_gallery_model->del_video($file_id);

        // ใส่สคริปต์ JavaScript เพื่อรีเฟรชหน้าเดิม
        echo '<script>window.history.back();</script>';
    }

    public function add_img($intra_gallery_id)
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($_FILES);
        // echo '</pre>';
        // exit;
        $this->Intra_gallery_model->add_img($intra_gallery_id);
        redirect('Intra_gallery');
    }
}
