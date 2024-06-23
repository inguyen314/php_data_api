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
$tsid_netmiss = $_GET['tsid_netmiss'];
$tsid_netmiss_observe = $_GET['tsid_netmiss_observe'];
$nws_day0_date = $_GET['nws_day0_date'];

$netmiss_forecast = find_netmiss_forecast($db, $tsid_netmiss, $tsid_netmiss_observe, $nws_day0_date);
echo json_encode($netmiss_forecast);
?>