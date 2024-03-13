<?php
class Intra_announce_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    public function add()
    {
        $config['upload_path'] = './docs/intranet/file';
        $config['allowed_types'] = 'pdf|doc|docx|xls|';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('intra_announce_pdf')) {
            // ไม่สามารถอัปโหลดไฟล์ได้
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
            exit;
        }

        // สำเร็จในการอัปโหลดไฟล์
        $data = $this->upload->data();
        $filename = $data['file_name'];

        // ตรวจสอบพื้นที่ในการบันทึก
        $used_space_mb = $this->space_model->get_used_space();
        $upload_limit_mb = $this->space_model->get_limit_storage();
        $total_space_required = $data['file_size'];

        if ($used_space_mb + ($total_space_required / (1024 * 1024)) >= $upload_limit_mb) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('Intra_announce');
            return;
        }

        // ข้อมูลสำหรับบันทึกลงในฐานข้อมูล
        $insert_data = array(
            'intra_announce_name' => $this->input->post('intra_announce_name'),
            'intra_announce_by' => $this->session->userdata('m_fname'),
            'intra_announce_pdf' => $filename
        );

        // บันทึกลงในฐานข้อมูล
        $query = $this->db->insert('tbl_intra_announce', $insert_data);

        // อัพเดตข้อมูลพื้นที่ในการใช้งาน
        $this->space_model->update_server_current();

        // ตรวจสอบความสำเร็จของการบันทึก
        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            $this->session->set_flashdata('save_error', TRUE);
        }
    }

    public function list_all()
    {
        $this->db->order_by('intra_announce_id', 'DESC');
        $query = $this->db->get('tbl_intra_announce');
        return $query->result();
    }

    //show announce edit
    public function read($intra_announce_id)
    {
        $this->db->where('intra_announce_id', $intra_announce_id);
        $query = $this->db->get('tbl_intra_announce');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function del_intra_announce($intra_announce_id)
    {
        // ดึงข้อมูลรูปเก่า
        $old_document = $this->db->get_where('tbl_intra_announce', array('intra_announce_id' => $intra_announce_id))->row();

        $old_file_path = './docs/intranet/file/' . $old_document->intra_announce_pdf;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_intra_announce', array('intra_announce_id' => $intra_announce_id));
    }

    public function search($search_term)
    {
        // ปรับแต่ง query ตามความต้องการ
        $this->db->like('intra_announce_name', $search_term);
        // $this->db->or_like('intra_announce_pdf', $search_term);
        // เพิ่มเงื่อนไขค้นหาเพิ่มเติมตามความต้องการ

        $query = $this->db->get('tbl_intra_announce');
        return $query->result();
    }

    public function increment_download($intra_announce_id)
    {
        $this->db->where('intra_announce_id', $intra_announce_id);
        $this->db->set('intra_announce_download', 'intra_announce_download + 1', false); // บวกค่า operation_policy_hr_download ทีละ 1
        $this->db->update('tbl_intra_announce');
    }
}
