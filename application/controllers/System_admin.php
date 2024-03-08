<?php
defined('BASEPATH') or exit('No direct script access allowed');

class System_admin extends CI_Controller
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
        $this->load->model('space_model');
        $this->load->model('member_model');
        $this->load->model('camera_model');
        $this->load->model('wifi_model');
        $this->load->model('report_model');
        $this->load->model('complain_model');
        $this->load->model('news_model');
        $this->load->model('activity_model');
        $this->load->model('food_model');
        $this->load->model('travel_model');
        $this->load->model('q_a_model');
        $this->load->model('log_users_model');
        $this->load->model('report_model');
    }
    public function index()
    {
        // ข้อมูลแถวบน
        $data['storage'] = $this->space_model->list_all();
        $data['rs_member'] = $this->member_model->count_member();
        $data['rs_camera'] = $this->camera_model->count_camera();
        $data['rs_wifi'] = $this->wifi_model->count_wifi();
        $data['rs_m_activity'] = $this->activity_model->sum_activity_id();
        $data['rs_complain'] = $this->complain_model->dashboard_Complain();

        // จำนวนผูเข้าชม
        $data['rs_sum_view_news'] = $this->news_model->sum_news_views();
        $data['rs_sum_view_activity'] = $this->activity_model->sum_activity_views();
        $data['rs_sum_view_food'] = $this->food_model->sum_food_views();
        $data['rs_sum_view_travel'] = $this->travel_model->sum_travel_views();

        // คะแนนรีวิว
        $data['rs_sum_like_activity'] = $this->activity_model->sum_activity_likes();
        $data['rs_sum_like_food'] = $this->food_model->sum_food_likes();
        $data['rs_sum_like_travel'] = $this->travel_model->sum_travel_likes();

        $data['rs_q_a'] = $this->q_a_model->list_one();

        $data['count_member_pid_3'] = $this->member_model->count_members_ref_pid_3();
        $data['count_member_pid_4'] = $this->member_model->count_members_ref_pid_4();
        $data['count_member_pid_5'] = $this->member_model->count_members_ref_pid_5();
        $data['count_member_pid_6'] = $this->member_model->count_members_ref_pid_6();
        $data['count_member_pid_7'] = $this->member_model->count_members_ref_pid_7();
        $data['count_member_pid_8'] = $this->member_model->count_members_ref_pid_8();
        $data['count_member_pid_9'] = $this->member_model->count_members_ref_pid_9();
        $data['count_member_pid_10'] = $this->member_model->count_members_ref_pid_10();
        $data['count_member_pid_11'] = $this->member_model->count_members_ref_pid_11();

        // จำนวนคนออนไลน์
        $data['onlineUsersCount'] = $this->log_users_model->countOnlineUsers();
        // คำนวณค่าออฟไลน์
        $data['offlineUsersCount'] = $data['rs_member'][0]->member_total - $data['onlineUsersCount'];

        $data['usersPerDay'] = $this->log_users_model->countUsersPerDay();

        // ภาพรวมเรื่องร้องเรียน
        $data['total_complain_year'] = $this->complain_model->count_complain_year();
        $data['total_complain_success'] = $this->complain_model->count_complain_success();
        $data['count_complain_operation'] = $this->complain_model->count_complain_operation();
        $data['total_complain_doing'] = $this->complain_model->count_complain_doing();

        // ผู้ใช้งานแต่ละวัน
        $data['users_each_day'] = $this->log_users_model->countUsersEachDayInCurrentMonth();

        // จำนวนยอดวิวสูงสุด
        $data['most_viewed_tables'] = $this->report_model->find_most_viewed_table();


        // echo '<pre>';
        // print_r($data['rs_sum_like_food']);
        // echo '</pre>';
        // exit;


        // if (time() - $this->session->userdata('last_update_time') >= 3 * 3600) { // 3 ชั่วโมง
        //     $this->space_model->update_server_current();
        //     $this->session->set_userdata('last_update_time', time());
        // }

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/dashboard', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function update_upload_limit()
    {
        $server_storage = $this->input->post('server_storage');

        if ($server_storage) {
            // อัปเดตค่าในตาราง tbl_server
            $this->load->database();
            $data = array(
                'server_storage' => $server_storage
            );
            $this->db->where('server_id', 1); // แทนตามความเหมาะสมกับโครงสร้างของฐานข้อมูลของคุณ
            $this->db->update('tbl_server', $data); // แทนตามชื่อตารางของคุณ

            // ทำการอัปเดตขนาดการจำกัดพื้นที่ในตัวแปร Session
            $this->session->set_userdata('server_storage', $server_storage);
        }

        // ส่งกลับไปยังหน้าเดิมหลังจากที่อัปเดตค่าเรียบร้อยแล้ว
        redirect(base_url('system_admin'));
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

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/profile', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }
}
