<?php
class Mptae_model extends CI_Model
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


        // กำหนดค่าใน $mptae_data
        $mptae_data = array(
            'mptae_name' => $this->input->post('mptae_name'),
            'mptae_detail' => $this->input->post('mptae_detail'),
            'mptae_date' => $this->input->post('mptae_date'),
            'mptae_link' => $this->input->post('mptae_link'),
            'mptae_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
        );

        // ทำการอัปโหลดรูปภาพ
        $img_main = $this->img_upload->do_upload('mptae_img');
        // ตรวจสอบว่ามีการอัปโหลดรูปภาพหรือไม่
        if (!empty($img_main)) {
            // ถ้ามีการอัปโหลดรูปภาพ
            $mptae_data['mptae_img'] = $this->img_upload->data('file_name');
        } // else {
        //     // ถ้าไม่มีการอัปโหลดรูปภาพ ให้ใช้รูปภาพ default
        //     $mptae_data['mptae_img'] = 'coverphoto.png';
        // }
        // เพิ่มข้อมูลลงในฐานข้อมูล
        $this->db->insert('tbl_mptae', $mptae_data);
        $mptae_id = $this->db->insert_id();

        // หาพื้นที่ว่าง และอัพโหลดlimit จากฐานข้อมูล
        $used_space = $this->space_model->get_used_space();
        $upload_limit = $this->space_model->get_limit_storage();

        $total_space_required = 0;
        // ตรวจสอบว่ามีข้อมูลรูปภาพเพิ่มเติมหรือไม่
        if (isset($_FILES['mptae_img_img'])) {
            foreach ($_FILES['mptae_img_img']['name'] as $index => $name) {
                if (isset($_FILES['mptae_img_img']['size'][$index])) {
                    $total_space_required += $_FILES['mptae_img_img']['size'][$index];
                }
            }
        }

        // ตรวจสอบว่ามีข้อมูลไฟล์ PDF หรือไม่
        if (isset($_FILES['mptae_file_pdf'])) {
            foreach ($_FILES['mptae_file_pdf']['name'] as $index => $name) {
                if (isset($_FILES['mptae_file_pdf']['size'][$index])) {
                    $total_space_required += $_FILES['mptae_file_pdf']['size'][$index];
                }
            }
        }

        // เช็คค่าว่าง
        if ($used_space + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('mptae_backend/adding');
            return;
        }

        $imgs_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['mptae_img_img']['name'][0])) {
            foreach ($_FILES['mptae_img_img']['name'] as $index => $name) {
                $_FILES['mptae_img_img_multiple']['name'] = $name;
                $_FILES['mptae_img_img_multiple']['type'] = $_FILES['mptae_img_img']['type'][$index];
                $_FILES['mptae_img_img_multiple']['tmp_name'] = $_FILES['mptae_img_img']['tmp_name'][$index];
                $_FILES['mptae_img_img_multiple']['error'] = $_FILES['mptae_img_img']['error'][$index];
                $_FILES['mptae_img_img_multiple']['size'] = $_FILES['mptae_img_img']['size'][$index];

                if ($this->img_upload->do_upload('mptae_img_img_multiple')) {
                    $upload_data = $this->img_upload->data();
                    $imgs_data[] = array(
                        'mptae_img_ref_id' => $mptae_id,
                        'mptae_img_img' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_mptae_img', $imgs_data);
        }

        $pdf_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['mptae_file_pdf']['name'][0])) {
            foreach ($_FILES['mptae_file_pdf']['name'] as $index => $name) {
                $_FILES['mptae_file_pdf_multiple']['name'] = $name;
                $_FILES['mptae_file_pdf_multiple']['type'] = $_FILES['mptae_file_pdf']['type'][$index];
                $_FILES['mptae_file_pdf_multiple']['tmp_name'] = $_FILES['mptae_file_pdf']['tmp_name'][$index];
                $_FILES['mptae_file_pdf_multiple']['error'] = $_FILES['mptae_file_pdf']['error'][$index];
                $_FILES['mptae_file_pdf_multiple']['size'] = $_FILES['mptae_file_pdf']['size'][$index];

                if ($this->pdf_upload->do_upload('mptae_file_pdf_multiple')) {
                    $upload_data = $this->pdf_upload->data();
                    $pdf_data[] = array(
                        'mptae_file_ref_id' => $mptae_id,
                        'mptae_file_pdf' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_mptae_file', $pdf_data);
        }
        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }

    public function list_all()
    {
        $this->db->select('*');
        $this->db->from('tbl_mptae');
        $this->db->group_by('tbl_mptae.mptae_id');
        $this->db->order_by('tbl_mptae.mptae_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function list_all_pdf($mptae_id)
    {
        $this->db->select('mptae_file_pdf');
        $this->db->from('tbl_mptae_file');
        $this->db->where('mptae_file_ref_id', $mptae_id);
        return $this->db->get()->result();
    }

    //show form edit
    public function read($mptae_id)
    {
        $this->db->where('mptae_id', $mptae_id);
        $query = $this->db->get('tbl_mptae');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function read_file($mptae_id)
    {
        $this->db->where('mptae_file_ref_id', $mptae_id);
        $this->db->order_by('mptae_file_id', 'DESC');
        $query = $this->db->get('tbl_mptae_file');
        return $query->result();
    }

    public function read_img($mptae_id)
    {
        $this->db->where('mptae_img_ref_id', $mptae_id);
        $this->db->order_by('mptae_img_id', 'DESC');
        $query = $this->db->get('tbl_mptae_img');
        return $query->result();
    }

    public function del_pdf($file_id)
    {
        // ดึงชื่อไฟล์ PDF จากฐานข้อมูลโดยใช้ $file_id
        $this->db->select('mptae_file_pdf');
        $this->db->where('mptae_file_id', $file_id);
        $query = $this->db->get('tbl_mptae_file');
        $file_data = $query->row();

        // ลบไฟล์จากแหล่งที่เก็บไฟล์ (อาจต้องใช้ unlink หรือวิธีอื่น)
        $file_path = './docs/file/' . $file_data->mptae_file_pdf;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // ลบข้อมูลของไฟล์จากฐานข้อมูล
        $this->db->where('mptae_file_id', $file_id);
        $this->db->delete('tbl_mptae_file');
    }

    public function del_img($file_id)
    {
        // ดึงชื่อไฟล์ PDF จากฐานข้อมูลโดยใช้ $file_id
        $this->db->select('mptae_img_img');
        $this->db->where('mptae_img_id', $file_id);
        $query = $this->db->get('tbl_mptae_img');
        $file_data = $query->row();

        // ลบไฟล์จากแหล่งที่เก็บไฟล์ (อาจต้องใช้ unlink หรือวิธีอื่น)
        $file_path = './docs/img/' . $file_data->mptae_img_img;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // ลบข้อมูลของไฟล์จากฐานข้อมูล
        $this->db->where('mptae_img_id', $file_id);
        $this->db->delete('tbl_mptae_img');
        $this->space_model->update_server_current();
        $this->session->set_flashdata('del_success', TRUE);
    }


    public function edit($mptae_id)
    {
        // Update mptae information
        $data = array(
            'mptae_name' => $this->input->post('mptae_name'),
            'mptae_detail' => $this->input->post('mptae_detail'),
            'mptae_date' => $this->input->post('mptae_date'),
            'mptae_link' => $this->input->post('mptae_link'),
            'mptae_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
        );

        $this->db->where('mptae_id', $mptae_id);
        $this->db->update('tbl_mptae', $data);

        // หาพื้นที่ว่าง และอัพโหลดlimit จากฐานข้อมูล
        $used_space = $this->space_model->get_used_space();
        $upload_limit = $this->space_model->get_limit_storage();

        $total_space_required = 0;
        // ตรวจสอบว่ามีข้อมูลรูปภาพเพิ่มเติมหรือไม่
        if (isset($_FILES['mptae_img_img'])) {
            foreach ($_FILES['mptae_img_img']['name'] as $index => $name) {
                if (isset($_FILES['mptae_img_img']['size'][$index])) {
                    $total_space_required += $_FILES['mptae_img_img']['size'][$index];
                }
            }
        }

        // ตรวจสอบว่ามีข้อมูลไฟล์ PDF หรือไม่
        if (isset($_FILES['mptae_file_pdf'])) {
            foreach ($_FILES['mptae_file_pdf']['name'] as $index => $name) {
                if (isset($_FILES['mptae_file_pdf']['size'][$index])) {
                    $total_space_required += $_FILES['mptae_file_pdf']['size'][$index];
                }
            }
        }

        // เช็คค่าว่าง
        if ($used_space + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('mptae_backend/adding');
            return;
        }

        $pdf_config['upload_path'] = './docs/file';
        $pdf_config['allowed_types'] = 'pdf';
        $this->load->library('upload', $pdf_config, 'pdf_upload');

        $img_config['upload_path'] = './docs/img';
        $img_config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $img_config, 'img_upload');

        // ทำการอัปโหลดรูปภาพ
        $img_main = $this->img_upload->do_upload('mptae_img');

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพหรือไม่
        if (!empty($img_main)) {
            $this->db->trans_start(); // เริ่ม Transaction

            // ดึงข้อมูลรูปเก่า
            $old_document = $this->db->get_where('tbl_mptae', array('mptae_id' => $mptae_id))->row();

            // ตรวจสอบว่ามีไฟล์เก่าหรือไม่
            if ($old_document && $old_document->mptae_img) {
                $old_file_path = './docs/img/' . $old_document->mptae_img;

                if (file_exists($old_file_path)) {
                    unlink($old_file_path); // ลบไฟล์เก่า
                }
            }

            // ถ้ามีการอัปโหลดรูปภาพใหม่
            $img_data['mptae_img'] = $this->img_upload->data('file_name');
            $this->db->where('mptae_id', $mptae_id);
            $this->db->update('tbl_mptae', $img_data);

            $this->db->trans_complete(); // สิ้นสุด Transaction
        }

        $imgs_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['mptae_img_img']['name'][0])) {

            foreach ($_FILES['mptae_img_img']['name'] as $index => $name) {
                $_FILES['mptae_img_img_multiple']['name'] = $name;
                $_FILES['mptae_img_img_multiple']['type'] = $_FILES['mptae_img_img']['type'][$index];
                $_FILES['mptae_img_img_multiple']['tmp_name'] = $_FILES['mptae_img_img']['tmp_name'][$index];
                $_FILES['mptae_img_img_multiple']['error'] = $_FILES['mptae_img_img']['error'][$index];
                $_FILES['mptae_img_img_multiple']['size'] = $_FILES['mptae_img_img']['size'][$index];

                if ($this->img_upload->do_upload('mptae_img_img_multiple')) {
                    $upload_data = $this->img_upload->data();
                    $imgs_data[] = array(
                        'mptae_img_ref_id' => $mptae_id,
                        'mptae_img_img' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_mptae_img', $imgs_data);
        }

        $pdf_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['mptae_file_pdf']['name'][0])) {
            foreach ($_FILES['mptae_file_pdf']['name'] as $index => $name) {
                $_FILES['mptae_file_pdf_multiple']['name'] = $name;
                $_FILES['mptae_file_pdf_multiple']['type'] = $_FILES['mptae_file_pdf']['type'][$index];
                $_FILES['mptae_file_pdf_multiple']['tmp_name'] = $_FILES['mptae_file_pdf']['tmp_name'][$index];
                $_FILES['mptae_file_pdf_multiple']['error'] = $_FILES['mptae_file_pdf']['error'][$index];
                $_FILES['mptae_file_pdf_multiple']['size'] = $_FILES['mptae_file_pdf']['size'][$index];

                if ($this->pdf_upload->do_upload('mptae_file_pdf_multiple')) {
                    $upload_data = $this->pdf_upload->data();
                    $pdf_data[] = array(
                        'mptae_file_ref_id' => $mptae_id,
                        'mptae_file_pdf' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_mptae_file', $pdf_data);
        }
        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }



    public function del_mptae($mptae_id)
    {
        $old_document = $this->db->get_where('tbl_mptae', array('mptae_id' => $mptae_id))->row();

        $old_file_path = './docs/img/' . $old_document->mptae_img;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_mptae', array('mptae_id' => $mptae_id));
        $this->space_model->update_server_current();
    }

    public function del_mptae_pdf($mptae_id)
    {
        // ดึงข้อมูลรายการรูปภาพก่อน
        $files = $this->db->get_where('tbl_mptae_file', array('mptae_file_ref_id' => $mptae_id))->result();

        // ลบรูปภาพจากตาราง tbl_mptae_file
        $this->db->where('mptae_file_ref_id', $mptae_id);
        $this->db->delete('tbl_mptae_file');

        // ลบไฟล์รูปภาพที่เกี่ยวข้อง
        foreach ($files as $files) {
            $file_path = './docs/file/' . $files->mptae_file_pdf;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }

    public function del_mptae_img($mptae_id)
    {
        // ดึงข้อมูลรายการรูปภาพก่อน
        $files = $this->db->get_where('tbl_mptae_img', array('mptae_img_ref_id' => $mptae_id))->result();

        // ลบรูปภาพจากตาราง tbl_mptae_file
        $this->db->where('mptae_img_ref_id', $mptae_id);
        $this->db->delete('tbl_mptae_img');

        // ลบไฟล์รูปภาพที่เกี่ยวข้อง
        foreach ($files as $files) {
            $file_path = './docs/img/' . $files->mptae_img_img;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }

    public function update_mptae_status()
    {
        // ตรวจสอบว่ามีการส่งข้อมูล POST มาหรือไม่
        if ($this->input->post()) {
            $mptaeId = $this->input->post('mptae_id'); // รับค่า mptae_id
            $newStatus = $this->input->post('new_status'); // รับค่าใหม่จาก switch checkbox

            // ทำการอัพเดตค่าในตาราง tbl_mptae ในฐานข้อมูลของคุณ
            $data = array(
                'mptae_status' => $newStatus
            );
            $this->db->where('mptae_id', $mptaeId); // ระบุ mptae_id ของแถวที่ต้องการอัพเดต
            $this->db->update('tbl_mptae', $data);

            // ส่งการตอบกลับ (response) กลับไปยังเว็บไซต์หรือแอพพลิเคชันของคุณ
            // โดยเช่นปกติคุณอาจส่ง JSON response กลับมาเพื่ออัพเดตหน้าเว็บ
            $response = array('status' => 'success', 'message' => 'อัพเดตสถานะเรียบร้อย');
            echo json_encode($response);
        } else {
            // ถ้าไม่มีข้อมูล POST ส่งมา ให้รีเดอร์เปรียบเสมอ
            show_404();
        }
    }

    public function mptae_frontend()
    {
        $this->db->select('*');
        $this->db->from('tbl_mptae');
        $this->db->where('tbl_mptae.mptae_status', 'show');
        $this->db->order_by('tbl_mptae.mptae_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function mptae_frontend_list()
    {
        $this->db->select('*');
        $this->db->from('tbl_mptae');
        $this->db->where('tbl_mptae.mptae_status', 'show');
        $this->db->order_by('tbl_mptae.mptae_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function increment_view($mptae_id)
    {
        $this->db->where('mptae_id', $mptae_id);
        $this->db->set('mptae_view', 'mptae_view + 1', false); // บวกค่า mptae_view ทีละ 1
        $this->db->update('tbl_mptae');
    }
    // ใน mptae_model
    public function increment_download_mptae($mptae_file_id)
    {
        $this->db->where('mptae_file_id', $mptae_file_id);
        $this->db->set('mptae_file_download', 'mptae_file_download + 1', false); // บวกค่า mptae_download ทีละ 1
        $this->db->update('tbl_mptae_file');
    }
}
