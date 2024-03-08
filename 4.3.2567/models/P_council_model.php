<?php
class P_council_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    public function add_p_council()
    {

        // Check used space
        $used_space_mb = $this->space_model->get_used_space();
        $upload_limit_mb = $this->space_model->get_limit_storage();

        // Calculate the total space required for all files
        $total_space_required = 0;
        if (!empty($_FILES['p_council_img']['name'])) {
            $total_space_required += $_FILES['p_council_img']['size'];
        }

        // Check if there's enough space
        if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('p_council/adding_p_council');
            return;
        }

        $config['upload_path'] = './docs/img';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);

        // Upload main file
        if (!$this->upload->do_upload('p_council_img')) {
            $this->session->set_flashdata('save_maxsize', TRUE);
            redirect('p_council/adding_p_council'); // กลับไปหน้าเดิม
            return;
        }
        $data = $this->upload->data();
        $filename =  $data['file_name'];


        $data = array(
            'p_council_name' => $this->input->post('p_council_name'),
            'p_council_rank' => $this->input->post('p_council_rank'),
            'p_council_phone' => $this->input->post('p_council_phone'),
            'p_council_row' => $this->input->post('p_council_row'),
            'p_council_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่เพิ่มข้อมูล
            'p_council_img' => $filename
        );

        $query = $this->db->insert('tbl_p_council', $data);

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
        $query = $this->db->get('tbl_p_council_group');
        return $query->result();
    }

    public function get_department_by_group($group_name)
    {
        $this->db->distinct();
        $this->db->select('pgroup_dname');
        $this->db->where('pgroup_gname', $group_name);
        $query = $this->db->get('tbl_p_council_group');
        return $query->result();
    }


    public function list_all()
    {
        $this->db->order_by('p_council_row', 'asc');
        $this->db->order_by('p_council_column', 'asc');
        $query = $this->db->get('tbl_p_council');
        return $query->result();
    }


    //show form edit
    public function read($p_council_id)
    {
        $this->db->where('p_council_id', $p_council_id);
        $query = $this->db->get('tbl_p_council');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    // public function getAllColumn($p_council_id)
    // {
    //     // ใช้ค่า p_council_row ในการดึงข้อมูลทั้งหมดที่ต้องการ
    //     $old_row = $this->db->get_where('tbl_p_council', array('p_council_id' => $p_council_id))->row();

    //     // ใช้ค่า p_council_row ในการดึงข้อมูลทั้งหมดที่ต้องการ
    //     $this->db->where('p_council_row', $old_row->p_council_row);
    //     $this->db->order_by('p_council_column', 'asc');
    //     $this->db->select('p_council_column');
    //     $query = $this->db->get('tbl_p_council');
    //     return $query->result_array();
    // }

    public function edit_p_council($p_council_id)
    {
        $old_document = $this->db->get_where('tbl_p_council', array('p_council_id' => $p_council_id))->row();

        $update_doc_file = !empty($_FILES['p_council_img']['name']) && $old_document->p_council_img != $_FILES['p_council_img']['name'];


        // ตรวจสอบว่ามีการอัพโหลดรูปภาพใหม่หรือไม่
        if ($update_doc_file) {
            $old_file_path = './docs/img/' . $old_document->p_council_img;
            if (file_exists($old_file_path)) {
                unlink($old_file_path);
            }

            // Check used space
            $used_space_mb = $this->space_model->get_used_space();
            $upload_limit_mb = $this->space_model->get_limit_storage();

            $total_space_required = 0;
            if (!empty($_FILES['p_council_img']['name'])) {
                $total_space_required += $_FILES['p_council_img']['size'];
            }

            if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
                $this->session->set_flashdata('save_error', TRUE);
                redirect('p_council/editing_p_council');
                return;
            }

            $config['upload_path'] = './docs/img';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('p_council_img')) {
                echo $this->upload->display_errors();
                return;
            }

            $data = $this->upload->data();
            $filename = $data['file_name'];
        } else {
            // ใช้รูปภาพเดิม
            $filename = $old_document->p_council_img;
        }

        $data = array(
            'p_council_name' => $this->input->post('p_council_name'),
            'p_council_phone' => $this->input->post('p_council_phone'),
            'p_council_column' => $this->input->post('p_council_column'),
            'p_council_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่เพิ่มข้อมูล
            'p_council_img' => $filename
        );

        $p_council_rank = $this->input->post('p_council_rank');

        // ตรวจสอบว่า $p_council_rank ไม่ใช่ค่าว่าง และไม่ใช่ null
        if ($p_council_rank !== "" && $p_council_rank !== null) {
            $data['p_council_rank'] = $p_council_rank;
        }

        $this->db->where('p_council_id', $p_council_id);
        $query = $this->db->update('tbl_p_council', $data);

        $this->space_model->update_server_current();

        // เปลี่ยนตำแหน่ง และ + 1 ค่าที่ *******
        $p_council_row = $old_document->p_council_row;

        $old_column = $old_document->p_council_column;
        $new_column = $this->input->post('p_council_column');

        // ดึงข้อมูลทั้งหมดจากฐานข้อมูล
        $all_column = $this->db->get('tbl_p_council')->result_array();

        // ตรวจสอบตำแหน่งที่มีค่ามากกว่าหรือเท่ากับตำแหน่งที่เปลี่ยนมา
        foreach ($all_column as $column) {
            if ($column['p_council_column'] >= $new_column && $column['p_council_column'] <= $old_column) {
                // ตำแหน่งใหม่ที่จะตั้ง
                $new_column_value = $column['p_council_column'] + 1;

                // อัปเดตตำแหน่งในฐานข้อมูล
                $this->db->where('p_council_id', $column['p_council_id']);
                $this->db->where('p_council_row', $p_council_row);
                $this->db->update('tbl_p_council', ['p_council_column' => $new_column_value]);
            }
        }

        // อัปเดตตำแหน่งของรายการที่กำลังแก้ไข
        $this->db->where('p_council_id', $p_council_id);
        $this->db->where('p_council_row', $p_council_row);
        $this->db->update('tbl_p_council', ['p_council_column' => $new_column]);

        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล !');";
            echo "</script>";
        }
    }

    public function del_p_council($p_council_id)
    {
        $old_document = $this->db->get_where('tbl_p_council', array('p_council_id' => $p_council_id))->row();

        $old_file_path = './docs/img/' . $old_document->p_council_img;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_p_council', array('p_council_id' => $p_council_id));
    }

    public function p_council_frontend_one()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_council');
        $this->db->where('tbl_p_council.p_council_id', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function p_council_row_1()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_council');
        $this->db->where('tbl_p_council.p_council_row', 1);
        $this->db->where('tbl_p_council.p_council_id !=', 1);
        $this->db->order_by('tbl_p_council.p_council_column', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    public function p_council_row_2()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_council');
        $this->db->where('tbl_p_council.p_council_row', 2);
        $this->db->where('tbl_p_council.p_council_id !=', 1);
        $this->db->order_by('tbl_p_council.p_council_column', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    public function p_council_row_3()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_council');
        $this->db->where('tbl_p_council.p_council_row', 3);
        $this->db->where('tbl_p_council.p_council_id !=', 1);
        $this->db->order_by('tbl_p_council.p_council_column', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    public function p_council_row_4()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_council');
        $this->db->where('tbl_p_council.p_council_row', 4);
        $this->db->where('tbl_p_council.p_council_id !=', 1);
        $this->db->order_by('tbl_p_council.p_council_column', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    public function p_council_row_5()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_council');
        $this->db->where('tbl_p_council.p_council_row', 5);
        $this->db->where('tbl_p_council.p_council_id !=', 1);
        $this->db->order_by('tbl_p_council.p_council_column', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    // public function p_council_frontend_one_left()
    // {
    //     $this->db->select('*');
    //     $this->db->from('tbl_p_council');
    //     $this->db->where('tbl_p_council.p_council_rank', 'รองประธานสภาองค์การบริหารส่วนตำบล');
    //     $query = $this->db->get();
    //     return $query->result();
    // }
    // public function p_council_frontend_one_right()
    // {
    //     $this->db->select('*');
    //     $this->db->from('tbl_p_council');
    //     $this->db->where('tbl_p_council.p_council_rank', 'เลขานุการสภาองค์การบริหารส่วนตำบล');
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    // public function p_council_frontend_list()
    // {
    //     $positions_to_exclude = array(
    //         'ประธานสภาองค์การบริหารส่วนตำบลกาเกาะ',
    //         'รองประธานสภาองค์การบริหารส่วนตำบล',
    //         'เลขานุการสภาองค์การบริหารส่วนตำบล'
    //     );

    //     $this->db->select('*');
    //     $this->db->from('tbl_p_council');
    //     $this->db->where_not_in('p_council_rank', $positions_to_exclude);
    //     $this->db->order_by('tbl_p_council.p_council_id', 'asc');
    //     $query = $this->db->get();
    //     return $query->result();
    // }

}
