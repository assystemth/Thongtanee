<?php
class Eitiit_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    public function add_eitiit()
    {
        // Check used space
        $used_space_mb = $this->space_model->get_used_space();
        $upload_limit_mb = $this->space_model->get_limit_storage();

        // Calculate the total space required for all files
        $total_space_required = 0;
        if (!empty($_FILES['eitiit_img']['name'])) {
            $total_space_required += $_FILES['eitiit_img']['size'];
        }

        // Check if there's enough space
        if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('eitiit/adding_eitiit');
            return;
        }

        // Upload configuration
        $config['upload_path'] = './docs/img';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);

        // Upload main file
        if (!$this->upload->do_upload('eitiit_img')) {
            // If the file size exceeds the max_size, set flash data and redirect
            $this->session->set_flashdata('save_maxsize', TRUE);
            redirect('eitiit/adding_eitiit');
            return;
        }

        $data = $this->upload->data();
        $filename = $data['file_name'];

        $data = array(
            'eitiit_name' => $this->input->post('eitiit_name'),
            'eitiit_link' => $this->input->post('eitiit_link'),
            'eitiit_by' => $this->session->userdata('m_fname'),
            'eitiit_img' => $filename
        );

        $query = $this->db->insert('tbl_eitiit', $data);

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
        $this->db->order_by('eitiit_id', 'asc');
        $query = $this->db->get('tbl_eitiit');
        return $query->result();
    }

    //show form edit
    public function read($eitiit_id)
    {
        $this->db->where('eitiit_id', $eitiit_id);
        $query = $this->db->get('tbl_eitiit');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function edit_eitiit($eitiit_id)
    {
        $old_document = $this->db->get_where('tbl_eitiit', array('eitiit_id' => $eitiit_id))->row();

        $update_doc_file = !empty($_FILES['eitiit_img']['name']) && $old_document->eitiit_img != $_FILES['eitiit_img']['name'];

        // ตรวจสอบว่ามีการอัพโหลดรูปภาพใหม่หรือไม่
        if ($update_doc_file) {
            $old_file_path = './docs/img/' . $old_document->eitiit_img;
            if (file_exists($old_file_path)) {
                unlink($old_file_path);
            }

            // Check used space
            $used_space_mb = $this->space_model->get_used_space();
            $upload_limit_mb = $this->space_model->get_limit_storage();

            $total_space_required = 0;
            if (!empty($_FILES['eitiit_img']['name'])) {
                $total_space_required += $_FILES['eitiit_img']['size'];
            }

            if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
                $this->session->set_flashdata('save_error', TRUE);
                redirect('eitiit/editing_eitiit');
                return;
            }

            $config['upload_path'] = './docs/img';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('eitiit_img')) {
                echo $this->upload->display_errors();
                return;
            }

            $data = $this->upload->data();
            $filename = $data['file_name'];
        } else {
            // ใช้รูปภาพเดิม
            $filename = $old_document->eitiit_img;
        }

        $data = array(
            'eitiit_name' => $this->input->post('eitiit_name'),
            'eitiit_link' => $this->input->post('eitiit_link'),
            'eitiit_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่เพิ่มข้อมูล
            'eitiit_img' => $filename
        );

        $this->db->where('eitiit_id', $eitiit_id);
        $query = $this->db->update('tbl_eitiit', $data);

        $this->space_model->update_server_current();


        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล !');";
            echo "</script>";
        }
    }

    public function del_eitiit($eitiit_id)
    {
        $old_document = $this->db->get_where('tbl_eitiit', array('eitiit_id' => $eitiit_id))->row();

        $old_file_path = './docs/img/' . $old_document->eitiit_img;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_eitiit', array('eitiit_id' => $eitiit_id));
    }

    public function updateeitiitStatus()
    {
        // ตรวจสอบว่ามีการส่งข้อมูล POST มาหรือไม่
        if ($this->input->post()) {
            $eitiitId = $this->input->post('eitiit_id'); // รับค่า eitiit_id
            $newStatus = $this->input->post('new_status'); // รับค่าใหม่จาก switch checkbox

            // ทำการอัพเดตค่าในตาราง tbl_eitiit ในฐานข้อมูลของคุณ
            $data = array(
                'eitiit_status' => $newStatus
            );
            $this->db->where('eitiit_id', $eitiitId); // ระบุ eitiit_id ของแถวที่ต้องการอัพเดต
            $this->db->update('tbl_eitiit', $data);

            // ส่งการตอบกลับ (response) กลับไปยังเว็บไซต์หรือแอพพลิเคชันของคุณ
            // โดยเช่นปกติคุณอาจส่ง JSON response กลับมาเพื่ออัพเดตหน้าเว็บ
            $response = array('status' => 'success', 'message' => 'อัพเดตสถานะเรียบร้อย');
            echo json_encode($response);
        } else {
            // ถ้าไม่มีข้อมูล POST ส่งมา ให้รีเดอร์เปรียบเสมอ
            show_404();
        }
    }

    public function eitiit_frontend()
    {
        $this->db->select('*');
        $this->db->from('tbl_eitiit');
        $this->db->where('tbl_eitiit.eitiit_status', 'show');
        $this->db->order_by('tbl_eitiit.eitiit_id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function increment_view($eitiit_id)
    {
        $this->db->where('eitiit_id', $eitiit_id);
        $this->db->set('eitiit_view', 'eitiit_view + 1', false); // บวกค่า eitiit_view ทีละ 1
        $this->db->update('tbl_eitiit');
    }
}
