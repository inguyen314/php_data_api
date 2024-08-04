<?php
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function get_bankfull_by_location_id($db, $location_id) {
	$stmnt_query = null;
	$data = null;

	if ($location_id == "Carlyle Lk-Kaskaskia") {
		$location_id = "Carlyle Lk";
	} else if ($location_id == "Lk Shelbyville-Kaskaskia") {
		$location_id = "Lk Shelbyville";
	} else if ($location_id == 'Wappapello Lk-St Francis') {
		$location_id = "Wappapello Lk";
	} else if ($location_id == "Mark Twain Lk-Salt") {
		$location_id = "Mark Twain Lk";
	} else if ($location_id == "Rend Lk-Big Muddy") {
		$location_id = "Rend Lk";
	} else {

	}
	
	try {		
		$sql = "select case
						when location_id = 'Lk Shelbyville' then 'Lk Shelbyville-Kaskaskia'
						when location_id = 'Wappapello Lk' then 'Wappapello Lk-St Francis'
						when location_id = 'Rend Lk' then 'Rend Lk-Big Muddy'
						when location_id = 'Mark Twain Lk' then 'Mark Twain Lk-Salt'
						when location_id = 'Carlyle Lk' then 'Carlyle Lk-Kaskaskia'
						else 'na'
					end as location_id
					,location_level_id
					,level_date
					,constant_level
					,level_unit
				from CWMS_20.AV_LOCATION_LEVEL
				where specified_level_id = 'Bankfull' 
					and location_id = '".$location_id."' 
					and level_unit = 'cfs'
					and unit_system = 'EN'";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {
			$data = (object) [
				"location_id" => $row['LOCATION_ID'],
				"location_level_id" => $row['LOCATION_LEVEL_ID'],
				"level_date" => $row['LEVEL_DATE'],
				"constant_level" => $row['CONSTANT_LEVEL'],
				"level_unit" => $row['LEVEL_UNIT']
			];
		}
	}
	catch (Exception $e) {
		$e = oci_error($db);  
		trigger_error(htmlentities($e['message']), E_USER_ERROR);
		return null;
	}
	finally {
		oci_free_statement($stmnt_query); 
	}
	return $data;
}
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
?>
