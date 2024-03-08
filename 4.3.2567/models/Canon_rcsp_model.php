<?php
class Canon_rcsp_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    public function add()
    {
        // Configure PDF upload
        $pdf_config['upload_path'] = './docs/file';
        $pdf_config['allowed_types'] = 'pdf';
        $this->load->library('upload', $pdf_config, 'pdf_upload');

        // Configure image upload
        $img_config['upload_path'] = './docs/img';
        $img_config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $img_config, 'img_upload');


        // กำหนดค่าใน $canon_rcsp_data
        $canon_rcsp_data = array(
            'canon_rcsp_name' => $this->input->post('canon_rcsp_name'),
            'canon_rcsp_detail' => $this->input->post('canon_rcsp_detail'),
            'canon_rcsp_date' => $this->input->post('canon_rcsp_date'),
            'canon_rcsp_link' => $this->input->post('canon_rcsp_link'),
            'canon_rcsp_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
        );

        // ทำการอัปโหลดรูปภาพ
        $img_main = $this->img_upload->do_upload('canon_rcsp_img');
        // ตรวจสอบว่ามีการอัปโหลดรูปภาพหรือไม่
        if (!empty($img_main)) {
            // ถ้ามีการอัปโหลดรูปภาพ
            $canon_rcsp_data['canon_rcsp_img'] = $this->img_upload->data('file_name');
        }
        // เพิ่มข้อมูลลงในฐานข้อมูล
        $this->db->insert('tbl_canon_rcsp', $canon_rcsp_data);
        $canon_rcsp_id = $this->db->insert_id();

        // หาพื้นที่ว่าง และอัพโหลดlimit จากฐานข้อมูล
        $used_space = $this->space_model->get_used_space();
        $upload_limit = $this->space_model->get_limit_storage();

        $total_space_required = 0;
        // ตรวจสอบว่ามีข้อมูลรูปภาพเพิ่มเติมหรือไม่
        if (isset($_FILES['canon_rcsp_img_img'])) {
            foreach ($_FILES['canon_rcsp_img_img']['name'] as $index => $name) {
                if (isset($_FILES['canon_rcsp_img_img']['size'][$index])) {
                    $total_space_required += $_FILES['canon_rcsp_img_img']['size'][$index];
                }
            }
        }

        // ตรวจสอบว่ามีข้อมูลไฟล์ PDF หรือไม่
        if (isset($_FILES['canon_rcsp_file_pdf'])) {
            foreach ($_FILES['canon_rcsp_file_pdf']['name'] as $index => $name) {
                if (isset($_FILES['canon_rcsp_file_pdf']['size'][$index])) {
                    $total_space_required += $_FILES['canon_rcsp_file_pdf']['size'][$index];
                }
            }
        }

        // เช็คค่าว่าง
        if ($used_space + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('canon_rcsp_backend/adding');
            return;
        }

        $imgs_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['canon_rcsp_img_img']['name'][0])) {
            foreach ($_FILES['canon_rcsp_img_img']['name'] as $index => $name) {
                $_FILES['canon_rcsp_img_img_multiple']['name'] = $name;
                $_FILES['canon_rcsp_img_img_multiple']['type'] = $_FILES['canon_rcsp_img_img']['type'][$index];
                $_FILES['canon_rcsp_img_img_multiple']['tmp_name'] = $_FILES['canon_rcsp_img_img']['tmp_name'][$index];
                $_FILES['canon_rcsp_img_img_multiple']['error'] = $_FILES['canon_rcsp_img_img']['error'][$index];
                $_FILES['canon_rcsp_img_img_multiple']['size'] = $_FILES['canon_rcsp_img_img']['size'][$index];

                if ($this->img_upload->do_upload('canon_rcsp_img_img_multiple')) {
                    $upload_data = $this->img_upload->data();
                    $imgs_data[] = array(
                        'canon_rcsp_img_ref_id' => $canon_rcsp_id,
                        'canon_rcsp_img_img' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_canon_rcsp_img', $imgs_data);
        }

        $pdf_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['canon_rcsp_file_pdf']['name'][0])) {
            foreach ($_FILES['canon_rcsp_file_pdf']['name'] as $index => $name) {
                $_FILES['canon_rcsp_file_pdf_multiple']['name'] = $name;
                $_FILES['canon_rcsp_file_pdf_multiple']['type'] = $_FILES['canon_rcsp_file_pdf']['type'][$index];
                $_FILES['canon_rcsp_file_pdf_multiple']['tmp_name'] = $_FILES['canon_rcsp_file_pdf']['tmp_name'][$index];
                $_FILES['canon_rcsp_file_pdf_multiple']['error'] = $_FILES['canon_rcsp_file_pdf']['error'][$index];
                $_FILES['canon_rcsp_file_pdf_multiple']['size'] = $_FILES['canon_rcsp_file_pdf']['size'][$index];

                if ($this->pdf_upload->do_upload('canon_rcsp_file_pdf_multiple')) {
                    $upload_data = $this->pdf_upload->data();
                    $pdf_data[] = array(
                        'canon_rcsp_file_ref_id' => $canon_rcsp_id,
                        'canon_rcsp_file_pdf' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_canon_rcsp_file', $pdf_data);
        }
        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }

    public function list_all()
    {
        $this->db->select('*');
        $this->db->from('tbl_canon_rcsp');
        $this->db->group_by('tbl_canon_rcsp.canon_rcsp_id');
        $this->db->order_by('tbl_canon_rcsp.canon_rcsp_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function list_all_pdf($canon_rcsp_id)
    {
        $this->db->select('canon_rcsp_file_pdf');
        $this->db->from('tbl_canon_rcsp_file');
        $this->db->where('canon_rcsp_file_ref_id', $canon_rcsp_id);
        return $this->db->get()->result();
    }

    //show form edit
    public function read($canon_rcsp_id)
    {
        $this->db->where('canon_rcsp_id', $canon_rcsp_id);
        $query = $this->db->get('tbl_canon_rcsp');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function read_file($canon_rcsp_id)
    {
        $this->db->where('canon_rcsp_file_ref_id', $canon_rcsp_id);
        $this->db->order_by('canon_rcsp_file_id', 'DESC');
        $query = $this->db->get('tbl_canon_rcsp_file');
        return $query->result();
    }

    public function read_img($canon_rcsp_id)
    {
        $this->db->where('canon_rcsp_img_ref_id', $canon_rcsp_id);
        $this->db->order_by('canon_rcsp_img_id', 'DESC');
        $query = $this->db->get('tbl_canon_rcsp_img');
        return $query->result();
    }

    public function del_pdf($file_id)
    {
        // ดึงชื่อไฟล์ PDF จากฐานข้อมูลโดยใช้ $file_id
        $this->db->select('canon_rcsp_file_pdf');
        $this->db->where('canon_rcsp_file_id', $file_id);
        $query = $this->db->get('tbl_canon_rcsp_file');
        $file_data = $query->row();

        // ลบไฟล์จากแหล่งที่เก็บไฟล์ (อาจต้องใช้ unlink หรือวิธีอื่น)
        $file_path = './docs/file/' . $file_data->canon_rcsp_file_pdf;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // ลบข้อมูลของไฟล์จากฐานข้อมูล
        $this->db->where('canon_rcsp_file_id', $file_id);
        $this->db->delete('tbl_canon_rcsp_file');
    }

    public function del_img($file_id)
    {
        // ดึงชื่อไฟล์ PDF จากฐานข้อมูลโดยใช้ $file_id
        $this->db->select('canon_rcsp_img_img');
        $this->db->where('canon_rcsp_img_id', $file_id);
        $query = $this->db->get('tbl_canon_rcsp_img');
        $file_data = $query->row();

        // ลบไฟล์จากแหล่งที่เก็บไฟล์ (อาจต้องใช้ unlink หรือวิธีอื่น)
        $file_path = './docs/img/' . $file_data->canon_rcsp_img_img;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // ลบข้อมูลของไฟล์จากฐานข้อมูล
        $this->db->where('canon_rcsp_img_id', $file_id);
        $this->db->delete('tbl_canon_rcsp_img');
        $this->space_model->update_server_current();
        $this->session->set_flashdata('del_success', TRUE);
    }


    public function edit($canon_rcsp_id)
    {
        // Update canon_rcsp information
        $data = array(
            'canon_rcsp_name' => $this->input->post('canon_rcsp_name'),
            'canon_rcsp_detail' => $this->input->post('canon_rcsp_detail'),
            'canon_rcsp_date' => $this->input->post('canon_rcsp_date'),
            'canon_rcsp_link' => $this->input->post('canon_rcsp_link'),
            'canon_rcsp_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
        );

        $this->db->where('canon_rcsp_id', $canon_rcsp_id);
        $this->db->update('tbl_canon_rcsp', $data);

        // หาพื้นที่ว่าง และอัพโหลดlimit จากฐานข้อมูล
        $used_space = $this->space_model->get_used_space();
        $upload_limit = $this->space_model->get_limit_storage();

        $total_space_required = 0;
        // ตรวจสอบว่ามีข้อมูลรูปภาพเพิ่มเติมหรือไม่
        if (isset($_FILES['canon_rcsp_img_img'])) {
            foreach ($_FILES['canon_rcsp_img_img']['name'] as $index => $name) {
                if (isset($_FILES['canon_rcsp_img_img']['size'][$index])) {
                    $total_space_required += $_FILES['canon_rcsp_img_img']['size'][$index];
                }
            }
        }

        // ตรวจสอบว่ามีข้อมูลไฟล์ PDF หรือไม่
        if (isset($_FILES['canon_rcsp_file_pdf'])) {
            foreach ($_FILES['canon_rcsp_file_pdf']['name'] as $index => $name) {
                if (isset($_FILES['canon_rcsp_file_pdf']['size'][$index])) {
                    $total_space_required += $_FILES['canon_rcsp_file_pdf']['size'][$index];
                }
            }
        }

        // เช็คค่าว่าง
        if ($used_space + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('canon_rcsp_backend/adding');
            return;
        }

        $pdf_config['upload_path'] = './docs/file';
        $pdf_config['allowed_types'] = 'pdf';
        $this->load->library('upload', $pdf_config, 'pdf_upload');

        $img_config['upload_path'] = './docs/img';
        $img_config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $img_config, 'img_upload');

        // ทำการอัปโหลดรูปภาพ
        $img_main = $this->img_upload->do_upload('canon_rcsp_img');

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพหรือไม่
        if (!empty($img_main)) {
            $this->db->trans_start(); // เริ่ม Transaction

            // ดึงข้อมูลรูปเก่า
            $old_document = $this->db->get_where('tbl_canon_rcsp', array('canon_rcsp_id' => $canon_rcsp_id))->row();

            // ตรวจสอบว่ามีไฟล์เก่าหรือไม่
            if ($old_document && $old_document->canon_rcsp_img) {
                $old_file_path = './docs/img/' . $old_document->canon_rcsp_img;

                if (file_exists($old_file_path)) {
                    unlink($old_file_path); // ลบไฟล์เก่า
                }
            }

            // ถ้ามีการอัปโหลดรูปภาพใหม่
            $img_data['canon_rcsp_img'] = $this->img_upload->data('file_name');
            $this->db->where('canon_rcsp_id', $canon_rcsp_id);
            $this->db->update('tbl_canon_rcsp', $img_data);

            $this->db->trans_complete(); // สิ้นสุด Transaction
        }

        $imgs_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['canon_rcsp_img_img']['name'][0])) {

            foreach ($_FILES['canon_rcsp_img_img']['name'] as $index => $name) {
                $_FILES['canon_rcsp_img_img_multiple']['name'] = $name;
                $_FILES['canon_rcsp_img_img_multiple']['type'] = $_FILES['canon_rcsp_img_img']['type'][$index];
                $_FILES['canon_rcsp_img_img_multiple']['tmp_name'] = $_FILES['canon_rcsp_img_img']['tmp_name'][$index];
                $_FILES['canon_rcsp_img_img_multiple']['error'] = $_FILES['canon_rcsp_img_img']['error'][$index];
                $_FILES['canon_rcsp_img_img_multiple']['size'] = $_FILES['canon_rcsp_img_img']['size'][$index];

                if ($this->img_upload->do_upload('canon_rcsp_img_img_multiple')) {
                    $upload_data = $this->img_upload->data();
                    $imgs_data[] = array(
                        'canon_rcsp_img_ref_id' => $canon_rcsp_id,
                        'canon_rcsp_img_img' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_canon_rcsp_img', $imgs_data);
        }

        $pdf_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['canon_rcsp_file_pdf']['name'][0])) {
            foreach ($_FILES['canon_rcsp_file_pdf']['name'] as $index => $name) {
                $_FILES['canon_rcsp_file_pdf_multiple']['name'] = $name;
                $_FILES['canon_rcsp_file_pdf_multiple']['type'] = $_FILES['canon_rcsp_file_pdf']['type'][$index];
                $_FILES['canon_rcsp_file_pdf_multiple']['tmp_name'] = $_FILES['canon_rcsp_file_pdf']['tmp_name'][$index];
                $_FILES['canon_rcsp_file_pdf_multiple']['error'] = $_FILES['canon_rcsp_file_pdf']['error'][$index];
                $_FILES['canon_rcsp_file_pdf_multiple']['size'] = $_FILES['canon_rcsp_file_pdf']['size'][$index];

                if ($this->pdf_upload->do_upload('canon_rcsp_file_pdf_multiple')) {
                    $upload_data = $this->pdf_upload->data();
                    $pdf_data[] = array(
                        'canon_rcsp_file_ref_id' => $canon_rcsp_id,
                        'canon_rcsp_file_pdf' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_canon_rcsp_file', $pdf_data);
        }
        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }



    public function del_canon_rcsp($canon_rcsp_id)
    {
        $old_document = $this->db->get_where('tbl_canon_rcsp', array('canon_rcsp_id' => $canon_rcsp_id))->row();

        $old_file_path = './docs/img/' . $old_document->canon_rcsp_img;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_canon_rcsp', array('canon_rcsp_id' => $canon_rcsp_id));
        $this->space_model->update_server_current();
    }

    public function del_canon_rcsp_pdf($canon_rcsp_id)
    {
        // ดึงข้อมูลรายการรูปภาพก่อน
        $files = $this->db->get_where('tbl_canon_rcsp_file', array('canon_rcsp_file_ref_id' => $canon_rcsp_id))->result();

        // ลบรูปภาพจากตาราง tbl_canon_rcsp_file
        $this->db->where('canon_rcsp_file_ref_id', $canon_rcsp_id);
        $this->db->delete('tbl_canon_rcsp_file');

        // ลบไฟล์รูปภาพที่เกี่ยวข้อง
        foreach ($files as $files) {
            $file_path = './docs/file/' . $files->canon_rcsp_file_pdf;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }

    public function del_canon_rcsp_img($canon_rcsp_id)
    {
        // ดึงข้อมูลรายการรูปภาพก่อน
        $files = $this->db->get_where('tbl_canon_rcsp_img', array('canon_rcsp_img_ref_id' => $canon_rcsp_id))->result();

        // ลบรูปภาพจากตาราง tbl_canon_rcsp_file
        $this->db->where('canon_rcsp_img_ref_id', $canon_rcsp_id);
        $this->db->delete('tbl_canon_rcsp_img');

        // ลบไฟล์รูปภาพที่เกี่ยวข้อง
        foreach ($files as $files) {
            $file_path = './docs/img/' . $files->canon_rcsp_img_img;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }

    public function update_canon_rcsp_status()
    {
        // ตรวจสอบว่ามีการส่งข้อมูล POST มาหรือไม่
        if ($this->input->post()) {
            $canon_rcspId = $this->input->post('canon_rcsp_id'); // รับค่า canon_rcsp_id
            $newStatus = $this->input->post('new_status'); // รับค่าใหม่จาก switch checkbox

            // ทำการอัพเดตค่าในตาราง tbl_canon_rcsp ในฐานข้อมูลของคุณ
            $data = array(
                'canon_rcsp_status' => $newStatus
            );
            $this->db->where('canon_rcsp_id', $canon_rcspId); // ระบุ canon_rcsp_id ของแถวที่ต้องการอัพเดต
            $this->db->update('tbl_canon_rcsp', $data);

            // ส่งการตอบกลับ (response) กลับไปยังเว็บไซต์หรือแอพพลิเคชันของคุณ
            // โดยเช่นปกติคุณอาจส่ง JSON response กลับมาเพื่ออัพเดตหน้าเว็บ
            $response = array('status' => 'success', 'message' => 'อัพเดตสถานะเรียบร้อย');
            echo json_encode($response);
        } else {
            // ถ้าไม่มีข้อมูล POST ส่งมา ให้รีเดอร์เปรียบเสมอ
            show_404();
        }
    }

    public function canon_rcsp_frontend()
    {
        $this->db->select('*');
        $this->db->from('tbl_canon_rcsp');
        $this->db->where('tbl_canon_rcsp.canon_rcsp_status', 'show');
        $this->db->order_by('tbl_canon_rcsp.canon_rcsp_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function increment_view($canon_rcsp_id)
    {
        $this->db->where('canon_rcsp_id', $canon_rcsp_id);
        $this->db->set('canon_rcsp_view', 'canon_rcsp_view + 1', false); // บวกค่า canon_rcsp_view ทีละ 1
        $this->db->update('tbl_canon_rcsp');
    }
    // ใน canon_rcsp_model
    public function increment_download_canon_rcsp($canon_rcsp_file_id)
    {
        $this->db->where('canon_rcsp_file_id', $canon_rcsp_file_id);
        $this->db->set('canon_rcsp_file_download', 'canon_rcsp_file_download + 1', false); // บวกค่า canon_rcsp_download ทีละ 1
        $this->db->update('tbl_canon_rcsp_file');
    }
}
