<?php
class Suggestions_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_suggestionss()
    {
        $this->db->select('*');
        $this->db->from('tbl_suggestions');
        return $this->db->get()->result();
    }
    public function get_images_for_suggestions($suggestions_id)
    {
        $this->db->select('suggestions_img_img');
        $this->db->from('tbl_suggestions_img');
        $this->db->where('suggestions_img_ref_id', $suggestions_id);
        return $this->db->get()->result();
    }

    //show form edit
    public function read($suggestions_id)
    {
        $this->db->where('suggestions_id', $suggestions_id);
        $query = $this->db->get('tbl_suggestions');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function read_detail($suggestions_id)
    {
        $this->db->where('suggestions_detail_case_id', $suggestions_id);
        $this->db->order_by('suggestions_detail_id', 'DESC');
        $query = $this->db->get('tbl_suggestions_detail');
        return $query->result();
    }

    public function updatesuggestionsStatus($suggestionsId, $suggestionsStatus)
    {
        $data = array(
            'suggestions_status' => $suggestionsStatus
        );

        $this->db->where('suggestions_id', $suggestionsId);
        $result = $this->db->update('tbl_suggestions', $data);

        return $result;
    }

    public function dashboard_suggestions()
    {
        $this->db->select('*');
        $this->db->from('tbl_suggestions as c');
        $this->db->limit(3);
        $this->db->order_by('c.suggestions_id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function updatesuggestions($suggestions_detail_case_id, $suggestions_detail_status, $suggestions_detail_com)
    {
        // อัปเดต tbl_suggestions
        $this->db->set('suggestions_status', $suggestions_detail_status);
        $this->db->where('suggestions_id', $suggestions_detail_case_id);
        $this->db->update('tbl_suggestions');

        // ดึงข้อมูลจาก tbl_suggestions หลังจากอัปเดต
        $suggestionsData = $this->db->get_where('tbl_suggestions', array('suggestions_id' => $suggestions_detail_case_id))->row();

        if ($suggestionsData) {
            $message = "เรื่องร้องเรียน !" . "\n";
            $message .= "case: " . $suggestionsData->suggestions_id . "\n";
            $message .= "สถานะ: " . $suggestionsData->suggestions_status . "\n";
            $message .= "เรื่อง: " . $suggestionsData->suggestions_head . "\n";
            $message .= "ประเภท: " . $suggestionsData->suggestions_type . "\n";
            $message .= "รายละเอียด: " . $suggestionsData->suggestions_detail . "\n";
            $message .= "พิกัด: " . $suggestionsData->suggestions_map . "\n";
            $message .= "ชื่อผู้อัพเดตข้อมูล: " . $suggestionsData->suggestions_by . "\n";
            $message .= "เบอร์โทรศัพท์ผู้แจ้ง: " . $suggestionsData->suggestions_phone . "\n";
            // เพิ่มข้อมูลอื่น ๆ ตามที่คุณต้องการ
        }

        // ส่งข้อมูลไปที่ LINE Notify
        $this->sendLineNotify($message);

        // เพิ่มข้อมูลใหม่ลงใน tbl_suggestions_detail
        $data = array(
            'suggestions_detail_case_id' => $suggestions_detail_case_id,
            'suggestions_detail_status' => $suggestions_detail_status,
            'suggestions_detail_by' => $this->session->userdata('m_fname'),
            'suggestions_detail_com' => $suggestions_detail_com
        );
        $this->db->insert('tbl_suggestions_detail', $data);
    }

    private function sendLineNotify($message)
    {
        define('LINE_API', "https://notify-api.line.me/api/notify");
        $token = "ziHhjoKhdgWBAOSV8LiwhKm7LZxqfqP52esG3pYkNlK"; // ใส่ Token ที่คุณได้รับ

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

    public function statusCancel($suggestions_detail_case_id, $suggestions_detail_status, $suggestions_detail_com)
    {
        // อัปเดต tbl_suggestions
        $this->db->set('suggestions_status', 'ยกเลิก');
        $this->db->where('suggestions_id', $suggestions_detail_case_id);
        $this->db->update('tbl_suggestions');

        // ดึงข้อมูลจาก tbl_suggestions หลังจากอัปเดต
        $suggestionsData = $this->db->get_where('tbl_suggestions', array('suggestions_id' => $suggestions_detail_case_id))->row();

        if ($suggestionsData) {
            $message = "เรื่องร้องเรียน !" . "\n";
            $message .= "case: " . $suggestionsData->suggestions_id . "\n";
            $message .= "สถานะ: " . $suggestionsData->suggestions_status . "\n";
            $message .= "เรื่อง: " . $suggestionsData->suggestions_head . "\n";
            $message .= "ประเภท: " . $suggestionsData->suggestions_type . "\n";
            $message .= "รายละเอียด: " . $suggestionsData->suggestions_detail . "\n";
            $message .= "พิกัด: " . $suggestionsData->suggestions_map . "\n";
            $message .= "ชื่อผู้อัพเดตข้อมูล: " . $suggestionsData->suggestions_by . "\n";
            $message .= "เบอร์โทรศัพท์ผู้แจ้ง: " . $suggestionsData->suggestions_phone . "\n";
            // เพิ่มข้อมูลอื่น ๆ ตามที่คุณต้องการ
        }

        // ส่งข้อมูลไปที่ LINE Notify
        $this->sendLineNotify($message);

        // เพิ่มข้อมูลใหม่ลงใน tbl_suggestions_detail
        $data = array(
            'suggestions_detail_case_id' => $suggestions_detail_case_id,
            'suggestions_detail_status' => 'ยกเลิก',
            'suggestions_detail_com' => $suggestions_detail_com, // เพิ่มฟิลด์นี้
            'suggestions_detail_by' => $this->session->userdata('m_fname')
        );
        $this->db->insert('tbl_suggestions_detail', $data);
    }


    public function getLatestDetail($suggestions_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_suggestions_detail');
        $this->db->where('suggestions_detail_case_id', $suggestions_id);
        $this->db->order_by('suggestions_detail_id', 'DESC');
        $this->db->limit(1); // จำกัดให้เรียกข้อมูลอันล่าสุดเท่านั้น

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }

        return null;
    }

    // เว็บ kakoh เริ่มจากตรงนี้ *********************************************************************
    public function add_suggestions()
    {
        // Configure image upload
        $img_config['upload_path'] = './docs/img';
        $img_config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $img_config, 'img_upload');


        // กำหนดค่าใน $suggestions_data
        $suggestions_data = array(
            'suggestions_topic' => $this->input->post('suggestions_topic'),
            'suggestions_detail' => $this->input->post('suggestions_detail'),
            'suggestions_by' => $this->input->post('suggestions_by'),
            'suggestions_phone' => $this->input->post('suggestions_phone'),
            'suggestions_email' => $this->input->post('suggestions_email'),
            'suggestions_address' => $this->input->post('suggestions_address'),
        );

        // เพิ่มข้อมูลลงในฐานข้อมูล
        $this->db->insert('tbl_suggestions', $suggestions_data);
        $suggestions_id = $this->db->insert_id();

        // หาพื้นที่ว่าง และอัพโหลดlimit จากฐานข้อมูล
        $used_space = $this->space_model->get_used_space();
        $upload_limit = $this->space_model->get_limit_storage();

        $total_space_required = 0;
        // ตรวจสอบว่ามีข้อมูลรูปภาพเพิ่มเติมหรือไม่
        if (isset($_FILES['suggestions_img_img'])) {
            foreach ($_FILES['suggestions_img_img']['name'] as $index => $name) {
                if (isset($_FILES['suggestions_img_img']['size'][$index])) {
                    $total_space_required += $_FILES['suggestions_img_img']['size'][$index];
                }
            }
        }

        // ตรวจสอบว่ามีข้อมูลไฟล์ PDF หรือไม่
        if (isset($_FILES['suggestions_file_pdf'])) {
            foreach ($_FILES['suggestions_file_pdf']['name'] as $index => $name) {
                if (isset($_FILES['suggestions_file_pdf']['size'][$index])) {
                    $total_space_required += $_FILES['suggestions_file_pdf']['size'][$index];
                }
            }
        }

        // เช็คค่าว่าง
        if ($used_space + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('suggestions_backend/adding');
            return;
        }

        $imgs_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['suggestions_img_img']['name'][0])) {
            foreach ($_FILES['suggestions_img_img']['name'] as $index => $name) {
                $_FILES['suggestions_img_img_multiple']['name'] = $name;
                $_FILES['suggestions_img_img_multiple']['type'] = $_FILES['suggestions_img_img']['type'][$index];
                $_FILES['suggestions_img_img_multiple']['tmp_name'] = $_FILES['suggestions_img_img']['tmp_name'][$index];
                $_FILES['suggestions_img_img_multiple']['error'] = $_FILES['suggestions_img_img']['error'][$index];
                $_FILES['suggestions_img_img_multiple']['size'] = $_FILES['suggestions_img_img']['size'][$index];

                if ($this->img_upload->do_upload('suggestions_img_img_multiple')) {
                    $upload_data = $this->img_upload->data();
                    $imgs_data[] = array(
                        'suggestions_img_ref_id' => $suggestions_id,
                        'suggestions_img_img' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_suggestions_img', $imgs_data);
        }

        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }
}
