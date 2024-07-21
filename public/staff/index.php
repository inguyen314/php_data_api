<?php require_once('../../private/initialize.php'); ?>
<?php //require_login(); ?>
<?php $page_title = 'Staff Menu'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <div id="main-menu">
        <script type="text/javascript">
            function openURL(baseUrl, queryParams) {
                const url = new URL(baseUrl);
                for (const key in queryParams) {
                    url.searchParams.append(key, queryParams[key]);
                }
                window.open(url, "_blank");
            }

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

            function allBasins() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_all_basins.php";
                const userInput = document.getElementById("all_basins").value;
                openURL(baseUrl, { userInput });
            }

            function mvsBasins() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_mvs_basins.php";
                const userInput = document.getElementById("mvs_basins").value;
                openURL(baseUrl, { userInput });
            }

            function riverReservoirBasins() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_river_reservoir_basins.php";
                const userInput = document.getElementById("river_reservoir_basins").value;
                openURL(baseUrl, { userInput });
            }

            function riverReservoirLakes() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_river_reservoir_lakes.php";
                const userInput = document.getElementById("river_reservoir_lakes").value;
                openURL(baseUrl, { userInput });
            }

            function riverReservoirLakeLocations() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_river_reservoir_lake_locations.php";
                const userInput = document.getElementById("river_reservoir_lake_locations").value;
                openURL(baseUrl, { userInput });
            }

            function allVersionIds() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_all_version_ids.php";
                const userInput = document.getElementById("all_version_ids").value;
                openURL(baseUrl, { userInput });
            }

            function allParameterIds() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_all_parameter_ids.php";
                const userInput = document.getElementById("all_parameter_ids").value;
                openURL(baseUrl, { userInput });
            }

            function allLocationIds() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_all_location_ids.php";
                const userInput = document.getElementById("all_location_ids").value;
                openURL(baseUrl, { userInput });
            }

            function ratingStageCoe() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_rating_stage_coe.php";
                const userInput = document.getElementById("rating_stage_coe").value;
                openURL(baseUrl, { userInput });
            }

            function locationIdRatingStageCoe() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_location_id_rating_stage_coe.php";
                const userInput = document.getElementById("location_id_rating_stage_coe").value;
                openURL(baseUrl, { location_id: userInput });
            }

            function locationIdRatingStageUsgs() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_location_id_rating_stage_usgs.php";
                const userInput = document.getElementById("location_id_rating_stage_usgs").value;
                openURL(baseUrl, { location_id: userInput });
            }

            function ratingStageUsgs() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_rating_stage_usgs.php";
                const userInput = document.getElementById("rating_stage_usgs").value;
                openURL(baseUrl, { userInput });
            }

            function locationIdRatingStageNws() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_location_id_rating_stage_nws.php";
                const userInput = document.getElementById("location_id_rating_stage_nws").value;
                openURL(baseUrl, { location_id: userInput });
            }

            function ratingStageNws() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_rating_stage_nws.php";
                const userInput = document.getElementById("rating_stage_nws").value;
                openURL(baseUrl, { userInput });
            }

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

            function carlyleForecast() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_carlyle_forecast.php";
                const userInput = document.getElementById("carlyle_forecast").value;
                openURL(baseUrl, { userInput });
            }

            function shelbyvilleForecast() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_shelbyville_forecast.php";
                const userInput = document.getElementById("shelbyville_forecast").value;
                openURL(baseUrl, { userInput });
            }

            function wappapelloForecast() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_wappapello_forecast.php";
                const userInput = document.getElementById("wappapello_forecast").value;
                openURL(baseUrl, { userInput });
            }

            function rendForecast() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_rend_forecast.php";
                const userInput = document.getElementById("rend_forecast").value;
                openURL(baseUrl, { userInput });
            }

            function markTwainForecast() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_mark_twain_forecast.php";
                const userInput = document.getElementById("mark_twain_forecast").value;
                openURL(baseUrl, { userInput });
            }

            function markTwainYesterdayForecast() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_mark_twain_yesterday_forecast.php";
                const userInput = document.getElementById("mark_twain_yesterday_forecast").value;
                openURL(baseUrl, { userInput });
            }

            function ld24Pool() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_ld24_pool.php";
                const userInput = document.getElementById("ld24_pool").value;
                openURL(baseUrl, { userInput });
            }

            function ld24Pool2() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_ld24_pool_2.php";
                const userInput = document.getElementById("ld24_pool_2").value;
                openURL(baseUrl, { userInput });
            }

            function ld24Tw() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_ld24_tw.php";
                const userInput = document.getElementById("ld24_tw").value;
                openURL(baseUrl, { userInput });
            }

            function ld25Pool() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_ld25_pool.php";
                const userInput = document.getElementById("ld25_pool").value;
                openURL(baseUrl, { userInput });
            }

            function ld25Pool2() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_ld25_pool_2.php";
                const userInput = document.getElementById("ld25_pool_2").value;
                openURL(baseUrl, { userInput });
            }

            function ld25Tw() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_ld25_tw.php";
                const userInput = document.getElementById("ld25_tw").value;
                openURL(baseUrl, { userInput });
            }

            function ldMelPricePool() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_ldmp_pool.php";
                const userInput = document.getElementById("ldmp_pool").value;
                openURL(baseUrl, { userInput });
            }

            function ldMelPricePool2() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_ldmp_pool_2.php";
                const userInput = document.getElementById("ldmp_pool_2").value;
                openURL(baseUrl, { userInput });
            }

            function ldMelPriceTw() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_ldmp_tw.php";
                const userInput = document.getElementById("ldmp_tw").value;
                openURL(baseUrl, { userInput });
            }

            function crestForecastCarlyle() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_crest_forecast_carlyle.php";
                const userInput = document.getElementById("crest_forecast_carlyle").value;
                openURL(baseUrl, { userInput });
            }

            function crestForecastShelbyville() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_crest_forecast_shelbyville.php";
                const userInput = document.getElementById("crest_forecast_shelbyville").value;
                openURL(baseUrl, { userInput });
            }

            function crestForecastWapppapello() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_crest_forecast_wappapello.php";
                const userInput = document.getElementById("crest_forecast_wappapello").value;
                openURL(baseUrl, { userInput });
            }

            function crestForecastMarkTwain() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_crest_forecast_mark_twain.php";
                const userInput = document.getElementById("crest_forecast_mark_twain").value;
                openURL(baseUrl, { userInput });
            }

            function crestForecastRend() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_crest_forecast_rend.php";
                const userInput = document.getElementById("crest_forecast_rend").value;
                openURL(baseUrl, { userInput });
            }

            function rollerTainterLd24() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_roller_tainter_ld24.php";
                const userInput = document.getElementById("roller_tainter_ld24").value;
                openURL(baseUrl, { userInput });
            }

            function rollerTainterLd25() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_roller_tainter_ld25.php";
                const userInput = document.getElementById("roller_tainter_ld25").value;
                openURL(baseUrl, { userInput });
            }

            function rollerTainterLdMelPrice() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_roller_tainter_ldmp.php";
                const userInput = document.getElementById("roller_tainter_ldmp").value;
                openURL(baseUrl, { userInput });
            }

            function morningReport() {
                const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_morning_report.php";
                const tsId = document.getElementById("tsId").value;
                const hour_cst = document.getElementById("hour_cst").value;
                const interval = document.getElementById("interval").value;
                const interval2 = document.getElementById("interval2").value;
                openURL(baseUrl, { tsId: tsId, hour_cst: hour_cst, interval: interval, interval2: interval2 });
            }
        </script>
        <style>
            input[type="text"] {
                width: 50%;
            }
        </style>

        <h1>QUERIES</h1>
        <!-- QUERIES -->
        <div>
            <h2>Get Gage Control</h2>
            <p><a href="https://wm.mvs.ds.usace.army.mil/php_data_api/public/json/gage_control.json" target="_blank">https://wm.mvs.ds.usace.army.mil/php_data_api/public/json/gage_control.json</a></p>

            <h2>Get Database Info</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_db_info.php</p>
            <div>
                <label>disabled: </label>
                <input type="text" id="db_info" name="db_info" disabled>
                <button onclick="dbInfo()">Submit</button>
            </div>

            <h2>Get Loading Application</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_loading_application.php</p>
            <div>
                <label>disabled: </label>
                <input type="text" id="loading_application" name="loading_application" disabled>
                <button onclick="loadingApplication()">Submit</button>
            </div>

            <h2>Get Comp Retry</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_comp_retry.php</p>
            <div>
                <label>disabled: </label>
                <input type="text" id="comp_retry" name="comp_retry" disabled>
                <button onclick="compRetry()">Submit</button>
            </div>

            <h2>Get Location Id Username At Log Message</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_location_id_username_at_log_message.php</p>
            <div>
                <label>disabled: </label>
                <input type="text" id="location_id_username_at_log_message" name="location_id_username_at_log_message" disabled>
                <button onclick="locationIdUsernameAtLogMessage()">Submit</button>
            </div>

            <h2>Get At Log Message</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_at_log_message.php</p>
            <div>
                <label>disabled: </label>
                <input type="text" id="at_log_message" value="B3WEBA18">
                <button onclick="atLogMessage()">Submit</button>
            </div>

            <h2>Get Cp Comp Tasklist</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_cp_comp_tasklist.php</p>
            <div>
                <label>disabled: </label>
                <input type="text" id="cp_comp_tasklist" name="cp_comp_tasklist" disabled>
                <button onclick="cpCompTasklist()">Submit</button>
            </div>

            <h2>Get Active Sessions</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_active_sessions.php</p>
            <div>
                <label>disabled: </label>
                <input type="text" id="active_sessions" name="active_sessions" disabled>
                <button onclick="activeSessions()">Submit</button>
            </div>

            <h2>Get V Session b3weba18</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_v_session_b3weba18.php</p>
            <div>
                <label>disabled: </label>
                <input type="text" id="v_session_b3weba18" name="v_session_b3weba18" disabled>
                <button onclick="vSessionB3weba18()">Submit</button>
            </div>

            <h2>Get V Session b3cwpa18</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_v_session_b3cwpa18.php</p>
            <div>
                <label>disabled: </label>
                <input type="text" id="v_session_b3cwpa18" name="v_session_b3cwpa18" disabled>
                <button onclick="vSessionB3cwpa18()">Submit</button>
            </div>

            <h2>Get Gage Control</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_gage_control.php</p>
            <div>
                <label>disabled: </label>
                <input type="text" id="gage_control" name="all_basin" disabled>
                <button onclick="gageControl()">Submit</button>
            </div>

            <h2>Get All Basins</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_all_basins.php</p>
            <div>
                <label>disabled: </label>
                <input type="text" id="all_basins" disabled>
                <button onclick="allBasins()">Submit</button>
            </div>

            <h2>Get MVS Basins</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_mvs_basins.php</p>
            <div>
                <label>disabled: </label>
                <input type="text" id="mvs_basins" disabled>
                <button onclick="allBasins()">Submit</button>
            </div>

            <h2>Get River Reservoir Basins</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_river_reservoir_basins.php</p>
            <div>
                <label>disabled: </label>
                <input type="text" id="river_reservoir_basins" disabled>
                <button onclick="riverReservoirBasins()">Submit</button>
            </div>

            <h2>Get River Reservoir Lakes</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_river_reservoir_lakes.php</p>
            <div>
                <label>disabled: </label>
                <input type="text" id="river_reservoir_lakes" disabled>
                <button onclick="riverReservoirLakes()">Submit</button>
            </div>

            <h2>Get River Reservoir Lake Locations</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_river_reservoir_lake_locations.php</p>
            <div>
                <label>disabled: </label>
                <input type="text" id="river_reservoir_lake_locations" disabled>
                <button onclick="riverReservoirLakeLocations()">Submit</button>
            </div>

            <h2>Get All Version Ids</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_all_version_ids.php</p>
            <div>
                <label>disabled: </label>
                <input type="text" id="all_version_ids" disabled>
                <button onclick="allVersionIds()">Submit</button>
            </div>

            <h2>Get All Parameter Ids</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_all_parameter_ids.php</p>
            <div>
                <label>disabled: </label>
                <input type="text" id="all_parameter_ids" disabled>
                <button onclick="allParameterIds()">Submit</button>
            </div>

            <h2>Get All Location Ids</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_all_location_ids.php</p>
            <div>
                <label>disabled: </label>
                <input type="text" id="all_location_ids" disabled>
                <button onclick="allLocationIds()">Submit</button>
            </div>

            <h2>Get Rating Stage Coe</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_rating_stage_coe.php</p>
            <div>
                <label>disabled: </label>
                <input type="text" id="rating_stage_coe" disabled>
                <button onclick="ratingStageCoe()">Submit</button>
            </div>

            <h2>Get Location Id Rating Stage Coe</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_location_id_rating_stage_coe.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="location_id_rating_stage_coe" value="St Louis-Mississippi">
                <button onclick="locationIdRatingStageCoe()">Submit</button>
            </div>

            <h2>Get Location Id Rating Stage Usgs</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_location_id_rating_stage_usgs.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="location_id_rating_stage_usgs" value="Chester-Mississippi">
                <button onclick="locationIdRatingStageUsgs()">Submit</button>
            </div>

            <h2>Get Rating Stage Usgs</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_rating_stage_usgs.php</p>
            <div>
                <label>disabled: </label>
                <input type="text" id="rating_stage_usgs" disabled>
                <button onclick="ratingStageCoe()">Submit</button>
            </div>

            <h2>Get Location Id Rating Stage Nws</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_location_id_rating_stage_nws.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="location_id_rating_stage_nws" value="Chester-Mississippi">
                <button onclick="locationIdRatingStageNws()">Submit</button>
            </div>

            <h2>Get Rating Stage Nws</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_rating_stage_nws.php</p>
            <div>
                <label>disabled: </label>
                <input type="text" id="rating_stage_nws" disabled>
                <button onclick="ratingStageNws()">Submit</button>
            </div>

            <h2>Get Rating COE Table</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_rating_coe_table.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="rating_coe_table" value="Chester-Mississippi">
                <button onclick="ratingCoeTable()">Submit</button>
            </div>

            <h2>Get Rating USGS Table</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_rating_usgs_table.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="rating_usgs_table" value="Chester-Mississippi">
                <button onclick="ratingUsgsTable()">Submit</button>
            </div>

            <h2>Get Rating NWS Table</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_rating_nws_table.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="rating_nws_table" value="Chester-Mississippi">
                <button onclick="ratingNwsTable()">Submit</button>
            </div>

            <h2>Get Location Id Datman Extents</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_location_id_datman_extents.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="location_id_datman_extents" value="Chester-Mississippi">
                <button onclick="locationIdDatmanExtents()">Submit</button>
            </div>

            <h2>Get Tsid Extents</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_tsid_extents.php</p>
            <div>
                <label>cwms_ts_id: </label>
                <input type="text" id="get_tsid_extents" value="Chester-Mississippi.Stage.Inst.30Minutes.0.lrgsShef-rev">
                <button onclick="tsidExtents()">Submit</button>
            </div>

            <h2>Get Location Id Lake Inflow Extents</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_location_id_lake_inflow_extents.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="location_id_lake_inflow_extents" value="Carlyle Lk-Kaskaskia">
                <button onclick="locationIdLakeInflowExtents()">Submit</button>
            </div>

            <h2>Get Location Id Lake Outflow Extents</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_location_id_lake_outflow_extents.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="location_id_lake_outflow_extents" value="Carlyle Lk-Kaskaskia">
                <button onclick="locationIdLakeOutflowExtents()">Submit</button>
            </div>

            <h2>Get Datman Rev Basin</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_datman_rev_basin.php</p>
            <div>
                <label>basin: </label>
                <input type="text" id="datman_rev_basin" value="Mississippi">
                <button onclick="datmanRevBasin()">Submit</button>
            </div>

            <h2>Get MVS DSS Location</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_mvs_dss_location.php</p>
            <div>
                <label>disabled: </label>
                <input type="text" id="mvs_dss_location" disabled>
                <button onclick="mvsDssLocation()">Submit</button>
            </div>

            <h2>Get Yearly Min RDL</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_yearly_min_rdl.php</p>
            <div>
                <label>cwms_ts_id: </label>
                <input type="text" id="cwms_ts_id" value="St Louis-Mississippi.Stage.Inst.30Minutes.0.lrgsShef-rev">
                <br>
                <label for="year">start day: </label>
                <input type="text" id="year" value="2020">
                <button onclick="yearlyMinRdl()">Submit</button>
            </div>

            <h2>Get Yearly Max RDL</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_yearly_max_rdl.php</p>
            <div>
                <label>cwms_ts_id: </label>
                <input type="text" id="cwms_ts_id" value="St Louis-Mississippi.Stage.Inst.30Minutes.0.lrgsShef-rev">
                <br>
                <label for="year">start day: </label>
                <input type="text" id="year" value="2022">
                <button onclick="yearlyMaxRdl()">Submit</button>
            </div>

            <h2>Get Yearly Min</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_yearly_min.php</p>
            <div>
                <label>cwms_ts_id: </label>
                <input type="text" id="cwms_ts_id" value="St Louis-Mississippi.Stage.Inst.30Minutes.0.lrgsShef-rev">
                <br>
                <label for="year">start day: </label>
                <input type="text" id="year" value="2020">
                <button onclick="yearlyMin()">Submit</button>
            </div>

            <h2>Get Yearly Max</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_yearly_max.php</p>
            <div>
                <label>cwms_ts_id: </label>
                <input type="text" id="cwms_ts_id" value="St Louis-Mississippi.Stage.Inst.30Minutes.0.lrgsShef-rev">
                <br>
                <label for="year">start day: </label>
                <input type="text" id="year" value="2020">
                <button onclick="yearlyMax()">Submit</button>
            </div>

            <h2>Get Datman Data Editing Status By Basin</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_datman_data_editing_status_by_basin.php</p>
            <div>
                <label>basin: </label>
                <input type="text" id="basin" value="Mississippi">
                <br>
                <label>type: </label>
                <input type="text" id="type" value="">
                <button onclick="datmanDataEditingStatusByBasin()">Submit</button>
            </div>

            <h2>Get Specified Level Id</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_specified_level_id.php</p>
            <div>
                <label>specified_level_id: </label>
                <input type="text" id="specified_level_id" disabled>
                <button onclick="specifiedLevelId()">Submit</button>
            </div>

            <h2>Get Specified Level Id Level</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_specified_level_id_level.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="location_id" value="Chester-Mississippi">
                <br>
                <label>specified_level_id_level: </label>
                <input type="text" id="specified_level_id_level" value="Flood">
                <button onclick="specifiedLevelIdLevel()">Submit</button>
            </div>

            <h2>Get Specified Level Id Level By Basin</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_specified_level_id_level_by_basin.php</p>
            <div>
                <label>basin: </label>
                <input type="text" id="basin" value="Mississippi">
                <br>
                <label>specified_level_id_level: </label>
                <input type="text" id="specified_level_id_level" value="Flood">
                <button onclick="specifiedLevelIdLevelByBasin()">Submit</button>
            </div>

            <h2>Get Datum Conversion By Basin</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_datum_conversion_by_basin.php</p>
            <div>
                <label>basin: </label>
                <input type="text" id="basin" value="Mississippi">
                <button onclick="datumConversionByBasin()">Submit</button>
            </div>

            <h2>Get Gage Control Metadata By Basin</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_gage_control_by_basin.php</p>
            <div>
                <label for="basin">basin: </label>
                <input type="text" id="gage_control_basin" name="basin" value="Mississippi">
                <button onclick="gageControlByBasin()">Submit</button>
            </div>

            <h2>Get Gage Control Metadata By Location</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_gage_control_by_location_id.php</p>
            <div>
                <label for="location_id">location: </label>
                <input type="text" id="gage_control_location_id" name="location_id" value="St Louis-Mississippi">
                <button onclick="gageControlByLocation()">Submit</button>
            </div>

            <h2>Get Metadata By Location</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_metadata_by_location_id.php</p>
            <div>
                <label for="location_id">location: </label>
                <input type="text" id="location_id" name="location_id" value="St Louis-Mississippi">
                <button onclick="gageMetadataByLocation()">Submit</button>
            </div>

            <h2>Get Level</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_level.php</p>
            <div>
                <label for="cwms_ts_id">cwms_ts_id: </label>
                <input type="text" id="stage" name="cwms_ts_id" value="St Louis-Mississippi.Stage.Inst.30Minutes.0.lrgsShef-rev">
                <button onclick="level()">Submit</button>
            </div>

            <h2>Get Precip</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_precip.php</p>
            <div>
                <label for="cwms_ts_id">cwms_ts_id: </label>
                <input type="text" id="precip" name="cwms_ts_id" value="Grafton-Mississippi.Precip.Inst.30Minutes.0.lrgsShef-raw">
                <button onclick="precip()">Submit</button>
            </div>

            <h2>Get Crest (Event Driven)</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_crest.php</p>
            <div>
                <label for="cwms_ts_id">cwms_ts_id: </label>
                <input type="text" id="crest" name="cwms_ts_id" value="Meredosia-Illinois.Stage.Inst.6Hours.0.RVFShef-FX">
                <button onclick="crest()">Submit</button>
            </div>

            <h2>Get NWS 3 Days Forecast</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_nws_forecast.php</p>
            <div>
                <label for="nws_forecast">cwms_ts_id: </label>
                <input type="text" id="nws_forecast" name="cwms_ts_id" value="St Louis-Mississippi.Stage.Inst.6Hours.0.RVFShef-FF">
                <br>
                <label for="nws_forecast_day1">nws_day1_date: </label>
                <input type="text" id="nws_forecast_day1" name="nws_day1_date" value="01-01-2024">
                <br>
                <label for="nws_forecast_day2">nws_day2_date: </label>
                <input type="text" id="nws_forecast_day2" name="nws_day2_date" value="01-02-2024">
                <br>
                <label for="nws_forecast_day3">nws_day3_date: </label>
                <input type="text" id="nws_forecast_day3" name="nws_day3_date" value="01-03-2024">
                <button onclick="nwsForecast()">Submit</button>
            </div>

            <h2>Get Time Series with Lookback</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_ts_lookback.php</p>
            <div>
                <label for="cwms_ts_id">cwms_ts_id: </label>
                <input type="text" id="ts" name="cwms_ts_id" value="St Louis-Mississippi.Stage.Inst.30Minutes.0.lrgsShef-rev">
                <br>
                <label for="start_day">start day: </label>
                <input type="text" id="start_day" name="start_day" value="-4">
                <br>
                <label for="end_day">end day: </label>
                <input type="text" id="end_day" name="end_day" value="0">
                <button onclick="timeSeries()">Submit</button>
            </div>

            <h2>Get Netmiss Forecast</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_netmiss_forecast.php</p>
            <div>
                <label for="tsid_netmiss">tsid_netmiss: </label>
                <input type="text" id="tsid_netmiss" name="tsid_netmiss" value="St Louis-Mississippi.Stage.Inst.~1Day.0.netmiss-fcst">
                <br>
                <label for="tsid_netmiss_observe">tsid_netmiss_observe: </label>
                <input type="text" id="tsid_netmiss_observe" name="tsid_netmiss_observe" value="St Louis-Mississippi.Stage.Inst.30Minutes.0.lrgsShef-rev">
                <br>
                <label for="nws_day0_date">nws_day0_date: </label>
                <input type="text" id="nws_day0_date" name="nws_day0_date" value="01-01-2024">
                <button onclick="netmissForecast()">Submit</button>
            </div>

            <h2>Get Netmiss</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_netmiss.php</p>
            <div>
                <label for="tsid_netmiss">tsid_netmiss: </label>
                <input type="text" id="tsid_netmiss" name="tsid_netmiss" value="St Louis-Mississippi.Stage.Inst.~1Day.0.netmiss-fcst">
                <button onclick="netmiss()">Submit</button>
            </div>

            <h2>Get Lake Precip</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake_precip.php</p>
            <div>
                <label for="location_id">location: </label>
                <input type="text" id="lake_precip" name="location_id" value="Carlyle Lk-Kaskaskia">
                <button onclick="lakePrecip()">Submit</button>
            </div>

            <h2>Get Lake Storage</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake_storage.php</p>
            <div>
                <label for="cwms_ts_id">cwms_ts_id: </label>
                <input type="text" id="lake_storage" name="cwms_ts_id" value="Carlyle Lk-Kaskaskia">
                <button onclick="lakeStorage()">Submit</button>
            </div>

            <h2>Get Lake Inflow</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake_inflow.php</p>
            <div>
                <label for="location_id">location_id: </label>
                <input type="text" id="lake_inflow" name="location_id" value="Carlyle Lk-Kaskaskia">
                <button onclick="lakeInflow()">Submit</button>
            </div>

            <h2>Get Lake Outflow</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake_outflow.php</p>
            <div>
                <label for="location_id">location_id: </label>
                <input type="text" id="lake_outflow" name="location_id" value="Carlyle Lk-Kaskaskia">
                <button onclick="lakeOutflow()">Submit</button>
            </div>

            <h2>Get Lake Rule Curve</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_rule_curve.php</p>
            <div>
                <label for="location_id">location_id: </label>
                <input type="text" id="rule_curve" name="location_id" value="Carlyle Lk-Kaskaskia">
                <button onclick="ruleCurve()">Submit</button>
            </div>

            <h2>Get Lake Crest Forecast</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake_crest_forecast.php</p>
            <div>
                <label for="location_id">location_id: </label>
                <input type="text" id="lake_crest_forecast" name="location_id" value="Carlyle Lk-Kaskaskia">
                <button onclick="lakeCrestForecast()">Submit</button>
            </div>

            <h2>Get LD Gate Summary</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_ld_gate_summary.php</p>
            <div>
                <label for="project_id">cwms_ts_id: </label>
                <input type="text" id="project_id" name="project_id" value="LD 25">
                <br>
                <label for="pool">cwms_ts_id: </label>
                <input type="text" id="pool" name="pool" value="LD 25 Pool-Mississippi.Stage.Inst.30Minutes.0.29">
                <br>
                <label for="tw">cwms_ts_id: </label>
                <input type="text" id="tw" name="tw" value="LD 25 TW-Mississippi.Stage.Inst.30Minutes.0.lrgsShef-rev">
                <br>
                <label for="hinge">cwms_ts_id: </label>
                <input type="text" id="hinge" name="hinge" value="Mosier Ldg-Mississippi.Stage.Inst.30Minutes.0.lrgsShef-rev">
                <br>
                <label for="taint">cwms_ts_id: </label>
                <input type="text" id="taint" name="taint" value="LD 25 Pool-Mississippi.Opening.Inst.~2Hours.0.lpmsShef-raw-Taint">
                <br>
                <label for="roll">cwms_ts_id: </label>
                <input type="text" id="roll" name="roll" value="LD 25 Pool-Mississippi.Opening.Inst.~2Hours.0.lpmsShef-raw-Roll">
                <button onclick="ldGateSummary()">Submit</button>
            </div>

            <h2>Get Record Stage</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_record_stage.php</p>
            <div>
                <label for="location_id">location: </label>
                <input type="text" id="record_stage" name="location_id" value="St Louis-Mississippi">
                <button onclick="recordStage()">Submit</button>
            </div>
        </div>
        
        <h1><u>LAKE QUERIES</u></h1> 
        <!-- LAKE QUERIES -->
        <div>
            <h2>Get Carlyle Forecast</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_carlyle_forecast.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="carlyle_forecast" disabled>
                <button onclick="carlyleForecast()">Submit</button>
            </div>

            <h2>Get Shelbyville Forecast</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_shelbyville_forecast.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="shelbyville_forecast" disabled>
                <button onclick="shelbyvilleForecast()">Submit</button>
            </div>

            <h2>Get Wappapello Forecast</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_wappapello_forecast.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="wappapello_forecast" disabled>
                <button onclick="wappapelloForecast()">Submit</button>
            </div>

            <h2>Get Rend Forecast</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_rend_forecast.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="rend_forecast" disabled>
                <button onclick="rendForecast()">Submit</button>
            </div>

            <h2>Get Mark Twain Forecast</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_mark_twain_forecast.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="mark_twain_forecast" disabled>
                <button onclick="markTwainForecast()">Submit</button>
            </div>

            <h2>Get Mark Twain Yesterday Forecast</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_mark_twain_yesterday_forecast.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="mark_twain_yesterday_forecast" disabled>
                <button onclick="markTwainYesterdayForecast()">Submit</button>
            </div>

            <h2>Get LD24 Pool</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_ld24_pool.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="ld24_pool" disabled>
                <button onclick="ld24Pool()">Submit</button>
            </div>

            <h2>Get LD24 Pool 2</h2><!-- remove current pool reading per NWS -->
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_ld24_pool_2.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="ld24_pool_2" disabled>
                <button onclick="ld24Pool2()">Submit</button>
            </div>

            <h2>Get LD24 TW</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_ld24_tw.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="ld24_tw" disabled>
                <button onclick="ld24Tw()">Submit</button>
            </div>

            <h2>Get LD25 Pool</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_ld25_pool.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="ld25_pool" disabled>
                <button onclick="ld25Pool()">Submit</button>
            </div>

            <h2>Get LD25 Pool 2</h2><!-- remove current pool reading per NWS -->
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_ld25_pool_2.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="ld25_pool_2" disabled>
                <button onclick="ld25Pool2()">Submit</button>
            </div>

            <h2>Get LD25 TW</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_ld25_tw.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="ld25_tw" disabled>
                <button onclick="ld25Tw()">Submit</button>
            </div>

            <h2>Get LD Mel Price Pool</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_ldmp_pool.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="ldmp_pool" disabled>
                <button onclick="ldMelPricePool()">Submit</button>
            </div>

            <h2>Get LD Mel Price Pool 2</h2><!-- remove current pool reading per NWS -->
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_ldmp_pool_2.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="ldmp_pool_2" disabled>
                <button onclick="ldMelPricePool2()">Submit</button>
            </div>

            <h2>Get LD Mel Price TW</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_ldmp_tw.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="ldmp_tw" disabled>
                <button onclick="ldMelPriceTw()">Submit</button>
            </div>

            <h2>Get Crest Forecast Carlyle</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_crest_forecast_carlyle.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="crest_forecast_carlyle" disabled>
                <button onclick="crestForecastCarlyle()">Submit</button>
            </div>

            <h2>Get Crest Forecast Shelbyville</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_crest_forecast_shelbyville.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="crest_forecast_shelbyville" disabled>
                <button onclick="crestForecastShelbyville()">Submit</button>
            </div>

            <h2>Get Crest Forecast Wappapello</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_crest_forecast_wappapello.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="crest_forecast_wappapello" disabled>
                <button onclick="crestForecastWappapello()">Submit</button>
            </div>

            <h2>Get Crest Forecast Mark Twain</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_crest_forecast_mark_twain.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="crest_forecast_mark_twain" disabled>
                <button onclick="crestForecastMarkTwain()">Submit</button>
            </div>

            <h2>Get Crest Forecast Rend</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_crest_forecast_rend.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="crest_forecast_rend" disabled>
                <button onclick="crestForecastRend()">Submit</button>
            </div>

            <h2>Get Roller Tainter LD24</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_roller_tainter_ld24.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="roller_tainter_ld24" disabled>
                <button onclick="rollerTainterLd24()">Submit</button>
            </div>

            <h2>Get Roller Tainter LD25</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_roller_tainter_ld25.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="roller_tainter_ld25" disabled>
                <button onclick="rollerTainterLd25()">Submit</button>
            </div>

            <h2>Get Roller Tainter Mel Price</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake/get_roller_tainter_ldmp.php</p>
            <div>
                <label>location_id: </label>
                <input type="text" id="roller_tainter_ldmp" disabled>
                <button onclick="rollerTainterLdMelPrice()">Submit</button>
            </div>
        </div>

        <h1><u>MORNING QUERIES</u></h1> 
        <div>
            <h2>Morning Report</h2>
            <p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_morning_report.php</p>
            <div>
                <label for="tsId">tsId: </label>
                <input type="text" id="tsId" name="tsId" value="St Louis-Mississippi.Stage.Inst.30Minutes.0.lrgsShef-rev">
                <br>
                <label for="hour_cst">hour_cst: </label>
                <input type="text" id="hour_cst" name="hour_cst" value="06">
                <br>
                <label for="interval">interval: </label>
                <input type="text" id="interval" name="interval" value="2">
                <br>
                <label for="interval2">interval2: </label>
                <input type="text" id="interval2" name="interval2" value="2">
                <button onclick="morningReport()">Submit</button>
            </div>
        </div>
        





















    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>