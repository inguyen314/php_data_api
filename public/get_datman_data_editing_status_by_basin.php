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
    $type = $_GET['type'];

    $data = find_datman_data_editing_status_by_basin($db, $basin, $type);
    echo json_encode($data);

    db_disconnect($db);
?>