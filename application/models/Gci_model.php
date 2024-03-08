<?php
class Gci_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    public function list_all()
    {
        $this->db->order_by('gci_id', 'DESC');
        $query = $this->db->get('tbl_gci');
        return $query->result();
    }

    //show form edit
    public function read($gci_id)
    {
        $this->db->where('gci_id', $gci_id);
        $query = $this->db->get('tbl_gci');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function edit($gci_id)
    {
        $old_document = $this->db->get_where('tbl_gci', array('gci_id' => $gci_id))->row();

        $update_doc_file = !empty($_FILES['gci_img']['name']) && $old_document->gci_img != $_FILES['gci_img']['name'];

        // ตรวจสอบว่ามีการอัพโหลดรูปภาพใหม่หรือไม่
        if ($update_doc_file) {
            $old_file_path = './docs/img/' . $old_document->gci_img;
            if (file_exists($old_file_path)) {
                unlink($old_file_path);
            }

            // Check used space
            $used_space_mb = $this->space_model->get_used_space();
            $upload_limit_mb = $this->space_model->get_limit_storage();

            $total_space_required = 0;
            if (!empty($_FILES['gci_img']['name'])) {
                $total_space_required += $_FILES['gci_img']['size'];
            }

            if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
                $this->session->set_flashdata('save_error', TRUE);
                redirect('gci/editing_gci');
                return;
            }

            $config['upload_path'] = './docs/img';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gci_img')) {
                echo $this->upload->display_errors();
                return;
            }

            $data = $this->upload->data();
            $filename = $data['file_name'];
        } else {
            // ใช้รูปภาพเดิม
            $filename = $old_document->gci_img;
        }

        $data = array(
            'gci_location' => $this->input->post('gci_location'),
            'gci_territory' => $this->input->post('gci_territory'),
            'gci_terrain' => $this->input->post('gci_terrain'),
            'gci_area' => $this->input->post('gci_area'),
            'gci_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่เพิ่มข้อมูล
            'gci_img' => $filename
        );

        $this->db->where('gci_id', $gci_id);
        $query = $this->db->update('tbl_gci', $data);

        $this->space_model->update_server_current();


        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล !');";
            echo "</script>";
        }
    }

    public function gci_frontend()
    {
        $this->db->select('*');
        $this->db->from('tbl_gci');
        $query = $this->db->get();
        return $query->result();
    }
}
