<?php
class Travel_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    public function add_Travel()
    {
        // Check used space
        $used_space_mb = $this->space_model->get_used_space();
        $upload_limit_mb = $this->space_model->get_limit_storage();

        $total_space_required = 0;
        $travel_imgs = $_FILES['travel_imgs'];

        foreach ($travel_imgs['size'] as $size) {
            $total_space_required += $size;
        }

        // Check if there's enough space
        if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('travel/adding_Travel');
            return;
        }

        $travel_data = array(
            'travel_name' => $this->input->post('travel_name'),
            'travel_refer' => $this->input->post('travel_refer'),
            'travel_detail' => $this->input->post('travel_detail'),
            'travel_location' => $this->input->post('travel_location'),
            'travel_timeopen' => $this->input->post('travel_timeopen'),
            'travel_timeclose' => $this->input->post('travel_timeclose'),
            'travel_day' => $this->input->post('travel_day'),
            'travel_date' => $this->input->post('travel_date'),
            'travel_phone' => $this->input->post('travel_phone'),
            'travel_youtube' => $this->input->post('travel_youtube'),
            'travel_lat' => $this->input->post('travel_lat'),
            'travel_long' => $this->input->post('travel_long'),
            'travel_by' => $this->session->userdata('m_fname') // เพิ่มชื่อคนที่แก้ไขข้อมูล
        );

        $config['upload_path'] = './docs/img';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);

        $travel_img = $_FILES['travel_img'];
        $travel_imgs = $_FILES['travel_imgs'];

        $this->db->trans_start();
        $this->db->insert('tbl_travel', $travel_data);
        $travel_id = $this->db->insert_id();

        // Upload and update travel_img
        $_FILES['travel_img']['name'] = $travel_img['name'];
        $_FILES['travel_img']['type'] = $travel_img['type'];
        $_FILES['travel_img']['tmp_name'] = $travel_img['tmp_name'];
        $_FILES['travel_img']['error'] = $travel_img['error'];
        $_FILES['travel_img']['size'] = $travel_img['size'];

        if (!$this->upload->do_upload('travel_img')) {
            $this->session->set_flashdata('save_maxsize', TRUE);
            redirect('travel/adding_Travel'); // กลับไปหน้าเดิม
            return;
        }

        $upload_data = $this->upload->data();
        $travel_img_file = $upload_data['file_name'];

        // Update travel_img column with the uploaded image
        $travel_img_data = array('travel_img' => $travel_img_file);
        $this->db->where('travel_id', $travel_id);
        $this->db->update('tbl_travel', $travel_img_data);

        // Upload and insert data into tbl_travel_img
        $image_data = array(); // Initialize the array
        foreach ($travel_imgs['name'] as $index => $name) {
            $_FILES['travel_img']['name'] = $name;
            $_FILES['travel_img']['type'] = $travel_imgs['type'][$index];
            $_FILES['travel_img']['tmp_name'] = $travel_imgs['tmp_name'][$index];
            $_FILES['travel_img']['error'] = $travel_imgs['error'][$index];
            $_FILES['travel_img']['size'] = $travel_imgs['size'][$index];

            if (!$this->upload->do_upload('travel_img')) {
                $this->session->set_flashdata('save_maxsize', TRUE);
                redirect('travel/adding_Travel'); // กลับไปหน้าเดิม
                return;
            }

            $upload_data = $this->upload->data();
            $image_data[] = array(
                'travel_img_ref_id' => $travel_id,
                'travel_img_img' => $upload_data['file_name']
            );
        }

        $this->db->insert_batch('tbl_travel_img', $image_data);

        $this->db->trans_complete();

        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }

    public function list_admin()
    {
        $this->db->select('t.*, GROUP_CONCAT(ti.travel_img_img) as additional_images');
        $this->db->from('tbl_travel as t');
        $this->db->join('tbl_travel_img as ti', 't.travel_id = ti.travel_img_ref_id', 'left');
        $this->db->group_by('t.travel_id');
        $this->db->order_by('t.travel_id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function list_user()
    {
        $this->db->select('t.*, GROUP_CONCAT(ti.user_travel_img_img) as additional_images');
        $this->db->from('tbl_user_travel as t');
        $this->db->join('tbl_user_travel_img as ti', 't.user_travel_id = ti.user_travel_img_ref_id', 'left');
        $this->db->group_by('t.user_travel_id');
        $this->db->order_by('t.user_travel_id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    //show form edit
    public function read_travel($travel_id)
    {
        $this->db->where('travel_id', $travel_id);
        $query = $this->db->get('tbl_travel');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function read_com_travel($travel_id)
    {
        $this->db->where('travel_com_ref_id', $travel_id);
        $this->db->order_by('travel_com_ref_id', 'DESC');
        $query = $this->db->get('tbl_travel_com');
        return $query->result();
    }

    public function read_com_reply_travel($travel_com_id)
    {
        $this->db->where('travel_com_reply_ref_id', $travel_com_id);
        $query = $this->db->get('tbl_travel_com_reply');
        return $query->result();
    }

    public function read_img_travel($travel_id)
    {
        $this->db->where('travel_img_ref_id', $travel_id);
        $this->db->order_by('travel_img_id', 'DESC');
        $query = $this->db->get('tbl_travel_img');
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

    public function edit_Travel($travel_id)
    {
        $old_document = $this->db->get_where('tbl_travel', array('travel_id' => $travel_id))->row();

        $update_doc_file = !empty($_FILES['travel_img']['name']) && $old_document->travel_img != $_FILES['travel_img']['name'];

        // ตรวจสอบว่ามีการอัพโหลดรูปภาพใหม่หรือไม่
        if ($update_doc_file) {
            $old_file_path = './docs/img/' . $old_document->travel_img;
            if (file_exists($old_file_path)) {
                unlink($old_file_path);
            }

            // Check used space
            $used_space_mb = $this->space_model->get_used_space();
            $upload_limit_mb = $this->space_model->get_limit_storage();

            $total_space_required = 0;
            if (!empty($_FILES['travel_img']['name'])) {
                $total_space_required += $_FILES['travel_img']['size'];
            }

            if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
                $this->session->set_flashdata('save_error', TRUE);
                redirect('travel/editing_Travel');
                return;
            }

            $config['upload_path'] = './docs/img';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('travel_img')) {
                echo $this->upload->display_errors();
                return;
            }

            $data = $this->upload->data();
            $filename = $data['file_name'];
        } else {
            // ใช้รูปภาพเดิม
            $filename = $old_document->travel_img;
        }

        // Update travel information
        $data = array(
            'travel_name' => $this->input->post('travel_name'),
            'travel_refer' => $this->input->post('travel_refer'),
            'travel_detail' => $this->input->post('travel_detail'),
            'travel_location' => $this->input->post('travel_location'),
            'travel_timeopen' => $this->input->post('travel_timeopen'),
            'travel_timeclose' => $this->input->post('travel_timeclose'),
            'travel_day' => $this->input->post('travel_day'),
            'travel_date' => $this->input->post('travel_date'),
            'travel_phone' => $this->input->post('travel_phone'),
            'travel_youtube' => $this->input->post('travel_youtube'),
            'travel_lat' => $this->input->post('travel_lat'),
            'travel_long' => $this->input->post('travel_long'),
            'travel_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
            'travel_img' => $filename
        );

        $this->db->where('travel_id', $travel_id);
        $this->db->update('tbl_travel', $data);

        // อัปโหลดและบันทึกไฟล์ใหม่ลงโฟลเดอร์
        if (!empty($_FILES['travel_img_img']['name'])) {
            $upload_config['upload_path'] = './docs/img';
            $upload_config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $upload_config);

            $upload_success = true; // ตั้งค่าเริ่มต้นเป็น true

            foreach ($_FILES['travel_img_img']['name'] as $index => $name) {
                $_FILES['travel_img']['name'] = $name;
                $_FILES['travel_img']['type'] = $_FILES['travel_img_img']['type'][$index];
                $_FILES['travel_img']['tmp_name'] = $_FILES['travel_img_img']['tmp_name'][$index];
                $_FILES['travel_img']['error'] = $_FILES['travel_img_img']['error'][$index];
                $_FILES['travel_img']['size'] = $_FILES['travel_img_img']['size'][$index];

                if (!$this->upload->do_upload('travel_img')) {
                    // echo $this->upload->display_errors();
                    $upload_success = false; // หากเกิดข้อผิดพลาดในการอัปโหลด ตั้งค่าเป็น false
                    break; // หยุดการทำงานลูป
                }

                $upload_data = $this->upload->data();
                $image_path = $upload_data['file_name'];

                // สร้างข้อมูลสำหรับบันทึกลงฐานข้อมูล tbl_activity_img
                $image_data = array(
                    'travel_img_ref_id' => $travel_id,
                    'travel_img_img' => $image_path
                );

                $this->db->insert('tbl_travel_img', $image_data);
            }

            if ($upload_success) {
                // ลบรูปภาพเก่าที่เกี่ยวข้องกับกิจกรรม
                $this->db->where('travel_img_ref_id', $travel_id);
                $existing_images = $this->db->get('tbl_travel_img')->result();

                foreach ($existing_images as $existing_image) {
                    $old_file_path = './docs/img/' . $existing_image->travel_img_img;
                    if (file_exists($old_file_path)) {
                        unlink($old_file_path);
                    }
                }

                $this->db->where('travel_img_ref_id', $travel_id);
                $this->db->delete('tbl_travel_img');

                // เพิ่มรูปภาพใหม่ลงไป
                foreach ($_FILES['travel_img_img']['name'] as $index => $name) {
                    $_FILES['travel_img']['name'] = $name;
                    $_FILES['travel_img']['type'] = $_FILES['travel_img_img']['type'][$index];
                    $_FILES['travel_img']['tmp_name'] = $_FILES['travel_img_img']['tmp_name'][$index];
                    $_FILES['travel_img']['error'] = $_FILES['travel_img_img']['error'][$index];
                    $_FILES['travel_img']['size'] = $_FILES['travel_img_img']['size'][$index];

                    if (!$this->upload->do_upload('travel_img')) {
                        // echo $this->upload->display_errors();
                        break; // หยุดการทำงานลูปหากรูปภาพมีปัญหา
                    }

                    $upload_data = $this->upload->data();
                    $image_path = $upload_data['file_name'];

                    // สร้างข้อมูลสำหรับบันทึกลงฐานข้อมูล tbl_activity_img
                    $image_data = array(
                        'travel_img_ref_id' => $travel_id,
                        'travel_img_img' => $image_path
                    );

                    $this->db->insert('tbl_travel_img', $image_data);
                }
                $this->space_model->update_server_current();
            }
        }
        $this->session->set_flashdata('save_success', TRUE);
    }

    public function del_travel($travel_id)
    {
        $old_document = $this->db->get_where('tbl_travel', array('travel_id' => $travel_id))->row();

        $old_file_path = './docs/img/' . $old_document->travel_img;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_travel', array('travel_id' => $travel_id));
        $this->space_model->update_server_current();
    }

    public function del_travel_img($travel_id)
    {
        // ดึงข้อมูลรายการรูปภาพก่อน
        $images = $this->db->get_where('tbl_travel_img', array('travel_img_ref_id' => $travel_id))->result();

        // ลบรูปภาพจากตาราง tbl_activity_img
        $this->db->where('travel_img_ref_id', $travel_id);
        $this->db->delete('tbl_travel_img');

        // ลบไฟล์รูปภาพที่เกี่ยวข้อง
        foreach ($images as $image) {
            $image_path = './docs/img/' . $image->travel_img_img;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
    }

    public function updateTravelStatus()
    {
        // ตรวจสอบว่ามีการส่งข้อมูล POST มาหรือไม่
        if ($this->input->post()) {
            $travelId = $this->input->post('travel_id'); // รับค่า travel_id
            $newStatus = $this->input->post('new_status'); // รับค่าใหม่จาก switch checkbox

            // ทำการอัพเดตค่าในตาราง tbl_travel ในฐานข้อมูลของคุณ
            $data = array(
                'travel_status' => $newStatus
            );
            $this->db->where('travel_id', $travelId); // ระบุ travel_id ของแถวที่ต้องการอัพเดต
            $this->db->update('tbl_travel', $data);

            // ส่งการตอบกลับ (response) กลับไปยังเว็บไซต์หรือแอพพลิเคชันของคุณ
            // โดยเช่นปกติคุณอาจส่ง JSON response กลับมาเพื่ออัพเดตหน้าเว็บ
            $response = array('status' => 'success', 'message' => 'อัพเดตสถานะเรียบร้อย');
            echo json_encode($response);
        } else {
            // ถ้าไม่มีข้อมูล POST ส่งมา ให้รีเดอร์เปรียบเสมอ
            show_404();
        }
    }


    public function del_com($travel_com_id)
    {
        return $this->db->where('travel_com_id', $travel_com_id)->delete('tbl_travel_com');
    }

    public function del_reply($travel_com_id)
    {
        return $this->db->where('travel_com_reply_ref_id', $travel_com_id)->delete('tbl_travel_com_reply');
    }

    public function del_com_reply($travel_com_reply_id)
    {
        return $this->db->where('travel_com_reply_id', $travel_com_reply_id)->delete('tbl_travel_com_reply');
    }

    // ส่วนของ user ***************************************************************************************************************************************************************************************************************************************************************
    public function read_user_travel($user_travel_id)
    {
        $this->db->where('user_travel_id', $user_travel_id);
        $query = $this->db->get('tbl_user_travel');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function read_user_com_travel($user_travel_id)
    {
        $this->db->where('user_travel_com_ref_id', $user_travel_id);
        $this->db->order_by('user_travel_com_ref_id', 'DESC');
        $query = $this->db->get('tbl_user_travel_com');
        return $query->result();
    }

    public function read_user_com_reply_travel($user_travel_com_id)
    {
        $this->db->where('user_travel_com_reply_ref_id', $user_travel_com_id);
        $query = $this->db->get('tbl_user_travel_com_reply');
        return $query->result();
    }

    public function read_img_user_travel($user_travel_id)
    {
        $this->db->where('user_travel_img_ref_id', $user_travel_id);
        $this->db->order_by('user_travel_img_id', 'DESC');
        $query = $this->db->get('tbl_user_travel_img');
        return $query->result();
    }

    public function edit_User_Travel($user_travel_id)
    {
        $old_document = $this->db->get_where('tbl_user_travel', array('user_travel_id' => $user_travel_id))->row();

        $update_doc_file = !empty($_FILES['user_travel_img']['name']) && $old_document->user_travel_img != $_FILES['user_travel_img']['name'];

        // ตรวจสอบว่ามีการอัพโหลดรูปภาพใหม่หรือไม่
        if ($update_doc_file) {
            $old_file_path = './docs/img/' . $old_document->user_travel_img;
            if (file_exists($old_file_path)) {
                unlink($old_file_path);
            }

            // Check used space
            $used_space_mb = $this->space_model->get_used_space();
            $upload_limit_mb = $this->space_model->get_limit_storage();

            $total_space_required = 0;
            if (!empty($_FILES['user_travel_img']['name'])) {
                $total_space_required += $_FILES['user_travel_img']['size'];
            }

            if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
                $this->session->set_flashdata('save_error', TRUE);
                redirect('travel/editing_User_Travel');
                return;
            }

            $config['upload_path'] = './docs/img';
            $config['allowed_types'] = 'gif|jpg|png';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('user_travel_img')) {
                echo $this->upload->display_errors();
                return;
            }

            $data = $this->upload->data();
            $filename = $data['file_name'];
        } else {
            // ใช้รูปภาพเดิม
            $filename = $old_document->user_travel_img;
        }

        // Update user_travel information
        $data = array(
            'user_travel_name' => $this->input->post('user_travel_name'),
            'user_travel_refer' => $this->input->post('user_travel_refer'),
            'user_travel_detail' => $this->input->post('user_travel_detail'),
            'user_travel_location' => $this->input->post('user_travel_location'),
            'user_travel_timeopen' => $this->input->post('user_travel_timeopen'),
            'user_travel_timeclose' => $this->input->post('user_travel_timeclose'),
            'user_travel_date' => $this->input->post('user_travel_date'),
            'user_travel_phone' => $this->input->post('user_travel_phone'),
            'user_travel_youtube' => $this->input->post('user_travel_youtube'),
            'user_travel_lat' => $this->input->post('user_travel_lat'),
            'user_travel_long' => $this->input->post('user_travel_long'),
            'user_travel_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
            'user_travel_img' => $filename
        );

        $this->db->where('user_travel_id', $user_travel_id);
        $this->db->update('tbl_user_travel', $data);

        // อัปโหลดและบันทึกไฟล์ใหม่ลงโฟลเดอร์
        if (!empty($_FILES['user_travel_img_img']['name'])) {
            $upload_config['upload_path'] = './docs/img';
            $upload_config['allowed_types'] = 'gif|jpg|png';
            $this->load->library('upload', $upload_config);

            $upload_success = true; // ตั้งค่าเริ่มต้นเป็น true

            foreach ($_FILES['user_travel_img_img']['name'] as $index => $name) {
                $_FILES['user_travel_img']['name'] = $name;
                $_FILES['user_travel_img']['type'] = $_FILES['user_travel_img_img']['type'][$index];
                $_FILES['user_travel_img']['tmp_name'] = $_FILES['user_travel_img_img']['tmp_name'][$index];
                $_FILES['user_travel_img']['error'] = $_FILES['user_travel_img_img']['error'][$index];
                $_FILES['user_travel_img']['size'] = $_FILES['user_travel_img_img']['size'][$index];

                if (!$this->upload->do_upload('user_travel_img')) {
                    // echo $this->upload->display_errors();
                    $upload_success = false; // หากเกิดข้อผิดพลาดในการอัปโหลด ตั้งค่าเป็น false
                    break; // หยุดการทำงานลูป
                }

                $upload_data = $this->upload->data();
                $image_path = $upload_data['file_name'];

                // สร้างข้อมูลสำหรับบันทึกลงฐานข้อมูล tbl_activity_img
                $image_data = array(
                    'user_travel_img_ref_id' => $user_travel_id,
                    'user_travel_img_img' => $image_path
                );

                $this->db->insert('tbl_user_travel_img', $image_data);
            }

            if ($upload_success) {
                // ลบรูปภาพเก่าที่เกี่ยวข้องกับกิจกรรม
                $this->db->where('user_travel_img_ref_id', $user_travel_id);
                $existing_images = $this->db->get('tbl_user_travel_img')->result();

                foreach ($existing_images as $existing_image) {
                    $old_file_path = './docs/img/' . $existing_image->user_travel_img_img;
                    if (file_exists($old_file_path)) {
                        unlink($old_file_path);
                    }
                }

                $this->db->where('user_travel_img_ref_id', $user_travel_id);
                $this->db->delete('tbl_user_travel_img');

                // เพิ่มรูปภาพใหม่ลงไป
                foreach ($_FILES['user_travel_img_img']['name'] as $index => $name) {
                    $_FILES['user_travel_img']['name'] = $name;
                    $_FILES['user_travel_img']['type'] = $_FILES['user_travel_img_img']['type'][$index];
                    $_FILES['user_travel_img']['tmp_name'] = $_FILES['user_travel_img_img']['tmp_name'][$index];
                    $_FILES['user_travel_img']['error'] = $_FILES['user_travel_img_img']['error'][$index];
                    $_FILES['user_travel_img']['size'] = $_FILES['user_travel_img_img']['size'][$index];

                    if (!$this->upload->do_upload('user_travel_img')) {
                        // echo $this->upload->display_errors();
                        break; // หยุดการทำงานลูปหากรูปภาพมีปัญหา
                    }

                    $upload_data = $this->upload->data();
                    $image_path = $upload_data['file_name'];

                    // สร้างข้อมูลสำหรับบันทึกลงฐานข้อมูล tbl_activity_img
                    $image_data = array(
                        'user_travel_img_ref_id' => $user_travel_id,
                        'user_travel_img_img' => $image_path
                    );

                    $this->db->insert('tbl_user_travel_img', $image_data);
                }
            }
        }
        $this->space_model->update_server_current();

        $this->session->set_flashdata('save_success', TRUE);
    }

    public function del_user_travel($user_travel_id)
    {
        $old_document = $this->db->get_where('tbl_user_travel', array('user_travel_id' => $user_travel_id))->row();

        $old_file_path = './docs/img/' . $old_document->user_travel_img;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_user_travel', array('user_travel_id' => $user_travel_id));
        $this->space_model->update_server_current();
    }

    public function del_user_travel_img($user_travel_id)
    {
        // ดึงข้อมูลรายการรูปภาพก่อน
        $images = $this->db->get_where('tbl_user_travel_img', array('user_travel_img_ref_id' => $user_travel_id))->result();

        // ลบรูปภาพจากตาราง tbl_activity_img
        $this->db->where('user_travel_img_ref_id', $user_travel_id);
        $this->db->delete('tbl_user_travel_img');

        // ลบไฟล์รูปภาพที่เกี่ยวข้อง
        foreach ($images as $image) {
            $image_path = './docs/img/' . $image->user_travel_img_img;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
    }

    public function updateUserTravelStatus()
    {
        // ตรวจสอบว่ามีการส่งข้อมูล POST มาหรือไม่
        if ($this->input->post()) {
            $usertravelId = $this->input->post('user_travel_id'); // รับค่า travel_id
            $newStatus = $this->input->post('new_status'); // รับค่าใหม่จาก switch checkbox

            // ทำการอัพเดตค่าในตาราง tbl_travel ในฐานข้อมูลของคุณ
            $data = array(
                'user_travel_status' => $newStatus
            );
            $this->db->where('user_travel_id', $usertravelId); // ระบุ travel_id ของแถวที่ต้องการอัพเดต
            $this->db->update('tbl_user_travel', $data);

            // ส่งการตอบกลับ (response) กลับไปยังเว็บไซต์หรือแอพพลิเคชันของคุณ
            // โดยเช่นปกติคุณอาจส่ง JSON response กลับมาเพื่ออัพเดตหน้าเว็บ
            $response = array('status' => 'success', 'message' => 'อัพเดตสถานะเรียบร้อย');
            echo json_encode($response);
        } else {
            // ถ้าไม่มีข้อมูล POST ส่งมา ให้รีเดอร์เปรียบเสมอ
            show_404();
        }
    }

    public function del_com_user($user_travel_com_id)
    {
        return $this->db->where('user_travel_com_id', $user_travel_com_id)->delete('tbl_user_travel_com');
    }

    public function del_reply_user($user_travel_com_id)
    {
        return $this->db->where('user_travel_com_reply_ref_id', $user_travel_com_id)->delete('tbl_user_travel_com_reply');
    }

    public function del_com_reply_user($user_travel_com_reply_id)
    {
        return $this->db->where('user_travel_com_reply_id', $user_travel_com_reply_id)->delete('tbl_user_travel_com_reply');
    }

    // ******************************************************************************************************************************

    public function sum_travel_views()
    {
        // คำนวณผลรวมของ tbl_travel
        $this->db->select('SUM(travel_view) as total_views');
        $this->db->from('tbl_travel');
        $query_travel = $this->db->get();

        // คำนวณผลรวมของ tbl_user_travel
        $this->db->select('SUM(user_travel_view) as total_user_views');
        $this->db->from('tbl_user_travel');
        $query_user_travel = $this->db->get();

        // นำผลรวมของทั้งสองตารางมาบวกกัน
        $total_views = $query_travel->row()->total_views + $query_user_travel->row()->total_user_views;

        return $total_views;
    }

    public function sum_travel_likes()
    {
        // คำนวณผลรวมของ tbl_travel
        $this->db->select('SUM(travel_like_like) as total_likes');
        $this->db->from('tbl_travel_like');
        $query_travel = $this->db->get();

        // คำนวณผลรวมของ tbl_user_travel
        $this->db->select('SUM(user_travel_like_like) as total_user_likes');
        $this->db->from('tbl_user_travel_like');
        $query_user_travel = $this->db->get();

        // นำผลรวมของทั้งสองตารางมาบวกกัน
        $total_likes = $query_travel->row()->total_likes + $query_user_travel->row()->total_user_likes;

        return $total_likes;
    }

    public function travel_frontend()
    {
        $this->db->select('*');
        $this->db->from('tbl_travel');
        $this->db->where('tbl_travel.travel_status', 'show');
        $this->db->order_by('travel_id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function read_img_travel_font($travel_id)
    {
        $this->db->where('travel_img_ref_id', $travel_id);
        $this->db->order_by('travel_img_id', 'DESC');
        // $this->db->limit(4); // จำกัดจำนวนรูปเป็น 4 รูป
        $query = $this->db->get('tbl_travel_img');
        return $query->result();
    }

    public function increment_travel_view($travel_id)
    {
        $this->db->where('travel_id', $travel_id);
        $this->db->set('travel_view', 'travel_view + 1', false); // บวกค่า travel_view ทีละ 1
        $this->db->update('tbl_travel');
    }
}
