<?php
class Auto_save_egp extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('auto_save_egp_model'); // เรียกใช้โมเดล auto_save_egp_model
    }

    public function save_data_egp_to_database_y2567()
    {
        $json_url = "https://govspending.data.go.th/api/service/cgdcontract?api-key=TH3JFBwJZlaXdDCpcVfSFGuoofCJ1heX&dept_code=5450503&year=2567&limit=500";

        // ดึงข้อมูลจาก API และบันทึกลงในฐานข้อมูล
        $inserted_rows = $this->auto_save_egp_model->save_data_egp_y2567($json_url);
        echo '<pre>';
        print_r($json_url);
        echo '</pre>';
        exit();

        // ตรวจสอบว่ามีข้อมูลถูกบันทึกลงในฐานข้อมูลหรือไม่
        if ($inserted_rows > 0) {
            echo "Data inserted successfully.";
        } else {
            echo "No new data inserted.";
        }
    }

    public function save_data_egp_to_database_y2566()
    {
        $json_url = "https://govspending.data.go.th/api/service/cgdcontract?api-key=TH3JFBwJZlaXdDCpcVfSFGuoofCJ1heX&dept_code=5450503&year=2566&limit=500";

        // ดึงข้อมูลจาก API และบันทึกลงในฐานข้อมูล
        $inserted_rows = $this->auto_save_egp_model->save_data_egp_y2566($json_url);

        // ตรวจสอบว่ามีข้อมูลถูกบันทึกลงในฐานข้อมูลหรือไม่
        if ($inserted_rows > 0) {
            echo "Data inserted successfully.";
        } else {
            echo "No new data inserted.";
        }
    }

    public function save_data_egp_to_database_y2565()
    {
        $json_url = "https://govspending.data.go.th/api/service/cgdcontract?api-key=TH3JFBwJZlaXdDCpcVfSFGuoofCJ1heX&dept_code=5450503&year=2565&limit=500";

        // ดึงข้อมูลจาก API และบันทึกลงในฐานข้อมูล
        $inserted_rows = $this->auto_save_egp_model->save_data_egp_y2565($json_url);

        // ตรวจสอบว่ามีข้อมูลถูกบันทึกลงในฐานข้อมูลหรือไม่
        if ($inserted_rows > 0) {
            echo "Data inserted successfully.";
        } else {
            echo "No new data inserted.";
        }
    }

    public function save_data_egp_to_database_y2564()
    {
        $json_url = "https://govspending.data.go.th/api/service/cgdcontract?api-key=TH3JFBwJZlaXdDCpcVfSFGuoofCJ1heX&dept_code=5450503&year=2564&limit=500";

        // ดึงข้อมูลจาก API และบันทึกลงในฐานข้อมูล
        $inserted_rows = $this->auto_save_egp_model->save_data_egp_y2564($json_url);

        // ตรวจสอบว่ามีข้อมูลถูกบันทึกลงในฐานข้อมูลหรือไม่
        if ($inserted_rows > 0) {
            echo "Data inserted successfully.";
        } else {
            echo "No new data inserted.";
        }
    }

    public function save_data_egp_to_database_y2563()
    {
        $json_url = "https://govspending.data.go.th/api/service/cgdcontract?api-key=TH3JFBwJZlaXdDCpcVfSFGuoofCJ1heX&dept_code=5450503&year=2563&limit=500";

        // ดึงข้อมูลจาก API และบันทึกลงในฐานข้อมูล
        $inserted_rows = $this->auto_save_egp_model->save_data_egp_y2563($json_url);

        // ตรวจสอบว่ามีข้อมูลถูกบันทึกลงในฐานข้อมูลหรือไม่
        if ($inserted_rows > 0) {
            echo "Data inserted successfully.";
        } else {
            echo "No new data inserted.";
        }
    }
}
