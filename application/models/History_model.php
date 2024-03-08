<?php
class History_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    public function list_all()
    {
        $this->db->order_by('history_id', 'DESC');
        $query = $this->db->get('tbl_history');
        return $query->result();
    }

    //show form edit
    public function read($history_id)
    {
        $this->db->where('history_id', $history_id);
        $query = $this->db->get('tbl_history');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function edit($history_id)
    {
        $old_document = $this->db->get_where('tbl_history', array('history_id' => $history_id))->row();

        $update_doc_file = !empty($_FILES['history_img']['name']) && $old_document->history_img != $_FILES['history_img']['name'];

        // ตรวจสอบว่ามีการอัพโหลดรูปภาพใหม่หรือไม่
        if ($update_doc_file) {
            $old_file_path = './docs/img/' . $old_document->history_img;
            if (file_exists($old_file_path)) {
                unlink($old_file_path);
            }

            // Check used space
            $used_space_mb = $this->space_model->get_used_space();
            $upload_limit_mb = $this->space_model->get_limit_storage();

            $total_space_required = 0;
            if (!empty($_FILES['history_img']['name'])) {
                $total_space_required += $_FILES['history_img']['size'];
            }

            if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
                $this->session->set_flashdata('save_error', TRUE);
                redirect('history/editing_history');
                return;
            }

            $config['upload_path'] = './docs/img';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('history_img')) {
                echo $this->upload->display_errors();
                return;
            }

            $data = $this->upload->data();
            $filename = $data['file_name'];
        } else {
            // ใช้รูปภาพเดิม
            $filename = $old_document->history_img;
        }

        $data = array(
            'history_name' => $this->input->post('history_name'),
            'history_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่เพิ่มข้อมูล
            'history_img' => $filename
        );

        $this->db->where('history_id', $history_id);
        $query = $this->db->update('tbl_history', $data);

        $this->space_model->update_server_current();


        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล !');";
            echo "</script>";
        }
    }

    public function history_frontend()
    {
        $this->db->select('*');
        $this->db->from('tbl_history');
        $query = $this->db->get();
        return $query->result();
    }
}
