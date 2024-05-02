<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Intra_it extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // if (
        //     $this->session->userdata('m_level') != 1 &&
        //     $this->session->userdata('m_level') != 2 &&
        //     $this->session->userdata('m_level') != 3 &&
        //     $this->session->userdata('m_level') != 4
        // ) {
        //     redirect('user', 'refresh');
        // }
        $this->load->model('Intra_form_model');
        $this->load->model('complain_model');
    }
    // public function index()
    // {
    //     $api_url = 'https://www.assystem.co.th/service_api/index.php';

    //     // Initialize cURL
    //     $curl = curl_init();

    //     // Set cURL options
    //     curl_setopt($curl, CURLOPT_URL, $api_url);
    //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification (for testing purposes only)

    //     // Execute cURL request
    //     $api_data = curl_exec($curl);

    //     // Check for errors
    //     if($api_data === false) {
    //         $error_message = curl_error($curl);
    //         echo "Error: $error_message";
    //     } else {
    //         // Decode JSON data
    //         $data = json_decode($api_data, true);

    //         // Pass data to view


    //     $this->load->view('intranet_templat/header');
    //     $this->load->view('internet_asste/css');
    //     $this->load->view('intranet_templat/navbar');
    //     $this->load->view('intranet/it', array('data' => $data));
    //     $this->load->view('internet_asste/js');
    //     $this->load->view('internet_asste/php');
    //     $this->load->view('intranet_templat/footer');
    //     return $data;
    // }

    //     // Close cURL session
    //     curl_close($curl);
    // }

    public function index()
    {
        // Call the existing functions to fetch existing data
        $data['total_complain_year'] = $this->complain_model->count_complain_year();
        $data['total_complain_success'] = $this->complain_model->count_complain_success();
        $data['total_complain_operation'] = $this->complain_model->count_complain_operation();
        $data['total_complain_accept'] = $this->complain_model->count_complain_accept();
        $data['total_complain_doing'] = $this->complain_model->count_complain_doing();
        $data['total_complain_wait'] = $this->complain_model->count_complain_wait();
        $data['total_complain_cancel'] = $this->complain_model->count_complain_cancel();
        $data['rs_complain'] = $this->complain_model->intranet_complain();

        // Call the function to fetch data from the API
        $api_data1 = $this->fetch_api_data('https://www.assystem.co.th/service_api/index.php');
        $api_data2 = $this->fetch_api_data('https://www.assystem.co.th/sale_api/index.php');

        // Check if API data is fetched successfully
        if ($api_data1 !== FALSE) {
            // Merge API data with existing data
            $data['api_data1'] = $api_data1;
        } else {
            // Handle if API data is not fetched successfully
            $data['api_data1'] = []; // or any default value as needed
        }

        if ($api_data2 !== FALSE) {
            // Merge API data with existing data
            $data['api_data2'] = $api_data2;
        } else {
            // Handle if API data is not fetched successfully
            $data['api_data2'] = []; // or any default value as needed
        }

        // Load views with merged data
        $this->load->view('intranet_templat/header');
        $this->load->view('internet_asste/css');
        $this->load->view('intranet_templat/navbar');
        $this->load->view('intranet/it', $data);
        $this->load->view('internet_asste/js');
        $this->load->view('internet_asste/php');
        $this->load->view('intranet_templat/footer');
        
    }

    // Custom function to fetch API data using cURL
    private function fetch_api_data($api_url)
    {
        // Initialize cURL
        $curl = curl_init();

        // Set cURL options
        curl_setopt($curl, CURLOPT_URL, $api_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification (for testing purposes only)

        // Execute cURL request
        $api_data = curl_exec($curl);

        // Check for errors
        if ($api_data === false) {
            $error_message = curl_error($curl);
            echo "Error: $error_message";
        } else {
            // Decode JSON data
            $data = json_decode($api_data, true);
            return $data;
        }

        // Close cURL session
        curl_close($curl);
    }

    




}
