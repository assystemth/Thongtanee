<?php
class P_reb_model extends CI_Model
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


        // กำหนดค่าใน $p_reb_data
        $p_reb_data = array(
            'p_reb_name' => $this->input->post('p_reb_name'),
            'p_reb_detail' => $this->input->post('p_reb_detail'),
            'p_reb_date' => $this->input->post('p_reb_date'),
            'p_reb_link' => $this->input->post('p_reb_link'),
            'p_reb_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
        );

        // ทำการอัปโหลดรูปภาพ
        $img_main = $this->img_upload->do_upload('p_reb_img');
        // ตรวจสอบว่ามีการอัปโหลดรูปภาพหรือไม่
        if (!empty($img_main)) {
            // ถ้ามีการอัปโหลดรูปภาพ
            $p_reb_data['p_reb_img'] = $this->img_upload->data('file_name');
        }
        // เพิ่มข้อมูลลงในฐานข้อมูล
        $this->db->insert('tbl_p_reb', $p_reb_data);
        $p_reb_id = $this->db->insert_id();

        // หาพื้นที่ว่าง และอัพโหลดlimit จากฐานข้อมูล
        $used_space = $this->space_model->get_used_space();
        $upload_limit = $this->space_model->get_limit_storage();

        $total_space_required = 0;
        // ตรวจสอบว่ามีข้อมูลรูปภาพเพิ่มเติมหรือไม่
        if (isset($_FILES['p_reb_img_img'])) {
            foreach ($_FILES['p_reb_img_img']['name'] as $index => $name) {
                if (isset($_FILES['p_reb_img_img']['size'][$index])) {
                    $total_space_required += $_FILES['p_reb_img_img']['size'][$index];
                }
            }
        }

        // ตรวจสอบว่ามีข้อมูลไฟล์ PDF หรือไม่
        if (isset($_FILES['p_reb_file_pdf'])) {
            foreach ($_FILES['p_reb_file_pdf']['name'] as $index => $name) {
                if (isset($_FILES['p_reb_file_pdf']['size'][$index])) {
                    $total_space_required += $_FILES['p_reb_file_pdf']['size'][$index];
                }
            }
        }

        // เช็คค่าว่าง
        if ($used_space + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('p_reb_backend/adding');
            return;
        }

        $imgs_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['p_reb_img_img']['name'][0])) {
            foreach ($_FILES['p_reb_img_img']['name'] as $index => $name) {
                $_FILES['p_reb_img_img_multiple']['name'] = $name;
                $_FILES['p_reb_img_img_multiple']['type'] = $_FILES['p_reb_img_img']['type'][$index];
                $_FILES['p_reb_img_img_multiple']['tmp_name'] = $_FILES['p_reb_img_img']['tmp_name'][$index];
                $_FILES['p_reb_img_img_multiple']['error'] = $_FILES['p_reb_img_img']['error'][$index];
                $_FILES['p_reb_img_img_multiple']['size'] = $_FILES['p_reb_img_img']['size'][$index];

                if ($this->img_upload->do_upload('p_reb_img_img_multiple')) {
                    $upload_data = $this->img_upload->data();
                    $imgs_data[] = array(
                        'p_reb_img_ref_id' => $p_reb_id,
                        'p_reb_img_img' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_p_reb_img', $imgs_data);
        }

        $pdf_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['p_reb_file_pdf']['name'][0])) {
            foreach ($_FILES['p_reb_file_pdf']['name'] as $index => $name) {
                $_FILES['p_reb_file_pdf_multiple']['name'] = $name;
                $_FILES['p_reb_file_pdf_multiple']['type'] = $_FILES['p_reb_file_pdf']['type'][$index];
                $_FILES['p_reb_file_pdf_multiple']['tmp_name'] = $_FILES['p_reb_file_pdf']['tmp_name'][$index];
                $_FILES['p_reb_file_pdf_multiple']['error'] = $_FILES['p_reb_file_pdf']['error'][$index];
                $_FILES['p_reb_file_pdf_multiple']['size'] = $_FILES['p_reb_file_pdf']['size'][$index];

                if ($this->pdf_upload->do_upload('p_reb_file_pdf_multiple')) {
                    $upload_data = $this->pdf_upload->data();
                    $pdf_data[] = array(
                        'p_reb_file_ref_id' => $p_reb_id,
                        'p_reb_file_pdf' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_p_reb_file', $pdf_data);
        }
        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }

    public function list_all()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_reb');
        $this->db->group_by('tbl_p_reb.p_reb_id');
        $this->db->order_by('tbl_p_reb.p_reb_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function list_all_pdf($p_reb_id)
    {
        $this->db->select('p_reb_file_pdf');
        $this->db->from('tbl_p_reb_file');
        $this->db->where('p_reb_file_ref_id', $p_reb_id);
        return $this->db->get()->result();
    }

    //show form edit
    public function read($p_reb_id)
    {
        $this->db->where('p_reb_id', $p_reb_id);
        $query = $this->db->get('tbl_p_reb');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function read_file($p_reb_id)
    {
        $this->db->where('p_reb_file_ref_id', $p_reb_id);
        $this->db->order_by('p_reb_file_id', 'DESC');
        $query = $this->db->get('tbl_p_reb_file');
        return $query->result();
    }

    public function read_img($p_reb_id)
    {
        $this->db->where('p_reb_img_ref_id', $p_reb_id);
        $this->db->order_by('p_reb_img_id', 'DESC');
        $query = $this->db->get('tbl_p_reb_img');
        return $query->result();
    }

    public function del_pdf($file_id)
    {
        // ดึงชื่อไฟล์ PDF จากฐานข้อมูลโดยใช้ $file_id
        $this->db->select('p_reb_file_pdf');
        $this->db->where('p_reb_file_id', $file_id);
        $query = $this->db->get('tbl_p_reb_file');
        $file_data = $query->row();

        // ลบไฟล์จากแหล่งที่เก็บไฟล์ (อาจต้องใช้ unlink หรือวิธีอื่น)
        $file_path = './docs/file/' . $file_data->p_reb_file_pdf;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // ลบข้อมูลของไฟล์จากฐานข้อมูล
        $this->db->where('p_reb_file_id', $file_id);
        $this->db->delete('tbl_p_reb_file');
    }

    public function del_img($file_id)
    {
        // ดึงชื่อไฟล์ PDF จากฐานข้อมูลโดยใช้ $file_id
        $this->db->select('p_reb_img_img');
        $this->db->where('p_reb_img_id', $file_id);
        $query = $this->db->get('tbl_p_reb_img');
        $file_data = $query->row();

        // ลบไฟล์จากแหล่งที่เก็บไฟล์ (อาจต้องใช้ unlink หรือวิธีอื่น)
        $file_path = './docs/img/' . $file_data->p_reb_img_img;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // ลบข้อมูลของไฟล์จากฐานข้อมูล
        $this->db->where('p_reb_img_id', $file_id);
        $this->db->delete('tbl_p_reb_img');
        $this->space_model->update_server_current();
        $this->session->set_flashdata('del_success', TRUE);
    }


    public function edit($p_reb_id)
    {
        // Update p_reb information
        $data = array(
            'p_reb_name' => $this->input->post('p_reb_name'),
            'p_reb_detail' => $this->input->post('p_reb_detail'),
            'p_reb_date' => $this->input->post('p_reb_date'),
            'p_reb_link' => $this->input->post('p_reb_link'),
            'p_reb_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
        );

        $this->db->where('p_reb_id', $p_reb_id);
        $this->db->update('tbl_p_reb', $data);

        // หาพื้นที่ว่าง และอัพโหลดlimit จากฐานข้อมูล
        $used_space = $this->space_model->get_used_space();
        $upload_limit = $this->space_model->get_limit_storage();

        $total_space_required = 0;
        // ตรวจสอบว่ามีข้อมูลรูปภาพเพิ่มเติมหรือไม่
        if (isset($_FILES['p_reb_img_img'])) {
            foreach ($_FILES['p_reb_img_img']['name'] as $index => $name) {
                if (isset($_FILES['p_reb_img_img']['size'][$index])) {
                    $total_space_required += $_FILES['p_reb_img_img']['size'][$index];
                }
            }
        }

        // ตรวจสอบว่ามีข้อมูลไฟล์ PDF หรือไม่
        if (isset($_FILES['p_reb_file_pdf'])) {
            foreach ($_FILES['p_reb_file_pdf']['name'] as $index => $name) {
                if (isset($_FILES['p_reb_file_pdf']['size'][$index])) {
                    $total_space_required += $_FILES['p_reb_file_pdf']['size'][$index];
                }
            }
        }

        // เช็คค่าว่าง
        if ($used_space + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('p_reb_backend/adding');
            return;
        }

        $pdf_config['upload_path'] = './docs/file';
        $pdf_config['allowed_types'] = 'pdf';
        $this->load->library('upload', $pdf_config, 'pdf_upload');

        $img_config['upload_path'] = './docs/img';
        $img_config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $img_config, 'img_upload');

        // ทำการอัปโหลดรูปภาพ
        $img_main = $this->img_upload->do_upload('p_reb_img');

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพหรือไม่
        if (!empty($img_main)) {
            $this->db->trans_start(); // เริ่ม Transaction

            // ดึงข้อมูลรูปเก่า
            $old_document = $this->db->get_where('tbl_p_reb', array('p_reb_id' => $p_reb_id))->row();

            // ตรวจสอบว่ามีไฟล์เก่าหรือไม่
            if ($old_document && $old_document->p_reb_img) {
                $old_file_path = './docs/img/' . $old_document->p_reb_img;

                if (file_exists($old_file_path)) {
                    unlink($old_file_path); // ลบไฟล์เก่า
                }
            }

            // ถ้ามีการอัปโหลดรูปภาพใหม่
            $img_data['p_reb_img'] = $this->img_upload->data('file_name');
            $this->db->where('p_reb_id', $p_reb_id);
            $this->db->update('tbl_p_reb', $img_data);

            $this->db->trans_complete(); // สิ้นสุด Transaction
        }

        $imgs_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['p_reb_img_img']['name'][0])) {

            foreach ($_FILES['p_reb_img_img']['name'] as $index => $name) {
                $_FILES['p_reb_img_img_multiple']['name'] = $name;
                $_FILES['p_reb_img_img_multiple']['type'] = $_FILES['p_reb_img_img']['type'][$index];
                $_FILES['p_reb_img_img_multiple']['tmp_name'] = $_FILES['p_reb_img_img']['tmp_name'][$index];
                $_FILES['p_reb_img_img_multiple']['error'] = $_FILES['p_reb_img_img']['error'][$index];
                $_FILES['p_reb_img_img_multiple']['size'] = $_FILES['p_reb_img_img']['size'][$index];

                if ($this->img_upload->do_upload('p_reb_img_img_multiple')) {
                    $upload_data = $this->img_upload->data();
                    $imgs_data[] = array(
                        'p_reb_img_ref_id' => $p_reb_id,
                        'p_reb_img_img' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_p_reb_img', $imgs_data);
        }

        $pdf_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['p_reb_file_pdf']['name'][0])) {
            foreach ($_FILES['p_reb_file_pdf']['name'] as $index => $name) {
                $_FILES['p_reb_file_pdf_multiple']['name'] = $name;
                $_FILES['p_reb_file_pdf_multiple']['type'] = $_FILES['p_reb_file_pdf']['type'][$index];
                $_FILES['p_reb_file_pdf_multiple']['tmp_name'] = $_FILES['p_reb_file_pdf']['tmp_name'][$index];
                $_FILES['p_reb_file_pdf_multiple']['error'] = $_FILES['p_reb_file_pdf']['error'][$index];
                $_FILES['p_reb_file_pdf_multiple']['size'] = $_FILES['p_reb_file_pdf']['size'][$index];

                if ($this->pdf_upload->do_upload('p_reb_file_pdf_multiple')) {
                    $upload_data = $this->pdf_upload->data();
                    $pdf_data[] = array(
                        'p_reb_file_ref_id' => $p_reb_id,
                        'p_reb_file_pdf' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_p_reb_file', $pdf_data);
        }
        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }



    public function del_p_reb($p_reb_id)
    {
        $old_document = $this->db->get_where('tbl_p_reb', array('p_reb_id' => $p_reb_id))->row();

        $old_file_path = './docs/img/' . $old_document->p_reb_img;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_p_reb', array('p_reb_id' => $p_reb_id));
        $this->space_model->update_server_current();
    }

    public function del_p_reb_pdf($p_reb_id)
    {
        // ดึงข้อมูลรายการรูปภาพก่อน
        $files = $this->db->get_where('tbl_p_reb_file', array('p_reb_file_ref_id' => $p_reb_id))->result();

        // ลบรูปภาพจากตาราง tbl_p_reb_file
        $this->db->where('p_reb_file_ref_id', $p_reb_id);
        $this->db->delete('tbl_p_reb_file');

        // ลบไฟล์รูปภาพที่เกี่ยวข้อง
        foreach ($files as $files) {
            $file_path = './docs/file/' . $files->p_reb_file_pdf;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }

    public function del_p_reb_img($p_reb_id)
    {
        // ดึงข้อมูลรายการรูปภาพก่อน
        $files = $this->db->get_where('tbl_p_reb_img', array('p_reb_img_ref_id' => $p_reb_id))->result();

        // ลบรูปภาพจากตาราง tbl_p_reb_file
        $this->db->where('p_reb_img_ref_id', $p_reb_id);
        $this->db->delete('tbl_p_reb_img');

        // ลบไฟล์รูปภาพที่เกี่ยวข้อง
        foreach ($files as $files) {
            $file_path = './docs/img/' . $files->p_reb_img_img;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }

    public function update_p_reb_status()
    {
        // ตรวจสอบว่ามีการส่งข้อมูล POST มาหรือไม่
        if ($this->input->post()) {
            $p_rebId = $this->input->post('p_reb_id'); // รับค่า p_reb_id
            $p_rebtatus = $this->input->post('new_status'); // รับค่าใหม่จาก switch checkbox

            // ทำการอัพเดตค่าในตาราง tbl_p_reb ในฐานข้อมูลของคุณ
            $data = array(
                'p_reb_status' => $p_rebtatus
            );
            $this->db->where('p_reb_id', $p_rebId); // ระบุ p_reb_id ของแถวที่ต้องการอัพเดต
            $this->db->update('tbl_p_reb', $data);

            // ส่งการตอบกลับ (response) กลับไปยังเว็บไซต์หรือแอพพลิเคชันของคุณ
            // โดยเช่นปกติคุณอาจส่ง JSON response กลับมาเพื่ออัพเดตหน้าเว็บ
            $response = array('status' => 'success', 'message' => 'อัพเดตสถานะเรียบร้อย');
            echo json_encode($response);
        } else {
            // ถ้าไม่มีข้อมูล POST ส่งมา ให้รีเดอร์เปรียบเสมอ
            show_404();
        }
    }

    public function p_reb_frontend()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_reb');
        $this->db->where('tbl_p_reb.p_reb_status', 'show');
        $this->db->limit(8);
        $this->db->order_by('tbl_p_reb.p_reb_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function p_reb_frontend_list()
    {
        $this->db->select('*');
        $this->db->from('tbl_p_reb');
        $this->db->where('tbl_p_reb.p_reb_status', 'show');
        $this->db->order_by('tbl_p_reb.p_reb_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function increment_view($p_reb_id)
    {
        $this->db->where('p_reb_id', $p_reb_id);
        $this->db->set('p_reb_view', 'p_reb_view + 1', false); // บวกค่า p_reb_view ทีละ 1
        $this->db->update('tbl_p_reb');
    }
    // ใน p_reb_model
    public function increment_download_p_reb($p_reb_file_id)
    {
        $this->db->where('p_reb_file_id', $p_reb_file_id);
        $this->db->set('p_reb_file_download', 'p_reb_file_download + 1', false); // บวกค่า p_reb_download ทีละ 1
        $this->db->update('tbl_p_reb_file');
    }
}
