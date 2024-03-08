<?php
class Esv_ods_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add_esv_ods()
    {
        // Check used space
        $used_space_mb = $this->space_model->get_used_space();
        $upload_limit_mb = $this->space_model->get_limit_storage();

        // Calculate the total space required for all files
        $total_space_required = 0;
        if (!empty($_FILES['esv_ods_file']['name'])) {
            $total_space_required += $_FILES['esv_ods_file']['size'];
        }

        // Check if there's enough space
        if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('esv_ods/adding_esv_ods');
            return;
        }

        // Upload configuration
        $config['upload_path'] = './docs/file';
        $config['allowed_types'] = 'doc|docx|pdf';
        $this->load->library('upload', $config);

        // Upload main file
        if (!$this->upload->do_upload('esv_ods_file')) {
            // If the file size exceeds the max_size, set flash data and redirect
            $this->session->set_flashdata('save_maxsize', TRUE);
            redirect('esv_ods/adding_esv_ods');
            return;
        }

        $data = $this->upload->data();
        $filename = $data['file_name'];

        $data = array(
            'esv_ods_topic' => $this->input->post('esv_ods_topic'),
            'esv_ods_detail' => $this->input->post('esv_ods_detail'),
            'esv_ods_by' => $this->input->post('esv_ods_by'),
            'esv_ods_phone' => $this->input->post('esv_ods_phone'),
            'esv_ods_email' => $this->input->post('esv_ods_email'),
            'esv_ods_address' => $this->input->post('esv_ods_address'),
            'esv_ods_file' => $filename
        );

        $query = $this->db->insert('tbl_esv_ods', $data);
        $esv_ods_id = $this->db->insert_id();
        // ดึงข้อมูลจาก tbl_esv_ods หลังจากอัปเดต
        $esv_odsData = $this->db->get_where('tbl_esv_ods', array('esv_ods_id' => $esv_ods_id))->row();

        if ($esv_odsData) {
            $message = "ยื่นเรื่องออนไลน์ ใหม่ !" . "\n";
            $message .= "เรื่อง: " . $esv_odsData->esv_ods_topic . "\n";
            $message .= "รายละเอียด: " . $esv_odsData->esv_ods_detail . "\n";
            $message .= "ชื่อผู้: " . $esv_odsData->esv_ods_by . "\n";
            $message .= "เบอร์โทรศัพท์ผู้แจ้ง: " . $esv_odsData->esv_ods_phone . "\n";
            $message .= "ที่อยู่: " . $esv_odsData->esv_ods_address . "\n";
            $message .= "อีเมล: " . $esv_odsData->esv_ods_email . "\n";
            // เพิ่มข้อมูลอื่น ๆ ตามที่คุณต้องการ
        }

        $this->sendLineNotifyImg($message);

        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);

        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('Error !');";
            echo "</script>";
        }
    }

    private function sendLineNotifyImg($message)
    {
        $headers = [
            'Authorization: Bearer ' . $this->lineNotifyAccessToken,
        ];

        $data = [
            'message' => $message,
        ];

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
    private $lineNotifyAccessToken = 'Iff0yJEZxd1xtZQDhWGKHltb455decobtxXQlDjlWST'; // Replace with your Line Notify access token

    public function list_all()
    {
        $this->db->select('*');
        $this->db->from('tbl_esv_ods');
        $this->db->group_by('tbl_esv_ods.esv_ods_id');
        $this->db->order_by('tbl_esv_ods.esv_ods_datesave', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
}
