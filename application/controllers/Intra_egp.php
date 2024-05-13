<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Intra_egp extends CI_Controller
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
        $this->load->model('intra_egp_model');
    }
    public function index()
    {
        //  โครงการ
        $data['count_id_y2567'] = $this->intra_egp_model->count_project_id_y2567();

        //  งบประมาณ
        $data['sum_money_y2567'] = $this->intra_egp_model->sum_project_money_without_comma_y2567();

        // สถานะโครงการ
        $data['sum_money_by_status_process_y2567'] = $this->intra_egp_model->sum_project_money_without_comma_by_status_process_y2567();
        $data['sum_money_by_status_end_y2567'] = $this->intra_egp_model->sum_project_money_without_comma_by_status_end_y2567();
        $data['sum_project_status_process_y2567'] = $this->intra_egp_model->count_projects_status_by_process_y2567();
        $data['sum_project_status_end_y2567'] = $this->intra_egp_model->count_projects_status_by_end_y2567();
        $data['sum_project_status_all_y2567'] = $this->intra_egp_model->count_projects_status_by_all_y2567();

        // ประเภทโครงการ
        $data['sum_money_by_type_rent_y2567'] = $this->intra_egp_model->sum_project_money_without_comma_by_type_rent_y2567();
        $data['sum_money_by_type_construction_y2567'] = $this->intra_egp_model->sum_project_money_without_comma_by_type_construction_y2567();
        $data['sum_money_by_type_s_contractor_y2567'] = $this->intra_egp_model->sum_project_money_without_comma_by_type_s_contractor_y2567();
        $data['sum_money_by_type_buy_y2567'] = $this->intra_egp_model->sum_project_money_without_comma_by_type_buy_y2567();
        $data['sum_project_by_type_rent_y2567'] = $this->intra_egp_model->count_projects_type_by_rent_y2567();
        $data['sum_project_by_type_construction_y2567'] = $this->intra_egp_model->count_projects_type_by_construction_y2567();
        $data['sum_project_by_type_s_contractor_y2567'] = $this->intra_egp_model->count_projects_type_by_s_contractor_y2567();
        $data['sum_project_by_type_buy_y2567'] = $this->intra_egp_model->count_projects_type_by_buy_y2567();

        // วิธีจัดซื้อจัดจ้าง
        $data['sum_money_by_purchase_other_y2567'] = $this->intra_egp_model->sum_project_money_without_comma_by_purchase_other_y2567();
        $data['sum_money_by_purchase_e_bidding_y2567'] = $this->intra_egp_model->sum_project_money_without_comma_by_purchase_e_bidding_y2567();
        $data['sum_money_by_purchase_specific_y2567'] = $this->intra_egp_model->sum_project_money_without_comma_by_purchase_specific_y2567();
        $data['sum_project_by_purchase_other_y2567'] = $this->intra_egp_model->count_projects_purchase_by_other_y2567();
        $data['sum_project_by_purchase_e_bidding_y2567'] = $this->intra_egp_model->count_projects_purchase_by_e_bidding_y2567();
        $data['sum_project_by_purchase_specific_y2567'] = $this->intra_egp_model->count_projects_purchase_by_specific_y2567();

        // ใช้จ่ายงบประมาณ
        $data['sum_price_build_money_y2567'] = $this->intra_egp_model->sum_price_build_money_without_comma_y2567();
        $data['sum_project_money_by_project_status_end_y2567'] = $this->intra_egp_model->sum_project_money_by_project_status_end_y2567();
        $data['sum_project_money_by_project_status_process_y2567'] = $this->intra_egp_model->sum_project_money_by_project_status_process_y2567();

        // --------------------------------------------------------------------------------------------------------------------------------------------------

        //  โครงการ
        $data['count_id_y2566'] = $this->intra_egp_model->count_project_id_y2566();
        //  งบประมาณ
        $data['sum_money_y2566'] = $this->intra_egp_model->sum_project_money_without_comma_y2566();

        // สถานะโครงการ
        $data['sum_money_by_status_process_y2566'] = $this->intra_egp_model->sum_project_money_without_comma_by_status_process_y2566();
        $data['sum_money_by_status_end_y2566'] = $this->intra_egp_model->sum_project_money_without_comma_by_status_end_y2566();
        $data['sum_project_status_process_y2566'] = $this->intra_egp_model->count_projects_status_by_process_y2566();
        $data['sum_project_status_end_y2566'] = $this->intra_egp_model->count_projects_status_by_end_y2566();
        $data['sum_project_status_all_y2566'] = $this->intra_egp_model->count_projects_status_by_all_y2566();

        // ประเภทโครงการ
        $data['sum_money_by_type_rent_y2566'] = $this->intra_egp_model->sum_project_money_without_comma_by_type_rent_y2566();
        $data['sum_money_by_type_construction_y2566'] = $this->intra_egp_model->sum_project_money_without_comma_by_type_construction_y2566();
        $data['sum_money_by_type_s_contractor_y2566'] = $this->intra_egp_model->sum_project_money_without_comma_by_type_s_contractor_y2566();
        $data['sum_money_by_type_buy_y2566'] = $this->intra_egp_model->sum_project_money_without_comma_by_type_buy_y2566();
        $data['sum_project_by_type_rent_y2566'] = $this->intra_egp_model->count_projects_type_by_rent_y2566();
        $data['sum_project_by_type_construction_y2566'] = $this->intra_egp_model->count_projects_type_by_construction_y2566();
        $data['sum_project_by_type_s_contractor_y2566'] = $this->intra_egp_model->count_projects_type_by_s_contractor_y2566();
        $data['sum_project_by_type_buy_y2566'] = $this->intra_egp_model->count_projects_type_by_buy_y2566();

        // วิธีจัดซื้อจัดจ้าง
        $data['sum_money_by_purchase_other_y2566'] = $this->intra_egp_model->sum_project_money_without_comma_by_purchase_other_y2566();
        $data['sum_money_by_purchase_e_bidding_y2566'] = $this->intra_egp_model->sum_project_money_without_comma_by_purchase_e_bidding_y2566();
        $data['sum_money_by_purchase_specific_y2566'] = $this->intra_egp_model->sum_project_money_without_comma_by_purchase_specific_y2566();
        $data['sum_project_by_purchase_other_y2566'] = $this->intra_egp_model->count_projects_purchase_by_other_y2566();
        $data['sum_project_by_purchase_e_bidding_y2566'] = $this->intra_egp_model->count_projects_purchase_by_e_bidding_y2566();
        $data['sum_project_by_purchase_specific_y2566'] = $this->intra_egp_model->count_projects_purchase_by_specific_y2566();

        // ใช้จ่ายงบประมาณ
        $data['sum_price_build_money_y2566'] = $this->intra_egp_model->sum_price_build_money_without_comma_y2566();
        $data['sum_project_money_by_project_status_end_y2566'] = $this->intra_egp_model->sum_project_money_by_project_status_end_y2566();
        $data['sum_project_money_by_project_status_process_y2566'] = $this->intra_egp_model->sum_project_money_by_project_status_process_y2566();

        // --------------------------------------------------------------------------------------------------------------------------------------------------

        //  โครงการ
        $data['count_id_y2565'] = $this->intra_egp_model->count_project_id_y2565();
        //  งบประมาณ
        $data['sum_money_y2565'] = $this->intra_egp_model->sum_project_money_without_comma_y2565();

        // สถานะโครงการ
        $data['sum_money_by_status_process_y2565'] = $this->intra_egp_model->sum_project_money_without_comma_by_status_process_y2565();
        $data['sum_money_by_status_end_y2565'] = $this->intra_egp_model->sum_project_money_without_comma_by_status_end_y2565();
        $data['sum_project_status_process_y2565'] = $this->intra_egp_model->count_projects_status_by_process_y2565();
        $data['sum_project_status_end_y2565'] = $this->intra_egp_model->count_projects_status_by_end_y2565();
        $data['sum_project_status_all_y2565'] = $this->intra_egp_model->count_projects_status_by_all_y2565();

        // ประเภทโครงการ
        $data['sum_money_by_type_rent_y2565'] = $this->intra_egp_model->sum_project_money_without_comma_by_type_rent_y2565();
        $data['sum_money_by_type_construction_y2565'] = $this->intra_egp_model->sum_project_money_without_comma_by_type_construction_y2565();
        $data['sum_money_by_type_s_contractor_y2565'] = $this->intra_egp_model->sum_project_money_without_comma_by_type_s_contractor_y2565();
        $data['sum_money_by_type_buy_y2565'] = $this->intra_egp_model->sum_project_money_without_comma_by_type_buy_y2565();
        $data['sum_project_by_type_rent_y2565'] = $this->intra_egp_model->count_projects_type_by_rent_y2565();
        $data['sum_project_by_type_construction_y2565'] = $this->intra_egp_model->count_projects_type_by_construction_y2565();
        $data['sum_project_by_type_s_contractor_y2565'] = $this->intra_egp_model->count_projects_type_by_s_contractor_y2565();
        $data['sum_project_by_type_buy_y2565'] = $this->intra_egp_model->count_projects_type_by_buy_y2565();

        // วิธีจัดซื้อจัดจ้าง
        $data['sum_money_by_purchase_other_y2565'] = $this->intra_egp_model->sum_project_money_without_comma_by_purchase_other_y2565();
        $data['sum_money_by_purchase_e_bidding_y2565'] = $this->intra_egp_model->sum_project_money_without_comma_by_purchase_e_bidding_y2565();
        $data['sum_money_by_purchase_specific_y2565'] = $this->intra_egp_model->sum_project_money_without_comma_by_purchase_specific_y2565();
        $data['sum_project_by_purchase_other_y2565'] = $this->intra_egp_model->count_projects_purchase_by_other_y2565();
        $data['sum_project_by_purchase_e_bidding_y2565'] = $this->intra_egp_model->count_projects_purchase_by_e_bidding_y2565();
        $data['sum_project_by_purchase_specific_y2565'] = $this->intra_egp_model->count_projects_purchase_by_specific_y2565();


        // ใช้จ่ายงบประมาณ
        $data['sum_price_build_money_y2565'] = $this->intra_egp_model->sum_price_build_money_without_comma_y2565();
        $data['sum_project_money_by_project_status_end_y2565'] = $this->intra_egp_model->sum_project_money_by_project_status_end_y2565();
        $data['sum_project_money_by_project_status_process_y2565'] = $this->intra_egp_model->sum_project_money_by_project_status_process_y2565();
        // echo '<pre>';
        // print_r($data['sum_project_by_type_buy_y2565']);
        // echo '</pre>';
        // exit;

        $this->load->view('intranet_templat/header');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/egp', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('internet_asste/php');
        $this->load->view('intranet_templat/footer');
    }
}
