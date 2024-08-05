<?php
require_once('../../private/initialize.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>St. Louis District Home Page</title>
	<meta name="Description" content="U.S. Army Corps of Engineers St. Louis District Home Page" />
	<link rel="stylesheet" href="../../../css/body.css" />
	<link rel="stylesheet" href="../../../css/breadcrumbs.css" />
	<link rel="stylesheet" href="../../../css/jumpMenu.css" />
	<script type="text/javascript" src="../../../js/main.js"></script>
	<!-- Additional CSS -->
	<link rel="stylesheet" href="../../../css/rebuild.css" />
	<!-- Include Moment.js -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
	<!-- Include the Chart.js library -->
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<!-- Include the Moment.js adapter for Chart.js -->
	<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@1.0.0"></script>
	<link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/staff.css'); ?>" />
	<script type="text/javascript" src="api.js"></script>
	<script type="text/javascript" src="api_data.js"></script>
	<script type="text/javascript" src="api_board.js"></script>
	<script type="text/javascript" src="api_database.js"></script>
	<script type="text/javascript" src="api_lake.js"></script>
	<script type="text/javascript" src="api_location.js"></script>
	<script type="text/javascript" src="api_morning.js"></script>
</head>

<body>
	<div id="page-container">
		<header id="header">
			<!--Header content populated here by JavaScript Tag at end of body -->
		</header>
		<div class="page-wrap">
			<div class="container-fluid">
				<div id="breadcrumbs">
				</div>
				<div class="page-content">
					<sidebar id="sidebar">
						<!--Side bar content populated here by JavaScript Tag at end of body -->
					</sidebar>
					<div id="topPane" class="col-md backend-cp-collapsible">
						<!-- Page Content Here -->
						<div class="box-usace">
							<h2 class="box-header-striped">
								<span class="titleLabel title">PHP Data API</span>
								<span class="rss"></span>
							</h2>
							<div class="box-content" style="background-color:white;margin:auto">
								<div class="content">
									<!-- Box Content Here -->
									<div class="tab">
										<button class="tablinks" onclick="openTab(event, 'Tab1')" id="defaultOpen">Json</button>
										<button class="tablinks" onclick="openTab(event, 'Tab2')">Alarm</button>
										<button class="tablinks" onclick="openTab(event, 'Tab3')">Location</button>
										<button class="tablinks" onclick="openTab(event, 'Tab4')">Lake</button>
										<button class="tablinks" onclick="openTab(event, 'Tab5')">Data</button>
										<button class="tablinks" onclick="openTab(event, 'Tab6')">Morning</button>
										<button class="tablinks" onclick="openTab(event, 'Tab7')">Top10</button>
										<button class="tablinks" onclick="openTab(event, 'Tab8')">Board</button>
									</div>

									<!-- gage control -->
									<div id="Tab1" class="tabcontent">
										<h2>Get Gage Control Json</h2>
										<p><a href="https://wm.mvs.ds.usace.army.mil/php_data_api/public/json/gage_control.json" target="_blank">https://wm.mvs.ds.usace.army.mil/php_data_api/public/json/gage_control.json</a></p>
									</div>

									<!-- database -->
									<div id="Tab2" class="tabcontent">
										<h2>Get Database Info</h2>
										<p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_db_info.php</p>
										<div>
											<label>disabled: </label>
											<input type="text" id="db_info" name="db_info" disabled>
											<button onclick="dbInfo()">Submit</button>
										</div>

										<h2>Get Database Change Log</h2>
										<p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_db_change_log.php</p>
										<div>
											<label>disabled: </label>
											<input type="text" id="change_log" name="change_log" disabled>
											<button onclick="dbChangeLog()">Submit</button>
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
									</div>

									<!-- location -->
									<div id="Tab3" class="tabcontent">
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

										<h2>Get Location Id Storage</h2>
										<p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_location_id_storage.php</p>
										<div>
											<label>location_id: </label>
											<input type="text" id="location_id_storage" disabled>
											<button onclick="locationIdStorage()">Submit</button>
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
									</div>

									<!-- lake -->
									<div id="Tab4" class="tabcontent">
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

									<!-- data -->
									<div id="Tab5" class="tabcontent">
										<h2>Get Storage Table</h2>
										<p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_storage_table.php</p>
										<div>
											<label>location_id: </label>
											<input type="text" id="storage_table" value="Carlyle Lk-Kaskaskia">
											<button onclick="ratingStorageTable()">Submit</button>
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

									<!-- morning -->
									<div id="Tab6" class="tabcontent">
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

									<!-- top10 -->
									<div id="Tab7" class="tabcontent">
										<h2>Get Extents By Location Id</h2>
										<p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_extents_by_location_id.php</p>
										<div>
											<label>location_id: </label>
											<input type="text" id="extents_by_location_id" value="Chester-Mississippi">
											<button onclick="extentsByLocationId()">Submit</button>
										</div>

										<h2>Get Stage 29 By Location Id</h2>
										<p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_stage_29_by_location_id.php</p>
										<div>
											<label>location_id: </label>
											<input type="text" id="stage_29_by_location_id" value="LD 22 TW-Mississippi">
											<button onclick="stage29FromLocationId()">Submit</button>
										</div>

										<h2>Get Stage Rev By Location Id</h2>
										<p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_stage_rev_by_location_id.php</p>
										<div>
											<label>location_id: </label>
											<input type="text" id="stage_rev_by_location_id" value="Chester-Mississippi">
											<button onclick="stageRevFromLocationId()">Submit</button>
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
									</div>

									<!-- board -->
									<div id="Tab8" class="tabcontent">
										<h2>Get Bankfull By Location Id</h2>
										<p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_bankfull_by_location_id.php</p>
										<div>
											<label>location_id: </label>
											<input type="text" id="bankfull_by_location_id" value="Lk Shelbyville-Kaskaskia">
											<button onclick="bankfullByLocationId()">Submit</button>
										</div>

										<h2>Get Lake Crest Forecast By Location Id</h2>
										<p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake_crest_forecast_by_location_id.php</p>
										<div>
											<label>location_id: </label>
											<input type="text" id="lake_crest_forecast_by_location_id" value="Lk Shelbyville-Kaskaskia">
											<button onclick="lakeCrestForecastByLocationId()">Submit</button>
										</div>

										<h2>Get Crest Data By Tsid</h2>
										<p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_crest_data_by_tsid.php</p>
										<div>
											<label>cwms_ts_id: </label>
											<input type="text" id="crest_data_by_tsid" value="Chester-Mississippi.Stage.Inst.30Minutes.0.lrgsShef-rev">
											<button onclick="crestDataByTsid()">Submit</button>
										</div>

										<h2>Get Generation</h2>
										<p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_generation.php</p>
										<div>
											<label>location_id: </label>
											<input type="text" id="generation" disabled>
											<button onclick="getGeneration()">Submit</button>
										</div>

										<h2>Get Generation 2</h2>
										<p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_generation2.php</p>
										<div>
											<label>location_id: </label>
											<input type="text" id="generation2" disabled>
											<button onclick="getGeneration2()">Submit</button>
										</div>

										<h2>Get Inflow By Location Id</h2>
										<p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_inflow_by_location_id.php</p>
										<div>
											<label>location_id: </label>
											<input type="text" id="inflow_by_location_id" value="Carlyle Lk-Kaskaskia">
											<button onclick="inflowByLocationId()">Submit</button>
										</div>

										<h2>Get Lake Storage By Location Id</h2>
										<p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lake_storage_by_location_id.php</p>
										<div>
											<label>location_id: </label>
											<input type="text" id="lake_storage_by_location_id" value="Carlyle Lk-Kaskaskia">
											<button onclick="lakeStorageByLocationId()">Submit</button>
										</div>

										<h2>Get Lower Upper Flow Limit By Tsid</h2>
										<p>https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_lower_upper_flow_limit_by_tsid.php</p>
										<div>
											<label>cwms_ts_id: </label>
											<input type="text" id="lower_upper_flow_limit_by_tsid" value="Carlyle-Kaskaskia.Flow.Inst.0.Flow Lower Limit">
											<button onclick="lowerUpperFlowLimitByTsid()">Submit</button>
										</div>


									</div>

									<script>
										// Get the element with id="defaultOpen" and click on it
										document.getElementById("defaultOpen").click();
									</script>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<button id="returnTop" title="Return to Top of Page">Top</button>
	</div>
	</div>
	<footer id="footer">
		<!--Footer content populated here by script tag at end of body -->
	</footer>
	<script src="../../../js/libraries/jQuery-3.3.6.min.js"></script>
	<script defer>
		// When the document has loaded pull in the page header and footer skins
		$(document).ready(function() {
			// Change the v= to a different number to force clearing the cached version on the client browser
			$('#header').load('../../../templates/INTERNAL.header.html');
			$('#sidebar').load('../../../templates/INTERNAL.sidebar.html');
			$('#footer').load('../../../templates/INTERNAL.footer.html');
		})
	</script>
</body>

</html>
<?php db_disconnect($db); ?>