<?php
class Video_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    public function add()
    {
        $video_name = $this->input->post('video_name');

        // ตรวจสอบว่ามีข้อมูลที่มีชื่อ video_name นี้อยู่แล้วหรือไม่
        $existing_record = $this->db->get_where('tbl_video', array('video_name' => $video_name))->row();

        if ($existing_record) {
            // ถ้ามีข้อมูลแล้วให้แสดงข้อความแจ้งเตือนหรือทำตามที่ต้องการ
            $this->session->set_flashdata('save_again', TRUE);
        } else {
            // ถ้าไม่มีข้อมูลในฐานข้อมูลให้ทำการเพิ่มข้อมูล
            $data = array(
                'video_name' => $video_name,
                'video_link' => $this->input->post('video_link'),
                'video_date' => $this->input->post('video_date'),
                'video_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่เพิ่มข้อมูล
            );

            $query = $this->db->insert('tbl_video', $data);

            $this->space_model->update_server_current();

            if ($query) {
                $this->session->set_flashdata('save_success', TRUE);
            } else {
                echo "<script>";
                echo "alert('เกิดข้อผิดพลาดในการเพิ่มข้อมูลใหม่ !');";
                echo "</script>";
            }
        }
    }



    public function list_all()
    {
        $this->db->order_by('video_id', 'DESC');
        $query = $this->db->get('tbl_video');
        return $query->result();
    }

    //show form edit
    public function read($video_id)
    {
        $this->db->where('video_id', $video_id);
        $query = $this->db->get('tbl_video');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function edit($video_id)
    {

        $data = array(
            'video_name' => $this->input->post('video_name'),
            'video_link' => $this->input->post('video_link'),
            'video_date' => $this->input->post('video_date'),
            'video_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่เพิ่มข้อมูล
        );

        $this->db->where('video_id', $video_id);
        $query = $this->db->update('tbl_video', $data);

        $this->space_model->update_server_current();


        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล !');";
            echo "</script>";
        }
    }

    public function del_video($video_id)
    {
        $this->db->delete('tbl_video', array('video_id' => $video_id));
    }

    public function updateVideoStatus()
    {
        // ตรวจสอบว่ามีการส่งข้อมูล POST มาหรือไม่
        if ($this->input->post()) {
            $videoId = $this->input->post('video_id'); // รับค่า video_id
            $newStatus = $this->input->post('new_status'); // รับค่าใหม่จาก switch checkbox

            // ทำการอัพเดตค่าในตาราง tbl_video ในฐานข้อมูลของคุณ
            $data = array(
                'video_status' => $newStatus
            );
            $this->db->where('video_id', $videoId); // ระบุ video_id ของแถวที่ต้องการอัพเดต
            $this->db->update('tbl_video', $data);

            // ส่งการตอบกลับ (response) กลับไปยังเว็บไซต์หรือแอพพลิเคชันของคุณ
            // โดยเช่นปกติคุณอาจส่ง JSON response กลับมาเพื่ออัพเดตหน้าเว็บ
            $response = array('status' => 'success', 'message' => 'อัพเดตสถานะเรียบร้อย');
            echo json_encode($response);
        } else {
            // ถ้าไม่มีข้อมูล POST ส่งมา ให้รีเดอร์เปรียบเสมอ
            show_404();
        }
    }

    public function video_frontend()
    {
        $this->db->select('*');
        $this->db->from('tbl_video');
        $this->db->where('tbl_video.video_status', 'show');
        $this->db->order_by('video_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row(); // ใช้ row() แทน result()
    }
}
