function bankfullByLocationId() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_bankfull_by_location_id.php";
    const userInput = document.getElementById("bankfull_by_location_id").value;
    openURL(baseUrl, { location_id: userInput });
}

function lakeCrestForecastByLocationId() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake_crest_forecast_by_location_id.php";
    const userInput = document.getElementById("lake_crest_forecast_by_location_id").value;
    openURL(baseUrl, { location_id: userInput });
}

function crestDataByTsid() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_crest_data_by_tsid.php";
    const userInput = document.getElementById("crest_data_by_tsid").value;
    openURL(baseUrl, { cwms_ts_id: userInput });
}

function getGeneration() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_generation.php";
    const userInput = document.getElementById("generation").value;
    openURL(baseUrl, { location_id: userInput });
}

function getGeneration2() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_generation2.php";
    const userInput = document.getElementById("generation2").value;
    openURL(baseUrl, { location_id: userInput });
}

function inflowByLocationId() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_inflow_by_location_id.php";
    const userInput = document.getElementById("inflow_by_location_id").value;
    openURL(baseUrl, { location_id: userInput });
}

function lakeStorageByLocationId() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake_storage_by_location_id.php";
    const userInput = document.getElementById("lake_storage_by_location_id").value;
    openURL(baseUrl, { cwms_ts_id: userInput });
}

function lowerUpperFlowLimitByTsid() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lower_upper_flow_limit_by_tsid.php";
    const userInput = document.getElementById("lower_upper_flow_limit_by_tsid").value;
    openURL(baseUrl, { cwms_ts_id: userInput });
}