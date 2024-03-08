<?php
class Executivepolicy_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    public function list_all()
    {
        $this->db->order_by('executivepolicy_id', 'DESC');
        $query = $this->db->get('tbl_executivepolicy');
        return $query->result();
    }

    //show form edit
    public function read($executivepolicy_id)
    {
        $this->db->where('executivepolicy_id', $executivepolicy_id);
        $query = $this->db->get('tbl_executivepolicy');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function edit($executivepolicy_id)
    {
        $old_document = $this->db->get_where('tbl_executivepolicy', array('executivepolicy_id' => $executivepolicy_id))->row();

        $update_doc_file = !empty($_FILES['executivepolicy_pdf']['name']) && $old_document->executivepolicy_pdf != $_FILES['executivepolicy_pdf']['name'];

        // ตรวจสอบว่ามีการอัพโหลดรูปภาพใหม่หรือไม่
        if ($update_doc_file) {
            $old_file_path = './docs/file/' . $old_document->executivepolicy_pdf;
            if (file_exists($old_file_path)) {
                unlink($old_file_path);
            }

            // Check used space
            $used_space_mb = $this->space_model->get_used_space();
            $upload_limit_mb = $this->space_model->get_limit_storage();

            $total_space_required = 0;
            if (!empty($_FILES['executivepolicy_pdf']['name'])) {
                $total_space_required += $_FILES['executivepolicy_pdf']['size'];
            }

            if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
                $this->session->set_flashdata('save_error', TRUE);
                redirect('executivepolicy/editing');
                return;
            }

            $config['upload_path'] = './docs/file';
            $config['allowed_types'] = 'pdf';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('executivepolicy_pdf')) {
                echo $this->upload->display_errors();
                return;
            }

            $data = $this->upload->data();
            $filename = $data['file_name'];
        } else {
            // ใช้รูปภาพเดิม
            $filename = $old_document->executivepolicy_pdf;
        }

        $data = array(
            'executivepolicy_name' => $this->input->post('executivepolicy_name'),
            'executivepolicy_detail' => $this->input->post('executivepolicy_detail'),
            'executivepolicy_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่เพิ่มข้อมูล
            'executivepolicy_pdf' => $filename
        );

        $this->db->where('executivepolicy_id', $executivepolicy_id);
        $query = $this->db->update('tbl_executivepolicy', $data);

        $this->space_model->update_server_current();


        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล !');";
            echo "</script>";
        }
    }

    public function executivepolicy_frontend()
    {
        $this->db->select('*');
        $this->db->from('tbl_executivepolicy');
        $query = $this->db->get();
        return $query->result();
    }
    public function increment_view()
    {
        $this->db->where('executivepolicy_id', 1);
        $this->db->set('executivepolicy_view', 'executivepolicy_view + 1', false); // บวกค่า executivepolicy_view ทีละ 1
        $this->db->update('tbl_executivepolicy');
    }
    public function increment_download_executivepolicy()
    {
        $this->db->where('executivepolicy_id', 1);
        $this->db->set('executivepolicy_download', 'executivepolicy_download + 1', false); // บวกค่า executivepolicy_view ทีละ 1
        $this->db->update('tbl_executivepolicy');
    }
}
