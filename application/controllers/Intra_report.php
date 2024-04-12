<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Intra_report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // if (
        //     $this->session->userdata('m_level') != 1 &&
        //     $this->session->userdata('m_level') != 2 &&
        //     $this->session->userdata('m_level') != 3 &&
        //     $this->session->userdata('m_level') != 4
        // ) {
        //     redirect('user', 'refresh');
        // }
        $this->load->model('Intra_form_model');
        $this->load->model('complain_model');
    }
    public function index()
    {
        // ภาพรวมเรื่องร้องเรียน
        $data['total_complain_year'] = $this->complain_model->count_complain_year();
        $data['total_complain_success'] = $this->complain_model->count_complain_success();
        $data['total_complain_operation'] = $this->complain_model->count_complain_operation();
        $data['total_complain_accept'] = $this->complain_model->count_complain_accept();
        $data['total_complain_doing'] = $this->complain_model->count_complain_doing();
        $data['total_complain_wait'] = $this->complain_model->count_complain_wait();
        $data['total_complain_cancel'] = $this->complain_model->count_complain_cancel();

        $data['rs_complain'] = $this->complain_model->intranet_complain();

        $this->load->view('intranet_templat/header');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/report', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('internet_asste/php');
        $this->load->view('intranet_templat/footer');
    }

    public function complain_all()
    {
        $complain_status = $this->input->get('complain_status');

        if (!$complain_status) {
            // ถ้าไม่มีการกรองด้วย complain_status ให้ดึงทั้งหมด
            $complains = $this->complain_model->get_complains();
        } else {
            // ถ้ามีการกรองด้วย complain_status ให้ดึงตามเงื่อนไข
            $complains = $this->complain_model->get_complains($complain_status);
        }

        foreach ($complains as $complain) {
            $complain->images = $this->complain_model->get_images_for_complain($complain->complain_id);
        }
        $this->load->view('intranet_templat/header');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/complain_all', ['complains' => $complains]);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function complain_detail($complain_id)
    {
        $data['query'] = $this->complain_model->read_detail($complain_id);
        $data['qcomplain'] = $this->complain_model->read($complain_id);
        $data['latest_query'] = $this->complain_model->getLatestDetail($complain_id);
        $data['qimg'] = $this->complain_model->get_images_for_complain($complain_id);

        $this->load->view('intranet_templat/header');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/complain_detail', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }
}
