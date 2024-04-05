<?php
class P_palaces_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    public function add_p_palaces()
    {
        // Check used space
        $used_space_mb = $this->space_model->get_used_space();
        $upload_limit_mb = $this->space_model->get_limit_storage();

        // Calculate the total space required for the file
        $total_space_required = 0;
        if (!empty($_FILES['p_palaces_img']['name'])) {
            $total_space_required += $_FILES['p_palaces_img']['size'];
        }

        // Check if there's enough space
        if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('p_palaces/adding_p_palaces');
            return;
        }

        // Upload configuration
        $config['upload_path'] = './docs/img';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);

        // Upload main file
        if (!$this->upload->do_upload('p_palaces_img')) {
            // If the file size exceeds the max_size, set flash data and redirect
            $this->session->set_flashdata('save_maxsize', TRUE);
            redirect('p_palaces/adding_p_palaces');
            return;
        }

        $data = $this->upload->data();
        $filename = $data['file_name'];

        $data = array(
            'p_palaces_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
            'p_palaces_img' => $filename
        );

        $query = $this->db->insert('tbl_p_palaces', $data);

        $this->space_model->update_server_current();

        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('Error !');";
            echo "</script>";
        }
    }


    public function list_all()
    {
        $this->db->order_by('p_palaces_id', 'DESC');
        $query = $this->db->get('tbl_p_palaces');
        return $query->result();
    }

    //show form edit
    public function read($p_palaces_id)
    {
        $this->db->where('p_palaces_id', $p_palaces_id);
        $query = $this->db->get('tbl_p_palaces');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function edit_p_palaces($p_palaces_id)
    {
        $old_document = $this->db->get_where('tbl_p_palaces', array('p_palaces_id' => $p_palaces_id))->row();
    
        $update_doc_file = !empty($_FILES['p_palaces_img']['name']) && $old_document->p_palaces_img != $_FILES['p_palaces_img']['name'];
    
        // ตรวจสอบว่ามีการอัพโหลดรูปภาพใหม่หรือไม่
        if ($update_doc_file) {
            $old_file_path = './docs/img/' . $old_document->p_palaces_img;
            if (file_exists($old_file_path)) {
                unlink($old_file_path);
            }
    
            // Check used space
            $used_space_mb = $this->space_model->get_used_space();
            $upload_limit_mb = $this->space_model->get_limit_storage();
    
            $total_space_required = 0;
            if (!empty($_FILES['p_palaces_img']['name'])) {
                $total_space_required += $_FILES['p_palaces_img']['size'];
            }
    
            if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
                $this->session->set_flashdata('save_error', TRUE);
                redirect('p_palaces/editing_p_palaces');
                return;
            }
    
            $config['upload_path'] = './docs/img';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
    
            if (!$this->upload->do_upload('p_palaces_img')) {
                echo $this->upload->display_errors();
                return;
            }
    
            $data = $this->upload->data();
            $filename = $data['file_name'];
        } else {
            // ใช้รูปภาพเดิม
            $filename = $old_document->p_palaces_img;
        }
    
        $data = array(
            'p_palaces_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
            'p_palaces_img' => $filename
        );
    
        $this->db->where('p_palaces_id', $p_palaces_id);
        $query = $this->db->update('tbl_p_palaces', $data);
    
        $this->space_model->update_server_current();
    
        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล !');";
            echo "</script>";
        }
    }
    

    public function del_p_palaces($p_palaces_id)
    {
        $old_document = $this->db->get_where('tbl_p_palaces', array('p_palaces_id' => $p_palaces_id))->row();

        $old_file_path = './docs/img/' . $old_document->p_palaces_img;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_p_palaces', array('p_palaces_id' => $p_palaces_id));
    }

    public function p_palaces_frontend()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_palaces');
        $this->db->where('tbl_p_palaces.p_palaces_status', 'show');
        $this->db->order_by('tbl_p_palaces.p_palaces_id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
}
