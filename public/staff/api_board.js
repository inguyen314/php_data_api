function bankfullByLocationId() {
    const baseUrl = "https://wm.mvs.ds.usace.army.mil/php_data_api/public/get_bankfull_by_location_id.php";
    const userInput = document.getElementById("bankfull_by_location_id").value;
    openURL(baseUrl, { location_id: userInput });
}