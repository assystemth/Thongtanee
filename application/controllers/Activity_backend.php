<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Activity_backend extends CI_Controller
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
        $this->load->model('activity_model');
    }

    public function index()
    {
        $data['qadmin'] = $this->activity_model->list_admin();
        $data['qimg'] = $this->activity_model->list_admin();
        // $data['quser'] = $this->activity_model->list_user();
        // $data['query'] = $this->activity_model->list_all();
        $data['used_space_mb'] = $this->space_model->get_used_space();
        // $data['upload_limit_mb'] = 35;
        $data['upload_limit_mb'] = $this->session->userdata('upload_limit_mb') ?? 35; // ตั้งค่าเริ่มต้นเป็น 35 MB

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/activity', $data);
        $this->load->view('asset/js');
        $this->load->view('asset/option_js');
        $this->load->view('templat/footer');
    }

    public function adding_Activity()
    {
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/activity_form_add');
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function add_Activity()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // exit;
        $this->activity_model->add_Activity();
        redirect('Activity_backend', 'refresh');
    }

    public function editing_Activity($activity_id)
    {
        $data['rsedit'] = $this->activity_model->read_activity($activity_id);
        $data['qimg'] = $this->activity_model->read_img_activity($activity_id);

        // echo '<pre>';
        // print_r($data['rsedit']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/activity_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit_Activity($activity_id)
    {
        $this->activity_model->edit_Activity($activity_id);
        redirect('Activity_backend', 'refresh');
    }

    public function del_activity($activity_id)
    {
        $this->activity_model->del_activity_img($activity_id);
        $this->activity_model->del_activity($activity_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('Activity_backend', 'refresh');
    }

    public function updateActivityStatus()
    {
        $this->activity_model->updateActivityStatus();
    }

    public function editing_User_Activity($user_travel_id)
    {
        $data['rsedit'] = $this->activity_model->read_user_activity($user_travel_id);
        $data['qimg'] = $this->activity_model->read_user_img_activity($user_travel_id);

        // echo '<pre>';
        // print_r($data['rsedit']);
        // echo '</pre>';
        // exit();

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/activity_user_form_edit', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }

    public function edit_User_Activity($user_activity_id)
    {
        $user_activity_name = $this->input->post('user_activity_name');
        $user_activity_detail = $this->input->post('user_activity_detail');
        $user_activity_phone = $this->input->post('user_activity_phone');

        $this->activity_model->edit_User_Activity($user_activity_id, $user_activity_name, $user_activity_detail, $user_activity_phone);
        redirect('Activity_backend', 'refresh');
    }

    public function del_User_Activity($user_activity_id)
    {
        $this->activity_model->del_user_activity_img($user_activity_id);
        $this->activity_model->del_user_activity($user_activity_id);
        $this->session->set_flashdata('del_success', TRUE);
        redirect('Activity_backend', 'refresh');
    }

    public function updateUserActivityStatus()
    {
        $this->activity_model->updateUserActivityStatus();
    }

    public function com($activity_id)
    {
        // อ่านข้อมูลเมนูอาหาร
        $data['activity'] = $this->activity_model->read_activity($activity_id);

        if (!empty($data['activity'])) {
            // อ่านข้อมูลความคิดเห็นที่เกี่ยวข้องกับอาหาร
            $data['rsCom'] = $this->activity_model->read_com_activity($activity_id);

            // อ่านข้อมูลความคิดเห็นตอบกลับที่เกี่ยวข้องกับความคิดเห็น
            foreach ($data['rsCom'] as $index => $com) {
                $activity_com_id = $com->activity_com_id;
                $com_reply_data = $this->activity_model->read_com_reply_activity($activity_com_id);

                // เก็บข้อมูลความคิดเห็นตอบกลับลงในอาร์เรย์ของความคิดเห็น
                $data['rsCom'][$index]->com_reply_data = $com_reply_data;
            }
            // echo '<pre>';
            // print_r($data['rsCom']);
            // echo '</pre>';
            // exit();
            // โหลดหน้า view และแสดงผล HTML
            $this->load->view('templat/header');
            $this->load->view('asset/css');
            $this->load->view('templat/navbar_system_admin');
            $this->load->view('system_admin/activity_com', $data);
            $this->load->view('asset/js');
            $this->load->view('templat/footer');
        } else {
            // หากไม่พบข้อมูลให้แสดงข้อความผิดพลาดหรือกระทำอื่นตามที่คุณต้องการ
            // ตัวอย่างเช่นแสดงข้อความผิดพลาด
            echo "ไม่พบข้อมูลอาหารที่เกี่ยวข้อง";
        }
    }

    public function del_com($activity_com_id)
    {
        $this->activity_model->del_reply($activity_com_id);
        $this->activity_model->del_com($activity_com_id);

        // ส่งคำตอบในรูปแบบ JSON เพื่อระบุว่าการลบสำเร็จ
        $response = array('success' => true);
        header('Content-Type: application/json');
        echo json_encode($response);
        $this->session->set_flashdata('del_success', TRUE);
    }

    public function del_com_reply($activity_com_reply_id)
    {
        $this->activity_model->del_com_reply($activity_com_reply_id);

        // ส่งคำตอบในรูปแบบ JSON เพื่อระบุว่าการลบสำเร็จ
        $response = array('success' => true);
        header('Content-Type: application/json');
        echo json_encode($response);
        $this->session->set_flashdata('del_success', TRUE);
    }

    public function com_user($user_activity_id)
    {
        // อ่านข้อมูลเมนูอาหาร
        $data['user_activity'] = $this->activity_model->read_user_activity($user_activity_id);

        if (!empty($data['user_activity'])) {
            // อ่านข้อมูลความคิดเห็นที่เกี่ยวข้องกับอาหาร
            $data['user_rsCom'] = $this->activity_model->read_user_com_activity($user_activity_id);

            // อ่านข้อมูลความคิดเห็นตอบกลับที่เกี่ยวข้องกับความคิดเห็น
            foreach ($data['user_rsCom'] as $index => $user_com) {
                $user_activity_com_id = $user_com->user_activity_com_id;
                $user_com_reply_data = $this->activity_model->read_user_com_reply_activity($user_activity_com_id);

                // เก็บข้อมูลความคิดเห็นตอบกลับลงในอาร์เรย์ของความคิดเห็น
                $data['user_rsCom'][$index]->user_com_reply_data = $user_com_reply_data;
            }

            // echo '<pre>';
            // print_r($data['user_rsCom']);
            // echo '</pre>';
            // exit();

            // โหลดหน้า view และแสดงผล HTML
            $this->load->view('templat/header');
            $this->load->view('asset/css');
            $this->load->view('templat/navbar_system_admin');
            $this->load->view('system_admin/activity_user_com', $data);
            $this->load->view('asset/js');
            $this->load->view('templat/footer');
        } else {
            // หากไม่พบข้อมูลให้แสดงข้อความผิดพลาดหรือกระทำอื่นตามที่คุณต้องการ
            // ตัวอย่างเช่นแสดงข้อความผิดพลาด
            echo "ไม่พบข้อมูลอาหารที่เกี่ยวข้อง";
        }
    }

    public function del_com_user($user_activity_com_id)
    {
        $this->activity_model->del_reply_user($user_activity_com_id);
        $this->activity_model->del_com_user($user_activity_com_id);

        // ส่งคำตอบในรูปแบบ JSON เพื่อระบุว่าการลบสำเร็จ
        $response = array('success' => true);
        header('Content-Type: application/json');
        echo json_encode($response);
        $this->session->set_flashdata('del_success', TRUE);
    }

    public function del_com_reply_user($user_activity_com_reply_id)
    {
        $this->activity_model->del_com_reply_user($user_activity_com_reply_id);

        // ส่งคำตอบในรูปแบบ JSON เพื่อระบุว่าการลบสำเร็จ
        $response = array('success' => true);
        header('Content-Type: application/json');
        echo json_encode($response);
        $this->session->set_flashdata('del_success', TRUE);
    }
}
