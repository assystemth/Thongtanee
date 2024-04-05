<?php
class P_treasury_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    public function add_p_treasury()
    {
        // Check used space
        $used_space_mb = $this->space_model->get_used_space();
        $upload_limit_mb = $this->space_model->get_limit_storage();

        // Calculate the total space required for all files
        $total_space_required = 0;
        if (!empty($_FILES['p_treasury_img']['name'])) {
            $total_space_required += $_FILES['p_treasury_img']['size'];
        }

        // Check if there's enough space
        if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('p_treasury/adding_p_treasury');
            return;
        }

        $config['upload_path'] = './docs/img';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);

        // Upload main file
        if (!$this->upload->do_upload('p_treasury_img')) {
            $this->session->set_flashdata('save_maxsize', TRUE);
            redirect('p_treasury/adding_p_treasury'); // กลับไปหน้าเดิม
            return;
        }
        $data = $this->upload->data();
        $filename =  $data['file_name'];


        $data = array(
            'p_treasury_name' => $this->input->post('p_treasury_name'),
            'p_treasury_rank' => $this->input->post('p_treasury_rank'),
            'p_treasury_phone' => $this->input->post('p_treasury_phone'),
            'p_treasury_row' => $this->input->post('p_treasury_row'),
            'p_treasury_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่เพิ่มข้อมูล
            'p_treasury_img' => $filename
        );

        $query = $this->db->insert('tbl_p_treasury', $data);

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
        $query = $this->db->get('tbl_p_treasury_group');
        return $query->result();
    }

    public function get_department_by_group($group_name)
    {
        $this->db->distinct();
        $this->db->select('pgroup_dname');
        $this->db->where('pgroup_gname', $group_name);
        $query = $this->db->get('tbl_p_treasury_group');
        return $query->result();
    }


    public function list_all()
    {
        $this->db->order_by('p_treasury_row', 'asc');
        $this->db->order_by('p_treasury_column', 'asc');
        $query = $this->db->get('tbl_p_treasury');
        return $query->result();
    }

    //show form edit
    public function read($p_treasury_id)
    {
        $this->db->where('p_treasury_id', $p_treasury_id);
        $query = $this->db->get('tbl_p_treasury');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function edit_p_treasury($p_treasury_id)
    {
        $old_document = $this->db->get_where('tbl_p_treasury', array('p_treasury_id' => $p_treasury_id))->row();

        $update_doc_file = !empty($_FILES['p_treasury_img']['name']) && $old_document->p_treasury_img != $_FILES['p_treasury_img']['name'];

        // ตรวจสอบว่ามีการอัพโหลดรูปภาพใหม่หรือไม่
        if ($update_doc_file) {
            $old_file_path = './docs/img/' . $old_document->p_treasury_img;
            if (file_exists($old_file_path)) {
                unlink($old_file_path);
            }

            // Check used space
            $used_space_mb = $this->space_model->get_used_space();
            $upload_limit_mb = $this->space_model->get_limit_storage();

            $total_space_required = 0;
            if (!empty($_FILES['p_treasury_img']['name'])) {
                $total_space_required += $_FILES['p_treasury_img']['size'];
            }

            if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
                $this->session->set_flashdata('save_error', TRUE);
                redirect('p_treasury/editing_p_treasury');
                return;
            }

            $config['upload_path'] = './docs/img';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('p_treasury_img')) {
                echo $this->upload->display_errors();
                return;
            }

            $data = $this->upload->data();
            $filename = $data['file_name'];
        } else {
            // ใช้รูปภาพเดิม
            $filename = $old_document->p_treasury_img;
        }

        $data = array(
            'p_treasury_name' => $this->input->post('p_treasury_name'),
            'p_treasury_rank' => $this->input->post('p_treasury_rank'),
            'p_treasury_phone' => $this->input->post('p_treasury_phone'),
            'p_treasury_column' => $this->input->post('p_treasury_column'),
            'p_treasury_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่เพิ่มข้อมูล
            'p_treasury_img' => $filename
        );

        $this->db->where('p_treasury_id', $p_treasury_id);
        $query = $this->db->update('tbl_p_treasury', $data);

        $this->space_model->update_server_current();

        // เปลี่ยนตำแหน่ง และ + 1 ค่าที่ *******
        $p_treasury_row = $old_document->p_treasury_row;

        $old_column = $old_document->p_treasury_column;
        $new_column = $this->input->post('p_treasury_column');

        // ดึงข้อมูลทั้งหมดจากฐานข้อมูล
        $all_column = $this->db->get('tbl_p_treasury')->result_array();

        // ตรวจสอบตำแหน่งที่มีค่ามากกว่าหรือเท่ากับตำแหน่งที่เปลี่ยนมา
        foreach ($all_column as $column) {
            if ($column['p_treasury_column'] >= $new_column && $column['p_treasury_column'] <= $old_column) {
                // ตำแหน่งใหม่ที่จะตั้ง
                $new_column_value = $column['p_treasury_column'] + 1;

                // อัปเดตตำแหน่งในฐานข้อมูล
                $this->db->where('p_treasury_id', $column['p_treasury_id']);
                $this->db->where('p_treasury_row', $p_treasury_row);
                $this->db->update('tbl_p_treasury', ['p_treasury_column' => $new_column_value]);
            }
        }

        // อัปเดตตำแหน่งของรายการที่กำลังแก้ไข
        $this->db->where('p_treasury_id', $p_treasury_id);
        $this->db->where('p_treasury_row', $p_treasury_row);
        $this->db->update('tbl_p_treasury', ['p_treasury_column' => $new_column]);

        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล !');";
            echo "</script>";
        }
    }

    public function del_p_treasury($p_treasury_id)
    {
        $old_document = $this->db->get_where('tbl_p_treasury', array('p_treasury_id' => $p_treasury_id))->row();

        $old_file_path = './docs/img/' . $old_document->p_treasury_img;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_p_treasury', array('p_treasury_id' => $p_treasury_id));
    }

    
    public function p_treasury_one()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_treasury');
        $this->db->where('tbl_p_treasury.p_treasury_id', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function p_treasury_under_one()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_treasury');
        $this->db->where('tbl_p_treasury.p_treasury_id !=', 1);
        $query = $this->db->get();
        return $query->result();
    }


    public function p_treasury_frontend_one()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_treasury');
        $this->db->where_in('tbl_p_treasury.p_treasury_id', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function p_treasury_row_1()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_treasury');
        $this->db->where('tbl_p_treasury.p_treasury_row', 1);
        $this->db->where('tbl_p_treasury.p_treasury_id !=', 1);
        $this->db->order_by('tbl_p_treasury.p_treasury_column', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    public function p_treasury_row_2()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_treasury');
        $this->db->where('tbl_p_treasury.p_treasury_row', 2);
        $this->db->where('tbl_p_treasury.p_treasury_id !=', 1);
        $this->db->order_by('tbl_p_treasury.p_treasury_column', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    public function p_treasury_row_3()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_treasury');
        $this->db->where('tbl_p_treasury.p_treasury_row', 3);
        $this->db->where('tbl_p_treasury.p_treasury_id !=', 1);
        $this->db->order_by('tbl_p_treasury.p_treasury_column', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    public function p_treasury_row_4()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_treasury');
        $this->db->where('tbl_p_treasury.p_treasury_row', 4);
        $this->db->where('tbl_p_treasury.p_treasury_id !=', 1);
        $this->db->order_by('tbl_p_treasury.p_treasury_column', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    public function p_treasury_row_5()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_treasury');
        $this->db->where('tbl_p_treasury.p_treasury_row', 5);
        $this->db->where('tbl_p_treasury.p_treasury_id !=', 1);
        $this->db->order_by('tbl_p_treasury.p_treasury_column', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    // public function p_treasury_frontend_one()
    // {
    //     $this->db->select('*');
    //     $this->db->from('tbl_p_treasury');
    //     $this->db->where('tbl_p_treasury.p_treasury_rank', 'ผู้อำนวยการกองคลัง');
    //     $this->db->order_by('tbl_p_treasury.p_treasury_id', 'DESC');
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    // public function p_treasury_frontend_two()
    // {
    //     $this->db->select('*');
    //     $this->db->from('tbl_p_treasury');
    //     $this->db->where_in('tbl_p_treasury.p_treasury_id', array(2, 3));
    //     $this->db->order_by('tbl_p_treasury.p_treasury_id', 'DESC');
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    // public function p_treasury_frontend_list()
    // {
    //     $positions_to_exclude = array(
    //         1, 2, 3
    //     );

    //     $this->db->select('*');
    //     $this->db->from('tbl_p_treasury');
    //     $this->db->where_not_in('p_treasury_rank', $positions_to_exclude);
    //     $this->db->order_by('tbl_p_treasury.p_treasury_id', 'asc');
    //     $query = $this->db->get();
    //     return $query->result();
    // }
}
