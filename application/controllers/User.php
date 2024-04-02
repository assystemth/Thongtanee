<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('member_model');
	}
	public function index()
	{
		$previous_page = $this->session->userdata('previous_page');

		// เช็คว่าเข้าสู่ระบบแล้วหรือยัง
		if ($this->session->userdata('m_id')) {
			// ระดับของผู้ใช้
			$m_level = $this->session->userdata('m_level');
			redirect($this->get_redirect_url($m_level), 'refresh');
		}

		if (!empty($previous_page)) {
			redirect($previous_page); // redirect ไปยังหน้าที่เคยเข้ามาจาก
		}

		// print_r($_SESSION);
		// $this->load->view('templat/header');
		$this->load->view('asset/css');
		// $this->load->view('templat/navbar_login');
		$this->load->view('login_form_admin');
		$this->load->view('asset/js');
		$this->load->view('templat/footer');
	}

	public function check2()
	{
		if ($this->input->post('m_username') == '') {
			$this->load->view('Home/login');
		} else {
			$result = $this->member_model->fetch_user_login(
				$this->input->post('m_username'),
				sha1($this->input->post('m_password'))
			);

			if (!empty($result)) {
				// ตรวจสอบว่าบัญชีผู้ใช้ถูกบล็อคหรือไม่
				if ($result->m_status == 0) {
					echo "<script>";
					echo "alert('คุณถูกบล็อค โปรดติดต่อผู้ให้บริการ');";
					echo "window.history.back();";
					echo "</script>";
				} else {
					// ตรวจสอบว่าผู้ใช้ต้องการจดจำเข้าสู่ระบบหรือไม่
					if ($this->input->post('remember_me')) {
						// สร้างคุกกี้ที่มีข้อมูลเข้ารหัส
						$encrypted_data = password_hash($result->m_password, PASSWORD_DEFAULT);
						$this->input->set_cookie('remember', json_encode(['id' => $result->m_id, 'data' => $encrypted_data]), 3600 * 24 * 30);
					}

					$sess = array(
						'm_id' => $result->m_id,
						'm_level' => $result->ref_pid,
						'm_fname' => $result->m_fname,
						'm_lname' => $result->m_lname,
						'm_img' => $result->m_img,
					);

					$this->session->set_userdata($sess);

					$m_level = $_SESSION['m_level'];

					redirect($this->get_redirect_url($m_level), 'refresh');
				}
			} else {
				echo "<script>";
				echo "alert('รหัสผ่านหรือชื่อผู้ใช้งานไม่ถูกต้อง');";
				echo "window.history.back();";
				echo "</script>";
			}
		}
	}

	private function get_redirect_url($level)
	{
		switch ($level) {
			case 1:
				return 'System_admin';
			case 2:
				return 'System_admin';
			default:
			echo "<script>";
			echo "alert('ไม่สามารถเข้าสู่ระบบได้ เนื่องจากคุณไม่ใช่ผู้ดูแลระบบ');";
			// echo "window.history.back();";
			echo "</script>";
			$this->logout(); // เรียกใช้ฟังก์ชั่น logout หากไม่พบระดับผู้ใช้งานที่เกี่ยวข้องกับการเด้ง
			return 'Home/login';

		}
	}

	public function logout()
	{
		$this->session->unset_userdata(array('m_id', 'm_level', 'm_lname', 'm_name'));
		redirect('Home/login', 'refresh');
	}

	public function forgotPassword()
	{
		$this->load->view('asset/css');
		$this->load->view('forgotPassword');
		$this->load->view('asset/js');
		$this->load->view('templat/footer');
	}

	public function sendEmail()
	{
		$this->load->library('email');

		$email = $this->input->post('email');

		// สร้างโทเค็นสำหรับการรีเซ็ตรหัสผ่าน
		$reset_token = bin2hex(random_bytes(32));

		// บันทึกโทเค็นลงในฐานข้อมูล
		$this->db->set('reset_token', $reset_token);
		$this->db->set('reset_expiration', date('Y-m-d H:i:s', time() + 600));
		$this->db->where('m_email', $email);
		$this->db->update('tbl_member');

		$config['mailtype'] = 'html';
		$this->email->initialize($config);

		$reset_link = base_url('user/resetPassword/' . $reset_token);

		$this->email->from('no-reply@thongtanee.go.th', 'Admin');
		$this->email->to($email);
		$this->email->subject('Reset Password');
		$this->email->message('คลิก <a href="' . $reset_link . '">ที่นี่</a> เพื่อรีเซ็ตรหัสผ่านของคุณ');


		if ($this->email->send()) {
			echo "<script>";
			echo "alert('ส่งอีเมลสำเร็จ');";
			echo "window.history.back();";
			echo "</script>";
		} else {
			echo 'Email could not be sent. Error: ' . $this->email->print_debugger();
		}
	}

	public function resetPassword($reset_token)
	{
		// ค้นหาผู้ใช้โดยใช้โทเค็นที่ส่งมากับ URL
		$user = $this->db->get_where('tbl_member', ['reset_token' => $reset_token])->row_array();

		// ตรวจสอบว่าโทเค็นถูกต้องและเวลาหมดอายุยังไม่ถึง
		if ($user && $user['reset_expiration'] > date('Y-m-d H:i:s')) {
			// โทเค็นถูกต้องและเวลาหมดอายุยังไม่ถึง
			// แสดงหน้าเปลี่ยนรหัสผ่านใหม่
			$this->load->view('asset/css');
			$this->load->view('resetPassword');
			$this->load->view('asset/js');
			$this->load->view('templat/footer');
		} else {
			echo "<script>";
			echo "alert('โทเค็นไม่ถูกต้องหรือหมดอายุ!!');";
			echo "</script>";
		}
	}

	public function changePassword()
	{
		$new_password = $this->input->post('new_password');
		$confirm_password = $this->input->post('confirm_password');
		$email = $this->input->post('email');

		if ($new_password !== $confirm_password) {
			// รหัสผ่านและรหัสผ่านยืนยันไม่ตรงกัน
			// แสดงข้อความผิดพลาดหรือทำอะไรตามที่คุณต้องการ
			echo "<script>";
			echo "alert('รหัสผ่านและรหัสผ่านยืนยันไม่ตรงกัน??');";
			echo "window.history.back();";
			echo "</script>";
		} else {
			// รหัสผ่านตรงกัน
			// ทำการเปลี่ยนรหัสผ่านในฐานข้อมูล
			// และอื่น ๆ ตามที่คุณต้องการ
			$this->db->set('m_password', sha1($new_password));
			$this->db->set('reset_token', NULL); // เคลียร์คอลัมน์ reset_token
			$this->db->set('reset_expiration', NULL); // เคลียร์คอลัมน์ reset_expiration
			$this->db->where('m_email', $email);
			$this->db->update('tbl_member');

			// แสดงข้อความว่ารหัสผ่านถูกรีเซ็ตเรียบร้อย
			echo "<script>";
			echo "alert('รหัสผ่านถูกรีเซ็ตเรียบร้อย!!');";
			echo "</script>";
		}
		redirect('user');
	}

	public function privacy()
	{

		// print_r($_SESSION);
		// $this->load->view('templat/header');
		$this->load->view('asset/css');
		// $this->load->view('templat/navbar_login');
		$this->load->view('privacy');
		$this->load->view('asset/js');
		$this->load->view('templat/footer');
	}
}
