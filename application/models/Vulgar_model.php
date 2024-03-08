<?php
class Vulgar_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    // เช็คข้อมูลซ้ำ
    public function add()
    {
        $vulgar_com = $this->input->post('vulgar_com');
        $this->db->select('vulgar_com');
        $this->db->where('vulgar_com', $vulgar_com);
        $query = $this->db->get('tbl_vulgar');
        $num = $query->num_rows();
        if ($num > 0) {
            $this->session->set_flashdata('save_again', TRUE);
        } else {
            // Check used space
            $used_space_mb = $this->space_model->get_used_space();
            $upload_limit_mb = $this->space_model->get_limit_storage();

            // Calculate the total space required for all files
            $total_space_required = 0;
            if (!empty($_FILES['m_img']['name'])) {
                $total_space_required += $_FILES['m_img']['size'];
            }

            // Check if there's enough space
            if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
                $this->session->set_flashdata('save_error', TRUE);
                redirect('vulgar');
                return;
            }

            $data = array(
                'vulgar_com' => $this->input->post('vulgar_com'),
                'vulgar_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่เพิ่มข้อมูล
            );
            $query = $this->db->insert('tbl_vulgar', $data);

            $this->space_model->update_server_current();
            $this->session->set_flashdata('save_success', TRUE);
        }
    }

    public function list()
    {
        $this->db->select('*');
        $this->db->from('tbl_vulgar');
        $this->db->order_by('tbl_vulgar.vulgar_id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function read($vulgar_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_vulgar');
        $this->db->where('tbl_vulgar.vulgar_id', $vulgar_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return false;
    }

    public function edit($vulgar_id)
    {
        $vulgar_com = $this->input->post('vulgar_com');

        // Check if the new vulgar_com value is not already in the database for other records.
        $this->db->where('vulgar_com', $vulgar_com);
        $this->db->where_not_in('vulgar_id', $vulgar_id); // Exclude the current record being edited.
        $query = $this->db->get('tbl_vulgar');
        $num = $query->num_rows();

        if ($num > 0) {
            // A record with the same vulgar_com already exists in the database.
            $this->session->set_flashdata('save_again', TRUE);
        } else {
            // Update the record.
            $data = array(
                'vulgar_com' => $vulgar_com,
                'vulgar_by' => $this->session->userdata('m_fname'), // Add the name of the person updating the record.
            );

            $this->db->where('vulgar_id', $vulgar_id);
            $this->db->update('tbl_vulgar', $data);

            $this->space_model->update_server_current();
            $this->session->set_flashdata('save_success', TRUE);
        }
    }


    public function del($vulgar_id)
    {
        $this->db->delete('tbl_vulgar', array('vulgar_id' => $vulgar_id));
    }
}
