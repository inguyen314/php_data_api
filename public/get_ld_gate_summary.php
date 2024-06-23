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

// Get all the variables from the query parameters
$project_id = $_GET['project_id'];
$pool = $_GET['pool'];
$tw = $_GET['tw'];
$hinge = $_GET['hinge'];
$taint = $_GET['taint'];
$roll = $_GET['roll'];

$location_ids = find_ld_gate($db, $pool, $tw, $hinge, $taint, $roll);
echo json_encode($location_ids);
?>                    