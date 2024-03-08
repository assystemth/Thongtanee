<?php
class Intra_share_file_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    // แชร์ไฟล์ภายในองค์กร **********************************************************************
    public function add_sf_all()
    {
        $config['upload_path'] = './docs/intranet/file';
        $config['allowed_types'] = 'pdf|doc|docx|xls|';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('intra_sf_all_pdf')) {
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
            redirect('Intra_sf_all');
            return;
        }

        // ข้อมูลสำหรับบันทึกลงในฐานข้อมูล
        $insert_data = array(
            'intra_sf_all_name' => $this->input->post('intra_sf_all_name'),
            'intra_sf_all_by' => $this->session->userdata('m_fname'),
            'intra_sf_all_pdf' => $filename
        );

        // บันทึกลงในฐานข้อมูล
        $query = $this->db->insert('tbl_intra_sf_all', $insert_data);

        // อัพเดตข้อมูลพื้นที่ในการใช้งาน
        $this->space_model->update_server_current();

        // ตรวจสอบความสำเร็จของการบันทึก
        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            $this->session->set_flashdata('save_error', TRUE);
        }
    }

    public function list_sf_all()
    {
        $this->db->order_by('intra_sf_all_id', 'DESC');
        $query = $this->db->get('tbl_intra_sf_all');
        return $query->result();
    }

    public function del_sf_all($intra_sf_all_id)
    {
        // ดึงข้อมูลรูปเก่า
        $old_document = $this->db->get_where('tbl_intra_sf_all', array('intra_sf_all_id' => $intra_sf_all_id))->row();

        $old_file_path = './docs/intranet/file/' . $old_document->intra_sf_all_pdf;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_intra_sf_all', array('intra_sf_all_id' => $intra_sf_all_id));
    }

    public function search_sf_all($search_term)
    {
        // ปรับแต่ง query ตามความต้องการ
        $this->db->like('intra_sf_all_name', $search_term);
        // $this->db->or_like('intra_sf_all_pdf', $search_term);
        // เพิ่มเงื่อนไขค้นหาเพิ่มเติมตามความต้องการ

        $query = $this->db->get('tbl_intra_sf_all');
        return $query->result();
    }
    // ****************************************************************************************

    // คณะผู้บริหาร *****************************************************************************
    public function add_sf_executive()
    {
        $config['upload_path'] = './docs/intranet/file';
        $config['allowed_types'] = 'pdf|doc|docx|xls|';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('intra_sf_executive_pdf')) {
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
            redirect('Intra_sf_executive');
            return;
        }

        // ข้อมูลสำหรับบันทึกลงในฐานข้อมูล
        $insert_data = array(
            'intra_sf_executive_name' => $this->input->post('intra_sf_executive_name'),
            'intra_sf_executive_by' => $this->session->userdata('m_fname'),
            'intra_sf_executive_pdf' => $filename
        );

        // บันทึกลงในฐานข้อมูล
        $query = $this->db->insert('tbl_intra_sf_executive', $insert_data);

        // อัพเดตข้อมูลพื้นที่ในการใช้งาน
        $this->space_model->update_server_current();

        // ตรวจสอบความสำเร็จของการบันทึก
        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            $this->session->set_flashdata('save_error', TRUE);
        }
    }

    public function list_sf_executive()
    {
        $this->db->order_by('intra_sf_executive_id', 'DESC');
        $query = $this->db->get('tbl_intra_sf_executive');
        return $query->result();
    }

    public function del_sf_executive($intra_sf_executive_id)
    {
        // ดึงข้อมูลรูปเก่า
        $old_document = $this->db->get_where('tbl_intra_sf_executive', array('intra_sf_executive_id' => $intra_sf_executive_id))->row();

        $old_file_path = './docs/intranet/file/' . $old_document->intra_sf_executive_pdf;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_intra_sf_executive', array('intra_sf_executive_id' => $intra_sf_executive_id));
    }
    public function search_sf_executive($search_term)
    {
        // ปรับแต่ง query ตามความต้องการ
        $this->db->like('intra_sf_executive_name', $search_term);
        // $this->db->or_like('intra_sf_all_pdf', $search_term);
        // เพิ่มเงื่อนไขค้นหาเพิ่มเติมตามความต้องการ

        $query = $this->db->get('tbl_intra_sf_executive');
        return $query->result();
    }
    // ****************************************************************************************

    // หน่วยตรวจสอบภายใน *****************************************************************************
    public function add_sf_audit()
    {
        $config['upload_path'] = './docs/intranet/file';
        $config['allowed_types'] = 'pdf|doc|docx|xls|';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('intra_sf_audit_pdf')) {
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
            redirect('Intra_sf_audit');
            return;
        }

        // ข้อมูลสำหรับบันทึกลงในฐานข้อมูล
        $insert_data = array(
            'intra_sf_audit_name' => $this->input->post('intra_sf_audit_name'),
            'intra_sf_audit_by' => $this->session->userdata('m_fname'),
            'intra_sf_audit_pdf' => $filename
        );

        // บันทึกลงในฐานข้อมูล
        $query = $this->db->insert('tbl_intra_sf_audit', $insert_data);

        // อัพเดตข้อมูลพื้นที่ในการใช้งาน
        $this->space_model->update_server_current();

        // ตรวจสอบความสำเร็จของการบันทึก
        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            $this->session->set_flashdata('save_error', TRUE);
        }
    }

    public function list_sf_audit()
    {
        $this->db->order_by('intra_sf_audit_id', 'DESC');
        $query = $this->db->get('tbl_intra_sf_audit');
        return $query->result();
    }

    public function del_sf_audit($intra_sf_audit_id)
    {
        // ดึงข้อมูลรูปเก่า
        $old_document = $this->db->get_where('tbl_intra_sf_audit', array('intra_sf_audit_id' => $intra_sf_audit_id))->row();

        $old_file_path = './docs/intranet/file/' . $old_document->intra_sf_audit_pdf;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_intra_sf_audit', array('intra_sf_audit_id' => $intra_sf_audit_id));
    }
    public function search_sf_audit($search_term)
    {
        // ปรับแต่ง query ตามความต้องการ
        $this->db->like('intra_sf_audit_name', $search_term);
        // เพิ่มเงื่อนไขค้นหาเพิ่มเติมตามความต้องการ

        $query = $this->db->get('tbl_intra_sf_audit');
        return $query->result();
    }
    // ****************************************************************************************

    // กองคลัง *****************************************************************************
    public function add_sf_treasury()
    {
        $config['upload_path'] = './docs/intranet/file';
        $config['allowed_types'] = 'pdf|doc|docx|xls|';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('intra_sf_treasury_pdf')) {
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
            redirect('Intra_sf_treasury');
            return;
        }

        // ข้อมูลสำหรับบันทึกลงในฐานข้อมูล
        $insert_data = array(
            'intra_sf_treasury_name' => $this->input->post('intra_sf_treasury_name'),
            'intra_sf_treasury_by' => $this->session->userdata('m_fname'),
            'intra_sf_treasury_pdf' => $filename
        );

        // บันทึกลงในฐานข้อมูล
        $query = $this->db->insert('tbl_intra_sf_treasury', $insert_data);

        // อัพเดตข้อมูลพื้นที่ในการใช้งาน
        $this->space_model->update_server_current();

        // ตรวจสอบความสำเร็จของการบันทึก
        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            $this->session->set_flashdata('save_error', TRUE);
        }
    }

    public function list_sf_treasury()
    {
        $this->db->order_by('intra_sf_treasury_id', 'DESC');
        $query = $this->db->get('tbl_intra_sf_treasury');
        return $query->result();
    }

    public function del_sf_treasury($intra_sf_treasury_id)
    {
        // ดึงข้อมูลรูปเก่า
        $old_document = $this->db->get_where('tbl_intra_sf_treasury', array('intra_sf_treasury_id' => $intra_sf_treasury_id))->row();

        $old_file_path = './docs/intranet/file/' . $old_document->intra_sf_treasury_pdf;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_intra_sf_treasury', array('intra_sf_treasury_id' => $intra_sf_treasury_id));
    }
    public function search_sf_treasury($search_term)
    {
        // ปรับแต่ง query ตามความต้องการ
        $this->db->like('intra_sf_treasury_name', $search_term);
        // เพิ่มเงื่อนไขค้นหาเพิ่มเติมตามความต้องการ

        $query = $this->db->get('tbl_intra_sf_treasury');
        return $query->result();
    }
    // ****************************************************************************************

    // กองช่าง *****************************************************************************
    public function add_sf_maintenance()
    {
        $config['upload_path'] = './docs/intranet/file';
        $config['allowed_types'] = 'pdf|doc|docx|xls|';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('intra_sf_maintenance_pdf')) {
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
            redirect('Intra_sf_maintenance');
            return;
        }

        // ข้อมูลสำหรับบันทึกลงในฐานข้อมูล
        $insert_data = array(
            'intra_sf_maintenance_name' => $this->input->post('intra_sf_maintenance_name'),
            'intra_sf_maintenance_by' => $this->session->userdata('m_fname'),
            'intra_sf_maintenance_pdf' => $filename
        );

        // บันทึกลงในฐานข้อมูล
        $query = $this->db->insert('tbl_intra_sf_maintenance', $insert_data);

        // อัพเดตข้อมูลพื้นที่ในการใช้งาน
        $this->space_model->update_server_current();

        // ตรวจสอบความสำเร็จของการบันทึก
        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            $this->session->set_flashdata('save_error', TRUE);
        }
    }

    public function list_sf_maintenance()
    {
        $this->db->order_by('intra_sf_maintenance_id', 'DESC');
        $query = $this->db->get('tbl_intra_sf_maintenance');
        return $query->result();
    }

    public function del_sf_maintenance($intra_sf_maintenance_id)
    {
        // ดึงข้อมูลรูปเก่า
        $old_document = $this->db->get_where('tbl_intra_sf_maintenance', array('intra_sf_maintenance_id' => $intra_sf_maintenance_id))->row();

        $old_file_path = './docs/intranet/file/' . $old_document->intra_sf_maintenance_pdf;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_intra_sf_maintenance', array('intra_sf_maintenance_id' => $intra_sf_maintenance_id));
    }
    public function search_sf_maintenance($search_term)
    {
        // ปรับแต่ง query ตามความต้องการ
        $this->db->like('intra_sf_maintenance_name', $search_term);
        // เพิ่มเงื่อนไขค้นหาเพิ่มเติมตามความต้องการ

        $query = $this->db->get('tbl_intra_sf_maintenance');
        return $query->result();
    }
    // ****************************************************************************************

    // สำนักปลัด *****************************************************************************
    public function add_sf_deputy()
    {
        $config['upload_path'] = './docs/intranet/file';
        $config['allowed_types'] = 'pdf|doc|docx|xls|';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('intra_sf_deputy_pdf')) {
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
            redirect('Intra_sf_deputy');
            return;
        }

        // ข้อมูลสำหรับบันทึกลงในฐานข้อมูล
        $insert_data = array(
            'intra_sf_deputy_name' => $this->input->post('intra_sf_deputy_name'),
            'intra_sf_deputy_by' => $this->session->userdata('m_fname'),
            'intra_sf_deputy_pdf' => $filename
        );

        // บันทึกลงในฐานข้อมูล
        $query = $this->db->insert('tbl_intra_sf_deputy', $insert_data);

        // อัพเดตข้อมูลพื้นที่ในการใช้งาน
        $this->space_model->update_server_current();

        // ตรวจสอบความสำเร็จของการบันทึก
        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            $this->session->set_flashdata('save_error', TRUE);
        }
    }

    public function list_sf_deputy()
    {
        $this->db->order_by('intra_sf_deputy_id', 'DESC');
        $query = $this->db->get('tbl_intra_sf_deputy');
        return $query->result();
    }

    public function del_sf_deputy($intra_sf_deputy_id)
    {
        // ดึงข้อมูลรูปเก่า
        $old_document = $this->db->get_where('tbl_intra_sf_deputy', array('intra_sf_deputy_id' => $intra_sf_deputy_id))->row();

        $old_file_path = './docs/intranet/file/' . $old_document->intra_sf_deputy_pdf;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_intra_sf_deputy', array('intra_sf_deputy_id' => $intra_sf_deputy_id));
    }
    public function search_sf_deputy($search_term)
    {
        // ปรับแต่ง query ตามความต้องการ
        $this->db->like('intra_sf_deputy_name', $search_term);
        // เพิ่มเงื่อนไขค้นหาเพิ่มเติมตามความต้องการ

        $query = $this->db->get('tbl_intra_sf_deputy');
        return $query->result();
    }
    // ****************************************************************************************

    // สมาชิกสภาตำบล *****************************************************************************
    public function add_sf_council()
    {
        $config['upload_path'] = './docs/intranet/file';
        $config['allowed_types'] = 'pdf|doc|docx|xls|';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('intra_sf_council_pdf')) {
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
            redirect('Intra_sf_council');
            return;
        }

        // ข้อมูลสำหรับบันทึกลงในฐานข้อมูล
        $insert_data = array(
            'intra_sf_council_name' => $this->input->post('intra_sf_council_name'),
            'intra_sf_council_by' => $this->session->userdata('m_fname'),
            'intra_sf_council_pdf' => $filename
        );

        // บันทึกลงในฐานข้อมูล
        $query = $this->db->insert('tbl_intra_sf_council', $insert_data);

        // อัพเดตข้อมูลพื้นที่ในการใช้งาน
        $this->space_model->update_server_current();

        // ตรวจสอบความสำเร็จของการบันทึก
        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            $this->session->set_flashdata('save_error', TRUE);
        }
    }

    public function list_sf_council()
    {
        $this->db->order_by('intra_sf_council_id', 'DESC');
        $query = $this->db->get('tbl_intra_sf_council');
        return $query->result();
    }

    public function del_sf_council($intra_sf_council_id)
    {
        // ดึงข้อมูลรูปเก่า
        $old_document = $this->db->get_where('tbl_intra_sf_council', array('intra_sf_council_id' => $intra_sf_council_id))->row();

        $old_file_path = './docs/intranet/file/' . $old_document->intra_sf_council_pdf;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_intra_sf_council', array('intra_sf_council_id' => $intra_sf_council_id));
    }
    public function search_sf_council($search_term)
    {
        // ปรับแต่ง query ตามความต้องการ
        $this->db->like('intra_sf_council_name', $search_term);
        // เพิ่มเงื่อนไขค้นหาเพิ่มเติมตามความต้องการ

        $query = $this->db->get('tbl_intra_sf_council');
        return $query->result();
    }
    // ****************************************************************************************

    // หัวหน้าหน่วยราชการ ************************************************************************
    public function add_sf_unit_leaders()
    {
        $config['upload_path'] = './docs/intranet/file';
        $config['allowed_types'] = 'pdf|doc|docx|xls|';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('intra_sf_unit_leaders_pdf')) {
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
            redirect('Intra_sf_unit_leaders');
            return;
        }

        // ข้อมูลสำหรับบันทึกลงในฐานข้อมูล
        $insert_data = array(
            'intra_sf_unit_leaders_name' => $this->input->post('intra_sf_unit_leaders_name'),
            'intra_sf_unit_leaders_by' => $this->session->userdata('m_fname'),
            'intra_sf_unit_leaders_pdf' => $filename
        );

        // บันทึกลงในฐานข้อมูล
        $query = $this->db->insert('tbl_intra_sf_unit_leaders', $insert_data);

        // อัพเดตข้อมูลพื้นที่ในการใช้งาน
        $this->space_model->update_server_current();

        // ตรวจสอบความสำเร็จของการบันทึก
        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            $this->session->set_flashdata('save_error', TRUE);
        }
    }

    public function list_sf_unit_leaders()
    {
        $this->db->order_by('intra_sf_unit_leaders_id', 'DESC');
        $query = $this->db->get('tbl_intra_sf_unit_leaders');
        return $query->result();
    }

    public function del_sf_unit_leaders($intra_sf_unit_leaders_id)
    {
        // ดึงข้อมูลรูปเก่า
        $old_document = $this->db->get_where('tbl_intra_sf_unit_leaders', array('intra_sf_unit_leaders_id' => $intra_sf_unit_leaders_id))->row();

        $old_file_path = './docs/intranet/file/' . $old_document->intra_sf_unit_leaders_pdf;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_intra_sf_unit_leaders', array('intra_sf_unit_leaders_id' => $intra_sf_unit_leaders_id));
    }
    public function search_sf_unit_leaders($search_term)
    {
        // ปรับแต่ง query ตามความต้องการ
        $this->db->like('intra_sf_unit_leaders_name', $search_term);
        // เพิ่มเงื่อนไขค้นหาเพิ่มเติมตามความต้องการ

        $query = $this->db->get('tbl_intra_sf_unit_leaders');
        return $query->result();
    }
    // ****************************************************************************************

    // กองการศึกษา ************************************************************************
    public function add_sf_education()
    {
        $config['upload_path'] = './docs/intranet/file';
        $config['allowed_types'] = 'pdf|doc|docx|xls|';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('intra_sf_education_pdf')) {
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
            redirect('Intra_sf_education');
            return;
        }

        // ข้อมูลสำหรับบันทึกลงในฐานข้อมูล
        $insert_data = array(
            'intra_sf_education_name' => $this->input->post('intra_sf_education_name'),
            'intra_sf_education_by' => $this->session->userdata('m_fname'),
            'intra_sf_education_pdf' => $filename
        );

        // บันทึกลงในฐานข้อมูล
        $query = $this->db->insert('tbl_intra_sf_education', $insert_data);

        // อัพเดตข้อมูลพื้นที่ในการใช้งาน
        $this->space_model->update_server_current();

        // ตรวจสอบความสำเร็จของการบันทึก
        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            $this->session->set_flashdata('save_error', TRUE);
        }
    }

    public function list_sf_education()
    {
        $this->db->order_by('intra_sf_education_id', 'DESC');
        $query = $this->db->get('tbl_intra_sf_education');
        return $query->result();
    }

    public function del_sf_education($intra_sf_education_id)
    {
        // ดึงข้อมูลรูปเก่า
        $old_document = $this->db->get_where('tbl_intra_sf_education', array('intra_sf_education_id' => $intra_sf_education_id))->row();

        $old_file_path = './docs/intranet/file/' . $old_document->intra_sf_education_pdf;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_intra_sf_education', array('intra_sf_education_id' => $intra_sf_education_id));
    }
    public function search_sf_education($search_term)
    {
        // ปรับแต่ง query ตามความต้องการ
        $this->db->like('intra_sf_education_name', $search_term);
        // เพิ่มเงื่อนไขค้นหาเพิ่มเติมตามความต้องการ

        $query = $this->db->get('tbl_intra_sf_education');
        return $query->result();
    }
    // ****************************************************************************************
}
