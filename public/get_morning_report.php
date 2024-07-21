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

    // GET REQUEST 
    $tsId = $_GET['tsId'] ?? null;
    $hour_cst = $_GET['hour_cst'] ?? null;
    $interval = $_GET['interval'] ?? null;
    $interval2 = $_GET['interval2'] ?? null;

    $set_options = set_options($db);

    $data = find_stage_and_stage_24($db, $tsId, $hour_cst, $interval, $interval2);
    echo json_encode($data);
?>