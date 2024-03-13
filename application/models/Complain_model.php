<?php

use SebastianBergmann\Environment\Console;

class Complain_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // public function get_complains()
    // {
    //     $this->db->select('*');
    //     $this->db->from('tbl_complain');
    //     return $this->db->get()->result();
    // }
    public function get_complains($complain_status = null)
{
    $this->db->select('*');
    $this->db->from('tbl_complain');

    if ($complain_status) {
        $this->db->where('complain_status', $complain_status);
    }

    return $this->db->get()->result();
}

    public function get_images_for_complain($complain_id)
    {
        $this->db->select('complain_img_img');
        $this->db->from('tbl_complain_img');
        $this->db->where('complain_img_ref_id', $complain_id);
        return $this->db->get()->result();
    }

    //show form edit
    public function read($complain_id)
    {
        $this->db->where('complain_id', $complain_id);
        $query = $this->db->get('tbl_complain');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function read_detail($complain_id)
    {
        $this->db->where('complain_detail_case_id', $complain_id);
        $this->db->order_by('complain_detail_id', 'asc');
        $query = $this->db->get('tbl_complain_detail');
        return $query->result();
    }

    public function updateComplainStatus($complainId, $complainStatus)
    {
        $data = array(
            'complain_status' => $complainStatus
        );

        $this->db->where('complain_id', $complainId);
        $result = $this->db->update('tbl_complain', $data);

        return $result;
    }

    public function dashboard_Complain()
    {
        $this->db->select('*');
        $this->db->from('tbl_complain as c');
        $this->db->limit(3);
        $this->db->order_by('c.complain_id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function intranet_complain()
    {
        $this->db->select('*');
        $this->db->from('tbl_complain as c');
        $this->db->limit(5);
        $this->db->order_by('c.complain_id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function updateComplain($complain_detail_case_id, $complain_detail_status, $complain_detail_com)
    {
        // อัปเดต tbl_complain
        $this->db->set('complain_status', $complain_detail_status);
        $this->db->where('complain_id', $complain_detail_case_id);
        $this->db->update('tbl_complain');

        // เพิ่มข้อมูลใหม่ลงใน tbl_complain_detail
        $data = array(
            'complain_detail_case_id' => $complain_detail_case_id,
            'complain_detail_status' => $complain_detail_status,
            'complain_detail_by' => $this->session->userdata('m_fname'),
            'complain_detail_com' => $complain_detail_com
        );
        $this->db->insert('tbl_complain_detail', $data);

        // ดึงข้อมูลจาก tbl_complain หลังจากอัปเดต
        $complainData = $this->db->get_where('tbl_complain', array('complain_id' => $complain_detail_case_id))->row();

        if ($complainData) {
            $message = "เรื่องร้องเรียน อัพเดต !" . "\n";
            $message .= "case: " . $complainData->complain_id . "\n";
            $message .= "สถานะ: " . $complainData->complain_status . "\n";
            $message .= "เรื่อง: " . $complainData->complain_topic . "\n";
            $message .= "รายละเอียด: " . $complainData->complain_detail . "\n";
            $message .= "ชื่อผู้อัพเดตข้อมูล: " . $complainData->complain_by . "\n";
            $message .= "เบอร์โทรศัพท์ผู้แจ้ง: " . $complainData->complain_phone . "\n";
            $message .= "ที่อยู่: " . $complainData->complain_address . "\n";
            $message .= "อีเมล: " . $complainData->complain_email . "\n";
        }

        // ดึงข้อมูลจาก tbl_complain_detail หลังจากอัปเดต
        $this->db->order_by('complain_detail_id', 'DESC');
        $this->db->limit(1);
        $complainData2 = $this->db->get_where('tbl_complain_detail', array('complain_detail_case_id' => $complain_detail_case_id))->row();

        if ($complainData2) {
            $message .= "ชื่อผู้อัพเดตข้อมูล: " . $complainData2->complain_detail_by . "\n";
            $message .= "ข้อความจากการอัพเดต: " . $complainData2->complain_detail_com . "\n";
        }

        // print_r($complainData);
        // echo "<br>";
        // print_r($complainData2);
        // exit;

        // ส่งข้อมูลไปที่ LINE Notify
        $this->sendLineNotify($message);
    }

    private function sendLineNotify($message)
    {
        define('LINE_API', "https://notify-api.line.me/api/notify");
        $token = "Cr7P2PjX5hMa9KzgyHGthEL9UGcqjelH2jGpTMqwn4X"; // ใส่ Token ที่คุณได้รับ

        $queryData = array('message' => $message);
        $queryData = http_build_query($queryData, '', '&');
        $headerOptions = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n" .
                    "Authorization: Bearer " . $token . "\r\n" .
                    "Content-Length: " . strlen($queryData) . "\r\n",
                'content' => $queryData
            ),
        );

        $context = stream_context_create($headerOptions);
        $result = file_get_contents(LINE_API, FALSE, $context);
        $res = json_decode($result);
    }

    public function statusCancel($complain_detail_case_id, $complain_detail_status, $complain_detail_com)
    {
        // อัปเดต tbl_complain
        $this->db->set('complain_status', 'ยกเลิก');
        $this->db->where('complain_id', $complain_detail_case_id);
        $this->db->update('tbl_complain');

        // ดึงข้อมูลจาก tbl_complain หลังจากอัปเดต
        $complainData = $this->db->get_where('tbl_complain', array('complain_id' => $complain_detail_case_id))->row();

        if ($complainData) {
            $message = "เรื่องร้องเรียน !" . "\n";
            $message .= "case: " . $complainData->complain_id . "\n";
            $message .= "สถานะ: " . $complainData->complain_status . "\n";
            $message .= "เรื่อง: " . $complainData->complain_topic . "\n";
            $message .= "รายละเอียด: " . $complainData->complain_detail . "\n";
            $message .= "ชื่อผู้อัพเดตข้อมูล: " . $complainData->complain_by . "\n";
            $message .= "เบอร์โทรศัพท์ผู้แจ้ง: " . $complainData->complain_phone . "\n";
            $message .= "ที่อยู่: " . $complainData->complain_address . "\n";
            $message .= "อีเมล: " . $complainData->complain_email . "\n";
            // เพิ่มข้อมูลอื่น ๆ ตามที่คุณต้องการ
        }

        // ส่งข้อมูลไปที่ LINE Notify
        $this->sendLineNotify($message);

        // เพิ่มข้อมูลใหม่ลงใน tbl_complain_detail
        $data = array(
            'complain_detail_case_id' => $complain_detail_case_id,
            'complain_detail_status' => 'ยกเลิก',
            'complain_detail_com' => $complain_detail_com, // เพิ่มฟิลด์นี้
            'complain_detail_by' => $this->session->userdata('m_fname')
        );
        $this->db->insert('tbl_complain_detail', $data);
    }


    public function getLatestDetail($complain_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_complain_detail');
        $this->db->where('complain_detail_case_id', $complain_id);
        $this->db->order_by('complain_detail_id', 'DESC');
        $this->db->limit(1); // จำกัดให้เรียกข้อมูลอันล่าสุดเท่านั้น

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }

        return null;
    }

    // เว็บ kakoh เริ่มจากตรงนี้ *********************************************************************
    public function add_complain()
    {
        // Check used space
        $used_space_mb = $this->space_model->get_used_space();
        $upload_limit_mb = $this->space_model->get_limit_storage();

        $total_space_required = 0;
        $complain_imgs = $_FILES['complain_imgs'];

        foreach ($complain_imgs['size'] as $size) {
            $total_space_required += $size;
        }

        // Check if there's enough space
        if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('Pages/adding_complain');
            return;
        }

        $complain_data = array(
            'complain_type' => $this->input->post('complain_type'),
            'complain_topic' => $this->input->post('complain_topic'),
            'complain_detail' => $this->input->post('complain_detail'),
            'complain_by' => $this->input->post('complain_by'),
            'complain_phone' => $this->input->post('complain_phone'),
            'complain_email' => $this->input->post('complain_email'),
            'complain_address' => $this->input->post('complain_address'),
        );

        // Config for uploading additional images
        $config['upload_path'] = './docs/img';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);

        $complain_imgs = $_FILES['complain_imgs'];

        $this->db->trans_start();
        $this->db->insert('tbl_complain', $complain_data);
        $complain_id = $this->db->insert_id();

        // Upload and insert data into tbl_complain_img
        $image_data = array(); // Initialize the array
        foreach ($complain_imgs['name'] as $index => $name) {
            $_FILES['complain_img']['name'] = $name;
            $_FILES['complain_img']['type'] = $complain_imgs['type'][$index];
            $_FILES['complain_img']['tmp_name'] = $complain_imgs['tmp_name'][$index];
            $_FILES['complain_img']['error'] = $complain_imgs['error'][$index];
            $_FILES['complain_img']['size'] = $complain_imgs['size'][$index];

            if (!$this->upload->do_upload('complain_img')) {
                $this->session->set_flashdata('save_maxsize', TRUE);
                redirect('Pages/adding_complain'); // กลับไปหน้าเดิม
                return;
            }

            $upload_data = $this->upload->data();
            $image_data[] = array(
                'complain_img_ref_id' => $complain_id,
                'complain_img_img' => $upload_data['file_name']
            );
        }

        $this->db->insert_batch('tbl_complain_img', $image_data);

        $this->db->trans_complete();

        // ดึงข้อมูลจาก tbl_complain หลังจากอัปเดต
        $complainData = $this->db->get_where('tbl_complain', array('complain_id' => $complain_id))->row();

        if ($complainData) {
            $message = "เรื่องร้องเรียน ใหม่ !" . "\n";
            $message .= "case: " . $complainData->complain_id . "\n";
            $message .= "สถานะ: " . $complainData->complain_status . "\n";
            $message .= "เรื่อง: " . $complainData->complain_topic . "\n";
            $message .= "รายละเอียด: " . $complainData->complain_detail . "\n";
            $message .= "ชื่อผู้อัพเดตข้อมูล: " . $complainData->complain_by . "\n";
            $message .= "เบอร์โทรศัพท์ผู้แจ้ง: " . $complainData->complain_phone . "\n";
            $message .= "ที่อยู่: " . $complainData->complain_address . "\n";
            $message .= "อีเมล: " . $complainData->complain_email . "\n";
            // เพิ่มข้อมูลอื่น ๆ ตามที่คุณต้องการ
        }

        $this->sendLineNotifyImg($message, $upload_data['full_path']);

        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);

        return $complain_id;
    }

    private function sendLineNotifyImg($message, $imagePath = null)
    {
        $headers = [
            'Authorization: Bearer ' . $this->lineNotifyAccessToken,
        ];

        $data = [
            'message' => $message,
        ];

        if ($imagePath) {
            $data['imageFile'] = curl_file_create($imagePath, 'image/png', 'imageFile');
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->lineNotifyApiUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        // Handle the response as needed
        echo "Line Notify API Response: $response";
    }
    private $lineNotifyApiUrl = 'https://notify-api.line.me/api/notify';
    private $lineNotifyAccessToken = 'Cr7P2PjX5hMa9KzgyHGthEL9UGcqjelH2jGpTMqwn4X'; // Replace with your Line Notify access token
    public function add_complain_detail($complain_id)
    {
        $data = array(
            'complain_detail_case_id' => $complain_id,
            'complain_detail_by' => $this->input->post('complain_by'),
            // Add other fields as needed
        );

        $query = $this->db->insert('tbl_complain_detail', $data);

        $this->space_model->update_server_current();

        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการเพิ่มข้อมูลใหม่ !');";
            echo "</script>";
        }
    }

    public function count_complain_year()
    {
        $this->db->select('COUNT(complain_id) AS total_complain_year');
        $this->db->from('tbl_complain');
        $this->db->where('YEAR(complain_datesave)', date('Y'));
        $query = $this->db->get();
        return $query->row()->total_complain_year;
    }
    public function count_complain_success()
    {
        $this->db->select('COUNT(complain_id) AS total_complain_success');
        $this->db->from('tbl_complain');
        $this->db->where('tbl_complain.complain_status', 'ดำเนินการเสร็จสิ้น');
        $query = $this->db->get();
        return $query->row()->total_complain_success;
    }
    public function count_complain_operation()
    {
        $this->db->select('COUNT(complain_id) AS total_complain_operation');
        $this->db->from('tbl_complain');
        $this->db->where('tbl_complain.complain_status', 'รอดำเนินการ');
        $query = $this->db->get();
        return $query->row()->total_complain_operation;
    }
    public function count_complain_doing()
    {
        $this->db->select('COUNT(complain_id) AS total_complain_doing');
        $this->db->from('tbl_complain');
        $this->db->where('tbl_complain.complain_status', 'กำลังดำเนินการ');
        $query = $this->db->get();
        return $query->row()->total_complain_doing;
    }
}
