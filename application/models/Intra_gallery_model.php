<?php
class Intra_gallery_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('space_model');
    }

    public function add()
    {
        // Configure image upload
        $img_config['upload_path'] = './docs/intranet/img';
        $img_config['allowed_types'] = 'jpg|png|jpeg';
        $this->load->library('upload', $img_config, 'img_upload');

        // Configure video upload
        $video_config['upload_path'] = './docs/intranet/video';
        $video_config['allowed_types'] = 'mp4|webm|ogg|avi|m4v|mov|mpg|mpeg|wmv';
        $this->load->library('upload', $video_config, 'video_upload');

        // กำหนดค่าใน $intra_gallery_data
        $intra_gallery_data = array(
            'intra_gallery_name' => $this->input->post('intra_gallery_name'),
            'intra_gallery_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
        );

        // เพิ่มข้อมูลลงในฐานข้อมูล
        $this->db->insert('tbl_intra_gallery', $intra_gallery_data);
        $intra_gallery_id = $this->db->insert_id();

        // หาพื้นที่ว่าง และอัพโหลดlimit จากฐานข้อมูล
        $used_space = $this->space_model->get_used_space();
        $upload_limit = $this->space_model->get_limit_storage();

        $total_space_required = 0;
        // ตรวจสอบว่ามีข้อมูลรูปภาพเพิ่มเติมหรือไม่
        if (isset($_FILES['intra_gallery_img_img'])) {
            foreach ($_FILES['intra_gallery_img_img']['name'] as $index => $name) {
                if (isset($_FILES['intra_gallery_img_img']['size'][$index])) {
                    $total_space_required += $_FILES['intra_gallery_img_img']['size'][$index];
                }
            }
        }

        // เช็คค่าว่าง
        if ($used_space + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('intra_gallery_backend/adding');
            return;
        }

        $imgs_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['intra_gallery_img_img']['name'][0])) {
            foreach ($_FILES['intra_gallery_img_img']['name'] as $index => $name) {
                $_FILES['intra_gallery_img_img_multiple']['name'] = $name;
                $_FILES['intra_gallery_img_img_multiple']['type'] = $_FILES['intra_gallery_img_img']['type'][$index];
                $_FILES['intra_gallery_img_img_multiple']['tmp_name'] = $_FILES['intra_gallery_img_img']['tmp_name'][$index];
                $_FILES['intra_gallery_img_img_multiple']['error'] = $_FILES['intra_gallery_img_img']['error'][$index];
                $_FILES['intra_gallery_img_img_multiple']['size'] = $_FILES['intra_gallery_img_img']['size'][$index];

                if ($this->img_upload->do_upload('intra_gallery_img_img_multiple')) {
                    $upload_data = $this->img_upload->data();
                    $imgs_data[] = array(
                        'intra_gallery_img_ref_id' => $intra_gallery_id,
                        'intra_gallery_img_img' => $upload_data['file_name'],
                        'intra_gallery_img_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
                    );
                }
            }
            $this->db->insert_batch('tbl_intra_gallery_img', $imgs_data);
        }

        // ตรวจสอบว่ามีข้อมูลวิดีโอเพิ่มเติมหรือไม่
        if (isset($_FILES['intra_gallery_video_video'])) {
            foreach ($_FILES['intra_gallery_video_video']['name'] as $index => $name) {
                if (isset($_FILES['intra_gallery_video_video']['size'][$index])) {
                    $total_space_required += $_FILES['intra_gallery_video_video']['size'][$index];
                }
            }
        }

        // เช็คค่าว่าง
        if ($used_space + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('intra_gallery_backend/adding');
            return;
        }

        $videos_data = array();

        // ตรวจสอบว่ามีการอัปโหลดวิดีโอเพิ่มเติมหรือไม่
        if (!empty($_FILES['intra_gallery_video_video']['name'][0])) {
            foreach ($_FILES['intra_gallery_video_video']['name'] as $index => $name) {
                $_FILES['intra_gallery_video_video_multiple']['name'] = $name;
                $_FILES['intra_gallery_video_video_multiple']['type'] = $_FILES['intra_gallery_video_video']['type'][$index];
                $_FILES['intra_gallery_video_video_multiple']['tmp_name'] = $_FILES['intra_gallery_video_video']['tmp_name'][$index];
                $_FILES['intra_gallery_video_video_multiple']['error'] = $_FILES['intra_gallery_video_video']['error'][$index];
                $_FILES['intra_gallery_video_video_multiple']['size'] = $_FILES['intra_gallery_video_video']['size'][$index];

                if ($this->video_upload->do_upload('intra_gallery_video_video_multiple')) {
                    $upload_data = $this->video_upload->data();
                    $videos_data[] = array(
                        'intra_gallery_video_ref_id' => $intra_gallery_id,
                        'intra_gallery_video_video' => $upload_data['file_name'],
                        'intra_gallery_video_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
                    );
                }
            }
            $this->db->insert_batch('tbl_intra_gallery_video', $videos_data);
        }

        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }

    public function list_all()
    {
        $this->db->select('*');
        $this->db->from('tbl_intra_gallery');
        $this->db->group_by('tbl_intra_gallery.intra_gallery_id');
        $this->db->order_by('tbl_intra_gallery.intra_gallery_id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    //show form edit
    public function read($intra_gallery_id)
    {
        $this->db->where('intra_gallery_id', $intra_gallery_id);
        $query = $this->db->get('tbl_intra_gallery');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            return $data;
        }
        return FALSE;
    }

    public function read_img($intra_gallery_id)
    {
        $this->db->where('intra_gallery_img_ref_id', $intra_gallery_id);
        $this->db->order_by('intra_gallery_img_id', 'DESC');
        $query = $this->db->get('tbl_intra_gallery_img');
        return $query->result();
    }
    public function read_video($intra_gallery_id)
    {
        $this->db->where('intra_gallery_video_ref_id', $intra_gallery_id);
        $this->db->order_by('intra_gallery_video_id', 'DESC');
        $query = $this->db->get('tbl_intra_gallery_video');
        return $query->result();
    }

    public function del_img($file_id)
    {
        // ดึงชื่อไฟล์ PDF จากฐานข้อมูลโดยใช้ $file_id
        $this->db->select('intra_gallery_img_img');
        $this->db->where('intra_gallery_img_id', $file_id);
        $query = $this->db->get('tbl_intra_gallery_img');
        $file_data = $query->row();

        // ลบไฟล์จากแหล่งที่เก็บไฟล์ (อาจต้องใช้ unlink หรือวิธีอื่น)
        $file_path = './docs/intranet/img/' . $file_data->intra_gallery_img_img;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // ลบข้อมูลของไฟล์จากฐานข้อมูล
        $this->db->where('intra_gallery_img_id', $file_id);
        $this->db->delete('tbl_intra_gallery_img');
        $this->space_model->update_server_current();
        $this->session->set_flashdata('del_success', TRUE);
    }

    public function del_video($file_id)
    {
        // ดึงชื่อไฟล์ PDF จากฐานข้อมูลโดยใช้ $file_id
        $this->db->select('intra_gallery_video_video');
        $this->db->where('intra_gallery_video_id', $file_id);
        $query = $this->db->get('tbl_intra_gallery_video');
        $file_data = $query->row();

        // ลบไฟล์จากแหล่งที่เก็บไฟล์ (อาจต้องใช้ unlink หรือวิธีอื่น)
        $file_path = './docs/intranet/video/' . $file_data->intra_gallery_video_video;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // ลบข้อมูลของไฟล์จากฐานข้อมูล
        $this->db->where('intra_gallery_video_id', $file_id);
        $this->db->delete('tbl_intra_gallery_video');
        $this->space_model->update_server_current();
        $this->session->set_flashdata('del_success', TRUE);
    }

    public function del_intra_gallery($intra_gallery_id)
    {
        $this->db->delete('tbl_intra_gallery', array('intra_gallery_id' => $intra_gallery_id));
        $this->space_model->update_server_current();
    }

    public function del_intra_gallery_img($intra_gallery_id)
    {
        // ดึงข้อมูลรายการรูปภาพก่อน
        $files = $this->db->get_where('tbl_intra_gallery_img', array('intra_gallery_img_ref_id' => $intra_gallery_id))->result();

        // ลบรูปภาพจากตาราง tbl_intra_gallery_file
        $this->db->where('intra_gallery_img_ref_id', $intra_gallery_id);
        $this->db->delete('tbl_intra_gallery_img');

        // ลบไฟล์รูปภาพที่เกี่ยวข้อง
        foreach ($files as $files) {
            $file_path = './docs/intranet/img/' . $files->intra_gallery_img_img;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }

    public function del_intra_gallery_video($intra_gallery_id)
    {
        // ดึงข้อมูลรายการรูปภาพก่อน
        $files = $this->db->get_where('tbl_intra_gallery_video', array('intra_gallery_video_ref_id' => $intra_gallery_id))->result();

        // ลบรูปภาพจากตาราง tbl_intra_gallery_file
        $this->db->where('intra_gallery_video_ref_id', $intra_gallery_id);
        $this->db->delete('tbl_intra_gallery_video');

        // ลบไฟล์รูปภาพที่เกี่ยวข้อง
        foreach ($files as $files) {
            $file_path = './docs/intranet/video/' . $files->intra_gallery_video_video;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }

    public function updateintra_galleryStatus()
    {
        // ตรวจสอบว่ามีการส่งข้อมูล POST มาหรือไม่
        if ($this->input->post()) {
            $intra_galleryId = $this->input->post('intra_gallery_id'); // รับค่า intra_gallery_id
            $intra_gallerytatus = $this->input->post('new_status'); // รับค่าใหม่จาก switch checkbox

            // ทำการอัพเดตค่าในตาราง tbl_intra_gallery ในฐานข้อมูลของคุณ
            $data = array(
                'intra_gallery_status' => $intra_gallerytatus
            );
            $this->db->where('intra_gallery_id', $intra_galleryId); // ระบุ intra_gallery_id ของแถวที่ต้องการอัพเดต
            $this->db->update('tbl_intra_gallery', $data);

            // ส่งการตอบกลับ (response) กลับไปยังเว็บไซต์หรือแอพพลิเคชันของคุณ
            // โดยเช่นปกติคุณอาจส่ง JSON response กลับมาเพื่ออัพเดตหน้าเว็บ
            $response = array('status' => 'success', 'message' => 'อัพเดตสถานะเรียบร้อย');
            echo json_encode($response);
        } else {
            // ถ้าไม่มีข้อมูล POST ส่งมา ให้รีเดอร์เปรียบเสมอ
            show_404();
        }
    }

    public function sum_intra_gallery_views()
    {
        $this->db->select('SUM(intra_gallery_view) as total_views');
        $this->db->from('tbl_intra_gallery');
        $query = $this->db->get();

        return $query->row()->total_views;
    }

    public function intra_gallery_frontend()
    {
        $this->db->select('*');
        $this->db->from('tbl_intra_gallery');
        $this->db->where('tbl_intra_gallery.intra_gallery_status', 'show');
        $this->db->limit(4);
        $this->db->order_by('tbl_intra_gallery.intra_gallery_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function intra_gallery_frontend_list()
    {
        $this->db->select('*');
        $this->db->from('tbl_intra_gallery');
        $this->db->where('tbl_intra_gallery.intra_gallery_status', 'show');
        $this->db->order_by('tbl_intra_gallery.intra_gallery_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function increment_view($intra_gallery_id)
    {
        $this->db->where('intra_gallery_id', $intra_gallery_id);
        $this->db->set('intra_gallery_view', 'intra_gallery_view + 1', false); // บวกค่า intra_gallery_view ทีละ 1
        $this->db->update('tbl_intra_gallery');
    }
    public function increment_dowload_intra_gallery($intra_gallery_file_id)
    {
        $this->db->where('intra_gallery_file_id', $intra_gallery_file_id);
        $this->db->set('intra_gallery_file_dowload', 'intra_gallery_file_dowload + 1', false); // บวกค่า intra_gallery_dowload ทีละ 1
        $this->db->update('tbl_intra_gallery_file');
    }

    public function add_img($intra_gallery_id)
    {
        // Configure image upload
        $img_config['upload_path'] = './docs/intranet/img';
        $img_config['allowed_types'] = 'jpg|png|jpeg';
        $this->load->library('upload', $img_config, 'img_upload');

        // Configure video upload
        $video_config['upload_path'] = './docs/intranet/video';
        $video_config['allowed_types'] = 'mp4|webm|ogg|avi|m4v|mov|mpg|mpeg|wmv';
        $this->load->library('upload', $video_config, 'video_upload');

        // หาพื้นที่ว่าง และอัพโหลดlimit จากฐานข้อมูล
        $used_space = $this->space_model->get_used_space();
        $upload_limit = $this->space_model->get_limit_storage();

        $total_space_required = 0;
        // ตรวจสอบว่ามีข้อมูลรูปภาพเพิ่มเติมหรือไม่
        if (isset($_FILES['intra_gallery_img_img'])) {
            foreach ($_FILES['intra_gallery_img_img']['name'] as $index => $name) {
                if (isset($_FILES['intra_gallery_img_img']['size'][$index])) {
                    $total_space_required += $_FILES['intra_gallery_img_img']['size'][$index];
                }
            }
        }

        // เช็คค่าว่าง
        if ($used_space + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('intra_gallery_backend/adding');
            return;
        }

        $imgs_data = array();

        // ตรวจสอบว่ามีการอัปโหลดรูปภาพเพิ่มเติมหรือไม่
        if (!empty($_FILES['intra_gallery_img_img']['name'][0])) {
            foreach ($_FILES['intra_gallery_img_img']['name'] as $index => $name) {
                $_FILES['intra_gallery_img_img_multiple']['name'] = $name;
                $_FILES['intra_gallery_img_img_multiple']['type'] = $_FILES['intra_gallery_img_img']['type'][$index];
                $_FILES['intra_gallery_img_img_multiple']['tmp_name'] = $_FILES['intra_gallery_img_img']['tmp_name'][$index];
                $_FILES['intra_gallery_img_img_multiple']['error'] = $_FILES['intra_gallery_img_img']['error'][$index];
                $_FILES['intra_gallery_img_img_multiple']['size'] = $_FILES['intra_gallery_img_img']['size'][$index];

                if ($this->img_upload->do_upload('intra_gallery_img_img_multiple')) {
                    $upload_data = $this->img_upload->data();
                    $imgs_data[] = array(
                        'intra_gallery_img_ref_id' => $intra_gallery_id,
                        'intra_gallery_img_img' => $upload_data['file_name'],
                        'intra_gallery_img_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
                    );
                }
            }
            $this->db->insert_batch('tbl_intra_gallery_img', $imgs_data);
        }

        // ตรวจสอบว่ามีข้อมูลวิดีโอเพิ่มเติมหรือไม่
        if (isset($_FILES['intra_gallery_video_video'])) {
            foreach ($_FILES['intra_gallery_video_video']['name'] as $index => $name) {
                if (isset($_FILES['intra_gallery_video_video']['size'][$index])) {
                    $total_space_required += $_FILES['intra_gallery_video_video']['size'][$index];
                }
            }
        }

        // เช็คค่าว่าง
        if ($used_space + ($total_space_required / (1024 * 1024 * 1024)) >= $upload_limit) {
            $this->session->set_flashdata('save_error', TRUE);
            redirect('intra_gallery_backend/adding');
            return;
        }

        $videos_data = array();

        // ตรวจสอบว่ามีการอัปโหลดวิดีโอเพิ่มเติมหรือไม่
        if (!empty($_FILES['intra_gallery_video_video']['name'][0])) {
            foreach ($_FILES['intra_gallery_video_video']['name'] as $index => $name) {
                $_FILES['intra_gallery_video_video_multiple']['name'] = $name;
                $_FILES['intra_gallery_video_video_multiple']['type'] = $_FILES['intra_gallery_video_video']['type'][$index];
                $_FILES['intra_gallery_video_video_multiple']['tmp_name'] = $_FILES['intra_gallery_video_video']['tmp_name'][$index];
                $_FILES['intra_gallery_video_video_multiple']['error'] = $_FILES['intra_gallery_video_video']['error'][$index];
                $_FILES['intra_gallery_video_video_multiple']['size'] = $_FILES['intra_gallery_video_video']['size'][$index];

                if ($this->video_upload->do_upload('intra_gallery_video_video_multiple')) {
                    $upload_data = $this->video_upload->data();
                    $videos_data[] = array(
                        'intra_gallery_video_ref_id' => $intra_gallery_id,
                        'intra_gallery_video_video' => $upload_data['file_name'],
                        'intra_gallery_video_by' => $this->session->userdata('m_fname'), // เพิ่มชื่อคนที่แก้ไขข้อมูล
                    );
                }
            }
            $this->db->insert_batch('tbl_intra_gallery_video', $videos_data);
        }

        $this->space_model->update_server_current();
        $this->session->set_flashdata('save_success', TRUE);
    }

    public function search($search_term)
    {
        // ปรับแต่ง query ตามความต้องการ
        $this->db->like('intra_gallery_name', $search_term);
        // เพิ่มเงื่อนไขค้นหาเพิ่มเติมตามความต้องการ

        $query = $this->db->get('tbl_intra_gallery');
        return $query->result();
    }
}
