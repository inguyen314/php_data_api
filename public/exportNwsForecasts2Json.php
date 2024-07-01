<?php
require_once "/wm/mvs/wm_web/var/apache2/2.4/htdocs/globals_mvs.php";
require_once "/wm/mvs/wm_web/var/apache2/2.4/htdocs/php_data_api/private/query_functions_river_reservoir.php";

function db_connect($db_host, $db_port, $db_service_name, $db_user, $db_pass) {
    $dbstr = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=" . $db_host . ")(PORT=" . $db_port . "))(CONNECT_DATA=(SERVICE_NAME=" . $db_service_name . ")))";
    // Attempt to connect
    $conn = oci_pconnect($db_user, $db_pass, $dbstr);

    // Check for connection success
    if (!$conn) {
        $error = oci_error();  // Fetch the OCI error
        die("Connection failed: " . $error['message']);
    }

    return $conn;
}


function db_disconnect($conn) {
    if ($conn) {
        oci_close($conn);
    }
}

// Usage
$db = db_connect($db_host, $db_port, $db_service_name, $db_user, $db_pass);

if ($db) {
    // Path to the JSON file
    $jsonFile = '/wm/mvs/wm_web/var/apache2/2.4/htdocs/php_data_api/public/json/gage_control.json';

    // Read the JSON file
    $jsonContent = file_get_contents($jsonFile);

    // Check if the file was read successfully
    if ($jsonContent === false) {
        die("Error reading the JSON file.");
    }

    // Decode JSON string to PHP array
    $data = json_decode($jsonContent, true);

    // Check if decoding was successful
    if ($data === null) {
        die("Error decoding JSON: " . json_last_error_msg());
    }

    // Function to recursively extract 'tsid_stage_nws_3_day_forecast' values
    function extractTsidStageForecast($array) {
        $tsidStageForecastValues = [];
        
        foreach ($array as $key => $value) {
            if ($key === null) {
                continue; // Skip the iteration if the key is null
            }
    
            if (is_array($value)) {
                $tsidStageForecastValues = array_merge($tsidStageForecastValues, extractTsidStageForecast($value));
            } elseif ($key === 'tsid_stage_nws_3_day_forecast') {
                $tsidStageForecastValues[] = $value;
            }
        }
        
        return $tsidStageForecastValues;
    }

    // Extract 'tsid_stage_nws_3_day_forecast' values from $data
    $tsidStageForecastValues = extractTsidStageForecast($data);

    // Filter out any NULL values from $tsidStageForecastValues
    $tsidStageForecastValues = array_filter($tsidStageForecastValues, function($tsid) {
        return $tsid !== null;
    });

    // Define the path and filename to save JSON data
    $directory = '/wm/mvs/wm_web/var/apache2/2.4/htdocs/php_data_api/public/json/';
    $filename = 'exportNwsForecasts2Json.json';
    $filePath = $directory . $filename;

    // Initialize an array to hold all JSON data
    $allCrestJson = [];

    // Process each extracted tsid with get_crest_data
    foreach ($tsidStageForecastValues as $tsid) {
        $crest = get_crest_data($db, $tsid);

        // Check if the desired object exists in $crest
        if (isset($crest->value)) {
            // Add the data directly to the array without overwriting
            $allCrestJson[$tsid]['location_id'] = $crest->location_id;
            $allCrestJson[$tsid]['cwms_ts_id'] = $crest->cwms_ts_id;
            $allCrestJson[$tsid]['date_time'] = $crest->date_time;
            $allCrestJson[$tsid]['value'] = round(floatval($crest->value), 2);
            $allCrestJson[$tsid]['unit_id'] = $crest->unit_id;
            $allCrestJson[$tsid]['quality_code'] = $crest->quality_code;
            $allCrestJson[$tsid]['data_entry_date'] = $crest->data_entry_date;
        } else {
            // Handle the case where the 'value' is not found
            // You may want to set a default value or log an error
            // For now, let's set it to null
            $allCrestJson[$tsid] = null;
        }
    }

    // Encode all JSON data as one JSON array
    $jsonArray = json_encode(array_values($allCrestJson), JSON_PRETTY_PRINT);

    // Save the JSON array to the file
    if (file_put_contents($filePath, $jsonArray) !== false) {
        echo "All JSON data has been saved to $filePath\n";
    } else {
        echo "Error saving JSON data to $filePath\n";
    }
}
// Disconnect when done
db_disconnect($db);
?>
