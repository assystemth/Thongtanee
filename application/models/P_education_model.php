<?php
class P_education_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    public function add_p_education()
    {
        // Check used space
        $used_space_mb = $this->space_model->get_used_space();
        $upload_limit_mb = $this->space_model->get_limit_storage();

        // Calculate the total space required for all files
        $total_space_required = 0;
        if (!empty($_FILES['p_education_img']['name'])) {
            $total_space_required += $_FILES['p_education_img']['size'];
        }

        // Check if there's enough space
        if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('p_education/adding_p_education');
            return;
        }

        $config['upload_path'] = './docs/img';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);

        // Upload main file
        if (!$this->upload->do_upload('p_education_img')) {
            $this->session->set_flashdata('save_maxsize', TRUE);
            redirect('p_education/adding_p_education'); // กลับไปหน้าเดิม
            return;
        }
        $data = $this->upload->data();
        $filename =  $data['file_name'];


        $data = array(
            'p_education_name' => $this->input->post('p_education_name'),
            'p_education_rank' => $this->input->post('p_education_rank'),
            'p_education_phone' => $this->input->post('p_education_phone'),
            'p_education_row' => $this->input->post('p_education_row'),
            'p_education_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่เพิ่มข้อมูล
            'p_education_img' => $filename
        );

        $query = $this->db->insert('tbl_p_education', $data);

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
        $query = $this->db->get('tbl_p_education_group');
        return $query->result();
    }

    public function get_department_by_group($group_name)
    {
        $this->db->distinct();
        $this->db->select('pgroup_dname');
        $this->db->where('pgroup_gname', $group_name);
        $query = $this->db->get('tbl_p_education_group');
        return $query->result();
    }

    public function list_all()
    {
        $this->db->order_by('p_education_row', 'asc');
        $this->db->order_by('p_education_column', 'asc');
        $query = $this->db->get('tbl_p_education');
        return $query->result();
    }

    //show form edit
    public function read($p_education_id)
    {
        $this->db->where('p_education_id', $p_education_id);
        $query = $this->db->get('tbl_p_education');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function edit_p_education($p_education_id)
    {
        $old_document = $this->db->get_where('tbl_p_education', array('p_education_id' => $p_education_id))->row();

        $update_doc_file = !empty($_FILES['p_education_img']['name']) && $old_document->p_education_img != $_FILES['p_education_img']['name'];

        // ตรวจสอบว่ามีการอัพโหลดรูปภาพใหม่หรือไม่
        if ($update_doc_file) {
            $old_file_path = './docs/img/' . $old_document->p_education_img;
            if (file_exists($old_file_path)) {
                unlink($old_file_path);
            }

            // Check used space
            $used_space_mb = $this->space_model->get_used_space();
            $upload_limit_mb = $this->space_model->get_limit_storage();

            $total_space_required = 0;
            if (!empty($_FILES['p_education_img']['name'])) {
                $total_space_required += $_FILES['p_education_img']['size'];
            }

            if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
                $this->session->set_flashdata('save_error', TRUE);
                redirect('p_education/editing_p_education');
                return;
            }

            $config['upload_path'] = './docs/img';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('p_education_img')) {
                echo $this->upload->display_errors();
                return;
            }

            $data = $this->upload->data();
            $filename = $data['file_name'];
        } else {
            // ใช้รูปภาพเดิม
            $filename = $old_document->p_education_img;
        }

        $data = array(
            'p_education_name' => $this->input->post('p_education_name'),
            'p_education_rank' => $this->input->post('p_education_rank'),
            'p_education_phone' => $this->input->post('p_education_phone'),
            'p_education_column' => $this->input->post('p_education_column'),
            'p_education_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่เพิ่มข้อมูล
            'p_education_img' => $filename
        );

        $this->db->where('p_education_id', $p_education_id);
        $query = $this->db->update('tbl_p_education', $data);

        $this->space_model->update_server_current();

        // เปลี่ยนตำแหน่ง และ + 1 ค่าที่ *******
        $p_education_row = $old_document->p_education_row;

        $old_column = $old_document->p_education_column;
        $new_column = $this->input->post('p_education_column');

        // ดึงข้อมูลทั้งหมดจากฐานข้อมูล
        $all_column = $this->db->get('tbl_p_education')->result_array();

        // ตรวจสอบตำแหน่งที่มีค่ามากกว่าหรือเท่ากับตำแหน่งที่เปลี่ยนมา
        foreach ($all_column as $column) {
            if ($column['p_education_column'] >= $new_column && $column['p_education_column'] <= $old_column) {
                // ตำแหน่งใหม่ที่จะตั้ง
                $new_column_value = $column['p_education_column'] + 1;

                // อัปเดตตำแหน่งในฐานข้อมูล
                $this->db->where('p_education_id', $column['p_education_id']);
                $this->db->where('p_education_row', $p_education_row);
                $this->db->update('tbl_p_education', ['p_education_column' => $new_column_value]);
            }
        }

        // อัปเดตตำแหน่งของรายการที่กำลังแก้ไข
        $this->db->where('p_education_id', $p_education_id);
        $this->db->where('p_education_row', $p_education_row);
        $this->db->update('tbl_p_education', ['p_education_column' => $new_column]);

        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล !');";
            echo "</script>";
        }
    }

    public function del_p_education($p_education_id)
    {
        $old_document = $this->db->get_where('tbl_p_education', array('p_education_id' => $p_education_id))->row();

        $old_file_path = './docs/img/' . $old_document->p_education_img;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_p_education', array('p_education_id' => $p_education_id));
    }

    public function p_education_one()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_education');
        $this->db->where('tbl_p_education.p_education_id', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function p_education_under_one()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_education');
        $this->db->where('tbl_p_education.p_education_id !=', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function p_education_frontend_one()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_education');
        $this->db->where_in('tbl_p_education.p_education_id', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function p_education_row_1()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_education');
        $this->db->where('tbl_p_education.p_education_row', 1);
        $this->db->where('tbl_p_education.p_education_id !=', 1);
        $this->db->order_by('tbl_p_education.p_education_column', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    public function p_education_row_2()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_education');
        $this->db->where('tbl_p_education.p_education_row', 2);
        $this->db->where('tbl_p_education.p_education_id !=', 1);
        $this->db->order_by('tbl_p_education.p_education_column', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    public function p_education_row_3()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_education');
        $this->db->where('tbl_p_education.p_education_row', 3);
        $this->db->where('tbl_p_education.p_education_id !=', 1);
        $this->db->order_by('tbl_p_education.p_education_column', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    public function p_education_row_4()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_education');
        $this->db->where('tbl_p_education.p_education_row', 4);
        $this->db->where('tbl_p_education.p_education_id !=', 1);
        $this->db->order_by('tbl_p_education.p_education_column', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    public function p_education_row_5()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_education');
        $this->db->where('tbl_p_education.p_education_row', 5);
        $this->db->where('tbl_p_education.p_education_id !=', 1);
        $this->db->order_by('tbl_p_education.p_education_column', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    // public function p_education_frontend_one()
    // {
    //     $this->db->select('*');
    //     $this->db->from('tbl_p_education');
    //     $this->db->where('tbl_p_education.p_education_rank', 'ผู้อำนวยการกองการศึกษาฯ');
    //     $this->db->order_by('tbl_p_education.p_education_id', 'DESC');
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    // public function p_education_frontend_list()
    // {
    //     $positions_to_exclude = array(
    //         'ผู้อำนวยการกองการศึกษาฯ',
    //     );

    //     $this->db->select('*');
    //     $this->db->from('tbl_p_education');
    //     $this->db->where_not_in('p_education_rank', $positions_to_exclude);
    //     $this->db->order_by('tbl_p_education.p_education_id', 'asc');
    //     $query = $this->db->get();
    //     return $query->result();
    // }
}
