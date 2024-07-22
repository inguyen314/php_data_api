function ratingCoeTable() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_rating_coe_table.php";
    const userInput = document.getElementById("rating_coe_table").value;
    openURL(baseUrl, { location_id: userInput });
}

function ratingUsgsTable() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_rating_usgs_table.php";
    const userInput = document.getElementById("rating_usgs_table").value;
    openURL(baseUrl, { location_id: userInput });
}

function ratingNwsTable() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_rating_nws_table.php";
    const userInput = document.getElementById("rating_nws_table").value;
    openURL(baseUrl, { location_id: userInput });
}

function locationIdDatmanExtents() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_location_id_datman_extents.php";
    const userInput = document.getElementById("location_id_datman_extents").value;
    openURL(baseUrl, { location_id: userInput });
}

function tsidExtents() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_tsid_extents.php";
    const userInput = document.getElementById("get_tsid_extents").value;
    openURL(baseUrl, { cwms_ts_id: userInput });
}

function locationIdLakeInflowExtents() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_location_id_lake_inflow_extents.php";
    const userInput = document.getElementById("location_id_lake_inflow_extents").value;
    openURL(baseUrl, { location_id: userInput });
}

function locationIdLakeOutflowExtents() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_location_id_lake_outflow_extents.php";
    const userInput = document.getElementById("location_id_lake_outflow_extents").value;
    openURL(baseUrl, { location_id: userInput });
}

function datmanRevBasin() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_datman_rev_basin.php";
    const userInput = document.getElementById("datman_rev_basin").value;
    openURL(baseUrl, { basin: userInput });
}

function specifiedLevelId() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_specified_level_id.php";
    const userInput = document.getElementById("specified_level_id").value;
    openURL(baseUrl, { userInput });
}

function specifiedLevelIdLevel() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_specified_level_id_level.php";
    const location_id = document.getElementById("location_id").value;
    const specified_level_id_level = document.getElementById("specified_level_id_level").value;
    openURL(baseUrl, { location_id, specified_level_id_level });
}

function specifiedLevelIdLevelByBasin() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_specified_level_id_level_by_basin.php";
    const basin = document.getElementById("basin").value;
    const specified_level_id_level = document.getElementById("specified_level_id_level").value;
    openURL(baseUrl, { basin, specified_level_id_level });
}

function datumConversionByBasin() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_datum_conversion_by_basin.php";
    const basin = document.getElementById("basin").value;
    openURL(baseUrl, { basin });
}

function gageControlByBasin() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_gage_control_by_basin.php";
    const userInput = document.getElementById("gage_control_basin").value;
    openURL(baseUrl, { basin: userInput });
}

function gageControlByLocation() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_gage_control_by_location_id.php";
    const userInput = document.getElementById("gage_control_location_id").value;
    openURL(baseUrl, { location_id: userInput });
}

function gageMetadataByLocation() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_metadata_by_location_id.php";
    const userInput = document.getElementById("location_id").value;
    openURL(baseUrl, { location_id: userInput });
}

function mvsDssLocation() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_mvs_dss_location.php";
    const userInput = document.getElementById("mvs_dss_location").value;
    openURL(baseUrl, { userInput });
}

function level() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_level.php";
    const userInput = document.getElementById("stage").value;
    openURL(baseUrl, { cwms_ts_id: userInput });
}

function precip() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_precip.php";
    const userInput = document.getElementById("precip").value;
    openURL(baseUrl, { cwms_ts_id: userInput });
}

function crest() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_crest.php";
    const userInput = document.getElementById("crest").value;
    openURL(baseUrl, { cwms_ts_id: userInput });
}

function nwsForecast() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_nws_forecast.php";
    const cwms_ts_id = document.getElementById("nws_forecast").value;
    const day1 = document.getElementById("nws_forecast_day1").value;
    const day2 = document.getElementById("nws_forecast_day2").value;
    const day3 = document.getElementById("nws_forecast_day3").value;
    openURL(baseUrl, { cwms_ts_id, nws_day1_date: day1, nws_day2_date: day2, nws_day3_date: day3 });
}

function timeSeries() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_ts_lookback.php";
    const cwms_ts_id = document.getElementById("ts").value;
    const start_day = document.getElementById("start_day").value;
    const end_day = document.getElementById("end_day").value;
    openURL(baseUrl, { cwms_ts_id, start_day, end_day });
}

function yearlyMinRdl() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_yearly_min_rdl.php";
    const cwms_ts_id = document.getElementById("cwms_ts_id").value;
    const year = document.getElementById("year").value;
    openURL(baseUrl, { cwms_ts_id, year });
}

function datmanDataEditingStatusByBasin() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_datman_data_editing_status_by_basin.php";
    const basin = document.getElementById("basin").value;
    const type = document.getElementById("type").value;
    openURL(baseUrl, { basin, type });
}

function yearlyMaxRdl() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_yearly_max_rdl.php";
    const cwms_ts_id = document.getElementById("cwms_ts_id").value;
    const year = document.getElementById("year").value;
    openURL(baseUrl, { cwms_ts_id, year });
}

function yearlyMin() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_yearly_min.php";
    const cwms_ts_id = document.getElementById("cwms_ts_id").value;
    const year = document.getElementById("year").value;
    openURL(baseUrl, { cwms_ts_id, year });
}

function yearlyMax() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_yearly_max.php";
    const cwms_ts_id = document.getElementById("cwms_ts_id").value;
    const year = document.getElementById("year").value;
    openURL(baseUrl, { cwms_ts_id, year });
}

function netmissForecast() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_netmiss_forecast.php";
    const tsid_netmiss = document.getElementById("tsid_netmiss").value;
    const tsid_netmiss_observe = document.getElementById("tsid_netmiss_observe").value;
    const nws_day0_date = document.getElementById("nws_day0_date").value;
    openURL(baseUrl, { tsid_netmiss, tsid_netmiss_observe, nws_day0_date });
}

function netmiss() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_netmiss.php";
    const tsid_netmiss = document.getElementById("tsid_netmiss").value;
    openURL(baseUrl, { tsid_netmiss });
}

function lakePrecip() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake_precip.php";
    const userInput = document.getElementById("lake_precip").value;
    openURL(baseUrl, { location_id: userInput });
}

function lakeStorage() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake_storage.php";
    const userInput = document.getElementById("lake_storage").value;
    openURL(baseUrl, { cwms_ts_id: userInput });
}

function lakeInflow() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake_inflow.php";
    const userInput = document.getElementById("lake_inflow").value;
    openURL(baseUrl, { location_id: userInput });
}

function lakeOutflow() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake_outflow.php";
    const userInput = document.getElementById("lake_outflow").value;
    openURL(baseUrl, { location_id: userInput });
}

function ruleCurve() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_rule_curve.php";
    const userInput = document.getElementById("rule_curve").value;
    openURL(baseUrl, { location_id: userInput });
}

function lakeCrestForecast() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake_crest_forecast.php";
    const userInput = document.getElementById("lake_crest_forecast").value;
    openURL(baseUrl, { location_id: userInput });
}

function ldGateSummary() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_ld_gate_summary.php";
    const project_id = document.getElementById("project_id").value;
    const pool = document.getElementById("pool").value;
    const tw = document.getElementById("tw").value;
    const hinge = document.getElementById("hinge").value;
    const taint = document.getElementById("taint").value;
    const roll = document.getElementById("roll").value;
    openURL(baseUrl, { project_id: project_id, pool: pool, tw: tw, hinge: hinge, taint: taint, roll: roll });
}

function recordStage() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_record_stage.php";
    const userInput = document.getElementById("record_stage").value;
    openURL(baseUrl, { location_id: userInput });
}							