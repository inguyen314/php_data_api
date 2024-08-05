<?php require_once('../private/initialize.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ini_set("xdebug.var_display_max_children", '-1');
ini_set("xdebug.var_display_max_data", '-1');
ini_set("xdebug.var_display_max_depth", '-1');

date_default_timezone_set('America/Chicago');
if (date_default_timezone_get()) {
}
if (ini_get('date.timezone')) {
}

// Set the content type to application/json
header('Content-Type: application/json');

$set_options = set_options($db);

// Get all the variables from the query parameters
$cwms_ts_id = $_GET['cwms_ts_id'];
$nws_day1_date = $_GET['nws_day1_date'];

$data = get_nws_forecast_by_day($db, $cwms_ts_id, $nws_day1_date);
echo json_encode($data);
