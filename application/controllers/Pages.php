<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('activity_model');
		$this->load->model('news_model');
		$this->load->model('announce_model');
		$this->load->model('order_model');
		$this->load->model('procurement_model');
		$this->load->model('mui_model');
		$this->load->model('guide_work_model');
		$this->load->model('loadform_model');
		$this->load->model('msg_pres_model');

		$this->load->model('history_model');
		$this->load->model('otop_model');
		$this->load->model('gci_model');
		$this->load->model('vision_model');
		$this->load->model('authority_model');
		$this->load->model('mission_model');
		$this->load->model('cmi_model');
		$this->load->model('executivepolicy_model');
		$this->load->model('travel_model');
		$this->load->model('si_model');

		$this->load->model('p_executives_model');
		$this->load->model('p_council_model');
		$this->load->model('p_unit_leaders_model');
		$this->load->model('p_deputy_model');
		$this->load->model('p_treasury_model');
		$this->load->model('p_maintenance_model');
		$this->load->model('p_education_model');
		$this->load->model('p_audit_model');

		$this->load->model('plan_pdl_model');
		$this->load->model('plan_pc3y_model');
		$this->load->model('plan_pds3y_model');
		$this->load->model('plan_pdpa_model');
		$this->load->model('plan_dpy_model');
		$this->load->model('plan_poa_model');
		$this->load->model('plan_pcra_model');
		$this->load->model('plan_pop_model');
		$this->load->model('plan_paca_model');
		$this->load->model('plan_psi_model');
		$this->load->model('plan_pmda_model');

		$this->load->model('canon_bgps_model');
		$this->load->model('canon_chh_model');
		$this->load->model('canon_ritw_model');
		$this->load->model('canon_market_model');
		$this->load->model('canon_rmwp_model');
		$this->load->model('canon_rcp_model');
		$this->load->model('canon_rcsp_model');

		$this->load->model('pbsv_cac_model');
		$this->load->model('pbsv_cig_model');
		$this->load->model('pbsv_cjc_model');
		$this->load->model('pbsv_sags_model');
		$this->load->model('pbsv_ahs_model');
		$this->load->model('pbsv_oppr_model');
		$this->load->model('pbsv_ems_model');
		$this->load->model('pbsv_gup_model');
		$this->load->model('pbsv_e_book_model');

		$this->load->model('operation_reauf_model');
		$this->load->model('p_rpo_model');
		$this->load->model('p_reb_model');
		$this->load->model('operation_sap_model');
		$this->load->model('operation_pm_model');
		$this->load->model('operation_policy_hr_model');
		$this->load->model('operation_am_hr_model');
		$this->load->model('operation_rdam_hr_model');
		$this->load->model('operation_cdm_model');
		$this->load->model('operation_po_model');
		$this->load->model('operation_eco_model');
		$this->load->model('operation_pgn_model');
		$this->load->model('operation_mcc_model');
		$this->load->model('operation_aca_model');
		$this->load->model('lpa_model');
		$this->load->model('ita_model');
		$this->load->model('operation_procurement_model');
		$this->load->model('operation_aa_model');
		$this->load->model('operation_aditn_model');

		$this->load->model('newsletter_model');
		$this->load->model('q_a_model');
		$this->load->model('complain_model');
		$this->load->model('corruption_model');
		$this->load->model('suggestions_model');
		$this->load->model('questions_model');
		$this->load->model('site_map_model');
		$this->load->model('laws_ral_model');
		$this->load->model('laws_rl_folder_model');
		$this->load->model('laws_rl_file_model');
		$this->load->model('laws_rm_model');
		$this->load->model('laws_act_model');
		$this->load->model('laws_ec_model');
		$this->load->model('laws_la_model');
		$this->load->model('form_esv_model');
		$this->load->model('esv_ods_model');
		$this->load->model('ita_year_model');
		$this->load->model('km_model');
	}

	// public function index()
	// {
	// 	$data['qHotnews'] = $this->HotNews_model->hotnews_frontend();
	// 	$data['qBanner'] = $this->banner_model->banner_frontend();
	// 	$data['qActivity'] = $this->activity_model->activity_frontend();
	// 	$data['qNews'] = $this->news_model->news_frontend();
	// 	$data['qAnnounce'] = $this->announce_model->announce_frontend();
	// 	$data['qProcurement'] = $this->procurement_model->procurement_frontend();

	// 	$this->load->view('frontend_templat/header');
	// 	$this->load->view('frontend_asset/css');
	// 	$this->load->view('frontend_templat/navbar');
	// 	$this->load->view('frontend/home', $data);
	// 	$this->load->view('frontend_asset/js');
	// 	$this->load->view('frontend_templat/footer');
	// }
	public function activity()
	{
		$data['query'] = $this->activity_model->activity_frontend_list();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/activity', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function activity_detail($activity_id)
	{
		$this->activity_model->increment_activity_view($activity_id);

		$data['rsActivity'] = $this->activity_model->read_activity($activity_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsActivity']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}
		$data['rsImg'] = $this->activity_model->read_img_activity_font($activity_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/activity_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function news()
	{
		$data['query'] = $this->news_model->news_frontend_list();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/news', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function news_detail($news_id)
	{
		$this->news_model->increment_view($news_id);

		$data['rsData'] = $this->news_model->read($news_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsImg'] = $this->news_model->read_img($news_id);
		$data['rsFile'] = $this->news_model->read_file($news_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/news_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_news($news_file_id)
	{
		$this->news_model->increment_download_news($news_file_id);
	}
	public function order()
	{
		$data['query'] = $this->order_model->order_frontend_list();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/order', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function order_detail($order_id)
	{
		$this->order_model->increment_view($order_id);

		$data['rsData'] = $this->order_model->read($order_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->order_model->read_file($order_id);
		$data['rsImg'] = $this->order_model->read_img($order_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/order_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}

	public function increment_download_order($order_file_id)
	{
		$this->order_model->increment_download_order($order_file_id);
	}
	public function announce()
	{
		$data['query'] = $this->announce_model->announce_frontend_list();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/announce', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function announce_detail($announce_id)
	{
		$this->announce_model->increment_view($announce_id);

		$data['rsData'] = $this->announce_model->read($announce_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->announce_model->read_file($announce_id);
		$data['rsImg'] = $this->announce_model->read_img($announce_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/announce_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}

	public function increment_download_announce($announce_file_id)
	{
		$this->announce_model->increment_download_announce($announce_file_id);
	}
	public function procurement()
	{
		$data['query'] = $this->procurement_model->procurement_frontend_list();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/procurement', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function procurement_detail($procurement_id)
	{
		$this->procurement_model->increment_view($procurement_id);

		$data['rsData'] = $this->procurement_model->read($procurement_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->procurement_model->read_file($procurement_id);
		$data['rsImg'] = $this->procurement_model->read_img($procurement_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/procurement_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_procurement($procurement_file_id)
	{
		$this->procurement_model->increment_download_procurement($procurement_file_id);
	}
	public function mui()
	{
		$data['query'] = $this->mui_model->mui_frontend_list();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/mui', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function mui_detail($mui_id)
	{
		$this->mui_model->increment_view($mui_id);

		$data['rsData'] = $this->mui_model->read($mui_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->mui_model->read_file($mui_id);
		$data['rsImg'] = $this->mui_model->read_img($mui_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/mui_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_mui($mui_file_id)
	{
		$this->mui_model->increment_download_mui($mui_file_id);
	}
	public function guide_work()
	{
		$data['query'] = $this->guide_work_model->guide_work_frontend_list();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/guide_work', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function guide_work_detail($guide_work_id)
	{
		$this->guide_work_model->increment_view($guide_work_id);

		$data['rsData'] = $this->guide_work_model->read($guide_work_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->guide_work_model->read_file($guide_work_id);
		$data['rsImg'] = $this->guide_work_model->read_img($guide_work_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/guide_work_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_guide_work($guide_work_file_id)
	{
		$this->guide_work_model->increment_download_guide_work($guide_work_file_id);
	}
	public function loadform()
	{
		$data['query'] = $this->loadform_model->loadform_frontend_list();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/loadform', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function loadform_detail($loadform_id)
	{
		$this->loadform_model->increment_view($loadform_id);

		$data['rsData'] = $this->loadform_model->read($loadform_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->loadform_model->read_file($loadform_id);
		$data['rsImg'] = $this->loadform_model->read_img($loadform_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/loadform_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_loadform($loadform_file_id)
	{
		$this->loadform_model->increment_download_loadform($loadform_file_id);
	}
	public function e_gp()
	{
		// URL of the Open API
		$api_url = 'https://opend.data.go.th/govspending/cgdcontract?api-key=TH3JFBwJZlaXdDCpcVfSFGuoofCJ1heX&year=2566&dept_code=6320120&budget_start=0&budget_end=1000000000&offset=0&limit=500&keyword=&winner_tin=';

		// Fetch data from the API
		$api_data = file_get_contents($api_url);

		// Check if data is fetched successfully
		if ($api_data !== FALSE) {
			// Decode the JSON data
			$json_data = json_decode($api_data, TRUE);

			// Check if JSON decoding is successful
			if ($json_data !== NULL) {
				// Pass JSON data to the view
				$data['json_data'] = $json_data;

				$this->load->view('frontend_templat/header');
				$this->load->view('frontend_asset/css');
				$this->load->view('frontend_templat/navbar_other');
				$this->load->view('frontend/e_gp', $data);
				$this->load->view('frontend_asset/js');
				$this->load->view('frontend_templat/footer');
			}
		}
	}
	public function otop()
	{
		$data['qOtop'] = $this->otop_model->otop_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/otop', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function history()
	{
		$data['qHistory'] = $this->history_model->history_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/history', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function vision()
	{
		$data['qVision'] = $this->vision_model->vision_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/vision', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function gci()
	{
		$data['qGci'] = $this->gci_model->gci_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/gci', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function authority()
	{
		$data['qAuthority'] = $this->authority_model->authority_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/authority', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function mission()
	{
		$data['qMission'] = $this->mission_model->mission_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/mission', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function ci()
	{
		$data['qCi'] = $this->cmi_model->ci_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/ci', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function executivepolicy()
	{
		$this->executivepolicy_model->increment_view();

		$data['qExecutivepolicy'] = $this->executivepolicy_model->executivepolicy_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/executivepolicy', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_executivepolicy()
	{
		$this->executivepolicy_model->increment_download_executivepolicy();
	}
	public function msg_pres()
	{
		$this->msg_pres_model->increment_view();

		$data['query'] = $this->msg_pres_model->msg_pres_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/msg_pres', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_msg_pres()
	{
		$this->msg_pres_model->increment_download_msg_pres();
	}
	public function travel()
	{
		$data['query'] = $this->travel_model->travel_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/travel', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function travel_detail($travel_id)
	{
		$this->travel_model->increment_travel_view($travel_id);

		$data['rsTravel'] = $this->travel_model->read_travel($travel_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsTravel']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsImg'] = $this->travel_model->read_img_travel_font($travel_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/travel_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function si()
	{
		$data['qSi'] = $this->si_model->si_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/si', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function canon_bgps()
	{
		$data['query'] = $this->canon_bgps_model->canon_bgps_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/canon_bgps', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function canon_bgps_detail($canon_bgps_id)
	{
		$this->canon_bgps_model->increment_view($canon_bgps_id);

		$data['rsData'] = $this->canon_bgps_model->read($canon_bgps_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->canon_bgps_model->read_file($canon_bgps_id);
		$data['rsImg'] = $this->canon_bgps_model->read_img($canon_bgps_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/canon_bgps_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_canon_bgps($canon_bgps_file_id)
	{
		$this->canon_bgps_model->increment_download_canon_bgps($canon_bgps_file_id);
	}
	public function canon_chh()
	{
		$data['query'] = $this->canon_chh_model->canon_chh_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/canon_chh', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function canon_chh_detail($canon_chh_id)
	{
		$this->canon_chh_model->increment_view($canon_chh_id);

		$data['rsData'] = $this->canon_chh_model->read($canon_chh_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->canon_chh_model->read_file($canon_chh_id);
		$data['rsImg'] = $this->canon_chh_model->read_Img($canon_chh_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/canon_chh_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_canon_chh($canon_chh_file_id)
	{
		$this->canon_chh_model->increment_download_canon_chh($canon_chh_file_id);
	}
	public function canon_ritw()
	{
		$data['query'] = $this->canon_ritw_model->canon_ritw_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/canon_ritw', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function canon_ritw_detail($canon_ritw_id)
	{
		$this->canon_ritw_model->increment_view($canon_ritw_id);

		$data['rsData'] = $this->canon_ritw_model->read($canon_ritw_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->canon_ritw_model->read_file($canon_ritw_id);
		$data['rsImg'] = $this->canon_ritw_model->read_img($canon_ritw_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/canon_ritw_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_canon_ritw($canon_ritw_file_id)
	{
		$this->canon_ritw_model->increment_download_canon_ritw($canon_ritw_file_id);
	}
	public function canon_market()
	{
		$data['query'] = $this->canon_market_model->canon_market_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/canon_market', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function canon_market_detail($canon_market_id)
	{
		$this->canon_market_model->increment_view($canon_market_id);

		$data['rsData'] = $this->canon_market_model->read($canon_market_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->canon_market_model->read_file($canon_market_id);
		$data['rsImg'] = $this->canon_market_model->read_img($canon_market_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/canon_market_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_canon_market($canon_market_file_id)
	{
		$this->canon_market_model->increment_download_canon_market($canon_market_file_id);
	}
	public function canon_rmwp()
	{
		$data['query'] = $this->canon_rmwp_model->canon_rmwp_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/canon_rmwp', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function canon_rmwp_detail($canon_rmwp_id)
	{
		$this->canon_rmwp_model->increment_view($canon_rmwp_id);

		$data['rsData'] = $this->canon_rmwp_model->read($canon_rmwp_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->canon_rmwp_model->read_file($canon_rmwp_id);
		$data['rsImg'] = $this->canon_rmwp_model->read_img($canon_rmwp_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/canon_rmwp_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_canon_rmwp($canon_rmwp_file_id)
	{
		$this->canon_rmwp_model->increment_download_canon_rmwp($canon_rmwp_file_id);
	}
	public function canon_rcsp()
	{
		$data['query'] = $this->canon_rcsp_model->canon_rcsp_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/canon_rcsp', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function canon_rcsp_detail($canon_rcsp_id)
	{
		$this->canon_rcsp_model->increment_view($canon_rcsp_id);

		$data['rsData'] = $this->canon_rcsp_model->read($canon_rcsp_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->canon_rcsp_model->read_file($canon_rcsp_id);
		$data['rsImg'] = $this->canon_rcsp_model->read_img($canon_rcsp_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/canon_rcsp_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_canon_rcsp($canon_rcsp_file_id)
	{
		$this->canon_rcsp_model->increment_download_canon_rcsp($canon_rcsp_file_id);
	}
	public function canon_rcp()
	{
		$data['query'] = $this->canon_rcp_model->canon_rcp_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/canon_rcp', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function canon_rcp_detail($canon_rcp_id)
	{
		$this->canon_rcp_model->increment_view($canon_rcp_id);

		$data['rsData'] = $this->canon_rcp_model->read($canon_rcp_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->canon_rcp_model->read_file($canon_rcp_id);
		$data['rsImg'] = $this->canon_rcp_model->read_img($canon_rcp_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/canon_rcp_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_canon_rcp($canon_rcp_file_id)
	{
		$this->canon_rcp_model->increment_download_canon_rcp($canon_rcp_file_id);
	}
	public function plan_pdl()
	{
		$data['query'] = $this->plan_pdl_model->plan_pdl_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/plan_pdl', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function plan_pdl_detail($plan_pdl_id)
	{
		$this->plan_pdl_model->increment_view($plan_pdl_id);

		$data['rsData'] = $this->plan_pdl_model->read($plan_pdl_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsImg'] = $this->plan_pdl_model->read_img($plan_pdl_id);
		$data['rsFile'] = $this->plan_pdl_model->read_file($plan_pdl_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/plan_pdl_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_plan_pdl($plan_pdl_file_id)
	{
		$this->plan_pdl_model->increment_download_plan_pdl($plan_pdl_file_id);
	}
	public function plan_pc3y()
	{
		$data['query'] = $this->plan_pc3y_model->plan_pc3y_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/plan_pc3y', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function plan_pc3y_detail($pc3y_id)
	{
		$this->plan_pc3y_model->increment_view($pc3y_id);

		$data['rsData'] = $this->plan_pc3y_model->read($pc3y_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsImg'] = $this->plan_pc3y_model->read_img($pc3y_id);
		$data['rsFile'] = $this->plan_pc3y_model->read_file($pc3y_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/plan_pc3y_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_plan_pc3y($pc3y_file_id)
	{
		$this->plan_pc3y_model->increment_download_plan_pc3y($pc3y_file_id);
	}
	public function plan_pds3y()
	{
		$data['query'] = $this->plan_pds3y_model->plan_pds3y_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/plan_pds3y', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function plan_pds3y_detail($plan_pds3y_id)
	{
		$this->plan_pds3y_model->increment_view($plan_pds3y_id);

		$data['rsData'] = $this->plan_pds3y_model->read($plan_pds3y_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->plan_pds3y_model->read_file($plan_pds3y_id);
		$data['rsImg'] = $this->plan_pds3y_model->read_img($plan_pds3y_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/plan_pds3y_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_plan_pds3y($plan_pds3y_file_id)
	{
		$this->plan_pds3y_model->increment_download_plan_pds3y($plan_pds3y_file_id);
	}
	public function plan_pdpa()
	{
		$data['query'] = $this->plan_pdpa_model->plan_pdpa_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/plan_pdpa', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function plan_pdpa_detail($plan_pdpa_id)
	{
		$this->plan_pdpa_model->increment_view($plan_pdpa_id);

		$data['rsData'] = $this->plan_pdpa_model->read($plan_pdpa_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->plan_pdpa_model->read_file($plan_pdpa_id);
		$data['rsImg'] = $this->plan_pdpa_model->read_img($plan_pdpa_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/plan_pdpa_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_plan_pdpa($plan_pdpa_file_id)
	{
		$this->plan_pdpa_model->increment_download_plan_pdpa($plan_pdpa_file_id);
	}
	public function plan_dpy()
	{
		$data['query'] = $this->plan_dpy_model->plan_dpy_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/plan_dpy', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function plan_dpy_detail($plan_dpy_id)
	{
		$this->plan_dpy_model->increment_view($plan_dpy_id);

		$data['rsData'] = $this->plan_dpy_model->read($plan_dpy_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->plan_dpy_model->read_file($plan_dpy_id);
		$data['rsImg'] = $this->plan_dpy_model->read_img($plan_dpy_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/plan_dpy_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_plan_dpy($plan_dpy_file_id)
	{
		$this->plan_dpy_model->increment_download_plan_dpy($plan_dpy_file_id);
	}
	public function plan_poa()
	{
		$data['query'] = $this->plan_poa_model->plan_poa_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/plan_poa', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function plan_poa_detail($plan_poa_id)
	{
		$this->plan_poa_model->increment_view($plan_poa_id);

		$data['rsData'] = $this->plan_poa_model->read($plan_poa_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->plan_poa_model->read_file($plan_poa_id);
		$data['rsImg'] = $this->plan_poa_model->read_img($plan_poa_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/plan_poa_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_plan_poa($plan_poa_file_id)
	{
		$this->plan_poa_model->increment_download_plan_poa($plan_poa_file_id);
	}
	public function plan_pcra()
	{
		$data['query'] = $this->plan_pcra_model->plan_pcra_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/plan_pcra', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function plan_pcra_detail($plan_pcra_id)
	{
		$this->plan_pcra_model->increment_view($plan_pcra_id);

		$data['rsData'] = $this->plan_pcra_model->read($plan_pcra_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->plan_pcra_model->read_file($plan_pcra_id);
		$data['rsImg'] = $this->plan_pcra_model->read_img($plan_pcra_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/plan_pcra_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_plan_pcra($plan_pcra_file_id)
	{
		$this->plan_pcra_model->increment_download_plan_pcra($plan_pcra_file_id);
	}
	public function plan_pop()
	{
		$data['query'] = $this->plan_pop_model->plan_pop_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/plan_pop', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function plan_pop_detail($plan_pop_id)
	{
		$this->plan_pop_model->increment_view($plan_pop_id);

		$data['rsData'] = $this->plan_pop_model->read($plan_pop_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->plan_pop_model->read_file($plan_pop_id);
		$data['rsImg'] = $this->plan_pop_model->read_img($plan_pop_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/plan_pop_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_plan_pop($plan_pop_file_id)
	{
		$this->plan_pop_model->increment_download_plan_pop($plan_pop_file_id);
	}
	public function plan_paca()
	{
		$data['query'] = $this->plan_paca_model->plan_paca_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/plan_paca', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function plan_paca_detail($plan_paca_id)
	{
		$this->plan_paca_model->increment_view($plan_paca_id);

		$data['rsData'] = $this->plan_paca_model->read($plan_paca_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->plan_paca_model->read_file($plan_paca_id);
		$data['rsImg'] = $this->plan_paca_model->read_img($plan_paca_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/plan_paca_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_plan_paca($plan_paca_file_id)
	{
		$this->plan_paca_model->increment_download_plan_paca($plan_paca_file_id);
	}
	public function plan_psi()
	{
		$data['query'] = $this->plan_psi_model->plan_psi_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/plan_psi', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function plan_psi_detail($plan_psi_id)
	{
		$this->plan_psi_model->increment_view($plan_psi_id);

		$data['rsData'] = $this->plan_psi_model->read($plan_psi_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->plan_psi_model->read_file($plan_psi_id);
		$data['rsImg'] = $this->plan_psi_model->read_img($plan_psi_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/plan_psi_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_plan_psi($plan_psi_file_id)
	{
		$this->plan_psi_model->increment_download_plan_psi($plan_psi_file_id);
	}
	public function plan_pmda()
	{
		$data['query'] = $this->plan_pmda_model->plan_pmda_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/plan_pmda', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function plan_pmda_detail($plan_pmda_id)
	{
		$this->plan_pmda_model->increment_view($plan_pmda_id);

		$data['rsData'] = $this->plan_pmda_model->read($plan_pmda_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->plan_pmda_model->read_file($plan_pmda_id);
		$data['rsImg'] = $this->plan_pmda_model->read_img($plan_pmda_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/plan_pmda_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_plan_pmda($plan_pmda_file_id)
	{
		$this->plan_pmda_model->increment_download_plan_pmda($plan_pmda_file_id);
	}
	public function pbsv_cac()
	{
		$data['query'] = $this->pbsv_cac_model->pbsv_cac_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/pbsv_cac', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function pbsv_cac_detail($pbsv_cac_id)
	{
		$this->pbsv_cac_model->increment_view($pbsv_cac_id);

		$data['rsData'] = $this->pbsv_cac_model->read($pbsv_cac_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->pbsv_cac_model->read_file($pbsv_cac_id);
		$data['rsImg'] = $this->pbsv_cac_model->read_img($pbsv_cac_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/pbsv_cac_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_pbsv_cac($pbsv_cac_file_id)
	{
		$this->pbsv_cac_model->increment_download_pbsv_cac($pbsv_cac_file_id);
	}
	public function pbsv_cig()
	{
		$data['query'] = $this->pbsv_cig_model->pbsv_cig_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/pbsv_cig', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function pbsv_cig_detail($pbsv_cig_id)
	{
		$this->pbsv_cig_model->increment_view($pbsv_cig_id);

		$data['rsData'] = $this->pbsv_cig_model->read($pbsv_cig_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->pbsv_cig_model->read_file($pbsv_cig_id);
		$data['rsImg'] = $this->pbsv_cig_model->read_img($pbsv_cig_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/pbsv_cig_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_pbsv_cig($pbsv_cig_file_id)
	{
		$this->pbsv_cig_model->increment_download_pbsv_cig($pbsv_cig_file_id);
	}
	public function pbsv_cjc()
	{
		$data['query'] = $this->pbsv_cjc_model->pbsv_cjc_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/pbsv_cjc', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function pbsv_cjc_detail($pbsv_cjc_id)
	{
		$this->pbsv_cjc_model->increment_view($pbsv_cjc_id);

		$data['rsData'] = $this->pbsv_cjc_model->read($pbsv_cjc_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->pbsv_cjc_model->read_file($pbsv_cjc_id);
		$data['rsImg'] = $this->pbsv_cjc_model->read_img($pbsv_cjc_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/pbsv_cjc_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_pbsv_cjc($pbsv_cjc_file_id)
	{
		$this->pbsv_cjc_model->increment_download_pbsv_cjc($pbsv_cjc_file_id);
	}
	public function pbsv_sags()
	{
		$data['query'] = $this->pbsv_sags_model->pbsv_sags_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/pbsv_sags', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function pbsv_sags_detail($pbsv_sags_id)
	{
		$this->pbsv_sags_model->increment_view($pbsv_sags_id);

		$data['rsData'] = $this->pbsv_sags_model->read($pbsv_sags_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->pbsv_sags_model->read_file($pbsv_sags_id);
		$data['rsImg'] = $this->pbsv_sags_model->read_img($pbsv_sags_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/pbsv_sags_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_pbsv_sags($pbsv_sags_file_id)
	{
		$this->pbsv_sags_model->increment_download_pbsv_sags($pbsv_sags_file_id);
	}
	public function pbsv_ahs()
	{
		$data['query'] = $this->pbsv_ahs_model->pbsv_ahs_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/pbsv_ahs', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function pbsv_ahs_detail($pbsv_ahs_id)
	{
		$this->pbsv_ahs_model->increment_view($pbsv_ahs_id);

		$data['rsData'] = $this->pbsv_ahs_model->read($pbsv_ahs_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->pbsv_ahs_model->read_file($pbsv_ahs_id);
		$data['rsImg'] = $this->pbsv_ahs_model->read_img($pbsv_ahs_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/pbsv_ahs_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_pbsv_ahs($pbsv_ahs_file_id)
	{
		$this->pbsv_ahs_model->increment_download_pbsv_ahs($pbsv_ahs_file_id);
	}
	public function pbsv_oppr()
	{
		$data['query'] = $this->pbsv_oppr_model->pbsv_oppr_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/pbsv_oppr', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function pbsv_oppr_detail($pbsv_oppr_id)
	{
		$this->pbsv_oppr_model->increment_view($pbsv_oppr_id);

		$data['rsData'] = $this->pbsv_oppr_model->read($pbsv_oppr_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->pbsv_oppr_model->read_file($pbsv_oppr_id);
		$data['rsImg'] = $this->pbsv_oppr_model->read_img($pbsv_oppr_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/pbsv_oppr_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_pbsv_oppr($pbsv_oppr_file_id)
	{
		$this->pbsv_oppr_model->increment_download_pbsv_oppr($pbsv_oppr_file_id);
	}
	public function pbsv_ems()
	{
		$data['query'] = $this->pbsv_ems_model->pbsv_ems_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/pbsv_ems', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function pbsv_ems_detail($pbsv_ems_id)
	{
		$this->pbsv_ems_model->increment_view($pbsv_ems_id);

		$data['rsData'] = $this->pbsv_ems_model->read($pbsv_ems_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->pbsv_ems_model->read_file($pbsv_ems_id);
		$data['rsImg'] = $this->pbsv_ems_model->read_img($pbsv_ems_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/pbsv_ems_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_pbsv_ems($pbsv_ems_file_id)
	{
		$this->pbsv_ems_model->increment_download_pbsv_ems($pbsv_ems_file_id);
	}
	public function pbsv_gup()
	{
		$data['query'] = $this->pbsv_gup_model->pbsv_gup_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/pbsv_gup', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function pbsv_gup_detail($pbsv_gup_id)
	{
		$this->pbsv_gup_model->increment_view($pbsv_gup_id);

		$data['rsData'] = $this->pbsv_gup_model->read($pbsv_gup_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->pbsv_gup_model->read_file($pbsv_gup_id);
		$data['rsImg'] = $this->pbsv_gup_model->read_img($pbsv_gup_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/pbsv_gup_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_pbsv_gup($pbsv_gup_file_id)
	{
		$this->pbsv_gup_model->increment_download_pbsv_gup($pbsv_gup_file_id);
	}
	public function pbsv_e_book()
	{
		$data['query'] = $this->pbsv_e_book_model->pbsv_e_book_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/pbsv_e_book', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function pbsv_e_book_detail($pbsv_e_book_id)
	{
		$this->pbsv_e_book_model->increment_view($pbsv_e_book_id);

		$data['rsData'] = $this->pbsv_e_book_model->read($pbsv_e_book_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->pbsv_e_book_model->read_file($pbsv_e_book_id);
		$data['rsImg'] = $this->pbsv_e_book_model->read_img($pbsv_e_book_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/pbsv_e_book_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_pbsv_e_book($pbsv_e_book_file_id)
	{
		$this->pbsv_e_book_model->increment_download_pbsv_e_book($pbsv_e_book_file_id);
	}
	public function operation_reauf()
	{
		$data['query'] = $this->operation_reauf_model->operation_reauf_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_reauf', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function operation_reauf_detail($operation_reauf_id)
	{
		$this->operation_reauf_model->increment_view($operation_reauf_id);

		$data['rsData'] = $this->operation_reauf_model->read($operation_reauf_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->operation_reauf_model->read_file($operation_reauf_id);
		$data['rsImg'] = $this->operation_reauf_model->read_img($operation_reauf_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_reauf_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_operation_reauf($operation_reauf_file_id)
	{
		$this->operation_reauf_model->increment_download_operation_reauf($operation_reauf_file_id);
	}
	public function p_rpo()
	{
		$data['query'] = $this->p_rpo_model->p_rpo_frontend_list();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/p_rpo', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function p_rpo_detail($p_rpo_id)
	{
		$this->p_rpo_model->increment_view($p_rpo_id);

		$data['rsData'] = $this->p_rpo_model->read($p_rpo_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->p_rpo_model->read_file($p_rpo_id);
		$data['rsImg'] = $this->p_rpo_model->read_img($p_rpo_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/p_rpo_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_p_rpo($p_rpo_file_id)
	{
		$this->p_rpo_model->increment_download_p_rpo($p_rpo_file_id);
	}
	public function p_reb()
	{
		$data['query'] = $this->p_reb_model->p_reb_frontend_list();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/p_reb', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function p_reb_detail($p_reb_id)
	{
		$this->p_reb_model->increment_view($p_reb_id);

		$data['rsData'] = $this->p_reb_model->read($p_reb_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->p_reb_model->read_file($p_reb_id);
		$data['rsImg'] = $this->p_reb_model->read_img($p_reb_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/p_reb_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_p_reb($p_reb_file_id)
	{
		$this->p_reb_model->increment_download_p_reb($p_reb_file_id);
	}
	public function operation_sap()
	{
		$data['query'] = $this->operation_sap_model->operation_sap_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_sap', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function operation_sap_detail($operation_sap_id)
	{
		$this->operation_sap_model->increment_view($operation_sap_id);

		$data['rsData'] = $this->operation_sap_model->read($operation_sap_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->operation_sap_model->read_file($operation_sap_id);
		$data['rsImg'] = $this->operation_sap_model->read_img($operation_sap_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_sap_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_operation_sap($operation_sap_file_id)
	{
		$this->operation_sap_model->increment_download_operation_sap($operation_sap_file_id);
	}
	public function operation_pm()
	{
		$data['query'] = $this->operation_pm_model->operation_pm_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar');
		$this->load->view('frontend/operation_pm', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function operation_pm_detail($operation_pm_id)
	{
		$this->operation_pm_model->increment_view($operation_pm_id);

		$data['rsData'] = $this->operation_pm_model->read($operation_pm_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->operation_pm_model->read_file($operation_pm_id);
		$data['rsImg'] = $this->operation_pm_model->read_img($operation_pm_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar');
		$this->load->view('frontend/operation_pm_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_operation_pm($operation_pm_file_id)
	{
		$this->operation_pm_model->increment_download_operation_pm($operation_pm_file_id);
	}
	public function operation_policy_hr()
	{
		$data['query'] = $this->operation_policy_hr_model->operation_policy_hr_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar');
		$this->load->view('frontend/operation_policy_hr', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function operation_policy_hr_detail($operation_policy_hr_id)
	{
		$this->operation_policy_hr_model->increment_view($operation_policy_hr_id);

		$data['rsData'] = $this->operation_policy_hr_model->read($operation_policy_hr_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->operation_policy_hr_model->read_file($operation_policy_hr_id);
		$data['rsImg'] = $this->operation_policy_hr_model->read_img($operation_policy_hr_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_policy_hr_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_operation_policy_hr($operation_policy_hr_file_id)
	{
		$this->operation_policy_hr_model->increment_download_operation_policy_hr($operation_policy_hr_file_id);
	}
	public function operation_am_hr()
	{
		$data['query'] = $this->operation_am_hr_model->operation_am_hr_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_am_hr', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function operation_am_hr_detail($operation_am_hr_id)
	{
		$this->operation_am_hr_model->increment_view($operation_am_hr_id);

		$data['rsData'] = $this->operation_am_hr_model->read($operation_am_hr_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->operation_am_hr_model->read_file($operation_am_hr_id);
		$data['rsImg'] = $this->operation_am_hr_model->read_img($operation_am_hr_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_am_hr_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_operation_am_hr($operation_am_hr_file_id)
	{
		$this->operation_am_hr_model->increment_download_operation_am_hr($operation_am_hr_file_id);
	}
	public function operation_rdam_hr()
	{
		$data['query'] = $this->operation_rdam_hr_model->operation_rdam_hr_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_rdam_hr', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function operation_rdam_hr_detail($operation_rdam_hr_id)
	{
		$this->operation_rdam_hr_model->increment_view($operation_rdam_hr_id);

		$data['rsData'] = $this->operation_rdam_hr_model->read($operation_rdam_hr_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->operation_rdam_hr_model->read_file($operation_rdam_hr_id);
		$data['rsImg'] = $this->operation_rdam_hr_model->read_img($operation_rdam_hr_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_rdam_hr_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_operation_rdam_hr($operation_rdam_hr_file_id)
	{
		$this->operation_rdam_hr_model->increment_download_operation_rdam_hr($operation_rdam_hr_file_id);
	}
	public function operation_cdm_topic()
	{
		$data['query'] = $this->operation_cdm_model->operation_cdm_frontend_list_topic();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_cdm_topic', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function operation_cdm($operation_cdm_type_id)
	{
		$data['query'] = $this->operation_cdm_model->operation_cdm_frontend_list($operation_cdm_type_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_cdm', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function operation_cdm_detail($operation_cdm_id)
	{
		$this->operation_cdm_model->increment_view($operation_cdm_id);

		$data['rsData'] = $this->operation_cdm_model->read($operation_cdm_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->operation_cdm_model->read_file($operation_cdm_id);
		$data['rsImg'] = $this->operation_cdm_model->read_img($operation_cdm_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_cdm_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}

	public function increment_download_operation_cdm($operation_cdm_file_id)
	{
		$this->operation_cdm_model->increment_download_operation_cdm($operation_cdm_file_id);
	}
	public function operation_po()
	{
		$data['query'] = $this->operation_po_model->operation_po_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_po', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function operation_po_detail($operation_po_id)
	{
		$this->operation_po_model->increment_view($operation_po_id);

		$data['rsData'] = $this->operation_po_model->read($operation_po_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->operation_po_model->read_file($operation_po_id);
		$data['rsImg'] = $this->operation_po_model->read_img($operation_po_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_po_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_operation_po($operation_po_file_id)
	{
		$this->operation_po_model->increment_download_operation_po($operation_po_file_id);
	}
	public function operation_eco()
	{
		$data['query'] = $this->operation_eco_model->operation_eco_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_eco', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function operation_eco_detail($operation_eco_id)
	{
		$this->operation_eco_model->increment_view($operation_eco_id);

		$data['rsData'] = $this->operation_eco_model->read($operation_eco_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->operation_eco_model->read_file($operation_eco_id);
		$data['rsImg'] = $this->operation_eco_model->read_img($operation_eco_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_eco_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_operation_eco($operation_eco_file_id)
	{
		$this->operation_eco_model->increment_download_operation_eco($operation_eco_file_id);
	}
	public function operation_pgn()
	{
		$data['query'] = $this->operation_pgn_model->operation_pgn_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_pgn', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function operation_pgn_detail($operation_pgn_id)
	{
		$this->operation_pgn_model->increment_view($operation_pgn_id);

		$data['rsData'] = $this->operation_pgn_model->read($operation_pgn_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->operation_pgn_model->read_file($operation_pgn_id);
		$data['rsImg'] = $this->operation_pgn_model->read_img($operation_pgn_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_pgn_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_operation_pgn($operation_pgn_file_id)
	{
		$this->operation_pgn_model->increment_download_operation_pgn($operation_pgn_file_id);
	}
	public function operation_mcc()
	{
		$data['query'] = $this->operation_mcc_model->operation_mcc_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_mcc', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function operation_mcc_detail($operation_mcc_id)
	{
		$this->operation_mcc_model->increment_view($operation_mcc_id);

		$data['rsData'] = $this->operation_mcc_model->read($operation_mcc_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->operation_mcc_model->read_file($operation_mcc_id);
		$data['rsImg'] = $this->operation_mcc_model->read_img($operation_mcc_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_mcc_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_operation_mcc($operation_mcc_file_id)
	{
		$this->operation_mcc_model->increment_download_operation_mcc($operation_mcc_file_id);
	}
	public function operation_aca()
	{
		$data['query'] = $this->operation_aca_model->operation_aca_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_aca', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function operation_aca_detail($operation_aca_id)
	{
		$this->operation_aca_model->increment_view($operation_aca_id);

		$data['rsData'] = $this->operation_aca_model->read($operation_aca_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->operation_aca_model->read_file($operation_aca_id);
		$data['rsImg'] = $this->operation_aca_model->read_img($operation_aca_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_aca_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_operation_aca($operation_aca_file_id)
	{
		$this->operation_aca_model->increment_download_operation_aca($operation_aca_file_id);
	}
	public function lpa()
	{
		$data['query'] = $this->lpa_model->lpa_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/lpa', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function lpa_detail($lpa_id)
	{
		$this->lpa_model->increment_view($lpa_id);

		$data['rsData'] = $this->lpa_model->read($lpa_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->lpa_model->read_file($lpa_id);
		$data['rsImg'] = $this->lpa_model->read_img($lpa_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/lpa_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_lpa($lpa_file_id)
	{
		$this->lpa_model->increment_download_lpa($lpa_file_id);
	}
	public function ita_all()
	{
		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/ita_all');
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function ita()
	{
		$data['query'] = $this->ita_model->ita_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/ita', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function ita_detail($ita_id)
	{
		$this->ita_model->increment_view($ita_id);

		$data['rsData'] = $this->ita_model->read($ita_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->ita_model->read_file($ita_id);
		$data['rsImg'] = $this->ita_model->read_img($ita_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/ita_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_ita($ita_file_id)
	{
		$this->ita_model->increment_download_ita($ita_file_id);
	}

	public function ita_year()
	{
		$data['query'] = $this->ita_year_model->ita_year_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/ita_year', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function ita_year_detail($ita_year_id)
	{
		$data['query'] = $this->ita_year_model->read($ita_year_id);
		$data['query_topic'] = $this->ita_year_model->get_ita_year_data($ita_year_id);
		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['query']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}
		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/ita_year_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function operation_aditn()
	{
		$data['query'] = $this->operation_aditn_model->operation_aditn_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_aditn', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function operation_aditn_detail($operation_aditn_id)
	{
		$this->operation_aditn_model->increment_view($operation_aditn_id);

		$data['rsData'] = $this->operation_aditn_model->read($operation_aditn_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->operation_aditn_model->read_file($operation_aditn_id);
		$data['rsImg'] = $this->operation_aditn_model->read_img($operation_aditn_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_aditn_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_operation_aditn($operation_aditn_file_id)
	{
		$this->operation_aditn_model->increment_download_operation_aditn($operation_aditn_file_id);
	}
	public function operation_procurement()
	{
		$data['query'] = $this->operation_procurement_model->operation_procurement_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_procurement', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function operation_procurement_detail($operation_procurement_id)
	{
		$this->operation_procurement_model->increment_view($operation_procurement_id);

		$data['rsData'] = $this->operation_procurement_model->read($operation_procurement_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->operation_procurement_model->read_file($operation_procurement_id);
		$data['rsImg'] = $this->operation_procurement_model->read_img($operation_procurement_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_procurement_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_operation_procurement($operation_procurement_file_id)
	{
		$this->operation_procurement_model->increment_download_operation_procurement($operation_procurement_file_id);
	}
	public function operation_aa()
	{
		$data['query'] = $this->operation_aa_model->operation_aa_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_aa', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function operation_aa_detail($operation_aa_id)
	{
		$this->operation_aa_model->increment_view($operation_aa_id);

		$data['rsData'] = $this->operation_aa_model->read($operation_aa_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->operation_aa_model->read_file($operation_aa_id);
		$data['rsImg'] = $this->operation_aa_model->read_img($operation_aa_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/operation_aa_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_operation_aa($operation_aa_file_id)
	{
		$this->operation_aa_model->increment_download_operation_aa($operation_aa_file_id);
	}
	public function newsletter()
	{
		$data['query'] = $this->newsletter_model->newsletter_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/newsletter', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function newsletter_detail($newsletter_id)
	{
		$this->newsletter_model->increment_view($newsletter_id);

		$data['rsData'] = $this->newsletter_model->read($newsletter_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->newsletter_model->read_file($newsletter_id);
		$data['rsImg'] = $this->newsletter_model->read_img($newsletter_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/newsletter_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_newsletter($newsletter_file_id)
	{
		$this->newsletter_model->increment_download_newsletter($newsletter_file_id);
	}

	public function q_a()
	{
		$data['query'] = $this->q_a_model->list_all();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/q_a', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function addding_q_a()
	{
		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/q_a_form_add');
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}

	public function add_q_a()
	{
		// echo '<pre>';
		// print_r($_POST);
		// echo '</pre>';
		// exit;
		$this->q_a_model->add_q_a();
		redirect('Pages/q_a', 'refresh');
	}

	public function q_a_chat($q_a_id)
	{

		$data['rsData'] = $this->q_a_model->read($q_a_id);
		$data['rsReply'] = $this->q_a_model->read_reply($q_a_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/q_a_chat', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function add_reply_q_a()
	{
		$this->q_a_model->add_reply_q_a();
		$q_a_id = $this->input->post('q_a_reply_ref_id'); // ดึง q_a_id จากข้อมูลที่ถูกส่งมา
		redirect("Pages/q_a_chat/{$q_a_id}");
	}

	public function adding_complain()
	{
		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/complain');
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function add_complain()
	{
		// echo '<pre>';
		// print_r($_POST);
		// echo '</pre>';
		// exit;
		$complain_id = $this->complain_model->add_complain();
		$this->complain_model->add_complain_detail($complain_id);
		redirect('Pages/adding_complain', 'refresh');
	}
	public function follow_complain()
	{
		// รับค่าจากฟอร์ม
		$complain_id = $this->input->post('complain_id');

		// Query เพื่อดึงข้อมูลจาก tbl_complain
		$complain_data = $this->db->get_where('tbl_complain', array('complain_id' => $complain_id))->row_array();

		// Query เพื่อดึงข้อมูลจาก tbl_complain_detail
		$complain_details = $this->db->get_where('tbl_complain_detail', array('complain_detail_case_id' => $complain_id))->result_array();

		// ส่งข้อมูลไปยัง View
		$data = array(
			'complain_data' => $complain_data,
			'complain_details' => $complain_details,
		);
		// โหลด View
		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/follow_complain', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function adding_corruption()
	{
		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/corruption');
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function add_corruption()
	{
		// echo '<pre>';
		// print_r($_POST);
		// echo '</pre>';
		// exit;
		$this->corruption_model->add_corruption();
		redirect('Pages/adding_corruption', 'refresh');
	}
	public function adding_suggestions()
	{
		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/suggestions');
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function add_suggestions()
	{
		// echo '<pre>';
		// print_r($_POST);
		// echo '</pre>';
		// exit;
		$this->suggestions_model->add_suggestions();
		redirect('Pages/adding_suggestions', 'refresh');
	}

	public function e_service()
	{
		$data['query1'] = $this->form_esv_model->form_esv_frontend_1();
		$data['query2'] = $this->form_esv_model->form_esv_frontend_2();
		$data['query3'] = $this->form_esv_model->form_esv_frontend_3();
		$data['query4'] = $this->form_esv_model->form_esv_frontend_4();
		$data['query5'] = $this->form_esv_model->form_esv_frontend_5();
		$data['query6'] = $this->form_esv_model->form_esv_frontend_6();
		$data['query7'] = $this->form_esv_model->form_esv_frontend_7();
		$data['query8'] = $this->form_esv_model->form_esv_frontend_8();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/e_service', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}

	public function adding_esv_ods()
	{
		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/esv_ods');
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}

	public function add_esv_ods()
	{
		// echo '<pre>';
		// print_r($_POST);
		// echo '</pre>';
		// exit;
		$this->esv_ods_model->add_esv_ods();
		redirect('Pages/adding_esv_ods');
	}

	public function questions()
	{
		$data['query'] = $this->questions_model->list();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/questions', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}

	public function site_map()
	{
		$data['query'] = $this->site_map_model->list_all();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/site_map', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}

	public function contact()
	{
		// echo '<pre>';
		// print_r($data['rsData']);
		// echo '</pre>';
		// exit();
		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/contact');
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}

	public function all_web()
	{

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/all_web');
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}

	public function p_executives()
	{
		$data['rsOne'] = $this->p_executives_model->p_executives_frontend_one();
		// $data['rsData'] = $this->p_executives_model->p_executives_frontend_list();
		$data['rsrow1'] = $this->p_executives_model->p_executives_row_1();
		$data['rsrow2'] = $this->p_executives_model->p_executives_row_2();
		$data['rsrow3'] = $this->p_executives_model->p_executives_row_3();
		$data['rsrow4'] = $this->p_executives_model->p_executives_row_4();
		$data['rsrow5'] = $this->p_executives_model->p_executives_row_5();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/p_executives', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function p_council()
	{
		$data['rsOne'] = $this->p_council_model->p_council_frontend_one();
		// $data['rsLeft'] = $this->p_council_model->p_council_frontend_one_left();
		// $data['rsRight'] = $this->p_council_model->p_council_frontend_one_right();
		// $data['rsData'] = $this->p_council_model->p_council_frontend_list();
		$data['rsrow1'] = $this->p_council_model->p_council_row_1();
		$data['rsrow2'] = $this->p_council_model->p_council_row_2();
		$data['rsrow3'] = $this->p_council_model->p_council_row_3();
		$data['rsrow4'] = $this->p_council_model->p_council_row_4();
		$data['rsrow5'] = $this->p_council_model->p_council_row_5();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/p_council', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function p_unit_leaders()
	{
		$data['rsOne'] = $this->p_unit_leaders_model->p_unit_leaders_frontend_one();
		// $data['rsData'] = $this->p_unit_leaders_model->p_unit_leaders_frontend_list();
		$data['rsrow1'] = $this->p_unit_leaders_model->p_unit_leaders_row_1();
		$data['rsrow2'] = $this->p_unit_leaders_model->p_unit_leaders_row_2();
		$data['rsrow3'] = $this->p_unit_leaders_model->p_unit_leaders_row_3();
		$data['rsrow4'] = $this->p_unit_leaders_model->p_unit_leaders_row_4();
		$data['rsrow5'] = $this->p_unit_leaders_model->p_unit_leaders_row_5();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/p_unit_leaders', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function p_deputy()
	{
		$data['rsOne'] = $this->p_deputy_model->p_deputy_frontend_one();
		// $data['rsTwo'] = $this->p_deputy_model->p_deputy_frontend_two();
		// $data['rsData'] = $this->p_deputy_model->p_deputy_frontend_list();
		$data['rsrow1'] = $this->p_deputy_model->p_deputy_row_1();
		$data['rsrow2'] = $this->p_deputy_model->p_deputy_row_2();
		$data['rsrow3'] = $this->p_deputy_model->p_deputy_row_3();
		$data['rsrow4'] = $this->p_deputy_model->p_deputy_row_4();
		$data['rsrow5'] = $this->p_deputy_model->p_deputy_row_5();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/p_deputy', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function p_treasury()
	{
		$data['rsOne'] = $this->p_treasury_model->p_treasury_frontend_one();
		// $data['rsTwo'] = $this->p_treasury_model->p_treasury_frontend_two();
		// $data['rsData'] = $this->p_treasury_model->p_treasury_frontend_list();
		$data['rsrow1'] = $this->p_treasury_model->p_treasury_row_1();
		$data['rsrow2'] = $this->p_treasury_model->p_treasury_row_2();
		$data['rsrow3'] = $this->p_treasury_model->p_treasury_row_3();
		$data['rsrow4'] = $this->p_treasury_model->p_treasury_row_4();
		$data['rsrow5'] = $this->p_treasury_model->p_treasury_row_5();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/p_treasury', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function p_maintenance()
	{
		$data['rsOne'] = $this->p_maintenance_model->p_maintenance_frontend_one();
		// $data['rsData'] = $this->p_maintenance_model->p_maintenance_frontend_list();
		$data['rsrow1'] = $this->p_maintenance_model->p_maintenance_row_1();
		$data['rsrow2'] = $this->p_maintenance_model->p_maintenance_row_2();
		$data['rsrow3'] = $this->p_maintenance_model->p_maintenance_row_3();
		$data['rsrow4'] = $this->p_maintenance_model->p_maintenance_row_4();
		$data['rsrow5'] = $this->p_maintenance_model->p_maintenance_row_5();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/p_maintenance', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function p_education()
	{
		$data['rsOne'] = $this->p_education_model->p_education_frontend_one();
		// $data['rsData'] = $this->p_education_model->p_education_frontend_list();
		$data['rsrow1'] = $this->p_education_model->p_education_row_1();
		$data['rsrow2'] = $this->p_education_model->p_education_row_2();
		$data['rsrow3'] = $this->p_education_model->p_education_row_3();
		$data['rsrow4'] = $this->p_education_model->p_education_row_4();
		$data['rsrow5'] = $this->p_education_model->p_education_row_5();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/p_education', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function p_audit()
	{
		$data['rsOne'] = $this->p_audit_model->p_audit_frontend_one();
		// $data['rsData'] = $this->p_audit_model->p_audit_frontend_list();
		$data['rsrow1'] = $this->p_audit_model->p_audit_row_1();
		$data['rsrow2'] = $this->p_audit_model->p_audit_row_2();
		$data['rsrow3'] = $this->p_audit_model->p_audit_row_3();
		$data['rsrow4'] = $this->p_audit_model->p_audit_row_4();
		$data['rsrow5'] = $this->p_audit_model->p_audit_row_5();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/p_audit', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}

	public function laws_all()
	{
		$data['query'] = $this->laws_la_model->list_all();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/laws_all', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}

	public function laws_ral()
	{
		$data['query'] = $this->laws_ral_model->list_all();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/laws_ral', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}

	public function laws_rl_folder()
	{
		$data['query'] = $this->laws_rl_folder_model->list_all();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/laws_rl_folder', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}

	public function laws_rl_file()
	{
		$data['query'] = $this->laws_rl_file_model->list_all();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/laws_rl_file', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}

	public function laws_rm()
	{
		$data['query'] = $this->laws_rm_model->list_all();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/laws_rm', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function laws_act()
	{
		$data['query'] = $this->laws_act_model->list_all();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/laws_act', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function laws_ec()
	{
		$data['query'] = $this->laws_ec_model->list_all();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/laws_ec', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function laws_la($laws_la_id)
	{
		$data['rsData'] = $this->laws_la_model->read($laws_la_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/laws_la', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}

	public function km()
	{
		$data['query'] = $this->km_model->km_frontend();

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/km', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function km_detail($km_id)
	{
		$this->km_model->increment_view($km_id);

		$data['rsData'] = $this->km_model->read($km_id);

		// เพิ่มเงื่อนไขเพื่อตรวจสอบว่ามีข้อมูลหรือไม่
		if (!$data['rsData']) {
			$this->load->view('frontend_templat/header');
			$this->load->view('frontend_asset/css');
			$this->load->view('frontend_templat/navbar_other');
			$this->load->view('frontend/empty_detail_pages');
			$this->load->view('frontend_asset/js');
			$this->load->view('frontend_templat/footer');
			return; // ให้จบการทำงานที่นี่
		}

		$data['rsFile'] = $this->km_model->read_file($km_id);
		$data['rsImg'] = $this->km_model->read_img($km_id);

		$this->load->view('frontend_templat/header');
		$this->load->view('frontend_asset/css');
		$this->load->view('frontend_templat/navbar_other');
		$this->load->view('frontend/km_detail', $data);
		$this->load->view('frontend_asset/js');
		$this->load->view('frontend_templat/footer');
	}
	public function increment_download_km($km_file_id)
	{
		$this->km_model->increment_download_km($km_file_id);
	}
}
