<?php
class Corruption_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_corruptions()
    {
        $this->db->select('*');
        $this->db->from('tbl_corruption');
        return $this->db->get()->result();
    }
    public function get_images_for_corruption($corruption_id)
    {
        $this->db->select('corruption_img_img');
        $this->db->from('tbl_corruption_img');
        $this->db->where('corruption_img_ref_id', $corruption_id);
        return $this->db->get()->result();
    }

    //show form edit
    public function read($corruption_id)
    {
        $this->db->where('corruption_id', $corruption_id);
        $query = $this->db->get('tbl_corruption');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function read_detail($corruption_id)
    {
        $this->db->where('corruption_detail_case_id', $corruption_id);
        $this->db->order_by('corruption_detail_id', 'DESC');
        $query = $this->db->get('tbl_corruption_detail');
        return $query->result();
    }

    public function updatecorruptionStatus($corruptionId, $corruptionStatus)
    {
        $data = array(
            'corruption_status' => $corruptionStatus
        );

        $this->db->where('corruption_id', $corruptionId);
        $result = $this->db->update('tbl_corruption', $data);

        return $result;
    }

    public function dashboard_corruption()
    {
        $this->db->select('*');
        $this->db->from('tbl_corruption as c');
        $this->db->limit(3);
        $this->db->order_by('c.corruption_id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function updatecorruption($corruption_detail_case_id, $corruption_detail_status, $corruption_detail_com)
    {
        // อัปเดต tbl_corruption
        $this->db->set('corruption_status', $corruption_detail_status);
        $this->db->where('corruption_id', $corruption_detail_case_id);
        $this->db->update('tbl_corruption');

        // ดึงข้อมูลจาก tbl_corruption หลังจากอัปเดต
        $corruptionData = $this->db->get_where('tbl_corruption', array('corruption_id' => $corruption_detail_case_id))->row();

        if ($corruptionData) {
            $message = "แจ้งเรื่องทุจริต !" . "\n";
            $message .= "case: " . $corruptionData->corruption_id . "\n";
            $message .= "สถานะ: " . $corruptionData->corruption_status . "\n";
            $message .= "เรื่อง: " . $corruptionData->corruption_head . "\n";
            $message .= "ประเภท: " . $corruptionData->corruption_type . "\n";
            $message .= "รายละเอียด: " . $corruptionData->corruption_detail . "\n";
            $message .= "พิกัด: " . $corruptionData->corruption_map . "\n";
            $message .= "ชื่อผู้อัพเดตข้อมูล: " . $corruptionData->corruption_by . "\n";
            $message .= "เบอร์โทรศัพท์ผู้แจ้ง: " . $corruptionData->corruption_phone . "\n";
            // เพิ่มข้อมูลอื่น ๆ ตามที่คุณต้องการ
        }

        // ส่งข้อมูลไปที่ LINE Notify
        $this->sendLineNotify($message);

        // เพิ่มข้อมูลใหม่ลงใน tbl_corruption_detail
        $data = array(
            'corruption_detail_case_id' => $corruption_detail_case_id,
            'corruption_detail_status' => $corruption_detail_status,
            'corruption_detail_by' => $this->session->userdata('m_fname'),
            'corruption_detail_com' => $corruption_detail_com
        );
        $this->db->insert('tbl_corruption_detail', $data);
    }

    private function sendLineNotify($message)
    {
        define('LINE_API', "https://notify-api.line.me/api/notify");
        $token = "k5KuFnUR64P2pI0usUJejwy1Ecn8XB73UVqFkUO7eeB"; // ใส่ Token ที่คุณได้รับ

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

    public function statusCancel($corruption_detail_case_id, $corruption_detail_status, $corruption_detail_com)
    {
        // อัปเดต tbl_corruption
        $this->db->set('corruption_status', 'ยกเลิก');
        $this->db->where('corruption_id', $corruption_detail_case_id);
        $this->db->update('tbl_corruption');

        // ดึงข้อมูลจาก tbl_corruption หลังจากอัปเดต
        $corruptionData = $this->db->get_where('tbl_corruption', array('corruption_id' => $corruption_detail_case_id))->row();

        if ($corruptionData) {
            $message = "แจ้งเรื่องทุจริต !" . "\n";
            $message .= "case: " . $corruptionData->corruption_id . "\n";
            $message .= "สถานะ: " . $corruptionData->corruption_status . "\n";
            $message .= "เรื่อง: " . $corruptionData->corruption_head . "\n";
            $message .= "ประเภท: " . $corruptionData->corruption_type . "\n";
            $message .= "รายละเอียด: " . $corruptionData->corruption_detail . "\n";
            $message .= "พิกัด: " . $corruptionData->corruption_map . "\n";
            $message .= "ชื่อผู้อัพเดตข้อมูล: " . $corruptionData->corruption_by . "\n";
            $message .= "เบอร์โทรศัพท์ผู้แจ้ง: " . $corruptionData->corruption_phone . "\n";
            // เพิ่มข้อมูลอื่น ๆ ตามที่คุณต้องการ
        }

        // ส่งข้อมูลไปที่ LINE Notify
        $this->sendLineNotify($message);

        // เพิ่มข้อมูลใหม่ลงใน tbl_corruption_detail
        $data = array(
            'corruption_detail_case_id' => $corruption_detail_case_id,
            'corruption_detail_status' => 'ยกเลิก',
            'corruption_detail_com' => $corruption_detail_com, // เพิ่มฟิลด์นี้
            'corruption_detail_by' => $this->session->userdata('m_fname')
        );
        $this->db->insert('tbl_corruption_detail', $data);
    }


    public function getLatestDetail($corruption_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_corruption_detail');
        $this->db->where('corruption_detail_case_id', $corruption_id);
        $this->db->order_by('corruption_detail_id', 'DESC');
        $this->db->limit(1); // จำกัดให้เรียกข้อมูลอันล่าสุดเท่านั้น

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }

        return null;
    }

    // เว็บ kakoh เริ่มจากตรงนี้ *********************************************************************
    public function add_corruption()
    {
        // Check used space
        $used_space_mb = $this->space_model->get_used_space();
        $upload_limit_mb = $this->space_model->get_limit_storage();

        $total_space_required = 0;
        $corruption_imgs = $_FILES['corruption_imgs'];

        foreach ($corruption_imgs['size'] as $size) {
            $total_space_required += $size;
        }

        // Check if there's enough space
        if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('Pages/adding_corruption');
            return;
        }

        $corruption_data = array(
            'corruption_topic' => $this->input->post('corruption_topic'),
            'corruption_detail' => $this->input->post('corruption_detail'),
            'corruption_by' => $this->input->post('corruption_by'),
            'corruption_phone' => $this->input->post('corruption_phone'),
            'corruption_email' => $this->input->post('corruption_email'),
            'corruption_address' => $this->input->post('corruption_address'),
        );

        // Config for uploading additional images
        $config['upload_path'] = './docs/img';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);

        $corruption_imgs = $_FILES['corruption_imgs'];

        $this->db->trans_start();
        $this->db->insert('tbl_corruption', $corruption_data);
        $corruption_id = $this->db->insert_id();

        // Upload and insert data into tbl_corruption_img
        $image_data = array(); // Initialize the array
        foreach ($corruption_imgs['name'] as $index => $name) {
            $_FILES['corruption_img']['name'] = $name;
            $_FILES['corruption_img']['type'] = $corruption_imgs['type'][$index];
            $_FILES['corruption_img']['tmp_name'] = $corruption_imgs['tmp_name'][$index];
            $_FILES['corruption_img']['error'] = $corruption_imgs['error'][$index];
            $_FILES['corruption_img']['size'] = $corruption_imgs['size'][$index];

            if (!$this->upload->do_upload('corruption_img')) {
                $this->session->set_flashdata('save_maxsize', TRUE);
                redirect('Pages/adding_corruption'); // กลับไปหน้าเดิม
                return;
            }

            $upload_data = $this->upload->data();
            $image_data[] = array(
                'corruption_img_ref_id' => $corruption_id,
                'corruption_img_img' => $upload_data['file_name']
            );
        }

        $this->db->insert_batch('tbl_corruption_img', $image_data);

        $this->db->trans_complete();

        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }
}
