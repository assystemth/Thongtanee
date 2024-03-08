<?php
class Publicize_ita_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    public function add_publicize_ita()
    {
        // Check used space
        $used_space_mb = $this->space_model->get_used_space();
        $upload_limit_mb = $this->space_model->get_limit_storage();

        // Calculate the total space required for all files
        $total_space_required = 0;
        if (!empty($_FILES['publicize_ita_img']['name'])) {
            $total_space_required += $_FILES['publicize_ita_img']['size'];
        }

        // Check if there's enough space
        if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('publicize_ita/adding_publicize_ita');
            return;
        }

        // Upload configuration
        $config['upload_path'] = './docs/img';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);

        // Upload main file
        if (!$this->upload->do_upload('publicize_ita_img')) {
            // If the file size exceeds the max_size, set flash data and redirect
            $this->session->set_flashdata('save_maxsize', TRUE);
            redirect('publicize_ita/adding_publicize_ita');
            return;
        }

        $data = $this->upload->data();
        $filename = $data['file_name'];

        $data = array(
            'publicize_ita_name' => $this->input->post('publicize_ita_name'),
            'publicize_ita_link' => $this->input->post('publicize_ita_link'),
            'publicize_ita_by' => $this->session->userdata('m_fname'),
            'publicize_ita_img' => $filename
        );

        $query = $this->db->insert('tbl_publicize_ita', $data);

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
        $this->db->order_by('publicize_ita_id', 'DESC');
        $query = $this->db->get('tbl_publicize_ita');
        return $query->result();
    }

    //show form edit
    public function read($publicize_ita_id)
    {
        $this->db->where('publicize_ita_id', $publicize_ita_id);
        $query = $this->db->get('tbl_publicize_ita');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function edit_publicize_ita($publicize_ita_id)
    {
        $old_document = $this->db->get_where('tbl_publicize_ita', array('publicize_ita_id' => $publicize_ita_id))->row();

        $update_doc_file = !empty($_FILES['publicize_ita_img']['name']) && $old_document->publicize_ita_img != $_FILES['publicize_ita_img']['name'];

        // ตรวจสอบว่ามีการอัพโหลดรูปภาพใหม่หรือไม่
        if ($update_doc_file) {
            $old_file_path = './docs/img/' . $old_document->publicize_ita_img;
            if (file_exists($old_file_path)) {
                unlink($old_file_path);
            }

            // Check used space
            $used_space_mb = $this->space_model->get_used_space();
            $upload_limit_mb = $this->space_model->get_limit_storage();

            $total_space_required = 0;
            if (!empty($_FILES['publicize_ita_img']['name'])) {
                $total_space_required += $_FILES['publicize_ita_img']['size'];
            }

            if ($used_space_mb + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit_mb) {
                $this->session->set_flashdata('save_error', TRUE);
                redirect('publicize_ita/editing_publicize_ita');
                return;
            }

            $config['upload_path'] = './docs/img';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('publicize_ita_img')) {
                echo $this->upload->display_errors();
                return;
            }

            $data = $this->upload->data();
            $filename = $data['file_name'];
        } else {
            // ใช้รูปภาพเดิม
            $filename = $old_document->publicize_ita_img;
        }

        $data = array(
            'publicize_ita_name' => $this->input->post('publicize_ita_name'),
            'publicize_ita_link' => $this->input->post('publicize_ita_link'),
            'publicize_ita_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่เพิ่มข้อมูล
            'publicize_ita_img' => $filename
        );

        $this->db->where('publicize_ita_id', $publicize_ita_id);
        $query = $this->db->update('tbl_publicize_ita', $data);

        $this->space_model->update_server_current();


        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล !');";
            echo "</script>";
        }
    }

    public function del_publicize_ita($publicize_ita_id)
    {
        $old_document = $this->db->get_where('tbl_publicize_ita', array('publicize_ita_id' => $publicize_ita_id))->row();

        $old_file_path = './docs/img/' . $old_document->publicize_ita_img;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_publicize_ita', array('publicize_ita_id' => $publicize_ita_id));
    }

    public function updatepublicize_itaStatus()
    {
        // ตรวจสอบว่ามีการส่งข้อมูล POST มาหรือไม่
        if ($this->input->post()) {
            $publicize_itaId = $this->input->post('publicize_ita_id'); // รับค่า publicize_ita_id
            $newStatus = $this->input->post('new_status'); // รับค่าใหม่จาก switch checkbox

            // ทำการอัพเดตค่าในตาราง tbl_publicize_ita ในฐานข้อมูลของคุณ
            $data = array(
                'publicize_ita_status' => $newStatus
            );
            $this->db->where('publicize_ita_id', $publicize_itaId); // ระบุ publicize_ita_id ของแถวที่ต้องการอัพเดต
            $this->db->update('tbl_publicize_ita', $data);

            // ส่งการตอบกลับ (response) กลับไปยังเว็บไซต์หรือแอพพลิเคชันของคุณ
            // โดยเช่นปกติคุณอาจส่ง JSON response กลับมาเพื่ออัพเดตหน้าเว็บ
            $response = array('status' => 'success', 'message' => 'อัพเดตสถานะเรียบร้อย');
            echo json_encode($response);
        } else {
            // ถ้าไม่มีข้อมูล POST ส่งมา ให้รีเดอร์เปรียบเสมอ
            show_404();
        }
    }

    public function publicize_ita_frontend()
    {
        $this->db->select('*');
        $this->db->from('tbl_publicize_ita');
        $this->db->where('tbl_publicize_ita.publicize_ita_status', 'show');
        $this->db->order_by('tbl_publicize_ita.publicize_ita_id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
}
