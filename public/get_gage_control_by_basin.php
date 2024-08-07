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
        //echo 'date_default_timezone_set: ' . date_default_timezone_get() . '<br />';
    }
    if (ini_get('date.timezone')) {
        //echo 'date.timezone: ' . ini_get('date.timezone');
    }

    // Set the content type to application/json
    header('Content-Type: application/json');

    // Get all the variables from the query parameters
    $basin = $_GET['basin'];

    $gage_control = find_gage_control_basin($db, $basin);
    echo json_encode($gage_control);
    
    db_disconnect($db);
?>
	

                            