<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Position_backend extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('position_model');
	}


	// public function index()
	// {
	// 	$data['query'] = $this->position_model->list_position();

	// 	// echo '<pre>';
	// 	// print_r($data);
	// 	// echo '</pre>';
	// 	// exit;

	// 	$this->load->view('templat/header');
	// 	$this->load->view('asset/css');
	// 	$this->load->view('templat/navbar_system_admin');
	// 	$this->load->view('system_admin/position', $data);
	// 	$this->load->view('asset/js');
	// 	$this->load->view('templat/footer');
	// }

	// public function adding()
	// {
	// 	$this->load->view('templat/header');
	// 	$this->load->view('asset/css');
	// 	$this->load->view('templat/navbar_system_admin');
	// 	$this->load->view('system_admin/position_form_add');
	// 	$this->load->view('asset/js');
	// 	$this->load->view('templat/footer');
	// }

	// public function adddata()
	// {
	// 	$this->position_model->addposition();
	// 	redirect('position','refresh');
	// }

	// public function edit($pid)
	// {
	// 	$data['rsedit'] = $this->position_model->read($pid);

	// 	$this->load->view('templat/header');
	// 	$this->load->view('asset/css');
	// 	$this->load->view('templat/navbar_system_admin');
	// 	$this->load->view('system_admin/position_form_edit', $data);
	// 	$this->load->view('asset/js');
	// 	$this->load->view('templat/footer');
	// }

	// public function editdata() {

	// 	// echo '<pre>';
	// 	// print_r($_POST);
	// 	// echo '</pre>';
	// 	// exit;
	// 	$this->position_model->editposition();
	// 	redirect('position','refresh');
	// }

    // public function del($pid)
	// {
    //     // print_r($_POST);
    //     $this->position_model->deldata($pid);
    //     redirect('', 'refresh');
    // }

}
