<?php
class Plan_paca_model extends CI_Model
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


        // กำหนดค่าใน $plan_paca_data
        $plan_paca_data = array(
            'plan_paca_name' => $this->input->post('plan_paca_name'),
            'plan_paca_detail' => $this->input->post('plan_paca_detail'),
            'plan_paca_date' => $this->input->post('plan_paca_date'),
            'plan_paca_link' => $this->input->post('plan_paca_link'),
            'plan_paca_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
        );

        // ทำการอัปโหลดรูปภาพ
        $img_main = $this->img_upload->do_upload('plan_paca_img');
        // ตรวจสอบว่ามีการอัปโหลดรูปภาพหรือไม่
        if (!empty($img_main)) {
            // ถ้ามีการอัปโหลดรูปภาพ
            $plan_paca_data['plan_paca_img'] = $this->img_upload->data('file_name');
        }
        // เพิ่มข้อมูลลงในฐานข้อมูล
        $this->db->insert('tbl_plan_paca', $plan_paca_data);
        $plan_paca_id = $this->db->insert_id();

        // หาพื้นที่ว่าง และอัพโหลดlimit จากฐานข้อมูล
        $used_space = $this->space_model->get_used_space();
        $upload_limit = $this->space_model->get_limit_storage();

        $total_space_required = 0;
        // ตรวจสอบว่ามีข้อมูลรูปภาพเพิ่มเติมหรือไม่
        if (isset($_FILES['plan_paca_img_img'])) {
            foreach ($_FILES['plan_paca_img_img']['name'] as $index => $name) {
                if (isset($_FILES['plan_paca_img_img']['size'][$index])) {
                    $total_space_required += $_FILES['plan_paca_img_img']['size'][$index];
                }
            }
        }

        // ตรวจสอบว่ามีข้อมูลไฟล์ PDF หรือไม่
        if (isset($_FILES['plan_paca_file_pdf'])) {
            foreach ($_FILES['plan_paca_file_pdf']['name'] as $index => $name) {
                if (isset($_FILES['plan_paca_file_pdf']['size'][$index])) {
                    $total_space_required += $_FILES['plan_paca_file_pdf']['size'][$index];
                }
            }
        }

        // เช็คค่าว่าง
        if ($used_space + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('plan_paca_backend/adding');
            return;
        }

        $imgs_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['plan_paca_img_img']['name'][0])) {
            foreach ($_FILES['plan_paca_img_img']['name'] as $index => $name) {
                $_FILES['plan_paca_img_img_multiple']['name'] = $name;
                $_FILES['plan_paca_img_img_multiple']['type'] = $_FILES['plan_paca_img_img']['type'][$index];
                $_FILES['plan_paca_img_img_multiple']['tmp_name'] = $_FILES['plan_paca_img_img']['tmp_name'][$index];
                $_FILES['plan_paca_img_img_multiple']['error'] = $_FILES['plan_paca_img_img']['error'][$index];
                $_FILES['plan_paca_img_img_multiple']['size'] = $_FILES['plan_paca_img_img']['size'][$index];

                if ($this->img_upload->do_upload('plan_paca_img_img_multiple')) {
                    $upload_data = $this->img_upload->data();
                    $imgs_data[] = array(
                        'plan_paca_img_ref_id' => $plan_paca_id,
                        'plan_paca_img_img' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_plan_paca_img', $imgs_data);
        }

        $pdf_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['plan_paca_file_pdf']['name'][0])) {
            foreach ($_FILES['plan_paca_file_pdf']['name'] as $index => $name) {
                $_FILES['plan_paca_file_pdf_multiple']['name'] = $name;
                $_FILES['plan_paca_file_pdf_multiple']['type'] = $_FILES['plan_paca_file_pdf']['type'][$index];
                $_FILES['plan_paca_file_pdf_multiple']['tmp_name'] = $_FILES['plan_paca_file_pdf']['tmp_name'][$index];
                $_FILES['plan_paca_file_pdf_multiple']['error'] = $_FILES['plan_paca_file_pdf']['error'][$index];
                $_FILES['plan_paca_file_pdf_multiple']['size'] = $_FILES['plan_paca_file_pdf']['size'][$index];

                if ($this->pdf_upload->do_upload('plan_paca_file_pdf_multiple')) {
                    $upload_data = $this->pdf_upload->data();
                    $pdf_data[] = array(
                        'plan_paca_file_ref_id' => $plan_paca_id,
                        'plan_paca_file_pdf' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_plan_paca_file', $pdf_data);
        }
        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }

    public function list_all()
    {
        $this->db->select('*');
        $this->db->from('tbl_plan_paca');
        $this->db->group_by('tbl_plan_paca.plan_paca_id');
        $this->db->order_by('tbl_plan_paca.plan_paca_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function list_all_pdf($plan_paca_id)
    {
        $this->db->select('plan_paca_file_pdf');
        $this->db->from('tbl_plan_paca_file');
        $this->db->where('plan_paca_file_ref_id', $plan_paca_id);
        return $this->db->get()->result();
    }

    //show form edit
    public function read($plan_paca_id)
    {
        $this->db->where('plan_paca_id', $plan_paca_id);
        $query = $this->db->get('tbl_plan_paca');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function read_file($plan_paca_id)
    {
        $this->db->where('plan_paca_file_ref_id', $plan_paca_id);
        $this->db->order_by('plan_paca_file_id', 'DESC');
        $query = $this->db->get('tbl_plan_paca_file');
        return $query->result();
    }

    public function read_img($plan_paca_id)
    {
        $this->db->where('plan_paca_img_ref_id', $plan_paca_id);
        $this->db->order_by('plan_paca_img_id', 'DESC');
        $query = $this->db->get('tbl_plan_paca_img');
        return $query->result();
    }

    public function del_pdf($file_id)
    {
        // ดึงชื่อไฟล์ PDF จากฐานข้อมูลโดยใช้ $file_id
        $this->db->select('plan_paca_file_pdf');
        $this->db->where('plan_paca_file_id', $file_id);
        $query = $this->db->get('tbl_plan_paca_file');
        $file_data = $query->row();

        // ลบไฟล์จากแหล่งที่เก็บไฟล์ (อาจต้องใช้ unlink หรือวิธีอื่น)
        $file_path = './docs/file/' . $file_data->plan_paca_file_pdf;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // ลบข้อมูลของไฟล์จากฐานข้อมูล
        $this->db->where('plan_paca_file_id', $file_id);
        $this->db->delete('tbl_plan_paca_file');
    }

    public function del_img($file_id)
    {
        // ดึงชื่อไฟล์ PDF จากฐานข้อมูลโดยใช้ $file_id
        $this->db->select('plan_paca_img_img');
        $this->db->where('plan_paca_img_id', $file_id);
        $query = $this->db->get('tbl_plan_paca_img');
        $file_data = $query->row();

        // ลบไฟล์จากแหล่งที่เก็บไฟล์ (อาจต้องใช้ unlink หรือวิธีอื่น)
        $file_path = './docs/img/' . $file_data->plan_paca_img_img;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // ลบข้อมูลของไฟล์จากฐานข้อมูล
        $this->db->where('plan_paca_img_id', $file_id);
        $this->db->delete('tbl_plan_paca_img');
        $this->space_model->update_server_current();
        $this->session->set_flashdata('del_success', TRUE);
    }


    public function edit($plan_paca_id)
    {
        // Update plan_paca information
        $data = array(
            'plan_paca_name' => $this->input->post('plan_paca_name'),
            'plan_paca_detail' => $this->input->post('plan_paca_detail'),
            'plan_paca_date' => $this->input->post('plan_paca_date'),
            'plan_paca_link' => $this->input->post('plan_paca_link'),
            'plan_paca_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
        );

        $this->db->where('plan_paca_id', $plan_paca_id);
        $this->db->update('tbl_plan_paca', $data);

        // หาพื้นที่ว่าง และอัพโหลดlimit จากฐานข้อมูล
        $used_space = $this->space_model->get_used_space();
        $upload_limit = $this->space_model->get_limit_storage();

        $total_space_required = 0;
        // ตรวจสอบว่ามีข้อมูลรูปภาพเพิ่มเติมหรือไม่
        if (isset($_FILES['plan_paca_img_img'])) {
            foreach ($_FILES['plan_paca_img_img']['name'] as $index => $name) {
                if (isset($_FILES['plan_paca_img_img']['size'][$index])) {
                    $total_space_required += $_FILES['plan_paca_img_img']['size'][$index];
                }
            }
        }

        // ตรวจสอบว่ามีข้อมูลไฟล์ PDF หรือไม่
        if (isset($_FILES['plan_paca_file_pdf'])) {
            foreach ($_FILES['plan_paca_file_pdf']['name'] as $index => $name) {
                if (isset($_FILES['plan_paca_file_pdf']['size'][$index])) {
                    $total_space_required += $_FILES['plan_paca_file_pdf']['size'][$index];
                }
            }
        }

        // เช็คค่าว่าง
        if ($used_space + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('plan_paca_backend/adding');
            return;
        }

        $pdf_config['upload_path'] = './docs/file';
        $pdf_config['allowed_types'] = 'pdf';
        $this->load->library('upload', $pdf_config, 'pdf_upload');

        $img_config['upload_path'] = './docs/img';
        $img_config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $img_config, 'img_upload');

        // ทำการอัปโหลดรูปภาพ
        $img_main = $this->img_upload->do_upload('plan_paca_img');

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพหรือไม่
        if (!empty($img_main)) {
            $this->db->trans_start(); // เริ่ม Transaction

            // ดึงข้อมูลรูปเก่า
            $old_document = $this->db->get_where('tbl_plan_paca', array('plan_paca_id' => $plan_paca_id))->row();

            // ตรวจสอบว่ามีไฟล์เก่าหรือไม่
            if ($old_document && $old_document->plan_paca_img) {
                $old_file_path = './docs/img/' . $old_document->plan_paca_img;

                if (file_exists($old_file_path)) {
                    unlink($old_file_path); // ลบไฟล์เก่า
                }
            }

            // ถ้ามีการอัปโหลดรูปภาพใหม่
            $img_data['plan_paca_img'] = $this->img_upload->data('file_name');
            $this->db->where('plan_paca_id', $plan_paca_id);
            $this->db->update('tbl_plan_paca', $img_data);

            $this->db->trans_complete(); // สิ้นสุด Transaction
        }

        $imgs_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['plan_paca_img_img']['name'][0])) {

            foreach ($_FILES['plan_paca_img_img']['name'] as $index => $name) {
                $_FILES['plan_paca_img_img_multiple']['name'] = $name;
                $_FILES['plan_paca_img_img_multiple']['type'] = $_FILES['plan_paca_img_img']['type'][$index];
                $_FILES['plan_paca_img_img_multiple']['tmp_name'] = $_FILES['plan_paca_img_img']['tmp_name'][$index];
                $_FILES['plan_paca_img_img_multiple']['error'] = $_FILES['plan_paca_img_img']['error'][$index];
                $_FILES['plan_paca_img_img_multiple']['size'] = $_FILES['plan_paca_img_img']['size'][$index];

                if ($this->img_upload->do_upload('plan_paca_img_img_multiple')) {
                    $upload_data = $this->img_upload->data();
                    $imgs_data[] = array(
                        'plan_paca_img_ref_id' => $plan_paca_id,
                        'plan_paca_img_img' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_plan_paca_img', $imgs_data);
        }

        $pdf_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['plan_paca_file_pdf']['name'][0])) {
            foreach ($_FILES['plan_paca_file_pdf']['name'] as $index => $name) {
                $_FILES['plan_paca_file_pdf_multiple']['name'] = $name;
                $_FILES['plan_paca_file_pdf_multiple']['type'] = $_FILES['plan_paca_file_pdf']['type'][$index];
                $_FILES['plan_paca_file_pdf_multiple']['tmp_name'] = $_FILES['plan_paca_file_pdf']['tmp_name'][$index];
                $_FILES['plan_paca_file_pdf_multiple']['error'] = $_FILES['plan_paca_file_pdf']['error'][$index];
                $_FILES['plan_paca_file_pdf_multiple']['size'] = $_FILES['plan_paca_file_pdf']['size'][$index];

                if ($this->pdf_upload->do_upload('plan_paca_file_pdf_multiple')) {
                    $upload_data = $this->pdf_upload->data();
                    $pdf_data[] = array(
                        'plan_paca_file_ref_id' => $plan_paca_id,
                        'plan_paca_file_pdf' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_plan_paca_file', $pdf_data);
        }
        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }



    public function del_plan_paca($plan_paca_id)
    {
        $old_document = $this->db->get_where('tbl_plan_paca', array('plan_paca_id' => $plan_paca_id))->row();

        $old_file_path = './docs/img/' . $old_document->plan_paca_img;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_plan_paca', array('plan_paca_id' => $plan_paca_id));
        $this->space_model->update_server_current();
    }

    public function del_plan_paca_pdf($plan_paca_id)
    {
        // ดึงข้อมูลรายการรูปภาพก่อน
        $files = $this->db->get_where('tbl_plan_paca_file', array('plan_paca_file_ref_id' => $plan_paca_id))->result();

        // ลบรูปภาพจากตาราง tbl_plan_paca_file
        $this->db->where('plan_paca_file_ref_id', $plan_paca_id);
        $this->db->delete('tbl_plan_paca_file');

        // ลบไฟล์รูปภาพที่เกี่ยวข้อง
        foreach ($files as $files) {
            $file_path = './docs/file/' . $files->plan_paca_file_pdf;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }

    public function del_plan_paca_img($plan_paca_id)
    {
        // ดึงข้อมูลรายการรูปภาพก่อน
        $files = $this->db->get_where('tbl_plan_paca_img', array('plan_paca_img_ref_id' => $plan_paca_id))->result();

        // ลบรูปภาพจากตาราง tbl_plan_paca_file
        $this->db->where('plan_paca_img_ref_id', $plan_paca_id);
        $this->db->delete('tbl_plan_paca_img');

        // ลบไฟล์รูปภาพที่เกี่ยวข้อง
        foreach ($files as $files) {
            $file_path = './docs/img/' . $files->plan_paca_img_img;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }

    public function update_plan_paca_status()
    {
        // ตรวจสอบว่ามีการส่งข้อมูล POST มาหรือไม่
        if ($this->input->post()) {
            $plan_pacaId = $this->input->post('plan_paca_id'); // รับค่า plan_paca_id
            $newStatus = $this->input->post('new_status'); // รับค่าใหม่จาก switch checkbox

            // ทำการอัพเดตค่าในตาราง tbl_plan_paca ในฐานข้อมูลของคุณ
            $data = array(
                'plan_paca_status' => $newStatus
            );
            $this->db->where('plan_paca_id', $plan_pacaId); // ระบุ plan_paca_id ของแถวที่ต้องการอัพเดต
            $this->db->update('tbl_plan_paca', $data);

            // ส่งการตอบกลับ (response) กลับไปยังเว็บไซต์หรือแอพพลิเคชันของคุณ
            // โดยเช่นปกติคุณอาจส่ง JSON response กลับมาเพื่ออัพเดตหน้าเว็บ
            $response = array('status' => 'success', 'message' => 'อัพเดตสถานะเรียบร้อย');
            echo json_encode($response);
        } else {
            // ถ้าไม่มีข้อมูล POST ส่งมา ให้รีเดอร์เปรียบเสมอ
            show_404();
        }
    }

    public function plan_paca_frontend()
    {
        $this->db->select('*');
        $this->db->from('tbl_plan_paca');
        $this->db->where('tbl_plan_paca.plan_paca_status', 'show');
        $this->db->order_by('tbl_plan_paca.plan_paca_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function increment_view($plan_paca_id)
    {
        $this->db->where('plan_paca_id', $plan_paca_id);
        $this->db->set('plan_paca_view', 'plan_paca_view + 1', false); // บวกค่า plan_paca_view ทีละ 1
        $this->db->update('tbl_plan_paca');
    }
    // ใน plan_paca_model
    public function increment_download_plan_paca($plan_paca_file_id)
    {
        $this->db->where('plan_paca_file_id', $plan_paca_file_id);
        $this->db->set('plan_paca_file_download', 'plan_paca_file_download + 1', false); // บวกค่า plan_paca_download ทีละ 1
        $this->db->update('tbl_plan_paca_file');
    }
}
