<?php
class Site_map_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    public function add_site_map()
    {
        // Check used space
        $used_space_mb = $this->space_model->get_used_space();
        $upload_limit_mb = $this->space_model->get_limit_storage();

        // Calculate the total space required for the file
        $total_space_required = 0;
        if (!empty($_FILES['site_map_img']['name'])) {
            $total_space_required += $_FILES['site_map_img']['size'];
        }

        // Check if there's enough space
        if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('site_map/adding_site_map');
            return;
        }

        // Upload configuration
        $config['upload_path'] = './docs/img';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);

        // Upload main file
        if (!$this->upload->do_upload('site_map_img')) {
            // If the file size exceeds the max_size, set flash data and redirect
            $this->session->set_flashdata('save_maxsize', TRUE);
            redirect('site_map/adding_site_map');
            return;
        }

        $data = $this->upload->data();
        $filename = $data['file_name'];

        $data = array(
            'site_map_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
            'site_map_img' => $filename
        );

        $query = $this->db->insert('tbl_site_map', $data);

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
        $this->db->order_by('site_map_id', 'DESC');
        $query = $this->db->get('tbl_site_map');
        return $query->result();
    }

    //show form edit
    public function read($site_map_id)
    {
        $this->db->where('site_map_id', $site_map_id);
        $query = $this->db->get('tbl_site_map');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function edit_site_map($site_map_id)
    {
        $old_document = $this->db->get_where('tbl_site_map', array('site_map_id' => $site_map_id))->row();
    
        $update_doc_file = !empty($_FILES['site_map_img']['name']) && $old_document->site_map_img != $_FILES['site_map_img']['name'];
    
        // ตรวจสอบว่ามีการอัพโหลดรูปภาพใหม่หรือไม่
        if ($update_doc_file) {
            $old_file_path = './docs/img/' . $old_document->site_map_img;
            if (file_exists($old_file_path)) {
                unlink($old_file_path);
            }
    
            // Check used space
            $used_space_mb = $this->space_model->get_used_space();
            $upload_limit_mb = $this->space_model->get_limit_storage();
    
            $total_space_required = 0;
            if (!empty($_FILES['site_map_img']['name'])) {
                $total_space_required += $_FILES['site_map_img']['size'];
            }
    
            if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
                $this->session->set_flashdata('save_error', TRUE);
                redirect('site_map/editing_site_map');
                return;
            }
    
            $config['upload_path'] = './docs/img';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
    
            if (!$this->upload->do_upload('site_map_img')) {
                echo $this->upload->display_errors();
                return;
            }
    
            $data = $this->upload->data();
            $filename = $data['file_name'];
        } else {
            // ใช้รูปภาพเดิม
            $filename = $old_document->site_map_img;
        }
    
        $data = array(
            'site_map_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
            'site_map_img' => $filename
        );
    
        $this->db->where('site_map_id', $site_map_id);
        $query = $this->db->update('tbl_site_map', $data);
    
        $this->space_model->update_server_current();
    
        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล !');";
            echo "</script>";
        }
    }
    

    public function del_site_map($site_map_id)
    {
        $old_document = $this->db->get_where('tbl_site_map', array('site_map_id' => $site_map_id))->row();

        $old_file_path = './docs/img/' . $old_document->site_map_img;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_site_map', array('site_map_id' => $site_map_id));
    }

    public function site_map_frontend()
    {
        $this->db->select('*');
        $this->db->from('tbl_site_map');
        $this->db->where('tbl_site_map.site_map_status', 'show');
        $this->db->order_by('tbl_site_map.site_map_id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
}
