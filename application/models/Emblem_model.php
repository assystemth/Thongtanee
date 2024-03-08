<?php
class Emblem_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    public function list_all()
    {
        $this->db->order_by('emblem_id', 'DESC');
        $query = $this->db->get('tbl_emblem');
        return $query->result();
    }

    //show form edit
    public function read($emblem_id)
    {
        $this->db->where('emblem_id', $emblem_id);
        $query = $this->db->get('tbl_emblem');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function edit($emblem_id)
    {
        $old_document = $this->db->get_where('tbl_emblem', array('emblem_id' => $emblem_id))->row();

        $update_doc_file = !empty($_FILES['emblem_img']['name']) && $old_document->emblem_img != $_FILES['emblem_img']['name'];

        // ตรวจสอบว่ามีการอัพโหลดรูปภาพใหม่หรือไม่
        if ($update_doc_file) {
            $old_file_path = './docs/img/' . $old_document->emblem_img;
            if (file_exists($old_file_path)) {
                unlink($old_file_path);
            }

            // Check used space
            $used_space_mb = $this->space_model->get_used_space();
            $upload_limit_mb = $this->space_model->get_limit_storage();

            $total_space_required = 0;
            if (!empty($_FILES['emblem_img']['name'])) {
                $total_space_required += $_FILES['emblem_img']['size'];
            }

            if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
                $this->session->set_flashdata('save_error', TRUE);
                redirect('emblem/editing_emblem');
                return;
            }

            $config['upload_path'] = './docs/img';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('emblem_img')) {
                echo $this->upload->display_errors();
                return;
            }

            $data = $this->upload->data();
            $filename = $data['file_name'];
        } else {
            // ใช้รูปภาพเดิม
            $filename = $old_document->emblem_img;
        }

        $data = array(
            'emblem_text1' => $this->input->post('emblem_text1'),
            'emblem_text2' => $this->input->post('emblem_text2'),
            'emblem_text3' => $this->input->post('emblem_text3'),
            'emblem_text4' => $this->input->post('emblem_text4'),
            'emblem_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่เพิ่มข้อมูล
            'emblem_img' => $filename
        );

        $this->db->where('emblem_id', $emblem_id);
        $query = $this->db->update('tbl_emblem', $data);

        $this->space_model->update_server_current();


        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล !');";
            echo "</script>";
        }
    }

    public function emblem_frontend()
    {
        $this->db->select('*');
        $this->db->from('tbl_emblem');
        $query = $this->db->get();
        return $query->result();
    }
}
