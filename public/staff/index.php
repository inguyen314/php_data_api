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
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_gage_control.php";
            const userInput = document.getElementById("gage_control").value;
            openURL(baseUrl, { userInput });
        }

        function allBasins() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_all_basins.php";
            const userInput = document.getElementById("all_basins").value;
            openURL(baseUrl, { userInput });
        }

        function mvsBasins() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_mvs_basins.php";
            const userInput = document.getElementById("mvs_basins").value;
            openURL(baseUrl, { userInput });
        }

        function riverReservoirBasins() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_river_reservoir_basins.php";
            const userInput = document.getElementById("river_reservoir_basins").value;
            openURL(baseUrl, { userInput });
        }

        function riverReservoirLakes() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_river_reservoir_lakes.php";
            const userInput = document.getElementById("river_reservoir_lakes").value;
            openURL(baseUrl, { userInput });
        }

        function riverReservoirLakeLocations() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_river_reservoir_lake_locations.php";
            const userInput = document.getElementById("river_reservoir_lake_locations").value;
            openURL(baseUrl, { userInput });
        }

        function allVersionIds() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_all_version_ids.php";
            const userInput = document.getElementById("all_version_ids").value;
            openURL(baseUrl, { userInput });
        }

        function allParameterIds() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_all_parameter_ids.php";
            const userInput = document.getElementById("all_parameter_ids").value;
            openURL(baseUrl, { userInput });
        }

        function allLocationIds() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_all_location_ids.php";
            const userInput = document.getElementById("all_location_ids").value;
            openURL(baseUrl, { userInput });
        }

        function ratingStageCoe() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_rating_stage_coe.php";
            const userInput = document.getElementById("rating_stage_coe").value;
            openURL(baseUrl, { userInput });
        }

        function locationIdRatingStageCoe() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_location_id_rating_stage_coe.php";
            const userInput = document.getElementById("location_id_rating_stage_coe").value;
            openURL(baseUrl, { location_id: userInput });
        }

        function locationIdRatingStageUsgs() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_location_id_rating_stage_usgs.php";
            const userInput = document.getElementById("location_id_rating_stage_usgs").value;
            openURL(baseUrl, { location_id: userInput });
        }

        function ratingStageUsgs() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_rating_stage_usgs.php";
            const userInput = document.getElementById("rating_stage_usgs").value;
            openURL(baseUrl, { userInput });
        }

        function locationIdRatingStageNws() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_location_id_rating_stage_nws.php";
            const userInput = document.getElementById("location_id_rating_stage_nws").value;
            openURL(baseUrl, { location_id: userInput });
        }

        function ratingStageNws() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_rating_stage_nws.php";
            const userInput = document.getElementById("rating_stage_nws").value;
            openURL(baseUrl, { userInput });
        }

        function ratingCoeTable() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_rating_coe_table.php";
            const userInput = document.getElementById("rating_coe_table").value;
            openURL(baseUrl, { location_id: userInput });
        }

        function ratingUsgsTable() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_rating_usgs_table.php";
            const userInput = document.getElementById("rating_usgs_table").value;
            openURL(baseUrl, { location_id: userInput });
        }

        function ratingNwsTable() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_rating_nws_table.php";
            const userInput = document.getElementById("rating_nws_table").value;
            openURL(baseUrl, { location_id: userInput });
        }

        function locationIdDatmanExtents() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_location_id_datman_extents.php";
            const userInput = document.getElementById("location_id_datman_extents").value;
            openURL(baseUrl, { location_id: userInput });
        }

        function locationIdLakeInflowExtents() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_location_id_lake_inflow_extents.php";
            const userInput = document.getElementById("location_id_lake_inflow_extents").value;
            openURL(baseUrl, { location_id: userInput });
        }

        function locationIdLakeOutflowExtents() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_location_id_lake_outflow_extents.php";
            const userInput = document.getElementById("location_id_lake_outflow_extents").value;
            openURL(baseUrl, { location_id: userInput });
        }

        function datmanRevBasin() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_datman_rev_basin.php";
            const userInput = document.getElementById("datman_rev_basin").value;
            openURL(baseUrl, { basin: userInput });
        }

        function specifiedLevelId() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_specified_level_id.php";
            const userInput = document.getElementById("specified_level_id").value;
            openURL(baseUrl, { userInput });
        }

        function specifiedLevelIdLevel() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_specified_level_id_level.php";
            const location_id = document.getElementById("location_id").value;
            const specified_level_id_level = document.getElementById("specified_level_id_level").value;
            openURL(baseUrl, { location_id, specified_level_id_level });
        }

        function gageControlBasin() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_gage_control_by_basin.php";
            const userInput = document.getElementById("gage_control_basin").value;
            openURL(baseUrl, { basin: userInput });
        }

        function gageControlLocation() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_gage_control_by_location_id.php";
            const userInput = document.getElementById("gage_control_location_id").value;
            openURL(baseUrl, { location_id: userInput });
        }

        function mvsDssLocation() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_mvs_dss_location.php";
            const userInput = document.getElementById("mvs_dss_location").value;
            openURL(baseUrl, { userInput });
        }

        function level() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_level.php";
            const userInput = document.getElementById("stage").value;
            openURL(baseUrl, { cwms_ts_id: userInput });
        }

        function precip() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_precip.php";
            const userInput = document.getElementById("precip").value;
            openURL(baseUrl, { cwms_ts_id: userInput });
        }

        function crest() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_crest.php";
            const userInput = document.getElementById("crest").value;
            openURL(baseUrl, { cwms_ts_id: userInput });
        }

        function nwsForecast() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_nws_forecast.php";
            const cwms_ts_id = document.getElementById("nws_forecast").value;
            const day1 = document.getElementById("nws_forecast_day1").value;
            const day2 = document.getElementById("nws_forecast_day2").value;
            const day3 = document.getElementById("nws_forecast_day3").value;
            openURL(baseUrl, { cwms_ts_id, nws_day1_date: day1, nws_day2_date: day2, nws_day3_date: day3 });
        }

        function timeSeries() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_ts_lookback.php";
            const cwms_ts_id = document.getElementById("ts").value;
            const start_day = document.getElementById("start_day").value;
            const end_day = document.getElementById("end_day").value;
            openURL(baseUrl, { cwms_ts_id, start_day, end_day });
        }

        function yearlyMinRdl() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_yearly_min_rdl.php";
            const cwms_ts_id = document.getElementById("cwms_ts_id").value;
            const year = document.getElementById("year").value;
            openURL(baseUrl, { cwms_ts_id, year });
        }

        function yearlyMaxRdl() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_yearly_max_rdl.php";
            const cwms_ts_id = document.getElementById("cwms_ts_id").value;
            const year = document.getElementById("year").value;
            openURL(baseUrl, { cwms_ts_id, year });
        }

        function yearlyMin() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_yearly_min.php";
            const cwms_ts_id = document.getElementById("cwms_ts_id").value;
            const year = document.getElementById("year").value;
            openURL(baseUrl, { cwms_ts_id, year });
        }

        function yearlyMax() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_yearly_max.php";
            const cwms_ts_id = document.getElementById("cwms_ts_id").value;
            const year = document.getElementById("year").value;
            openURL(baseUrl, { cwms_ts_id, year });
        }

        function netmissForecast() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_netmiss_forecast.php";
            const tsid_netmiss = document.getElementById("tsid_netmiss").value;
            const tsid_netmiss_observe = document.getElementById("tsid_netmiss_observe").value;
            const nws_day0_date = document.getElementById("nws_day0_date").value;
            openURL(baseUrl, { tsid_netmiss, tsid_netmiss_observe, nws_day0_date });
        }

        function netmiss() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_netmiss.php";
            const tsid_netmiss = document.getElementById("tsid_netmiss").value;
            openURL(baseUrl, { tsid_netmiss });
        }

        function lakePrecip() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_lake_precip.php";
            const userInput = document.getElementById("lake_precip").value;
            openURL(baseUrl, { location_id: userInput });
        }

        function lakeStorage() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_lake_storage.php";
            const userInput = document.getElementById("lake_storage").value;
            openURL(baseUrl, { cwms_ts_id: userInput });
        }

        function lakeInflow() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_lake_inflow.php";
            const userInput = document.getElementById("lake_inflow").value;
            openURL(baseUrl, { location_id: userInput });
        }

        function lakeOutflow() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_lake_outflow.php";
            const userInput = document.getElementById("lake_outflow").value;
            openURL(baseUrl, { location_id: userInput });
        }

        function ruleCurve() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_rule_curve.php";
            const userInput = document.getElementById("rule_curve").value;
            openURL(baseUrl, { location_id: userInput });
        }

        function lakeCrestForecast() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_lake_crest_forecast.php";
            const userInput = document.getElementById("lake_crest_forecast").value;
            openURL(baseUrl, { location_id: userInput });
        }

        function ldGateSummary() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_ld_gate_summary.php";
            const project_id = document.getElementById("project_id").value;
            const pool = document.getElementById("pool").value;
            const tw = document.getElementById("tw").value;
            const hinge = document.getElementById("hinge").value;
            const taint = document.getElementById("taint").value;
            const roll = document.getElementById("roll").value;
            openURL(baseUrl, { project_id: project_id, pool: pool, tw: tw, hinge: hinge, taint: taint, roll: roll });
        }

        function recordStage() {
            const baseUrl = "https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_record_stage.php";
            const userInput = document.getElementById("record_stage").value;
            openURL(baseUrl, { location_id: userInput });
        }
    </script>
    <style>
        input[type="text"] {
            width: 50%;
        }
    </style>

    <h2>Get Gage Control</h2>
    <p><a href="https://wm.mvs.ds.usace.army.mil/php-data-api/public/json/gage_control.json" target="_blank">https://wm.mvs.ds.usace.army.mil/php-data-api/public/json/gage_control.json</a></p>

    <h2>Get Meta Data</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_gage_control.php</p>
    <div>
        <label>disabled: </label>
        <input type="text" id="gage_control" name="all_basin" disabled>
        <button onclick="gageControl()">Submit</button>
    </div>

    <h2>Get All Basins</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_all_basins.php</p>
    <div>
        <label>disabled: </label>
        <input type="text" id="all_basins" disabled>
        <button onclick="allBasins()">Submit</button>
    </div>

    <h2>Get MVS Basins</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_mvs_basins.php</p>
    <div>
        <label>disabled: </label>
        <input type="text" id="mvs_basins" disabled>
        <button onclick="allBasins()">Submit</button>
    </div>

    <h2>Get River Reservoir Basins</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_river_reservoir_basins.php</p>
    <div>
        <label>disabled: </label>
        <input type="text" id="river_reservoir_basins" disabled>
        <button onclick="riverReservoirBasins()">Submit</button>
    </div>

    <h2>Get River Reservoir Lakes</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_river_reservoir_lakes.php</p>
    <div>
        <label>disabled: </label>
        <input type="text" id="river_reservoir_lakes" disabled>
        <button onclick="riverReservoirLakes()">Submit</button>
    </div>

    <h2>Get River Reservoir Lake Locations</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_river_reservoir_lake_locations.php</p>
    <div>
        <label>disabled: </label>
        <input type="text" id="river_reservoir_lake_locations" disabled>
        <button onclick="riverReservoirLakeLocations()">Submit</button>
    </div>

    <h2>Get All Version Ids</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_all_version_ids.php</p>
    <div>
        <label>disabled: </label>
        <input type="text" id="all_version_ids" disabled>
        <button onclick="allVersionIds()">Submit</button>
    </div>

    <h2>Get All Parameter Ids</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_all_parameter_ids.php</p>
    <div>
        <label>disabled: </label>
        <input type="text" id="all_parameter_ids" disabled>
        <button onclick="allParameterIds()">Submit</button>
    </div>

    <h2>Get All Location Ids</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_all_location_ids.php</p>
    <div>
        <label>disabled: </label>
        <input type="text" id="all_location_ids" disabled>
        <button onclick="allLocationIds()">Submit</button>
    </div>

    <h2>Get Rating Stage Coe</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_rating_stage_coe.php</p>
    <div>
        <label>disabled: </label>
        <input type="text" id="rating_stage_coe" disabled>
        <button onclick="ratingStageCoe()">Submit</button>
    </div>

    <h2>Get Location Id Rating Stage Coe</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_location_id_rating_stage_coe.php</p>
    <div>
        <label>location_id: </label>
        <input type="text" id="location_id_rating_stage_coe" value="St Louis-Mississippi">
        <button onclick="locationIdRatingStageCoe()">Submit</button>
    </div>

    <h2>Get Location Id Rating Stage Usgs</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_location_id_rating_stage_usgs.php</p>
    <div>
        <label>location_id: </label>
        <input type="text" id="location_id_rating_stage_usgs" value="Chester-Mississippi">
        <button onclick="locationIdRatingStageUsgs()">Submit</button>
    </div>

    <h2>Get Rating Stage Usgs</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_rating_stage_usgs.php</p>
    <div>
        <label>disabled: </label>
        <input type="text" id="rating_stage_usgs" disabled>
        <button onclick="ratingStageCoe()">Submit</button>
    </div>

    <h2>Get Location Id Rating Stage Nws</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_location_id_rating_stage_nws.php</p>
    <div>
        <label>location_id: </label>
        <input type="text" id="location_id_rating_stage_nws" value="Chester-Mississippi">
        <button onclick="locationIdRatingStageNws()">Submit</button>
    </div>

    <h2>Get Rating Stage Nws</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_rating_stage_nws.php</p>
    <div>
        <label>disabled: </label>
        <input type="text" id="rating_stage_nws" disabled>
        <button onclick="ratingStageNws()">Submit</button>
    </div>

    <h2>Get Rating COE Table</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_rating_coe_table.php</p>
    <div>
        <label>location_id: </label>
        <input type="text" id="rating_coe_table" value="Chester-Mississippi">
        <button onclick="ratingCoeTable()">Submit</button>
    </div>

    <h2>Get Rating USGS Table</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_rating_usgs_table.php</p>
    <div>
        <label>location_id: </label>
        <input type="text" id="rating_usgs_table" value="Chester-Mississippi">
        <button onclick="ratingUsgsTable()">Submit</button>
    </div>

    <h2>Get Rating NWS Table</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_rating_nws_table.php</p>
    <div>
        <label>location_id: </label>
        <input type="text" id="rating_nws_table" value="Chester-Mississippi">
        <button onclick="ratingNwsTable()">Submit</button>
    </div>

    <h2>Get Location Id Datman Extents</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_location_id_datman_extents.php</p>
    <div>
        <label>location_id: </label>
        <input type="text" id="location_id_datman_extents" value="Chester-Mississippi">
        <button onclick="locationIdDatmanExtents()">Submit</button>
    </div>

    <h2>Get Location Id Lake Inflow Extents</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_location_id_lake_inflow_extents.php</p>
    <div>
        <label>location_id: </label>
        <input type="text" id="location_id_lake_inflow_extents" value="Carlyle Lk-Kaskaskia">
        <button onclick="locationIdLakeInflowExtents()">Submit</button>
    </div>

    <h2>Get Location Id Lake Outflow Extents</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_location_id_lake_outflow_extents.php</p>
    <div>
        <label>location_id: </label>
        <input type="text" id="location_id_lake_outflow_extents" value="Carlyle Lk-Kaskaskia">
        <button onclick="locationIdLakeOutflowExtents()">Submit</button>
    </div>

    <h2>Get Datman Rev Basin</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_datman_rev_basin.php</p>
    <div>
        <label>basin: </label>
        <input type="text" id="datman_rev_basin" value="Mississippi">
        <button onclick="datmanRevBasin()">Submit</button>
    </div>

    <h2>Get MVS DSS Location</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_mvs_dss_location.php</p>
    <div>
        <label>disabled: </label>
        <input type="text" id="mvs_dss_location" disabled>
        <button onclick="mvsDssLocation()">Submit</button>
    </div>

    <h2>Get Yearly Min RDL</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_yearly_min_rdl.php</p>
    <div>
        <label>cwms_ts_id: </label>
        <input type="text" id="cwms_ts_id" value="St Louis-Mississippi.Stage.Inst.30Minutes.0.lrgsShef-rev">
        <br>
        <label for="year">start day: </label>
        <input type="text" id="year" value="2020">
        <button onclick="yearlyMinRdl()">Submit</button>
    </div>

    <h2>Get Yearly Max RDL</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_yearly_max_rdl.php</p>
    <div>
        <label>cwms_ts_id: </label>
        <input type="text" id="cwms_ts_id" value="St Louis-Mississippi.Stage.Inst.30Minutes.0.lrgsShef-rev">
        <br>
        <label for="year">start day: </label>
        <input type="text" id="year" value="2022">
        <button onclick="yearlyMaxRdl()">Submit</button>
    </div>

    <h2>Get Yearly Min</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_yearly_min.php</p>
    <div>
        <label>cwms_ts_id: </label>
        <input type="text" id="cwms_ts_id" value="St Louis-Mississippi.Stage.Inst.30Minutes.0.lrgsShef-rev">
        <br>
        <label for="year">start day: </label>
        <input type="text" id="year" value="2020">
        <button onclick="yearlyMin()">Submit</button>
    </div>

    <h2>Get Yearly Max</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_yearly_max.php</p>
    <div>
        <label>cwms_ts_id: </label>
        <input type="text" id="cwms_ts_id" value="St Louis-Mississippi.Stage.Inst.30Minutes.0.lrgsShef-rev">
        <br>
        <label for="year">start day: </label>
        <input type="text" id="year" value="2020">
        <button onclick="yearlyMax()">Submit</button>
    </div>

    <h2>Get Specified Level Id</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_specified_level_id.php</p>
    <div>
        <label>specified_level_id: </label>
        <input type="text" id="specified_level_id" disabled>
        <button onclick="specifiedLevelId()">Submit</button>
    </div>

    <h2>Get Specified Level Id Level</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_specified_level_id_level.php</p>
    <div>
        <label>location_id: </label>
        <input type="text" id="location_id" value="Chester-Mississippi">
        <br>
        <label>specified_level_id_level: </label>
        <input type="text" id="specified_level_id_level" value="Flood">
        <button onclick="specifiedLevelIdLevel()">Submit</button>
    </div>

    <h2>Get Meta Data</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_gage_control_by_basin.php</p>
    <div>
        <label for="basin">basin: </label>
        <input type="text" id="gage_control_basin" name="basin" value="Mississippi">
        <button onclick="gageControlBasin()">Submit</button>
    </div>

    <h2>Get Meta Data</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_gage_control_by_location_id.php</p>
    <div>
        <label for="location_id">location: </label>
        <input type="text" id="gage_control_location_id" name="location_id" value="St Louis-Mississippi">
        <button onclick="gageControlLocation()">Submit</button>
    </div>

    <h2>Get Level</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_level.php</p>
    <div>
        <label for="cwms_ts_id">cwms_ts_id: </label>
        <input type="text" id="stage" name="cwms_ts_id" value="St Louis-Mississippi.Stage.Inst.30Minutes.0.lrgsShef-rev">
        <button onclick="level()">Submit</button>
    </div>

    <h2>Get Precip</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_precip.php</p>
    <div>
        <label for="cwms_ts_id">cwms_ts_id: </label>
        <input type="text" id="precip" name="cwms_ts_id" value="Grafton-Mississippi.Precip.Inst.30Minutes.0.lrgsShef-raw">
        <button onclick="precip()">Submit</button>
    </div>

    <h2>Get Crest (Event Driven)</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_crest.php</p>
    <div>
        <label for="cwms_ts_id">cwms_ts_id: </label>
        <input type="text" id="crest" name="cwms_ts_id" value="Meredosia-Illinois.Stage.Inst.6Hours.0.RVFShef-FX">
        <button onclick="crest()">Submit</button>
    </div>

    <h2>Get NWS 3 Days Forecast</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_nws_forecast.php</p>
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
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_ts_lookback.php</p>
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
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_netmiss_forecast.php</p>
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
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_netmiss.php</p>
    <div>
        <label for="tsid_netmiss">tsid_netmiss: </label>
        <input type="text" id="tsid_netmiss" name="tsid_netmiss" value="St Louis-Mississippi.Stage.Inst.~1Day.0.netmiss-fcst">
        <button onclick="netmiss()">Submit</button>
    </div>

    <h2>Get Lake Precip</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_lake_precip.php</p>
    <div>
        <label for="location_id">location: </label>
        <input type="text" id="lake_precip" name="location_id" value="Carlyle Lk-Kaskaskia">
        <button onclick="lakePrecip()">Submit</button>
    </div>

    <h2>Get Lake Storage</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_lake_storage.php</p>
    <div>
        <label for="cwms_ts_id">cwms_ts_id: </label>
        <input type="text" id="lake_storage" name="cwms_ts_id" value="Carlyle Lk-Kaskaskia">
        <button onclick="lakeStorage()">Submit</button>
    </div>

    <h2>Get Lake Inflow</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_lake_inflow.php</p>
    <div>
        <label for="location_id">location_id: </label>
        <input type="text" id="lake_inflow" name="location_id" value="Carlyle Lk-Kaskaskia">
        <button onclick="lakeInflow()">Submit</button>
    </div>

    <h2>Get Lake Outflow</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_lake_outflow.php</p>
    <div>
        <label for="location_id">location_id: </label>
        <input type="text" id="lake_outflow" name="location_id" value="Carlyle Lk-Kaskaskia">
        <button onclick="lakeOutflow()">Submit</button>
    </div>

    <h2>Get Lake Rule Curve</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_rule_curve.php</p>
    <div>
        <label for="location_id">location_id: </label>
        <input type="text" id="rule_curve" name="location_id" value="Carlyle Lk-Kaskaskia">
        <button onclick="ruleCurve()">Submit</button>
    </div>

    <h2>Get Lake Crest Forecast</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_lake_crest_forecast.php</p>
    <div>
        <label for="location_id">location_id: </label>
        <input type="text" id="lake_crest_forecast" name="location_id" value="Carlyle Lk-Kaskaskia">
        <button onclick="lakeCrestForecast()">Submit</button>
    </div>

    <h2>Get LD Gate Summary</h2>
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_ld_gate_summary.php</p>
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
    <p>https://wm.mvs.ds.usace.army.mil/php-data-api/public/get_record_stage.php</p>
    <div>
        <label for="location_id">location: </label>
        <input type="text" id="record_stage" name="location_id" value="St Louis-Mississippi">
        <button onclick="recordStage()">Submit</button>
    </div>
  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>