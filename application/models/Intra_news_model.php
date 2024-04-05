<?php
class Intra_news_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    public function add()
    {
        // Configure PDF upload
        $pdf_config['upload_path'] = './docs/intranet/file';
        $pdf_config['allowed_types'] = 'pdf';
        $pdf_config['overwrite'] = FALSE; // Add this line to prevent overwriting
        $this->load->library('upload', $pdf_config, 'pdf_upload');

        // Configure image upload
        $img_config['upload_path'] = './docs/intranet/img';
        $img_config['allowed_types'] = 'gif|jpg|png|jpeg';
        $img_config['overwrite'] = FALSE; // Add this line to prevent overwriting
        $this->load->library('upload', $img_config, 'img_upload');


        // Upload main file (Image)
        if (!$this->img_upload->do_upload('intra_news_img')) {
            // If the file size exceeds the max_size, set flash data and redirect
            $this->session->set_flashdata('save_maxsize', TRUE);
            redirect('System_intranet/adding');
            return;
        }

        $img_data = $this->img_upload->data();
        $img_filename = $img_data['file_name'];

        // Insert data into tbl_intra_news
        $intra_news_data = array(
            'intra_news_topic' => $this->input->post('intra_news_topic'),
            'intra_news_detail' => $this->input->post('intra_news_detail'),
            'intra_news_by' => $this->session->userdata('m_fname'),
            'intra_news_img' => $img_filename
        );

        $this->db->insert('tbl_intra_news', $intra_news_data);
        $intra_news_id = $this->db->insert_id();

        // Upload additional images
        $imgs_data = array();

        if (!empty($_FILES['intra_news_img_img_multiple']['name'][0])) {
            foreach ($_FILES['intra_news_img_img_multiple']['name'] as $index => $name) {
                $_FILES['intra_news_img_img_multiple']['name'] = $name;
                $_FILES['intra_news_img_img_multiple']['type'] = $_FILES['intra_news_img_img_multiple']['type'][$index];
                $_FILES['intra_news_img_img_multiple']['tmp_name'] = $_FILES['intra_news_img_img_multiple']['tmp_name'][$index];
                $_FILES['intra_news_img_img_multiple']['error'] = $_FILES['intra_news_img_img_multiple']['error'][$index];
                $_FILES['intra_news_img_img_multiple']['size'] = $_FILES['intra_news_img_img_multiple']['size'][$index];

                if ($this->img_upload->do_upload('intra_news_img_img_multiple')) {
                    $upload_data = $this->img_upload->data();
                    $imgs_data[] = array(
                        'intra_news_img_ref_id' => $intra_news_id,
                        'intra_news_img_img' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_intra_news_img', $imgs_data);
        }

        // Insert data into tbl_intra_news_file
        $pdf_data = array();

        if (!empty($_FILES['intra_news_file_pdf_multiple']['name'][0])) {
            foreach ($_FILES['intra_news_file_pdf_multiple']['name'] as $index => $name) {
                $_FILES['intra_news_file_pdf_multiple']['name'] = $name;
                $_FILES['intra_news_file_pdf_multiple']['type'] = $_FILES['intra_news_file_pdf_multiple']['type'][$index];
                $_FILES['intra_news_file_pdf_multiple']['tmp_name'] = $_FILES['intra_news_file_pdf_multiple']['tmp_name'][$index];
                $_FILES['intra_news_file_pdf_multiple']['error'] = $_FILES['intra_news_file_pdf_multiple']['error'][$index];
                $_FILES['intra_news_file_pdf_multiple']['size'] = $_FILES['intra_news_file_pdf_multiple']['size'][$index];

                if ($this->pdf_upload->do_upload('intra_news_file_pdf_multiple')) {
                    $upload_data = $this->pdf_upload->data();
                    $pdf_data[] = array(
                        'intra_news_file_ref_id' => $intra_news_id,
                        'intra_news_file_pdf' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_intra_news_file', $pdf_data);
        }

        // Send Line Notify
        $message = "เรื่อง: " . $intra_news_data['intra_news_topic'] . "\n";
        $message .= "รายละเอียด: " . strip_tags($intra_news_data['intra_news_detail']) . "\n";
        $message .= "ชื่อผู้เพิ่มข้อมูล: " . $intra_news_data['intra_news_by'] . "\n";

        $this->sendLineNotifyImg($message, $img_data['full_path']);
        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);

        return $intra_news_id;
    }

    private function sendLineNotifyImg($message, $imagePath = null)
    {
        $headers = [
            'Authorization: Bearer ' . $this->lineNotifyAccessToken,
        ];

        $data = [
            'message' => $message,
        ];

        if ($imagePath) {
            $data['imageFile'] = curl_file_create($imagePath);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->lineNotifyApiUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        // Handle the response as needed
        echo "Line Notify API Response: $response";
    }
    private $lineNotifyApiUrl = 'https://notify-api.line.me/api/notify';
    private $lineNotifyAccessToken = 'wYiezr5sxQETJEMuFdYAPCTW1K9Z19eLTnKkT66wxq7';

    public function list_all()
    {
        $this->db->order_by('intra_news_id', 'DESC');
        $query = $this->db->get('tbl_intra_news');
        return $query->result();
    }

    //show form edit
    public function read($intra_news_id)
    {
        $this->db->where('intra_news_id', $intra_news_id);
        $query = $this->db->get('tbl_intra_news');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function read_file($intra_news_id)
    {
        $this->db->where('intra_news_file_ref_id', $intra_news_id);
        $this->db->order_by('intra_news_file_id', 'DESC');
        $query = $this->db->get('tbl_intra_news_file');
        return $query->result();
    }

    public function read_img($intra_news_id)
    {
        $this->db->where('intra_news_img_ref_id', $intra_news_id);
        $this->db->order_by('intra_news_img_id', 'DESC');
        $query = $this->db->get('tbl_intra_news_img');
        return $query->result();
    }

    public function del_pdf($file_id)
    {
        // ดึงชื่อไฟล์ PDF จากฐานข้อมูลโดยใช้ $file_id
        $this->db->select('intra_news_file_pdf');
        $this->db->where('intra_news_file_id', $file_id);
        $query = $this->db->get('tbl_intra_news_file');
        $file_data = $query->row();

        // ลบไฟล์จากแหล่งที่เก็บไฟล์ (อาจต้องใช้ unlink หรือวิธีอื่น)
        $file_path = './docs/intranet/file/' . $file_data->intra_news_file_pdf;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // ลบข้อมูลของไฟล์จากฐานข้อมูล
        $this->db->where('intra_news_file_id', $file_id);
        $this->db->delete('tbl_intra_news_file');
    }

    public function del_img($file_id)
    {
        // ดึงชื่อไฟล์ PDF จากฐานข้อมูลโดยใช้ $file_id
        $this->db->select('intra_news_img_img');
        $this->db->where('intra_news_img_id', $file_id);
        $query = $this->db->get('tbl_intra_news_img');
        $file_data = $query->row();

        // ลบไฟล์จากแหล่งที่เก็บไฟล์ (อาจต้องใช้ unlink หรือวิธีอื่น)
        $file_path = './docs/intranet/img/' . $file_data->intra_news_img_img;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // ลบข้อมูลของไฟล์จากฐานข้อมูล
        $this->db->where('intra_news_img_id', $file_id);
        $this->db->delete('tbl_intra_news_img');
        $this->space_model->update_server_current();
        $this->session->set_flashdata('del_success', TRUE);
    }

    public function edit($intra_news_id)
    {
        // Update intra_news information
        $data = array(
            'intra_news_topic' => $this->input->post('intra_news_topic'),
            'intra_news_detail' => $this->input->post('intra_news_detail'),
            'intra_news_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
        );

        $this->db->where('intra_news_id', $intra_news_id);
        $this->db->update('tbl_intra_news', $data);

        // หาพื้นที่ว่าง และอัพโหลดlimit จากฐานข้อมูล
        $used_space = $this->space_model->get_used_space();
        $upload_limit = $this->space_model->get_limit_storage();

        $total_space_required = 0;
        // ตรวจสอบว่ามีข้อมูลรูปภาพเพิ่มเติมหรือไม่
        if (isset($_FILES['intra_news_img_img'])) {
            foreach ($_FILES['intra_news_img_img']['name'] as $index => $name) {
                if (isset($_FILES['intra_news_img_img']['size'][$index])) {
                    $total_space_required += $_FILES['intra_news_img_img']['size'][$index];
                }
            }
        }

        // ตรวจสอบว่ามีข้อมูลไฟล์ PDF หรือไม่
        if (isset($_FILES['intra_news_file_pdf'])) {
            foreach ($_FILES['intra_news_file_pdf']['name'] as $index => $name) {
                if (isset($_FILES['intra_news_file_pdf']['size'][$index])) {
                    $total_space_required += $_FILES['intra_news_file_pdf']['size'][$index];
                }
            }
        }

        // เช็คค่าว่าง
        if ($used_space + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('intra_news_backend/adding');
            return;
        }

        $pdf_config['upload_path'] = './docs/intranet/file';
        $pdf_config['allowed_types'] = 'pdf';
        $this->load->library('upload', $pdf_config, 'pdf_upload');

        $img_config['upload_path'] = './docs/intranet/img';
        $img_config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $img_config, 'img_upload');

        // ทำการอัปโหลดรูปภาพ
        $img_main = $this->img_upload->do_upload('intra_news_img');

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพหรือไม่
        if (!empty($img_main)) {
            $this->db->trans_start(); // เริ่ม Transaction

            // ดึงข้อมูลรูปเก่า
            $old_document = $this->db->get_where('tbl_intra_news', array('intra_news_id' => $intra_news_id))->row();

            // ตรวจสอบว่ามีไฟล์เก่าหรือไม่
            if ($old_document && $old_document->intra_news_img) {
                $old_file_path = './docs/intranet/img/' . $old_document->intra_news_img;

                if (file_exists($old_file_path)) {
                    unlink($old_file_path); // ลบไฟล์เก่า
                }
            }

            // ถ้ามีการอัปโหลดรูปภาพใหม่
            $img_data['intra_news_img'] = $this->img_upload->data('file_name');
            $this->db->where('intra_news_id', $intra_news_id);
            $this->db->update('tbl_intra_news', $img_data);

            $this->db->trans_complete(); // สิ้นสุด Transaction
        }

        $imgs_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['intra_news_img_img']['name'][0])) {

            foreach ($_FILES['intra_news_img_img']['name'] as $index => $name) {
                $_FILES['intra_news_img_img_multiple']['name'] = $name;
                $_FILES['intra_news_img_img_multiple']['type'] = $_FILES['intra_news_img_img']['type'][$index];
                $_FILES['intra_news_img_img_multiple']['tmp_name'] = $_FILES['intra_news_img_img']['tmp_name'][$index];
                $_FILES['intra_news_img_img_multiple']['error'] = $_FILES['intra_news_img_img']['error'][$index];
                $_FILES['intra_news_img_img_multiple']['size'] = $_FILES['intra_news_img_img']['size'][$index];

                if ($this->img_upload->do_upload('intra_news_img_img_multiple')) {
                    $upload_data = $this->img_upload->data();
                    $imgs_data[] = array(
                        'intra_news_img_ref_id' => $intra_news_id,
                        'intra_news_img_img' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_intra_news_img', $imgs_data);
        }

        $pdf_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['intra_news_file_pdf']['name'][0])) {
            foreach ($_FILES['intra_news_file_pdf']['name'] as $index => $name) {
                $_FILES['intra_news_file_pdf_multiple']['name'] = $name;
                $_FILES['intra_news_file_pdf_multiple']['type'] = $_FILES['intra_news_file_pdf']['type'][$index];
                $_FILES['intra_news_file_pdf_multiple']['tmp_name'] = $_FILES['intra_news_file_pdf']['tmp_name'][$index];
                $_FILES['intra_news_file_pdf_multiple']['error'] = $_FILES['intra_news_file_pdf']['error'][$index];
                $_FILES['intra_news_file_pdf_multiple']['size'] = $_FILES['intra_news_file_pdf']['size'][$index];

                if ($this->pdf_upload->do_upload('intra_news_file_pdf_multiple')) {
                    $upload_data = $this->pdf_upload->data();
                    $pdf_data[] = array(
                        'intra_news_file_ref_id' => $intra_news_id,
                        'intra_news_file_pdf' => $upload_data['file_name']
                    );
                }
            }
            $this->db->insert_batch('tbl_intra_news_file', $pdf_data);
        }
        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }
    public function del_intra_news($intra_news_id)
    {
        $old_document = $this->db->get_where('tbl_intra_news', array('intra_news_id' => $intra_news_id))->row();

        $old_file_path = './docs/intranet/img/' . $old_document->intra_news_img;
        if (file_exists($old_file_path)) {
            unlink($old_file_path);
        }

        $this->db->delete('tbl_intra_news', array('intra_news_id' => $intra_news_id));
        $this->space_model->update_server_current();
    }

    public function del_intra_news_pdf($intra_news_id)
    {
        // ดึงข้อมูลรายการรูปภาพก่อน
        $files = $this->db->get_where('tbl_intra_news_file', array('intra_news_file_ref_id' => $intra_news_id))->result();

        // ลบรูปภาพจากตาราง tbl_intra_news_file
        $this->db->where('intra_news_file_ref_id', $intra_news_id);
        $this->db->delete('tbl_intra_news_file');

        // ลบไฟล์รูปภาพที่เกี่ยวข้อง
        foreach ($files as $files) {
            $file_path = './docs/intranet/file/' . $files->intra_news_file_pdf;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }

    public function del_intra_news_img($intra_news_id)
    {
        // ดึงข้อมูลรายการรูปภาพก่อน
        $files = $this->db->get_where('tbl_intra_news_img', array('intra_news_img_ref_id' => $intra_news_id))->result();

        // ลบรูปภาพจากตาราง tbl_intra_news_file
        $this->db->where('intra_news_img_ref_id', $intra_news_id);
        $this->db->delete('tbl_intra_news_img');

        // ลบไฟล์รูปภาพที่เกี่ยวข้อง
        foreach ($files as $files) {
            $file_path = './docs/intranet/img/' . $files->intra_news_img_img;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }

    public function search($search_term)
    {
        // ปรับแต่ง query ตามความต้องการ
        $this->db->like('intra_news_topic', $search_term);
        $this->db->or_like('intra_news_detail', $search_term);
        // เพิ่มเงื่อนไขค้นหาเพิ่มเติมตามความต้องการ

        $query = $this->db->get('tbl_intra_news');
        return $query->result();
    }
}
