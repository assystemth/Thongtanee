<?php
class P_maintenance_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    public function add_p_maintenance()
    {
        // Check used space
        $used_space_mb = $this->space_model->get_used_space();
        $upload_limit_mb = $this->space_model->get_limit_storage();

        // Calculate the total space required for all files
        $total_space_required = 0;
        if (!empty($_FILES['p_maintenance_img']['name'])) {
            $total_space_required += $_FILES['p_maintenance_img']['size'];
        }

        // Check if there's enough space
        if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('p_maintenance/adding_p_maintenance');
            return;
        }

        $config['upload_path'] = './docs/img';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);

        // Upload main file
        if (!$this->upload->do_upload('p_maintenance_img')) {
            $this->session->set_flashdata('save_maxsize', TRUE);
            redirect('p_maintenance/adding_p_maintenance'); // กลับไปหน้าเดิม
            return;
        }
        $data = $this->upload->data();
        $filename =  $data['file_name'];


        $data = array(
            'p_maintenance_name' => $this->input->post('p_maintenance_name'),
            'p_maintenance_rank' => $this->input->post('p_maintenance_rank'),
            'p_maintenance_phone' => $this->input->post('p_maintenance_phone'),
            'p_maintenance_row' => $this->input->post('p_maintenance_row'),
            'p_maintenance_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่เพิ่มข้อมูล
            'p_maintenance_img' => $filename
        );

        $query = $this->db->insert('tbl_p_maintenance', $data);

        $this->space_model->update_server_current();


        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('Error !');";
            echo "</script>";
        }
    }

    public function get_group()
    {
        $this->db->distinct();
        $this->db->select('pgroup_gname');
        $query = $this->db->get('tbl_p_maintenance_group');
        return $query->result();
    }

    public function get_department_by_group($group_name)
    {
        $this->db->distinct();
        $this->db->select('pgroup_dname');
        $this->db->where('pgroup_gname', $group_name);
        $query = $this->db->get('tbl_p_maintenance_group');
        return $query->result();
    }

    public function list_all()
    {
        $this->db->order_by('p_maintenance_row', 'asc');
        $this->db->order_by('p_maintenance_column', 'asc');
        $query = $this->db->get('tbl_p_maintenance');
        return $query->result();
    }

    //show form edit
    public function read($p_maintenance_id)
    {
        $this->db->where('p_maintenance_id', $p_maintenance_id);
        $query = $this->db->get('tbl_p_maintenance');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function edit_p_maintenance($p_maintenance_id)
    {
        $old_document = $this->db->get_where('tbl_p_maintenance', array('p_maintenance_id' => $p_maintenance_id))->row();

        $update_doc_file = !empty($_FILES['p_maintenance_img']['name']) && $old_document->p_maintenance_img != $_FILES['p_maintenance_img']['name'];

        // ตรวจสอบว่ามีการอัพโหลดรูปภาพใหม่หรือไม่
        if ($update_doc_file) {
            $old_file_path = './docs/img/' . $old_document->p_maintenance_img;
            if (file_exists($old_file_path)) {
                unlink($old_file_path);
            }

            // Check used space
            $used_space_mb = $this->space_model->get_used_space();
            $upload_limit_mb = $this->space_model->get_limit_storage();

            $total_space_required = 0;
            if (!empty($_FILES['p_maintenance_img']['name'])) {
                $total_space_required += $_FILES['p_maintenance_img']['size'];
            }

            if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
                $this->session->set_flashdata('save_error', TRUE);
                redirect('p_maintenance/editing_p_maintenance');
                return;
            }

            $config['upload_path'] = './docs/img';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('p_maintenance_img')) {
                echo $this->upload->display_errors();
                return;
            }

            $data = $this->upload->data();
            $filename = $data['file_name'];
        } else {
            // ใช้รูปภาพเดิม
            $filename = $old_document->p_maintenance_img;
        }

        $data = array(
            'p_maintenance_name' => $this->input->post('p_maintenance_name'),
            'p_maintenance_rank' => $this->input->post('p_maintenance_rank'),
            'p_maintenance_phone' => $this->input->post('p_maintenance_phone'),
            'p_maintenance_column' => $this->input->post('p_maintenance_column'),
            'p_maintenance_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่เพิ่มข้อมูล
            'p_maintenance_img' => $filename
        );

        $this->db->where('p_maintenance_id', $p_maintenance_id);
        $query = $this->db->update('tbl_p_maintenance', $data);

        $this->space_model->update_server_current();

        // เปลี่ยนตำแหน่ง และ + 1 ค่าที่ *******
        $p_maintenance_row = $old_document->p_maintenance_row;

        $old_column = $old_document->p_maintenance_column;
        $new_column = $this->input->post('p_maintenance_column');

        // ดึงข้อมูลทั้งหมดจากฐานข้อมูล
        $all_column = $this->db->get('tbl_p_maintenance')->result_array();

        // ตรวจสอบตำแหน่งที่มีค่ามากกว่าหรือเท่ากับตำแหน่งที่เปลี่ยนมา
        foreach ($all_column as $column) {
            if ($column['p_maintenance_column'] >= $new_column && $column['p_maintenance_column'] <= $old_column) {
                // ตำแหน่งใหม่ที่จะตั้ง
                $new_column_value = $column['p_maintenance_column'] + 1;

                // อัปเดตตำแหน่งในฐานข้อมูล
                $this->db->where('p_maintenance_id', $column['p_maintenance_id']);
                $this->db->where('p_maintenance_row', $p_maintenance_row);
                $this->db->update('tbl_p_maintenance', ['p_maintenance_column' => $new_column_value]);
            }
        }

        // อัปเดตตำแหน่งของรายการที่กำลังแก้ไข
        $this->db->where('p_maintenance_id', $p_maintenance_id);
        $this->db->where('p_maintenance_row', $p_maintenance_row);
        $this->db->update('tbl_p_maintenance', ['p_maintenance_column' => $new_column]);

        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล !');";
            echo "</script>";
        }
    }

    public function del_p_maintenance($p_maintenance_id)
    {
        $old_document = $this->db->get_where('tbl_p_maintenance', array('p_maintenance_id' => $p_maintenance_id))->row();

        $old_file_path = './docs/img/' . $old_document->p_maintenance_img;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_p_maintenance', array('p_maintenance_id' => $p_maintenance_id));
    }

    
    public function p_maintenance_one()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_maintenance');
        $this->db->where('tbl_p_maintenance.p_maintenance_id', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function p_maintenance_under_one()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_maintenance');
        $this->db->where('tbl_p_maintenance.p_maintenance_id !=', 1);
        $query = $this->db->get();
        return $query->result();
    }


    public function p_maintenance_frontend_one()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_maintenance');
        $this->db->where_in('tbl_p_maintenance.p_maintenance_id', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function p_maintenance_row_1()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_maintenance');
        $this->db->where('tbl_p_maintenance.p_maintenance_row', 1);
        $this->db->where('tbl_p_maintenance.p_maintenance_id !=', 1);
        $this->db->order_by('tbl_p_maintenance.p_maintenance_column', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    public function p_maintenance_row_2()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_maintenance');
        $this->db->where('tbl_p_maintenance.p_maintenance_row', 2);
        $this->db->where('tbl_p_maintenance.p_maintenance_id !=', 1);
        $this->db->order_by('tbl_p_maintenance.p_maintenance_column', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    public function p_maintenance_row_3()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_maintenance');
        $this->db->where('tbl_p_maintenance.p_maintenance_row', 3);
        $this->db->where('tbl_p_maintenance.p_maintenance_id !=', 1);
        $this->db->order_by('tbl_p_maintenance.p_maintenance_column', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    public function p_maintenance_row_4()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_maintenance');
        $this->db->where('tbl_p_maintenance.p_maintenance_row', 4);
        $this->db->where('tbl_p_maintenance.p_maintenance_id !=', 1);
        $this->db->order_by('tbl_p_maintenance.p_maintenance_column', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    public function p_maintenance_row_5()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_maintenance');
        $this->db->where('tbl_p_maintenance.p_maintenance_row', 5);
        $this->db->where('tbl_p_maintenance.p_maintenance_id !=', 1);
        $this->db->order_by('tbl_p_maintenance.p_maintenance_column', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    // public function p_maintenance_frontend_one()
    // {
    //     $this->db->select('*');
    //     $this->db->from('tbl_p_maintenance');
    //     $this->db->where('tbl_p_maintenance.p_maintenance_rank', 'ผู้อำนวยการกองช่าง');
    //     $this->db->order_by('tbl_p_maintenance.p_maintenance_id', 'DESC');
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    // public function p_maintenance_frontend_list()
    // {
    //     $positions_to_exclude = array(
    //         'ผู้อำนวยการกองช่าง',
    //     );

    //     $this->db->select('*');
    //     $this->db->from('tbl_p_maintenance');
    //     $this->db->where_not_in('p_maintenance_rank', $positions_to_exclude);
    //     $this->db->order_by('tbl_p_maintenance.p_maintenance_id', 'asc');
    //     $query = $this->db->get();
    //     return $query->result();
    // }
}
