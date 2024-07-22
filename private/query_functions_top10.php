<?php 
//------------------------------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------------------------
function find_datman_extents_per_location($db, $location_id) {
	$stmnt_query = null;
	$data = null;
	
	try {		
		$sql = "select location_id
					,parameter_id
					,extract(YEAR from earliest_time) as min_date_year
					,extract(YEAR from latest_time) as max_date_year 
					,ts_id
				from CWMS_20.AV_TS_EXTENTS_LOCAL
				where ts_id like '%datman-rev'
				and location_id = '".$location_id."'
				order by location_id asc";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);

		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {

			$data = (object) [
				"location_id" => $row['LOCATION_ID'],
				"parameter_id" => $row['PARAMETER_ID'],
				"min_date_year" => $row['MIN_DATE_YEAR'],
				"max_date_year" => $row['MAX_DATE_YEAR'],
				"ts_id" => $row['TS_ID']			
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
function find_stage_29_from_location_id($db, $location_id) {
	$stmnt_query = null;
	
	try {		
		$sql = "select cwms_ts_id 
				from cwms_v_ts_id
				where location_id = '".$location_id."'
					and parameter_id = 'Stage'
					and version_id = '29'";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);
		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {			
			$data =  $row['CWMS_TS_ID'];
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
function find_stage_rev_from_location_id($db, $location_id) {
	$stmnt_query = null;
	
	try {		
		$sql = "select cwms_ts_id 
				from cwms_v_ts_id
				where location_id = '".$location_id."'
					and parameter_id = 'Stage'
					and version_id = 'lrgsShef-rev'";
		
		$stmnt_query = oci_parse($db, $sql);
		$status = oci_execute($stmnt_query);
		while (($row = oci_fetch_array($stmnt_query, OCI_ASSOC+OCI_RETURN_NULLS)) !== false) {			
			$data =  $row['CWMS_TS_ID'];
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