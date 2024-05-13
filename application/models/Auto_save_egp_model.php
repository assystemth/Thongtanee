<?php
class Auto_save_egp_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // เรียกใช้งานฐานข้อมูล
    }

    public function save_data_egp_y2567($json_url)
    {
        // Define convertThaiDateToDatetime2567 function
        function convertThaiDateToDatetime2567($textDate)
        {
            // Map Thai month abbreviations to English month names
            $thaiMonths = array(
                'ม.ค' => 'Jan',
                'ก.พ' => 'Feb',
                'มี.ค' => 'Mar',
                'เม.ย' => 'Apr',
                'พ.ค' => 'May',
                'มิ.ย' => 'Jun',
                'ก.ค' => 'Jul',
                'ส.ค' => 'Aug',
                'ก.ย' => 'Sep',
                'ต.ค' => 'Oct',
                'พ.ย' => 'Nov',
                'ธ.ค' => 'Dec'
            );

            // Replace Thai month abbreviations with English month names
            foreach ($thaiMonths as $thaiMonth => $englishMonth) {
                $textDate = str_replace($thaiMonth, $englishMonth, $textDate);
            }

            // Extract the year from the input text date
            if (preg_match('/(\d{1,2}) (\w{3}\.?) (\d{2})/', $textDate, $matches)) {
                $day = isset($matches[1]) ? $matches[1] : '';
                $month = isset($matches[2]) ? rtrim($matches[2], ".") : ''; // Remove trailing period if present
                $year = isset($matches[3]) ? $matches[3] : '';

                // Convert the year to the Gregorian calendar year
                $gregorianYear = ($year + 2500) - 543;

                // Combine the day, month, and Gregorian year into the new text date
                $textDate = "$day $month $gregorianYear";

                // Define the format of the input text date
                $inputFormat = 'd M Y';

                // Create a DateTime object from the input text date using the specified format
                $dateTime = DateTime::createFromFormat($inputFormat, $textDate);

                // Check if the conversion was successful
                if ($dateTime !== false) {
                    // Convert DateTime object to another format if needed
                    $outputFormat = 'Y-m-d'; // Output format with date
                    return $dateTime->format($outputFormat);
                } else {
                    // Return an error message if the conversion failed
                    return null;
                }
            } else {
                // Return an error message if the regular expression does not match
                return null;
            }
        }

        // Get the JSON data from the URL
        $json_data = file_get_contents($json_url);

        // Decode the JSON data into an associative array
        $data = json_decode($json_data, true);

        // Check if the 'result' key exists in the data
        if (isset($data['result']) && is_array($data['result']) && !empty($data['result'])) {
            $results = $data['result'];

            // Delete existing data from the table
            $this->db->empty_table('tbl_bp_report_y2567');

            // Insert data into the database
            foreach ($results as $row) {
                // Flatten the array
                $flattenedRow = $this->flattenArray($row);

                // Remove the index '0' from 'contract' headers
                $flattenedRow = array_combine(
                    array_map(function ($key) {
                        return str_replace('_0_', '_', $key);
                    }, array_keys($flattenedRow)),
                    $flattenedRow
                );

                // Convert contract_contract_date to datetime format
                if (!empty($flattenedRow['contract_contract_date'])) {
                    $flattenedRow['contract_contract_date'] = convertThaiDateToDatetime2567($flattenedRow['contract_contract_date']);
                }

                // Convert contract_contract_finish_date to datetime format
                if (!empty($flattenedRow['contract_contract_finish_date'])) {
                    $flattenedRow['contract_contract_finish_date'] = convertThaiDateToDatetime2567($flattenedRow['contract_contract_finish_date']);
                }

                // Insert data into the database
                $this->db->insert('tbl_bp_report_y2567', $flattenedRow);
            }

            return count($results); // Return the number of rows inserted
        } else {
            return 0; // Return 0 if no data found or unable to fetch data
        }
    }



    public function save_data_egp_y2566($json_url)
    {
        // Define convertThaiDateToDatetime2566 function
        function convertThaiDateToDatetime2566($textDate)
        {
            // Map Thai month abbreviations to English month names
            $thaiMonths = array(
                'ม.ค' => 'Jan',
                'ก.พ' => 'Feb',
                'มี.ค' => 'Mar',
                'เม.ย' => 'Apr',
                'พ.ค' => 'May',
                'มิ.ย' => 'Jun',
                'ก.ค' => 'Jul',
                'ส.ค' => 'Aug',
                'ก.ย' => 'Sep',
                'ต.ค' => 'Oct',
                'พ.ย' => 'Nov',
                'ธ.ค' => 'Dec'
            );

            // Replace Thai month abbreviations with English month names
            foreach ($thaiMonths as $thaiMonth => $englishMonth) {
                $textDate = str_replace($thaiMonth, $englishMonth, $textDate);
            }

            // Extract the year from the input text date
            if (preg_match('/(\d{1,2}) (\w{3}\.?) (\d{2})/', $textDate, $matches)) {
                $day = isset($matches[1]) ? $matches[1] : '';
                $month = isset($matches[2]) ? rtrim($matches[2], ".") : ''; // Remove trailing period if present
                $year = isset($matches[3]) ? $matches[3] : '';

                // Convert the year to the Gregorian calendar year
                $gregorianYear = ($year + 2500) - 543;

                // Combine the day, month, and Gregorian year into the new text date
                $textDate = "$day $month $gregorianYear";

                // Define the format of the input text date
                $inputFormat = 'd M Y';

                // Create a DateTime object from the input text date using the specified format
                $dateTime = DateTime::createFromFormat($inputFormat, $textDate);

                // Check if the conversion was successful
                if ($dateTime !== false) {
                    // Convert DateTime object to another format if needed
                    $outputFormat = 'Y-m-d'; // Output format with date
                    return $dateTime->format($outputFormat);
                } else {
                    // Return an error message if the conversion failed
                    return null;
                }
            } else {
                // Return an error message if the regular expression does not match
                return null;
            }
        }

        // Get the JSON data from the URL
        $json_data = file_get_contents($json_url);

        // Decode the JSON data into an associative array
        $data = json_decode($json_data, true);

        // Check if the 'result' key exists in the data
        if (isset($data['result']) && is_array($data['result']) && !empty($data['result'])) {
            $results = $data['result'];

            // Delete existing data from the table
            $this->db->empty_table('tbl_bp_report_y2566');

            // Insert data into the database
            foreach ($results as $row) {
                // Flatten the array
                $flattenedRow = $this->flattenArray($row);

                // Remove the index '0' from 'contract' headers
                $flattenedRow = array_combine(
                    array_map(function ($key) {
                        return str_replace('_0_', '_', $key);
                    }, array_keys($flattenedRow)),
                    $flattenedRow
                );

                // Convert contract_contract_date to datetime format
                if (!empty($flattenedRow['contract_contract_date'])) {
                    $flattenedRow['contract_contract_date'] = convertThaiDateToDatetime2566($flattenedRow['contract_contract_date']);
                }

                // Convert contract_contract_finish_date to datetime format
                if (!empty($flattenedRow['contract_contract_finish_date'])) {
                    $flattenedRow['contract_contract_finish_date'] = convertThaiDateToDatetime2566($flattenedRow['contract_contract_finish_date']);
                }

                // Insert data into the database
                $this->db->insert('tbl_bp_report_y2566', $flattenedRow);
            }

            return count($results); // Return the number of rows inserted
        } else {
            return 0; // Return 0 if no data found or unable to fetch data
        }
    }
    public function save_data_egp_y2565($json_url)
    {
        // Define convertThaiDateToDatetime2565 function
        function convertThaiDateToDatetime2565($textDate)
        {
            // Map Thai month abbreviations to English month names
            $thaiMonths = array(
                'ม.ค' => 'Jan',
                'ก.พ' => 'Feb',
                'มี.ค' => 'Mar',
                'เม.ย' => 'Apr',
                'พ.ค' => 'May',
                'มิ.ย' => 'Jun',
                'ก.ค' => 'Jul',
                'ส.ค' => 'Aug',
                'ก.ย' => 'Sep',
                'ต.ค' => 'Oct',
                'พ.ย' => 'Nov',
                'ธ.ค' => 'Dec'
            );

            // Replace Thai month abbreviations with English month names
            foreach ($thaiMonths as $thaiMonth => $englishMonth) {
                $textDate = str_replace($thaiMonth, $englishMonth, $textDate);
            }

            // Extract the year from the input text date
            if (preg_match('/(\d{1,2}) (\w{3}\.?) (\d{2})/', $textDate, $matches)) {
                $day = isset($matches[1]) ? $matches[1] : '';
                $month = isset($matches[2]) ? rtrim($matches[2], ".") : ''; // Remove trailing period if present
                $year = isset($matches[3]) ? $matches[3] : '';

                // Convert the year to the Gregorian calendar year
                $gregorianYear = ($year + 2500) - 543;

                // Combine the day, month, and Gregorian year into the new text date
                $textDate = "$day $month $gregorianYear";

                // Define the format of the input text date
                $inputFormat = 'd M Y';

                // Create a DateTime object from the input text date using the specified format
                $dateTime = DateTime::createFromFormat($inputFormat, $textDate);

                // Check if the conversion was successful
                if ($dateTime !== false) {
                    // Convert DateTime object to another format if needed
                    $outputFormat = 'Y-m-d'; // Output format with date
                    return $dateTime->format($outputFormat);
                } else {
                    // Return an error message if the conversion failed
                    return null;
                }
            } else {
                // Return an error message if the regular expression does not match
                return null;
            }
        }

        // Get the JSON data from the URL
        $json_data = file_get_contents($json_url);

        // Decode the JSON data into an associative array
        $data = json_decode($json_data, true);

        // Check if the 'result' key exists in the data
        if (isset($data['result']) && is_array($data['result']) && !empty($data['result'])) {
            $results = $data['result'];

            // Delete existing data from the table
            $this->db->empty_table('tbl_bp_report_y2565');

            // Insert data into the database
            foreach ($results as $row) {
                // Flatten the array
                $flattenedRow = $this->flattenArray($row);

                // Remove the index '0' from 'contract' headers
                $flattenedRow = array_combine(
                    array_map(function ($key) {
                        return str_replace('_0_', '_', $key);
                    }, array_keys($flattenedRow)),
                    $flattenedRow
                );

                // Convert contract_contract_date to datetime format
                if (!empty($flattenedRow['contract_contract_date'])) {
                    $flattenedRow['contract_contract_date'] = convertThaiDateToDatetime2565($flattenedRow['contract_contract_date']);
                }

                // Convert contract_contract_finish_date to datetime format
                if (!empty($flattenedRow['contract_contract_finish_date'])) {
                    $flattenedRow['contract_contract_finish_date'] = convertThaiDateToDatetime2565($flattenedRow['contract_contract_finish_date']);
                }

                // Insert data into the database
                $this->db->insert('tbl_bp_report_y2565', $flattenedRow);
            }

            return count($results); // Return the number of rows inserted
        } else {
            return 0; // Return 0 if no data found or unable to fetch data
        }
    }



    public function save_data_egp_y2564($json_url)
    {
        // Define convertThaiDateToDatetime2564 function
        function convertThaiDateToDatetime2564($textDate)
        {
            // Map Thai month abbreviations to English month names
            $thaiMonths = array(
                'ม.ค' => 'Jan',
                'ก.พ' => 'Feb',
                'มี.ค' => 'Mar',
                'เม.ย' => 'Apr',
                'พ.ค' => 'May',
                'มิ.ย' => 'Jun',
                'ก.ค' => 'Jul',
                'ส.ค' => 'Aug',
                'ก.ย' => 'Sep',
                'ต.ค' => 'Oct',
                'พ.ย' => 'Nov',
                'ธ.ค' => 'Dec'
            );

            // Replace Thai month abbreviations with English month names
            foreach ($thaiMonths as $thaiMonth => $englishMonth) {
                $textDate = str_replace($thaiMonth, $englishMonth, $textDate);
            }

            // Extract the year from the input text date
            if (preg_match('/(\d{1,2}) (\w{3}\.?) (\d{2})/', $textDate, $matches)) {
                $day = isset($matches[1]) ? $matches[1] : '';
                $month = isset($matches[2]) ? rtrim($matches[2], ".") : ''; // Remove trailing period if present
                $year = isset($matches[3]) ? $matches[3] : '';

                // Convert the year to the Gregorian calendar year
                $gregorianYear = ($year + 2500) - 543;

                // Combine the day, month, and Gregorian year into the new text date
                $textDate = "$day $month $gregorianYear";

                // Define the format of the input text date
                $inputFormat = 'd M Y';

                // Create a DateTime object from the input text date using the specified format
                $dateTime = DateTime::createFromFormat($inputFormat, $textDate);

                // Check if the conversion was successful
                if ($dateTime !== false) {
                    // Convert DateTime object to another format if needed
                    $outputFormat = 'Y-m-d'; // Output format with date
                    return $dateTime->format($outputFormat);
                } else {
                    // Return an error message if the conversion failed
                    return null;
                }
            } else {
                // Return an error message if the regular expression does not match
                return null;
            }
        }

        // Get the JSON data from the URL
        $json_data = file_get_contents($json_url);

        // Decode the JSON data into an associative array
        $data = json_decode($json_data, true);

        // Check if the 'result' key exists in the data
        if (isset($data['result']) && is_array($data['result']) && !empty($data['result'])) {
            $results = $data['result'];

            // Delete existing data from the table
            $this->db->empty_table('tbl_bp_report_y2564');

            // Insert data into the database
            foreach ($results as $row) {
                // Flatten the array
                $flattenedRow = $this->flattenArray($row);

                // Remove the index '0' from 'contract' headers
                $flattenedRow = array_combine(
                    array_map(function ($key) {
                        return str_replace('_0_', '_', $key);
                    }, array_keys($flattenedRow)),
                    $flattenedRow
                );

                // Convert contract_contract_date to datetime format
                if (!empty($flattenedRow['contract_contract_date'])) {
                    $flattenedRow['contract_contract_date'] = convertThaiDateToDatetime2564($flattenedRow['contract_contract_date']);
                }

                // Convert contract_contract_finish_date to datetime format
                if (!empty($flattenedRow['contract_contract_finish_date'])) {
                    $flattenedRow['contract_contract_finish_date'] = convertThaiDateToDatetime2564($flattenedRow['contract_contract_finish_date']);
                }

                // Insert data into the database
                $this->db->insert('tbl_bp_report_y2564', $flattenedRow);
            }

            return count($results); // Return the number of rows inserted
        } else {
            return 0; // Return 0 if no data found or unable to fetch data
        }
    }
    public function save_data_egp_y2563($json_url)
    {
        // Define convertThaiDateToDatetime2563 function
        function convertThaiDateToDatetime2563($textDate)
        {
            // Map Thai month abbreviations to English month names
            $thaiMonths = array(
                'ม.ค' => 'Jan',
                'ก.พ' => 'Feb',
                'มี.ค' => 'Mar',
                'เม.ย' => 'Apr',
                'พ.ค' => 'May',
                'มิ.ย' => 'Jun',
                'ก.ค' => 'Jul',
                'ส.ค' => 'Aug',
                'ก.ย' => 'Sep',
                'ต.ค' => 'Oct',
                'พ.ย' => 'Nov',
                'ธ.ค' => 'Dec'
            );

            // Replace Thai month abbreviations with English month names
            foreach ($thaiMonths as $thaiMonth => $englishMonth) {
                $textDate = str_replace($thaiMonth, $englishMonth, $textDate);
            }

            // Extract the year from the input text date
            if (preg_match('/(\d{1,2}) (\w{3}\.?) (\d{2})/', $textDate, $matches)) {
                $day = isset($matches[1]) ? $matches[1] : '';
                $month = isset($matches[2]) ? rtrim($matches[2], ".") : ''; // Remove trailing period if present
                $year = isset($matches[3]) ? $matches[3] : '';

                // Convert the year to the Gregorian calendar year
                $gregorianYear = ($year + 2500) - 543;

                // Combine the day, month, and Gregorian year into the new text date
                $textDate = "$day $month $gregorianYear";

                // Define the format of the input text date
                $inputFormat = 'd M Y';

                // Create a DateTime object from the input text date using the specified format
                $dateTime = DateTime::createFromFormat($inputFormat, $textDate);

                // Check if the conversion was successful
                if ($dateTime !== false) {
                    // Convert DateTime object to another format if needed
                    $outputFormat = 'Y-m-d'; // Output format with date
                    return $dateTime->format($outputFormat);
                } else {
                    // Return an error message if the conversion failed
                    return null;
                }
            } else {
                // Return an error message if the regular expression does not match
                return null;
            }
        }

        // Get the JSON data from the URL
        $json_data = file_get_contents($json_url);

        // Decode the JSON data into an associative array
        $data = json_decode($json_data, true);

        // Check if the 'result' key exists in the data
        if (isset($data['result']) && is_array($data['result']) && !empty($data['result'])) {
            $results = $data['result'];

            // Delete existing data from the table
            $this->db->empty_table('tbl_bp_report_y2563');

            // Insert data into the database
            foreach ($results as $row) {
                // Flatten the array
                $flattenedRow = $this->flattenArray($row);

                // Remove the index '0' from 'contract' headers
                $flattenedRow = array_combine(
                    array_map(function ($key) {
                        return str_replace('_0_', '_', $key);
                    }, array_keys($flattenedRow)),
                    $flattenedRow
                );

                // Convert contract_contract_date to datetime format
                if (!empty($flattenedRow['contract_contract_date'])) {
                    $flattenedRow['contract_contract_date'] = convertThaiDateToDatetime2563($flattenedRow['contract_contract_date']);
                }

                // Convert contract_contract_finish_date to datetime format
                if (!empty($flattenedRow['contract_contract_finish_date'])) {
                    $flattenedRow['contract_contract_finish_date'] = convertThaiDateToDatetime2563($flattenedRow['contract_contract_finish_date']);
                }

                // Insert data into the database
                $this->db->insert('tbl_bp_report_y2563', $flattenedRow);
            }

            return count($results); // Return the number of rows inserted
        } else {
            return 0; // Return 0 if no data found or unable to fetch data
        }
    }

    // Function to flatten nested arrays and combine keys
    private function flattenArray($array, $prefix = '')
    {
        $result = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                // Recursively flatten nested arrays
                $result += $this->flattenArray($value, $prefix . $key . '_');
            } else {
                // Combine keys with underscores
                $result[$prefix . $key] = $value;
            }
        }
        return $result;
    }
}
