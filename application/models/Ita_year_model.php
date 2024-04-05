<?php
class Ita_year_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
        $this->load->model('ita_year_model');
    }

    public function add_year()
    {
        // ดึงค่าจากฟอร์ม
        $ita_year_year = $this->input->post('ita_year_year');

        // ตรวจสอบว่ามีข้อมูลซ้ำหรือไม่
        $duplicate_check = $this->db->get_where('tbl_ita_year', array('ita_year_year' => $ita_year_year));

        if ($duplicate_check->num_rows() > 0) {
            // ถ้ามีข้อมูลซ้ำ
            $this->session->set_flashdata('save_again', TRUE);
        } else {
            // ถ้าไม่มีข้อมูลซ้ำ, ทำการเพิ่มข้อมูล
            $data = array(
                'ita_year_year' => $ita_year_year,
                'ita_year_by' => $this->session->userdata('m_fname'),
            );

            $query = $this->db->insert('tbl_ita_year', $data);

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

    public function list_all()
    {
        $this->db->order_by('ita_year_id', 'DESC');
        $query = $this->db->get('tbl_ita_year');
        return $query->result();
    }

    //show form edit
    public function read($ita_year_id)
    {
        $this->db->where('ita_year_id', $ita_year_id);
        $query = $this->db->get('tbl_ita_year');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function edit_year($ita_year_id)
    {

        $data = array(
            'ita_year_year' => $this->input->post('ita_year_year'),
            'ita_year_by' => $this->session->userdata('m_fname'),
        );

        $this->db->where('ita_year_id', $ita_year_id);
        $query = $this->db->update('tbl_ita_year', $data);

        $this->space_model->update_server_current();


        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล !');";
            echo "</script>";
        }
    }

    public function list_all_ita_topic($ita_year_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_ita_year_topic');
        $this->db->join('tbl_ita_year', 'tbl_ita_year_topic.ita_year_topic_ref_id = tbl_ita_year.ita_year_id');
        $this->db->where('tbl_ita_year_topic.ita_year_topic_ref_id', $ita_year_id);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function add_topic($ita_year_topic_ref_id, $ita_year_topic_name, $ita_year_topic_msg)
    {
        $data = array(
            'ita_year_topic_ref_id' => $ita_year_topic_ref_id,
            'ita_year_topic_name' => $ita_year_topic_name,
            'ita_year_topic_msg' => $ita_year_topic_msg,
        );

        $this->db->insert('tbl_ita_year_topic', $data);

        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }
    public function read_topic($ita_year_topic_id)
    {
        $this->db->where('ita_year_topic_id', $ita_year_topic_id);
        $query = $this->db->get('tbl_ita_year_topic');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }
    public function edit_topic($ita_year_topic_ref_id, $ita_year_topic_name, $ita_year_topic_msg, $ita_year_topic_id)
    {
        $data = array(
            'ita_year_topic_name' => $ita_year_topic_name,
            'ita_year_topic_msg' => $ita_year_topic_msg,
        );

        $this->db->where('ita_year_topic_id', $ita_year_topic_id);
        $query = $this->db->update('tbl_ita_year_topic', $data);

        $this->space_model->update_server_current();

        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล !');";
            echo "</script>";
        }
    }

    public function read_link($ita_year_link_id)
    {
        $this->db->where('ita_year_link_id', $ita_year_link_id);
        $query = $this->db->get('tbl_ita_year_link');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function list_all_ita_link($ita_year_topic_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_ita_year_link');
        $this->db->join('tbl_ita_year_topic', 'tbl_ita_year_link.ita_year_link_ref_id = tbl_ita_year_topic.ita_year_topic_id');
        $this->db->where('tbl_ita_year_link.ita_year_link_ref_id', $ita_year_topic_id);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function add_link($ita_year_link_ref_id, $ita_year_link_name, $ita_year_link_link1, $ita_year_link_link2, $ita_year_link_link3, $ita_year_link_link4, $ita_year_link_link5)
    {
        $data = array(
            'ita_year_link_ref_id' => $ita_year_link_ref_id,
            'ita_year_link_name' => $ita_year_link_name,
            'ita_year_link_link1' => $ita_year_link_link1,
            'ita_year_link_link2' => $ita_year_link_link2,
            'ita_year_link_link3' => $ita_year_link_link3,
            'ita_year_link_link4' => $ita_year_link_link4,
            'ita_year_link_link5' => $ita_year_link_link5,
        );

        $this->db->insert('tbl_ita_year_link', $data);

        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }
    public function edit_link($ita_year_link_id, $ita_year_link_ref_id, $ita_year_link_name, $ita_year_link_link1, $ita_year_link_link2, $ita_year_link_link3, $ita_year_link_link4, $ita_year_link_link5)
    {
        $data = array(
            'ita_year_link_name' => $ita_year_link_name,
            'ita_year_link_link1' => $ita_year_link_link1,
            'ita_year_link_link2' => $ita_year_link_link2,
            'ita_year_link_link3' => $ita_year_link_link3,
            'ita_year_link_link4' => $ita_year_link_link4,
            'ita_year_link_link5' => $ita_year_link_link5,
        );

        $this->db->where('ita_year_link_id', $ita_year_link_id);
        $query = $this->db->update('tbl_ita_year_link', $data);

        // เพิ่มบรรทัดนี้เพื่อ debug
        echo $this->db->last_query();

        $this->space_model->update_server_current();

        if ($query) {
            $this->session->set_flashdata('save_success', TRUE);
        } else {
            echo "<script>";
            echo "alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล !');";
            echo "</script>";
        }
    }

    public function del_ita_link($ita_year_link_id)
    {
        $this->db->delete('tbl_ita_year_link', array('ita_year_link_id' => $ita_year_link_id));
    }

    public function del_ita_topic($ita_year_topic_id)
    {
        // ลบข้อมูลใน tbl_ita_year_topic_year ที่เชื่อมโยงไปยัง tbl_ita_year_topic
        $this->db->where('ita_year_link_ref_id', $ita_year_topic_id);
        $this->db->delete('tbl_ita_year_link');

        // ลบข้อมูลใน tbl_ita_year_topic
        $this->db->where('ita_year_topic_id', $ita_year_topic_id);
        $this->db->delete('tbl_ita_year_topic');
    }

    public function del_ita_year($ita_year_id)
    {
        // ดึง ita_year_topic_id จาก tbl_ita_year_topic
        $this->db->select('ita_year_topic_id');
        $this->db->where('ita_year_topic_ref_id', $ita_year_id);
        $this->db->order_by('ita_year_topic_id', 'asc');
        $this->db->limit(1);
        $query = $this->db->get('tbl_ita_year_topic');
        $result = $query->row();

        if ($result) {
            $ita_year_id_to_delete = $result->ita_year_topic_id;

            // ลบข้อมูลใน tbl_ita_year_link
            $this->db->where('ita_year_link_ref_id', $ita_year_id_to_delete);
            $this->db->delete('tbl_ita_year_link');

            // ลบข้อมูลใน tbl_ita_year_topic
            $this->db->where('ita_year_topic_ref_id', $ita_year_id);
            $this->db->delete('tbl_ita_year_topic');

            // ลบข้อมูลใน tbl_ita_year
            $this->db->where('ita_year_id', $ita_year_id);
            $this->db->delete('tbl_ita_year');
        }
    }

    public function get_ita_year_data($ita_year_id)
    {
        $this->db->select('
        tbl_ita_year_topic.*,
        GROUP_CONCAT(
            JSON_OBJECT(
                "ita_year_link_id", tbl_ita_year_link.ita_year_link_id,
                "ita_year_link_name", tbl_ita_year_link.ita_year_link_name,
                "ita_year_link_link1", tbl_ita_year_link.ita_year_link_link1,
                "ita_year_link_link2", tbl_ita_year_link.ita_year_link_link2,
                "ita_year_link_link3", tbl_ita_year_link.ita_year_link_link3,
                "ita_year_link_link4", tbl_ita_year_link.ita_year_link_link4,
                "ita_year_link_link5", tbl_ita_year_link.ita_year_link_link5
            ) ORDER BY CAST(SUBSTRING(tbl_ita_year_link.ita_year_link_name, 2) AS UNSIGNED) ASC
        ) AS link_data
    ');
        $this->db->from('tbl_ita_year_topic');
        $this->db->join('tbl_ita_year_link', 'tbl_ita_year_topic.ita_year_topic_id = tbl_ita_year_link.ita_year_link_ref_id', 'left');
        $this->db->where('tbl_ita_year_topic.ita_year_topic_ref_id', $ita_year_id);
        $this->db->group_by('tbl_ita_year_topic.ita_year_topic_id');

        $query = $this->db->get();
        // echo '<pre>';
        // print_r($query->result_array());
        // echo '</pre>';
        // exit;
        return $query->result();
    }

    // public function get_ita_year_link_data($ita_year_topic_id)
    // {
    //     $this->db->select('*');
    //     $this->db->from('tbl_ita_year_link');
    //     $this->db->where('tbl_ita_year_link.ita_year_link_ref_id', $ita_year_topic_id);
    //     $this->db->order_by('tbl_ita_year_link.ita_year_link_id', 'DESC');
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    public function ita_year_frontend()
    {
        $this->db->select('*');
        $this->db->from('tbl_ita_year');
        $this->db->order_by('tbl_ita_year.ita_year_id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
}
