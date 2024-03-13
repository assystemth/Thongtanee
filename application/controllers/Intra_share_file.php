<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Intra_share_file extends CI_Controller
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
        $this->load->model('Intra_share_file_model');
    }
    public function index()
    {
        $data['storage'] = $this->space_model->list_all();

        $this->load->view('intranet_templat/header_share_file');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/share_file', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    // แชร์ไฟล์ภายในองค์กร **********************************************************************
    public function sf_all()
    {
        $data['query'] = $this->Intra_share_file_model->list_sf_all();

        $this->load->view('intranet_templat/header_sf_all');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/sf_all', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function search_sf_all()
    {
        $search_term = $this->input->post('search_term');

        // ถ้ามีคำค้นหา
        if (!empty($search_term)) {
            $data['query'] = $this->Intra_share_file_model->search_sf_all($search_term);
        } else {
            // ถ้าไม่มีคำค้นหา ดึงข้อมูลทั้งหมด
            $data['query'] = $this->Intra_share_file_model->list_sf_all();
        }

        $this->load->view('intranet_templat/header_sf_all');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/sf_all', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function add_sf_all()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($_FILES);
        // echo '</pre>';
        // exit;
        $this->Intra_share_file_model->add_sf_all();
        redirect('Intra_share_file/sf_all');
    }

    public function del_sf_all($intra_form_id)
    {
        $this->Intra_share_file_model->del_sf_all($intra_form_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('Intra_share_file/sf_all');
    }
    // ********************************************************************************


    // คณะผู้บริหาร **********************************************************************
    public function sf_executive()
    {
        $data['query'] = $this->Intra_share_file_model->list_sf_executive();


        $this->load->view('intranet_templat/header_sf_executive');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/sf_executive', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function search_sf_executive()
    {
        $search_term = $this->input->post('search_term');

        // ถ้ามีคำค้นหา
        if (!empty($search_term)) {
            $data['query'] = $this->Intra_share_file_model->search_sf_executive($search_term);
        } else {
            // ถ้าไม่มีคำค้นหา ดึงข้อมูลทั้งหมด
            $data['query'] = $this->Intra_share_file_model->list_sf_executive();
        }

        $this->load->view('intranet_templat/header_sf_executive');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/sf_executive', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function add_sf_executive()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($_FILES);
        // echo '</pre>';
        // exit;
        $this->Intra_share_file_model->add_sf_executive();
        redirect('Intra_share_file/sf_executive');
    }

    public function del_sf_executive($intra_form_id)
    {
        $this->Intra_share_file_model->del_sf_executive($intra_form_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('Intra_share_file/sf_executive');
    }
    // ทำเนียบธงธานี **********************************************************************
    public function sf_palace()
    {
        $data['query'] = $this->Intra_share_file_model->list_sf_palace();


        $this->load->view('intranet_templat/header_sf_palace');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/sf_palace', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function search_sf_palace()
    {
        $search_term = $this->input->post('search_term');

        // ถ้ามีคำค้นหา
        if (!empty($search_term)) {
            $data['query'] = $this->Intra_share_file_model->search_sf_palace($search_term);
        } else {
            // ถ้าไม่มีคำค้นหา ดึงข้อมูลทั้งหมด
            $data['query'] = $this->Intra_share_file_model->list_sf_palace();
        }

        $this->load->view('intranet_templat/header_sf_palace');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/sf_palace', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function add_sf_palace()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($_FILES);
        // echo '</pre>';
        // exit;
        $this->Intra_share_file_model->add_sf_palace();
        redirect('Intra_share_file/sf_palace');
    }

    public function del_sf_palace($intra_form_id)
    {
        $this->Intra_share_file_model->del_sf_palace($intra_form_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('Intra_share_file/sf_palace');
    }
    // *****************************************************************************************
    // พนักงานเทศบาล **********************************************************************
    public function sf_employee()
    {
        $data['query'] = $this->Intra_share_file_model->list_sf_employee();


        $this->load->view('intranet_templat/header_sf_employee');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/sf_employee', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function search_sf_employee()
    {
        $search_term = $this->input->post('search_term');

        // ถ้ามีคำค้นหา
        if (!empty($search_term)) {
            $data['query'] = $this->Intra_share_file_model->search_sf_employee($search_term);
        } else {
            // ถ้าไม่มีคำค้นหา ดึงข้อมูลทั้งหมด
            $data['query'] = $this->Intra_share_file_model->list_sf_employee();
        }

        $this->load->view('intranet_templat/header_sf_employee');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/sf_employee', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function add_sf_employee()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($_FILES);
        // echo '</pre>';
        // exit;
        $this->Intra_share_file_model->add_sf_employee();
        redirect('Intra_share_file/sf_employee');
    }

    public function del_sf_employee($intra_form_id)
    {
        $this->Intra_share_file_model->del_sf_employee($intra_form_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('Intra_share_file/sf_employee');
    }
    // *****************************************************************************************

    // กองประปา ************************************************************************
    public function sf_audit()
    {
        $data['query'] = $this->Intra_share_file_model->list_sf_audit();

        $this->load->view('intranet_templat/header_sf_audit');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/sf_audit', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function search_sf_audit()
    {
        $search_term = $this->input->post('search_term');

        // ถ้ามีคำค้นหา
        if (!empty($search_term)) {
            $data['query'] = $this->Intra_share_file_model->search_sf_audit($search_term);
        } else {
            // ถ้าไม่มีคำค้นหา ดึงข้อมูลทั้งหมด
            $data['query'] = $this->Intra_share_file_model->list_sf_audit();
        }

        $this->load->view('intranet_templat/header_sf_audit');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/sf_audit', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function add_sf_audit()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($_FILES);
        // echo '</pre>';
        // exit;
        $this->Intra_share_file_model->add_sf_audit();
        redirect('Intra_share_file/sf_audit');
    }

    public function del_sf_audit($intra_form_id)
    {
        $this->Intra_share_file_model->del_sf_audit($intra_form_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('Intra_share_file/sf_audit');
    }
    // *****************************************************************************************
    // กองประปา ************************************************************************
    public function sf_dsab()
    {
        $data['query'] = $this->Intra_share_file_model->list_sf_dsab();

        $this->load->view('intranet_templat/header_sf_dsab');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/sf_dsab', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function search_sf_dsab()
    {
        $search_term = $this->input->post('search_term');

        // ถ้ามีคำค้นหา
        if (!empty($search_term)) {
            $data['query'] = $this->Intra_share_file_model->search_sf_dsab($search_term);
        } else {
            // ถ้าไม่มีคำค้นหา ดึงข้อมูลทั้งหมด
            $data['query'] = $this->Intra_share_file_model->list_sf_dsab();
        }

        $this->load->view('intranet_templat/header_sf_dsab');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/sf_dsab', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function add_sf_dsab()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($_FILES);
        // echo '</pre>';
        // exit;
        $this->Intra_share_file_model->add_sf_dsab();
        redirect('Intra_share_file/sf_dsab');
    }

    public function del_sf_dsab($intra_form_id)
    {
        $this->Intra_share_file_model->del_sf_dsab($intra_form_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('Intra_share_file/sf_dsab');
    }
    // *****************************************************************************************

    // กองคลัง **********************************************************************************
    public function sf_treasury()
    {
        $data['query'] = $this->Intra_share_file_model->list_sf_treasury();

        $this->load->view('intranet_templat/header_sf_treasury');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/sf_treasury', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function search_sf_treasury()
    {
        $search_term = $this->input->post('search_term');

        // ถ้ามีคำค้นหา
        if (!empty($search_term)) {
            $data['query'] = $this->Intra_share_file_model->search_sf_treasury($search_term);
        } else {
            // ถ้าไม่มีคำค้นหา ดึงข้อมูลทั้งหมด
            $data['query'] = $this->Intra_share_file_model->list_sf_treasury();
        }

        $this->load->view('intranet_templat/header_sf_treasury');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/sf_treasury', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function add_sf_treasury()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($_FILES);
        // echo '</pre>';
        // exit;
        $this->Intra_share_file_model->add_sf_treasury();
        redirect('Intra_share_file/sf_treasury');
    }

    public function del_sf_treasury($intra_form_id)
    {
        $this->Intra_share_file_model->del_sf_treasury($intra_form_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('Intra_share_file/sf_treasury');
    }
    // *****************************************************************************************

    // กองช่าง **********************************************************************************
    public function sf_maintenance()
    {
        $data['query'] = $this->Intra_share_file_model->list_sf_maintenance();

        $this->load->view('intranet_templat/header_sf_maintenance');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/sf_maintenance', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function search_sf_maintenance()
    {
        $search_term = $this->input->post('search_term');

        // ถ้ามีคำค้นหา
        if (!empty($search_term)) {
            $data['query'] = $this->Intra_share_file_model->search_sf_maintenance($search_term);
        } else {
            // ถ้าไม่มีคำค้นหา ดึงข้อมูลทั้งหมด
            $data['query'] = $this->Intra_share_file_model->list_sf_maintenance();
        }

        $this->load->view('intranet_templat/header_sf_maintenance');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/sf_maintenance', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function add_sf_maintenance()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($_FILES);
        // echo '</pre>';
        // exit;
        $this->Intra_share_file_model->add_sf_maintenance();
        redirect('Intra_share_file/sf_maintenance');
    }

    public function del_sf_maintenance($intra_form_id)
    {
        $this->Intra_share_file_model->del_sf_maintenance($intra_form_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('Intra_share_file/sf_maintenance');
    }
    // *****************************************************************************************

    // สำนักปลัด **********************************************************************************
    public function sf_deputy()
    {
        $data['query'] = $this->Intra_share_file_model->list_sf_deputy();

        $this->load->view('intranet_templat/header_sf_deputy');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/sf_deputy', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function search_sf_deputy()
    {
        $search_term = $this->input->post('search_term');

        // ถ้ามีคำค้นหา
        if (!empty($search_term)) {
            $data['query'] = $this->Intra_share_file_model->search_sf_deputy($search_term);
        } else {
            // ถ้าไม่มีคำค้นหา ดึงข้อมูลทั้งหมด
            $data['query'] = $this->Intra_share_file_model->list_sf_deputy();
        }

        $this->load->view('intranet_templat/header_sf_deputy');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/sf_deputy', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function add_sf_deputy()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($_FILES);
        // echo '</pre>';
        // exit;
        $this->Intra_share_file_model->add_sf_deputy();
        redirect('Intra_share_file/sf_deputy');
    }

    public function del_sf_deputy($intra_form_id)
    {
        $this->Intra_share_file_model->del_sf_deputy($intra_form_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('Intra_share_file/sf_deputy');
    }
    // *****************************************************************************************

    // สมาชิกสภาตำบล ***************************************************************************
    public function sf_council()
    {
        $data['query'] = $this->Intra_share_file_model->list_sf_council();

        $this->load->view('intranet_templat/header_sf_council');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/sf_council', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function search_sf_council()
    {
        $search_term = $this->input->post('search_term');

        // ถ้ามีคำค้นหา
        if (!empty($search_term)) {
            $data['query'] = $this->Intra_share_file_model->search_sf_council($search_term);
        } else {
            // ถ้าไม่มีคำค้นหา ดึงข้อมูลทั้งหมด
            $data['query'] = $this->Intra_share_file_model->list_sf_council();
        }

        $this->load->view('intranet_templat/header_sf_council');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/sf_council', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function add_sf_council()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($_FILES);
        // echo '</pre>';
        // exit;
        $this->Intra_share_file_model->add_sf_council();
        redirect('Intra_share_file/sf_council');
    }

    public function del_sf_council($intra_form_id)
    {
        $this->Intra_share_file_model->del_sf_council($intra_form_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('Intra_share_file/sf_council');
    }
    // *****************************************************************************************

    // หัวหน้าหน่วยราชการ ***************************************************************************
    public function sf_unit_leaders()
    {
        $data['query'] = $this->Intra_share_file_model->list_sf_unit_leaders();

        $this->load->view('intranet_templat/header_sf_unit_leaders');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/sf_unit_leaders', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function search_sf_unit_leaders()
    {
        $search_term = $this->input->post('search_term');

        // ถ้ามีคำค้นหา
        if (!empty($search_term)) {
            $data['query'] = $this->Intra_share_file_model->search_sf_unit_leaders($search_term);
        } else {
            // ถ้าไม่มีคำค้นหา ดึงข้อมูลทั้งหมด
            $data['query'] = $this->Intra_share_file_model->list_sf_unit_leaders();
        }

        $this->load->view('intranet_templat/header_sf_unit_leaders');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/sf_unit_leaders', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function add_sf_unit_leaders()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($_FILES);
        // echo '</pre>';
        // exit;
        $this->Intra_share_file_model->add_sf_unit_leaders();
        redirect('Intra_share_file/sf_unit_leaders');
    }

    public function del_sf_unit_leaders($intra_form_id)
    {
        $this->Intra_share_file_model->del_sf_unit_leaders($intra_form_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('Intra_share_file/sf_unit_leaders');
    }
    // *****************************************************************************************

    // กองการศึกษา ***************************************************************************
    public function sf_education()
    {
        $data['query'] = $this->Intra_share_file_model->list_sf_education();

        $this->load->view('intranet_templat/header_sf_education');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/sf_education', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function search_sf_education()
    {
        $search_term = $this->input->post('search_term');

        // ถ้ามีคำค้นหา
        if (!empty($search_term)) {
            $data['query'] = $this->Intra_share_file_model->search_sf_education($search_term);
        } else {
            // ถ้าไม่มีคำค้นหา ดึงข้อมูลทั้งหมด
            $data['query'] = $this->Intra_share_file_model->list_sf_education();
        }

        $this->load->view('intranet_templat/header_sf_education');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/sf_education', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('intranet_templat/footer');
    }

    public function add_sf_education()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($_FILES);
        // echo '</pre>';
        // exit;
        $this->Intra_share_file_model->add_sf_education();
        redirect('Intra_share_file/sf_education');
    }

    public function del_sf_education($intra_form_id)
    {
        $this->Intra_share_file_model->del_sf_education($intra_form_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('Intra_share_file/sf_education');
    }
    // *****************************************************************************************
}
