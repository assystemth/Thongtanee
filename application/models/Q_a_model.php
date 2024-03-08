<?php
class Q_a_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    public function add_q_a()
    {
        // ถ้าไม่มีข้อมูลในฐานข้อมูลให้ทำการเพิ่มข้อมูล
        $data = array(
            'q_a_msg' => $this->input->post('q_a_msg'),
            'q_a_detail' => $this->input->post('q_a_detail'),
            'q_a_by' => $this->input->post('q_a_by'),
            'q_a_email' => $this->input->post('q_a_email'),
        );

        $query = $this->db->insert('tbl_q_a', $data);

        // ดึงข้อมูลจาก tbl_q_a หลังจากอัปเดต
        $q_a_id = $this->db->insert_id(); // ดึงค่า ID ที่เพิ่มล่าสุด
        $QaData = $this->db->get_where('tbl_q_a', array('q_a_id' => $q_a_id))->row();

        if ($QaData) {
            $message = "กระทู้ถาม-ตอบ ใหม่ !" . "\n";
            $message .= "หัวข้อคำถาม: " . $QaData->q_a_msg . "\n";
            $message .= "รายละเอียด: " . $QaData->q_a_detail . "\n";
            $message .= "ชื่อผู้ถาม: " . $QaData->q_a_by . "\n";
            $message .= "อีเมล: " . $QaData->q_a_email . "\n";
            // เพิ่มข้อมูลอื่น ๆ ตามที่คุณต้องการ
        }

        // ส่งข้อมูลไปที่ LINE Notify
        $this->sendLineNotify($message);

        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการเพิ่มข้อมูลใหม่ !');";
            echo "</script>";
        }
    }

    private function sendLineNotify($message)
    {
        define('LINE_API', "https://notify-api.line.me/api/notify");
        $token = "Iff0yJEZxd1xtZQDhWGKHltb455decobtxXQlDjlWST"; // ใส่ Token ที่คุณได้รับ

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


    public function list_all()
    {
        $this->db->order_by('q_a_id', 'DESC');
        $query = $this->db->get('tbl_q_a');
        return $query->result();
    }

    public function read_all_q_a_reply($q_a_id)
    {
        $this->db->where('q_a_reply_ref_id', $q_a_id);
        $query = $this->db->get('tbl_q_a_reply');
        return $query->result();
    }


    //show form edit
    public function read($q_a_id)
    {
        $this->db->where('q_a_id', $q_a_id);
        $query = $this->db->get('tbl_q_a');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function read_reply($q_a_id)
    {
        $this->db->where('q_a_reply_ref_id', $q_a_id);
        $this->db->order_by('q_a_reply_id', 'DESC');
        $query = $this->db->get('tbl_q_a_reply');
        $result = $query->result();

        // ลอง print ค่าที่ได้
        // print_r($result);
        // print_r(exit);

        return $result;
    }

    public function add_reply_q_a()
    {

        // ถ้าไม่มีข้อมูลในฐานข้อมูลให้ทำการเพิ่มข้อมูล
        $data = array(
            'q_a_reply_ref_id' => $this->input->post('q_a_reply_ref_id'),
            'q_a_reply_by' => $this->input->post('q_a_reply_by'),
            'q_a_reply_email' => $this->input->post('q_a_reply_email'),
            'q_a_reply_detail' => $this->input->post('q_a_reply_detail'),
        );

        $query = $this->db->insert('tbl_q_a_reply', $data);
        $this->space_model->update_server_current();

        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการเพิ่มข้อมูลใหม่ !');";
            echo "</script>";
        }
    }

    public function del_com($q_a_id)
    {
        return $this->db->where('q_a_id', $q_a_id)->delete('tbl_q_a');
    }

    public function del_reply($q_a_id)
    {
        return $this->db->where('q_a_reply_id', $q_a_id)->delete('tbl_q_a_reply');
    }

    public function del_com_reply($q_a_reply_id)
    {
        return $this->db->where('q_a_reply_id', $q_a_reply_id)->delete('tbl_q_a_reply');
    }

    public function list_one()
    {
        $this->db->order_by('q_a_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tbl_q_a');
        return $query->result();
    }
    public function q_a_frontend()
    {
        $this->db->order_by('q_a_id', 'DESC');
        $this->db->limit(6);
        $query = $this->db->get('tbl_q_a');
        return $query->result();
    }
}
