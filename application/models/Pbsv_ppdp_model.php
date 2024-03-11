<?php
class Pbsv_ppdp_model extends CI_Model
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


        // กำหนดค่าใน $pbsv_ppdp_data
        $pbsv_ppdp_data = array(
            'pbsv_ppdp_name' => $this->input->post('pbsv_ppdp_name'),
            'pbsv_ppdp_detail' => $this->input->post('pbsv_ppdp_detail'),
            'pbsv_ppdp_date' => $this->input->post('pbsv_ppdp_date'),
            'pbsv_ppdp_link' => $this->input->post('pbsv_ppdp_link'),
            'pbsv_ppdp_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
        );

        // ทำการอัปโหลดรูปภาพ
        $img_main = $this->img_upload->do_upload('pbsv_ppdp_img');
        // ตรวจสอบว่ามีการอัปโหลดรูปภาพหรือไม่
        if (!empty($img_main)) {
            // ถ้ามีการอัปโหลดรูปภาพ
            $pbsv_ppdp_data['pbsv_ppdp_img'] = $this->img_upload->data('file_name');
        }
        // เพิ่มข้อมูลลงในฐานข้อมูล
        $this->db->insert('tbl_pbsv_ppdp', $pbsv_ppdp_data);
        $pbsv_ppdp_id = $this->db->insert_id();

        // หาพื้นที่ว่าง และอัพโหลดlimit จากฐานข้อมูล
        $used_space = $this->space_model->get_used_space();
        $upload_limit = $this->space_model->get_limit_storage();

        $total_space_required = 0;
        // ตรวจสอบว่ามีข้อมูลรูปภาพเพิ่มเติมหรือไม่
        if (isset($_FILES['pbsv_ppdp_img_img'])) {
            foreach ($_FILES['pbsv_ppdp_img_img']['name'] as $index => $name) {
                if (isset($_FILES['pbsv_ppdp_img_img']['size'][$index])) {
                    $total_space_required += $_FILES['pbsv_ppdp_img_img']['size'][$index];
                }
            }
        }

        // ตรวจสอบว่ามีข้อมูลไฟล์ PDF หรือไม่
        if (isset($_FILES['pbsv_ppdp_file_pdf'])) {
            foreach ($_FILES['pbsv_ppdp_file_pdf']['name'] as $index => $name) {
                if (isset($_FILES['pbsv_ppdp_file_pdf']['size'][$index])) {
                    $total_space_required += $_FILES['pbsv_ppdp_file_pdf']['size'][$index];
                }
            }
        }

        // เช็คค่าว่าง
        if ($used_space + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('pbsv_ppdp_backend/adding');
            return;
        }

        $imgs_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['pbsv_ppdp_img_img']['name'][0])) {
            foreach ($_FILES['pbsv_ppdp_img_img']['name'] as $index => $name) {
                $_FILES['pbsv_ppdp_img_img_multiple']['name'] = $name;
                $_FILES['pbsv_ppdp_img_img_multiple']['type'] = $_FILES['pbsv_ppdp_img_img']['type'][$index];
                $_FILES['pbsv_ppdp_img_img_multiple']['tmp_name'] = $_FILES['pbsv_ppdp_img_img']['tmp_name'][$index];
                $_FILES['pbsv_ppdp_img_img_multiple']['error'] = $_FILES['pbsv_ppdp_img_img']['error'][$index];
                $_FILES['pbsv_ppdp_img_img_multiple']['size'] = $_FILES['pbsv_ppdp_img_img']['size'][$index];

                if ($this->img_upload->do_upload('pbsv_ppdp_img_img_multiple')) {
                    $upload_data = $this->img_upload->data();
                    $imgs_data[] = array(
                        'pbsv_ppdp_img_ref_id' => $pbsv_ppdp_id,
                        'pbsv_ppdp_img_img' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_pbsv_ppdp_img', $imgs_data);
        }

        $pdf_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['pbsv_ppdp_file_pdf']['name'][0])) {
            foreach ($_FILES['pbsv_ppdp_file_pdf']['name'] as $index => $name) {
                $_FILES['pbsv_ppdp_file_pdf_multiple']['name'] = $name;
                $_FILES['pbsv_ppdp_file_pdf_multiple']['type'] = $_FILES['pbsv_ppdp_file_pdf']['type'][$index];
                $_FILES['pbsv_ppdp_file_pdf_multiple']['tmp_name'] = $_FILES['pbsv_ppdp_file_pdf']['tmp_name'][$index];
                $_FILES['pbsv_ppdp_file_pdf_multiple']['error'] = $_FILES['pbsv_ppdp_file_pdf']['error'][$index];
                $_FILES['pbsv_ppdp_file_pdf_multiple']['size'] = $_FILES['pbsv_ppdp_file_pdf']['size'][$index];

                if ($this->pdf_upload->do_upload('pbsv_ppdp_file_pdf_multiple')) {
                    $upload_data = $this->pdf_upload->data();
                    $pdf_data[] = array(
                        'pbsv_ppdp_file_ref_id' => $pbsv_ppdp_id,
                        'pbsv_ppdp_file_pdf' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_pbsv_ppdp_file', $pdf_data);
        }
        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }

    public function list_all()
    {
        $this->db->select('*');
        $this->db->from('tbl_pbsv_ppdp');
        $this->db->group_by('tbl_pbsv_ppdp.pbsv_ppdp_id');
        $this->db->order_by('tbl_pbsv_ppdp.pbsv_ppdp_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function list_all_pdf($pbsv_ppdp_id)
    {
        $this->db->select('pbsv_ppdp_file_pdf');
        $this->db->from('tbl_pbsv_ppdp_file');
        $this->db->where('pbsv_ppdp_file_ref_id', $pbsv_ppdp_id);
        return $this->db->get()->result();
    }

    //show form edit
    public function read($pbsv_ppdp_id)
    {
        $this->db->where('pbsv_ppdp_id', $pbsv_ppdp_id);
        $query = $this->db->get('tbl_pbsv_ppdp');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function read_file($pbsv_ppdp_id)
    {
        $this->db->where('pbsv_ppdp_file_ref_id', $pbsv_ppdp_id);
        $this->db->order_by('pbsv_ppdp_file_id', 'DESC');
        $query = $this->db->get('tbl_pbsv_ppdp_file');
        return $query->result();
    }

    public function read_img($pbsv_ppdp_id)
    {
        $this->db->where('pbsv_ppdp_img_ref_id', $pbsv_ppdp_id);
        $this->db->order_by('pbsv_ppdp_img_id', 'DESC');
        $query = $this->db->get('tbl_pbsv_ppdp_img');
        return $query->result();
    }

    public function del_pdf($file_id)
    {
        // ดึงชื่อไฟล์ PDF จากฐานข้อมูลโดยใช้ $file_id
        $this->db->select('pbsv_ppdp_file_pdf');
        $this->db->where('pbsv_ppdp_file_id', $file_id);
        $query = $this->db->get('tbl_pbsv_ppdp_file');
        $file_data = $query->row();

        // ลบไฟล์จากแหล่งที่เก็บไฟล์ (อาจต้องใช้ unlink หรือวิธีอื่น)
        $file_path = './docs/file/' . $file_data->pbsv_ppdp_file_pdf;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // ลบข้อมูลของไฟล์จากฐานข้อมูล
        $this->db->where('pbsv_ppdp_file_id', $file_id);
        $this->db->delete('tbl_pbsv_ppdp_file');
    }

    public function del_img($file_id)
    {
        // ดึงชื่อไฟล์ PDF จากฐานข้อมูลโดยใช้ $file_id
        $this->db->select('pbsv_ppdp_img_img');
        $this->db->where('pbsv_ppdp_img_id', $file_id);
        $query = $this->db->get('tbl_pbsv_ppdp_img');
        $file_data = $query->row();

        // ลบไฟล์จากแหล่งที่เก็บไฟล์ (อาจต้องใช้ unlink หรือวิธีอื่น)
        $file_path = './docs/img/' . $file_data->pbsv_ppdp_img_img;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // ลบข้อมูลของไฟล์จากฐานข้อมูล
        $this->db->where('pbsv_ppdp_img_id', $file_id);
        $this->db->delete('tbl_pbsv_ppdp_img');
        $this->space_model->update_server_current();
        $this->session->set_flashdata('del_success', TRUE);
    }


    public function edit($pbsv_ppdp_id)
    {
        // Update pbsv_ppdp information
        $data = array(
            'pbsv_ppdp_name' => $this->input->post('pbsv_ppdp_name'),
            'pbsv_ppdp_detail' => $this->input->post('pbsv_ppdp_detail'),
            'pbsv_ppdp_date' => $this->input->post('pbsv_ppdp_date'),
            'pbsv_ppdp_link' => $this->input->post('pbsv_ppdp_link'),
            'pbsv_ppdp_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
        );

        $this->db->where('pbsv_ppdp_id', $pbsv_ppdp_id);
        $this->db->update('tbl_pbsv_ppdp', $data);

        // หาพื้นที่ว่าง และอัพโหลดlimit จากฐานข้อมูล
        $used_space = $this->space_model->get_used_space();
        $upload_limit = $this->space_model->get_limit_storage();

        $total_space_required = 0;
        // ตรวจสอบว่ามีข้อมูลรูปภาพเพิ่มเติมหรือไม่
        if (isset($_FILES['pbsv_ppdp_img_img'])) {
            foreach ($_FILES['pbsv_ppdp_img_img']['name'] as $index => $name) {
                if (isset($_FILES['pbsv_ppdp_img_img']['size'][$index])) {
                    $total_space_required += $_FILES['pbsv_ppdp_img_img']['size'][$index];
                }
            }
        }

        // ตรวจสอบว่ามีข้อมูลไฟล์ PDF หรือไม่
        if (isset($_FILES['pbsv_ppdp_file_pdf'])) {
            foreach ($_FILES['pbsv_ppdp_file_pdf']['name'] as $index => $name) {
                if (isset($_FILES['pbsv_ppdp_file_pdf']['size'][$index])) {
                    $total_space_required += $_FILES['pbsv_ppdp_file_pdf']['size'][$index];
                }
            }
        }

        // เช็คค่าว่าง
        if ($used_space + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('pbsv_ppdp_backend/adding');
            return;
        }

        $pdf_config['upload_path'] = './docs/file';
        $pdf_config['allowed_types'] = 'pdf';
        $this->load->library('upload', $pdf_config, 'pdf_upload');

        $img_config['upload_path'] = './docs/img';
        $img_config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $img_config, 'img_upload');

        // ทำการอัปโหลดรูปภาพ
        $img_main = $this->img_upload->do_upload('pbsv_ppdp_img');

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพหรือไม่
        if (!empty($img_main)) {
            $this->db->trans_start(); // เริ่ม Transaction

            // ดึงข้อมูลรูปเก่า
            $old_document = $this->db->get_where('tbl_pbsv_ppdp', array('pbsv_ppdp_id' => $pbsv_ppdp_id))->row();

            // ตรวจสอบว่ามีไฟล์เก่าหรือไม่
            if ($old_document && $old_document->pbsv_ppdp_img) {
                $old_file_path = './docs/img/' . $old_document->pbsv_ppdp_img;

                if (file_exists($old_file_path)) {
                    unlink($old_file_path); // ลบไฟล์เก่า
                }
            }

            // ถ้ามีการอัปโหลดรูปภาพใหม่
            $img_data['pbsv_ppdp_img'] = $this->img_upload->data('file_name');
            $this->db->where('pbsv_ppdp_id', $pbsv_ppdp_id);
            $this->db->update('tbl_pbsv_ppdp', $img_data);

            $this->db->trans_complete(); // สิ้นสุด Transaction
        }

        $imgs_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['pbsv_ppdp_img_img']['name'][0])) {

            foreach ($_FILES['pbsv_ppdp_img_img']['name'] as $index => $name) {
                $_FILES['pbsv_ppdp_img_img_multiple']['name'] = $name;
                $_FILES['pbsv_ppdp_img_img_multiple']['type'] = $_FILES['pbsv_ppdp_img_img']['type'][$index];
                $_FILES['pbsv_ppdp_img_img_multiple']['tmp_name'] = $_FILES['pbsv_ppdp_img_img']['tmp_name'][$index];
                $_FILES['pbsv_ppdp_img_img_multiple']['error'] = $_FILES['pbsv_ppdp_img_img']['error'][$index];
                $_FILES['pbsv_ppdp_img_img_multiple']['size'] = $_FILES['pbsv_ppdp_img_img']['size'][$index];

                if ($this->img_upload->do_upload('pbsv_ppdp_img_img_multiple')) {
                    $upload_data = $this->img_upload->data();
                    $imgs_data[] = array(
                        'pbsv_ppdp_img_ref_id' => $pbsv_ppdp_id,
                        'pbsv_ppdp_img_img' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_pbsv_ppdp_img', $imgs_data);
        }

        $pdf_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['pbsv_ppdp_file_pdf']['name'][0])) {
            foreach ($_FILES['pbsv_ppdp_file_pdf']['name'] as $index => $name) {
                $_FILES['pbsv_ppdp_file_pdf_multiple']['name'] = $name;
                $_FILES['pbsv_ppdp_file_pdf_multiple']['type'] = $_FILES['pbsv_ppdp_file_pdf']['type'][$index];
                $_FILES['pbsv_ppdp_file_pdf_multiple']['tmp_name'] = $_FILES['pbsv_ppdp_file_pdf']['tmp_name'][$index];
                $_FILES['pbsv_ppdp_file_pdf_multiple']['error'] = $_FILES['pbsv_ppdp_file_pdf']['error'][$index];
                $_FILES['pbsv_ppdp_file_pdf_multiple']['size'] = $_FILES['pbsv_ppdp_file_pdf']['size'][$index];

                if ($this->pdf_upload->do_upload('pbsv_ppdp_file_pdf_multiple')) {
                    $upload_data = $this->pdf_upload->data();
                    $pdf_data[] = array(
                        'pbsv_ppdp_file_ref_id' => $pbsv_ppdp_id,
                        'pbsv_ppdp_file_pdf' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_pbsv_ppdp_file', $pdf_data);
        }
        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }



    public function del_pbsv_ppdp($pbsv_ppdp_id)
    {
        $old_document = $this->db->get_where('tbl_pbsv_ppdp', array('pbsv_ppdp_id' => $pbsv_ppdp_id))->row();

        $old_file_path = './docs/img/' . $old_document->pbsv_ppdp_img;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_pbsv_ppdp', array('pbsv_ppdp_id' => $pbsv_ppdp_id));
        $this->space_model->update_server_current();
    }

    public function del_pbsv_ppdp_pdf($pbsv_ppdp_id)
    {
        // ดึงข้อมูลรายการรูปภาพก่อน
        $files = $this->db->get_where('tbl_pbsv_ppdp_file', array('pbsv_ppdp_file_ref_id' => $pbsv_ppdp_id))->result();

        // ลบรูปภาพจากตาราง tbl_pbsv_ppdp_file
        $this->db->where('pbsv_ppdp_file_ref_id', $pbsv_ppdp_id);
        $this->db->delete('tbl_pbsv_ppdp_file');

        // ลบไฟล์รูปภาพที่เกี่ยวข้อง
        foreach ($files as $files) {
            $file_path = './docs/file/' . $files->pbsv_ppdp_file_pdf;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }

    public function del_pbsv_ppdp_img($pbsv_ppdp_id)
    {
        // ดึงข้อมูลรายการรูปภาพก่อน
        $files = $this->db->get_where('tbl_pbsv_ppdp_img', array('pbsv_ppdp_img_ref_id' => $pbsv_ppdp_id))->result();

        // ลบรูปภาพจากตาราง tbl_pbsv_ppdp_file
        $this->db->where('pbsv_ppdp_img_ref_id', $pbsv_ppdp_id);
        $this->db->delete('tbl_pbsv_ppdp_img');

        // ลบไฟล์รูปภาพที่เกี่ยวข้อง
        foreach ($files as $files) {
            $file_path = './docs/img/' . $files->pbsv_ppdp_img_img;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }

    public function update_pbsv_ppdp_status()
    {
        // ตรวจสอบว่ามีการส่งข้อมูล POST มาหรือไม่
        if ($this->input->post()) {
            $pbsv_ppdpId = $this->input->post('pbsv_ppdp_id'); // รับค่า pbsv_ppdp_id
            $newStatus = $this->input->post('new_status'); // รับค่าใหม่จาก switch checkbox

            // ทำการอัพเดตค่าในตาราง tbl_pbsv_ppdp ในฐานข้อมูลของคุณ
            $data = array(
                'pbsv_ppdp_status' => $newStatus
            );
            $this->db->where('pbsv_ppdp_id', $pbsv_ppdpId); // ระบุ pbsv_ppdp_id ของแถวที่ต้องการอัพเดต
            $this->db->update('tbl_pbsv_ppdp', $data);

            // ส่งการตอบกลับ (response) กลับไปยังเว็บไซต์หรือแอพพลิเคชันของคุณ
            // โดยเช่นปกติคุณอาจส่ง JSON response กลับมาเพื่ออัพเดตหน้าเว็บ
            $response = array('status' => 'success', 'message' => 'อัพเดตสถานะเรียบร้อย');
            echo json_encode($response);
        } else {
            // ถ้าไม่มีข้อมูล POST ส่งมา ให้รีเดอร์เปรียบเสมอ
            show_404();
        }
    }

    public function pbsv_ppdp_frontend()
    {
        $this->db->select('*');
        $this->db->from('tbl_pbsv_ppdp');
        $this->db->where('tbl_pbsv_ppdp.pbsv_ppdp_status', 'show');
        $this->db->order_by('tbl_pbsv_ppdp.pbsv_ppdp_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function increment_view($pbsv_ppdp_id)
    {
        $this->db->where('pbsv_ppdp_id', $pbsv_ppdp_id);
        $this->db->set('pbsv_ppdp_view', 'pbsv_ppdp_view + 1', false); // บวกค่า pbsv_ppdp_view ทีละ 1
        $this->db->update('tbl_pbsv_ppdp');
    }
    // ใน pbsv_ppdp_model
    public function increment_download_pbsv_ppdp($pbsv_ppdp_file_id)
    {
        $this->db->where('pbsv_ppdp_file_id', $pbsv_ppdp_file_id);
        $this->db->set('pbsv_ppdp_file_download', 'pbsv_ppdp_file_download + 1', false); // บวกค่า pbsv_ppdp_download ทีละ 1
        $this->db->update('tbl_pbsv_ppdp_file');
    }
}
