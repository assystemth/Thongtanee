<?php
class Form_esv_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    public function add()
    {
        // Check used space
        $used_space_mb = $this->space_model->get_used_space();
        $upload_limit_mb = $this->space_model->get_limit_storage();

        // Calculate the total space required for all files
        $total_space_required = 0;
        if (!empty($_FILES['form_esv_file']['name'])) {
            $total_space_required += $_FILES['form_esv_file']['size'];
        }

        // Check if there's enough space
        if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('form_esv/adding_form_esv');
            return;
        }

        // Upload configuration
        $config['upload_path'] = './docs/file';
        $config['allowed_types'] = 'pdf';
        $this->load->library('upload', $config);

        // Upload main file
        if (!$this->upload->do_upload('form_esv_file')) {
            // If the file size exceeds the max_size, set flash data and redirect
            $this->session->set_flashdata('save_maxsize', TRUE);
            redirect('form_esv/adding_form_esv');
            return;
        }

        $data = $this->upload->data();
        $filename = $data['file_name'];

        $data = array(
            'form_esv_by' => $this->session->userdata('m_fname'),
            'form_esv_file' => $filename
        );

        $query = $this->db->insert('tbl_form_esv', $data);

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
        $this->db->order_by('form_esv_id', 'asc');
        $query = $this->db->get('tbl_form_esv');
        return $query->result();
    }

    //show form edit
    public function read($form_esv_id)
    {
        $this->db->where('form_esv_id', $form_esv_id);
        $query = $this->db->get('tbl_form_esv');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function edit($form_esv_id)
    {
        $old_document = $this->db->get_where('tbl_form_esv', array('form_esv_id' => $form_esv_id))->row();

        $update_doc_file = !empty($_FILES['form_esv_file']['name']) && $old_document->form_esv_file != $_FILES['form_esv_file']['name'];

        // ตรวจสอบว่ามีการอัพโหลดรูปภาพใหม่หรือไม่
        if ($update_doc_file) {
            $old_file_path = './docs/file/' . $old_document->form_esv_file;
            if (file_exists($old_file_path)) {
                unlink($old_file_path);
            }

            // Check used space
            $used_space_mb = $this->space_model->get_used_space();
            $upload_limit_mb = $this->space_model->get_limit_storage();

            $total_space_required = 0;
            if (!empty($_FILES['form_esv_file']['name'])) {
                $total_space_required += $_FILES['form_esv_file']['size'];
            }

            if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
                $this->session->set_flashdata('save_error', TRUE);
                redirect('form_esv/editing_form_esv');
                return;
            }

            $config['upload_path'] = './docs/file';
            $config['allowed_types'] = 'pdf';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('form_esv_file')) {
                echo $this->upload->display_errors();
                return;
            }

            $data = $this->upload->data();
            $filename = $data['file_name'];
        } else {
            // ใช้รูปภาพเดิม
            $filename = $old_document->form_esv_file;
        }

        $data = array(
            'form_esv_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่เพิ่มข้อมูล
            'form_esv_file' => $filename
        );

        $this->db->where('form_esv_id', $form_esv_id);
        $query = $this->db->update('tbl_form_esv', $data);

        $this->space_model->update_server_current();


        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล !');";
            echo "</script>";
        }
    }

    public function del_form_esv($form_esv_id)
    {
        $old_document = $this->db->get_where('tbl_form_esv', array('form_esv_id' => $form_esv_id))->row();

        $old_file_path = './docs/file/' . $old_document->form_esv_file;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_form_esv', array('form_esv_id' => $form_esv_id));
    }

    public function updateform_esvStatus()
    {
        // ตรวจสอบว่ามีการส่งข้อมูล POST มาหรือไม่
        if ($this->input->post()) {
            $form_esvId = $this->input->post('form_esv_id'); // รับค่า form_esv_id
            $newStatus = $this->input->post('new_status'); // รับค่าใหม่จาก switch checkbox

            // ทำการอัพเดตค่าในตาราง tbl_form_esv ในฐานข้อมูลของคุณ
            $data = array(
                'form_esv_status' => $newStatus
            );
            $this->db->where('form_esv_id', $form_esvId); // ระบุ form_esv_id ของแถวที่ต้องการอัพเดต
            $this->db->update('tbl_form_esv', $data);

            // ส่งการตอบกลับ (response) กลับไปยังเว็บไซต์หรือแอพพลิเคชันของคุณ
            // โดยเช่นปกติคุณอาจส่ง JSON response กลับมาเพื่ออัพเดตหน้าเว็บ
            $response = array('status' => 'success', 'message' => 'อัพเดตสถานะเรียบร้อย');
            echo json_encode($response);
        } else {
            // ถ้าไม่มีข้อมูล POST ส่งมา ให้รีเดอร์เปรียบเสมอ
            show_404();
        }
    }

    public function form_esv_frontend_1()
    {
        $this->db->select('*');
        $this->db->from('tbl_form_esv');
        $this->db->where('tbl_form_esv.form_esv_id', 1); // ระบุ id ที่ต้องการ
        $query = $this->db->get();
        return $query->result();
    }
    public function form_esv_frontend_2()
    {
        $this->db->select('*');
        $this->db->from('tbl_form_esv');
        $this->db->where('tbl_form_esv.form_esv_id', 2); // ระบุ id ที่ต้องการ
        $query = $this->db->get();
        return $query->result();
    }
    public function form_esv_frontend_3()
    {
        $this->db->select('*');
        $this->db->from('tbl_form_esv');
        $this->db->where('tbl_form_esv.form_esv_id', 3); // ระบุ id ที่ต้องการ
        $query = $this->db->get();
        return $query->result();
    }
    public function form_esv_frontend_4()
    {
        $this->db->select('*');
        $this->db->from('tbl_form_esv');
        $this->db->where('tbl_form_esv.form_esv_id', 4); // ระบุ id ที่ต้องการ
        $query = $this->db->get();
        return $query->result();
    }
    public function form_esv_frontend_5()
    {
        $this->db->select('*');
        $this->db->from('tbl_form_esv');
        $this->db->where('tbl_form_esv.form_esv_id', 5); // ระบุ id ที่ต้องการ
        $query = $this->db->get();
        return $query->result();
    }
    public function form_esv_frontend_6()
    {
        $this->db->select('*');
        $this->db->from('tbl_form_esv');
        $this->db->where('tbl_form_esv.form_esv_id', 6); // ระบุ id ที่ต้องการ
        $query = $this->db->get();
        return $query->result();
    }
    public function form_esv_frontend_7()
    {
        $this->db->select('*');
        $this->db->from('tbl_form_esv');
        $this->db->where('tbl_form_esv.form_esv_id', 7); // ระบุ id ที่ต้องการ
        $query = $this->db->get();
        return $query->result();
    }
    public function form_esv_frontend_8()
    {
        $this->db->select('*');
        $this->db->from('tbl_form_esv');
        $this->db->where('tbl_form_esv.form_esv_id', 8); // ระบุ id ที่ต้องการ
        $query = $this->db->get();
        return $query->result();
    }
}
