function gageControl() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_gage_control.php";
    const userInput = document.getElementById("gage_control").value;
    openURL(baseUrl, { userInput });
}

function dbInfo() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_db_info.php";
    const userInput = document.getElementById("db_info").value;
    openURL(baseUrl, { userInput });
}

function loadingApplication() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_loading_application.php";
    const userInput = document.getElementById("loading_application").value;
    openURL(baseUrl, { userInput });
}

function compRetry() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_comp_retry.php";
    const userInput = document.getElementById("comp_retry").value;
    openURL(baseUrl, { userInput });
}

function locationIdUsernameAtLogMessage() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_location_id_username_at_log_message.php";
    const userInput = document.getElementById("location_id_username_at_log_message").value;
    openURL(baseUrl, { userInput });
}

function atLogMessage() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_at_log_message.php";
    const userInput = document.getElementById("at_log_message").value;
    openURL(baseUrl, { session_username: userInput });
}

function cpCompTasklist() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_cp_comp_tasklist.php";
    const userInput = document.getElementById("cp_comp_tasklist").value;
    openURL(baseUrl, { userInput });
}

function activeSessions() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_active_sessions.php";
    const userInput = document.getElementById("active_sessions").value;
    openURL(baseUrl, { userInput });
}

function vSessionB3weba18() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_v_session_b3weba18.php";
    const userInput = document.getElementById("v_session_b3weba18").value;
    openURL(baseUrl, { userInput });
}

function vSessionB3cwpa18() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_v_session_b3cwpa18.php";
    const userInput = document.getElementById("v_session_b3cwpa18").value;
    openURL(baseUrl, { userInput });
}

function dbChangeLog() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_db_change_log.php";
    const userInput = document.getElementById("change_log").value;
    openURL(baseUrl, { userInput });
}