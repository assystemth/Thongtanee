<?php
class Operation_cdm_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    public function add_type()
    {

        $data = array(
            'operation_cdm_type_name' => $this->input->post('operation_cdm_type_name'),
            'operation_cdm_type_date' => $this->input->post('operation_cdm_type_date'),
            'operation_cdm_type_by' => $this->session->userdata('m_fname'),
        );

        $query = $this->db->insert('tbl_operation_cdm_type', $data);

        $this->space_model->update_server_current();

        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('Error !');";
            echo "</script>";
        }
    }

    public function edit_type($operation_cdm_type_id)
    {

        $data = array(
            'operation_cdm_type_name' => $this->input->post('operation_cdm_type_name'),
            'operation_cdm_type_date' => $this->input->post('operation_cdm_type_date'),
            'operation_cdm_type_by' => $this->session->userdata('m_fname'),
        );

        $this->db->where('operation_cdm_type_id', $operation_cdm_type_id);
        $this->db->update('tbl_operation_cdm_type', $data);

        $this->space_model->update_server_current();

        if ($data) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('Error !');";
            echo "</script>";
        }
    }

    public function list_type()
    {
        $this->db->select('*');
        $this->db->from('tbl_operation_cdm_type');
        $this->db->group_by('tbl_operation_cdm_type.operation_cdm_type_id');
        $this->db->order_by('tbl_operation_cdm_type.operation_cdm_type_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function list_operation_cdm_type()
    {
        $this->db->order_by('operation_cdm_type_id', 'DESC');
        $query = $this->db->get('tbl_operation_cdm_type');
        return $query->result();
    }


    public function add()
    {
        // Configure PDF upload
        $pdf_config['upload_path'] = './docs/file';
        $pdf_config['allowed_types'] = 'pdf';
        $this->load->library('upload', $pdf_config, 'pdf_upload');

        // // Configure image upload
        // $img_config['upload_path'] = './docs/img';
        // $img_config['allowed_types'] = 'gif|jpg|png|jpeg';
        // $this->load->library('upload', $img_config, 'img_upload');


        // กำหนดค่าใน $operation_cdm_data
        $operation_cdm_data = array(
            'operation_cdm_ref_id' => $this->input->post('operation_cdm_ref_id'),
            'operation_cdm_name' => $this->input->post('operation_cdm_name'),
            'operation_cdm_detail' => $this->input->post('operation_cdm_detail'),
            'operation_cdm_date' => $this->input->post('operation_cdm_date'),
            'operation_cdm_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
        );

        // // ทำการอัปโหลดรูปภาพ
        // $img_main = $this->img_upload->do_upload('operation_cdm_img');
        // // ตรวจสอบว่ามีการอัปโหลดรูปภาพหรือไม่
        // if (!empty($img_main)) {
        //     // ถ้ามีการอัปโหลดรูปภาพ
        //     $operation_cdm_data['operation_cdm_img'] = $this->img_upload->data('file_name');
        // } // else {
        // //     // ถ้าไม่มีการอัปโหลดรูปภาพ ให้ใช้รูปภาพ default
        // //     $operation_cdm_data['operation_cdm_img'] = 'coverphoto.png';
        // // }
        // // เพิ่มข้อมูลลงในฐานข้อมูล
        $this->db->insert('tbl_operation_cdm', $operation_cdm_data);
        $operation_cdm_id = $this->db->insert_id();

        // หาพื้นที่ว่าง และอัพโหลดlimit จากฐานข้อมูล
        $used_space = $this->space_model->get_used_space();
        $upload_limit = $this->space_model->get_limit_storage();

        $total_space_required = 0;
        // // ตรวจสอบว่ามีข้อมูลรูปภาพเพิ่มเติมหรือไม่
        // if (isset($_FILES['operation_cdm_img_img'])) {
        //     foreach ($_FILES['operation_cdm_img_img']['name'] as $index => $name) {
        //         if (isset($_FILES['operation_cdm_img_img']['size'][$index])) {
        //             $total_space_required += $_FILES['operation_cdm_img_img']['size'][$index];
        //         }
        //     }
        // }

        // ตรวจสอบว่ามีข้อมูลไฟล์ PDF หรือไม่
        if (isset($_FILES['operation_cdm_file_pdf'])) {
            foreach ($_FILES['operation_cdm_file_pdf']['name'] as $index => $name) {
                if (isset($_FILES['operation_cdm_file_pdf']['size'][$index])) {
                    $total_space_required += $_FILES['operation_cdm_file_pdf']['size'][$index];
                }
            }
        }

        // เช็คค่าว่าง
        if ($used_space + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('operation_cdm_backend/adding');
            return;
        }

        // $imgs_data = array();

        // // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        // if (!empty($_FILES['operation_cdm_img_img']['name'][0])) {
        //     foreach ($_FILES['operation_cdm_img_img']['name'] as $index => $name) {
        //         $_FILES['operation_cdm_img_img_multiple']['name'] = $name;
        //         $_FILES['operation_cdm_img_img_multiple']['type'] = $_FILES['operation_cdm_img_img']['type'][$index];
        //         $_FILES['operation_cdm_img_img_multiple']['tmp_name'] = $_FILES['operation_cdm_img_img']['tmp_name'][$index];
        //         $_FILES['operation_cdm_img_img_multiple']['error'] = $_FILES['operation_cdm_img_img']['error'][$index];
        //         $_FILES['operation_cdm_img_img_multiple']['size'] = $_FILES['operation_cdm_img_img']['size'][$index];

        //         if ($this->img_upload->do_upload('operation_cdm_img_img_multiple')) {
        //             $upload_data = $this->img_upload->data();
        //             $imgs_data[] = array(
        //                 'operation_cdm_img_ref_id' => $operation_cdm_id,
        //                 'operation_cdm_img_img' => $upload_data['file_name']
        //             );
        //         }
        //     }
        //     $this->db->insert_batch('tbl_operation_cdm_img', $imgs_data);
        // }

        $pdf_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['operation_cdm_file_pdf']['name'][0])) {
            foreach ($_FILES['operation_cdm_file_pdf']['name'] as $index => $name) {
                $_FILES['operation_cdm_file_pdf_multiple']['name'] = $name;
                $_FILES['operation_cdm_file_pdf_multiple']['type'] = $_FILES['operation_cdm_file_pdf']['type'][$index];
                $_FILES['operation_cdm_file_pdf_multiple']['tmp_name'] = $_FILES['operation_cdm_file_pdf']['tmp_name'][$index];
                $_FILES['operation_cdm_file_pdf_multiple']['error'] = $_FILES['operation_cdm_file_pdf']['error'][$index];
                $_FILES['operation_cdm_file_pdf_multiple']['size'] = $_FILES['operation_cdm_file_pdf']['size'][$index];

                if ($this->pdf_upload->do_upload('operation_cdm_file_pdf_multiple')) {
                    $upload_data = $this->pdf_upload->data();
                    $pdf_data[] = array(
                        'operation_cdm_file_ref_id' => $operation_cdm_id,
                        'operation_cdm_file_pdf' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_operation_cdm_file', $pdf_data);
        }
        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }

    public function list_all($operation_cdm_type_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_operation_cdm');
        $this->db->join('tbl_operation_cdm_type', 'tbl_operation_cdm.operation_cdm_ref_id = tbl_operation_cdm_type.operation_cdm_type_id', 'inner'); // เปลี่ยนเป็น INNER JOIN
        $this->db->where('tbl_operation_cdm_type.operation_cdm_type_id', $operation_cdm_type_id);
        $query = $this->db->get();
        return $query->result();
    }


    public function list_all_pdf($operation_cdm_id)
    {
        $this->db->select('operation_cdm_file_pdf');
        $this->db->from('tbl_operation_cdm_file');
        $this->db->where('operation_cdm_file_ref_id', $operation_cdm_id);
        return $this->db->get()->result();
    }

    //show form edit
    public function read_type($operation_cdm_id)
    {
        $this->db->where('operation_cdm_type_id', $operation_cdm_id);
        $query = $this->db->get('tbl_operation_cdm_type');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function read($operation_cdm_id)
    {
        $this->db->select('m.*,t.operation_cdm_type_name');
        $this->db->from('tbl_operation_cdm as m');
        $this->db->join('tbl_operation_cdm_type as t', 'm.operation_cdm_ref_id=t.operation_cdm_type_id');
        $this->db->where('m.operation_cdm_id', $operation_cdm_id);
        $query = $this->db->get('tbl_operation_cdm');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function read_file($operation_cdm_id)
    {
        $this->db->where('operation_cdm_file_ref_id', $operation_cdm_id);
        $this->db->order_by('operation_cdm_file_id', 'DESC');
        $query = $this->db->get('tbl_operation_cdm_file');
        return $query->result();
    }

    public function read_img($operation_cdm_id)
    {
        $this->db->where('operation_cdm_img_ref_id', $operation_cdm_id);
        $this->db->order_by('operation_cdm_img_id', 'DESC');
        $query = $this->db->get('tbl_operation_cdm_img');
        return $query->result();
    }

    public function del_pdf($file_id)
    {
        // ดึงชื่อไฟล์ PDF จากฐานข้อมูลโดยใช้ $file_id
        $this->db->select('operation_cdm_file_pdf');
        $this->db->where('operation_cdm_file_id', $file_id);
        $query = $this->db->get('tbl_operation_cdm_file');
        $file_data = $query->row();

        // ลบไฟล์จากแหล่งที่เก็บไฟล์ (อาจต้องใช้ unlink หรือวิธีอื่น)
        $file_path = './docs/file/' . $file_data->operation_cdm_file_pdf;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // ลบข้อมูลของไฟล์จากฐานข้อมูล
        $this->db->where('operation_cdm_file_id', $file_id);
        $this->db->delete('tbl_operation_cdm_file');
    }

    public function del_img($file_id)
    {
        // ดึงชื่อไฟล์ PDF จากฐานข้อมูลโดยใช้ $file_id
        $this->db->select('operation_cdm_img_img');
        $this->db->where('operation_cdm_img_id', $file_id);
        $query = $this->db->get('tbl_operation_cdm_img');
        $file_data = $query->row();

        // ลบไฟล์จากแหล่งที่เก็บไฟล์ (อาจต้องใช้ unlink หรือวิธีอื่น)
        $file_path = './docs/img/' . $file_data->operation_cdm_img_img;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // ลบข้อมูลของไฟล์จากฐานข้อมูล
        $this->db->where('operation_cdm_img_id', $file_id);
        $this->db->delete('tbl_operation_cdm_img');
        $this->space_model->update_server_current();
        $this->session->set_flashdata('del_success', TRUE);
    }


    public function edit($operation_cdm_id)
    {
        // Update operation_cdm information
        $data = array(
            'operation_cdm_ref_id' => $this->input->post('operation_cdm_ref_id'),
            'operation_cdm_name' => $this->input->post('operation_cdm_name'),
            'operation_cdm_detail' => $this->input->post('operation_cdm_detail'),
            'operation_cdm_date' => $this->input->post('operation_cdm_date'),
            'operation_cdm_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
        );

        $this->db->where('operation_cdm_id', $operation_cdm_id);
        $this->db->update('tbl_operation_cdm', $data);

        // หาพื้นที่ว่าง และอัพโหลดlimit จากฐานข้อมูล
        $used_space = $this->space_model->get_used_space();
        $upload_limit = $this->space_model->get_limit_storage();

        $total_space_required = 0;
        // ตรวจสอบว่ามีข้อมูลรูปภาพเพิ่มเติมหรือไม่
        if (isset($_FILES['operation_cdm_img_img'])) {
            foreach ($_FILES['operation_cdm_img_img']['name'] as $index => $name) {
                if (isset($_FILES['operation_cdm_img_img']['size'][$index])) {
                    $total_space_required += $_FILES['operation_cdm_img_img']['size'][$index];
                }
            }
        }

        // ตรวจสอบว่ามีข้อมูลไฟล์ PDF หรือไม่
        if (isset($_FILES['operation_cdm_file_pdf'])) {
            foreach ($_FILES['operation_cdm_file_pdf']['name'] as $index => $name) {
                if (isset($_FILES['operation_cdm_file_pdf']['size'][$index])) {
                    $total_space_required += $_FILES['operation_cdm_file_pdf']['size'][$index];
                }
            }
        }

        // เช็คค่าว่าง
        if ($used_space + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('operation_cdm_backend/adding');
            return;
        }

        $pdf_config['upload_path'] = './docs/file';
        $pdf_config['allowed_types'] = 'pdf';
        $this->load->library('upload', $pdf_config, 'pdf_upload');

        $img_config['upload_path'] = './docs/img';
        $img_config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $img_config, 'img_upload');

        // ทำการอัปโหลดรูปภาพ
        $img_main = $this->img_upload->do_upload('operation_cdm_img');

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพหรือไม่
        if (!empty($img_main)) {
            $this->db->trans_start(); // เริ่ม Transaction

            // ดึงข้อมูลรูปเก่า
            $old_document = $this->db->get_where('tbl_operation_cdm', array('operation_cdm_id' => $operation_cdm_id))->row();

            // ตรวจสอบว่ามีไฟล์เก่าหรือไม่
            if ($old_document && $old_document->operation_cdm_img) {
                $old_file_path = './docs/img/' . $old_document->operation_cdm_img;

                if (file_exists($old_file_path)) {
                    unlink($old_file_path); // ลบไฟล์เก่า
                }
            }

            // ถ้ามีการอัปโหลดรูปภาพใหม่
            $img_data['operation_cdm_img'] = $this->img_upload->data('file_name');
            $this->db->where('operation_cdm_id', $operation_cdm_id);
            $this->db->update('tbl_operation_cdm', $img_data);

            $this->db->trans_complete(); // สิ้นสุด Transaction
        }

        $imgs_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['operation_cdm_img_img']['name'][0])) {

            foreach ($_FILES['operation_cdm_img_img']['name'] as $index => $name) {
                $_FILES['operation_cdm_img_img_multiple']['name'] = $name;
                $_FILES['operation_cdm_img_img_multiple']['type'] = $_FILES['operation_cdm_img_img']['type'][$index];
                $_FILES['operation_cdm_img_img_multiple']['tmp_name'] = $_FILES['operation_cdm_img_img']['tmp_name'][$index];
                $_FILES['operation_cdm_img_img_multiple']['error'] = $_FILES['operation_cdm_img_img']['error'][$index];
                $_FILES['operation_cdm_img_img_multiple']['size'] = $_FILES['operation_cdm_img_img']['size'][$index];

                if ($this->img_upload->do_upload('operation_cdm_img_img_multiple')) {
                    $upload_data = $this->img_upload->data();
                    $imgs_data[] = array(
                        'operation_cdm_img_ref_id' => $operation_cdm_id,
                        'operation_cdm_img_img' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_operation_cdm_img', $imgs_data);
        }

        $pdf_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['operation_cdm_file_pdf']['name'][0])) {
            foreach ($_FILES['operation_cdm_file_pdf']['name'] as $index => $name) {
                $_FILES['operation_cdm_file_pdf_multiple']['name'] = $name;
                $_FILES['operation_cdm_file_pdf_multiple']['type'] = $_FILES['operation_cdm_file_pdf']['type'][$index];
                $_FILES['operation_cdm_file_pdf_multiple']['tmp_name'] = $_FILES['operation_cdm_file_pdf']['tmp_name'][$index];
                $_FILES['operation_cdm_file_pdf_multiple']['error'] = $_FILES['operation_cdm_file_pdf']['error'][$index];
                $_FILES['operation_cdm_file_pdf_multiple']['size'] = $_FILES['operation_cdm_file_pdf']['size'][$index];

                if ($this->pdf_upload->do_upload('operation_cdm_file_pdf_multiple')) {
                    $upload_data = $this->pdf_upload->data();
                    $pdf_data[] = array(
                        'operation_cdm_file_ref_id' => $operation_cdm_id,
                        'operation_cdm_file_pdf' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_operation_cdm_file', $pdf_data);
        }
        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }

    public function del_operation_cdm_type($operation_cdm_type_id)
    {
        $this->db->delete('tbl_operation_cdm_type', array('operation_cdm_type_id' => $operation_cdm_type_id));
        $this->space_model->update_server_current();
    }


    public function del_operation_cdm($operation_cdm_type_id)
    {
        $this->db->delete('tbl_operation_cdm', array('operation_cdm_ref_id' => $operation_cdm_type_id));
        $this->space_model->update_server_current();
    }

    public function del_operation_cdm_pdf($operation_cdm_type_id)
    {
        $operation_cdm_ids = $this->get_operation_cdm_id($operation_cdm_type_id);

        if ($operation_cdm_ids) {
            // แปลง array เป็น string โดยคั่นด้วย ','
            $operation_cdm_ids_string = implode(',', $operation_cdm_ids);

            // สร้าง SQL query โดยใส่ ' รอบแต่ละค่า
            $sql = "SELECT * FROM `tbl_operation_cdm_file` WHERE operation_cdm_file_ref_id IN ($operation_cdm_ids_string)";

            // ดึงข้อมูลรายการรูปภาพที่ต้องการลบ
            $files = $this->db->query($sql)->result();

            // ลบรูปภาพจากตาราง tbl_operation_cdm_file
            $this->db->where_in('operation_cdm_file_ref_id', $operation_cdm_ids);
            $this->db->delete('tbl_operation_cdm_file');

            // ลบไฟล์รูปภาพที่เกี่ยวข้อง
            foreach ($files as $file) {
                $file_path = './docs/file/' . $file->operation_cdm_file_pdf;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
        }
    }

    public function get_operation_cdm_id($operation_cdm_type_id)
    {
        $query = $this->db->select('operation_cdm_id')
            ->from('tbl_operation_cdm')
            ->where('operation_cdm_ref_id', $operation_cdm_type_id)
            ->get();

        if ($query->num_rows() > 0) {
            $result = array();
            foreach ($query->result() as $row) {
                $result[] = $row->operation_cdm_id;
            }
            return $result; // คืน Array ของ operation_cdm_id ทั้งหมด
        } else {
            return null; // หรือค่าที่เหมาะสมเมื่อไม่พบข้อมูล
        }
    }

    public function del_operation_cdm_img($operation_cdm_id)
    {
        // ดึงข้อมูลรายการรูปภาพก่อน
        $files = $this->db->get_where('tbl_operation_cdm_img', array('operation_cdm_img_ref_id' => $operation_cdm_id))->result();

        // ลบรูปภาพจากตาราง tbl_operation_cdm_file
        $this->db->where('operation_cdm_img_ref_id', $operation_cdm_id);
        $this->db->delete('tbl_operation_cdm_img');

        // ลบไฟล์รูปภาพที่เกี่ยวข้อง
        foreach ($files as $files) {
            $file_path = './docs/img/' . $files->operation_cdm_img_img;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }


    public function operation_cdm_topic_frontend()
    {
        $this->db->select('*');
        $this->db->from('tbl_operation_cdm_type');
        $this->db->limit(8);
        $this->db->order_by('tbl_operation_cdm_type.operation_cdm_type_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function operation_cdm_frontend_list_topic()
    {
        $this->db->select('*');
        $this->db->from('tbl_operation_cdm_type');
        $this->db->order_by('tbl_operation_cdm_type.operation_cdm_type_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function operation_cdm_frontend_list($operation_cdm_type_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_operation_cdm');
        $this->db->join('tbl_operation_cdm_type', 'tbl_operation_cdm.operation_cdm_ref_id = tbl_operation_cdm_type.operation_cdm_type_id', 'inner'); // เปลี่ยนเป็น INNER JOIN
        $this->db->where('tbl_operation_cdm_type.operation_cdm_type_id', $operation_cdm_type_id);
        $this->db->where('tbl_operation_cdm.operation_cdm_status', 'show');
        $query = $this->db->get();
        return $query->result();
    }
    public function increment_view($operation_cdm_id)
    {
        $this->db->where('operation_cdm_id', $operation_cdm_id);
        $this->db->set('operation_cdm_view', 'operation_cdm_view + 1', false); // บวกค่า operation_cdm_view ทีละ 1
        $this->db->update('tbl_operation_cdm');
    }
    // ใน operation_cdm_model
    public function increment_download_operation_cdm($operation_cdm_file_id)
    {
        $this->db->where('operation_cdm_file_id', $operation_cdm_file_id);
        $this->db->set('operation_cdm_file_download', 'operation_cdm_file_download + 1', false); // บวกค่า operation_cdm_download ทีละ 1
        $this->db->update('tbl_operation_cdm_file');
    }
}
