
function morningReport() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_morning_report.php";
    const tsId = document.getElementById("tsId").value;
    const hour_cst = document.getElementById("hour_cst").value;
    const interval = document.getElementById("interval").value;
    const interval2 = document.getElementById("interval2").value;
    openURL(baseUrl, { tsId: tsId, hour_cst: hour_cst, interval: interval, interval2: interval2 });
}

function extentsByLocationId() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_extents_by_location_id.php";
    const userInput = document.getElementById("extents_by_location_id").value;
    openURL(baseUrl, { location_id: userInput });
}

function stage29FromLocationId() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_stage_29_by_location_id.php";
    const userInput = document.getElementById("stage_29_by_location_id").value;
    openURL(baseUrl, { location_id: userInput });
}

function stageRevFromLocationId() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_stage_rev_by_location_id.php";
    const userInput = document.getElementById("stage_rev_by_location_id").value;
    openURL(baseUrl, { location_id: userInput });
}