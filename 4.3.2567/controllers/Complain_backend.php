<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Complain_backend extends CI_Controller
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
        $this->load->model('complain_model');
    }

    public function index()
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
    
        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/complain', ['complains' => $complains]);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }
    

    // public function updateComplainStatus()
    // {
    //     // ตรวจสอบว่ามีการส่งข้อมูล POST มาหรือไม่
    //     if ($this->input->post()) {
    //         $complainId = $this->input->post('complain_id'); // รับค่า complain_id
    //         $newStatus = $this->input->post('new_status'); // รับค่าใหม่จาก dropdown

    //         // ทำการอัพเดตค่าในตาราง tbl_complain ในฐานข้อมูลของคุณ
    //         $data = array(
    //             'complain_status' => $newStatus
    //         );
    //         $this->db->where('complain_id', $complainId); // ระบุ complain_id ของแถวที่ต้องการอัพเดต
    //         $this->db->update('tbl_complain', $data);

    //         // ดึงข้อมูลของ complain_id จากฐานข้อมูล
    //         $complainData = $this->db->get_where('tbl_complain', array('complain_id' => $complainId))->row();
    //         if ($complainData) {
    //             $message = "เรื่องร้องเรียน !" . "\n";
    //             $message .= "case: " . $complainData->complain_id . "\n";
    //             $message .= "สถานะ: " . $newStatus . "\n";
    //             $message .= "เรื่อง: " . $complainData->complain_topic . "\n";
    //             $message .= "รายละเอียด: " . $complainData->complain_detail . "\n";
    //             $message .= "เบอร์โทรศัพท์ผู้แจ้ง: " . $complainData->complain_phone . "\n";
    //             $message .= "ชื่อผู้แจ้ง: " . $complainData->complain_by . "\n";
    //         } else {
    //             $message = "สถานะใหม่: " . $newStatus;
    //         }


    //         // โค้ดสำหรับส่งข้อความ LINE Notify
    //         define('LINE_API', "https://notify-api.line.me/api/notify");
    //         $token = "Bo56prLIvzzXoSIvQhFImstsl3PusUl2iKEvEsVMobV"; // ใส่ Token ที่คุณได้รับ

    //         $queryData = array('message' => $message);
    //         $queryData = http_build_query($queryData, '', '&');
    //         $headerOptions = array(
    //             'http' => array(
    //                 'method' => 'POST',
    //                 'header' => "Content-Type: application/x-www-form-urlencoded\r\n" .
    //                     "Authorization: Bearer " . $token . "\r\n" .
    //                     "Content-Length: " . strlen($queryData) . "\r\n",
    //                 'content' => $queryData
    //             ),
    //         );

    //         $context = stream_context_create($headerOptions);
    //         $result = file_get_contents(LINE_API, FALSE, $context);
    //         $res = json_decode($result);
    //     } else {
    //         // ถ้าไม่มีข้อมูล POST ส่งมา ให้รีเดอร์เปรียบเสมอ
    //         show_404();
    //     }
    // }

    public function detail($complain_id)
    {
        $data['query'] = $this->complain_model->read_detail($complain_id);
        $data['qcomplain'] = $this->complain_model->read($complain_id);
        $data['latest_query'] = $this->complain_model->getLatestDetail($complain_id);

        $this->load->view('templat/header');
        $this->load->view('asset/css');
        $this->load->view('templat/navbar_system_admin');
        $this->load->view('system_admin/complain_detail', $data);
        $this->load->view('asset/js');
        $this->load->view('templat/footer');
    }


    public function updateStatus($complain_detail_case_id)
    {
        // รับข้อมูลจากฟอร์ม
        $complain_detail_case_id = $this->input->post('complain_detail_case_id');
        $complain_detail_status = $this->input->post('complain_detail_status');
        $complain_detail_com = $this->input->post('complain_detail_com');

        // เรียกใช้ฟังก์ชัน updateComplain
        $this->complain_model->updateComplain($complain_detail_case_id, $complain_detail_status, $complain_detail_com);

        // รีเดิร็คหน้าหลังจากทำการบันทึก
        redirect('Complain_backend/detail/' . $complain_detail_case_id);
    }

    public function statusCancel($complain_detail_case_id)
    {
        $complain_detail_case_id = $this->input->post('complain_detail_case_id');
        $complain_detail_status = 'ยกเลิก';
        $complain_detail_com = $this->input->post('complain_detail_com'); // รับข้อมูลจาก Swal

        // เรียกใช้ Model เพื่ออัปเดตข้อมูล
        $this->complain_model->statusCancel($complain_detail_case_id, $complain_detail_status, $complain_detail_com);

        // รีเดิร็คหน้าหลังจากทำการบันทึก
        redirect('complain_backend/detail/' . $complain_detail_case_id);
    }
}
