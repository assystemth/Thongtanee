<?php
class Msg_pres_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    public function list_all()
    {
        $this->db->order_by('msg_pres_id', 'DESC');
        $query = $this->db->get('tbl_msg_pres');
        return $query->result();
    }

    //show form edit
    public function read($msg_pres_id)
    {
        $this->db->where('msg_pres_id', $msg_pres_id);
        $query = $this->db->get('tbl_msg_pres');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function edit($msg_pres_id)
    {
        $old_document = $this->db->get_where('tbl_msg_pres', array('msg_pres_id' => $msg_pres_id))->row();

        $update_doc_file = !empty($_FILES['msg_pres_pdf']['name']) && $old_document->msg_pres_pdf != $_FILES['msg_pres_pdf']['name'];

        // ตรวจสอบว่ามีการอัพโหลดรูปภาพใหม่หรือไม่
        if ($update_doc_file) {
            $old_file_path = './docs/file/' . $old_document->msg_pres_pdf;
            if (file_exists($old_file_path)) {
                unlink($old_file_path);
            }

            // Check used space
            $used_space_mb = $this->space_model->get_used_space();
            $upload_limit_mb = $this->space_model->get_limit_storage();

            $total_space_required = 0;
            if (!empty($_FILES['msg_pres_pdf']['name'])) {
                $total_space_required += $_FILES['msg_pres_pdf']['size'];
            }

            if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
                $this->session->set_flashdata('save_error', TRUE);
                redirect('msg_pres/editing');
                return;
            }

            $config['upload_path'] = './docs/file';
            $config['allowed_types'] = 'pdf';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('msg_pres_pdf')) {
                echo $this->upload->display_errors();
                return;
            }

            $data = $this->upload->data();
            $filename = $data['file_name'];
        } else {
            // ใช้รูปภาพเดิม
            $filename = $old_document->msg_pres_pdf;
        }

        $data = array(
            'msg_pres_name' => $this->input->post('msg_pres_name'),
            'msg_pres_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่เพิ่มข้อมูล
            'msg_pres_pdf' => $filename
        );

        $this->db->where('msg_pres_id', $msg_pres_id);
        $query = $this->db->update('tbl_msg_pres', $data);

        $this->space_model->update_server_current();


        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล !');";
            echo "</script>";
        }
    }

    public function msg_pres_frontend()
    {
        $this->db->select('*');
        $this->db->from('tbl_msg_pres');
        $query = $this->db->get();
        return $query->result();
    }
    public function increment_view()
    {
        $this->db->where('msg_pres_id', 1);
        $this->db->set('msg_pres_view', 'msg_pres_view + 1', false); // บวกค่า msg_pres_view ทีละ 1
        $this->db->update('tbl_msg_pres');
    }
    public function increment_download_msg_pres()
    {
        $this->db->where('msg_pres_id', 1);
        $this->db->set('msg_pres_download', 'msg_pres_download + 1', false); // บวกค่า msg_pres_view ทีละ 1
        $this->db->update('tbl_msg_pres');
    }
}
