<?php 
    require_once('../private/initialize.php'); 
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
    $basin = $_GET['basin'];
    $specified_level_id_level = $_GET['specified_level_id_level'];

    $data = find_location_level_by_basin($db, $basin, $specified_level_id_level);
    echo json_encode($data);

    db_disconnect($db);
?>