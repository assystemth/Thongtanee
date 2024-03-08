<?php
class Member_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    // public function list_member()
    // {
    //     $query = $this->db->get('tbl_member');
    //     return $query->result();
    // }

    public function list_member()
    {
        $this->db->select('m.*, p.pname');
        $this->db->from('tbl_member as m');
        $this->db->join('tbl_position as p', 'm.ref_pid = p.pid', 'DESC');
        // $this->db->where('p.pid !=', 1);  // เพิ่มเงื่อนไขที่ไม่ให้แสดงข้อมูลที่มี pid เท่ากับ 1
        $this->db->order_by('m.m_id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }


    public function get_provinces()
    {
        $this->db->distinct();
        $this->db->select('tambol_pname');
        $query = $this->db->get('tbl_tambol');
        return $query->result();
    }

    public function get_unique_amphurs_by_province($province_name)
    {
        $this->db->distinct();
        $this->db->select('tambol_aname');
        $this->db->where('tambol_pname', $province_name);
        $query = $this->db->get('tbl_tambol');
        return $query->result();
    }


    public function get_tambols_by_amphur($province_name, $amphur_name)
    {
        $this->db->where('tambol_pname', $province_name);
        $this->db->where('tambol_aname', $amphur_name);
        $query = $this->db->get('tbl_tambol');
        return $query->result();
    }



    public function addmember()
    {

        $data = array(
            'ref_pid' => $this->input->post('ref_pid'),
            'm_username' => $this->input->post('m_username'),
            'm_password' => sha1($this->input->post('m_password')),
            'm_fname' => $this->input->post('m_fname'),
            'm_name' => $this->input->post('m_name'),
            'm_lname' => $this->input->post('m_lname')
        );
        $query = $this->db->insert('tbl_member', $data);

        if ($query) {
            echo 'add ok';
        } else {
            echo 'false';
        }
    }

    // เช็คข้อมูลซ้ำ
    public function add_Member()
    {
        $m_username = $this->input->post('m_username');

        $this->db->where('m_username', $m_username);

        $query = $this->db->get('tbl_member');
        $num = $query->num_rows();

        if ($num > 0) {
            $this->session->set_flashdata('save_again', TRUE);
        } else {
            // ตรวจสอบรหัสผ่าน
            $m_password1 = $this->input->post('m_password');
            $m_password2 = $this->input->post('confirm_password');

            if ($m_password1 != $m_password2) {
                // รหัสผ่านไม่ตรงกัน
                $this->session->set_flashdata('password_mismatch', TRUE);
                redirect('Member_backend/adding');
                return;
            }

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
                redirect('Member_backend/add_Member');
                return;
            }

            // Upload configuration
            $config['upload_path'] = './docs/img';
            $config['allowed_types'] = 'gif|jpg|png'; // gif|jpg|png
            $this->load->library('upload', $config);

            // Upload main file
            if (!empty($_FILES['m_img']['name']) && $this->upload->do_upload('m_img')) {
                $data = $this->upload->data();
                $filename = $data['file_name'];
            } else {
                $filename = null; // ไม่มีการอัพโหลดรูปภาพ
            }

            $data = array(
                'm_username' => $this->input->post('m_username'),
                'm_password' => sha1($m_password1),
                'ref_pid' => $this->input->post('ref_pid'),
                'm_fname' => $this->input->post('m_fname'),
                'm_lname' => $this->input->post('m_lname'),
				'm_email' => $this->input->post('m_email'),
                'm_phone' => $this->input->post('m_phone'),
                'm_img' => $filename
            );

            $this->db->insert('tbl_member', $data);

            $this->space_model->update_server_current();
            $this->session->set_flashdata('save_success', TRUE);
        }
    }

    public function read($m_id)
    {
        $this->db->select('m.*,p.pname');
        $this->db->from('tbl_member as m');
        $this->db->join('tbl_position as p', 'm.ref_pid=p.pid');
        $this->db->where('m.m_id', $m_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $data = $query->row();

            // Decrypt the password using sha1() function
            $data->m_password = sha1($data->m_password);

            return $data;
        }

        return false;
    }


    public function edit_Member($m_id)
    {
        $old_document = $this->db->get_where('tbl_member', array('m_id' => $m_id))->row();

        $update_doc_file = !empty($_FILES['m_img']['name']) && $old_document->m_img != $_FILES['m_img']['name'];

        // ตรวจสอบว่ามีการอัพโหลดรูปภาพใหม่หรือไม่
        if ($update_doc_file) {
            $old_file_path = './docs/img/' . $old_document->m_img;
            if (file_exists($old_file_path)) {
                unlink($old_file_path);
            }

            // Check used space
            $used_space_mb = $this->space_model->get_used_space();
            $upload_limit_mb = $this->space_model->get_limit_storage();

            $total_space_required = 0;
            if (!empty($_FILES['m_img']['name'])) {
                $total_space_required += $_FILES['m_img']['size'];
            }

            if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
                $this->session->set_flashdata('save_error', TRUE);
                redirect('Member_backend/edit/' . $m_id);
                return;
            }

            $config['upload_path'] = './docs/img';
            $config['allowed_types'] = 'gif|jpg|png';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('m_img')) {
                echo $this->upload->display_errors();
                return;
            }

            $data = $this->upload->data();
            $filename = $data['file_name'];
        } else {
            // ใช้รูปภาพเดิม
            $filename = $old_document->m_img;
        }

        $data = array(
            'm_username' => $this->input->post('m_username'),
            'ref_pid' => $this->input->post('ref_pid'),
            'm_fname' => $this->input->post('m_fname'),
            'm_lname' => $this->input->post('m_lname'),
            'm_email' => $this->input->post('m_email'),
            'm_phone' => $this->input->post('m_phone'),
            'm_img' => $filename
        );

        $current_password = $this->input->post('current_password');
        $current_password2 = $this->input->post('current_password2');

        if (!empty($current_password) || !empty($current_password2)) {
            if ($current_password == $current_password2) {
                $data['m_password'] = sha1($current_password);
                $this->db->where('m_id', $m_id);
                $this->db->update('tbl_member', $data);
            } else {
                // รหัสผ่านไม่ตรงกัน
                $this->session->set_flashdata('password_mismatch', TRUE);
                redirect('Member_backend/edit/' . $m_id);
                return;
            }
        }
        $this->db->where('m_id', $m_id);
        $this->db->update('tbl_member', $data);

        // ตรวจสอบ session สำหรับสมาชิกที่เข้าสู่ระบบ
        $current_member_data = $this->db->get_where('tbl_member', array('m_id' => $m_id))->row();

        if (
            $current_member_data->m_id == $this->session->userdata('m_id') &&
            $current_member_data->m_fname == $this->session->userdata('m_fname') &&
            $current_member_data->m_img == $this->session->userdata('m_img')
        ) {
            // ไม่ต้องทำอะไรเพราะข้อมูล session ปัจจุบันตรงกับฐานข้อมูล
        } else {
            // ทำการอัพเดต session หลังจากอัพเดตข้อมูลในฐานข้อมูล
            $updated_member_data = array(
                'm_id' => $current_member_data->m_id,
                'm_fname' => $current_member_data->m_fname,
                'm_img' => $current_member_data->m_img,
            );
            $this->session->set_userdata($updated_member_data);
        }
        // ลบถึงตรงนี้ 

        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }

    // public function editmemberpwd()
    // {

    //     $data = array(
    //         'm_password' => sha1($this->input->post('m_password'))
    //     );

    //     $this->db->where('m_id', $this->input->post('m_id'));
    //     $query = $this->db->update('tbl_member', $data);

    //     if ($query) {
    //         echo "<script>";
    //         echo "alert('Update success !');";
    //         echo "</script>";
    //     } else {
    //         echo "<script>";
    //         echo "alert('Error !');";
    //         echo "</script>";
    //     }
    // }


    public function deldata($m_id)
    {
        $this->db->delete('tbl_member', array('m_id' => $m_id));
    }

    public function fetch_user_login($m_username, $m_password)
    {
        $this->db->where('m_username', $m_username);
        $this->db->where('m_password', $m_password);
        $query = $this->db->get('tbl_member');
        return $query->row();
    }

    public function blockMember($m_id)
    {
        $data = array(
            'm_status' => 0,
        );

        $this->db->where('m_id', $m_id);
        $query = $this->db->update('tbl_member', $data);

        return $query;
    }
    public function unblockMember($m_id)
    {
        $data = array(
            'm_status' => 1,
        );

        $this->db->where('m_id', $m_id);
        $query = $this->db->update('tbl_member', $data);

        return $query;
    }

    public function count_member()
    {
        $this->db->select('COUNT(m_id) as member_total');
        $this->db->from('tbl_member');
        $query = $this->db->get();
        return $query->result();
    }

    public function count_members_ref_pid_3()
    {
        // กำหนดเงื่อนไข WHERE
        $this->db->where('ref_pid', 3);
        // ดึงข้อมูลจากตาราง tbl_member
        $query = $this->db->get('tbl_member');
        // คืนค่าจำนวนแถวที่ตรงกับเงื่อนไข
        return $query->num_rows();
    }
    public function count_members_ref_pid_4()
    {
        // กำหนดเงื่อนไข WHERE
        $this->db->where('ref_pid', 4);
        // ดึงข้อมูลจากตาราง tbl_member
        $query = $this->db->get('tbl_member');
        // คืนค่าจำนวนแถวที่ตรงกับเงื่อนไข
        return $query->num_rows();
    }
    public function count_members_ref_pid_5()
    {
        // กำหนดเงื่อนไข WHERE
        $this->db->where('ref_pid', 5);
        // ดึงข้อมูลจากตาราง tbl_member
        $query = $this->db->get('tbl_member');
        // คืนค่าจำนวนแถวที่ตรงกับเงื่อนไข
        return $query->num_rows();
    }
    public function count_members_ref_pid_6()
    {
        // กำหนดเงื่อนไข WHERE
        $this->db->where('ref_pid', 6);
        // ดึงข้อมูลจากตาราง tbl_member
        $query = $this->db->get('tbl_member');
        // คืนค่าจำนวนแถวที่ตรงกับเงื่อนไข
        return $query->num_rows();
    }
    public function count_members_ref_pid_7()
    {
        // กำหนดเงื่อนไข WHERE
        $this->db->where('ref_pid', 7);
        // ดึงข้อมูลจากตาราง tbl_member
        $query = $this->db->get('tbl_member');
        // คืนค่าจำนวนแถวที่ตรงกับเงื่อนไข
        return $query->num_rows();
    }
    public function count_members_ref_pid_8()
    {
        // กำหนดเงื่อนไข WHERE
        $this->db->where('ref_pid', 8);
        // ดึงข้อมูลจากตาราง tbl_member
        $query = $this->db->get('tbl_member');
        // คืนค่าจำนวนแถวที่ตรงกับเงื่อนไข
        return $query->num_rows();
    }
    public function count_members_ref_pid_9()
    {
        // กำหนดเงื่อนไข WHERE
        $this->db->where('ref_pid', 9);
        // ดึงข้อมูลจากตาราง tbl_member
        $query = $this->db->get('tbl_member');
        // คืนค่าจำนวนแถวที่ตรงกับเงื่อนไข
        return $query->num_rows();
    }
    public function count_members_ref_pid_10()
    {
        // กำหนดเงื่อนไข WHERE
        $this->db->where('ref_pid', 10);
        // ดึงข้อมูลจากตาราง tbl_member
        $query = $this->db->get('tbl_member');
        // คืนค่าจำนวนแถวที่ตรงกับเงื่อนไข
        return $query->num_rows();
    }
    public function count_members_ref_pid_11()
    {
        // กำหนดเงื่อนไข WHERE
        $this->db->where('ref_pid', 11);
        // ดึงข้อมูลจากตาราง tbl_member
        $query = $this->db->get('tbl_member');
        // คืนค่าจำนวนแถวที่ตรงกับเงื่อนไข
        return $query->num_rows();
    }
}
