<?php
class Msg_prem_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    public function list_all()
    {
        $this->db->order_by('msg_prem_id', 'DESC');
        $query = $this->db->get('tbl_msg_prem');
        return $query->result();
    }

    //show form edit
    public function read($msg_prem_id)
    {
        $this->db->where('msg_prem_id', $msg_prem_id);
        $query = $this->db->get('tbl_msg_prem');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function edit($msg_prem_id)
    {
        $old_document = $this->db->get_where('tbl_msg_prem', array('msg_prem_id' => $msg_prem_id))->row();

        $update_doc_file = !empty($_FILES['msg_prem_pdf']['name']) && $old_document->msg_prem_pdf != $_FILES['msg_prem_pdf']['name'];

        // ตรวจสอบว่ามีการอัพโหลดรูปภาพใหม่หรือไม่
        if ($update_doc_file) {
            $old_file_path = './docs/file/' . $old_document->msg_prem_pdf;
            if (file_exists($old_file_path)) {
                unlink($old_file_path);
            }

            // Check used space
            $used_space_mb = $this->space_model->get_used_space();
            $upload_limit_mb = $this->space_model->get_limit_storage();

            $total_space_required = 0;
            if (!empty($_FILES['msg_prem_pdf']['name'])) {
                $total_space_required += $_FILES['msg_prem_pdf']['size'];
            }

            if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
                $this->session->set_flashdata('save_error', TRUE);
                redirect('msg_prem/editing');
                return;
            }

            $config['upload_path'] = './docs/file';
            $config['allowed_types'] = 'pdf';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('msg_prem_pdf')) {
                echo $this->upload->display_errors();
                return;
            }

            $data = $this->upload->data();
            $filename = $data['file_name'];
        } else {
            // ใช้รูปภาพเดิม
            $filename = $old_document->msg_prem_pdf;
        }

        $data = array(
            'msg_prem_name' => $this->input->post('msg_prem_name'),
            'msg_prem_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่เพิ่มข้อมูล
            'msg_prem_pdf' => $filename
        );

        $this->db->where('msg_prem_id', $msg_prem_id);
        $query = $this->db->update('tbl_msg_prem', $data);

        $this->space_model->update_server_current();


        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล !');";
            echo "</script>";
        }
    }

    public function msg_prem_frontend()
    {
        $this->db->select('*');
        $this->db->from('tbl_msg_prem');
        $query = $this->db->get();
        return $query->result();
    }
    public function increment_view()
    {
        $this->db->where('msg_prem_id', 1);
        $this->db->set('msg_prem_view', 'msg_prem_view + 1', false); // บวกค่า msg_prem_view ทีละ 1
        $this->db->update('tbl_msg_prem');
    }
    public function increment_download_msg_prem()
    {
        $this->db->where('msg_prem_id', 1);
        $this->db->set('msg_prem_download', 'msg_prem_download + 1', false); // บวกค่า msg_prem_view ทีละ 1
        $this->db->update('tbl_msg_prem');
    }
}
