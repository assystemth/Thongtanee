<?php
class Ita_year_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
        $this->load->model('ita_year_model');
    }

    public function add()
    {
        $data = array(
            'ita_year_year' => $this->input->post('ita_year_year'),
            'ita_year_name1' => $this->input->post('ita_year_name1'),
            'ita_year_link1' => $this->input->post('ita_year_link1'),
            'ita_year_name2' => $this->input->post('ita_year_name2'),
            'ita_year_link2' => $this->input->post('ita_year_link2'),
            'ita_year_name3' => $this->input->post('ita_year_name3'),
            'ita_year_link3' => $this->input->post('ita_year_link3'),
            'ita_year_name4' => $this->input->post('ita_year_name4'),
            'ita_year_link4' => $this->input->post('ita_year_link4'),
            'ita_year_name5' => $this->input->post('ita_year_name5'),
            'ita_year_link5' => $this->input->post('ita_year_link5'),
            'ita_year_name6' => $this->input->post('ita_year_name6'),
            'ita_year_link6' => $this->input->post('ita_year_link6'),
            'ita_year_name7' => $this->input->post('ita_year_name7'),
            'ita_year_link7' => $this->input->post('ita_year_link7'),
            'ita_year_name8' => $this->input->post('ita_year_name8'),
            'ita_year_link8' => $this->input->post('ita_year_link8'),
            'ita_year_name9' => $this->input->post('ita_year_name9'),
            'ita_year_link9' => $this->input->post('ita_year_link9'),
            'ita_year_name10' => $this->input->post('ita_year_name10'),
            'ita_year_link10' => $this->input->post('ita_year_link10'),
            'ita_year_name11' => $this->input->post('ita_year_name11'),
            'ita_year_link11' => $this->input->post('ita_year_link11'),
            'ita_year_name12' => $this->input->post('ita_year_name12'),
            'ita_year_link12' => $this->input->post('ita_year_link12'),
            'ita_year_name13' => $this->input->post('ita_year_name13'),
            'ita_year_link13' => $this->input->post('ita_year_link13'),
            'ita_year_name14' => $this->input->post('ita_year_name14'),
            'ita_year_link14' => $this->input->post('ita_year_link14'),
            'ita_year_name15' => $this->input->post('ita_year_name15'),
            'ita_year_link15' => $this->input->post('ita_year_link15'),
            'ita_year_name16' => $this->input->post('ita_year_name16'),
            'ita_year_link16' => $this->input->post('ita_year_link16'),
            'ita_year_name17' => $this->input->post('ita_year_name17'),
            'ita_year_link17' => $this->input->post('ita_year_link17'),
            'ita_year_name18' => $this->input->post('ita_year_name18'),
            'ita_year_link18' => $this->input->post('ita_year_link18'),
            'ita_year_name19' => $this->input->post('ita_year_name19'),
            'ita_year_link19' => $this->input->post('ita_year_link19'),
            'ita_year_name20' => $this->input->post('ita_year_name20'),
            'ita_year_link20' => $this->input->post('ita_year_link20'),
            'ita_year_name21' => $this->input->post('ita_year_name21'),
            'ita_year_link21' => $this->input->post('ita_year_link21'),
            'ita_year_name22' => $this->input->post('ita_year_name22'),
            'ita_year_link22' => $this->input->post('ita_year_link22'),
            'ita_year_name23' => $this->input->post('ita_year_name23'),
            'ita_year_link23' => $this->input->post('ita_year_link23'),
            'ita_year_name24' => $this->input->post('ita_year_name24'),
            'ita_year_link24' => $this->input->post('ita_year_link24'),
            'ita_year_name25' => $this->input->post('ita_year_name25'),
            'ita_year_link25' => $this->input->post('ita_year_link25'),
            'ita_year_name26' => $this->input->post('ita_year_name26'),
            'ita_year_link26' => $this->input->post('ita_year_link26'),
            'ita_year_name27' => $this->input->post('ita_year_name27'),
            'ita_year_link27' => $this->input->post('ita_year_link27'),
            'ita_year_name28' => $this->input->post('ita_year_name28'),
            'ita_year_link28' => $this->input->post('ita_year_link28'),
            'ita_year_name29' => $this->input->post('ita_year_name29'),
            'ita_year_link29' => $this->input->post('ita_year_link29'),
            'ita_year_name30' => $this->input->post('ita_year_name30'),
            'ita_year_link30' => $this->input->post('ita_year_link30'),
            'ita_year_name31' => $this->input->post('ita_year_name31'),
            'ita_year_link31' => $this->input->post('ita_year_link31'),
            'ita_year_name32' => $this->input->post('ita_year_name32'),
            'ita_year_link32' => $this->input->post('ita_year_link32'),
            'ita_year_name33' => $this->input->post('ita_year_name33'),
            'ita_year_link33' => $this->input->post('ita_year_link33'),
            'ita_year_name34' => $this->input->post('ita_year_name34'),
            'ita_year_link34' => $this->input->post('ita_year_link34'),
            'ita_year_name35' => $this->input->post('ita_year_name35'),
            'ita_year_link35' => $this->input->post('ita_year_link35'),
            'ita_year_name36' => $this->input->post('ita_year_name36'),
            'ita_year_link36' => $this->input->post('ita_year_link36'),
            'ita_year_name37' => $this->input->post('ita_year_name37'),
            'ita_year_link37' => $this->input->post('ita_year_link37'),
            'ita_year_name38' => $this->input->post('ita_year_name38'),
            'ita_year_link38' => $this->input->post('ita_year_link38'),
            'ita_year_name39' => $this->input->post('ita_year_name39'),
            'ita_year_link39' => $this->input->post('ita_year_link39'),
            'ita_year_name40' => $this->input->post('ita_year_name40'),
            'ita_year_link40' => $this->input->post('ita_year_link40'),
            'ita_year_name41' => $this->input->post('ita_year_name41'),
            'ita_year_link41' => $this->input->post('ita_year_link41'),
            'ita_year_name42' => $this->input->post('ita_year_name42'),
            'ita_year_link42' => $this->input->post('ita_year_link42'),
            'ita_year_name43' => $this->input->post('ita_year_name43'),
            'ita_year_link43' => $this->input->post('ita_year_link43'),
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

    public function edit($ita_year_id)
    {

        $data = array(
            'ita_year_year' => $this->input->post('ita_year_year'),
            'ita_year_name1' => $this->input->post('ita_year_name1'),
            'ita_year_link1' => $this->input->post('ita_year_link1'),
            'ita_year_name2' => $this->input->post('ita_year_name2'),
            'ita_year_link2' => $this->input->post('ita_year_link2'),
            'ita_year_name3' => $this->input->post('ita_year_name3'),
            'ita_year_link3' => $this->input->post('ita_year_link3'),
            'ita_year_name4' => $this->input->post('ita_year_name4'),
            'ita_year_link4' => $this->input->post('ita_year_link4'),
            'ita_year_name5' => $this->input->post('ita_year_name5'),
            'ita_year_link5' => $this->input->post('ita_year_link5'),
            'ita_year_name6' => $this->input->post('ita_year_name6'),
            'ita_year_link6' => $this->input->post('ita_year_link6'),
            'ita_year_name7' => $this->input->post('ita_year_name7'),
            'ita_year_link7' => $this->input->post('ita_year_link7'),
            'ita_year_name8' => $this->input->post('ita_year_name8'),
            'ita_year_link8' => $this->input->post('ita_year_link8'),
            'ita_year_name9' => $this->input->post('ita_year_name9'),
            'ita_year_link9' => $this->input->post('ita_year_link9'),
            'ita_year_name10' => $this->input->post('ita_year_name10'),
            'ita_year_link10' => $this->input->post('ita_year_link10'),
            'ita_year_name11' => $this->input->post('ita_year_name11'),
            'ita_year_link11' => $this->input->post('ita_year_link11'),
            'ita_year_name12' => $this->input->post('ita_year_name12'),
            'ita_year_link12' => $this->input->post('ita_year_link12'),
            'ita_year_name13' => $this->input->post('ita_year_name13'),
            'ita_year_link13' => $this->input->post('ita_year_link13'),
            'ita_year_name14' => $this->input->post('ita_year_name14'),
            'ita_year_link14' => $this->input->post('ita_year_link14'),
            'ita_year_name15' => $this->input->post('ita_year_name15'),
            'ita_year_link15' => $this->input->post('ita_year_link15'),
            'ita_year_name16' => $this->input->post('ita_year_name16'),
            'ita_year_link16' => $this->input->post('ita_year_link16'),
            'ita_year_name17' => $this->input->post('ita_year_name17'),
            'ita_year_link17' => $this->input->post('ita_year_link17'),
            'ita_year_name18' => $this->input->post('ita_year_name18'),
            'ita_year_link18' => $this->input->post('ita_year_link18'),
            'ita_year_name19' => $this->input->post('ita_year_name19'),
            'ita_year_link19' => $this->input->post('ita_year_link19'),
            'ita_year_name20' => $this->input->post('ita_year_name20'),
            'ita_year_link20' => $this->input->post('ita_year_link20'),
            'ita_year_name21' => $this->input->post('ita_year_name21'),
            'ita_year_link21' => $this->input->post('ita_year_link21'),
            'ita_year_name22' => $this->input->post('ita_year_name22'),
            'ita_year_link22' => $this->input->post('ita_year_link22'),
            'ita_year_name23' => $this->input->post('ita_year_name23'),
            'ita_year_link23' => $this->input->post('ita_year_link23'),
            'ita_year_name24' => $this->input->post('ita_year_name24'),
            'ita_year_link24' => $this->input->post('ita_year_link24'),
            'ita_year_name25' => $this->input->post('ita_year_name25'),
            'ita_year_link25' => $this->input->post('ita_year_link25'),
            'ita_year_name26' => $this->input->post('ita_year_name26'),
            'ita_year_link26' => $this->input->post('ita_year_link26'),
            'ita_year_name27' => $this->input->post('ita_year_name27'),
            'ita_year_link27' => $this->input->post('ita_year_link27'),
            'ita_year_name28' => $this->input->post('ita_year_name28'),
            'ita_year_link28' => $this->input->post('ita_year_link28'),
            'ita_year_name29' => $this->input->post('ita_year_name29'),
            'ita_year_link29' => $this->input->post('ita_year_link29'),
            'ita_year_name30' => $this->input->post('ita_year_name30'),
            'ita_year_link30' => $this->input->post('ita_year_link30'),
            'ita_year_name31' => $this->input->post('ita_year_name31'),
            'ita_year_link31' => $this->input->post('ita_year_link31'),
            'ita_year_name32' => $this->input->post('ita_year_name32'),
            'ita_year_link32' => $this->input->post('ita_year_link32'),
            'ita_year_name33' => $this->input->post('ita_year_name33'),
            'ita_year_link33' => $this->input->post('ita_year_link33'),
            'ita_year_name34' => $this->input->post('ita_year_name34'),
            'ita_year_link34' => $this->input->post('ita_year_link34'),
            'ita_year_name35' => $this->input->post('ita_year_name35'),
            'ita_year_link35' => $this->input->post('ita_year_link35'),
            'ita_year_name36' => $this->input->post('ita_year_name36'),
            'ita_year_link36' => $this->input->post('ita_year_link36'),
            'ita_year_name37' => $this->input->post('ita_year_name37'),
            'ita_year_link37' => $this->input->post('ita_year_link37'),
            'ita_year_name38' => $this->input->post('ita_year_name38'),
            'ita_year_link38' => $this->input->post('ita_year_link38'),
            'ita_year_name39' => $this->input->post('ita_year_name39'),
            'ita_year_link39' => $this->input->post('ita_year_link39'),
            'ita_year_name40' => $this->input->post('ita_year_name40'),
            'ita_year_link40' => $this->input->post('ita_year_link40'),
            'ita_year_name41' => $this->input->post('ita_year_name41'),
            'ita_year_link41' => $this->input->post('ita_year_link41'),
            'ita_year_name42' => $this->input->post('ita_year_name42'),
            'ita_year_link42' => $this->input->post('ita_year_link42'),
            'ita_year_name43' => $this->input->post('ita_year_name43'),
            'ita_year_link43' => $this->input->post('ita_year_link43'),
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

    public function del_ita_year($ita_year_id)
    {
        $this->db->delete('tbl_ita_year', array('ita_year_id' => $ita_year_id));
    }

    public function ita_year_frontend()
    {
        $this->db->select('*');
        $this->db->from('tbl_ita_year');
        $this->db->order_by('tbl_ita_year.ita_year_id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
}
