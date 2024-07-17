<?php 
    require_once('../../private/initialize.php'); 
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

    $data = get_shelbyville_forecast($db);
    echo json_encode($data);
?>