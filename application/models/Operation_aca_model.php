<?php
class Operation_aca_model extends CI_Model
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


        // กำหนดค่าใน $operation_aca_data
        $operation_aca_data = array(
            'operation_aca_name' => $this->input->post('operation_aca_name'),
            'operation_aca_detail' => $this->input->post('operation_aca_detail'),
            'operation_aca_date' => $this->input->post('operation_aca_date'),
            'operation_aca_link' => $this->input->post('operation_aca_link'),
            'operation_aca_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
        );

        // ทำการอัปโหลดรูปภาพ
        $img_main = $this->img_upload->do_upload('operation_aca_img');
        // ตรวจสอบว่ามีการอัปโหลดรูปภาพหรือไม่
        if (!empty($img_main)) {
            // ถ้ามีการอัปโหลดรูปภาพ
            $operation_aca_data['operation_aca_img'] = $this->img_upload->data('file_name');
        }
        // เพิ่มข้อมูลลงในฐานข้อมูล
        $this->db->insert('tbl_operation_aca', $operation_aca_data);
        $operation_aca_id = $this->db->insert_id();

        // หาพื้นที่ว่าง และอัพโหลดlimit จากฐานข้อมูล
        $used_space = $this->space_model->get_used_space();
        $upload_limit = $this->space_model->get_limit_storage();

        $total_space_required = 0;
        // ตรวจสอบว่ามีข้อมูลรูปภาพเพิ่มเติมหรือไม่
        if (isset($_FILES['operation_aca_img_img'])) {
            foreach ($_FILES['operation_aca_img_img']['name'] as $index => $name) {
                if (isset($_FILES['operation_aca_img_img']['size'][$index])) {
                    $total_space_required += $_FILES['operation_aca_img_img']['size'][$index];
                }
            }
        }

        // ตรวจสอบว่ามีข้อมูลไฟล์ PDF หรือไม่
        if (isset($_FILES['operation_aca_file_pdf'])) {
            foreach ($_FILES['operation_aca_file_pdf']['name'] as $index => $name) {
                if (isset($_FILES['operation_aca_file_pdf']['size'][$index])) {
                    $total_space_required += $_FILES['operation_aca_file_pdf']['size'][$index];
                }
            }
        }

        // เช็คค่าว่าง
        if ($used_space + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('operation_aca_backend/adding');
            return;
        }

        $imgs_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['operation_aca_img_img']['name'][0])) {
            foreach ($_FILES['operation_aca_img_img']['name'] as $index => $name) {
                $_FILES['operation_aca_img_img_multiple']['name'] = $name;
                $_FILES['operation_aca_img_img_multiple']['type'] = $_FILES['operation_aca_img_img']['type'][$index];
                $_FILES['operation_aca_img_img_multiple']['tmp_name'] = $_FILES['operation_aca_img_img']['tmp_name'][$index];
                $_FILES['operation_aca_img_img_multiple']['error'] = $_FILES['operation_aca_img_img']['error'][$index];
                $_FILES['operation_aca_img_img_multiple']['size'] = $_FILES['operation_aca_img_img']['size'][$index];

                if ($this->img_upload->do_upload('operation_aca_img_img_multiple')) {
                    $upload_data = $this->img_upload->data();
                    $imgs_data[] = array(
                        'operation_aca_img_ref_id' => $operation_aca_id,
                        'operation_aca_img_img' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_operation_aca_img', $imgs_data);
        }

        $pdf_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['operation_aca_file_pdf']['name'][0])) {
            foreach ($_FILES['operation_aca_file_pdf']['name'] as $index => $name) {
                $_FILES['operation_aca_file_pdf_multiple']['name'] = $name;
                $_FILES['operation_aca_file_pdf_multiple']['type'] = $_FILES['operation_aca_file_pdf']['type'][$index];
                $_FILES['operation_aca_file_pdf_multiple']['tmp_name'] = $_FILES['operation_aca_file_pdf']['tmp_name'][$index];
                $_FILES['operation_aca_file_pdf_multiple']['error'] = $_FILES['operation_aca_file_pdf']['error'][$index];
                $_FILES['operation_aca_file_pdf_multiple']['size'] = $_FILES['operation_aca_file_pdf']['size'][$index];

                if ($this->pdf_upload->do_upload('operation_aca_file_pdf_multiple')) {
                    $upload_data = $this->pdf_upload->data();
                    $pdf_data[] = array(
                        'operation_aca_file_ref_id' => $operation_aca_id,
                        'operation_aca_file_pdf' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_operation_aca_file', $pdf_data);
        }
        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }

    public function list_all()
    {
        $this->db->select('*');
        $this->db->from('tbl_operation_aca');
        $this->db->group_by('tbl_operation_aca.operation_aca_id');
        $this->db->order_by('tbl_operation_aca.operation_aca_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function list_all_pdf($operation_aca_id)
    {
        $this->db->select('operation_aca_file_pdf');
        $this->db->from('tbl_operation_aca_file');
        $this->db->where('operation_aca_file_ref_id', $operation_aca_id);
        return $this->db->get()->result();
    }

    //show form edit
    public function read($operation_aca_id)
    {
        $this->db->where('operation_aca_id', $operation_aca_id);
        $query = $this->db->get('tbl_operation_aca');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function read_file($operation_aca_id)
    {
        $this->db->where('operation_aca_file_ref_id', $operation_aca_id);
        $this->db->order_by('operation_aca_file_id', 'DESC');
        $query = $this->db->get('tbl_operation_aca_file');
        return $query->result();
    }

    public function read_img($operation_aca_id)
    {
        $this->db->where('operation_aca_img_ref_id', $operation_aca_id);
        $this->db->order_by('operation_aca_img_id', 'DESC');
        $query = $this->db->get('tbl_operation_aca_img');
        return $query->result();
    }

    public function del_pdf($file_id)
    {
        // ดึงชื่อไฟล์ PDF จากฐานข้อมูลโดยใช้ $file_id
        $this->db->select('operation_aca_file_pdf');
        $this->db->where('operation_aca_file_id', $file_id);
        $query = $this->db->get('tbl_operation_aca_file');
        $file_data = $query->row();

        // ลบไฟล์จากแหล่งที่เก็บไฟล์ (อาจต้องใช้ unlink หรือวิธีอื่น)
        $file_path = './docs/file/' . $file_data->operation_aca_file_pdf;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // ลบข้อมูลของไฟล์จากฐานข้อมูล
        $this->db->where('operation_aca_file_id', $file_id);
        $this->db->delete('tbl_operation_aca_file');
    }

    public function del_img($file_id)
    {
        // ดึงชื่อไฟล์ PDF จากฐานข้อมูลโดยใช้ $file_id
        $this->db->select('operation_aca_img_img');
        $this->db->where('operation_aca_img_id', $file_id);
        $query = $this->db->get('tbl_operation_aca_img');
        $file_data = $query->row();

        // ลบไฟล์จากแหล่งที่เก็บไฟล์ (อาจต้องใช้ unlink หรือวิธีอื่น)
        $file_path = './docs/img/' . $file_data->operation_aca_img_img;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // ลบข้อมูลของไฟล์จากฐานข้อมูล
        $this->db->where('operation_aca_img_id', $file_id);
        $this->db->delete('tbl_operation_aca_img');
        $this->space_model->update_server_current();
        $this->session->set_flashdata('del_success', TRUE);
    }


    public function edit($operation_aca_id)
    {
        // Update operation_aca information
        $data = array(
            'operation_aca_name' => $this->input->post('operation_aca_name'),
            'operation_aca_detail' => $this->input->post('operation_aca_detail'),
            'operation_aca_date' => $this->input->post('operation_aca_date'),
            'operation_aca_link' => $this->input->post('operation_aca_link'),
            'operation_aca_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
        );

        $this->db->where('operation_aca_id', $operation_aca_id);
        $this->db->update('tbl_operation_aca', $data);

        // หาพื้นที่ว่าง และอัพโหลดlimit จากฐานข้อมูล
        $used_space = $this->space_model->get_used_space();
        $upload_limit = $this->space_model->get_limit_storage();

        $total_space_required = 0;
        // ตรวจสอบว่ามีข้อมูลรูปภาพเพิ่มเติมหรือไม่
        if (isset($_FILES['operation_aca_img_img'])) {
            foreach ($_FILES['operation_aca_img_img']['name'] as $index => $name) {
                if (isset($_FILES['operation_aca_img_img']['size'][$index])) {
                    $total_space_required += $_FILES['operation_aca_img_img']['size'][$index];
                }
            }
        }

        // ตรวจสอบว่ามีข้อมูลไฟล์ PDF หรือไม่
        if (isset($_FILES['operation_aca_file_pdf'])) {
            foreach ($_FILES['operation_aca_file_pdf']['name'] as $index => $name) {
                if (isset($_FILES['operation_aca_file_pdf']['size'][$index])) {
                    $total_space_required += $_FILES['operation_aca_file_pdf']['size'][$index];
                }
            }
        }

        // เช็คค่าว่าง
        if ($used_space + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('operation_aca_backend/adding');
            return;
        }

        $pdf_config['upload_path'] = './docs/file';
        $pdf_config['allowed_types'] = 'pdf';
        $this->load->library('upload', $pdf_config, 'pdf_upload');

        $img_config['upload_path'] = './docs/img';
        $img_config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $img_config, 'img_upload');

        // ทำการอัปโหลดรูปภาพ
        $img_main = $this->img_upload->do_upload('operation_aca_img');

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพหรือไม่
        if (!empty($img_main)) {
            $this->db->trans_start(); // เริ่ม Transaction

            // ดึงข้อมูลรูปเก่า
            $old_document = $this->db->get_where('tbl_operation_aca', array('operation_aca_id' => $operation_aca_id))->row();

            // ตรวจสอบว่ามีไฟล์เก่าหรือไม่
            if ($old_document && $old_document->operation_aca_img) {
                $old_file_path = './docs/img/' . $old_document->operation_aca_img;

                if (file_exists($old_file_path)) {
                    unlink($old_file_path); // ลบไฟล์เก่า
                }
            }

            // ถ้ามีการอัปโหลดรูปภาพใหม่
            $img_data['operation_aca_img'] = $this->img_upload->data('file_name');
            $this->db->where('operation_aca_id', $operation_aca_id);
            $this->db->update('tbl_operation_aca', $img_data);

            $this->db->trans_complete(); // สิ้นสุด Transaction
        }

        $imgs_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['operation_aca_img_img']['name'][0])) {

            foreach ($_FILES['operation_aca_img_img']['name'] as $index => $name) {
                $_FILES['operation_aca_img_img_multiple']['name'] = $name;
                $_FILES['operation_aca_img_img_multiple']['type'] = $_FILES['operation_aca_img_img']['type'][$index];
                $_FILES['operation_aca_img_img_multiple']['tmp_name'] = $_FILES['operation_aca_img_img']['tmp_name'][$index];
                $_FILES['operation_aca_img_img_multiple']['error'] = $_FILES['operation_aca_img_img']['error'][$index];
                $_FILES['operation_aca_img_img_multiple']['size'] = $_FILES['operation_aca_img_img']['size'][$index];

                if ($this->img_upload->do_upload('operation_aca_img_img_multiple')) {
                    $upload_data = $this->img_upload->data();
                    $imgs_data[] = array(
                        'operation_aca_img_ref_id' => $operation_aca_id,
                        'operation_aca_img_img' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_operation_aca_img', $imgs_data);
        }

        $pdf_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['operation_aca_file_pdf']['name'][0])) {
            foreach ($_FILES['operation_aca_file_pdf']['name'] as $index => $name) {
                $_FILES['operation_aca_file_pdf_multiple']['name'] = $name;
                $_FILES['operation_aca_file_pdf_multiple']['type'] = $_FILES['operation_aca_file_pdf']['type'][$index];
                $_FILES['operation_aca_file_pdf_multiple']['tmp_name'] = $_FILES['operation_aca_file_pdf']['tmp_name'][$index];
                $_FILES['operation_aca_file_pdf_multiple']['error'] = $_FILES['operation_aca_file_pdf']['error'][$index];
                $_FILES['operation_aca_file_pdf_multiple']['size'] = $_FILES['operation_aca_file_pdf']['size'][$index];

                if ($this->pdf_upload->do_upload('operation_aca_file_pdf_multiple')) {
                    $upload_data = $this->pdf_upload->data();
                    $pdf_data[] = array(
                        'operation_aca_file_ref_id' => $operation_aca_id,
                        'operation_aca_file_pdf' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_operation_aca_file', $pdf_data);
        }
        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }



    public function del_operation_aca($operation_aca_id)
    {
        $old_document = $this->db->get_where('tbl_operation_aca', array('operation_aca_id' => $operation_aca_id))->row();

        $old_file_path = './docs/img/' . $old_document->operation_aca_img;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_operation_aca', array('operation_aca_id' => $operation_aca_id));
        $this->space_model->update_server_current();
    }

    public function del_operation_aca_pdf($operation_aca_id)
    {
        // ดึงข้อมูลรายการรูปภาพก่อน
        $files = $this->db->get_where('tbl_operation_aca_file', array('operation_aca_file_ref_id' => $operation_aca_id))->result();

        // ลบรูปภาพจากตาราง tbl_operation_aca_file
        $this->db->where('operation_aca_file_ref_id', $operation_aca_id);
        $this->db->delete('tbl_operation_aca_file');

        // ลบไฟล์รูปภาพที่เกี่ยวข้อง
        foreach ($files as $files) {
            $file_path = './docs/file/' . $files->operation_aca_file_pdf;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }

    public function del_operation_aca_img($operation_aca_id)
    {
        // ดึงข้อมูลรายการรูปภาพก่อน
        $files = $this->db->get_where('tbl_operation_aca_img', array('operation_aca_img_ref_id' => $operation_aca_id))->result();

        // ลบรูปภาพจากตาราง tbl_operation_aca_file
        $this->db->where('operation_aca_img_ref_id', $operation_aca_id);
        $this->db->delete('tbl_operation_aca_img');

        // ลบไฟล์รูปภาพที่เกี่ยวข้อง
        foreach ($files as $files) {
            $file_path = './docs/img/' . $files->operation_aca_img_img;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }

    public function update_operation_aca_status()
    {
        // ตรวจสอบว่ามีการส่งข้อมูล POST มาหรือไม่
        if ($this->input->post()) {
            $operation_acaId = $this->input->post('operation_aca_id'); // รับค่า operation_aca_id
            $newStatus = $this->input->post('new_status'); // รับค่าใหม่จาก switch checkbox

            // ทำการอัพเดตค่าในตาราง tbl_operation_aca ในฐานข้อมูลของคุณ
            $data = array(
                'operation_aca_status' => $newStatus
            );
            $this->db->where('operation_aca_id', $operation_acaId); // ระบุ operation_aca_id ของแถวที่ต้องการอัพเดต
            $this->db->update('tbl_operation_aca', $data);

            // ส่งการตอบกลับ (response) กลับไปยังเว็บไซต์หรือแอพพลิเคชันของคุณ
            // โดยเช่นปกติคุณอาจส่ง JSON response กลับมาเพื่ออัพเดตหน้าเว็บ
            $response = array('status' => 'success', 'message' => 'อัพเดตสถานะเรียบร้อย');
            echo json_encode($response);
        } else {
            // ถ้าไม่มีข้อมูล POST ส่งมา ให้รีเดอร์เปรียบเสมอ
            show_404();
        }
    }

    public function operation_aca_frontend()
    {
        $this->db->select('*');
        $this->db->from('tbl_operation_aca');
        $this->db->where('tbl_operation_aca.operation_aca_status', 'show');
        $this->db->order_by('tbl_operation_aca.operation_aca_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function increment_view($operation_aca_id)
    {
        $this->db->where('operation_aca_id', $operation_aca_id);
        $this->db->set('operation_aca_view', 'operation_aca_view + 1', false); // บวกค่า operation_aca_view ทีละ 1
        $this->db->update('tbl_operation_aca');
    }
    // ใน operation_aca_model
    public function increment_download_operation_aca($operation_aca_file_id)
    {
        $this->db->where('operation_aca_file_id', $operation_aca_file_id);
        $this->db->set('operation_aca_file_download', 'operation_aca_file_download + 1', false); // บวกค่า operation_aca_download ทีละ 1
        $this->db->update('tbl_operation_aca_file');
    }
}
