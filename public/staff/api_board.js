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

function getLwrpByTsid() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lwrp_by_tsid.php";
    const userInput = document.getElementById("get_lwrp_by_tsid").value;
    openURL(baseUrl, { cwms_ts_id: userInput });
}

function getNoteByLocationId() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_note_by_location_id.php";
    const userInput = document.getElementById("get_note_by_location_id").value;
    openURL(baseUrl, { location_id: userInput });
}

function getNwsForecastByDay() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_nws_forecast_by_day.php";
    const cwms_ts_id = document.getElementById("get_nws_forecast_by_day_cwms_ts_id").value;
    const nws_day1_date = document.getElementById("get_nws_forecast_by_day").value;
    openURL(baseUrl, { cwms_ts_id, nws_day1_date });
}

function getOutflow2ByLocationId() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_outflow2_by_location_id.php";
    const userInput = document.getElementById("get_outflow2_by_location_id").value;
    openURL(baseUrl, { location_id: userInput });
}

function getPhase1ByTsid() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_phase1_by_tsid.php";
    const userInput = document.getElementById("get_phase1_by_tsid").value;
    openURL(baseUrl, { cwms_ts_id: userInput });
}

function getPhase2ByTsid() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_phase2_by_tsid.php";
    const userInput = document.getElementById("get_phase2_by_tsid").value;
    openURL(baseUrl, { cwms_ts_id: userInput });
}

function getPrecipByLocationId() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_precip_by_location_id.php";
    const userInput = document.getElementById("get_precip_by_location_id").value;
    openURL(baseUrl, { location_id: userInput });
}

function getRecordStageByTsid() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_record_stage_by_tsid.php";
    const userInput = document.getElementById("get_record_stage_by_tsid").value;
    openURL(baseUrl, { cwms_ts_id: userInput });
}

function getRollerTainterByTsid() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_roller_tainter_by_tsid.php";
    const userInput = document.getElementById("get_roller_tainter_by_tsid").value;
    openURL(baseUrl, { cwms_ts_id: userInput });
}

function getRuleCurve2ByLocationId() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_rule_curve2_by_location_id.php";
    const userInput = document.getElementById("get_rule_curve2_by_location_id").value;
    openURL(baseUrl, { location_id: userInput });
}

function getSchd() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_schd.php";
    const userInput = document.getElementById("get_schd").value;
    openURL(baseUrl, { location_id: userInput });
}

function getStageDataByTsid() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_stage_data_by_tsid.php";
    const userInput = document.getElementById("get_stage_data_by_tsid").value;
    openURL(baseUrl, { cwms_ts_id: userInput });
}

function getTurbineByLocationId() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_turbine_by_location_id.php";
    const userInput = document.getElementById("get_turbine_by_location_id").value;
    openURL(baseUrl, { location_id: userInput });
}