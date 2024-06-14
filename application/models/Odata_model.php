<?php
class Odata_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
        $this->load->model('odata_model');
    }

    public function add_odata()
    {
        // ดึงค่าจากฟอร์ม
        $odata_name = $this->input->post('odata_name');

        // ตรวจสอบว่ามีข้อมูลซ้ำหรือไม่
        $duplicate_check = $this->db->get_where('tbl_odata', array('odata_name' => $odata_name));

        if ($duplicate_check->num_rows() > 0) {
            // ถ้ามีข้อมูลซ้ำ
            $this->session->set_flashdata('save_again', TRUE);
        } else {
            // ถ้าไม่มีข้อมูลซ้ำ, ทำการเพิ่มข้อมูล
            $data = array(
                'odata_name' => $odata_name,
                'odata_by' => $this->session->userdata('m_fname'),
            );

            $query = $this->db->insert('tbl_odata', $data);

            $this->space_model->update_server_current();

            if ($query) {
                $this->session->set_flashdata('save_success', TRUE);
            } else {
                echo "<script>";
                echo "alert('Error !');";
                echo "</script>";
            }
        }
    }

    public function list_odata()
    {
        $this->db->order_by('odata_id', 'DESC');
        $query = $this->db->get('tbl_odata');
        return $query->result();
    }

    //show form edit
    public function read($odata_id)
    {
        $this->db->where('odata_id', $odata_id);
        $query = $this->db->get('tbl_odata');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function edit_odata($odata_id)
    {

        $data = array(
            'odata_name' => $this->input->post('odata_name'),
            'odata_by' => $this->session->userdata('m_fname'),
        );

        $this->db->where('odata_id', $odata_id);
        $query = $this->db->update('tbl_odata', $data);

        $this->space_model->update_server_current();


        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล !');";
            echo "</script>";
        }
    }

    public function list_all_odata_sub($odata_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_odata_sub');
        $this->db->join('tbl_odata', 'tbl_odata_sub.odata_sub_ref_id = tbl_odata.odata_id');
        $this->db->where('tbl_odata_sub.odata_sub_ref_id', $odata_id);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function add_odata_sub($odata_sub_ref_id, $odata_sub_name)
    {
        $data = array(
            'odata_sub_ref_id' => $odata_sub_ref_id,
            'odata_sub_name' => $odata_sub_name,
        );

        $this->db->insert('tbl_odata_sub', $data);

        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }
    public function read_odata_sub($odata_sub_id)
    {
        $this->db->where('odata_sub_id', $odata_sub_id);
        $query = $this->db->get('tbl_odata_sub');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }
    public function edit_odata_sub($odata_sub_ref_id, $odata_sub_name, $odata_sub_id)
    {
        $data = array(
            'odata_sub_name' => $odata_sub_name,
            'odata_sub_ref_id' => $odata_sub_ref_id,
        );

        $this->db->where('odata_sub_id', $odata_sub_id);
        $query = $this->db->update('tbl_odata_sub', $data);

        $this->space_model->update_server_current();

        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล !');";
            echo "</script>";
        }
    }

    public function read_odata_sub_file($odata_sub_file_id)
    {
        $this->db->where('odata_sub_file_id', $odata_sub_file_id);
        $query = $this->db->get('tbl_odata_sub_file');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function list_all_odata_sub_file($odata_sub_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_odata_sub_file');
        $this->db->join('tbl_odata_sub', 'tbl_odata_sub_file.odata_sub_file_ref_id = tbl_odata_sub.odata_sub_id');
        $this->db->where('tbl_odata_sub_file.odata_sub_file_ref_id', $odata_sub_id);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function add_odata_sub_file($odata_sub_file_ref_id, $odata_sub_file_name, $uploaded_filename)
    {
        // เตรียมข้อมูลที่จะบันทึกลงฐานข้อมูล
        $data = array(
            'odata_sub_file_ref_id' => $odata_sub_file_ref_id,
            'odata_sub_file_name' => $odata_sub_file_name,
            'odata_sub_file_doc' => $uploaded_filename
        );

        // บันทึกข้อมูลลงฐานข้อมูล
        $this->db->insert('tbl_odata_sub_file', $data);

        // อัปเดตพื้นที่ที่ใช้งานปัจจุบันบนเซิร์ฟเวอร์
        $this->space_model->update_server_current();
    }

    public function edit_odata_sub_file($odata_sub_file_id, $odata_sub_file_ref_id, $odata_sub_file_name, $odata_sub_file_doc = null)
    {
        // รับข้อมูลไฟล์เดิมจากฐานข้อมูล
        $this->db->select('odata_sub_file_doc');
        $this->db->from('tbl_odata_sub_file');
        $this->db->where('odata_sub_file_id', $odata_sub_file_id);
        $old_file = $this->db->get()->row()->odata_sub_file_doc;

        // ถ้ามีไฟล์ใหม่ที่แตกต่างจากไฟล์เดิม ให้ลบไฟล์เก่าออกจากโฟลเดอร์
        if ($old_file && $odata_sub_file_doc && $old_file != $odata_sub_file_doc) {
            $this->delete_file_from_server($old_file);
        }

        // เตรียมข้อมูลสำหรับอัปเดตในฐานข้อมูล
        $data = array(
            'odata_sub_file_ref_id' => $odata_sub_file_ref_id,
            'odata_sub_file_name' => $odata_sub_file_name,
        );

        // ถ้ามีการอัพโหลดไฟล์ใหม่ ให้เพิ่มข้อมูลไฟล์ใหม่ในฐานข้อมูล
        if ($odata_sub_file_doc) {
            $data['odata_sub_file_doc'] = $odata_sub_file_doc;
        }

        // อัปเดตข้อมูลในฐานข้อมูล
        $this->db->where('odata_sub_file_id', $odata_sub_file_id);
        $query = $this->db->update('tbl_odata_sub_file', $data);

        // อัปเดตพื้นที่ที่ใช้งานปัจจุบันบนเซิร์ฟเวอร์
        $this->space_model->update_server_current();

        // ตรวจสอบสถานะการอัปเดตและตั้งค่า session flashdata
        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            $this->session->set_flashdata('save_error', 'เกิดข้อผิดพลาดในการอัปเดตข้อมูล');
        }
    }

    // ฟังก์ชันสำหรับลบไฟล์จากเซิร์ฟเวอร์
    private function delete_file_from_server($filename)
    {
        $file_path = './docs/file/' . $filename;
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }

    public function del_odata_sub_file($odata_sub_file_id)
    {
        $old_document = $this->db->get_where('tbl_odata_sub_file', array('odata_sub_file_id' => $odata_sub_file_id))->row();

        $old_file_path = './docs/file/' . $old_document->odata_sub_file_doc;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_odata_sub_file', array('odata_sub_file_id' => $odata_sub_file_id));
        $this->space_model->update_server_current();
    }


    public function del_odata_sub($odata_sub_id)
    {
        // ดึงข้อมูลทั้งหมดจาก tbl_odata_sub_file ที่เชื่อมโยงไปยัง tbl_odata_sub
        $query = $this->db->get_where('tbl_odata_sub_file', array('odata_sub_file_ref_id' => $odata_sub_id));
        $files = $query->result();

        // วนลูปผ่านข้อมูลเพื่อลบไฟล์แต่ละไฟล์
        foreach ($files as $file) {
            $file_path = './docs/file/' . $file->odata_sub_file_doc;
            if (file_exists($file_path)) {
                unlink($file_path); // ลบไฟล์จากระบบ
            }
        }

        // ลบข้อมูลใน tbl_odata_sub_file ที่เชื่อมโยงไปยัง tbl_odata_sub
        $this->db->where('odata_sub_file_ref_id', $odata_sub_id);
        $this->db->delete('tbl_odata_sub_file');

        // ลบข้อมูลใน tbl_odata_sub
        $this->db->where('odata_sub_id', $odata_sub_id);
        $this->db->delete('tbl_odata_sub');

        // อัปเดตสถานะของเซิร์ฟเวอร์ปัจจุบัน (ถ้าจำเป็น)
        $this->space_model->update_server_current();
    }


    public function del_odata($odata_id)
    {
        // ดึง odata_sub_id จาก tbl_odata_sub
        $this->db->select('odata_sub_id');
        $this->db->where('odata_sub_ref_id', $odata_id);
        $query = $this->db->get('tbl_odata_sub');
        $results = $query->result();
    
        // วนลูปผ่านแต่ละผลลัพธ์
        foreach ($results as $result) {
            $odata_sub_id = $result->odata_sub_id;
    
            // ดึงข้อมูลไฟล์จาก tbl_odata_sub_file ที่เชื่อมโยงกับ odata_sub_id
            $file_query = $this->db->get_where('tbl_odata_sub_file', array('odata_sub_file_ref_id' => $odata_sub_id));
            $files = $file_query->result();
    
            // วนลูปผ่านข้อมูลเพื่อลบไฟล์แต่ละไฟล์
            foreach ($files as $file) {
                $file_path = './docs/file/' . $file->odata_sub_file_doc;
                if (file_exists($file_path)) {
                    unlink($file_path); // ลบไฟล์จากระบบ
                }
            }
    
            // ลบข้อมูลใน tbl_odata_sub_file ที่เชื่อมโยงกับ odata_sub_id
            $this->db->where('odata_sub_file_ref_id', $odata_sub_id);
            $this->db->delete('tbl_odata_sub_file');
        }
    
        // ลบข้อมูลใน tbl_odata_sub ที่เชื่อมโยงกับ odata_id
        $this->db->where('odata_sub_ref_id', $odata_id);
        $this->db->delete('tbl_odata_sub');
    
        // ลบข้อมูลใน tbl_odata
        $this->db->where('odata_id', $odata_id);
        $this->db->delete('tbl_odata');
    
        // อัปเดตสถานะของเซิร์ฟเวอร์ปัจจุบัน (ถ้าจำเป็น)
        $this->space_model->update_server_current();
    }
    
    public function odata_frontend()
    {
        $this->db->select('*');
        $this->db->from('tbl_odata');
        $this->db->order_by('tbl_odata.odata_id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function increment_download_odata_sub_file($odata_sub_file_id)
    {
        $this->db->where('odata_sub_file_id', $odata_sub_file_id);
        $this->db->set('odata_sub_file_download', 'odata_sub_file_download + 1', false); // บวกค่า mui_download ทีละ 1
        $this->db->update('tbl_odata_sub_file');
    }
}
