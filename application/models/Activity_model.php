<?php
class Activity_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    public function add_Activity()
    {
        // Check used space
        $used_space_mb = $this->space_model->get_used_space();
        $upload_limit_mb = $this->space_model->get_limit_storage();

        $total_space_required = 0;
        $activity_imgs = $_FILES['activity_imgs'];

        foreach ($activity_imgs['size'] as $size) {
            $total_space_required += $size;
        }

        // Check if there's enough space
        if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('activity/adding_Activity');
            return;
        }

        $activity_data = array(
            'activity_name' => $this->input->post('activity_name'),
            'activity_detail' => $this->input->post('activity_detail'),
            'activity_date' => $this->input->post('activity_date'),
            'activity_refer' => $this->input->post('activity_refer'),
            'activity_by' => $this->session->userdata('m_fname') // เพิ่มชื่อคนที่แก้ไขข้อมูล
        );

        $config['upload_path'] = './docs/img';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);

        $activity_img = $_FILES['activity_img'];
        $activity_imgs = $_FILES['activity_imgs'];

        $this->db->trans_start();
        $this->db->insert('tbl_activity', $activity_data);
        $activity_id = $this->db->insert_id();

        // Upload and update activity_img
        $_FILES['activity_img']['name'] = $activity_img['name'];
        $_FILES['activity_img']['type'] = $activity_img['type'];
        $_FILES['activity_img']['tmp_name'] = $activity_img['tmp_name'];
        $_FILES['activity_img']['error'] = $activity_img['error'];
        $_FILES['activity_img']['size'] = $activity_img['size'];

        // Upload main file
        if (!$this->upload->do_upload('activity_img')) {
            $this->session->set_flashdata('save_maxsize', TRUE);
            redirect('activity/adding_Activity'); // กลับไปหน้าเดิม
            return; // ออกจากฟังก์ชันทันทีเมื่อขนาดเกิน
        }

        $upload_data = $this->upload->data();
        $activity_img_file = $upload_data['file_name'];

        // Update activity_img column with the uploaded image
        $activity_img_data = array('activity_img' => $activity_img_file);
        $this->db->where('activity_id', $activity_id);
        $this->db->update('tbl_activity', $activity_img_data);

        // Upload and insert data into tbl_activity_img
        $image_data = array(); // Initialize the array
        foreach ($activity_imgs['name'] as $index => $name) {
            $_FILES['activity_img']['name'] = $name;
            $_FILES['activity_img']['type'] = $activity_imgs['type'][$index];
            $_FILES['activity_img']['tmp_name'] = $activity_imgs['tmp_name'][$index];
            $_FILES['activity_img']['error'] = $activity_imgs['error'][$index];
            $_FILES['activity_img']['size'] = $activity_imgs['size'][$index];

            if (!$this->upload->do_upload('activity_img')) {
                $this->session->set_flashdata('save_maxsize', TRUE);
                redirect('activity/adding_Activity'); // กลับไปหน้าเดิม
                return;
            }

            $upload_data = $this->upload->data();
            $image_data[] = array(
                'activity_img_ref_id' => $activity_id,
                'activity_img_img' => $upload_data['file_name']
            );
        }

        $this->db->insert_batch('tbl_activity_img', $image_data);

        $this->space_model->update_server_current();

        $this->db->trans_complete();

        $this->session->set_flashdata('save_success', TRUE);
    }

    public function list_admin()
    {
        $this->db->select('a.*, GROUP_CONCAT(ai.activity_img_img) as additional_images');
        $this->db->from('tbl_activity as a');
        $this->db->join('tbl_activity_img as ai', 'a.activity_id = ai.activity_img_ref_id', 'left');
        $this->db->group_by('a.activity_id');
        $this->db->order_by('a.activity_id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // public function list_user()
    // {
    //     $this->db->select('a.*, GROUP_CONCAT(ai.user_activity_img_img) as additional_images');
    //     $this->db->from('tbl_user_activity as a');
    //     $this->db->join('tbl_user_activity_img as ai', 'a.user_activity_id = ai.user_activity_img_ref_id', 'left');
    //     $this->db->group_by('a.user_activity_id');
    //     $this->db->order_by('a.user_activity_id', 'DESC');
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    // public function list_all()
    // {
    //     $this->db->select('a.*, GROUP_CONCAT(ai.activity_img_img) as additional_images');
    //     $this->db->from('tbl_activity as a');
    //     $this->db->join('tbl_activity_img as ai', 'a.activity_id = ai.activity_img_ref_id', 'left');
    //     $this->db->group_by('a.activity_id');
    //     $this->db->order_by('a.activity_id', 'DESC');
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    //show form edit
    public function read_activity($activity_id)
    {
        $this->db->where('activity_id', $activity_id);
        $query = $this->db->get('tbl_activity');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function read_img_activity($activity_id)
    {
        $this->db->where('activity_img_ref_id', $activity_id);
        $this->db->order_by('activity_img_id', 'DESC');
        $query = $this->db->get('tbl_activity_img');
        return $query->result();
    }

    public function read_com_activity($activity_id)
    {
        $this->db->where('activity_com_ref_id', $activity_id);
        $this->db->order_by('activity_com_ref_id', 'DESC');
        $query = $this->db->get('tbl_activity_com');
        return $query->result();
    }

    public function read_com_reply_activity($activity_com_id)
    {
        $this->db->where('activity_com_reply_ref_id', $activity_com_id);
        $query = $this->db->get('tbl_activity_com_reply');
        return $query->result();
    }

    public function get_used_space()
    {
        $upload_folder = './docs'; // ตำแหน่งของโฟลเดอร์ที่คุณต้องการ

        $used_space = $this->calculateFolderSize($upload_folder);

        $used_space_mb = $used_space / (1024 * 1024 * 1024);
        return $used_space_mb;
    }
    private function calculateFolderSize($folder)
    {
        $used_space = 0;
        $files = scandir($folder);
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $path = $folder . '/' . $file;
                if (is_file($path)) {
                    $used_space += filesize($path);
                } elseif (is_dir($path)) {
                    $used_space += $this->calculateFolderSize($path);
                }
            }
        }
        return $used_space;
    }

    public function edit_Activity($activity_id)
    {
        $old_document = $this->db->get_where('tbl_activity', array('activity_id' => $activity_id))->row();

        $update_doc_file = !empty($_FILES['activity_img']['name']) && $old_document->activity_img != $_FILES['activity_img']['name'];

        // ตรวจสอบว่ามีการอัพโหลดรูปภาพใหม่หรือไม่
        if ($update_doc_file) {
            $old_file_path = './docs/img/' . $old_document->activity_img;
            if (file_exists($old_file_path)) {
                unlink($old_file_path);
            }

            // Check used space
            $used_space_mb = $this->space_model->get_used_space();
            $upload_limit_mb = $this->space_model->get_limit_storage();

            $total_space_required = 0;
            if (!empty($_FILES['activity_img']['name'])) {
                $total_space_required += $_FILES['activity_img']['size'];
            }

            if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
                $this->session->set_flashdata('save_error', TRUE);
                redirect('activity/editing_Activity');
                return;
            }

            $config['upload_path'] = './docs/img';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('activity_img')) {
                echo $this->upload->display_errors();
                return;
            }

            $data = $this->upload->data();
            $filename = $data['file_name'];
        } else {
            // ใช้รูปภาพเดิม
            $filename = $old_document->activity_img;
        }

        // Update activity information
        $data = array(
            'activity_name' => $this->input->post('activity_name'),
            'activity_detail' => $this->input->post('activity_detail'),
            'activity_date' => $this->input->post('activity_date'),
            'activity_refer' => $this->input->post('activity_refer'),
            'activity_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
            'activity_img' => $filename
        );

        $this->db->where('activity_id', $activity_id);
        $this->db->update('tbl_activity', $data);

        // อัปโหลดและบันทึกไฟล์ใหม่ลงโฟลเดอร์
        if (!empty($_FILES['activity_img_img']['name'])) {
            $upload_config['upload_path'] = './docs/img';
            $upload_config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $upload_config);

            $upload_success = true; // ตั้งค่าเริ่มต้นเป็น true

            foreach ($_FILES['activity_img_img']['name'] as $index => $name) {
                $_FILES['activity_img']['name'] = $name;
                $_FILES['activity_img']['type'] = $_FILES['activity_img_img']['type'][$index];
                $_FILES['activity_img']['tmp_name'] = $_FILES['activity_img_img']['tmp_name'][$index];
                $_FILES['activity_img']['error'] = $_FILES['activity_img_img']['error'][$index];
                $_FILES['activity_img']['size'] = $_FILES['activity_img_img']['size'][$index];

                if (!$this->upload->do_upload('activity_img')) {
                    // echo $this->upload->display_errors();
                    $upload_success = false; // หากเกิดข้อผิดพลาดในการอัปโหลด ตั้งค่าเป็น false
                    break; // หยุดการทำงานลูป
                }

                $upload_data = $this->upload->data();
                $image_path = $upload_data['file_name'];

                // สร้างข้อมูลสำหรับบันทึกลงฐานข้อมูล tbl_activity_img
                $image_data = array(
                    'activity_img_ref_id' => $activity_id,
                    'activity_img_img' => $image_path
                );

                $this->db->insert('tbl_activity_img', $image_data);
            }

            if ($upload_success) {
                // ลบรูปภาพเก่าที่เกี่ยวข้องกับกิจกรรม
                $this->db->where('activity_img_ref_id', $activity_id);
                $existing_images = $this->db->get('tbl_activity_img')->result();

                foreach ($existing_images as $existing_image) {
                    $old_file_path = './docs/img/' . $existing_image->activity_img_img;
                    if (file_exists($old_file_path)) {
                        unlink($old_file_path);
                    }
                }

                $this->db->where('activity_img_ref_id', $activity_id);
                $this->db->delete('tbl_activity_img');

                // เพิ่มรูปภาพใหม่ลงไป
                foreach ($_FILES['activity_img_img']['name'] as $index => $name) {
                    $_FILES['activity_img']['name'] = $name;
                    $_FILES['activity_img']['type'] = $_FILES['activity_img_img']['type'][$index];
                    $_FILES['activity_img']['tmp_name'] = $_FILES['activity_img_img']['tmp_name'][$index];
                    $_FILES['activity_img']['error'] = $_FILES['activity_img_img']['error'][$index];
                    $_FILES['activity_img']['size'] = $_FILES['activity_img_img']['size'][$index];

                    if (!$this->upload->do_upload('activity_img')) {
                        // echo $this->upload->display_errors();
                        break; // หยุดการทำงานลูปหากรูปภาพมีปัญหา
                    }

                    $upload_data = $this->upload->data();
                    $image_path = $upload_data['file_name'];

                    // สร้างข้อมูลสำหรับบันทึกลงฐานข้อมูล tbl_activity_img
                    $image_data = array(
                        'activity_img_ref_id' => $activity_id,
                        'activity_img_img' => $image_path
                    );

                    $this->db->insert('tbl_activity_img', $image_data);
                }
            }
        }
        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }


    public function del_Activity($activity_id)
    {
        $old_document = $this->db->get_where('tbl_activity', array('activity_id' => $activity_id))->row();

        $old_file_path = './docs/img/' . $old_document->activity_img;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_activity', array('activity_id' => $activity_id));
        $this->space_model->update_server_current();
    }

    public function del_activity_img($activity_id)
    {
        // ดึงข้อมูลรายการรูปภาพก่อน
        $images = $this->db->get_where('tbl_activity_img', array('activity_img_ref_id' => $activity_id))->result();

        // ลบรูปภาพจากตาราง tbl_activity_img
        $this->db->where('activity_img_ref_id', $activity_id);
        $this->db->delete('tbl_activity_img');

        // ลบไฟล์รูปภาพที่เกี่ยวข้อง
        foreach ($images as $image) {
            $image_path = './docs/img/' . $image->activity_img_img;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
    }

    public function updateActivityStatus()
    {
        // ตรวจสอบว่ามีการส่งข้อมูล POST มาหรือไม่
        if ($this->input->post()) {
            $activityId = $this->input->post('activity_id'); // รับค่า activity_id
            $newStatus = $this->input->post('new_status'); // รับค่าใหม่จาก switch checkbox

            // ทำการอัพเดตค่าในตาราง tbl_activity ในฐานข้อมูลของคุณ
            $data = array(
                'activity_status' => $newStatus
            );
            $this->db->where('activity_id', $activityId); // ระบุ activity_id ของแถวที่ต้องการอัพเดต
            $this->db->update('tbl_activity', $data);

            // ส่งการตอบกลับ (response) กลับไปยังเว็บไซต์หรือแอพพลิเคชันของคุณ
            // โดยเช่นปกติคุณอาจส่ง JSON response กลับมาเพื่ออัพเดตหน้าเว็บ
            $response = array('status' => 'success', 'message' => 'อัพเดตสถานะเรียบร้อย');
            echo json_encode($response);
        } else {
            // ถ้าไม่มีข้อมูล POST ส่งมา ให้รีเดอร์เปรียบเสมอ
            show_404();
        }
    }

    public function del_com($activity_com_id)
    {
        return $this->db->where('activity_com_id', $activity_com_id)->delete('tbl_activity_com');
    }

    public function del_reply($activity_com_id)
    {
        return $this->db->where('activity_com_reply_ref_id', $activity_com_id)->delete('tbl_activity_com_reply');
    }

    public function del_com_reply($activity_com_reply_id)
    {
        return $this->db->where('activity_com_reply_id', $activity_com_reply_id)->delete('tbl_activity_com_reply');
    }

    // ส่วนของ user ***************************************************************************************************************************************************************************************************************************************************************
    public function read_user_activity($user_activity_id)
    {
        $this->db->where('user_activity_id', $user_activity_id);
        $query = $this->db->get('tbl_user_activity');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function read_user_img_activity($user_activity_id)
    {
        $this->db->where('user_activity_img_ref_id', $user_activity_id);
        $this->db->order_by('user_activity_img_id', 'DESC');
        $query = $this->db->get('tbl_user_activity_img');
        return $query->result();
    }

    public function read_user_com_activity($user_activity_id)
    {
        $this->db->where('user_activity_com_ref_id', $user_activity_id);
        $this->db->order_by('user_activity_com_ref_id', 'DESC');
        $query = $this->db->get('tbl_user_activity_com');
        return $query->result();
    }

    public function read_user_com_reply_activity($user_activity_com_id)
    {
        $this->db->where('user_activity_com_reply_ref_id', $user_activity_com_id);
        $query = $this->db->get('tbl_user_activity_com_reply');
        return $query->result();
    }

    public function edit_User_Activity($user_activity_id, $user_activity_name, $user_activity_detail, $user_activity_phone)
    {
        $old_document = $this->db->get_where('tbl_user_activity', array('user_activity_id' => $user_activity_id))->row();

        $update_doc_file = !empty($_FILES['user_activity_img']['name']) && $old_document->user_activity_img != $_FILES['user_activity_img']['name'];

        // ตรวจสอบว่ามีการอัพโหลดรูปภาพใหม่หรือไม่
        if ($update_doc_file) {
            $old_file_path = './docs/img/' . $old_document->user_activity_img;
            if (file_exists($old_file_path)) {
                unlink($old_file_path);
            }

            // Check used space
            $used_space_mb = $this->space_model->get_used_space();
            $upload_limit_mb = $this->space_model->get_limit_storage();

            $total_space_required = 0;
            if (!empty($_FILES['user_activity_img']['name'])) {
                $total_space_required += $_FILES['user_activity_img']['size'];
            }

            if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
                $this->session->set_flashdata('save_error', TRUE);
                redirect('activity/editing_User_Activity');
                return;
            }

            $config['upload_path'] = './docs/img';
            $config['allowed_types'] = 'gif|jpg|png';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('user_activity_img')) {
                echo $this->upload->display_errors();
                return;
            }

            $data = $this->upload->data();
            $filename = $data['file_name'];
        } else {
            // ใช้รูปภาพเดิม
            $filename = $old_document->user_activity_img;
        }

        // Update user_activity information
        $data = array(
            'user_activity_name' => $user_activity_name,
            'user_activity_detail' => $user_activity_detail,
            'user_activity_phone' => $user_activity_phone,
            'user_activity_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
            'user_activity_img' => $filename
        );

        $this->db->where('user_activity_id', $user_activity_id);
        $this->db->update('tbl_user_activity', $data);

        // อัปโหลดและบันทึกไฟล์ใหม่ลงโฟลเดอร์
        if (!empty($_FILES['user_activity_img_img']['name'])) {
            $upload_config['upload_path'] = './docs/img';
            $upload_config['allowed_types'] = 'gif|jpg|png';
            $this->load->library('upload', $upload_config);

            $upload_success = true; // ตั้งค่าเริ่มต้นเป็น true

            foreach ($_FILES['user_activity_img_img']['name'] as $index => $name) {
                $_FILES['user_activity_img']['name'] = $name;
                $_FILES['user_activity_img']['type'] = $_FILES['user_activity_img_img']['type'][$index];
                $_FILES['user_activity_img']['tmp_name'] = $_FILES['user_activity_img_img']['tmp_name'][$index];
                $_FILES['user_activity_img']['error'] = $_FILES['user_activity_img_img']['error'][$index];
                $_FILES['user_activity_img']['size'] = $_FILES['user_activity_img_img']['size'][$index];

                if (!$this->upload->do_upload('user_activity_img')) {
                    // echo $this->upload->display_errors();
                    $upload_success = false; // หากเกิดข้อผิดพลาดในการอัปโหลด ตั้งค่าเป็น false
                    break; // หยุดการทำงานลูป
                }

                $upload_data = $this->upload->data();
                $image_path = $upload_data['file_name'];

                // สร้างข้อมูลสำหรับบันทึกลงฐานข้อมูล tbl_user_activity_img
                $image_data = array(
                    'user_activity_img_ref_id' => $user_activity_id,
                    'user_activity_img_img' => $image_path
                );

                $this->db->insert('tbl_user_activity_img', $image_data);
            }

            if ($upload_success) {
                // ลบรูปภาพเก่าที่เกี่ยวข้องกับกิจกรรม
                $this->db->where('user_activity_img_ref_id', $user_activity_id);
                $existing_images = $this->db->get('tbl_user_activity_img')->result();

                foreach ($existing_images as $existing_image) {
                    $old_file_path = './docs/img/' . $existing_image->user_activity_img_img;
                    if (file_exists($old_file_path)) {
                        unlink($old_file_path);
                    }
                }

                $this->db->where('user_activity_img_ref_id', $user_activity_id);
                $this->db->delete('tbl_user_activity_img');

                // เพิ่มรูปภาพใหม่ลงไป
                foreach ($_FILES['user_activity_img_img']['name'] as $index => $name) {
                    $_FILES['user_activity_img']['name'] = $name;
                    $_FILES['user_activity_img']['type'] = $_FILES['user_activity_img_img']['type'][$index];
                    $_FILES['user_activity_img']['tmp_name'] = $_FILES['user_activity_img_img']['tmp_name'][$index];
                    $_FILES['user_activity_img']['error'] = $_FILES['user_activity_img_img']['error'][$index];
                    $_FILES['user_activity_img']['size'] = $_FILES['user_activity_img_img']['size'][$index];

                    if (!$this->upload->do_upload('user_activity_img')) {
                        // echo $this->upload->display_errors();
                        break; // หยุดการทำงานลูปหากรูปภาพมีปัญหา
                    }

                    $upload_data = $this->upload->data();
                    $image_path = $upload_data['file_name'];

                    // สร้างข้อมูลสำหรับบันทึกลงฐานข้อมูล tbl_user_activity_img
                    $image_data = array(
                        'user_activity_img_ref_id' => $user_activity_id,
                        'user_activity_img_img' => $image_path
                    );

                    $this->db->insert('tbl_user_activity_img', $image_data);
                }
            }
        }
        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }

    public function del_user_activity($user_activity_id)
    {
        $old_document = $this->db->get_where('tbl_user_activity', array('user_activity_id' => $user_activity_id))->row();

        $old_file_path = './docs/img/' . $old_document->user_activity_img;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_user_activity', array('user_activity_id' => $user_activity_id));
        $this->space_model->update_server_current();
    }

    public function del_user_activity_img($user_activity_id)
    {
        // ดึงข้อมูลรายการรูปภาพก่อน
        $images = $this->db->get_where('tbl_user_activity_img', array('user_activity_img_ref_id' => $user_activity_id))->result();

        // ลบรูปภาพจากตาราง tbl_user_activity_img
        $this->db->where('user_activity_img_ref_id', $user_activity_id);
        $this->db->delete('tbl_user_activity_img');

        // ลบไฟล์รูปภาพที่เกี่ยวข้อง
        foreach ($images as $image) {
            $image_path = './docs/img/' . $image->user_activity_img_img;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
    }

    public function updateUserActivityStatus()
    {
        // ตรวจสอบว่ามีการส่งข้อมูล POST มาหรือไม่
        if ($this->input->post()) {
            $useractivityId = $this->input->post('user_activity_id'); // รับค่า activity_id
            $newStatus = $this->input->post('new_status'); // รับค่าใหม่จาก switch checkbox

            // ทำการอัพเดตค่าในตาราง tbl_activity ในฐานข้อมูลของคุณ
            $data = array(
                'user_activity_status' => $newStatus
            );
            $this->db->where('user_activity_id', $useractivityId); // ระบุ activity_id ของแถวที่ต้องการอัพเดต
            $this->db->update('tbl_user_activity', $data);

            // ส่งการตอบกลับ (response) กลับไปยังเว็บไซต์หรือแอพพลิเคชันของคุณ
            // โดยเช่นปกติคุณอาจส่ง JSON response กลับมาเพื่ออัพเดตหน้าเว็บ
            $response = array('status' => 'success', 'message' => 'อัพเดตสถานะเรียบร้อย');
            echo json_encode($response);
        } else {
            // ถ้าไม่มีข้อมูล POST ส่งมา ให้รีเดอร์เปรียบเสมอ
            show_404();
        }
    }

    public function del_com_user($user_activity_com_id)
    {
        return $this->db->where('user_activity_com_id', $user_activity_com_id)->delete('tbl_user_activity_com');
    }

    public function del_reply_user($user_activity_com_id)
    {
        return $this->db->where('user_activity_com_reply_ref_id', $user_activity_com_id)->delete('tbl_user_activity_com_reply');
    }

    public function del_com_reply_user($user_activity_com_reply_id)
    {
        return $this->db->where('user_activity_com_reply_id', $user_activity_com_reply_id)->delete('tbl_user_activity_com_reply');
    }

    // ************************************************************************************************************

    public function sum_activity_views()
    {
        // คำนวณผลรวมของ tbl_activity
        $this->db->select('SUM(activity_view) as total_views');
        $this->db->from('tbl_activity');
        $query_activity = $this->db->get();

        // คำนวณผลรวมของ tbl_user_activity
        // $this->db->select('SUM(user_activity_view) as total_user_views');
        // $this->db->from('tbl_user_activity');
        // $query_user_activity = $this->db->get();

        // นำผลรวมของทั้งสองตารางมาบวกกัน
        // $total_views = $query_activity->row()->total_views + $query_user_activity->row()->total_user_views;
        $total_views = $query_activity->row()->total_views;

        return $total_views;
    }

    public function sum_activity_likes()
    {
        // คำนวณผลรวมของ tbl_activity
        $this->db->select('SUM(activity_like_like) as total_likes');
        $this->db->from('tbl_activity_like');
        $query_activity = $this->db->get();

        // คำนวณผลรวมของ tbl_user_activity
        // $this->db->select('SUM(user_activity_like_like) as total_user_likes');
        // $this->db->from('tbl_user_activity_like');
        // $query_user_activity = $this->db->get();

        // นำผลรวมของทั้งสองตารางมาบวกกัน
        // $total_likes = $query_activity->row()->total_likes + $query_user_activity->row()->total_user_likes;
        $total_likes = $query_activity->row()->total_likes;

        return $total_likes;
    }

    public function sum_activity_id()
    {
        // หาวันที่แรกของเดือนปัจจุบัน
        $start_of_current_month = date('Y-m-01');

        // หาวันที่แรกของเดือนถัดไป
        $start_of_next_month = date('Y-m-01', strtotime('+1 month'));

        // คำนวณผลรวมของ tbl_activity ที่มีวันที่อยู่ในเดือนปัจจุบันหรือเดือนถัดไป
        $this->db->select('SUM(activity_id) as total_id');
        $this->db->from('tbl_activity');
        $this->db->where('activity_datesave >=', $start_of_current_month);
        $this->db->where('activity_datesave <', $start_of_next_month);
        $query_activity = $this->db->get();

        // คำนวณผลรวมของ tbl_user_activity ที่มีวันที่อยู่ในเดือนปัจจุบันหรือเดือนถัดไป
        // $this->db->select('SUM(user_activity_id) as total_user_id');
        // $this->db->from('tbl_user_activity');
        // $this->db->where('user_activity_datesave >=', $start_of_current_month);
        // $this->db->where('user_activity_datesave <', $start_of_next_month);
        // $query_user_activity = $this->db->get();

        // นำผลรวมของทั้งสองตารางมาบวกกัน
        // $total_id = $query_activity->row()->total_id + $query_user_activity->row()->total_user_id;
        $total_id = $query_activity->row()->total_id;

        return $total_id;
    }

    public function activity_frontend()
    {
        $this->db->select('*');
        $this->db->from('tbl_activity');
        $this->db->where('tbl_activity.activity_status', 'show');
        $this->db->limit(10);
        $this->db->order_by('tbl_activity.activity_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function activity_frontend_list()
    {
        $this->db->select('*');
        $this->db->from('tbl_activity');
        $this->db->where('tbl_activity.activity_status', 'show');
        $this->db->order_by('tbl_activity.activity_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function read_img_activity_font($activity_id)
    {
        $this->db->where('activity_img_ref_id', $activity_id);
        $this->db->order_by('activity_img_id', 'DESC');
        // $this->db->limit(4); // จำกัดจำนวนรูปเป็น 4 รูป
        $query = $this->db->get('tbl_activity_img');
        return $query->result();
    }

    public function increment_activity_view($activity_id)
    {
        $this->db->where('activity_id', $activity_id);
        $this->db->set('activity_view', 'activity_view + 1', false); // บวกค่า activity_view ทีละ 1
        $this->db->update('tbl_activity');
    }
}
