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

function locationIdStorage() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_location_id_storage.php";
    const userInput = document.getElementById("location_id_storage").value;
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